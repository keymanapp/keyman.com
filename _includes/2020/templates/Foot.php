<?php
  declare(strict_types=1);

  namespace Keyman\Site\com\keyman\templates;

  use Keyman\Site\com\keyman\ImageRandomizer;
  use Keyman\Site\com\keyman\KeymanVersion;
  use Keyman\Site\Common\KeymanHosts;

  class Foot {
    static function render(array $fields = []) {
      $fields = (object)$fields;
      $fields->stable_version = KeymanVersion::stable_version;
      $fields->beta_version = KeymanVersion::beta_version;
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

            <div id='footer-get-involved'>
              <a href="/about/get-involved">Get involved</a>
              <a href='/donate'>Donate</a>
            </div>
        </div>
        <div class="footer-third" id="footer-social">
            <h2 class="footer-third-title">Keep in touch</h2>
            <div>
              <a rel="me" href="https://facebook.com/KeymanApp" target="_blank" data-icon='&#xf203;'>Facebook</a>
              <a rel="me" href="https://twitter.com/keyman" target="_blank" data-icon='&#xf10e;'>X/Twitter</a>
              <a rel="me" href="https://typo.social/@keyman" target="_blank" data-icon='&#xf10a;'>Mastodon</a>
              <a rel="me" href="https://youtube.com/@KeymanApp" target="_blank" data-icon='&#xf213;'>YouTube</a>
              <a href="<?= KeymanHosts::Instance()->blog_keyman_com ?>/" target="_blank" data-icon='&#xf413;'>Keyman blog</a>
              <a rel="me" href="https://github.com/keymanapp" target="_blank" data-icon='&#xf200;'>GitHub</a>
              <a href="https://community.software.sil.org/c/keyman" target="_blank" id='footer-community'>Keyman Community</a>
            </div>
        </div>
        <div class="footer-third sil-logo">
            <br>
            <a href="/about/"><img id="sil-logo" src="<?php echo ImageRandomizer::randomizer("img/sil-logos-2024/"); ?>" width="50%" alt='SIL' /></a>
            <p>Created by <a href="/about/">SIL Global</a></p>
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
<div id="KeymanWebControl"></div>
</body>
</html>
<?php
    }
  }
