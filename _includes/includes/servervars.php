<?php /*
  Name:             servervars
  Copyright:        Copyright (C) 2005 Tavultesoft Pty Ltd.
  Documentation:
  Description:
  Create Date:      17 Oct 2009

  Modified Date:    17 Oct 2009
  Authors:          mcdurdin
  Related Files:
  Dependencies:

  Bugs:
  Todo:
  Notes:
  History:          17 Oct 2009 - mcdurdin - Alter help base dir
*/

  require_once __DIR__ . '/../../vendor/autoload.php';
  require_once __DIR__ . '/../../_common/KeymanSentry.php';
  require_once __DIR__ . '/../2020/KeymanComSentry.php';
  Keyman\Site\com\keyman\KeymanComSentry::init();

  // *don't* use autoloader here because it may lead to side-effects in older pages
  require_once(__DIR__ . '/../../_common/KeymanVersion.php');
  require_once(__DIR__ . '/../../_common/KeymanHosts.php');
  require_once(__DIR__ . '/../2020/Util.php');

  use \Keyman\Site\Common\KeymanVersion;
  use \Keyman\Site\Common\KeymanHosts;
  use \Keyman\Site\com\keyman\Util;

  // Major stable and beta versions
  // TODO: refactor away these globals
  global $stable_version_int, $beta_version_int;
  $stable_version_int = KeymanVersion::stable_version_int;
  $beta_version_int = KeymanVersion::beta_version_int;

  global $stable_version, $beta_version;
  $stable_version = KeymanVersion::stable_version;
  $beta_version = KeymanVersion::beta_version;

  global $unicode_version;
  $unicode_version = KeymanVersion::unicode_version;

  function betaTier() {
    return KeymanVersion::IsBetaTier();
  }

  // TODO refactor away global variable
  global $KeymanHosts;
  $KeymanHosts = KeymanHosts::Instance();

  // Alpha and Beta signup links
  global $playstore_signup_link, $testflight_alpha_link, $testflight_beta_link;
  $playstore_signup_link = "https://play.google.com/apps/testing/com.tavultesoft.kmapro";
  $testflight_alpha_link = "https://testflight.apple.com/join/vnCV2EiH";
  $testflight_beta_link = "https://testflight.apple.com/join/9W4XIoxQ";

  function cdn($file) {
    return Util::cdn($file);
  }
