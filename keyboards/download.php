<?php
  define('DEBUG', false);

  // Redirects download to the appropriate file on downloads.keyman.com
  // On the way, captures some statistics on the download for GA with a 'keyboard' event
  // If necessary, triggers a rebuild for a bundled installer upgrade
  //
  // Parameters:
  //   id        string identifier of keyboard to download
  //   platform  one of windows,macos,linux,ios,android,web
  //   mode:     optional, either bundle or standalone (for now, supported only for Windows)
  //   cid:      optional, adds client id for Google Analytics tracking

  require_once('includes/template.php');

  if(DEBUG)
    header('Content-Type: text/plain');

  function fail($s) {
    header('HTTP/1.0 400');
    header('Content-Type: text/plain');
    echo $s;
    exit;
  }

  if(!validateParameters($id, $platform, $mode, $cid, $target)) {
    fail('Invalid parameters');
  }

  $downloads = getKeyboardDownloadData($id);

  recordGoogleAnalyticsEvent($cid, $id, $platform, $mode);

  if(hasNewerBundleVersion($id, $downloads)) {
    triggerBuildOfBundle($id);
  }

  redirectToDownload($downloads, $target);

  /**
   * Validate that input parameters are correct
   */
  function validateParameters(&$id, &$platform, &$mode, &$cid, &$target) {
    if(!isset($_REQUEST['id']) || !isset($_REQUEST['platform'])) {
      fail("Usage: download.php?id=<keyboard_id>&platform=<platform>[&mode=<bundle|standalone>][&cid=xxxx]");
    }

    $id = $_REQUEST['id'];
    $platform = $_REQUEST['platform'];
    if(isset($_REQUEST['mode'])) $mode = $_REQUEST['mode']; else $mode = 'standalone';
    if(isset($_REQUEST['cid'])) $cid = $_REQUEST['cid'];

    if(!in_array($platform, ['windows','macos','linux','ios','android','web'])) {
      fail("Invalid platform parameter");
    }

    if(!in_array($mode, ['bundle', 'standalone'])) {
      fail("Invalid mode parameter");
    }

    // For now, the only bundle type supported is Windows
    if($mode == 'standalone' && $platform != 'windows') {
      fail("Bundles are only supported for Windows platform");
    }

    switch($mode) {
      case 'bundle':
        if($platform != 'windows') {
          fail("Bundles are only supported for Windows platform");
        }
        $target = 'windows';
        break;
      case 'standalone':
        if($platform == 'web') {
          $target = 'js';
        } else {
          $target = 'kmp';
        }
        break;
    }
    return true;
  }

  /**
   * Get metadata on the downloadable files from the download server for the keyboard in question
   */
  function getKeyboardDownloadData($id) {
    global $downloadhost;

    $s = @file_get_contents($downloadhost . '/api/keyboard/1.0/' . rawurlencode($id));
    if($s === FALSE) {
      echo "Unable to find keyboard $id";
      exit;
    }

    $downloads = json_decode($s);

    return $downloads;
  }

  /**
   * Record download request on Google Analytics
   */
  function recordGoogleAnalyticsEvent($cid, $id, $platform, $mode) {
    if(empty($cid)) {
      $uid = com_create_guid();
      $gauser = 'uid='.$uid;
    } else {
      $gauser = 'cid='.rawurlencode($cid);
    }

    if(DEBUG) {
      $gabaseurl = "https://www.google-analytics.com/debug/collect";
    } else {
      $gabaseurl = "https://www.google-analytics.com/collect";
    }
    $gaurl = "$gabaseurl?v=1&t=event&tid=UA-249828-1&$gauser&ds=server&ec=keyboard&ea=download-$platform-$mode&el=".rawurlencode($id);
    $result = @file_get_contents($gaurl);
    if(DEBUG)
      var_dump($http_response_header);

    return !($result === FALSE);
  }

  /**
   * Check if a newer version of the keyboard package and/or Keyman Desktop executable are available
   */
  function hasNewerBundleVersion($id, $downloads) {
    // Get the keyboard version from api.keyman.com:
    $s = @file_get_contents($apihost . '/keyboard/' . rawurlencode($id));
    if ($s !== FALSE) {
      // Test if we have a Windows version available
      $keyboard_info = json_decode($s);
      $keyboardVersion = $keyboard_info->version;
      $supportsWindows = is_object($keyboard_info) && isset($keyboard_info->platformSupport->windows) && $keyboard_info->platformSupport->windows != 'none';
    } else {
      // We avoid
      $supportsWindows = false;
    }

    if($supportsWindows) {
      if(!isset($downloads->windows) && $target == 'windows') {
        // TODO: trigger Windows bundled build because it is not present and allow retry
        $shouldBuild = true;
      } else {
        //
        // Parse the executable filename. This is not ideal but better than adding a bunch of additional infrastructure
        // to store the version metadata separately
        //

        $s = @file_get_contents($downloadhost . '/api/version/windows');
        if ($s !== FALSE) {
          $windowsVersion = json_decode($s);
          $windowsStableVersion = $windowsVersion->windows->stable;
        }

        $shouldBuild =
          preg_match('/keymandesktop-(\d+\.\d+\.\d+\.\d+)-(.+)-([0-9.]+)\.exe$/', $downloads->windows, $matches) &&
          (version_compare($keyboardVersion, $matches[3], '>') || version_compare($windowsStableVersion, $matches[1], '>'));
      }
    } else {
      $shouldBuild = false;
    }

    return $shouldBuild;
  }

  /**
   * Ask TeamCity to queue build and upload of a keyboard bundle for Windows
   */
  function triggerBuildOfBundle($id) {
    $data =
    '<build>
      <buildType id="Keyboards_BuildAndDeployBundledInstaller"/>
      <comment><text>Build triggered by keyboard download</text></comment>
      <properties>
        <property name="target_keyboard" value="'.htmlspecialchars($id, ENT_COMPAT, 'UTF-8').'"/>
      </properties>
    </build>';

    $bearer_token = $_ENV['teamcity_bearer_token'];
    $url = 'https://build.palaso.org/app/rest/buildQueue';
    $options = array(
      'http' => array(
          'header'  => "Content-Type: application/xml\r\n".
                        "Origin: https://build.palaso.org\r\n".
                        "Authorization: Bearer $bearer_token\r\n",
          'method'  => 'POST',
          'content' => $data
      )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) {
      /* Handle error */
      // TODO: log the error; but where; this will come later with active error monitoring
      if(DEBUG) {
        var_dump($http_response_header);
        var_dump($result);
      }
    }
    return !($result === FALSE);
  }

  /**
   * Redirect to the download, if it is available; otherwise, return to the keyboard
   * information page and show a toast.
   */
  function redirectToDownload($downloads, $target) {
    if(!isset($downloads->$target)) {
      // TODO: redirect to keyboard page and toast
      fail("Download target is not found");
      exit;
    }

    if(DEBUG) {
      echo $downloads->$target;
    } else {
      header($_SERVER["SERVER_PROTOCOL"].' 302 Found');
      header('Location: '.$downloads->$target);
    }
  }
?>