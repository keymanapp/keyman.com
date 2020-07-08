<?php
  declare(strict_types=1);

  namespace Keyman\Site\com\keyman;

  require __DIR__ . '/../../_includes/autoload.php';

  const DEBUG=0;

  use Keyman\Site\com\keyman\Validation;
  use Keyman\Site\com\keyman\KeymanHosts;

  PackageDownloadPage::redirect_to_file(
    isset($_REQUEST['id']) ? $_REQUEST['id'] : null,
    isset($_REQUEST['version']) ? $_REQUEST['version'] : null,
    isset($_REQUEST['platform']) ? $_REQUEST['platform'] : null,
    isset($_REQUEST['tier']) ? $_REQUEST['tier'] : null,
    isset($_REQUEST['bcp47']) ? $_REQUEST['bcp47'] : null,
    isset($_REQUEST['update']) ? $_REQUEST['update'] : null,
    isset($_COOKIE['_ga']) ? $_COOKIE['_ga'] : null
  );

  class PackageDownloadPage {

    public static function redirect_to_file($id, $version, $platform, $tier, $bcp47, $update, $ga_cookie) {
      if(empty($id)) {
        echo "Invalid parameters; id and version expected";
        exit;
      }

      if(empty($version)) {
        // If version isn't provided, we'll query the live api for the version
        $json = @file_get_contents(KeymanHosts::Instance()->api_keyman_com . '/keyboard/' . rawurlencode($id));
        if ($json !== FALSE) {
          $json = json_decode($json);
        }

        if(empty($json)) {
          echo "Invalid parameter; id not found";
          exit;
        }

        $version = $json->version;
      }

      $update = empty($update) ? 0 : 1;

      $bcp47 = Validation::validate_bcp47($bcp47);
      $tier = Validation::validate_tier($tier, 'stable');
      $platform = Validation::validate_platform($platform, 'unknown');

      $url = KeymanHosts::Instance()->downloads_keyman_com . "/keyboards/$id/$version/$id.kmp";
      $url_e = htmlentities($url);

      if(DEBUG) header('Content-Type: text/plain');

      self::report_download_event($ga_cookie, $id, $platform, $tier, $bcp47, $update);

      if(DEBUG) {
        echo "\n\nLocation: $url\n";
        exit;
      }

      header("HTTP/1.1 302 Found");
      header("Cache-Control: no-store");
      header("Location: $url");
      echo "<a href='$url_e'>Download Link</a>";
    }

    private static function report_download_event($ga_cookie, $id, $platform, $tier, $bcp47, $update) {
      $cid = '';
      if(empty($ga_cookie)) $ga_cookie = '';

      if(preg_match('/^GA\d+\.\d\.(.+)$/', $ga_cookie, $matches)) {
        $cid = rawurlencode($matches[1]);
        $gauser = "cid={$cid}";
      } else {
        $uid = GUIDv4(true);
        $gauser = "uid={$uid}";
      }

      if(DEBUG) {
        $gabaseurl = "https://www.google-analytics.com/debug/collect";
      } else {
        $gabaseurl = "https://www.google-analytics.com/collect";
      }

      $update = $update ? "update" : "install";

      $category = 'keyboard';
      $action = rawurlencode("download-$platform-$tier-$update" . (empty($bcp47) ? "" : "-$bcp47"));
      $label = rawurlencode($id);

      $gaurl = "$gabaseurl?v=1&t=event&tid=UA-249828-1&$gauser&ds=server&ec=$category&ea=$action&el=$label";
      $result = @file_get_contents($gaurl);
      if(DEBUG) {
        var_dump("Google Analytics response for $gaurl: ".print_r($http_response_header, true));
      }

      return !($result === FALSE);
    }
  }

/**
* Returns a GUIDv4 string
*
* Uses the best cryptographically secure method
* for all supported pltforms with fallback to an older,
* less secure version.
* https://www.php.net/manual/en/function.com-create-guid.php#119168
*
* @param bool $trim
* @return string
*/
function GUIDv4 ($trim = true)
{
    // Windows
    if (function_exists('com_create_guid') === true) {
        if ($trim === true)
            return trim(com_create_guid(), '{}');
        else
            return com_create_guid();
    }

    // OSX/Linux
    if (function_exists('openssl_random_pseudo_bytes') === true) {
        $data = openssl_random_pseudo_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);    // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);    // set bits 6-7 to 10
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    // Fallback (PHP 4.2+)
    mt_srand((double)microtime() * 10000);
    $charid = strtolower(md5(uniqid(rand(), true)));
    $hyphen = chr(45);                  // "-"
    $lbrace = $trim ? "" : chr(123);    // "{"
    $rbrace = $trim ? "" : chr(125);    // "}"
    $guidv4 = $lbrace.
              substr($charid,  0,  8).$hyphen.
              substr($charid,  8,  4).$hyphen.
              substr($charid, 12,  4).$hyphen.
              substr($charid, 16,  4).$hyphen.
              substr($charid, 20, 12).
              $rbrace;
    return $guidv4;
}