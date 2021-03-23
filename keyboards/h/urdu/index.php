<?php
  require_once('includes/template.php');
  require_once __DIR__ . '/../../../_includes/autoload.php';
  use Keyman\Site\Common\KeymanHosts;

  // Required
  head([
    'title' =>'Keyman for Urdu',
    'css' => ['template.css','index.css'],
    'showMenu' => true
  ]);
?>
<h2 class="red underline large">Keyman for Urdu</h2>
<p>
    Type in Urdu on iPhone, Windows and Android. Our Urdu keyboard works with Microsoft Word, Photoshop, Facebook, Twitter, email and thousands of other applications. This keyboard layout has been optimised for touch devices!
</p>
<p>
    <a href='<?= KeymanHosts::Instance()->blog_keyman_com ?>/2015/01/an-urdu-keyboard-layout-optimised-for-small-touch-devices/'>Read more on our blog</a>
</p>
<div id="download-cta" data-language='ur' data-keyboard='basic_kbdurdu'>
  <div class="download-cta-big" id="cta-big-Holder">
    <img src="<?php echo cdn('img/wait.gif'); ?>" />
  </div>
  <div class="download-cta-big Windows" id="cta-big-Windows">
    <h3>Urdu for Keyman for Windows</h3>
    <p>
      Type in Urdu in all your favourite software applications for Windows. Keyman for Windows will automatically configure your system for the Urdu language.
    </p>
    <div class="download-stable-email">
      <div class="download-cta-button">
        <h4>Download Now</h4>
      </div>
      <a class="download-cta-more" href="/windows/">Learn more about Keyman for Windows</a>
    </div>
  </div>
  <div class="download-cta-big mac" id="cta-big-mac">
    <h3>Urdu Keyman for macOS</h3>
    <p>
      Type in Urdu in all your favourite software applications for macOS. Download <a href="/mac/">Keyman
      for macOS</a> first
    </p>
    <div class="download-cta-button">
      <h4>Download Now</h4>
    </div>
    <a class="download-cta-more" href="/mac/">Learn more about Keyman for macOS</a>
  </div>
  <div class="download-cta-big iPhone" id="cta-big-iPhone">
    <h3>Urdu Keyman for iPhone</h3>
    <div class="download-cta-button">
      <h4>Download for iPhone</h4>
    </div>
    <p>
      Type in Urdu on your iPhone.  Keyman brings the iPhone language experience to life, adding the language and font support for Urdu that even Apple don't!
    </p>
  </div>
  <div class="download-cta-big iPad" id="cta-big-iPad">
    <h3>Urdu Keyman for iPad</h3>
    <div class="download-cta-button">
      <h4>Download for iPad</h4>
    </div>
    <p>
      Type in Urdu on your iPad.  Keyman brings the iPad language experience to life, adding the language and font support for Urdu that even Apple don't!
    </p>
  </div>
  <div class="download-cta-big Android" id="cta-big-Android">
    <h3>Urdu Keyman for Android</h3>
    <div class="download-cta-button">
      <h4>Download for Android</h4>
    </div>
    <p>
      Type in Urdu on your Android device. Touch enabled keyboards for phone, 7-inch and 10-inch tablets ensure a seamless typing solution across any Android device.
    </p>
  </div>

  <div class="download-cta-big" id="cta-big-Web">
    <h3>Type Urdu in your Browser</h3>
    <p>
      Type Urdu online in your browser with keymanweb.com, no download required.
    </p>
    <div class="download-cta-button" id="cta-button-web">
      <h4>Start Typing!</h4>
    </div>
  </div>

  <h3 id="cta-other-downloads">Download an Urdu keyboard on these devices:</h3>

  <div class="download-cta-small iPhone" id="cta-iPhone">
    <a href="/iphone/">
      <img src="<?php echo cdn('img/cta-icons/icon-iphone.png'); ?>" />
      <p>iPhone</p>
    </a>
  </div>
  <div class="download-cta-small iPad" id="cta-iPad">
    <a href="/ipad/">
      <img src="<?php echo cdn('img/cta-icons/icon-ipad.png'); ?>" />
      <p>iPad</p>
  </div>
  <div class="download-cta-small Android" id="cta-Android">
    <a href="/android/">
      <img src="<?php echo cdn('img/cta-icons/icon-android.png'); ?>" />
      <p>Android</p>
    </a>
  </div>
  <!--<div class="download-cta-small Bookmarklet" id="cta-Bookmarklet">
    <a href="/bookmarklet/">
      <img src="<?php echo cdn('img/cta-icons/icon-bookmarklet.png'); ?>" />
      <p>Bookmarklet</p>
    </a>
  </div>-->
</div>
<div class="spacer"></div>
<h2 class='red underline'>Screenshots</h2>
<h3>Urdu on Windows</h3>
<img src="<?php echo cdn('img/urdu-desktop.png'); ?>"' />
<br/><br/>
<h3>Urdu on iPhone</h3>
<img src="<?php echo cdn('img/urdu-keyboard-iphone5-small.png'); ?>" />
<h2 class="red underline">Frequently Asked Questions</h2>
<ul id="faq">
  <li>
    <span class="question">Which font should I use in Microsoft Word and other programs on Windows?</span><br>
    <span class="answer">We recommend you use the new Google Noto Nastaliq Urdu Draft font:</span>
    <table id="ethiopic-fonts" >
      <tbody>
        <tr>
          <th><a target='_blank' href='http://www.google.com/get/noto/#/family/noto-nastaliq-aran'>Noto Nastaliq Urdu Draft</a></th>
          <td>
            <img alt="Noto Nastaliq Urdu Draft Font Sample" style='width:70%; padding: 0 32px 8px 0; background: white;' src="<?php echo cdn('img/noto-nastaliq-aran_ur_400_normal.png'); ?>" />
          </td>
        </tr>
      </tbody>
    </table>
    <span class="answer">The Noto Nastaliq Urdu Draft font is included in the Urdu keyboard download for Keyman for Windows. Find other supported Urdu fonts on your computer by <a href="<?= KeymanHosts::Instance()->help_keyman_com ?>/products/desktop/10.0/docs/start_font.php">using the Font Helper tool.</a></span>
  </li>
  <li>
    <span class="question">What layout does this keyboard use?</span><br>
    <span class="answer">
      This keyboard follows the Urdu typewriter layout, and on small touch devices has been adapted to reduce the number of keys on each layer for usability reasons.
    </span>
  </li>
</ul>

<div id='info'>
  <h2 class="red underline">More Information</h2>

  <p>For technical support, please <a href='https://community.software.sil.org/c/keyman'>visit our forums</a> online.</p>

  <p><a href='<?= KeymanHosts::Instance()->help_keyman_com ?>/keyboard/kbdurdu'>Urdu Keyboard Documentation</a></p>

  <p><a href='<?= KeymanHosts::Instance()->blog_keyman_com ?>/2015/01/an-urdu-keyboard-layout-optimised-for-small-touch-devices/'>Read more about this keyboard on our blog</a></p>
</div>
