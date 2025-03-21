<?php
  use Keyman\Site\Common\KeymanHosts;
  define('DEBUG', false);

  // Redirects download to the appropriate file on downloads.keyman.com
  // On the way, captures some statistics on the download to api.keyman.com
  //
  // Parameters:
  //   id        string identifier of keyboard to download
  //   platform  one of windows,macos,linux,ios,android,web
  //   mode:     optional, either bundle or standalone (for now, supported only for Windows)

  require_once('includes/servervars.php');

  if(DEBUG)
    header('Content-Type: text/plain');

  function fail($s) {
    header('HTTP/1.0 400');
    header('Content-Type: text/plain');
    echo $s;
    exit;
  }

  if(!validateParameters($id, $platform, $mode, $target)) {
    fail('Invalid parameters');
  }

  $downloads = getKeyboardDownloadData($id);

  redirectToDownload($downloads, $target);

  /**
   * Validate that input parameters are correct
   */
  function validateParameters(&$id, &$platform, &$mode, &$target) {
    if(!isset($_REQUEST['id']) || !isset($_REQUEST['platform'])) {
      fail("Usage: download.php?id=<keyboard_id>&platform=<platform>[&mode=<bundle|standalone>]");
    }

    $id = $_REQUEST['id'];
    $platform = $_REQUEST['platform'];
    if(isset($_REQUEST['mode'])) $mode = $_REQUEST['mode']; else $mode = 'standalone';

    if(!in_array($platform, ['windows','macos','linux','ios','android','web'])) {
      fail("Invalid platform parameter");
    }

    if(!in_array($mode, ['bundle', 'standalone'])) {
      fail("Invalid mode parameter");
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
    $s = @file_get_contents(KeymanHosts::Instance()->SERVER_downloads_keyman_com . '/api/keyboard/1.0/' . rawurlencode($id));
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