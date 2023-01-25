<?php
  require_once('includes/template.php');
  require_once('includes/playstore.php');
  require_once __DIR__ . '/../_includes/autoload.php';
  use Keyman\Site\Common\KeymanHosts;

  // Required
  head([
    'title' =>'Keyman for Android',
    'css' => ['template.css','feature-grid.css','app-store-links.css'],
    'showMenu' => true,
    'banner' => [
      'title' => 'Type in Your Language On Your Android Device!',
      'button' => '<a href="'.$playstore.'"><img id="app-store" src="https://developer.android.com/images/brand/en_app_rgb_wo_60.png" alt="Android app on Google Play"></a>',
      'image' => 'android-splash.png',
      'background' => 'water'
    ]
  ]);
?>
<h2 class="red underline">Keyman for Android</h2>

<?= $playstoreTable ?>

<?php
    if (betaTier()) {
?>
        <p>Want to try the Keyman for Android <?= $beta_version ?> Beta? <a href="/beta/">Learn more</a></p>
<?php
    }
?>

<p>
  Keyman is available for Android devices. Keyman for Android makes it possible to type in over 2000 different languages on
  your Android device, and share the content you enter with friends on Facebook or Twitter, via email or instant messaging!
</p>

<p>
  With keyboard layouts customized across phone, 7-inch tablets and 10-inch tablets, Keyman for Android provides the
  easiest way to type in your language on your favorite Android powered device.
</p>

<p>
  Keyman keyboard layouts are installable as System-wide keyboards, so you can type into any app!
</p>

<p>
  Create custom Keyman dictionaries with <a href='/developer'>Keyman Developer <?= $stable_version ?> </a>
  and install them to use with your keyboards.
</p>

<p style='text-align:center'>
  <img src='<?= cdn("img/android-sencoten.png"); ?>' />
</p>

<p>
  Now you also have the flexibility of installing Keyman keyboard packages from either online
  (like <a href="/keyboards"><?= KeymanHosts::Instance()->keyman_com ?>/keyboards</a>) or local storage from a new "Settings" panel.
</p>

<p>
    <img src='<?= cdn("img/android-kmp.png"); ?>' />
</p>

<p>The <strong class='red'>Keyman built-in browser</strong> dynamically loads your language font into each website you visit so you no longer see square boxes for your language on the web!</p>

<p style='text-align:center'><img src='<?= cdn("img/android-browser.png"); ?>' /></p>

<p>
  The built-in browser feature applies your language font to websites that you browse, and includes a bookmark feature and of course supports typing your language into any website!
</p>

<h2>Keyman for Android Features</h2>

<br/>

<table class='feature-grid'>
  <thead>
    <tr>
      <th>Feature</th>
      <th>Keyman</th>
    </tr>
  </thead>
  <tbody>
    <tr>
        <td>World-leading input methods for hundreds of languages</td>
        <td><img class="table-tick" src="<?= cdn("img/table-tick.png"); ?>"/></td>
    </tr>
    <tr>
        <td>Create your own custom keyboards</td>
        <td><img class="table-tick" src="<?= cdn("img/table-tick.png"); ?>"/></td>
    </tr>
    <tr>
        <td>External keyboard support</td>
        <td><img class="table-tick" src="<?= cdn("img/table-tick.png"); ?>"/></td>
    </tr>
    <tr>
        <td>System keyboard support</td>
        <td><img class="table-tick" src="<?= cdn("img/table-tick.png"); ?>"/></td>
    </tr>
    <tr>
        <td>Built in browser for full font support</td>
        <td><img class="table-tick" src="<?= cdn("img/table-tick.png"); ?>"/></td>
    </tr>
    <tr>
        <td>Install custom keyboard and dictionary packages</td>
        <td><img class="table-tick" src="<?= cdn("img/table-tick.png"); ?>"/></td>
    </tr>
  </tbody>
</table>

<br/>
<h3>New in Keyman for Android 16.0 (Jan 2023)</h3>
<ul>
  <li>Dismiss long-press keys on multi-touch (#7388, #7472)</li>
  <li>Don't show "Get Started" after setting Keyman as default system keyboard (#7587)</li>
  <li>Add localizations for:
    <ol>
      <li>Czech</li>
      <li>Dutch</li>
      <li>Russian</li>
      <li>Swedish</li>
      <li>Ukrainian</li>
    </ol>
  </li>
</ul>

<br/>
<h3>New in Keyman for Android 15.0 (Apr 2022)</h3>

<ul>
  <li>Keyman Engine no longer needs internet access </li>
  <li>English keyboard can now be removed</li>
  <li>Add a menu to adjust keyboard height</li>
  <li>Add support for haptic feedback (vibration) when typing</li>
  <li>Add a settings option to change the displayed keyboard name on the spacebar</li>
  <li>Improve the globe key experience for switching keyboards:
    <ol>
      <li>Short press and release the globe key to immediately switch to next keyboard</li>
      <li>Long press and release the globe key to bring up the keyboard picker menu</li>
      <li>Allow switching to other system IME's in the keyboard picker menu</li>
    </ol>
  </li>
  <li>Select numeric layer when entering a number field</li>
</ul>

<br/>
<h3>New in Keyman for Android 14.0 (Mar 2021)</h3>

<ul>
    <li>Improved UI for installing keyboard packages</li>
    <li>Select a language during keyboard package installation</li>
    <li>Added new Settings menu to "Change Display Language"</li>
    <li>Updated minimum version of Android to 5.0 (Lollipop)</li>
</ul>

<br/>
<h3>New in Keyman for Android 13.0 (Feb 2020)</h3>
<ul>
    <li>Download keyboard and dictionary resources in the background</li>
    <li>Show available keyboard updates as Android system notifications</li>
    <li>Add QR codes to Keyboard Info pages to share keyboard downloads</li>
    <li>Improve handling keyboard context with applications such as Gmail and Chrome</li>
</ul>

<br/>
<h3>New in Keyman for Android 12.0 (Oct 2019)</h3>

<ul>
    <li>Add predictive text support to keyboards. Default English keyboard now uses a dictionary by default</li>
    <li>Changed keyboard install/uninstalls to use new "Settings" menu</li>
    <li>Add keyboard packages from the local device using the "Settings" menu</li>
</ul>

<br/>
<h3>New in Keyman for Android 11.0 (Mar 2019)</h3>

<ul>
    <li>Updated app to use Material Design theme</li>
    <li>Device vibrates when current keyboard signals an invalid keystroke (e.g. two identical diacritics in a row)</li>
    <li>Improved support for hardware keyboards (including 102nd key found on European keyboards)</li>
    <li>Fixed integration with hardware keyboard keys [tab] and [backspace]</li>
    <li>Updated minimum version of Android to 4.1 (Jellybean)</li>
</ul>

<br/>
<h3>New in Keyman for Android 10.0 (July 2018)</h3>

<ul>
  <li><a href="<?= KeymanHosts::Instance()->help_keyman_com ?>/developer/10.0/guides/distribute/install-kmp-android">Install custom keyboard</a>
    by clicking a link to your Keyman package (.kmp) file</li>
  <li>Improved longpress behavior</li>
  <li>Fixed OSK missing some keys on older Android configurations</li>
  <li>Add support for L/R Alt and Ctrl and Caps Lock modifiers</li>
  <li>Updated app to target Android 8.1 (API level 27)</li>
  <li>Removed "Share to Facebook" feature</li>
</ul>

<br/>
<h3>New in Keyman for Android 2.8 (10 Aug 2017)</h3>

<ul>
  <li>Fixed long-press popups to correctly show lower case and upper case letters</li>
  <li>Fixed several hardware keyboard bugs involving SPACEBAR, TAB, and ENTER keys, and correctly displaying non-English languages)</li>
  <li>Removed license checks</li>
</ul>

<br/>
<h3>New in Keyman 2.4 (10 Oct 2016)</h3>

<ul>
  <li>Keyman is now free!</li>
  <li>Keyman Pro renamed to Keyman</li>
  <li>Keyman Free retired</li>
  <li>Experimental support for hardware keyboards</li>
</ul>

<br/>
<h3>New in Keyman Pro 2.2 (6 Jul 2015)</h3>

<ul>
  <li>Faster load, keyboard switching and more responsive touches</li>
  <li>More stable, reduced memory requirements and addressed crashes</li>
  <li>Improved look and feel including improved long-press menus</li>
  <li>Smoother touch interactions and rapid touch interactions</li>
  <li>Handles touches just outside a key more intelligently</li>
  <li>Minor bug fixes and improvements</li>
</ul>

<br/>
<h3>New in Keyman Pro 2.1 (27 Jan 2015)</h3>

<ul>
  <li>The <strong class='red'>Keyman Pro built-in browser</strong> dynamically loads your language font into each website you visit, so you no longer see square boxes for your language on the web!</li>
</ul>

<br/>
<h3>New in Update 2.0 (10 Nov 2014):</h3>

<ul>
  <li>Released in two editions: Keyman Free and Keyman Pro</li>
  <li>Use any Keyman keyboard throughout your entire Android device (Pro Edition only)</li>
    <li>Install custom keyboards created with Keyman Developer 9 (<a href="/downloads/archive/">free download for Windows</a>)</li>
    <li>Updated keyboard styling</li>
  <li>Bug fixes</li>

  <li>
  Beta Edition users please note: Keyman for Android is now available in two editions: Free and Pro. If you are an existing Keyman Beta user, you can continue using the Keyman Beta Edition as long as you like, or you can upgrade to the Free or Pro Edition (recommended!) Note that the Beta Edition will no longer be updated, and at some point will be removed from the Android Play Store.
  </li>
</ul>

<br/>
<h3>New in Update 1.5 (26 Sep 2014):</h3>
<ul>
  <li>Added a new 'Get Started' menu that lists key tasks such as adding a keyboard or implementing system-wide keyboards</li>
  <li>Other bug fixes</li>
</ul>
<br/>
<h3>New in Update 1.4 (30 Jun 2014):</h3>
<ul>
  <li>You will now see a key preview on phone devices when you touch a key</li>
  <li>You can now swipe to select popup keys</li>
  <li>Installed keyboards now have keyboard version and help available</li>
  <li>European Latin keyboard no longer uses desktop-based shortcuts (e.g. .c no longer outputs ċ)</li>
  <li>Improved lock screen compatibility</li>
  <li>System keyboard no longer loses context or fails to respond on switch</li>
  <li>Other minor bug fixes</li>
</ul>
<br/>
<h3>New in Update 1.3 (29 May 2014):</h3>
<ul>
  <li>Keyboards will update automatically when bug fixes or new features are added</li>
  <li>Bug fix: A slightly longer press on a key would sometimes fail to input the keystroke</li>
  <li>Default English keyboard is now enhanced for European language diacritics</li>
  <li>Behind the scenes: Now uses Keyman Cloud API 3.0 for access to newest keyboard layouts</li>
  <li>Other minor bug fixes</li>
</ul>
<br/>
<h3>New in Update 1.2 (22 Apr 2014):</h3>
<ul>
  <li>Install custom keyboards created with Keyman Developer 9 (<a href="/downloads/archive/">free download for Windows</a>)</li>
</ul>
<br/>
<p>
  <a href="<?= $KeymanHosts->help_keyman_com ?>/products/android/version-history/">View all version history</a>
</p>

<?= $playstoreTable ?>

<h2 class="red underline">Keyman Engine for Android</h2>

<p>
  As always, we make our technology available to app developers! Keyman Engine for Android is our programming interface for Keyman for Android. Bringing with it over 2000 languages and multiple keyboards for many of those languages, as well as automatic embedded font support, Keyman Engine for Android makes it straightforward to take your app to the world!
</p>
<br/>
<p>
  You can develop your own keyboard layouts for Keyman for Android with <a href="/developer/download.php">Keyman Developer</a>. If you have existing keyboards, they can be ported to Android with just a recompile. And of course, we include support for touch-oriented features such as touch-and-hold menus, dynamic keyboard layers and more!
</p>
<p>
  <a href="<?= $KeymanHosts->help_keyman_com ?>/developer/engine/android/">Keyman Engine for Android Documentation</a>
</p>
<p>
  <a href="/downloads/#android-engine">Download the latest Keyman Engine for Android</a>
</p>