<?php
  global $stable_version, $beta_version;
  if(!isset($device)){
    $device = '';
 }
?>
<body data-device="<?php echo $device; ?>">
<div id="phone-menu">
    <div id="phone-menu-inner">
        <div class="phone-menu-item">
            <h3>Keyboards</h3>
            <form method="get" action="/keyboards" name="fsearch">
                <input id="language-search2" type="text" placeholder="Enter language" name="q">
                <input id="search-submit2" type="image" src="<?php echo cdn("img/search-button.png"); ?>" value="Search" onclick="if(document.getElementById('language-search2').value==''){return false;}">
            </form>
        </div>
        <div class="phone-menu-item">
            <h3>Products</h3>
            <ul>
                <li><a href="/desktop/">Keyman Desktop <?=$stable_version?></a></li>
                <li><a href="/mac/">Keyman <?=$stable_version?> for macOS</a></li>
                <li><a href="/linux/">Keyman for Linux <?=$stable_version?></a></li>
                <li><a href="/keymanweb/">KeymanWeb.com</a></li>
                <li><a href="/iphone/">Keyman for iPhone</a></li>
                <li><a href="/ipad/">Keyman for iPad</a></li>
                <li><a href="/android/">Keyman for Android</a></li>
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
                <li><a href="/developer/">Keyman Developer <?=$stable_version?></a></li>
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
              <li><a href="/contact/">Contact Us</a></li>
              <li><a href="https://blog.keyman.com">Keyman Blog</a></li>
              <li><a href="/testimonials/">Testimonials</a></li>
              <li><a href="/search/">Search Site</a></li>
           </ul>
        </div>
        <div class="phone-menu-item">
            <h3>Help</h3>
            <ul>
                <li><a href="https://help.keyman.com">Help and Documentation</a></li>
           </ul>
        </div>
    </div>
</div>