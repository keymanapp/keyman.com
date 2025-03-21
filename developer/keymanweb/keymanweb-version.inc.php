<?php
require_once("includes/servervars.php");

use Keyman\Site\Common\KeymanHosts;

function getKeymanWebHref()
{
  $json = @file_get_contents(KeymanHosts::Instance()->SERVER_api_keyman_com . "/version/web");
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
