<?php

declare(strict_types=1);

namespace Keyman\Site\com\keyman;
use Keyman\Site\Common\KeymanHosts;
use Keyman\Site\com\keyman\Util;

class KeymanWebHost {
  static function getKeymanWebUrlBase() {
    $json = Util::call_api_keyman_com("/version/web");
    if($json) {
      $json = json_decode($json);
    }
    if($json && property_exists($json, 'version')) {
      $build = $json->version;
    } else {
      // If the get-version API fails, we'll use the latest known stable version
      $build = "18.0.246";
    }

    return KeymanHosts::Instance()->s_keyman_com."/kmw/engine/$build";
  }
}
