<?php
  declare(strict_types=1);

  namespace Keyman\Site\com\keyman\templates;

  use Keyman\Site\com\keyman\Util;
  use Keyman\Site\Common\KeymanVersion;
  use Keyman\Site\Common\KeymanHosts;

  class Menu {
    //
    /**
     *
     * @param $fields   array of 'pageClass' (default: 'default'), and 'device' (default: blank)
     * Note: we'll move to named parameters when PHP lets us in the future
     */
    public static function render(array $fields): void {
      $fields = (object)$fields;
      if(!isset($fields->pageClass)) $fields->pageClass = 'default';
      if(!isset($fields->device)) $fields->device = '';
      $fields->stable_version = KeymanVersion::stable_version;
      $fields->beta_version = KeymanVersion::beta_version;

      // Fallback to 'en'
      // TODO-I18N-URL-SCHEME: integrate with Locale.php
      $fields->lang = isset($_REQUEST['lang']) ? $_REQUEST['lang'] : 'en';

      echo <<<END
<body data-device="$fields->device">
END;

      Menu::render_phone_menu($fields);
      Menu::render_top_menu($fields);
    }

    /**
     * Generate the URL with query to change the UI language
     * @param language - language tag to use
     */
    private static function change_ui_language($language): string {
      // Parse the current URI for populating the UI dropdown
      $url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
      $parts = parse_url($url);

      if (!empty($parts['path'])) {
        // Replace language
        $path = explode('/', $parts['path']);
        //echo "$path";
        $path[0] = $language;
      }

      // Rebuild the path
      $query = http_build_query($parts['query']);
      return join('/', $path) . "?" . $query;
    }

    /**
     * Generate links that correspond to the UI options
     * As UI languages get added, we'll need to update this.
     */
    private static function render_ui_list() {
      echo "<ul>\n                <!-- Just use autonyms -->\n";
      $linkArray = array(
        'en' => array(Menu::change_ui_language('en'), 'English'),
        'de' => array(Menu::change_ui_language('de'), 'Deutsch'),
        'es' => array(Menu::change_ui_language('es'), 'Español'),
        'fr' => array(Menu::change_ui_language('fr'), 'Français'),
        'km' => array(Menu::change_ui_language('km'), 'ខ្មែរ')
      );

      foreach($linkArray as $id) {
echo <<<END
                <li><a href="{$id[0]}">{$id[1]}</a></li>\n
END;
      }
      echo "</ul>";
    }

    /**
     * Render the globe dropdown for changing the UI language
     * Limitation: Currently only visible on pages that use localized strings
     * @param divID - <div> ID to handle 3 cases:
     * ui-language (default) Desktop globe hover
     * ui-language1 - Desktop globe hover
     * phone - Mobile list
     */
    private static function render_globe_dropdown($divID = "ui-language"): void {
      global $page_is_using_locale;
      if (!isset($page_is_using_locale) || !$page_is_using_locale) {
        // only render on pages that use localized strings
        return;
      }

      // Phone layout
      $globeClass = '';
      if ($divID === "phone") {
?>
<div class="phone-menu-item">
            <h3><span><img src="<?php echo Util::cdn("img/globe.png"); ?>" alt="UI globe dropdown" /></span> Keyboard Search UI</h3>
            <?= Menu::render_ui_list(); ?>
        </div>
      <?php
        return;
      } else if ($divID === "ui-language") {
        $globeClass = 'menu-item';
      } else if ($divID === "ui-language1") {
        $globeClass = 'help1-globe menu-item';
      }

      // Desktop layout
echo <<<END
          <p>
            <div id='$divID' class='$globeClass'>
END;
?>
              <img src="<?php echo Util::cdn("img/globe.png"); ?>" alt="UI globe dropdown" />
              <div class="menu-item-dropdown">
                <div class="menu-dropdown-inner">
                  <?= Menu::render_ui_list(); ?>
                </div>
              </div>
            </div>
          </p>
<?php
    }

    private static function render_phone_menu(object $fields): void {
?>

<div id="phone-menu">
    <div id="phone-menu-inner">
        <div class="phone-menu-item">
            <h3>Keyboards</h3>
            <form method="get" action="/<?=$fields->lang?>/keyboards" name="fsearch">
                <input id="language-search2" type="text" placeholder="Enter language" name="q">
                <input id="search-submit2" type="image" src="<?php echo Util::cdn("img/search-button.png"); ?>" alt="search button" value="Search" onclick="if(document.getElementById('language-search2').value==''){return false;}">
            </form>
        </div>
        <?= Menu::render_globe_dropdown("phone"); ?>
  <div class="phone-menu-item">
            <h3>Products</h3>
            <ul>
                <li><a href="/<?=$fields->lang?>/windows/">Keyman <?=$fields->stable_version?> for Windows</a></li>
                <li><a href="/<?=$fields->lang?>/mac/">Keyman <?=$fields->stable_version?> for macOS</a></li>
                <li><a href="/<?=$fields->lang?>/linux/">Keyman <?=$fields->stable_version?> for Linux</a></li>
                <li><a href="/<?=$fields->lang?>/keymanweb/">KeymanWeb.com</a></li>
                <li><a href="/<?=$fields->lang?>/iphone/">Keyman <?=$fields->stable_version?> for iPhone</a></li>
                <li><a href="/<?=$fields->lang?>/ipad/">Keyman <?=$fields->stable_version?> for iPad</a></li>
                <li><a href="/<?=$fields->lang?>/android/">Keyman <?=$fields->stable_version?> for Android</a></li>
                <li><a href="/<?=$fields->lang?>/bookmarklet/">Keyman Bookmarklet</a></li>
            </ul>
            <h3>Downloads</h3>
            <ul>
                <li><a href='/<?=$fields->lang?>/downloads/'>Current release versions</a></li>
                <li><a href='/<?=$fields->lang?>/downloads/pre-release/'>Pre-release versions</a></li>
                <li><a href="/<?=$fields->lang?>/downloads/archive/">Older versions</a></li>
            </ul>
        </div>
        <div class="phone-menu-item">
            <h3>Developer Tools</h3>
            <ul>
                <li><a href="/<?=$fields->lang?>/developer/">Keyman Developer <?=$fields->stable_version?></a></li>
                <li><a href="/<?=$fields->lang?>/engine/">Keyman Engine for Desktop</a></li>
                <li><a href="/<?=$fields->lang?>/engine/">Keyman Engine for Web</a></li>
                <li><a href="/<?=$fields->lang?>/engine/">Keyman Engine for iOS</a></li>
                <li><a href="/<?=$fields->lang?>/engine/">Keyman Engine for Android</a></li>
            </ul>
        </div>
        <div class="phone-menu-item">
            <h3>About</h3>
            <ul>
              <li><a href="/<?=$fields->lang?>/about/">About Keyman</a></li>
              <li><a href="/<?=$fields->lang?>/about/team">The team</a></li>
              <li><a href="/<?=$fields->lang?>/about/get-involved">Get Involved</a></li>
              <li><a href="/<?=$fields->lang?>/training">Training Events</a></li>
              <li><a href="/<?=$fields->lang?>/free/">Free on all Platforms</a></li>
              <li><a href="/<?=$fields->lang?>/ldml/">LDML Support</a></li>
              <li><a href="/<?=$fields->lang?>/contact/">Contact Us</a></li>
              <li><a href="<?= KeymanHosts::Instance()->blog_keyman_com ?>">Keyman Blog</a></li>
              <li><a href="/<?=$fields->lang?>/testimonials/">Testimonials</a></li>
              <li><a href="/<?=$fields->lang?>/search/">Search Site</a></li>
           </ul>
        </div>
        <div class="phone-menu-item">
            <h3>Help</h3>
            <ul>
                <li><a href="<?= KeymanHosts::Instance()->help_keyman_com ?>">Help and Documentation</a></li>
           </ul>
        </div>
    </div>
</div>

<?php
    }

    private static function render_top_menu(object $fields): void {
?>

<div id="container" class="page-<?=$fields->pageClass?>">
    <div class="header">
        <img id="show-phone-menu" src="<?php echo Util::cdn("img/phonehide.png"); ?>" alt="menu toggle" />
        <a id="home-link" href="/"><img id="logo" src="<?php echo Util::cdn(KeymanHosts::Instance()->Tier() == KeymanHosts::TIER_PRODUCTION ? "img/logo2.png" : "img/logo2dev.png"); ?>" alt='Keyman Logo' /></a>
        <img id="header-bottom" src="<?php echo Util::cdn("img/headerbar.png"); ?>" alt='Header bottom' />
        <div id="help">

          <span id='free'>Keyman is <a href='/free'>free and open source</a></span>

          <form action="/<?=$fields->lang?>/search/" method="get" role="search">
            <div class="search-wrap">
              <label for="main-q" class="offscreen">Search</label>
              <input type="search" id="main-q" name="q" placeholder="Search" data-value="" value="" />
              <button type="submit" class="offscreen">Search</button>
            </div>
          </form>
          <p id="donate"><a href="/donate">Donate</a></p>
          <p><a href="<?= KeymanHosts::Instance()->help_keyman_com ?>" target="blank">Support<img src="<?php echo Util::cdn("img/helpIcon.png"); ?>" alt="help icon"></a></p>
          <?php
            Menu::render_globe_dropdown("ui-language");
?>
        </div>
    </div>
    <div id="top-menu-bg"></div>
    <div id="top-menu1">
        <a href="/"><img id="top-menu-icon" src="<?php echo Util::cdn("img/icon1.png"); ?>" alt="Keyman logo" /></a>
        <div id='help1'>
          <form action="/<?=$fields->lang?>/search/" method="get" role="search">
            <div class="search-wrap">
              <label for="main-q" class="offscreen">Search</label>
              <input type="search" id="main-q" name="q" placeholder="Search" data-value="" value="" />
              <button type="submit" class="offscreen">Search</button>
            </div>
          </form>
          <a id='help1-donate' href="/donate">Donate</a>
          <a href="<?= KeymanHosts::Instance()->help_keyman_com ?>"><img id="top-menu-icon2" src="<?php echo Util::cdn("img/helpIcon.png"); ?>" alt="help icon" /></a>
<?php
            Menu::render_globe_dropdown("ui-language1");
?>
        </div>
        <div class="wrapper">
            <div class="menu-item" id="keyboards">
                <h3>Keyboards<span class="header-triangle"><img src="<?php echo Util::cdn("img/img_trans.png"); ?>" alt="keyboards dropdown" /></span></h3>
                <div class="menu-item-dropdown">
                    <div class="menu-dropdown-inner">
                        <h4>(2500+ languages)</h4>
                        <form method="get" action="/<?=$fields->lang?>/keyboards" name="fsearch">
                            <input id="language-search" type="text" placeholder="Enter language" name="q">
                            <input id="search-submit" type="image" src="<?php echo Util::cdn('img/search-button.png'); ?>" value="Search" onclick="if(document.getElementById('language-search').value==''){return false;}">
                        </form>

                        <h4>Featured keyboards</h4>
                        <ul>
                            <li><a href="/amharic/">Amharic and Ethiopic keyboards</a></li>
                            <li><a href="/tigrigna/">Tigrigna keyboards</a></li>
                            <li><a href="/eurolatin/">Eurolatin keyboard</a></li>
                            <li><a href="/ipa/">IPA keyboards</a></li>
                            <li><a href="/khmer/">Khmer Angkor keyboard</a></li>
                            <li><a href="/burmese/">Burmese keyboards</a></li>
                            <li><a href="/cameroon/">Cameroon keyboards</a></li>
                            <li><a href="/tamil/">Tamil keyboards</a></li>
                            <li><a href="/sinhala/">Sinhala keyboards</a></li>
                            <li><a href="/greek/">Greek (Ancient) keyboards</a></li>
                            <li><a href="/tibetan/">Tibetan keyboards</a></li>
                            <li><a href="/urdu/">Urdu keyboard</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="menu-item" id="products">
                <h3>Products<span class="header-triangle"><img src="<?php echo Util::cdn("img/img_trans.png"); ?>" alt="products dropdown" /></span></h3>
                <div class="menu-item-dropdown">
                    <div class="menu-dropdown-inner">
                        <h4>Core Products</h4>
                        <ul>
                            <li><a href="/<?=$fields->lang?>/windows/">Keyman <?=$fields->stable_version?> for Windows</a></li>
                            <li><a href="/<?=$fields->lang?>/mac/">Keyman <?=$fields->stable_version?> for macOS</a></li>
                            <li><a href="/<?=$fields->lang?>/linux/">Keyman <?=$fields->stable_version?> for Linux</a></li>
                            <li><a href="/<?=$fields->lang?>/iphone-and-ipad/">Keyman <?=$fields->stable_version?> for iPhone and iPad</a></li>
                            <li><a href="/<?=$fields->lang?>/android/">Keyman <?=$fields->stable_version?> for Android</a></li>
                            <li><a href="/<?=$fields->lang?>/keymanweb/">KeymanWeb.com</a></li>
                            <li><a href="/<?=$fields->lang?>/bookmarklet/">Keyman Bookmarklet</a></li>
                        </ul>
                        <h4>Downloads</h4>
                        <ul>
                            <li><a href='/<?=$fields->lang?>/downloads/'>Current release versions</a></li>
                            <li><a href='/<?=$fields->lang?>/downloads/pre-release/'>Pre-release versions</a></li>
                            <li><a href="/<?=$fields->lang?>/downloads/archive/">Older versions</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="menu-item" id="tavultesoft">
                <h3>About<span class="header-triangle"><img src="<?php echo Util::cdn("img/img_trans.png"); ?>" alt="About dropdown" /></span></h3>
                <div class="menu-item-dropdown">
                    <div class="menu-dropdown-inner">
                        <ul>
                            <li><a href="/<?=$fields->lang?>/about/">About Keyman</a></li>
                            <li><a href="/<?=$fields->lang?>/about/team">The team</a></li>
                            <li><a href="/<?=$fields->lang?>/<?=$fields->lang?>/about/get-involved">Get Involved</a></li>
                            <li><a href="/<?=$fields->lang?>/<?=$fields->lang?>/training">Training Events</a></li>
                            <li><a href="/<?=$fields->lang?>/<?=$fields->lang?>/free/">Free on all Platforms</a></li>
                            <li><a href="/<?=$fields->lang?>/<?=$fields->lang?>/ldml/">LDML Support</a></li>
                            <li><a href="<<?=$fields->lang?>/?= KeymanHosts::Instance()->help_keyman_com ?>">Help and Documentation</a></li>
                            <li><a href="/<?=$fields->lang?>/contact/">Contact Us</a></li>
                            <li><a href="<?= KeymanHosts::Instance()->blog_keyman_com ?>">Keyman Blog</a></li>
                            <li><a href="/<?=$fields->lang?>/testimonials/">Testimonials</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="menu-item" id="developer">
                <div class="menu-item-sub" id="develop">
                    <a href="/<?=$fields->lang?>/developer/">
                        <h3>Developer</h3>
                    </a>
                </div>
            </div>
        </div>
        <img id="top-menu-bottom" src="<?php echo Util::cdn("img/headerbar.png"); ?>" alt="Header bottom" />
    </div>
    <div id="phone-header-spacer"></div>

<?php
    }
  }
