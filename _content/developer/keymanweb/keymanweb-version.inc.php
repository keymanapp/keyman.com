<?php
require_once _KEYMANCOM_INCLUDES . '/includes/servervars.php';

use Keyman\Site\Common\KeymanHosts;
use Keyman\Site\com\keyman\Util;

function getKeymanWebHref()
{
  $json = Util::call_api_keyman_com("/version/web");
  if ($json) {
    $json = json_decode($json);
  }
  if ($json && property_exists($json, 'version')) {
    $build = $json->version;
  } else {
    // If the get-version API fails, we'll use the latest known stable version
    $build = "17.0.328";
  }

  $cdnUrlBase = KeymanHosts::Instance()->s_keyman_com . "/kmw/engine/$build";
  return $cdnUrlBase;
}
