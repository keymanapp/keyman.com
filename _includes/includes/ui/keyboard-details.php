<?php
  namespace UI;

  require_once('includes/template.php');
  require_once('includes/playstore.php');
  require_once('includes/appstore.php');

  use \DateTime;
  use \Keyman\Site\com\keyman\KeymanWebHost;
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
    static private $downloadCount;
    static private $totalDownloadCount;

    static private $deprecatedBy;

    /**
     * render_keyboard_details - display keyboard download boxes and details
     * @param $id - keyboard package ID
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
      self::WriteDescription();
      self::WriteDownloadBoxes();
      self::WriteKeymanWebBox();
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

    protected static function WriteDeveloperCloneBox() {
      $filename = self::$id . ".kpj";
      $installLink = 'keyman:keyboard/install/' . rawurlencode(self::$id);
      if(!empty(self::$bcp47)) $installLink .= "?bcp47=" . rawurlencode(self::$bcp47);
      $h_filename = htmlspecialchars($filename);

      return <<<END
<div class="download download-developer">
  <div class="download-description">Fill in New Project Details box below and click OK to clone $h_filename.</div>
</div>
END;
  // <script>location.href = '$installLink';</script>
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

    protected static function WriteWebBoxes($useDescription) {
      global $embed_target;

      // only show if the jsFilename property is present in the .keyboard_info
      if(empty(self::$keyboard->jsFilename)) {
        return FALSE;
      }

      if (!isset(self::$keyboard->platformSupport->desktopWeb) || self::$keyboard->platformSupport->desktopWeb == 'none' || !empty(self::$deprecatedBy)) {
        return FALSE;
      }

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
      $url = KeymanHosts::Instance()->keymanweb_com ."/#$lang,Keyboard_" . self::GetWebKeyboardId();
      if($useDescription) {
        $description = htmlentities(self::$keyboard->name);
        $description = "<div class=\"download-description\">Use $description in your web browser. No need to install anything.</div>";
        $linktext = 'Use keyboard online';
      } else {
        $description = '';
        $linktext = 'Full online editor';
      }
      return <<<END
        <div class="download download-web">
          <a class="download-link" $embed_target href='$url'>$linktext</a>
          $description
        </div>
END;
    }

    protected static function LoadData() {
      global $stable_version;

      self::$error = "";
      $s = @file_get_contents(KeymanHosts::Instance()->SERVER_api_keyman_com. '/keyboard/' . rawurlencode(self::$id));
      if ($s === FALSE) {
        // Will fail later in the script
        self::$error .= error_get_last()['message'] . "\n";
        self::$title = 'Failed to load keyboard package ' . self::$id;
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
          self::$error .= "Error returned from ".KeymanHosts::Instance()->api_keyman_com.": $s\n";
          self::$title = 'Failed to load keyboard package ' . self::$id;
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

        self::$downloadCount = 0;
        self::$totalDownloadCount = 0;
        $s = @file_get_contents(KeymanHosts::Instance()->SERVER_api_keyman_com.'/search/2.0?q=k:id:' . rawurlencode(self::$id));
        if ($s !== FALSE) {
          $s = json_decode($s);
          if(is_object($s) && is_array(($s->keyboards))) {
            $sk = self::array_find($s->keyboards, function($x) { return $x->id === self::$id; });
            if($sk) {
              if(!empty($sk->match->downloads)) {
                self::$downloadCount = $sk->match->downloads;
              }
              if(!empty($sk->match->totalDownloads)) {
                self::$totalDownloadCount = $sk->match->totalDownloads;
              }
            }
          }
        }
      }
    }

    private static function array_find($xs, $f) {
      foreach ($xs as $x) {
        if (call_user_func($f, $x) === true)
          return $x;
      }
      return null;
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
          <p>Keyboard package <?= self::$id ?> not found.</p>
        <?php
        // DEBUG: Only display errors on local sites
        if(KeymanHosts::Instance()->Tier() == KeymanHosts::TIER_DEVELOPMENT && (ini_get('display_errors') !== '0')) {
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
            <input id="search-q" type="text" placeholder="New keyboard search" name="q">
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
      global $embed, $embed_win, $embed_version;
      global $embed_developer;

      // We'll write all the different platforms here and then let Bowser determine
      // which box to show. This is true for both embedded and web-based viewing.

      $text = '';

      if($embed_developer) {
        $text .= self::WriteDeveloperCloneBox();
        echo $text;
      } else {
        foreach(self::platformTitles as $platform => $title) {
          if($platform != 'desktopWeb' && $platform != 'mobileWeb')
            $text .= self::download_box($platform);
        }

        $text .= self::download_box('unknown');

        if ($embed_win && isset(self::$keyboard->minKeymanVersion) && version_compare(self::$keyboard->minKeymanVersion, $embed_version) > 0) {
?>
        <p>Sorry, this keyboard requires Keyman <?= self::$keyboard->minKeymanVersion ?> or higher.</p>
<?php
        } else {
          echo $text;
        }
      }

      if ($embed == 'none') {
        if(self::GetWebDeviceFromPageDevice() == null) {
          $webtext = self::WriteWebBoxes(true);
          if ($webtext) {
            // If we have a web keyboard, and we are not embedded, and this is a
            // mobile device, then show the link to keymanweb.com
            echo $webtext;
          }
        }
        if(empty(self::$deprecatedBy)) {
          self::WriteQRCode('other');
        }
      }
    }

    private static function GetWebKeyboardId() {
      if(empty(self::$keyboard->jsFilename)) {
        return "";
      }
      return preg_replace("/\.js$/", "", self::$keyboard->jsFilename);
    }

    protected static function GetWebDeviceFromPageDevice() {
      global $pageDevice;
      switch($pageDevice) {
        case 'Windows': return 'windows';
        case 'mac':     return 'macosx';
        case 'Linux':   return 'linux';
      }
      return null;
    }

    protected static function WriteKeymanWebBox() {
      global $embed;

      // don't show if we are embedded into a Keyman app
      if($embed != 'none') {
        return;
      }

      // only show if we have a web keyboard and we are not deprecated
      if(!isset(self::$keyboard->platformSupport->desktopWeb) ||
          self::$keyboard->platformSupport->desktopWeb == 'none' ||
          !empty(self::$deprecatedBy)) {
        return;
      }

      // only show if the jsFilename property is present in the .keyboard_info
      if(empty(self::$keyboard->jsFilename)) {
        return;
      }

      // only inject on desktop platforms
      $webDevice = self::GetWebDeviceFromPageDevice();
      if(!$webDevice) {
        return;
      }

      $keymanWebId = self::GetWebKeyboardId();
      $webtext = self::WriteWebBoxes(false);
      $cdnUrlBase = KeymanWebHost::getKeymanWebUrlBase();
      ?>
        <h2 id='try-header' class='red underline'>Try this keyboard</h2>
        <div id='try-box'>
          <input type='text' id='try-keyboard'>
          <div id='osk-host'></div>
          <div id='try-keymanweb-link'><?= $webtext ?></div>
        </div>
        <script crossorigin="anonymous" src='<?=$cdnUrlBase?>/keymanweb.js'></script>
        <script>
          (function() {
            keyman.init({attachType:'manual'}).then(
              function() {
                keyman.attachToControl(document.getElementById('try-keyboard'));

                // Create a new on screen keyboard view and tell KeymanWeb that
                // we are using the targetDevice for context input.
                const targetDevice = {
                  browser: 'chrome', formFactor: 'desktop', OS: '<?=$webDevice?>',
                  touchable: false, dimensions: [640, 300] };
                newOSK = new keyman.views.InlinedOSKView(keyman, { device: targetDevice });  // Note: KeymanWeb internal API
                keyman.core.contextDevice = targetDevice;  // Note: KeymanWeb internal API
                keyman.osk = newOSK;  // Note: undocumented KeymanWeb API
                newOSK.setSize(targetDevice.dimensions[0]+'px', targetDevice.dimensions[1]+'px');
                document.getElementById('osk-host').appendChild(newOSK.element);
              }
            );
            keyman.addKeyboards('<?= $keymanWebId ?>');
          })();
        </script>
      <?php
    }

    protected static function WriteDescription() {
      echo "<p>" . self::$description . "</p>";
    }

    protected static function WriteKeyboardDetails() {
      global $embed_target, $session_query_q;

      // this is html, trusted in database
      ?>
      <h2 class='red underline'>Keyboard Details</h2>
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
<?php
              if(isset(self::$keyboard->packageFilename)) {
?>
            <tr>
              <th>Package Download</th>
              <td><a href="<?= self::$kmpDownloadUrl ?>" rel="nofollow"><?= self::$keyboard->id ?>.kmp</a></td>
            </tr>
<?php
              }
?>
            <tr>
              <th>Monthly Downloads</th>
              <td><?= number_format(self::$downloadCount) ?></td>
            </tr>
            <tr>
              <th>Total Downloads</th>
              <td title='Downloads since October 2019'><?= number_format(self::$totalDownloadCount) ?></td>
            </tr>
            <tr>
              <th>Encoding</th>
              <td><?= self::$keyboardEncoding ?></td>
            </tr>
            <tr>
              <th>Minimum Keyman Version</th>
              <td><?= self::$minVersion ?></td>
            </tr>
            <?php if (isset(self::$keyboard->related)) { ?>
              <tr>
                <th>Related Keyboards</th>
                <td>
                  <?php
                  foreach (self::$keyboard->related as $name => $value) {
                    $hname = htmlentities($name);
                    // TODO(lowpri): we could return this information in the API to avoid multiple
                    // round trip queries but that requires more changes to the API, docs, and
                    // schema.
                    $s = @file_get_contents(KeymanHosts::Instance()->SERVER_api_keyman_com.'/keyboard/' . rawurlencode($name));
                    if ($s === FALSE) {
                      echo "<span class='keyboard-unavailable' title='This keyboard is not available on ".
                        KeymanHosts::Instance()->keyman_com_host."'>$hname</span> ";
                    } else {
                      echo "<a href='/keyboards/$hname$session_query_q'>$hname</a> ";
                    }
                    if (isset($value->deprecates) && $value->deprecates) echo " (deprecated) ";
                    if (isset($value->deprecatedBy) && $value->deprecatedBy) echo " (new version) ";
                  }
                  ?>
                </td>
              </tr>
            <?php } ?>
            <tr>
              <th>Supported Languages</th>
              <td class='supported-languages'>
                <?php
                  (function() {
                    $n = 0;
                    $count = count(get_object_vars(self::$keyboard->languages)) - 3;
                    $langs = (array) self::$keyboard->languages;
                    uasort($langs, function($i1, $i2) {
                      return strcasecmp($i1->languageName, $i2->languageName);
                    });

                    foreach($langs as $bcp47 => $detail) {
                      if($n == 3) {
                        echo " <a id='expand-languages' href='#expand-languages'>Expand $count more &gt;&gt;</a>";
                        echo "<a id='collapse-languages' href='#collapse-languages'>&lt;&lt; Collapse</a> <span class='expand-languages'>";
                      }
                      if (property_exists($detail, 'languageName')) {
                        echo
                          "<a href='/keyboards?q=l:id:".htmlspecialchars(rawurlencode($bcp47)).
                          "' title='".htmlspecialchars($bcp47).": ".htmlspecialchars($detail->displayName)."'>" .
                          (!strcasecmp($bcp47, self::$bcp47) ? "<mark>".htmlspecialchars($detail->languageName)."</mark>" : htmlspecialchars($detail->languageName)).
                          "</a> ";
                      }
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
