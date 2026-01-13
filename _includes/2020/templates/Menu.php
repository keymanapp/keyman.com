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

      if (!empty($parts['query'])) {
        parse_str($parts['query'], $queryParams);
      } else {
        $queryParams = [];
      }

      // Set the language query
      $queryParams['lang'] = $language;
      $query = http_build_query($queryParams);

      return $parts['path'] . "?" . $query;
    }

    /**
     * Render the globe dropdown for changing the UI language
     * As UI languages get added, we'll need to update this.
     * Limitation: Currently only visible on pages that use localized strings
     * @param number - Div number, default 0.
     */
    private static function render_globe_dropdown($number = 0): void {
      global $page_is_using_locale;
      if (!isset($page_is_using_locale) || !$page_is_using_locale) {
        // only render on pages that use localized strings
        return;
      }

      $divID = ($number == 1) ? "ui-language1" : "ui-language";
echo <<<END
          <p>
            <div id='$divID' class="menu-item">
END;
?>
              <img src="<?php echo Util::cdn("img/globe.png"); ?>" alt="UI globe dropdown" />
              <div class="menu-item-dropdown">
                <div class="menu-dropdown-inner">
                  <ul>
                    <!-- Just use autonyms -->
                    <li><a href="<?= Menu::change_ui_language('en'); ?>">English</a></li>
                    <li><a href="<?= Menu::change_ui_language('es'); ?>">Español</a></li>
                    <li><a href="<?= Menu::change_ui_language('fr'); ?>">Français</a></li>
                    <li><a href="<?= Menu::change_ui_language('km'); ?>">ខ្មែរ</a></li>
                  </ul>
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
            <form method="get" action="/keyboards" name="fsearch">
                <input id="language-search2" type="text" placeholder="Enter language" name="q">
                <input id="search-submit2" type="image" src="<?php echo Util::cdn("img/search-button.png"); ?>" alt="search button" value="Search" onclick="if(document.getElementById('language-search2').value==''){return false;}">
            </form>
        </div>
        <div class="phone-menu-item">
            <h3>Products</h3>
            <ul>
                <li><a href="/windows/">Keyman <?=$fields->stable_version?> for Windows</a></li>
                <li><a href="/mac/">Keyman <?=$fields->stable_version?> for macOS</a></li>
                <li><a href="/linux/">Keyman <?=$fields->stable_version?> for Linux</a></li>
                <li><a href="/keymanweb/">KeymanWeb.com</a></li>
                <li><a href="/iphone/">Keyman <?=$fields->stable_version?> for iPhone</a></li>
                <li><a href="/ipad/">Keyman <?=$fields->stable_version?> for iPad</a></li>
                <li><a href="/android/">Keyman <?=$fields->stable_version?> for Android</a></li>
                <li><a href="/bookmarklet/">Keyman Bookmarklet</a></li>
            </ul>
            <h3>Downloads</h3>
            <ul>
                <li><a href='/downloads/'>Current release versions</a></li>
                <li><a href='/downloads/pre-release/'>Pre-release versions</a></li>
                <li><a href="/downloads/archive/">Older versions</a></li>
            </ul>
        </div>
        <div class="phone-menu-item">
            <h3>Developer Tools</h3>
            <ul>
                <li><a href="/developer/">Keyman Developer <?=$fields->stable_version?></a></li>
                <li><a href="/engine/">Keyman Engine for Desktop</a></li>
                <li><a href="/engine/">Keyman Engine for Web</a></li>
                <li><a href="/engine/">Keyman Engine for iOS</a></li>
                <li><a href="/engine/">Keyman Engine for Android</a></li>
            </ul>
        </div>
        <div class="phone-menu-item">
            <h3>About</h3>
            <ul>
              <li><a href="/about/">About Keyman</a></li>
              <li><a href="/about/get-involved">Get Involved</a></li>
              <li><a href="/training">Training Events</a></li>
              <li><a href="/free/">Free on all Platforms</a></li>
              <li><a href="/ldml/">LDML Support</a></li>
              <li><a href="/contact/">Contact Us</a></li>
              <li><a href="<?= KeymanHosts::Instance()->blog_keyman_com ?>">Keyman Blog</a></li>
              <li><a href="/testimonials/">Testimonials</a></li>
              <li><a href="/search/">Search Site</a></li>
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

          <form action="/search/" method="get" role="search">
            <div class="search-wrap">
              <label for="main-q" class="offscreen">Search</label>
              <input type="search" id="main-q" name="q" placeholder="Search" data-value="" value="" />
              <button type="submit" class="offscreen">Search</button>
            </div>
          </form>
          <p id="donate"><a href="/donate">Donate</a></p>
          <p><a href="<?= KeymanHosts::Instance()->help_keyman_com ?>" target="blank">Support<img src="<?php echo Util::cdn("img/helpIcon.png"); ?>" alt="help icon"></a></p>
          <?php
            Menu::render_globe_dropdown();
?>
        </div>
    </div>
    <div id="top-menu-bg"></div>
    <div id="top-menu1">
        <a href="/"><img id="top-menu-icon" src="<?php echo Util::cdn("img/icon1.png"); ?>" alt="Keyman logo" /></a>
        <div id='help1'>
          <form action="/search/" method="get" role="search">
            <div class="search-wrap">
              <label for="main-q" class="offscreen">Search</label>
              <input type="search" id="main-q" name="q" placeholder="Search" data-value="" value="" />
              <button type="submit" class="offscreen">Search</button>
            </div>
          </form>
          <a id='help1-donate' href="/donate">Donate</a>
          <a href="<?= KeymanHosts::Instance()->help_keyman_com ?>"><img id="top-menu-icon2" src="<?php echo Util::cdn("img/helpIcon.png"); ?>" alt="help icon" /></a>
<?php
            Menu::render_globe_dropdown(1);
?>
        </div>
        <div class="wrapper">
            <div class="menu-item" id="keyboards">
                <h3>Keyboards<span class="header-triangle"><img src="<?php echo Util::cdn("img/img_trans.png"); ?>" alt="keyboards dropdown" /></span></h3>
                <div class="menu-item-dropdown">
                    <div class="menu-dropdown-inner">
                        <h4>(2500+ languages)</h4>
                        <form method="get" action="/keyboards" name="fsearch">
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
                            <li><a href="/windows/">Keyman <?=$fields->stable_version?> for Windows</a></li>
                            <li><a href="/mac/">Keyman <?=$fields->stable_version?> for macOS</a></li>
                            <li><a href="/linux/">Keyman <?=$fields->stable_version?> for Linux</a></li>
                            <li><a href="/iphone-and-ipad/">Keyman <?=$fields->stable_version?> for iPhone and iPad</a></li>
                            <li><a href="/android/">Keyman <?=$fields->stable_version?> for Android</a></li>
                            <li><a href="/keymanweb/">KeymanWeb.com</a></li>
                            <li><a href="/bookmarklet/">Keyman Bookmarklet</a></li>
                        </ul>
                        <h4>Downloads</h4>
                        <ul>
                            <li><a href='/downloads/'>Current release versions</a></li>
                            <li><a href='/downloads/pre-release/'>Pre-release versions</a></li>
                            <li><a href="/downloads/archive/">Older versions</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="menu-item" id="tavultesoft">
                <h3>About<span class="header-triangle"><img src="<?php echo Util::cdn("img/img_trans.png"); ?>" alt="About dropdown" /></span></h3>
                <div class="menu-item-dropdown">
                    <div class="menu-dropdown-inner">
                        <ul>
                            <li><a href="/about/">About Keyman</a></li>
                            <li><a href="/about/get-involved">Get Involved</a></li>
                            <li><a href="/training">Training Events</a></li>
                            <li><a href="/free/">Free on all Platforms</a></li>
                            <li><a href="/ldml/">LDML Support</a></li>
                            <li><a href="<?= KeymanHosts::Instance()->help_keyman_com ?>">Help and Documentation</a></li>
                            <li><a href="/contact/">Contact Us</a></li>
                            <li><a href="<?= KeymanHosts::Instance()->blog_keyman_com ?>">Keyman Blog</a></li>
                            <li><a href="/testimonials/">Testimonials</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="menu-item" id="developer">
                <div class="menu-item-sub" id="develop">
                    <a href="/developer/">
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
