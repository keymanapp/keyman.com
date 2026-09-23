<?php
/**
 *
 * Provide static links to executable downloads of Keyman products on various
 * platforms.
 *
 * Usage:
 * https://keyman.com/go/download/<PRODUCT>[?tier=<TIER>][&version=<VERSION>]
 *
 * PRODUCT: kmcomp|keyman-developer|keyman-windows|keyman-mac
 * TIER: alpha|beta|stable (default 'stable')
 * VERSION: any valid version number (default to latest for tier)
 *
 * Redirects to the referenced executable, e.g. keyman-18.0.252.dmg for Mac.
 *
 * This page is referenced by Keyman Developer Server, e.g.
 * /go/download/keyman-mac and by Keyman Developer kmc documentation
 * /go/download/kmcomp. These paths are rewritten by .htaccess to call into
 * _download.php.
 */

  require_once _KEYMANCOM_INCLUDES . '/autoload.php';
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
    $versions = @json_decode(Util::call_downloads_keyman_com('/api/version/2.0', 'downloads.keyman.com-api_version_2.0.json'));

    $DEVELOPER_VERSION = $versions->developer->$TIER->version;
    $WINDOWS_VERSION = $versions->windows->$TIER->version;
    $MAC_VERSION = $versions->mac->$TIER->version;
  }

  // epic/mac-config changes the mac installer from a .dmg to .pkg, in version 19.0.2xx-alpha
  // TODO: update to actual release version
  $MAC_FILENAME = version_compare($MAC_VERSION, "19.0.288") >= 0 ? "keyman-$MAC_VERSION.pkg" : "keyman-$MAC_VERSION.dmg";

  $packages = [
    "kmcomp" => ["developer", $DEVELOPER_VERSION, "kmcomp-$DEVELOPER_VERSION.zip"],
    "keyman-developer" => ["developer", $DEVELOPER_VERSION, "keymandeveloper-$DEVELOPER_VERSION.exe"],
    "keyman-windows" => ["windows", $WINDOWS_VERSION, "keyman-$WINDOWS_VERSION.exe"],
    "keyman-mac" => ["mac", $MAC_VERSION, $MAC_FILENAME],
  ];

  if(!isset($packages[$object])) {
    Util::Fail("Error: object not found");
  }

  $package = $packages[$object];

  $url = KeymanHosts::Instance()->downloads_keyman_com . "/{$package[0]}/$TIER/{$package[1]}/{$package[2]}";
  header('HTTP/302 Temporary Redirect');
  header("Location: $url");