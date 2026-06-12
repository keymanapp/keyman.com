<?php
  declare(strict_types=1);

  namespace Keyman\Site\com\keyman;

  use Keyman\Site\Common\KeymanHosts;

  class Util {
    static function Fail($message) {
      echo $message;
      //TODO: http header 500
      exit;
    }

    static function cdn($file) {
      global $cdn; // we'll continue to use this as global for now.
      if(!isset($cdn)) {
        if(!empty($_SERVER['DOCUMENT_ROOT']) && file_exists($_SERVER['DOCUMENT_ROOT'].'/cdn/deploy/cdn.php')) {
          require_once($_SERVER['DOCUMENT_ROOT'].'/cdn/deploy/cdn.php');
        } else {
          $cdn = false;
        }
      }
      $use_cdn = KeymanHosts::Instance()->Tier() == KeymanHosts::TIER_PRODUCTION ||
          KeymanHosts::Instance()->Tier() == KeymanHosts::TIER_STAGING ||
          (isset($_REQUEST['cdn']) && $_REQUEST['cdn'] == 'force');
      if($use_cdn) {
        if($cdn && isset($cdn['/'.$file])) {
          return "/cdn/deploy{$cdn['/'.$file]}";
        }
      }
      // TODO: log warning or error to sentry on missing files
      return "/cdn/dev/{$file}";
    }

    private static function call_keyman_site($site, $url, $testFixture) {
      if(KeymanHosts::Instance()->Tier() == KeymanHosts::TIER_TEST) {
        return file_get_contents(__DIR__ . '/../../tests/fixtures/' . $testFixture);
      }

      // curl library is more reliable than file_get_contents
      $curl_handle=curl_init();
      curl_setopt($curl_handle, CURLOPT_URL, $site . $url);
      curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
      curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($curl_handle, CURLOPT_USERAGENT, 'keyman.com/1.0');
      $query = @curl_exec($curl_handle);
      $http_code = curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);
      curl_close($curl_handle);
      if($http_code >= 200 && $http_code <= 299) {
        // Can use this to generate fixtures when needed:
        // $p = parse_url($site . $url);
        // file_put_contents(__DIR__ . '/../../tests/fixtures/' . $site . '-' . str_replace('/', '_', $p['path']) . '.json', $query);
        return $query;
      } else {
        @trigger_error("request to $site$url failed with $http_code");
        return FALSE;
      }
    }

    static function call_api_keyman_com($url, $testFixture) {
      return Util::call_keyman_site(KeymanHosts::Instance()->SERVER_api_keyman_com, $url, $testFixture);
    }

    static function call_downloads_keyman_com($url, $testFixture) {
      return Util::call_keyman_site(KeymanHosts::Instance()->SERVER_downloads_keyman_com, $url, $testFixture);
    }
  }
