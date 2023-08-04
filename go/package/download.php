<?php
  declare(strict_types=1);

  namespace Keyman\Site\com\keyman;

  require __DIR__ . '/../../_includes/autoload.php';

  const DEBUG=0;

  use Keyman\Site\com\keyman\KeymanComSentry;
  use Keyman\Site\com\keyman\Validation;
  use Keyman\Site\Common\KeymanHosts;
  use Keyman\Site\Common\JsonApiFailure;

  KeymanComSentry::init();

  PackageDownloadPage::redirect_to_file(
    isset($_REQUEST['type']) ? $_REQUEST['type'] : null,
    isset($_REQUEST['id']) ? $_REQUEST['id'] : null,
    isset($_REQUEST['version']) ? $_REQUEST['version'] : null,
    isset($_REQUEST['platform']) ? $_REQUEST['platform'] : null,
    isset($_REQUEST['tier']) ? $_REQUEST['tier'] : null,
    isset($_REQUEST['bcp47']) ? $_REQUEST['bcp47'] : null,
    isset($_REQUEST['update']) ? $_REQUEST['update'] : null
  );

  class PackageDownloadPage {

    public static function redirect_to_file($type, $id, $version, $platform, $tier, $bcp47, $update) {
      if(empty($type)) {
        $type = 'keyboard';
      }

      if($type !== 'keyboard' && $type !== 'model') {
        JsonApiFailure::InvalidParameters("type");
      }

      if(empty($id)) {
        JsonApiFailure::InvalidParameters("id, version");
      }

      if(empty($version)) {
        // If version isn't provided, we'll query the live api for the version
        $json = @file_get_contents(KeymanHosts::Instance()->api_keyman_com . "/$type/" . rawurlencode($id));
        if ($json !== FALSE) {
          $json = json_decode($json);
        }

        if(empty($json)) {
          JsonApiFailure::Failure(404, JsonApiFailure::ERROR_NotFound, "$type package with id $id was not found");
        }

        $version = $json->version;
      }

      $update = empty($update) ? 0 : 1;

      $bcp47 = Validation::validate_bcp47($bcp47);
      $tier = Validation::validate_tier($tier, 'stable');
      $platform = Validation::validate_platform($platform, 'unknown');

      if($type === 'keyboard') {
        $url = KeymanHosts::Instance()->downloads_keyman_com . "/keyboards/$id/$version/$id.kmp";
      }
      else {
        $url = KeymanHosts::Instance()->downloads_keyman_com . "/models/$id/$version/$id.model.kmp";
      }

      $url_e = htmlentities($url);

      if(DEBUG) {
        header('Content-Type: text/plain');
      }

      if(KeymanHosts::Instance()->Tier() !== KeymanHosts::TIER_TEST) {
        self::report_download_event($id . ($type === "model" ? ".$type" : ""), $platform, $tier, $bcp47, $update);

        if(DEBUG) {
          echo "\n\nLocation: $url\n";
          exit;
        }

        // We don't do a redirect for Test tier because a test instance of the
        // downloads server is not available and so it gives us an error
        header("HTTP/1.1 302 Found");
        header("Cache-Control: no-store");
        header("Location: $url");
      }

      echo "<a href='$url_e'>Download Link</a>";
    }

    private static function report_download_event($id, $platform, $tier, $bcp47, $update) {
      $url = KeymanHosts::Instance()->api_keyman_com . "/increment-download/".rawurlencode($id);

      if(KeymanHosts::Instance()->Tier() !== KeymanHosts::TIER_TEST) {
        if(KeymanHosts::Instance()->Tier() === KeymanHosts::TIER_DEVELOPMENT)
          $key = 'local';
        else
          $key = $_SERVER['API_KEYMAN_COM_INCREMENT_DOWNLOAD_KEY'];

        $c = curl_init($url);
        curl_setopt($c, CURLOPT_HEADER, 0);
        curl_setopt($c, CURLOPT_POSTFIELDS, 'key='.rawurlencode($key));
        curl_setopt($c, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($c, CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
        $data = curl_exec($c);
        curl_close($c);

        if(DEBUG) {
          var_dump("increment-download ($url):",$data);
        }
      } else
        $data = TRUE;
      return $data !== FALSE;
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