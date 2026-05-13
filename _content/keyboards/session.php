<?php
  if(!isset($_SESSION)) {
    session_set_cookie_params(["SameSite" => "None"]);   // Allow use in iframe, needed for Download Keyboards dialog
    session_set_cookie_params(["Secure" => "true"]);     // None requires Secure to be set
    session_start();
  }

  if(isset($_REQUEST['embed'])) {
    $embed = $_REQUEST['embed'];
    if(!in_array($embed, ['none','windows','macos','linux','android','ios','developer'])) {
      $embed = 'none';
    }
    if(isset($_REQUEST['version'])) {
      $embed_version = $_REQUEST['version'];
    } else {
      $embed_version = '10.0.0.0';
    }
  } else if(isset($_SESSION['embed']) && isset($_SESSION['embed_version'])) {
    $embed = $_SESSION['embed'];
    $embed_version = $_SESSION['embed_version'];
  } else {
    $embed = 'none';
    $embed_version = null;
  }
  $_SESSION['embed'] = $embed;
  $_SESSION['embed_version'] = $embed_version;

  $embed_win = $embed == 'windows';
  $embed_mac = $embed == 'macos';
  $embed_linux = $embed == 'linux';
  $embed_android = $embed == 'android';
  $embed_ios = $embed == 'ios';
  $embed_developer = $embed == 'developer';

  if($embed != 'none') {
    // Set a cookie header for subsequent requests so that we do not get a
    // locale redirect for embedded keyboard search for Keyman 14.0-18.0. See
    // /.htaccess for full discussion (line ~32)
    setcookie('embed_keyboards_no_locale_redirect', '1', 0, '/');

    $session_query = http_build_query([
      'embed' => $embed,
      'version' => $embed_version
    ]);
    $session_query_q = "?$session_query";
  } else {
    $session_query = '';
    $session_query_q = '';
  }
?>