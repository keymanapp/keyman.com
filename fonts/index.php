<?php
  require_once('includes/template.php');
  require_once __DIR__ . '/../_includes/autoload.php';
  use Keyman\Site\Common\KeymanHosts;

  // Required
  head([
    'title' =>'Keyman Font Support',
    'css' => ['template.css'],
    'showMenu' => true,
    'banner' => [
      'title' => 'Font support for all devices',
      'image' => 'gears.png',
      'background' => 'water'
    ]
  ]);
?>
<h2 class="red underline">How to fix square boxes</h2>
<p>
  If you've read or received a message via Keyman that is displayed as square boxes, the most likely cause is that your device does not support the language or script. The Keyman range of products for desktop, web and mobile can help!
  <br/><br/>
  <a href="../desktop">Get Keyman Desktop for Windows</a>
  <br/>
  <a href="../mac">Get Keyman for macOS</a>
  <br/>
  <a href="../web">Use keymanweb.com</a>
  <br/>
  <a href="https://itunes.apple.com/us/app/keyman/id721595078">Download Keyman for iPhone and iPad</a>
  <br/>
  <a href="https://play.google.com/store/apps/details?id=com.tavultesoft.kmapro">Download Keyman for Android</a>
</p>

<h2 class="red underline">Keyman Fonts for iPhone and iPad (iOS 7 onwards)</h2>
<p>
  Some keyboards require special fonts that do not come standard with your iPhone or iPad. For keyboards that use these fonts, the Keyman app will provide a download of the font to install onto your device, meaning all apps will be able to correctly display the font.
</p>
<p class="center">
  To install the font, touch <span class="command">Install</span>.
  <br/>
  <img src="<?php echo cdn("img/app/font-dl1.png"); ?>" />
  <br/><br/>
  You will then be taken to your device settings, and asked to install a profile for the font. Touch <span class="command">Install</span>.
  <br/>
  <img src="<?php echo cdn("img/app/font-dl2.png"); ?>" />
  <br/><br/>
  Then <span class="command">Install</span> again in the Consent page.
  <br/>
  <img src="<?php echo cdn("img/app/font-dl3.png"); ?>" />
  <br/><br/>
  Once the profile is installed, touch <span class="command">Done</span>.
  <br/>
  <img src="<?php echo cdn("img/app/font-dl4.png"); ?>" />
  <br/><br/>
  And then <span class="command">Touch now to return to Keyman</span>.
  <br/>
  <img src="<?php echo cdn("img/app/font-dl5.png"); ?>" />
  <br/><br/>
  The font is now successfully installed, and will display correctly throughout your device!
</p>

<h2 class="red underline">Keyman Fonts for web</h2>
<p class="center">
  To display fonts correctly on desktop web browsers, you can install the suitable Keyman Bookmarklet for the language. This will install the required font:
  <br/>
  <img src="<?php echo cdn("img/app/bookmarklet.png"); ?>" />
  <br/><br/>
  <a href="../bookmarklet">Find and install a bookmarklet now.</a>
</p>

<h2 class="red underline">Keyman Fonts for desktop</h2>
<p>
  Many Keyman keyboards type out letters that need special fonts. Without the right font, these letters may turn into square boxes or become unreadable. Keyman Desktop keyboards that require a special font will generally come packaged with the font. You can also use the Keyman Font Helper tool to find suitable fonts for your keyboard.
  <br/><br/>
  <a href="<?= KeymanHosts::Instance()->help_keyman_com ?>/products/desktop/<?php echo $stable_version; ?>/docs/basic_fonthelper.php">Learn more about the Font Helper tool.</a>
</p>
