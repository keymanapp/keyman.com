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

  require_once('includes/servervars.php');

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

  triggerDownloadBackgroundProcesses($cid, $id, $platform, $mode);

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
   * Start a background PHP process to do the async work so we don't block the user
   */
  function triggerDownloadBackgroundProcesses($cid, $id, $platform, $mode) {
    $bearer_token = getenv('TEAMCITY_TOKEN');
    if($bearer_token === FALSE) {
      error_log("ERROR: [download.php] TEAMCITY_TOKEN is not configured.");
      return false;
    }

    execInBackground("php ../_includes/async/keyboard-download.php " .
      escapeshellarg($cid) . " " .
      escapeshellarg($id) . " " .
      escapeshellarg($platform) . " " .
      escapeshellarg($mode) . " " .
      escapeshellarg($bearer_token)
    );
  }

  /**
   * Run in background, cross platform
   * https://www.php.net/manual/en/function.exec.php#86329
   */
  function execInBackground($cmd) {
    if (substr(php_uname(), 0, 7) == "Windows"){
        pclose(popen("start /B ". $cmd, "r"));
    }
    else {
        exec($cmd . " > /dev/null &");
    }
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