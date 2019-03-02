<?php
    global $stable_version;
?>
        </div>
    </div>
</div>
<div class="footer">
    <div class="wrapper">
        <div class="footer-third" id="footer-mailchimp">
            <h2 class="footer-third-title">Keep me updated</h2>
            <!-- Begin MailChimp Signup Form -->
            <div id="mc_embed_signup">
            <form action="//keyman.us1.list-manage.com/subscribe/post?u=99fcab2b035a8a51cd2158ca9&amp;id=7ccdac1e32" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                <div class="mc-field-group">
                    <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="email" />
                </div>
                <div id="mce-responses" class="clear">
                    <div class="response" id="mce-error-response" style="display:none"></div>
                    <div class="response" id="mce-success-response" style="display:none"></div>
                </div>
                <div class="button subscribe">
                    <h2>Subscribe</h2>
                </div>
            </form>
            </div>
            <!--End mc_embed_signup-->
            <br>
            <div id="privacy-policy"><a href="/privacy/">Privacy policy</a></div>
        </div>
        <div class="footer-third" id="footer-social">
            <h2 class="footer-third-title">Keep in touch</h2>
            <div>
              <a href="https://facebook.com/KeymanApp" target="_blank" data-icon='&#xf203;'>Facebook</a>
              <a href="https://twitter.com/keyman" target="_blank" data-icon='&#xf202;'>Twitter</a>
              <a href="https://blog.keyman.com/" target="_blank" data-icon='&#xf413;'>Keyman blog</a>
              <a href="https://github.com/keymanapp" target="_blank" data-icon='&#xf200;'>GitHub</a>
              <a href="https://community.software.sil.org/c/keyman" target="_blank" id='footer-community'>Keyman Community</a>
            </div>
        </div>
        <div class="footer-third sil-logo">
            <br>
            <a href="/about/"><img id="sil-logo" src="<?php echo cdn("img/sil-logo-blue-2017_1.png"); ?>" alt='SIL' /></a>
            <p>Created by <a href="/about/">SIL International</a></p>
        </div>
    </div>
</div>
<div id="install-modal"></div>
<div id="ios-install">
    <p>Do you already have Keyman for iPhone and iPad installed on this device?</p>
    <a id="ios-installed" href="#">Yes - Install Keyboard</a>
    <a id="ios-install-confirm" href="https://itunes.apple.com/us/app/keyman/id721595078">No - Download from the App Store</a>
    <a id="ios-install-cancel" href="#">Cancel</a>
</div>
<div id="android-install">
    <p>Do you already have Keyman for Android installed on this device?</p>
    <a id="android-installed" href="#">Yes - Install Keyboard</a>
    <a id="android-install-confirm" href="market://details?id=com.tavultesoft.kma">No - Download from the Play Store</a>
    <a id="android-install-cancel" href="#">Cancel</a>
</div>
<div id="jira-feedback">
  <div id="jira-feedback-tab"><h4><a href='https://community.software.sil.org/c/keyman'>Support</a></h4></div>
</div>
<div id="product-download-popup">
    <div id="product-download-popup-header">
        <img src="<?php echo cdn('img/download-free-badge.png'); ?>" />
        <p id="product-download-popup-name">Keyboard Download</p>
        <p id="product-download-popup-close">Close</p>
    </div>
    <div id="product-download-popup-body">
        <div id="product-download-popup-instruct">
            <p>Click to install:</p>
            <img id="ie-dl" src="<?php echo cdn('img/ie-dl.png'); ?>" />
            <img id="chrome-dl" src="<?php echo cdn('img/chrome-dl.png'); ?>" />
            <img id="firefox-dl" src="<?php echo cdn('img/firefox-dl.png'); ?>" />
        </div>
        <div id="product-download-popup-links">
            <p>Useful Links:</p>
            <ul>
                <li><a href="http://help.keyman.com/products/desktop/<?php echo $stable_version; ?>/docs/start_download-install_keyman.php" target="_blank">How to Install Keyman Desktop</a></li>
                <li><a href="/contact/" target="_blank">Keyman Desktop Support</a></li>
            </ul>
            <form name="download-signup" id="download-signup" method="post" >
                <p>Sign up for helpful hints and tips:</p>
                <input type="email" name="email" placeholder="email address" />
                <div class="button">
                    <h2>Signup</h2>
                </div>
                <p id="download-signup-response"></p>
            </form>
        </div>
    </div>
</div>
<div id="KeymanWebControl"></div>
</body>
</html>