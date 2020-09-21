<?php
  namespace UI;

  require_once('includes/template.php');
  require_once('includes/playstore.php');
  require_once('includes/appstore.php');

  use \DateTime;
  use \Keyman\Site\Common\KeymanHosts;

  define('GITHUB_ROOT', 'https://github.com/keymanapp/keyboards/tree/master/');
  define('DOCUMENTATION_ROOT', KeymanHosts::Instance()->help_keyman_com . '/keyboard/');

  class KeyboardDetails
  {
    const platformTitles = [
      'windows' => 'Windows',
      'macos' => 'macOS',
      'linux' => 'Linux',
      'android' => 'Android',
      'ios' => 'iPhone and iPad',
      'desktopWeb' => 'Web',
      'mobileWeb' => 'Mobile web'
    ];

    // Property for landing pages not to display keyboard searchbox and title
    static private $landingPage;

    // Properties for querying api.keyman.com
    static private $id;
    static private $tier;

    // Properties to provide to apps in embedded download mode
    static private $bcp47;

    // Properties for querying keyboard downloads
    static private $keyboard;
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
    static private $kmpDownloadUrl;

    static private $deprecatedBy;

    /**
     * render_keyboard_details - display keyboard download boxes and details
     * @param $id - keyboard ID
     * @param string $tier - ['stable', 'alpha', or 'beta']
     * @param bool $landingPage - when true, details won't display keyboard search box or title
     * @param string $bcp47 - BCP 47 tag to pass as a hint to download links for apps to make connection
     */
    public static function render_keyboard_details($id, $tier = 'stable', $landingPage = false, $bcp47 = null) {
      self::$id = $id;
      self::$bcp47 = $bcp47;
      self::$tier = self::get_tier_from_request($tier);
      self::$landingPage = $landingPage;

      self::LoadData();
      self::WriteTitle();
      self::WriteDownloadBoxes();
      self::WriteKeyboardDetails();
      if(!empty(self::$deprecatedBy)) echo "</div></div>";
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

    protected static function download_box($platform) {
      if(!empty(self::$deprecatedBy)) {
        return "";
      } else if(isset(self::$keyboard->platformSupport->$platform) && self::$keyboard->platformSupport->$platform != 'none') {
        $filename = self::$id . ".kmp";
        $installLink = '/keyboards/install/' . rawurlencode(self::$id);
        if(!empty(self::$bcp47)) $installLink .= "?bcp47=" . rawurlencode(self::$bcp47);
        $h_filename = htmlspecialchars($filename);
        $platformTitle = self::platformTitles[$platform];

        return <<<END
<div class="download download-$platform">
  <a class='download-link binary-download' href='$installLink'><span>Install keyboard</span></a>
  <div class="download-description">Installs {$h_filename} for $platformTitle on this device</div>
</div>
END;
      } else {
        return <<<END
<div class="download download-$platform">
  <span>This keyboard is not supported on this device. You may find other options below.</span>
</div>
END;
      }
    }

    protected static function WriteWebBoxes() {
      global $embed_target;
      global $KeymanHosts;
      if (isset(self::$keyboard->platformSupport->desktopWeb) && self::$keyboard->platformSupport->desktopWeb != 'none' && empty(self::$deprecatedBy)) {
          if(empty(self::$bcp47)) {
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
        } else {
          $lang = self::$bcp47;
        }
        if (!isset($lang)) $lang = 'en';
        $url = "{$KeymanHosts->keymanweb_com}/#$lang,Keyboard_" . self::$keyboard->id;
        $description = htmlentities(self::$keyboard->name);
          return <<<END
          <div class="download download-web">
          <a class="download-link" $embed_target href='$url'>Use keyboard online</a>
          <div class="download-description">Use $description in your web browser. No need to install anything.</div>
        </div>
END;
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

      if(!empty(self::$keyboard)) {
        if (in_array('unicode', self::$keyboard->encodings) && in_array('ansi', self::$keyboard->encodings))
          self::$keyboardEncoding = 'Unicode, Legacy (ANSI)';
        else if (in_array('unicode', self::$keyboard->encodings))
          self::$keyboardEncoding = 'Unicode';
        else // ansi
          self::$keyboardEncoding = 'Legacy (ANSI)';

        $date = new DateTime(self::$keyboard->lastModifiedDate);
        self::$keyboardLastModifiedDate = $date->format('Y-m-d H:i');

        $platformTitles = self::platformTitles;

        self::$keyboardPlatforms = "<span class='platforms'>";
        $vars = get_object_vars(self::$keyboard->platformSupport);
        foreach ($vars as $var => $value) {
          if ($value != 'none' && array_key_exists($var, $platformTitles)) {
            self::$keyboardPlatforms .= "<span class='platform-$var'>{$platformTitles[$var]}</span>";
          }
        }
        self::$keyboardPlatforms .= "</span>";

        if (isset(self::$keyboard->related)) {
          foreach (self::$keyboard->related as $name => $value) {
            if (isset($value->deprecatedBy) && $value->deprecatedBy) {
              self::$deprecatedBy = $name;
              break;
            }
          }
        }

        self::$kmpDownloadUrl = "/go/package/download/" .
          rawurlencode(self::$id) .
          "?version=" . rawurlencode(self::$keyboard->version) .
          (empty(self::$tier) ? "" : "&tier=" . rawurlencode(self::$tier)) .
          (empty(self::$bcp47) ? "" : "&bcp47=" . rawurlencode(self::$bcp47));
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
          'js' => ['../keyboard-search/keyboard-details.js', 'qrcode.js'],
          'css' => ['template.css', '../keyboard-search/search.css', '../keyboard-search/embed.css']
        ];
        $embed_target = " target='_blank' ";
      } else {
        $head_options += [
          'js' => ['../keyboard-search/keyboard-details.js', 'qrcode.js'],
          'css' => ['template.css', '../keyboard-search/search.css']
        ];
        $embed_target = '';
      }
      head($head_options);

      if($embed == 'none') { ?>
        <script>
          var embed='none';
          var embed_query='';
        </script>
      <?php
      } else {
        global $session_query;
      ?>
        <script>
          var embed='<?=$embed?>';
          var embed_query='<?=$session_query?>';
        </script>
      <?php
      }

      if (!isset(self::$keyboard)) {
        // If parameters are missing ...
        ?>
          <h1 class='red underline'><?= self::$id ?></h1>
          <p>Keyboard <?= self::$id ?> not found.</p>
        <?php
        // DEBUG: Only display errors on local sites
        global $KeymanHosts;
        if($KeymanHosts->Tier() == KeymanHosts::TIER_DEVELOPMENT && (ini_get('display_errors') !== '0')) {
          echo "<p>" . self::$error . "</p>";
        }
        exit;
      }

      if ($embed != 'none') {
        ?>

        <div id='search-box'>
          <label id='search-new'><a href='/keyboards<?= $session_query_q ?>'>New search</a></label>
          <h1 class='red'><?= self::$title ?></h1>
        </div>

        <?php
      } else if (!self::$landingPage) {
        ?>

        <div id='search-box'>
          <form method='get' action='/keyboards' name='f'>
            <div id='search-title'><a href='/keyboards'>Keyboard Search</a>:</div>
            <input id="search-q" type="text" placeholder="(new search)" name="q">
            <input id='search-page' type='hidden' name='page'>
            <input id="search-f" type="image" src="<?= cdn('img/search-button.png') ?>" value="Search">
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

      if(!empty(self::$deprecatedBy)) {
        $dep = self::$deprecatedBy;
        $id = self::$id;
        echo "
          <div>
            <a href='/keyboards/$dep$session_query_q' class='deprecated'><span>Important note:</span>
            This is an obsolete version of this keyboard. Unless you have a good reason, click here to install the new version, called <span>$dep</span>, instead.</a>
          </div>
          <div>
            <p class='deprecated-link'><a href='javascript:toggleDeprecatedVersionDetails()'>View details for obsolete version instead</a></p>
            <div id='deprecated-old'>

        ";
      }
    }

    protected static function WriteDownloadBoxes() {
      global $embed, $session_query_q, $embed_win, $embed_version, $pageDevice;
      global $embed_target;

      // We'll write all the different platforms here and then let Bowser determine
      // which box to show. This is true for both embedded and web-based viewing.

      $text = '';

      foreach(self::platformTitles as $platform => $title) {
        if($platform != 'desktopWeb' && $platform != 'mobileWeb')
          $text .= self::download_box($platform);
      }

      $text .= self::download_box('unknown');

      if ($embed_win && isset(self::$keyboard->minKeymanVersion) && version_compare(self::$keyboard->minKeymanVersion, $embed_version) > 0) {
?>
        <p>Sorry, this keyboard requires Keyman Desktop <?= self::$keyboard->minKeymanVersion ?> or higher.</p>
<?php
      } else {
        echo $text;
      }

      if ($embed == 'none') {
        $webtext = self::WriteWebBoxes();
        if ($webtext) {
          echo $webtext;
        }

        if(empty(self::$deprecatedBy)) {
          self::WriteQRCode('other');
        }
      }
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
              <th>Supported Platforms</th>
              <td><?= self::$keyboardPlatforms ?></td>
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
              <th>Package Download</th>
              <td><a href="<?= self::$kmpDownloadUrl ?>"><?= self::$keyboard->id ?>.kmp</a></td>
            </tr>
            <tr>
              <th>Encoding</th>
              <td><?= self::$keyboardEncoding ?></td>
            </tr>
            <tr>
              <th>Minimum Keyman Version</th>
              <td><?= self::$minVersion ?></td>
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
                    foreach(self::$keyboard->languages as $bcp47 => $detail) {
                      if($n == 3) {
                        echo " <a id='expand-languages' href='#expand-languages'>Expand $count more &gt;&gt;</a>";
                        echo "<a id='collapse-languages' href='#collapse-languages'>&lt;&lt; Collapse</a> <span class='expand-languages'>";
                      }
                      echo
                        "<a href='/keyboards?q=l:id:".htmlspecialchars(rawurlencode($bcp47)).
                        "' title='".htmlspecialchars($bcp47).": ".htmlspecialchars($detail->displayName)."'>" .
                        (!strcasecmp($bcp47, self::$bcp47) ? "<mark>".htmlspecialchars($detail->languageName)."</mark>" : htmlspecialchars($detail->languageName)).
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
        <a <?= $embed_target ?> href='<?= KeymanHosts::Instance()->keyman_com ?>/keyboards/<?= self::$keyboard->id ?>'>
          <?= KeymanHosts::Instance()->keyman_com ?>/keyboards/<?= self::$keyboard->id ?>
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
