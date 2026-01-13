<?php
  declare(strict_types=1);

  namespace Keyman\Site\com\keyman;

  require __DIR__ . '/../_includes/autoload.php';
  require_once('./session.php');

  use Keyman\Site\com\keyman\templates\Head;
  use Keyman\Site\com\keyman\templates\Menu;
  use Keyman\Site\com\keyman\templates\Body;
  use Keyman\Site\com\keyman\templates\Foot;
  use Keyman\Site\com\keyman\templates\AppStore;
  use Keyman\Site\com\keyman\templates\PlayStore;
  use Keyman\Site\Common\KeymanHosts;
  use Keyman\Site\Common\KeymanVersion;
  use Keyman\Site\com\keyman\Validation;
  use Keyman\Site\com\keyman\Util;
  use Keyman\Site\com\keyman\Locale;

  Locale::definePageLocale('LOCALE_KEYBOARDS_INSTALL', 'keyboards/install');
  $_m = function($id, ...$args) {
    return Locale::m(LOCALE_KEYBOARDS_INSTALL, $id, ...$args);
  };
  function _m($id, ...$args) {
    return Locale::m(LOCALE_KEYBOARDS_INSTALL, $id, ...$args);
  }

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

  if(!isset($_REQUEST['id'])) {
    // install without a keyboard id doesn't make sense,
    // so redirect to the keyboard search
    header('Location: /keyboards');
    exit;
  }

  KeyboardInstallPage::render_keyboard_details(
    $_REQUEST['id'],
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
      global $_m;

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
      $downloadServerLink = KeymanHosts::Instance()->downloads_keyman_com .
        "/windows/{$hu['tier']}/{$hu['version']}/keyman-setup" .
        self::BOOTSTRAP_SEPARATOR . "{$hu['id']}" .
        (empty($hu['bcp47']) ? "" : ".{$hu['bcp47']}") .
        ".exe";
      $downloadLink = "/go/app/download/windows/{$hu['version']}/{$hu['tier']}?url=".rawurlencode($downloadServerLink);

      $helpLink = KeymanHosts::Instance()->help_keyman_com . "/products/windows/current-version/start/download-and-install-keyman";

      $keyboardHomeUrl = "/keyboards/{$hu['id']}" .
        (empty($hu['bcp47']) ? "" : "?bcp47=" . $hu['bcp47']);

      $result = <<<END
        <div class='download download-windows'>
        <p> {$_m('download_start_shortly', $h['name'])} </p>
        <div class='download download-windows'><a class='download-link binary-download' href='$downloadLink'><span>{$_m('download_keyboard')}</span></a></div>
        <script data-host="{$h['host']}" data-tier="{$h['tier']}" data-version="{$h['version']}"
            data-id="{$h['id']}" data-bcp47="{$h['bcp47']}">
          startAfterPageLoad_Windows(document.currentScript.dataset);
        </script>
        <ul>
        <li><a href='$helpLink'>{$_m('help_on_installing_keyman')}</a></li>
        <li><a href='$keyboardHomeUrl'>{$_m('download_keyboard')}</a></li>
        </ul>
        </div>
END;
      return $result;
    }

    protected static function WritemacOSBoxes() {
      global $_m;

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
        <div class='download download-macos'>
          <div>
            <p>{$_m('platform_not_installed', 'Keyman for macOS')}</p>
            <ol>
              <li id='step1'><a href='$downloadKeymanUrl' title='{$_m('download_keyman_title')}'>{$_m('install_keyman', 'Keyman for macOS')}</a></li>
              <li id='step2'><a class='download-link binary-download' rel="nofollow" href='$downloadLink'>
                <span>{$_m('install_keyboard')}</span></a>
                <div class='download-description'>{$_m('downloads_keyboard_for_platform', $h['name'], 'macOS')}</div>
              </li>
            </ol>
            <ul>
              <li><a href='$helpLink'>{$_m('help_on_installing_keyboard')}</a></li>
              <li><a href='$keyboardHomeUrl'>{$_m('keyboard_home', $h['name'])}</a></li>
            </ul>
          </div>
        </div>
END;
      return $result;
    }

    protected static function WriteLinuxBoxes() {
      global $_m;

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

      $helpLink = KeymanHosts::Instance()->help_keyman_com . "/products/linux/current-version/start/installing-keyboard";

      $keyboardHomeUrl = "/keyboards/{$hu['id']}" .
        (empty($hu['bcp47']) ? "" : "?bcp47=" . $hu['bcp47']);

      $downloadKeymanUrl = KeymanHosts::Instance()->keyman_com . '/linux/download';

      $result = <<<END
        <div class='download download-linux'>
          <script data-id="{$h['id']}" data-bcp47="{$h['bcp47']}">
            startAfterPageLoad_Linux(document.currentScript.dataset);
          </script>
          <div>
            <p>{$_m('platform_not_installed', 'Keyman for Linux')}</p>
            <ol>
              <li id='step1'><a href='$downloadKeymanUrl' title='{$_m('download_keyman_title')}'>{$_m('install_keyman', 'Keyman for Linux')}</a></li>
              <li id='step2'><a class='download-link binary-download' rel="nofollow" href='$downloadLink'>
                <span>{$_m('install_keyboard')}</span></a>
                <div class='download-description'>{$_m('downloads_keyboard_for_platform', $h['name'], 'Linux')}</div>
              </li>
            </ol>

            <br>
            <ul>
              <li><a href='$helpLink'>{$_m('help_on_installing_keyboard')}</a></li>
              <li><a href='$keyboardHomeUrl'>{$_m('keyboard_home', $h['name'])}</a></li>
            </ul>
          </div>
        </div>
END;
      return $result;
    }

    protected static function WriteAndroidBoxes() {
      global $_m;

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

      // Build a Google Play Install Referrer URL parameter; this will be passed
      // in to Keyman on its first start. Note that the double-encoding is intentional.
      $referrer = "source=keyman&package={$u['id']}";
      if(!empty($u['bcp47'])) $referrer .= "&bcp47={$u['bcp47']}";

      $downloadKeymanUrl = PlayStore::url . "&referrer=" . rawurlencode($referrer);

      $result = <<<END
        <div class='download download-android'>
          <p></p>
          <div>
            <p>{$_m('with_play_store', $h['name'])}</p>
            <a class='download-link binary-download' href='$downloadKeymanUrl' title='{$_m('download_keyman_title')}'><span>{$_m('install_from_play_store')}</span></a>
            <div class='download-description'>{$_m('keyman_and_keyboard_for_platform', $h['name'], 'Android')}</div>
            <br>
            <p>{$_m('already_installed')} <a rel="nofollow" href='$downloadLink'>{$_m('download_just_keyboard')}</a> {$_m('and_then_install_in_the_app')}</p>
            <ul>
              <li><a href='$helpLink'>{$_m('help_on_installing_keyboard')}</a></li>
              <li><a href='$keyboardHomeUrl'>{$_m('keyboard_home', $h['name'])}</a></li>
            </ul>
          </div>
        </div>
END;
      return $result;
    }

    protected static function WriteiOSBoxes() {
      global $_m;

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

      $helpLink = KeymanHosts::Instance()->help_keyman_com . "/products/iphone-and-ipad/current-version/start/searching-for-keyboards";

      $keyboardHomeUrl = "/keyboards/{$hu['id']}" .
        (empty($hu['bcp47']) ? "" : "?bcp47=" . $hu['bcp47']);

      $downloadKeymanUrl = AppStore::url;

      $result = <<<END
        <div class='download download-ios'>
          <div>
            <p>{$_m('platform_not_installed', 'Keyman for iPhone and iPad')}</p>
            <ol>
              <li id='step1'><a href='$downloadKeymanUrl' title='{$_m('download_keyman_title')}'>{$_m('install_keyman', 'Keyman for iPhone and iPad')}</a></li>
              <li id='step2'><a class='download-link binary-download' rel="nofollow" href='$downloadLink'>
                <span>{$_m('install_keyboard')}</span></a>
                <div class='download-description'>{$_m('downloads_keyboard_for_platform', $h['name'], 'iPhone and iPad')}</div>
              </li>
            </ol>
            <ul>
              <li><a href='$helpLink'>{$_m('help_on_installing_keyboard')}</a></li>
              <li><a href='$keyboardHomeUrl'>{$_m('keyboard_home', $h['name'])}</a></li>
            </ul>
          </div>
        </div>
END;
      return $result;
    }

    protected static function LoadData() {
      self::$error = "";

      // Get Keyboard Metadata

      $s = @file_get_contents(KeymanHosts::Instance()->SERVER_api_keyman_com . '/keyboard/' . rawurlencode(self::$id));
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

      $s = @file_get_contents(KeymanHosts::Instance()->SERVER_downloads_keyman_com . '/api/version/1.0');
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
          <p><?= $_m('keyboard_not_found', htmlentities(self::$id)) ?></p>
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
