<?php
  declare(strict_types=1);

  namespace Keyman\Site\com\keyman;

  require __DIR__ . '/../../_includes/autoload.php';

  const DEBUG=0;

  use Keyman\Site\com\keyman\KeymanComSentry;
  use Keyman\Site\com\keyman\Validation;
  use Keyman\Site\Common\KeymanHosts;
  use Keyman\Site\Common\JsonApiFailure;

  $env = getenv();
  KeymanComSentry::init();

  AppDownloadPage::redirect_to_file(
    isset($_REQUEST['url']) ? $_REQUEST['url'] : null,
    isset($_REQUEST['product']) ? $_REQUEST['product'] : null,
    isset($_REQUEST['version']) ? $_REQUEST['version'] : null,
    isset($_REQUEST['tier']) ? $_REQUEST['tier'] : null,
    // TODO: should we? or just leave it encoded in URL for now?
    // isset($_REQUEST['bcp47']) ? $_REQUEST['bcp47'] : null,
    // isset($_REQUEST['update']) ? $_REQUEST['update'] : null
  );

  class AppDownloadPage {

    public static function redirect_to_file($url, $product, $version, $tier) {
      if(empty($url)) {
        JsonApiFailure::InvalidParameters("url");
      }

      if(empty($product)) {
        $product = 'unknown';
      }

      if(empty($version)) {
        $version = '0.0';
      }

      if(empty($tier)) {
        $tier = 'stable';
      }

      $tier = Validation::validate_tier($tier, 'stable');

      $url_e = htmlentities($url);

      if(DEBUG) {
        header('Content-Type: text/plain');
      }

      if(KeymanHosts::Instance()->Tier() !== KeymanHosts::TIER_TEST) {
        self::report_app_download_event($product, $version, $tier);

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

    private static function report_app_download_event($product, $version, $tier) {
      global $env;
      $url = KeymanHosts::Instance()->SERVER_api_keyman_com . "/app-downloads-increment/".rawurlencode($product).
        "/".rawurlencode($version)."/".rawurlencode($tier);

      if(KeymanHosts::Instance()->Tier() !== KeymanHosts::TIER_TEST) {
        if(KeymanHosts::Instance()->Tier() === KeymanHosts::TIER_DEVELOPMENT)
          $key = 'local';
        else
          $key = $env['API_KEYMAN_COM_INCREMENT_DOWNLOAD_KEY'];

        $c = curl_init($url);
        curl_setopt($c, CURLOPT_HEADER, 0);
        curl_setopt($c, CURLOPT_POSTFIELDS, 'key='.rawurlencode($key));
        curl_setopt($c, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($c, CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
        $data = curl_exec($c);
        curl_close($c);

        if(DEBUG) {
          var_dump("app-downloads-increment ($url):",$data);
        }
      } else
        $data = TRUE;
      return $data !== FALSE;
    }
  }
