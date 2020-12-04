<?php

require_once('includes/template.php');
require_once('includes/ui/downloads.php');
require_once('includes/appstore.php');
require_once('includes/playstore.php');

use Keyman\Site\Common\KeymanHosts;

// Required
head([
  'class' => 'keyman11',
  'title' => 'Keyman 14 is now in Beta!',
  'css' => ['template.css', 'dev.css', 'app-store-links.css', 'prism.css'],
  'js' => ['prism.js'],
  'showMenu' => true,
  'banner' => [
    'title' => 'Keyman 14.0 Beta',
    'image' => 'world.png',
    'background' => 'water'
  ]
]);
?>

<h2>Announcing the release of Keyman 14.0 Beta</h2>
<p class="red">TBD 2020</p>
<p>We are pleased to announce that Keyman 14.0 is now in beta!</p>
<br>

<h3>What's New?</h3>
<p>These major features are in all supported platforms:</p>
<ul>
  <li>
    Simpler and Smoother Keyboard Search<br>
    <img alt='Search for Khmer Keyboard' src='keyboard_search_khmer.png'>
  </li>
  <li>
    Localizable UI through <a href="<?= KeymanHosts::Instance()->translate_keyman_com ?>">translate.keyman.com</a> (not yet available for macOS).
  </li>
  <li>
    Mobile apps download and install keyboard packages from keyman.com
  </li>
  <li>
    Consolidated crash reporting to <a href="<?= KeymanHosts::Instance()->sentry_keyman_com ?>">sentry.keyman.com</a>
  </li>
  <li>
    Many bug fixes and improvements (see the <a href="<?= KeymanHosts::Instance()->help_keyman_com ?>/version-history">version history</a>)
  </li>
</ul>
<br>

<h3>What's Next?</h3>
<ul>
  <li>
    Check the <a href="https://blog.keyman.com/2020/03/keyman-roadmap-march-2020/">Keyman Roadmap</a> for upcoming features.
  </li>
</ul>
<br>

<h3>14.0 Beta Feedback</h3>
<ul>
  <li>Please send feedback about Keyman 14 to the
    <a href="https://community.software.sil.org/t/keyman-14-beta-feedback/4115">Keyman Community site</a> or submit bugs and feature requests to our
    <a href="https://github.com/keymanapp/keyman/issues/new/choose">Issue Tracker</a></li>
</ul>
<br>

<h1 class='red underline'>User Software</h1>

<?php
downloadSection('Keyman for Windows 14',   'windows',     'keyman-$version.exe', 'beta');
?>

<h3>What's New in Keyman for Windows 14?</h3>

<ul>
  <li>Renamed from <strong class="red">Keyman Desktop</strong> to <strong class="red">Keyman for Windows</strong></li>
  <li>Keyman keyboards are no longer hidden from the Windows language picker when you exit Keyman. Rather, if you select a Keyman keyboard, Keyman will be restarted for you automatically.</li>
  <li>Added user interface for configuring all Keyman system-level options (#3733)</li>
  <li>Refreshed user interface no longer depends on Internet Explorer (#1720)</li>
  <li>Smoother and more reliable installation of keyboard languages (#3509)</li>
  <li>Choose associated language when keyboard is installed (#3524)</li>
  <li>Much improved keyboard download experience (#3326)</li>
  <li>Improved BCP 47 tag support (#3529)</li>
  <li>Much improved initial download and installation experience including bundled keyboards (#3304)</li>
  <li>Keyman Configuration changes now apply instantly (#3753)</li>
  <li>Improved user experience when many keyboards installed (#3626, #3627)</li>
  <li>Improved bootstrap installer</li>
  <li>Now uses Chromium to host all web-based UI (e.g. Keyman Configuration)</li>
  <li>Breaking: Keyman Engine no longer supports the keyboard usage page (usage.htm)</li>
</ul>



<?php
downloadSection('Keyman 14 for macOS',   'mac',     'keyman-$version.dmg', 'beta');
?>

<h3>What's New in Keyman 14 for macOS?</h3>

<ul>
  <li>Added icon for Keyman app (#3892)</li>
  <li>Improved compatibility with Java apps (#3944)</li>
  <li>Added support for European layouts in On Screen Keyboard (#3924)</li>
  <li>Made it possible to specify app compatibility modes as a user default (#3949)</li>
  <li>Improved input reliability with modifier keys and cursor keys (#2588, #3946)</li>
</ul>



<h2 id='linux' class='red underline'>Keyman 14 for Linux</h2>

<h3>What's New in Keyman 14 for Linux?</h3>

<ul>
  <li>Open a .kmp file with Keyman Config (#3183)</li>
  <li>Now supports Ubuntu 20.10 (Groovy) (#3876)</li>
  <li>Improved user interface</li>
  <li>Improved support for KDE, Gnome, Arch Linux</li>
</ul>

<li>Ubuntu, Wasta-Linux: Keyman for Linux can be installed via launchpad:</li>
<blockquote><pre class='language-bash code'><code>sudo add-apt-repository ppa:keymanapp/keyman
sudo apt install keyman onboard-keyman</code></pre></blockquote>


<?php
downloadSection('Keyman for Android 14', 'android', 'keyman-$version.apk', 'beta');
?>

<p>You can also <a href=<?= $playstore_signup_link ?>>sign up</a> to access pre-release versions through Google Play.</p>
<?= $playstoreTable ?>

<h3>What's new in Keyman for Android 14?</h3>

<ul>
  <li>Improved UI for installing keyboard packages (#3498)</li>
  <li>
    Select a language during keyboard package installation (#3481)<br>
    <img alt='Select language during keyboard installation' src='select_language.png'>
  </li>
  <li>Added new menu to add languages for an installed keyboard package (#3255)</li>
  <li>Consolidated install menus for installing keyboards (#3245)</li>
  <li>Fix slow input in the embedded browser (#3768)</li>
  <li>Add system globe action to show system keyboards (#3197)</li>
  <li>Improved corrections and predictions (#3555)</li>
  <li>Match user input capital letters when offering suggestions (#3845)</li>
  <li> Update minimum Android SDK to 21 (Android 5.0 Lollipop) (#2993)</li>
</ul>

<h2 class="red underline">Keyman for iPhone and iPad 14</h2>
<h3>Beta</h3>
<p>Please register for the pre-release version through the links below for Keyman <a href=<?= $testflight_beta_link ?>>beta</a>
  pre-releases on your iOS device. This will grant access to the app through <a  href="https://developer.apple.com/testflight/testers/">Apple's
    Testflight app</a>, which facilitates direct installation on iOS devices.</p>

<?= iosTestFlightTable(); ?>

<h3>What's new in Keyman for iPhone and iPad 14?</h3>

<ul>
  <li>Choose associated language(s) when keyboard is installed (#3437)</li>
  <li>Improved batching of keyboard and dictionary downloads (#3458)</li>
  <li>Improved corrections and predictions (#3555)</li>
  <li>Match user input capital letters when offering suggestions (#3845)</li>
</ul>





<?php
downloadSection('KeymanWeb 14', 'web', 'keymanweb-$version.zip', 'beta');
?>

<h3>What's New in KeymanWeb 14?</h3>

<ul>
  <li>Adds special keys for right-to-left keyboards (#3851, #3937)</li>
  <li>Interaction with explicitly blank / hidden keys is now blocked (#3857, #3858)</li>
  <li>Sourcemap improvements (#2809)</li>
  <li>Fixes issues with keyboard rules involving system stores (#2884)</li>
  <li>Fixes issues with keyboard rules involving both 'notany' and 'context' (#3817)</li>
</ul>



<h1 class='red underline'>Developer Software</h1>

<?php
downloadSection('Keyman Developer 14',    'developer', 'keymandeveloper-$version.exe', 'beta');
?>

<h3>What's new in Keyman Developer 14?</h3>

<ul>
  <li>Improve how casing is handled for lexical-models (#3770)</li>
  <li>Add support for notany() and context() (#3816)</li>
  <li>Remove IE dependency from Developer setup (#3839)</li>
  <li>New touch layout special key caps *RTLEnter*, *RTLBkSp*, *ZWSP*, ... (#3878)</li>
  <li>Improved BCP 47 support and script mapping (#3818)</li>
  <li>Model compiler merges duplicate words and normalizes when compiling (#3338)</li>
  <li>Support ISO9995 key identifiers (e.g. E01) (#2741)</li>
</ul>


<h2>Get Involved</h2>
<p>There are many ways you can help: <a href='/about/get-involved'>get involved</a> in the Keyman project now!
</p>
