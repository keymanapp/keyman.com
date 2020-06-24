<?php
  declare(strict_types=1);

  namespace Keyman\Site\com\keyman;

  # use Keyman\Site\com\keyman\KeymanHosts;
  # use Keyman\Site\com\keyman\templates\Foot;

  class Util {
    static function Fail($message) {
      echo $message;
      //TODO: http header 500
      exit;
    }

    static function cdn($file) {
      /* TODO: setup cdn
      global $cdn;
      $use_cdn = KeymanHosts::Instance()->Tier() == KeymanHosts::TIER_PRODUCTION || (isset($_REQUEST['cdn']) && $_REQUEST['cdn'] == 'force');
      if($use_cdn) {
        if($cdn && isset($cdn['/'.$file])) {
          return "/cdn/deploy{$cdn['/'.$file]}";
        }
      }
      */
      return "/cdn/dev/{$file}";
    }
  }
