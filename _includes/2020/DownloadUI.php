<?php
  namespace Keyman\Site\com\keyman;

  require_once _KEYMANCOM_INCLUDES . '/autoload.php';
  use Keyman\Site\Common\KeymanHosts;
  use Keyman\Site\com\keyman\Locale;
  use Keyman\Site\com\keyman\Util;
  Locale::definePageScope('LOCALE_DOWNLOADS', 'downloads');

  global $versions;
  $versions = @json_decode(Util::call_downloads_keyman_com('/api/version/2.0', 'downloads.keyman.com-api_version_2.0.json'));

  class DownloadUI {
    private static function formatSizeUnits($bytes) {
      if ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
      } elseif ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
      } elseif ($bytes >= 1024) {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
      } elseif ($bytes > 1) {
        $bytes = $bytes . ' bytes';
      } elseif ($bytes == 1) {
        $bytes = $bytes . ' byte';
      } else {
        $bytes = '0 bytes';
      }

      return $bytes;
    }

    private static function filenamePatterns($target, $tier) {
      global $versions;
      switch($target) {
        case 'android':         return 'keyman-$version.apk';
        case 'android-engine':  return 'keyman-engine-android-$version.zip';
        case 'developer':       return ['keymandeveloper-$version.exe', 'kmcomp-$version.exe'];
        case 'ios':             return 'keyman-ios-$version.ipa'; // not currently used
        case 'ios-engine':      return 'keyman-engine-ios-$version.zip';
        case 'linux':           return ''; // not currently used
        case 'mac':             return ['keyman-$version.pkg','keyman-$version.dmg'];
        case 'web':             return 'keymanweb-$version.zip';
        case 'windows':         return ['keyman-$version.exe', 'keymandesktop-$version.exe'];
        default: throw new Exception("Invalid target $target");
      }
    }

    private static function productName($target) {
      switch($target) {
        case 'android':         return 'product_android';
        case 'android-engine':  return 'product_engine_android';
        case 'developer':       return 'product_developer';
        case 'ios':             return 'product_ios'; // not currently used
        case 'ios-engine':      return 'product_engine_ios';
        case 'linux':           return 'product_linux'; // not currently used
        case 'mac':             return 'product_macos'; // note mismatched platform name
        case 'web':             return 'product_keymanweb'; // note mismatched platform name
        case 'windows':         return 'product_windows';
        default: throw new Exception("Invalid target $target");
      }
    }

    private static function title($target) {
      switch($target) {
        case 'android':         return 'Keyman for Android';
        case 'android-engine':  return 'Keyman Engine for Android';
        case 'developer':       return 'Keyman Developer';
        case 'ios':             return 'Keyman for iPhone and iPad'; // not currently used
        case 'ios-engine':      return 'Keyman Engine for iPhone and iPad';
        case 'linux':           return 'Keyman for Linux'; // not currently used
        case 'mac':             return 'Keyman for mac';
        case 'web':             return 'KeymanWeb';
        case 'windows':         return 'Keyman for Windows';
        default: throw new Exception("Invalid target $target");
      }
    }


    public static function downloadSection($platform, $tiers = '', $target = '') {

      if($target == '') $target = $platform;

      echo sprintf("<h2 id='%s' class='red underline'>%s</h2>\n\n",
        $target, _m_Downloads(DownloadUI::productName($target)));
      $tiers = explode(' ',$tiers);
      foreach($tiers as $tier) {
        $filepatterns = DownloadUI::filenamePatterns($target, $tier);
        echo DownloadUI::downloadLinks($platform, $tier, $filepatterns);
      }
    }

    private static function downloadLinks($platform, $tier, $filepatterns) {
      global $versions;
      $product = DownloadUI::productName($platform);
      echo sprintf("<h3>%s</h3>\n<ul>\n", ucFirst(_m_Downloads($tier)));
      if(!empty($versions->$platform->$tier)) {
        if(!is_array($filepatterns)) $filepatterns = array($filepatterns);
        foreach($filepatterns as $filepattern) {
          $file = str_replace('$version', $versions->$platform->$tier->version, $filepattern);
          $file = str_replace('$tier', $tier, $file);

          if(!empty($versions->$platform->$tier->files->$file)) {
            $fileData = $versions->$platform->$tier->files->$file;
            $fileSize = DownloadUI::formatSizeUnits($fileData->size);
            echo sprintf("<li><a href='%s/%s/%s/%s/%s'>%s %s</a> %s</li>\n",
              KeymanHosts::Instance()->downloads_keyman_com ,
              $platform, $tier,
              $versions->$platform->$tier->version,
              $file, $file, $tier,
              _m_Downloads('released_date_size', $fileData->date, $fileSize));
          }
        }
      }
      echo sprintf("<li><a href='%s/%s/%s/'>%s</a></li>\n</ul><br/>\n",
        KeymanHosts::Instance()->downloads_keyman_com, $platform, $tier,
        _m_Downloads('all_product_releases', _m_Downloads($product), _m_Downloads($tier)));
    }

    public static function downloadLargeCTA($platform, $tier) {
      global $versions;

      if(empty($versions)) return false;

      $found = false;

      $filepatterns = DownloadUI::filenamePatterns($platform, $tier);
      $title = DownloadUI::title($platform);
      // CTA only supports the first download (which will typically be the right one?)
      if(!is_array($filepatterns)) $filepatterns = [$filepatterns];
      foreach($filepatterns as $filepattern) {
        $file = str_replace('$version', $versions->$platform->$tier->version, $filepattern);
        $file = str_replace('$tier', $tier, $file);

        if(empty($versions->$platform->$tier->files->$file)) {
          continue;
        }

        $found = true;

        $fileData = $versions->$platform->$tier->files->$file;
        $fileSize = DownloadUI::formatSizeUnits($fileData->size);
        $host = KeymanHosts::Instance()->downloads_keyman_com;
        $downloadSiteUrl = "$host/$platform/$tier/{$versions->$platform->$tier->version}/$file";
        $downloadUrl = htmlentities("/go/app/download/$platform/{$versions->$platform->$tier->version}/$tier?url=".
          rawurlencode($downloadSiteUrl));

        echo <<<END
<div class="download-cta-big selected" id="cta-big-Windows" data-url='$downloadUrl' data-version='{$versions->$platform->$tier->version}'>
    <div class="download-stable-email">
    <h3>$title {$versions->$platform->$tier->version}</h3>
    <p>Released: {$fileData->date}</p>
    <p>Size: $fileSize</p>
    </div>
    <div class="download-cta-button">
      <h4>Download Now</h4>
    </div>
    <div class="download-cta-base"></div>
</div>
END;
      }

      if(!$found) {
          echo "<p>No downloads found for $title.</p>";
        return false;
      }
    }

    public static function iosTestflightTable() {
      $testflight = 'https://itunes.apple.com/us/app/testflight/id899247664?mt=8';
      $testflight_beta_signup = 'https://testflight.apple.com/join/9W4XIoxQ';
      $testflight_alpha_signup = 'https://testflight.apple.com/join/vnCV2EiH';
      $testflightTable_cdn = cdn('img/testflight-64x64.png');
      $testflight_about = 'https://developer.apple.com/testflight/testers/';
      $testflightTable = <<<END
<table class='app-store-links'><tr><td>
  <a href="$testflight_about" target="itunes_store">Available through TestFlight</a>
  <a href="$testflight" target="itunes_store"><img id="app-store" src="{$testflightTable_cdn}" alt="TestFlight app in the App Store" /></a>
  <a href="$testflight_beta_signup">Sign up here for beta-only Keyman access.</a>
  <a href="$testflight_alpha_signup">Sign up for here alpha-only Keyman access.</a>
</td></tr></table>
END;
      return $testflightTable;
    }

  }
?>