<?php
  namespace UI;

  require_once('includes/template.php');
  require_once('includes/playstore.php');
  require_once('includes/appstore.php');
  require_once('includes/KeymanHosts.php');

  use \DateTime;
use KeymanHosts;

define('GITHUB_ROOT', 'https://github.com/keymanapp/keyboards/tree/master/');
  define('DOCUMENTATION_ROOT', 'https://help.keyman.com/keyboard/');

  class KeyboardDetails
  {
    // Property for landing pages not to display keyboard searchbox and title
    static private $landingPage;

    // Properties for querying api.keyman.com
    static private $id;
    static private $tier;

    // Properties to provide to apps in embedded download mode
    static private $tag;

    // Properties for querying keyboard downloads
    static private $keyboard;
    static private $downloads;
    static private $title;
    static private $error;

    // Additional properties for keyboard details
    static private $description;
    static private $authorName;
    static private $license;
    static private $keyboardLastModifiedDate;
    static private $keyboardEncoding;
    static private $minVersion;
    static private $keyboardPlatforms;

    static private $deprecatedBy;

    private static function WriteLinkAnnotator() {
      echo '<script>
        var binaryFileClientId = null;
        function downloadBinaryFile(a) {
          if(!a.href.match(/cid=/) && binaryFileClientId) {
            a.href = a.href + "&cid="+binaryFileClientId;
          }
          //alert(a.href);
          return true;
        }

        try {
          if(ga) ga(function(tracker) {
            binaryFileClientId = tracker.get("clientId");
          });
        } catch(error) {
        }
      </script>';
    }

    /**
     * render_keyboard_details - display keyboard download boxes and details
     * @param $id - keyboard ID
     * @param string $tier - ['stable', 'alpha', or 'beta']
     * @param bool $landingPage - when true, details won't display keyboard search box or title
     * @param string $tag - BCP 47 tag to pass as a hint to download links for apps to make connection
     */
    public static function render_keyboard_details($id, $tier = 'stable', $landingPage = false, $tag = null) {
      self::$id = $id;
      self::$tag = $tag;
      self::$tier = self::get_tier_from_request($tier);
      self::$landingPage = $landingPage;

      self::LoadData();
      self::WriteTitle();
      self::WriteDownloadBoxes();
      self::WriteKeyboardDetails();
      if(!empty(self::$deprecatedBy)) echo "</div></div>";
      self::WriteLinkAnnotator();
    }

    /**
     * get_tier_from_request - checks provided $tier or $_REQUEST['tier'] and determines
     *                         if the tier is 'stable', 'alpha', or 'beta'.
     *                         Default to 'stable'
     * @param string $tier - ['stable', 'alpha', or 'beta']
     * @return string
     */
    public static function get_tier_from_request($tier = 'stable') {
      if (isset($_REQUEST['tier'])) {
        $t = $_REQUEST['tier'];
        if (in_array($t, array('alpha', 'beta', 'stable'))) {
          $tier = $t;
        }
      }
      return $tier;
    }

    protected static function map_license($s) {
      $license_map = ['mit' => 'MIT'];
      return array_key_exists($s, $license_map) ? $license_map[$s] : $s;
    }

    protected static function download_box($url, $title, $description, $class, $linktitle, $platform, $mode='standalone') {
      $urlbits = explode('/', $url);
      $filename = array_pop($urlbits);
      $id = self::$id;
      global $embed;

      $e_filename = urlencode($filename);
      $e_id = urlencode($id);

      if($embed != 'none') {
        // note: if embed != none, mode should was be standalone
        $url = "keyman:download?filename=$e_filename&url=".urlencode("https://keyman.com/keyboard/download?id=$e_id&platform=$platform&mode=$mode");
        if(!empty(self::$tag)) $url .= "&tag=".urlencode(self::$tag);
      } else {
        $url = "/keyboard/download?id=$e_id&platform=$platform&mode=$mode";
      }
      $url = htmlspecialchars($url);
      $downloadlink = "<a class='download-link binary-download' href='$url' onclick='return downloadBinaryFile(this);'><span>$linktitle</span></a>";
      return <<<END
      <div class='download $class'>
        $downloadlink
        <div class='download-title'>$title</div>
        <div class='download-description'>$description</div>
        <div class='download-filename'>$filename</div>
      </div>
END;
    }

    protected static function onlinelink_box($id, $url, $title, $description, $class = '') {
      global $embed_target;
      return <<<END
      <div class='download download-web $class'>
        <a class='download-link' $embed_target href='$url'>Use keyboard online</a>
        <div class='download-title'>$title</div>
        <div class='download-description'>$description</div>
        <div class='download-filename'>$id</div>
      </div>
END;
    }

    protected static function embed_path($kmp) {
      global $embed;
      if ($embed == 'none') {
        return $kmp;
      }
      return 'keyman:download?filename=' . basename($kmp) . '&amp;url=' . $kmp;
    }

    protected static function WriteWindowsBoxes() {
      global $embed_win;
      $result = '';
      if (!$embed_win && isset(self::$downloads->windows) && isset(self::$keyboard->platformSupport->windows) && self::$keyboard->platformSupport->windows != 'none') {
        $result = self::download_box(
          self::$downloads->windows,
          htmlentities(self::$keyboard->name) . ' + Keyman Desktop',
          'Keyman Desktop and ' . htmlentities(self::$keyboard->name) . ' in a single installer.',
          'download-windows',
          'Install on Windows',
          'windows', 'bundle');
      }

      if (isset(self::$downloads->kmp)) {
        if (isset(self::$keyboard->platformSupport->windows) && self::$keyboard->platformSupport->windows != 'none') {
          $result .= self::download_box(
            self::embed_path(self::$downloads->kmp),
            htmlentities(self::$keyboard->name) . ' for Windows',
            $embed_win ?
              'Install ' . htmlentities(self::$keyboard->name) :
              'Installs only ' . htmlentities(self::$keyboard->name) . '. <a href="/desktop/download#standalone">Keyman Desktop</a> for Windows must be installed first.',
            'download-kmp-windows',
            $embed_win ? 'Install keyboard' : 'Windows download',
            'windows');
        }
      }

      return $result === '' ? FALSE : $result;
    }

    protected static function WriteMacOSBoxes() {
      global $embed_mac;
      if (isset(self::$downloads->kmp)) {
        if (isset(self::$keyboard->platformSupport->macos) && self::$keyboard->platformSupport->macos != 'none') {
          return self::download_box(
            self::embed_path(self::$downloads->kmp),
            htmlentities(self::$keyboard->name) . ' for macOS',
            $embed_mac ?
              'Install ' . htmlentities(self::$keyboard->name) :
              'Installs only ' . htmlentities(self::$keyboard->name) . '. <a href="/macosx">Keyman for Mac</a> must be installed first.',
            'download-kmp-macos',
            $embed_mac ? 'Install keyboard' : 'macOS download',
            'macos');
        }
      }
      return FALSE;
    }

    protected static function WriteLinuxBoxes() {
      global $embed_linux;
      if (isset(self::$downloads->kmp)) {
        if (isset(self::$keyboard->platformSupport->linux) && self::$keyboard->platformSupport->linux != 'none') {
          return self::download_box(
            self::embed_path(self::$downloads->kmp),
            htmlentities(self::$keyboard->name) . ' for Linux',
            $embed_linux ?
              'Install ' . htmlentities(self::$keyboard->name) :
              'Installs only ' . htmlentities(self::$keyboard->name) . '. Keyman for Linux must be installed first.',
            'download-kmp-linux',
            $embed_linux ? 'Install keyboard' : 'Linux download',
            'linux');
        }
      }
      return FALSE;
    }

    protected static function WriteWebBoxes() {
      global $KeymanHosts;
      if (isset(self::$downloads->js)) {
        if (isset(self::$keyboard->platformSupport->desktopWeb) && self::$keyboard->platformSupport->desktopWeb != 'none') {
          if (isset(self::$keyboard->languages)) {
            if (is_array(self::$keyboard->languages)) {
              if (count(self::$keyboard->languages) > 0) {
                $lang = self::$keyboard->languages[0];
              }
            } else {
              $langs = array_keys(get_object_vars(self::$keyboard->languages));
              if (count($langs) > 0) {
                $lang = $langs[0];
              }
            }
          }
          if (!isset($lang)) $lang = 'en';
          $url = "{$KeymanHosts->keymanweb_com}/#$lang,Keyboard_" . self::$keyboard->id;
          return self::onlinelink_box(
            self::$id,
            $url,
            'Use ' . htmlentities(self::$keyboard->name) . ' online',
            'Use ' . htmlentities(self::$keyboard->name) . ' in your web browser. No need to install anything.');
        }
      }
      return FALSE;
    }

    protected static function WriteAndroidBoxes() {
      global $playstore;
      if (isset(self::$downloads->kmp)) {
        if (isset(self::$keyboard->platformSupport->android) && self::$keyboard->platformSupport->android != 'none') {
          return self::download_box(
            self::embed_path(self::$downloads->kmp),
            htmlentities(self::$keyboard->name) . ' for Android',
            'Installs only ' . htmlentities(self::$keyboard->name) . '. <a href="'.$playstore.'">Keyman for Android</a> must be installed first.',
            'download-android',
            'Install on Android',
            'android');
        }
      }
      return FALSE;
    }

    protected static function WriteiPhoneBoxes() {
      global $appstore;
      if (isset(self::$downloads->kmp)) {
        if (isset(self::$keyboard->platformSupport->ios) && self::$keyboard->platformSupport->ios != 'none') {
          return self::download_box(
            self::embed_path(self::$downloads->kmp),
            htmlentities(self::$keyboard->name) . ' for iPhone',
            'Installs only ' . htmlentities(self::$keyboard->name) . '. <a href="'.$appstore.'">Keyman for iPhone</a> must be installed first.',
            'download-ios',
            'Install on iPhone',
            'ios');
        }
      }

      return FALSE;
    }

    protected static function WriteiPadBoxes() {
      global $appstore;
      if (isset(self::$downloads->kmp)) {
        if (isset(self::$keyboard->platformSupport->ios) && self::$keyboard->platformSupport->ios != 'none') {
          return self::download_box(
            self::embed_path(self::$downloads->kmp),
            htmlentities(self::$keyboard->name) . ' for iPad',
            'Installs only ' . htmlentities(self::$keyboard->name) . '. <a href="'.$appstore.'">Keyman for iPad</a> must be installed first.',
            'download-ios',
            'Install on iPad',
            'ios');
        }
      }

      return FALSE;
    }

    protected static function LoadData() {
      global $KeymanHosts, $stable_version;

      self::$error = "";
      $s = @file_get_contents($KeymanHosts->api_keyman_com . '/keyboard/' . rawurlencode(self::$id));
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
          self::$description = isset(self::$keyboard->description) ? self::$keyboard->description : '';
          self::$authorName = isset(self::$keyboard->authorName) ? self::$keyboard->authorName : '';
          self::$minVersion = isset(self::$keyboard->minKeymanVersion) ? self::$keyboard->minKeymanVersion : $stable_version;
          self::$license = self::map_license(isset(self::$keyboard->license) ? self::$keyboard->license : 'Unknown');
        } else {
          self::$error .= "Error returned from {$KeymanHosts->api_keyman_com}: $s\n";
          self::$title = 'Failed to load keyboard ' . self::$id;
          header('HTTP/1.0 500 Internal Server Error');
        }
      }

      $s = @file_get_contents($KeymanHosts->downloads_keyman_com . '/api/keyboard/1.0/' . rawurlencode(self::$id) . '?tier=' . self::$tier);
      if ($s === FALSE) {
        // Will fail later in the script
        self::$error .= error_get_last()['message'] . "\n";
        if (empty(self::$title)) {
          self::$title = 'Failed to get downloads for keyboard ' . self::$id;
          header('HTTP/1.0 404 Keyboard downloads not found');
        }
      } else {
        self::$downloads = json_decode($s);
      }

      if(!empty(self::$keyboard)) {
        if (in_array('unicode', self::$keyboard->encodings) && in_array('ansi', self::$keyboard->encodings))
          self::$keyboardEncoding = 'Unicode, Legacy (ANSI)';
        else if (in_array('unicode', self::$keyboard->encodings))
          self::$keyboardEncoding = 'Unicode';
        else // ansi
          self::$keyboardEncoding = 'Legacy (ANSI)';

        $date = new DateTime(self::$keyboard->lastModifiedDate);
        self::$keyboardLastModifiedDate = $date->format('Y-m-d H:i');

        $platformTitles = array('windows' => 'Windows', 'macos' => 'macOS', 'linux' => 'Linux', 'android' => 'Android', 'ios' => 'iPhone and iPad', 'desktopWeb' => 'Web', 'mobileWeb' => 'Mobile web');

        self::$keyboardPlatforms = '';
        $vars = get_object_vars(self::$keyboard->platformSupport);
        foreach ($vars as $var => $value) {
          if ($value != 'none' && array_key_exists($var, $platformTitles)) {
            self::$keyboardPlatforms .= (self::$keyboardPlatforms == '' ? '' : ', ') . $platformTitles[$var];
          }
        }

        if (isset(self::$keyboard->related)) {
          foreach (self::$keyboard->related as $name => $value) {
            if (isset($value->deprecatedBy) && $value->deprecatedBy) {
              self::$deprecatedBy = $name;
              break;
            }
          }
        }
      }
    }

    protected static function WriteTitle() {
      $head_options = [
        'title' => self::$title
      ];

      global $embed, $session_query_q, $embed_win, $embed_version;
      global $embed_target;

      if ($embed != 'none') {
        $head_options += [
          'showMenu' => false,
          'showHeader' => false,
          'foot' => false,
          'js' => ['../keyboard-search/search.js', 'qrcode.js'],
          'css' => ['template.css', '../keyboard-search/search.css', '../keyboard-search/embed.css']
        ];
        $embed_target = " target='_blank' ";
      } else {
        $head_options += [
          'js' => ['../keyboard-search/search.js', 'qrcode.js'],
          'css' => ['template.css', '../keyboard-search/search.css']
        ];
        $embed_target = '';
      }
      head($head_options);

      if($embed == 'none') { ?>
        <script>
          var detail_page = true;
          var embed='none';
          var embed_query='';
        </script>
      <?php
      } else {
        global $session_query;
      ?>
        <script>
          var detail_page = true;
          var embed='<?=$embed?>';
          var embed_query='<?=$session_query?>';
        </script>
      <?php
      }

      if (!isset(self::$keyboard) || !isset(self::$downloads)) {
        // If parameters are missing ...
        ?>
          <h1 class='red underline'><?= self::$id ?></h1>
          <p>Keyboard <?= self::$id ?> not found.</p>
        <?php
        // DEBUG: Only display errors on local sites
        global $KeymanHosts;
        if($KeymanHosts->Tier() == \KeymanHosts::TIER_DEVELOPMENT && (ini_get('display_errors') !== '0')) {
          echo "<p>" . self::$error . "</p>";
        }
        exit;
      }

      if ($embed != 'none') {
        ?>

        <div id='navigation'>
          <a class='nav-right' target='_blank' href='/keyboards'>Go to keyman.com</a>
          <a href='/keyboards<?= $session_query_q ?>'>Home</a>
        </div>

        <?php
      } else if (!self::$landingPage) {
        ?>

        <div id='search-box'>
          <form method='get' action='/keyboards' name='f'>
            <div id='search-title'><a href='/keyboards'>Keyboard Search</a>:</div>
            <input id="search-q" type="text" placeholder="(new search)" name="q">
            <input id='search-page' type='hidden' name='page'>
            <input id="search-f" type="image" src="<?= cdn('img/search-button.png') ?>" value="Search"
                   onclick="return do_search()">
          </form>
        </div>
<?php
        if(empty(self::$deprecatedBy)) {
          self::WriteQRCode('top');
        }
?>
        <h1 class='red underline'><?= self::$title ?></h1>
<?php
      }
?>
<?php
      if(!empty(self::$deprecatedBy)) {
        $dep = self::$deprecatedBy;
        $id = self::$id;
        echo "
          <div class='download deprecated-new'>
            <a class='download-link' href='/keyboards/$dep$session_query_q'><span>Download</span></a>
            <div class='download-title'>Keyboard '$id' is obsolete.</div>
            <div class='download-description'>Click the Download button to get the replacement <span style='font-weight:bold'>$dep</span> keyboard instead.</div>
            <div class='download-filename'>$dep</div>
          </div>
          <div>
            <p class='deprecated-link'><a href='javascript:toggleDeprecatedVersionDetails()'>View details for old version of this keyboard</a></p>
            <div id='deprecated-old'>
              <a href='/keyboards/$dep$session_query_q' class='deprecated'><span>Important note:</span>
              This is an old version of this keyboard. Unless you have a good reason, click here to install the new version, called <span>$dep</span>, instead.</a>
        ";
      }
    }

    protected static function WriteDownloadBoxes() {
      global $embed, $session_query_q, $embed_win, $embed_version, $pageDevice;
      global $embed_target;

      $deviceboxfuncs = array(
        "Windows" => "self::WriteWindowsBoxes",
        "mac" => "self::WritemacOSBoxes",
        "Linux" => "self::WriteLinuxBoxes",
        "iPhone" => "self::WriteiPhoneBoxes",
        "iPad" => "self::WriteiPadBoxes",
        "Android" => "self::WriteAndroidBoxes"
      );

      $text = (isset($pageDevice) && array_key_exists($pageDevice, $deviceboxfuncs)) ? $deviceboxfuncs[$pageDevice] : '';
      $webtext = self::WriteWebBoxes();

      if ($text) {
        if ($embed_win && isset(self::$keyboard->minKeymanVersion) && version_compare(self::$keyboard->minKeymanVersion, $embed_version) > 0) {
?>
          <h2 class='red underline'>Downloads for your device</h2><p>Sorry, this keyboard requires Keyman Desktop <?= self::$keyboard->minKeymanVersion ?> or higher.</p>
<?php
        } else {
          echo "<h2 class='red underline' style='clear:none'>Downloads for your device</h2>" . call_user_func($text);
        }
      }

      if ($embed == 'none') {
        if ($webtext) {
          echo "<h2 class='red underline'>Online tools</h2>" . $webtext;
        }

        echo "<h2 class='red underline'>Downloads for other devices</h2><div class='download-other'>";
        if(empty(self::$deprecatedBy)) {
          self::WriteQRCode('other');
        }
        foreach ($deviceboxfuncs as $platform => $func) {
          if ($platform != $pageDevice) {
            echo call_user_func($func);
          }
        }
      }
      echo "</div>";
    }

    protected static function WriteKeyboardDetails() {
      global $embed_target, $session_query_q;

      // this is html, trusted in database
      ?>
      <h2 class='red underline'>Keyboard Details</h2>
      <p><?= self::$description ?></p>
      <div class='cols' id='keyboard-details-col'>
        <div class='col'>

          <table id='keyboard-details'>
            <tbody>
            <tr>
              <th>Keyboard ID</th>
              <td><?= htmlentities(self::$id) ?></td>
            </tr>
            <tr>
              <th>Author</th>
              <td><?= htmlentities(self::$authorName) ?></td>
            </tr>
            <tr>
              <th>License</th>
              <td><?= self::$license ?></td>
            </tr>
            <tr>
              <th>Documentation</th>
              <td>
<?php
              if (isset(self::$keyboard->helpLink)) {
?>
                <a <?= $embed_target ?>
                  href='<?= self::$keyboard->helpLink ?>'>Keyboard help</a>
<?php
              } else {
                echo "Help not available.";
              }
?>
              </td>
            </tr>
            <tr>
              <th>Source</th>
              <td>
<?php
                if (isset(self::$keyboard->sourcePath) && preg_match('/^(release|experimental)\//', self::$keyboard->sourcePath)) {
?>
                  <a <?= $embed_target ?>
                    href='<?= GITHUB_ROOT . htmlentities(self::$keyboard->sourcePath) ?>'><?= htmlentities(self::$keyboard->sourcePath) ?></a>
<?php
                } else {
                  echo "Source not available.";
                } ?>
              </td>
            <tr>
              <th>Keyboard Version</th>
              <td><?= htmlentities(self::$keyboard->version) ?></td>
            </tr>
            <tr>
              <th>Last Updated</th>
              <td><?= self::$keyboardLastModifiedDate ?></td>
            </tr>
            </tbody>
          </table>

        </div>
        <div class='col'>

          <table id='keyboard-details'>
            <tbody>
            <tr>
              <th>Encoding</th>
              <td><?= self::$keyboardEncoding ?></td>
            </tr>
            <tr>
              <th>Minimum Keyman Version</th>
              <td><?= self::$minVersion ?></td>
            </tr>
            <tr>
              <th>Platform Support</th>
              <td><?= self::$keyboardPlatforms ?></td>
            </tr>
            <?php
            if (isset(self::$keyboard->related)) {
              ?>
              <tr>
                <th>Related Keyboards</th>
                <td>
                  <?php
                  foreach (self::$keyboard->related as $name => $value) {
                    $hname = htmlentities($name);
                    echo "<a href='/keyboards/$hname$session_query_q'>$hname</a> ";
                    if (isset($value->deprecates) && $value->deprecates) echo " (deprecated) ";
                    if (isset($value->deprecatedBy) && $value->deprecatedBy) echo " (new version) ";
                  }
                  ?>
                </td>
              </tr>
              <?php
            }
            ?>
            <tr>
              <th>Supported Languages</th>
              <td class='supported-languages'>
                <?php
                  (function() {
                    $n = 0;
                    $count = count(get_object_vars(self::$keyboard->languages)) - 3;
                    foreach(self::$keyboard->languages as $tag => $detail) {
                      if($n == 3) {
                        echo " <a id='expand-languages' href='#expand-languages'>Expand $count more &gt;&gt;</a>";
                        echo "<a id='collapse-languages' href='#collapse-languages'>&lt;&lt; Collapse</a> <span class='expand-languages'>";
                      }
                      echo
                        "<a href='/keyboards?q=l:id:".htmlspecialchars(urlencode($tag)).
                        "' title='".htmlspecialchars($tag).": ".htmlspecialchars($detail->displayName)."'>" .
                        (!strcasecmp($tag, self::$tag) ? "<mark>".htmlspecialchars($detail->languageName)."</mark>" : htmlspecialchars($detail->languageName)).
                        "</a> ";
                      $n++;
                    }
                    if($n >= 3) {
                      echo "</span>";
                    }
                  })();
                ?>
              </td>
            </tr>
            </tbody>
          </table>

        </div>
        <div class='clear-left'></div>
      </div>

      <p id='permalink'>
        Permanent link to this keyboard:
        <a <?= $embed_target ?> href='https://keyman.com/keyboards/<?= self::$keyboard->id ?>'>
          https://keyman.com/keyboards/<?= self::$keyboard->id ?>
        </a>
      </p>
      <?php
    }

    protected static function WriteQRCode($context) {
?>
    <div class='qrcode-host qrcode-<?=$context?>'>
      <div id="qrcode-<?=$context?>"></div>
      <div class='qrcode-caption'>Scan this code to load this keyboard on another device</div>
    </div>
    <script type="text/javascript">
      new QRCode(document.getElementById("qrcode-<?=$context?>"), {
        text: location.href,
        width: 128,
        height: 128
      });
    </script>
<?php
    }
  }
