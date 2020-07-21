<?php
  declare(strict_types=1);

  namespace Keyman\Site\com\keyman;

  require __DIR__ . '/../_includes/autoload.php';

  use Keyman\Site\com\keyman\templates\Head;
  use Keyman\Site\com\keyman\templates\Menu;
  use Keyman\Site\com\keyman\templates\Body;
  use Keyman\Site\com\keyman\templates\Foot;
  use Keyman\Site\com\keyman\templates\AppStore;
  use Keyman\Site\com\keyman\templates\PlayStore;
  use Keyman\Site\com\keyman\KeymanDownloadVersions;
  use Keyman\Site\com\keyman\KeymanHosts;
  use Keyman\Site\com\keyman\Validation;
  use Keyman\Site\com\keyman\Util;

  KeyboardInstallPage::render_keyboard_details(
    isset($_REQUEST['id']) ? $_REQUEST['id'] : null,
    isset($_REQUEST['tier']) ? $_REQUEST['tier'] : null,
    isset($_REQUEST['bcp47']) ? $_REQUEST['bcp47'] : null
  );

  class KeyboardInstallPage
  {
    const BOOTSTRAP_SEPARATOR = '.';

    // Properties for querying api.keyman.com
    static private $id;
    static private $tier;

    // Properties to provide to apps in embedded download mode
    static private $bcp47;

    // Properties for querying keyboard downloads
    static private $keyboard;  // from api.keyman.com/keyboard
    static private $versions;  // from downloads.keyman.com/api/version
    static private $title;
    static private $error;

    /**
     * render_keyboard_details - display keyboard download boxes and details
     * @param $id - keyboard ID
     * @param string $tier - ['stable', 'alpha', or 'beta']
     * @param bool $landingPage - when true, details won't display keyboard search box or title
     * @param string $bcp47 - BCP 47 tag to pass as a hint to download links for apps to make connection
     */
    public static function render_keyboard_details($id, $tier, $bcp47) {
      self::$id = $id;
      self::$bcp47 = Validation::validate_bcp47($bcp47);
      self::$tier = Validation::validate_tier($tier, 'stable');

      self::LoadData();
      self::WriteTitle();
      self::WriteDownloadBoxes();
      Foot::render();
    }

    protected static function download_box($keymanProductName, $keymanUrl, $title, $description, $class, $linktitle, $platform, $mode='standalone') {

      if(isset(self::$keyboard->platformSupport->$platform) && self::$keyboard->platformSupport->$platform != 'none') {
        $id = self::$id;

        $e_id = urlencode($id);

        // TODO: this won't work now, needs rewrite for other platforms
        // TODO: copying the WriteWindowsBoxes function
        $url = "/keyboard/download?id=$e_id&platform=$platform&mode=$mode";
        if(!empty(self::$bcp47)) $url .= "&bcp47=".rawurlencode(self::$bcp47);
        $url = htmlspecialchars($url);
        return <<<END
        <div class='download download-$platform'>

        <ol>
          <li id='step1'><a href='$keymanUrl' title='Download and install Keyman'>Install $keymanProductName</a></li>
          <li id='step2'><a class='download-link binary-download' href='$url' onclick='return downloadBinaryFile(this);'><span>Install $title</span></a></li>
        </ol>

        </div>
END;
      } else {
        // TODO: this message not yet clear
        return "<div class='download download-platform'>Not available for $platform</div>";
      }
    }

    protected static function WriteWindowsBoxes() {
      $keyboard = self::$keyboard;
      $bcp47 = rawurlencode(empty(self::$bcp47) ? '' : self::BOOTSTRAP_SEPARATOR.self::$bcp47);
      $tier = self::$tier;
      $version = self::$versions->windows->$tier;

      $e = [
        'name' => $keyboard->name,
        'host' => KeymanHosts::Instance()->downloads_keyman_com,
        'tier' => $tier,
        'version' => $version,
        'id' => $keyboard->id,
        'bcp47' => empty(self::$bcp47) ? '' : self::$bcp47
      ];

      $u = array_map('rawurlencode', $e);
      $hu = array_map('htmlentities', $u);
      $h = array_map('htmlentities', $e);

      // Note, we don't need to capture an event for the keyboard download here, because we'll capture
      // it when the bootstrap downloads the file.

      // This maps to buildStandardWindowsDownloadUrl in install.js (which we don't use here for those
      // few users who have JS disabled -- although this is not really a tested/supported scenario)
      $downloadLink = KeymanHosts::Instance()->downloads_keyman_com .
        "/windows/{$hu['tier']}/{$hu['version']}/keyman-setup" .
        self::BOOTSTRAP_SEPARATOR . "{$hu['id']}" .
        (empty($hu['bcp47']) ? "" : "." . "{$hu['bcp47']}.exe");

      $helpLink = KeymanHosts::Instance()->help_keyman_com . "/products/desktop/current-version/docs/start_download-install_keyman";

      $keyboardHomeUrl = "/keyboards/{$hu['id']}" .
        (empty($hu['bcp47']) ? "" : "?bcp47=" . $hu['bcp47']);

      $result = <<<END
        <div class='download download-windows'>
        <p>Your {$h['name']} keyboard download should start shortly. If it does not,
          <a href='$downloadLink'>click here</a> to start the download.</p>
        <script data-host="{$h['host']}" data-tier="{$h['tier']}" data-version="{$h['version']}"
            data-id="{$h['id']}" data-bcp47="{$h['bcp47']}">
          startAfterPageLoad_Windows(document.currentScript.dataset);
        </script>
        <ul>
        <li><a href='$helpLink'>Help on installing Keyman</a></li>
        <li><a href='$keyboardHomeUrl'>{$h['name']} keyboard home</a></li>
        </ul>
        </div>
END;
      return $result;
    }

    protected static function WriteMacOSBoxes() {
      return self::download_box(
        'Keyman for macOS',
        KeymanDownloadVersions::getDownloadUrl('mac'), // note inconsistent platform name :(
        htmlentities(self::$keyboard->name) . ' for macOS',
        'Installs only ' . htmlentities(self::$keyboard->name) . '. <a href="/macosx">Keyman for Mac</a> must be installed first.',
        'download-kmp-macos',
        'Install keyboard',
        'macos');
    }

    protected static function WriteLinuxBoxes() {
      $keyboard = self::$keyboard;
      $tier = self::$tier;
      $version = self::$versions->linux->$tier;

      $e = [
        'name' => $keyboard->name,
        'host' => KeymanHosts::Instance()->downloads_keyman_com,
        'tier' => $tier,
        'version' => $version,
        'id' => $keyboard->id,
        'bcp47' => empty(self::$bcp47) ? '' : self::$bcp47,
      ];

      $u = array_map('rawurlencode', $e);
      $hu = array_map('htmlentities', $u);
      $h = array_map('htmlentities', $e);

      // Note, we don't need to capture an event for the keyboard download here, because we'll
      // capture it when the bootstrap downloads the file.

      $downloadLink = KeymanHosts::Instance()->keyman_com . "/go/package/download/{$hu['id']}?" .
        "platform=linux&version={$hu['version']}&tier={$hu['tier']}" .
        (empty($hu['bcp47']) ? "" : "&bcp47={$hu['bcp47']}");

      $helpLink = KeymanHosts::Instance()->help_keyman_com . "/products/linux/current-version/guide/installing-keyboard";

      $keyboardHomeUrl = "/keyboards/{$hu['id']}" .
        (empty($hu['bcp47']) ? "" : "?bcp47=" . $hu['bcp47']);

      $result = <<<END
        <div id='content' class='download download-linux'>
          <p>Your {$h['name']} keyboard download should start shortly. If it does not,
            <a href='$downloadLink'>click here</a> to start the download.</p>
          <script data-host="{$h['host']}" data-tier="{$h['tier']}" data-version="{$h['version']}"
              data-id="{$h['id']}" data-bcp47="{$h['bcp47']}" data-name="{$h['name']}">
            startAfterPageLoad_Linux(document.currentScript.dataset);
          </script>
          <ul>
            <li><a href='$helpLink'>Help on installing Keyman</a></li>
            <li><a href='$keyboardHomeUrl'>{$h['name']} keyboard home</a></li>
          </ul>
        </div>
END;
      return $result;
    }

    protected static function WriteAndroidBoxes() {
      return self::download_box(
        'Keyman for Android',
        PlayStore::url,
        htmlentities(self::$keyboard->name) . ' for Android',
        'Installs only ' . htmlentities(self::$keyboard->name) . '. <a href="'.PlayStore::url.'">Keyman for Android</a> must be installed first.',
        'download-android',
        'Install on Android',
        'android');
    }

    protected static function WriteiPhoneBoxes() {
      return self::download_box(
        'Keyman for iPhone',
        AppStore::url,
        htmlentities(self::$keyboard->name) . ' for iPhone',
        'Installs only ' . htmlentities(self::$keyboard->name) . '. <a href="'.AppStore::url.'">Keyman for iPhone</a> must be installed first.',
        'download-ios',
        'Install on iPhone',
        'ios');
    }

    protected static function WriteiPadBoxes() {
      return self::download_box(
        'Keyman for iPad',
        AppStore::url,
        htmlentities(self::$keyboard->name) . ' for iPad',
        'Installs only ' . htmlentities(self::$keyboard->name) . '. <a href="'.AppStore::url.'">Keyman for iPad</a> must be installed first.',
        'download-ios',
        'Install on iPad',
        'ios');
    }

    protected static function LoadData() {
      self::$error = "";

      // Get Keyboard Metadata

      $s = @file_get_contents(KeymanHosts::Instance()->api_keyman_com . '/keyboard/' . rawurlencode(self::$id));
      if ($s === FALSE) {
        // Will fail later in the script
        self::$error .= error_get_last()['message'] . "\n";
        self::$title = 'Failed to load keyboard ' . self::$id;
        header('HTTP/1.0 404 Keyboard not found');
      } else {
        $s = json_decode($s);
        if(is_object($s)) {
          self::$keyboard = $s;
          self::$title = htmlentities(self::$keyboard->name);
          if (!preg_match('/keyboard$/i', self::$title)) self::$title .= ' keyboard';
        } else {
          self::$error .= "Error returned from ".KeymanHosts::Instance()->api_keyman_com.": $s\n";
          self::$title = 'Failed to load keyboard ' . self::$id;
          header('HTTP/1.0 500 Internal Server Error');
        }
      }

      // Get Program Download Versions and URLs

      $s = @file_get_contents(KeymanHosts::Instance()->downloads_keyman_com . '/api/version/1.0');
      if ($s === FALSE) {
        // Will fail later in the script
        self::$error .= error_get_last()['message'] . "\n";
        if (empty(self::$title)) {
          self::$title = 'Failed to get product version information';
          header('HTTP/1.0 404 product version information not found');
        }
      } else {
        self::$versions = json_decode($s);
      }
    }

    protected static function WriteTitle() {
      $head_options = [
        'title' => self::$title,
        'js' => [Util::cdn('keyboard-search/keyboard-details.js'), Util::cdn('keyboard-search/install.js')],
        'css' => [Util::cdn('css/template.css'), Util::cdn('keyboard-search/search.css'), Util::cdn('keyboard-search/install.css')]
      ];
      Head::render($head_options);
      Menu::render([]); // we'll be doing client-side os detection now
      Body::render();

      if (!isset(self::$keyboard)) {
        // If parameters are missing ...
?>
          <h1 class='red underline'><?= htmlentities(self::$id); ?></h1>
          <p>Keyboard <?= htmlentities(self::$id); ?> not found.</p>
<?php
        // DEBUG: Only display errors on local sites
        if(KeymanHosts::Instance()->Tier() == KeymanHosts::TIER_DEVELOPMENT && (ini_get('display_errors') !== '0')) {
          echo "<p>" . self::$error . "</p>";
        }
        exit;
      }

?>
        <h1 class='red underline'><?= self::$title ?></h1>
<?php
    }

    protected static function WriteDownloadBoxes() {
      global $pageDevice;

      $deviceboxfuncs = array(
        "Windows" => "self::WriteWindowsBoxes",
        "mac" => "self::WritemacOSBoxes",
        "Linux" => "self::WriteLinuxBoxes",
        "iPhone" => "self::WriteiPhoneBoxes",
        "iPad" => "self::WriteiPadBoxes",
        "Android" => "self::WriteAndroidBoxes"
      );

      foreach($deviceboxfuncs as $device => $func) {
        echo call_user_func($func);
      }

      //?echo "</div>";
    }
  }
