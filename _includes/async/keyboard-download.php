<?php
  define('DEBUG', 0); // 0 = off, 1 = lots of logging but don't force a build, 2 = force a build

  if(!is_cli()) {
    echo 'keyboard-download.php must be run from the command line, not web server environment.';
    exit(1);
  }

  require_once(dirname(__FILE__)."\\..\\includes\\servervars.php");

  if($argv < 5) {
    error_log('Parameters: cid id platform mode bearer_token(teamcity)');
    exit(1);
  }

  $cid = $argv[1];
  $id = $argv[2];
  $platform = $argv[3];
  $mode = $argv[4];
  $bearer_token = $argv[5];

  if(DEBUG) {
    error_log("Input parameters: cid=$cid id=$id platform=$platform mode=$mode bearer_token=$bearer_token");
  }

  function fail($s) {
    error_log('FAIL: '.$s);
    exit(1);
  }

  $downloads = getKeyboardDownloadData($id);

  recordGoogleAnalyticsEvent($cid, $id, $platform, $mode);

  if(hasNewerBundleVersion($id, $downloads)) {
    // TeamCity by default will not queue multiple instances of builds with similar properties
    // so it doesn't hurt to re-trigger it.
    triggerBuildOfBundle($id, $bearer_token);
  }

  // TODO: have shared download code

  /**
   * Get metadata on the downloadable files from the download server for the keyboard in question
   */
  function getKeyboardDownloadData($id) {
    global $downloadhost;
    $url = $downloadhost . '/api/keyboard/1.0/' . rawurlencode($id);
    $s = @file_get_contents($url);
    if($s === FALSE) {
      fail("Unable to find keyboard $id");
    }

    $downloads = json_decode($s);

    if(DEBUG) {
      error_log("Downloads data for $url: ".print_r($downloads, true));
    }

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
    if(DEBUG) {
      error_log("Google Analytics response for $gaurl: ".print_r($http_response_header, true));
    }

    return !($result === FALSE);
  }

  /**
   * Check if a newer version of the keyboard package and/or Keyman Desktop executable are available
   */
  function hasNewerBundleVersion($id, $downloads) {
    global $apihost, $downloadhost;

    $shouldBuild = false;

    // Get the keyboard version from api.keyman.com:
    $url = $apihost . '/keyboard/' . rawurlencode($id);
    $s = @file_get_contents($url);
    if ($s !== FALSE) {
      // Test if we have a Windows version available
      $keyboard_info = json_decode($s);

      if(DEBUG) {
        error_log("api response for $url: ".print_r($keyboard_info, true));
      }

      $keyboardVersion = $keyboard_info->version;
      $supportsWindows = is_object($keyboard_info) && isset($keyboard_info->platformSupport->windows) && $keyboard_info->platformSupport->windows != 'none';
    } else {
      // We avoid
      error_log("Failed to download $url: $php_errormsg");
      $supportsWindows = false;
    }

    if($supportsWindows) {
      if(!isset($downloads->windows)) {
        // Trigger Windows bundled build because it is not present
        // Building initial version will be triggered through a maintenance plan
        $shouldBuild = true;
      } else {
        //
        // Parse the executable filename. This is not ideal but better than adding a bunch of additional infrastructure
        // to store the version metadata separately
        //

        $url = $downloadhost . '/api/version/windows';
        $s = @file_get_contents($url);
        if ($s !== FALSE) {
          $windowsVersion = json_decode($s);

          if(DEBUG) {
            error_log("api response for $url: ".print_r($windowsVersion, true));
          }

          $windowsStableVersion = $windowsVersion->windows->stable;
          $shouldBuild =
            preg_match('/keymandesktop-(\d+\.\d+\.\d+\.\d+)-(.+)-([0-9.]+)\.exe$/', $downloads->windows, $matches) &&
              (version_compare($keyboardVersion, $matches[3], '>') || version_compare($windowsStableVersion, $matches[1], '>'));

          if(DEBUG == 2) {
            // Force a test build
            $shouldBuild = true;
          }
        } else {
          error_log("Failed to download $url: $php_errormsg");
        }
      }
    }

    return $shouldBuild;
  }

  /**
   * Ask TeamCity to queue build and upload of a keyboard bundle for Windows
   */
  function triggerBuildOfBundle($id, $bearer_token) {
    $data =
    '<build>
      <buildType id="Keyboards_BuildAndDeployBundledInstaller"/>
      <comment><text>Build triggered by keyboard download</text></comment>
      <properties>
        <property name="target_keyboard" value="'.htmlspecialchars($id, ENT_COMPAT, 'UTF-8').'"/>
      </properties>
    </build>';

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
    $result = @file_get_contents($url, false, $context);
    if ($result !== FALSE) {
      if(DEBUG) {
        error_log("TeamCity response for $url(".print_r($options, true)."): ".$result);
      }
    } else {
      /* Handle error */
      if(DEBUG) {
        error_log("Error loading $url: " . print_r($http_response_header));
      }
      return FALSE;
    }
    return TRUE;
  }

  function is_cli() {
    return empty($_SERVER['REMOTE_ADDR']);
  }
?>