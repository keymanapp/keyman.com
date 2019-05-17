<?php
  global $stable_version, $beta_version;
?>
<div id="container" class="page-<?=$pageClass?>">
    <div class="header">
        <img id="show-phone-menu" src="<?php echo cdn("img/phonehide.png"); ?>" />
        <a id="home-link" href="/"><img id="logo" src="<?php echo cdn("img/logo2.png"); ?>" alt='Keyman Logo' /></a>
        <img id="header-bottom" src="<?php echo cdn("img/headerbar.png"); ?>" alt='Header bottom' />
        <div id="help">
    
          <form action="/search/" method="get" role="search">
            <div class="search-wrap">
              <label for="main-q" class="offscreen">Search</label>
              <input type="search" id="main-q" name="q" placeholder="Search" data-value="" value="" />
              <button type="submit" class="offscreen">Search</button>
            </div>
          </form>
          <p id="donate"><a href="/donate">Donate</a></p>
          <p><a href="https://help.keyman.com" target="blank">Support<img src="<?php echo cdn("img/helpIcon.png"); ?>"></a></p>
        </div>
    </div>
    <div id="top-menu-bg"></div>
    <div id="top-menu1">
        <a href="/"><img id="top-menu-icon" src="<?php echo cdn("img/icon1.png"); ?>" /></a>
        <div id='help1'>
          <form action="/search/" method="get" role="search">
            <div class="search-wrap">
              <label for="main-q" class="offscreen">Search</label>
              <input type="search" id="main-q" name="q" placeholder="Search" data-value="" value="" />
              <button type="submit" class="offscreen">Search</button>
            </div>
          </form>
          <a id='help1-donate' href="/donate">Donate</a>        
          <a href="https://help.keyman.com"><img id="top-menu-icon2" src="<?php echo cdn("img/helpIcon.png"); ?>" /></a>
        </div>
        <div class="wrapper">
            <div class="menu-item" id="keyboards">
                <h3>Keyboards<span class="header-triangle"><img src="<?php echo cdn("img/img_trans.png"); ?>" /></span></h3>
                <div class="menu-item-dropdown">
                    <div class="menu-dropdown-inner">
                        <h4>Find a Keyboard (1000+)</h4>
                        <form method="get" action="/keyboards" name="fsearch">
                            <input id="language-search" type="text" placeholder="Enter language" name="q">
                            <input id="search-submit" type="image" src="<?php echo cdn('img/search-button.png'); ?>" value="Search" onclick="if(document.getElementById('language-search').value==''){return false;}">
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
                <h3>Products<span class="header-triangle"><img src="<?php echo cdn("img/img_trans.png"); ?>" /></span></h3>
                <div class="menu-item-dropdown">
                    <div class="menu-dropdown-inner">
                        <h4>Core Products</h4>
                        <ul>
                            <li><a href="/desktop/">Keyman Desktop <?=$stable_version?></a></li>
                            <li><a href="/mac/">Keyman <?=$stable_version?> for macOS</a></li>
                            <li><a href="/linux/">Keyman for Linux <?=$stable_version?></a></li>
                            <li><a href="/iphone-and-ipad/">Keyman for iPhone and iPad <?=$stable_version?></a></li>
                            <li><a href="/android/">Keyman for Android <?=$stable_version?></a></li>
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
                <h3>About<span class="header-triangle"><img src="<?php echo cdn("img/img_trans.png"); ?>" /></span></h3>
                <div class="menu-item-dropdown">
                    <div class="menu-dropdown-inner">
                        <ul>
                            <li><a href="/about/">About Keyman</a></li>
                            <li><a href="/about/get-involved">Get Involved</a></li>
                            <li><a href="/free/">Free on all Platforms</a></li>
                            <li><a href="http://help.keyman.com">Help and Documentation</a></li>
                            <li><a href="/contact/">Contact Us</a></li>
                            <li><a href="https://blog.keyman.com/">Keyman Blog</a></li>
                            <li><a href="/testimonials/">Testimonials</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--            <div class="menu-item" id="account">
                <h3>Account<span class="header-triangle"><img src="<?php echo cdn("img/img_trans.png"); ?>" /></span></h3>
                <div class="menu-item-dropdown">
                    <div class="menu-dropdown-inner">
                        <ul>
                            <li><a href="/account/home/profile/">Update Profile</a></li>
                            <li><a href="/account/home/">My Account</a></li>
                        </ul>
                    </div>
                </div>
            </div>-->
            <div class="menu-item" id="developer">
                <div class="menu-item-sub" id="develop">
                    <a href="/developer/">
                        <h3>Developer</h3>
                    </a>
                </div>
            </div>
        </div>
        <img id="top-menu-bottom" src="<?php echo cdn("img/headerbar.png"); ?>" />
    </div>
    <div id="phone-header-spacer"></div>