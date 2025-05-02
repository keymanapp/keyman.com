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
  }
