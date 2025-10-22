<?php
require_once('includes/template.php');
require_once __DIR__ . '/_includes/autoload.php';

// Required
head([
    'title' =>'Keyman | Type to the world in your language',
    'description' => 'Unlock the power of your language with Keyman customizable keyboard software.
       Available for Windows, Mac, Linux, Android, iPhone, and web,
       we support over 2,000 languages to make communication seamless and meaningful.',
    'css' => ['template.css','index.css'],
    'showMenu' => true,
    'addSection2' => false
]);
?>
</div>
</div>
<div class="main1">
    <h1>Type to the world<br/> in your language</h1>
    <img id="main-banner" src="<?php echo cdn("img/banner.png"); ?>" alt='More than 2500 languages supported' />
</div>
<div class="main2">
<!--
    <div class="home-page-video">
        <div class="home-page-video-container">
            <div id="splash-video"></div>
        </div>
    </div>
    <script src="https://player.vimeo.com/api/player.js"></script>
    <script>
        var options={
            url: 'https://player.vimeo.com/video/708800585?h=0c119bfc6b',
            title: false,
            pip: false,
            byline: false,
            responsive: true,
            portrait: false,
            // controls: false,
        };
        var videoPlayer = new Vimeo.Player('splash-video', options);
    </script>
-->
    <div class="section section-blurb">
        <div class='wrapper'>
            <p>
                Keyman helps you type in over 2500 languages on
                just about any device &mdash; Windows, macOS, Linux, iPhone, iPad, Android tablets and phones, and even instantly in your web browser.
                Keyman is completely <a href="/free">free and open source</a>!
            </p>
        </div>
    </div>

    <div class="section">
      <div class='wrapper' id='attributions'>
        <p><a href='https://commons.wikimedia.org/wiki/File:Noun_project_Globe_icon_1109009.png'>Globe icon</a> courtesy of Adnen Kadri, under
        <a href='https://creativecommons.org/licenses/by/3.0/deed.en'>Creative Commons Attribution 3.0 Unported licence</a>.</p>
      </div>
    </div>

    <!-- event banner: uncomment this section when we have an event or promotion -
    <div class="section section-announcement">
          <div class='wrapper'>
            <p style='font-size:2em'><a href='/15'>New: Keyman 15 is released!!</a></p>
          </div>
        </div>
    -->

    <div class="section section-languages">
        <div class="wrapper">
            <h2 class="section-heading">Choose a keyboard for your language</h2>
            <p class="section-explainer">Select a language to download a suitable keyboard for your device. We've listed some of the more popular below, if yours isn't there, use the search tool to find it.</p>

            <?php require_once('includes/ui/download-links.php'); ?>

            <form name="fsearch" action="/keyboards" method="get">
                <h4>Search over 2500 languages</h4>
                <input type="text" name="q" id="language-search3" placeholder="Enter your language" />
                <input id="search-submit3" type="image" onclick="if(document.getElementById('language-search3').value==''){return false;}" value="Search" src="<?php echo cdn("img/search-button.png"); ?>" alt="Search button">
            </form>
        </div>
    </div>
    <div class="section section-products">
        <div class="wrapper">
            <h2 class="section-heading">Core products</h2>
            <p class="section-explainer">
                With the world’s most powerful keyboarding engine, intuitive and rapid text input is now possible in
                your language, and for over 99% of the global population’s mother tongues!</p>
            <div class="product" id="product-desktop">
                <a href="/windows">
                    <img src="<?php echo cdn("img/icon-desktop.png"); ?>" alt="Windows logo" />
                    <h3>Keyman for Windows</h3>
                    <p>
                        Type in your language in all your favourite software applications for Windows.  Keyman for Windows will automatically configure your system for your language.
                    </p>
                </a>
            </div>
            <div class="product" id="product-mac">
                <a href="/mac">
                    <img src="<?php echo cdn("img/icon-mac.png"); ?>" alt="macOS logo" />
                    <h3>Keyman for macOS</h3>
                    <p>
                        Type in your language in all your favourite software applications for macOS.
                    </p>
                </a>
            </div>
            <div class="product" id="product-linux">
                <a href="/linux">
                    <img src="<?= cdn("img/icon-tux.png"); ?>" alt="Linux logo" />
                    <h3>Keyman for Linux</h3>
                    <p>
                        Type in your language in all your favourite software applications for Linux.
                    </p>
                </a>
            </div>
            <div class="product" id="product-android">
                <a href="/android">
                    <img src="<?php echo cdn("img/icon-android2.png"); ?>" alt="Android logo" />
                    <h3>Keyman for Android</h3>
                    <p>
                        Type in over 2500 languages on your Android device. Touch enabled keyboards for phone, 7-inch and 10-inch tablets ensure a seamless typing solution across any Android device.
                    </p>
                </a>
            </div>
            <div class="product" id="product-iphone">
                <a href="/iphone-and-ipad">
                    <img src="<?php echo cdn("img/icon-iphone.png"); ?>" alt="Keyman for iPhone and iPad screenshot" />
                    <h3>Keyman for iPhone and iPad</h3>
                    <p>
                        Type in your language on your iPhone or iPad.  Keyman brings the language experience to life, adding support for many languages and scripts that Apple do not support!
                    </p>
                </a>
            </div>
            <div class="product" id="product-web">
                <a href="/web">
                    <img src="<?php echo cdn("img/icon-web.png"); ?>" alt="various browser logos" />
                    <h3>keymanweb.com</h3>
                    <p>
                        Type instantly in your web browser and post to Facebook, Google and more, or copy and paste to use the text anywhere!  No download or configuration is required.
                    </p>
                </a>
            </div>
            <div class="product" id="product-bookmarklet">
                <a href="/bookmarklet">
                    <img src="<?php echo cdn("img/icon-bookmarklet.png"); ?>" alt="Hebrew Keyboard bookmarklet" />
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
                Such great software. Thanks for supporting those who need to enter text in 100’s of less-widely-supported languages.
            </p>
            <p id="twitter-testimonial" data-href="https://twitter.com/simoncaudwell/status/1372154283613884425">
                <span>&mdash; @simoncaudwell, 17 Mar 2021</span>
            </p>
        </div>
    </div>
    <div class="section section-developers">
        <div class="wrapper">
            <h2 class="section-heading">Developer Tools</h2>
            <div class="developer-half" id="product-developer">
                <a href="/developer">
                    <img src="<?php echo cdn("img/icon-developer.png"); ?>" alt="Keyman logo" />
                    <h3>Keyman Developer</h3>
                    <p>
                        Create keyboard layouts for every major operating system and device.
                    </p>
                </a>
            </div>
            <div class="developer-half" id="product-engine">
                <a href="/engine">
                    <img src="<?php echo cdn("img/icon-engine.png"); ?>" alt="Gears" />
                    <h3>Keyman Engine</h3>
                    <p>
                        Integrate custom keyboard layouts into your apps and websites.
                    </p>
                </a>
            </div>
        </div>
    </div>
</div>
