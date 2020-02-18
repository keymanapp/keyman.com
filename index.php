<?php
    require_once('includes/template.php');
  
  // Required
  head([
    'title' =>'Keyman | Type to the world in your language',
    'css' => ['template.css','index.css'],
    'showMenu' => true,
    'addSection2' => false
  ]);
?>
    </div>
</div>
    <div class="main1">
        <h1>Type to the world<br/> in your language</h1>
        <img id="main-banner" src="<?php echo cdn("img/banner.png"); ?>" alt='More than 1000 languages supported' />
    </div>
    <div class="main2">
    
        <!-- event banner: uncomment this section when we have an event or promotion -->
        <div class="section section-announcement">
          <div class='wrapper'>
            <p style='font-size:2em'><a href='/13/'>New: Keyman 13.0 is now in Beta!</a></p>
          </div>
        </div>
        <!-- -->
    
        <div class="section section-languages">
            <div class="wrapper">
                <h2 class="section-heading">Choose a keyboard for your language</h2>
                <p class="section-explainer">Select a language to download a suitable keyboard for your device. We've listed some of the more popular below, if yours isn't there, use the search tool to find it.</p>

                <?php require_once('includes/ui/download-links.php'); ?>
                
                <form name="fsearch" action="/keyboards" method="get">
                    <h4>Search over 1000 languages</h4>
                    <input type="text" name="q" id="language-search3" placeholder="Enter your language" />
                    <input id="search-submit3" type="image" onclick="if(document.getElementById('language-search3').value==''){return false;}" value="Search" src="<?php echo cdn("img/search-button.png"); ?>">
                </form>
            </div>
        </div>
        <div class="section section-products">
            <div class="wrapper">
                <h2 class="section-heading">Core products</h2>
                <p class="section-explainer">Keyman makes it possible for you to type in over 1,000 languages on
                  Windows, macOS, Linux, iPhone, iPad, Android tablets and phones, and even instantly in your web browser.
                  With the world’s most powerful keyboarding engine, intuitive and rapid text input is now possible in
                  your language, and for over 99% of the global population’s mother tongues!</p>
                <div class="product" id="product-desktop">
                    <a href="/desktop">
                        <img src="<?php echo cdn("img/icon-desktop.png"); ?>" />
                        <h3>Keyman Desktop <?php echo $stable_version; ?></h3>
                        <p>
                            Type in your language in all your favourite software applications for Windows.  Keyman Desktop will automatically configure your system for your language.
                        </p>
                    </a>
                </div>
                <div class="product" id="product-mac">
                    <a href="/mac">
                        <img src="<?php echo cdn("img/icon-mac.png"); ?>" />
                        <h3>Keyman for macOS</h3>
                        <p>
                            Type in your language in all your favourite software applications for macOS.
                        </p>
                    </a>
                </div>
                <div class="product" id="product-linux">
                    <a href="/linux">
                        <img src="<?= cdn("img/icon-tux.png"); ?>" />
                        <h3>Keyman for Linux</h3>
                        <p>
                            Type in your language in all your favourite software applications for Linux.
                        </p>
                    </a>
                </div>
                <div class="product" id="product-web">
                    <a href="/web">
                        <img src="<?php echo cdn("img/icon-web.png"); ?>" />
                        <h3>keymanweb.com</h3>
                        <p>
                            Type instantly in your web browser and post to Facebook, Google and more, or copy and paste to use the text anywhere!  No download or configuration is required.
                        </p>
                    </a>
                </div>
                <div class="product" id="product-iphone">
                    <a href="/iphone-and-ipad">
                        <img src="<?php echo cdn("img/icon-iphone.png"); ?>" />
                        <h3>Keyman for iPhone and iPad</h3>
                        <p>
                            Type in your language on your iPhone or iPad.  Keyman brings the language experience to life, adding support for many languages and scripts that Apple do not support!
                        </p>
                    </a>
                </div>
                <div class="product" id="product-android">
                    <a href="/android">
                        <img src="<?php echo cdn("img/icon-android2.png"); ?>" />
                        <h3>Keyman for Android</h3>
                        <p>
                            Type in over 600 languages on your Android device. Touch enabled keyboards for phone, 7-inch and 10-inch tablets ensure a seamless typing solution across any Android device.
                        </p>
                    </a>
                </div>
                <div class="product" id="product-bookmarklet">
                    <a href="/bookmarklet">
                        <img src="<?php echo cdn("img/icon-bookmarklet.png"); ?>" />
                        <h3>Keyman Bookmarklet</h3>
                        <p>
                            Add the Keyman Bookmarklet to your web browser to type in your language on every website you visit.
                        </p>
                    </a>
                </div>
            </div>
        </div>
        <div class="wrapper">
            <div class="section section-testimonials">
                <div>“</div>
                <p id="testimonial">
                    <!-- https://twitter.com/ibrahimasaar/status/1161753102527193088 -->
                    Both Ukelele and MSKLC are useful in allowing quick and easy creation of keyboards but I really
                    think #keyman is a much more complex tool in that it allows to develop for multiple platforms
                    especially mobile.
                </p>
                <p id="twitter-testimonial">
                  <span>&mdash; @ibrahimasaar - Le Havre</span>
                </p>
            </div>
        </div>
        <div class="section section-developers">
            <div class="wrapper">
                <h2 class="section-heading">Developer Tools</h2>
                <div class="developer-half" id="product-developer">
                    <a href="/developer">
                        <img src="<?php echo cdn("img/icon-developer.png"); ?>" />
                        <h3>Keyman Developer</h3>
                        <p>
                            Create keyboard layouts for every major operating system and device.
                        </p>
                    </a>
                </div>
                <div class="developer-half" id="product-engine">
                    <a href="/engine">
                        <img src="<?php echo cdn("img/icon-engine.png"); ?>" />
                        <h3>Keyman Engine</h3>
                        <p>
                            Integrate custom keyboard layouts into your apps and websites.
                        </p>
                    </a>
                </div>
            </div>
        </div>
    </div>
