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
  use Keyman\Site\Common\KeymanHosts;
  use Keyman\Site\com\keyman\Validation;
  use Keyman\Site\com\keyman\Util;

  // Bundled downloads will make use of Keyman tier, which the site visitor
  // can override with tier=[alpha|beta|stable]. If no override has been
  // made, then we make a determination on the basis of which site is in use
  // and whether not we are currently in a beta phase.
  if(isset($_REQUEST['tier']))
    $tier = $_REQUEST['tier'];
  else {
    if(KeymanHosts::Instance()->Tier() == KeymanHosts::TIER_PRODUCTION) {
      $tier = 'stable';
    } else if(KeymanVersion::IsBetaTier()) {
      // if we are in a beta phase, then we'll use the beta download
      $tier = 'beta';
    } else {
      $tier = 'alpha';
    }
  }

  KeyboardInstallPage::render_keyboard_details(
    isset($_REQUEST['id']) ? $_REQUEST['id'] : null,
    $tier,
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

      echo self::WriteWindowsBoxes();
      echo self::WritemacOSBoxes();
      echo self::WriteLinuxBoxes();
      echo self::WriteAndroidBoxes();
      echo self::WriteiOSBoxes();

      Foot::render();
    }

    protected static function WriteWindowsBoxes() {
      $keyboard = self::$keyboard;
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
        (empty($hu['bcp47']) ? "" : ".{$hu['bcp47']}") .
        ".exe";

      $helpLink = KeymanHosts::Instance()->help_keyman_com . "/products/windows/current-version/docs/start_download-install_keyman";

      $keyboardHomeUrl = "/keyboards/{$hu['id']}" .
        (empty($hu['bcp47']) ? "" : "?bcp47=" . $hu['bcp47']);

      $result = <<<END
        <div class='download download-windows'>
        <p>Your {$h['name']} keyboard download should start shortly. If it does not,
        click the button below to start the download.</p>
        <div class='download download-windows'><a class='download-link binary-download' href='$downloadLink'><span>Download keyboard</span></a></div>
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

    protected static function WritemacOSBoxes() {
      $keyboard = self::$keyboard;
      $tier = self::$tier;

      $e = [
        'name' => $keyboard->name,
        'host' => KeymanHosts::Instance()->downloads_keyman_com,
        'tier' => $tier,
        'keyboardversion' => $keyboard->version,
        'id' => $keyboard->id,
        'bcp47' => empty(self::$bcp47) ? '' : self::$bcp47,
      ];

      $u = array_map('rawurlencode', $e);
      $hu = array_map('htmlentities', $u);
      $h = array_map('htmlentities', $e);

      // Note, we don't need to capture an event for the keyboard download here, because we'll
      // capture it in the /go/package/download step

      $downloadLink = KeymanHosts::Instance()->keyman_com . "/go/package/download/{$hu['id']}" .
        "?platform=macos&amp;version={$hu['keyboardversion']}&amp;tier={$hu['tier']}" .
        (empty($hu['bcp47']) ? "" : "&amp;bcp47={$hu['bcp47']}");

      $helpLink = KeymanHosts::Instance()->help_keyman_com . "/products/mac/current-version/start/install-keyboard";

      $keyboardHomeUrl = "/keyboards/{$hu['id']}" .
        (empty($hu['bcp47']) ? "" : "?bcp47=" . $hu['bcp47']);

      $downloadKeymanUrl = KeymanHosts::Instance()->keyman_com . '/mac/download';

      $result = <<<END
        <div id='content' class='download download-macos'>
          <div>
            <p>If you have not yet installed Keyman for macOS, please install it first before installing the keyboard.</p>
            <ol>
              <li id='step1'><a href='$downloadKeymanUrl' title='Download and install Keyman'>Install Keyman for macOS</a></li>
              <li id='step2'><a class='download-link binary-download' rel="nofollow" href='$downloadLink'>
                <span>Install keyboard</span></a>
                <div class='download-description'>Downloads {$h['name']} for macOS.</div>
              </li>
            </ol>
            <ul>
              <li><a href='$helpLink'>Help on installing a keyboard</a></li>
              <li><a href='$keyboardHomeUrl'>{$h['name']} keyboard home</a></li>
            </ul>
          </div>
        </div>
END;
      return $result;
    }

    protected static function WriteLinuxBoxes() {
      $keyboard = self::$keyboard;
      $tier = self::$tier;

      $e = [
        'name' => $keyboard->name,
        'host' => KeymanHosts::Instance()->downloads_keyman_com,
        'tier' => $tier,
        'keyboardversion' => $keyboard->version,
        'id' => $keyboard->id,
        'bcp47' => empty(self::$bcp47) ? '' : self::$bcp47,
      ];

      $u = array_map('rawurlencode', $e);
      $hu = array_map('htmlentities', $u);
      $h = array_map('htmlentities', $e);

      // Note, we don't need to capture an event for the keyboard download here, because we'll
      // capture it when the bootstrap downloads the file.

      $downloadLink = KeymanHosts::Instance()->keyman_com . "/go/package/download/{$hu['id']}" .
        "?platform=linux&amp;version={$hu['keyboardversion']}&amp;tier={$hu['tier']}" .
        (empty($hu['bcp47']) ? "" : "&amp;bcp47={$hu['bcp47']}");

      $helpLink = KeymanHosts::Instance()->help_keyman_com . "/products/linux/current-version/guide/installing-keyboard";

      $keyboardHomeUrl = "/keyboards/{$hu['id']}" .
        (empty($hu['bcp47']) ? "" : "?bcp47=" . $hu['bcp47']);

      $downloadKeymanUrl = KeymanHosts::Instance()->keyman_com . '/linux/download';

      $result = <<<END
        <div id='content' class='download download-linux'>
          <script data-id="{$h['id']}" data-bcp47="{$h['bcp47']}">
            startAfterPageLoad_Linux(document.currentScript.dataset);
          </script>
          <div>
            <p>If you have not yet installed Keyman for Linux, please install it first before installing the keyboard.</p>
            <ol>
              <li id='step1'><a href='$downloadKeymanUrl' title='Download and install Keyman'>Install Keyman for Linux</a></li>
              <li id='step2'><a class='download-link binary-download' rel="nofollow" href='$downloadLink'>
                <span>Install keyboard</span></a>
              </li>
            </ol>
          </div>
          <br>
          <ul>
            <li><a href='$helpLink'>Help on installing a keyboard</a></li>
            <li><a href='$keyboardHomeUrl'>{$h['name']} keyboard home</a></li>
          </ul>
          </div>
        </div>
END;
      return $result;
    }

    protected static function WriteAndroidBoxes() {
      $keyboard = self::$keyboard;
      $tier = self::$tier;

      $e = [
        'name' => $keyboard->name,
        'host' => KeymanHosts::Instance()->downloads_keyman_com,
        'tier' => $tier,
        'version' => $keyboard->version,
        'id' => $keyboard->id,
        'bcp47' => empty(self::$bcp47) ? '' : self::$bcp47,
      ];

      $u = array_map('rawurlencode', $e);
      $hu = array_map('htmlentities', $u);
      $h = array_map('htmlentities', $e);

      // Note, we don't need to capture an event for the keyboard download here, because we'll
      // capture it in the /go/package/download step

      $downloadLink = KeymanHosts::Instance()->keyman_com . "/go/package/download/{$hu['id']}" .
        "?platform=android&amp;version={$hu['version']}&amp;tier={$hu['tier']}" .
        (empty($hu['bcp47']) ? "" : "&amp;bcp47={$hu['bcp47']}");

      $helpLink = KeymanHosts::Instance()->help_keyman_com . "/products/android/current-version/start/installing-keyboards";

      $keyboardHomeUrl = "/keyboards/{$hu['id']}" .
        (empty($hu['bcp47']) ? "" : "?bcp47=" . $hu['bcp47']);

      $downloadKeymanUrl = PlayStore::url;

      $result = <<<END
        <div id='content' class='download download-android'>
          <div>
            <p>If you have not yet installed Keyman for Android, please install it first before installing the keyboard.</p>
            <ol>
              <li id='step1'><a href='$downloadKeymanUrl' title='Download and install Keyman'>Install Keyman for Android</a></li>
              <li id='step2'><a class='download-link binary-download' rel="nofollow" href='$downloadLink'>
                <span>Install keyboard</span></a>
                <div class='download-description'>Downloads {$h['name']} for Android.</div>
              </li>
            </ol>
            <ul>
              <li><a href='$helpLink'>Help on installing a keyboard</a></li>
              <li><a href='$keyboardHomeUrl'>{$h['name']} keyboard home</a></li>
            </ul>
          </div>
        </div>
END;
      return $result;
    }

    protected static function WriteiOSBoxes() {

      $keyboard = self::$keyboard;
      $tier = self::$tier;

      $e = [
        'name' => $keyboard->name,
        'host' => KeymanHosts::Instance()->downloads_keyman_com,
        'tier' => $tier,
        'keyboardversion' => $keyboard->version,
        'id' => $keyboard->id,
        'bcp47' => empty(self::$bcp47) ? '' : self::$bcp47,
      ];

      $u = array_map('rawurlencode', $e);
      $hu = array_map('htmlentities', $u);
      $h = array_map('htmlentities', $e);

      // Note, we don't need to capture an event for the keyboard download here, because we'll
      // capture it in the /go/package/download step

      $downloadLink = KeymanHosts::Instance()->keyman_com . "/go/package/download/{$hu['id']}" .
        "?platform=ios&amp;version={$hu['keyboardversion']}&amp;tier={$hu['tier']}" .
        (empty($hu['bcp47']) ? "" : "&amp;bcp47={$hu['bcp47']}");

      $helpLink = KeymanHosts::Instance()->help_keyman_com . "/products/iphone-and-ipad/current-version/start/installing-keyboards";

      $keyboardHomeUrl = "/keyboards/{$hu['id']}" .
        (empty($hu['bcp47']) ? "" : "?bcp47=" . $hu['bcp47']);

      $downloadKeymanUrl = AppStore::url;

      $result = <<<END
        <div id='content' class='download download-ios'>
          <div>
            <p>If you have not yet installed Keyman for iPhone and iPad, please install it first before installing the keyboard.</p>
            <ol>
              <li id='step1'><a href='$downloadKeymanUrl' title='Download and install Keyman'>Install Keyman for iPhone and iPad</a></li>
              <li id='step2'><a class='download-link binary-download' rel="nofollow" href='$downloadLink'>
                <span>Install keyboard</span></a>
                <div class='download-description'>Downloads {$h['name']} for iPhone and iPad.</div>
              </li>
            </ol>
            <ul>
              <li><a href='$helpLink'>Help on installing a keyboard</a></li>
              <li><a href='$keyboardHomeUrl'>{$h['name']} keyboard home</a></li>
            </ul>
          </div>
        </div>
END;
      return $result;
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
  }
