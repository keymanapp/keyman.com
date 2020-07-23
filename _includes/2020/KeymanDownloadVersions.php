<?php
  declare(strict_types=1);

  namespace Keyman\Site\com\keyman;

  use Keyman\Site\Common\KeymanHosts;

  class KeymanDownloadVersions {
    private static $versions;

    const filenamePatterns = [
      'android' => 'keyman-(\d+\.\d+\.\d+)\.apk', // Generally, use Play Store
      'ios' => 'keyman-ios-(\d+\.\d+\.\d+)\.ipa', // Always use App Store; included for completeness but not generally used
      'mac' => 'keyman-(\d+\.\d+\.\d+)\.dmg',
      'linux' => '-', // Linux distribution is multiple archives, use a package manager
      'windows' => 'keymandesktop-(\d+\.\d+\.\d+(\.\d+)?).exe'
    ];

    static function getDownloadUrls() {
      if(empty(self::$versions))
        self::$versions = @json_decode(file_get_contents(KeymanHosts::Instance()->downloads_keyman_com . '/api/version/2.0'));
      return self::$versions;
    }

    static function getDownloadUrl($platform, $tier = 'stable') {
      $versions = self::getDownloadUrls();
      if(empty($versions->$platform->$tier)) {
        return null;
      }
      $files = $versions->$platform->$tier;
      $pattern = self::filenamePatterns[$platform];
      foreach($files->files as $name => $details) {
        //echo $name;
        if(preg_match("/^$pattern\$/", $name)) {
          return KeymanHosts::Instance()->downloads_keyman_com . "/$platform/$tier/{$files->version}/{$name}";
        }
      }
      return null;
    }
  }
