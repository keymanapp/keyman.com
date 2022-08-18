<?php
  require_once __DIR__ . '/../../_includes/autoload.php';
  use Keyman\Site\com\keyman\KeymanComSentry;
  use Keyman\Site\Common\KeymanHosts;
  use Keyman\Site\com\keyman\Util;

  KeymanComSentry::init();

  if(isset($_REQUEST['tier'])) {
    $TIER = $_REQUEST['tier'];
  } else {
    $TIER = 'stable';
  }

  if(!isset($_REQUEST['object'])) {
    Util::Fail("Error: object must be specified");
  }

  $object = $_REQUEST['object'];

  if(!in_array($TIER, ['alpha','beta','stable'])) {
    Util::Fail("Error: tier must be alpha, beta or stable");
  }

  if(isset($_REQUEST['version'])) {
    $DEVELOPER_VERSION = $_REQUEST['version'];
    $WINDOWS_VERSION = $_REQUEST['version'];
    $MAC_VERSION = $_REQUEST['version'];
  } else {
    $versions = @json_decode(file_get_contents(KeymanHosts::Instance()->downloads_keyman_com . '/api/version/2.0'));

    $DEVELOPER_VERSION = $versions->developer->$TIER->version;
    $WINDOWS_VERSION = $versions->windows->$TIER->version;
    $MAC_VERSION = $versions->mac->$TIER->version;
  }

  $packages = [
    "kmcomp" => ["developer", $DEVELOPER_VERSION, "kmcomp-$DEVELOPER_VERSION.zip"],
    "keyman-developer" => ["developer", $DEVELOPER_VERSION, "keymandeveloper-$DEVELOPER_VERSION.exe"],
    "keyman-windows" => ["windows", $WINDOWS_VERSION, "keyman-$WINDOWS_VERSION.exe"],
    "keyman-mac" => ["mac", $MAC_VERSION, "keyman-$MAC_VERSION.dmg"]
  ];

  if(!isset($packages[$object])) {
    Util::Fail("Error: object not found");
  }

  $package = $packages[$object];

  $url = KeymanHosts::Instance()->downloads_keyman_com . "/{$package[0]}/$TIER/{$package[1]}/{$package[2]}";
  header('HTTP/302 Temporary Redirect');
  header("Location: $url");