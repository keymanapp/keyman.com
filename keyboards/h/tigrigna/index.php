<?php
  require_once('includes/template.php');
  require_once __DIR__ . '/../../../_includes/autoload.php';
  use Keyman\Site\Common\KeymanHosts;

  // Required
  head([
    'title' =>'Tigrigna (Ethiopia) Keyboards for Keyman',
    'description' => 'Free and open source Tigrigna (Ethiopia) keyboard layouts for Windows, macOS, Linux, Android, iOS and web',
    'css' => ['template.css','index.css'],
    'showMenu' => true
  ]);
?>
<h1 class="red underline large">Tigrigna (Ethiopia) Keyboards for Keyman<span lang="ti" class="lang-example large"></span></h1>
<p>
    Type in Tigrigna on iPhone, iPad, Windows, macOS, Linux, and Android. Our Tigrigna keyboards works with Microsoft Word, Photoshop, Facebook, Twitter, email and thousands of other applications.
</p>
<p>
  <a href="eritrean.php">Click here</a> for Tigirigna (Eritrea)
</p>
<img id="ezana-stone" style="height:488px" src="<?php echo cdn('img/ezana.jpg'); ?>" title="The Ezana Stone — Image Courtesy of A. Davey" />
<div id="download-cta" data-language='ti' data-keyboard='gff_tigrinya_ethiopia'>
  <div class="download-cta-big" id="cta-big-Holder">
    <img src="<?php echo cdn('img/wait.gif'); ?>" />
  </div>
  <div class="download-cta-big Windows" id="cta-big-Windows">
    <h3>Tigrigna for Keyman for Windows</h3>
    <p>
      Type in Tigrigna in all your favourite software applications for Windows. Keyman for Windows will automatically configure your system for the Tigrigna language.
    </p>
    <div class="download-stable-email">
      <div class="download-cta-button">
        <h4>Download Now</h4>
      </div>
      <a class="download-cta-more" href="/windows/">Learn more about Keyman for Windows</a>
    </div>
  </div>
  <div class="download-cta-big iPhone" id="cta-big-iPhone">
    <h3>Tigrigna Keyman for iPhone</h3>
    <div class="download-cta-button">
      <h4>Download for iPhone</h4>
    </div>
    <p>
      Type in Tigrigna on your iPhone.  Keyman brings the iPhone language experience to life, adding the language and font support for Tigrigna that even Apple don't!
    </p>
  </div>
  <div class="download-cta-big iPad" id="cta-big-iPad">
    <h3>Tigrigna Keyman for iPad</h3>
    <div class="download-cta-button">
      <h4>Download for iPad</h4>
    </div>
    <p>
      Type in Tigrigna on your iPad.  Keyman brings the iPad language experience to life, adding the language and font support for Tigrigna that even Apple don't!
    </p>
  </div>
  <div class="download-cta-big Android" id="cta-big-Android">
    <h3>Tigrigna Keyman for Android</h3>
    <div class="download-cta-button">
      <h4>Download for Android</h4>
    </div>
    <p>
      Type in Tigrigna on your Android device. Touch enabled keyboards for phone, 7-inch and 10-inch tablets ensure a seamless typing solution across any Android device.
    </p>
  </div>
  <div class="download-cta-big mac" id="cta-big-mac">
    <h3>Tigrigna Keyman for macOS</h3>
    <p>
      Type in Tigrigna in all your favourite software applications for macOS. Download <a href="/mac/">Keyman
      for macOS</a> first
    </p>
    <div class="download-cta-button">
      <h4>Download Now</h4>
    </div>
    <a class="download-cta-more" href="/mac/">Learn more about Keyman for macOS</a>
  </div>

  <div class="download-cta-big" id="cta-big-Web">
    <h3>Type Tigrigna in your Browser</h3>
    <p>
      Type Tigrigna online in your browser with keymanweb.com, no download required.
    </p>
    <div class="download-cta-button" id="cta-button-web">
      <h4>Start Typing!</h4>
    </div>
  </div>

  <h3 id="cta-other-downloads">Download a Tigrigna keyboard on these devices:</h3>

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
  <div class="download-cta-small Bookmarklet" id="cta-Bookmarklet">
    <a href="/bookmarklet/">
      <img src="<?php echo cdn('img/cta-icons/icon-bookmarklet.png'); ?>" />
      <p>Bookmarklet</p>
    </a>
  </div>
</div>
<div class="spacer"></div>
<h2 class="red underline">Other Ethiopic languages</h2>
<p>
    Type in other Ethiopic languages such as:
    <ul>
        <li><a href="eritrean.php">Tigrigna (Eritrea)</a></li>
        <li><a href="/keyboards/gff_awngi_xamtanga">Awngi & Xamtanga</a></li>
        <li><a href="/keyboards/gff_blin">Blin</a></li>
        <li><a href="/keyboards/gff_geez">Ge'ez</a></li>
        <li><a href="/keyboards/gff_gurage">Gurage</a></li>
        <li><a href="/keyboards/gff_gurage_legacy">Gurage Legacy</a></li>
        <li><a href="/keyboards/gff_harari">Harari</a></li>
        <li><a href="/keyboards/gff_tigre">Tigre</a></li>
        <li><a href="/amharic/">Amharic</a></li>
    </ul>
</p>
<div class="spacer"></div>
<h2 class="red underline">Frequently Asked Questions</h2>
<ul id="faq">
  <li>
    <span class="question">Which font should I use in Microsoft Word and other programs on Windows?</span>
    <span class="answer">Keyman for Windows Ethiopic packages come with the following Ge'ez fonts, which we recommend you use:</span>
    <table id="ethiopic-fonts" >
      <tbody>
        <tr>
          <th>Abyssinica SIL</th>
          <td>
            <img alt="Abyssinica Font Sample" src="<?php echo cdn('img/abyssinica.png'); ?>" />
          </td>
          <th>Ethiopic Fantuwua</th>
          <td>
            <img alt="Fantuwua Font Sample" src="<?php echo cdn('img/fantuwua.png'); ?>" />
          </td>
        </tr>
        <tr>
          <th>Ethiopic Hiwua</th>
          <td>
            <img alt="Hiwua Font Sample" src="<?php echo cdn('img/hiwua.png'); ?>" />
          </td>
          <th>Ethiopic Jiret</th>
          <td>
            <img alt="Jiret Font Sample" src="<?php echo cdn('img/jiret.png'); ?>" />
          </td>
        </tr>
        <tr>
          <th>Ethiopic Tint</th>
          <td>
            <img alt="Tint Font Sample" src="<?php echo cdn('img/tint.png'); ?>" />
          </td>
          <th>Ethiopic WashRa</th>
          <td>
            <img alt="WashRa Font Sample" src="<?php echo cdn('img/washra.png'); ?>" />
          </td>
        </tr>
        <tr>
          <th>Ethiopic Wookianos</th>
          <td>
            <img alt="Wookianos Font Sample" src="<?php echo cdn('img/wookianos.png'); ?>" />
          </td>
          <th>Ethiopic Yebse</th>
          <td>
            <img alt="Yebse Font Sample" src="<?php echo cdn('img/yebse.png'); ?>" />
          </td>
        </tr>
        <tr>
          <th>Ethiopic Yigezu Bisrat Goffer</th>
          <td>
            <img alt="Yigezu Bisrat Goffer Font Sample" src="<?php echo cdn('img/yigezu.png'); ?>" />
          </td>
          <th>Free Serif</th>
          <td>
            <img alt="Free Serif Font Sample" src="<?php echo cdn('img/freeserif.png'); ?>" />
          </td>
        </tr>
      </tbody>
    </table>
    <span class="answer">Find other supported Ge'ez fonts on your computer by <a href="<?= KeymanHosts::Instance()->help_keyman_com ?>/products/windows/current-version/basic/toolbox/font-helper">using the Font Helper tool.</a></span>
  </li>
  <li>
    <span class="question">What transcription method do the keyboards use?</span>
    <span class="answer">
      The keyboards use the SERA (System for Ethiopic Representation in ASCII) method for transcribing the Ge'ez script into Latin characters. SERA uses the following principles:
      <ul class="disc">
        <li>A letter for every keystroke.</li>
        <li>
          Keystrokes with intuitive phonetic associations. For example —
          <br>
          Typing
          <kbd>s</kbd>
          <kbd>e</kbd>
          <kbd>l</kbd>
          <kbd>a</kbd>
          <kbd>m</kbd>
          produces:
          <span class="example" lang="am">ሰላም</span>
          <br>
          Typing
          <kbd>T</kbd>
          <kbd>i</kbd>
          <kbd>e</kbd>
          <kbd>n</kbd>
          <kbd>a</kbd>
          <kbd>y</kbd>
          <kbd>s</kbd>
          <kbd>T</kbd>
          <kbd>l</kbd>
          <kbd>N</kbd>
          produces:
          <span class="example" lang="am">ጤናይስጥልኝ</span>
        </li>
        <li>
          Ge'ez default punctuation with Western default space. (Ge'ez space '
          <span class="example" lang="am">፡</span>
          ' available with
          <kbd>SHIFT</kbd>
          +
          <kbd>SPACEBAR</kbd>
          )
        </li>
        <li>
          Western default number.
        </li>
      </ul>
    </span>
  </li>
  <li>
    <span class="question">What is the difference between Tigrigna (Eritrea) and Tigrigna (Ethiopia)?</span>
    <span class="answer">
      The two Tigrigna keyboards differ slightly. Tigrigna (Ethiopia) includes three sets of characters which are not in Tigrigna (Eritrea) —
      <span class="example" lang="ti-et">ሥ</span>
      ,
      <span class="example" lang="ti-et">ኅ</span>
      ,
      <span class="example" lang="ti-et">ፅ</span>
      — as well as the single character
      <span class="example" lang="ti-et">ኧ</span>
      . The two keyboards also differ on the punctuation they offer:
    </span>
    <table id="ethiopic-punctuation">
      <tbody>
        <tr>
          <th>Typing</th>
          <th>
          <kbd>,</kbd>
          </th>
          <th>
          <kbd>,</kbd>
          <kbd>,</kbd>
          </th>
          <th>
          <kbd>,</kbd>
          <kbd>,</kbd>
          <kbd>,</kbd>
          </th>
          <th>
          <kbd>;</kbd>
          </th>
          <th>
          <kbd>;</kbd>
          <kbd>;</kbd>
          </th>
          <th>
          <kbd>:</kbd>
          </th>
          <th>
          <kbd>:</kbd>
          <kbd>:</kbd>
          </th>
          <th>
          <kbd>:</kbd>
          <kbd>-</kbd>
          </th>
          <th>
          <kbd>?</kbd>
          <kbd>?</kbd>
          </th>
        </tr>
        <tr>
          <th>Tigrigna (Eritrea) result</th>
          <td class="example" lang="ti-er">፡</td>
          <td class="example" lang="ti-er">,</td>
          <td class="nil"></td>
          <td class="example" lang="ti-er">፣</td>
          <td class="example" lang="ti-er">;</td>
          <td class="example" lang="ti-er">፡</td>
          <td class="example" lang="ti-er">።</td>
          <td class="example" lang="ti-er">፦</td>
          <td class="example" lang="ti-er">፧</td>
        </tr>
        <tr>
          <th>Tigrignia (Ethiopia) result</th>
          <td class="example" lang="ti-et">፣</td>
          <td class="example" lang="ti-et">፥</td>
          <td class="example" lang="ti-et">,</td>
          <td class="example" lang="ti-et">፤</td>
          <td class="example" lang="ti-et">;</td>
          <td class="example" lang="ti-et">፡</td>
          <td class="example" lang="ti-et">።</td>
          <td class="example" lang="ti-et">፦</td>
          <td class="nil"></td>
        </tr>
      </tbody>
    </table>
  </li>
</ul>

<div id='info'>
  <h2 class="red underline">More Information</h2>

  <p>These keyboards are designed and copyrighted by the Geez Frontier Foundation.</p>

  <p>For technical support, please <a href='https://community.software.sil.org/c/keyman'>visit our forums</a> online.</p>

  <p><a href='<?= KeymanHosts::Instance()->help_keyman_com ?>/keyboard/gff_tigrinya_ethiopia'>Tigrigna Keyboard Documentation</a></p>
</div>
<br/>

<div id='attributions'>
  <p><a href="https://commons.wikimedia.org/wiki/File:The_Ezana_Stone_(2840202630).jpg">Ezana stone image</a> courtesy of A. Davey, under <a href="http://creativecommons.org/licenses/by/2.0/deed.en" target="blank">Create Commons Attribution 2.0 Generic licence.</a></p>
</div>
