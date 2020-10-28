<?php
require_once('includes/template.php');
require_once('includes/ui/downloads.php');
require_once('includes/appstore.php');
require_once('includes/playstore.php');

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
<p class="red">30 November 2020</p>
<p>We are pleased to announce that Keyman 14.0 is now in beta!</p>
<br>

<h3>What's New?</h3>
<ul>
  <li>
    Simpler and Smoother Keyboard Seach<br>
    <img alt='Search for Khmer Keyboard' src='keyboard_search_khmer.png'>
  </li>
  <li>
    Localizable UI through <a href="https://translate.keyman.com">translate.keyman.com</a>.
  </li>
  <li>
    Mobile apps download and install keyboard packages from keyman.com
  </li>
  <li>
    Consolidated crash reporting to <a href="https://sentry.keyman.com">sentry.keyman.com</a>
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
  <li>Handles major version upgrades from 10 onward</li>
  <li>Add GUI for setting configuration options</li>
</ul>



<?php
downloadSection('Keyman 14 for macOS',   'mac',     'keyman-$version.dmg', 'beta');
?>

<h3>What's New in Keyman 14 for macOS?</h3>

<ul>
  <li>Added icon for Keyman.app</li>
</ul>



<h2 id='linux' class='red underline'>Keyman 14 for Linux</h2>

<h3>What's New in Keyman 14 for Linux?</h3>

<ul>
  <li>Open a .kmp file with Keyman Config</li>
  <li>Now supports Ubuntu 20.10 (Groovy)</li>
  <li>Improved UI</li>
</ul>

<li>Ubuntu, Wasta-Linux: Keyman for Linux can be installed via launchpad:</li>
<blockquote><pre class='language-bash code'><code>sudo add-apt-repository ppa:keymanapp/keyman-nightly
sudo apt-get update
sudo apt-get upgrade
sudo apt-get install keyman onboard</code></pre></blockquote>


<?php
downloadSection('Keyman for Android 14', 'android', 'keyman-$version.apk', 'beta');
?>

<p>You can also <a href=<?= $playstore_signup_link ?>>sign up</a> to access pre-release versions through Google Play.</p>
<?= $playstoreTable ?>

<h3>What's new in Keyman for Android 14?</h3>

<ul>
  <li>
    Select a language during keyboard package installation<br>
    <img alt='Select language during keyboard installation' src='select_language.png'>
  </li>
  <li>Consolidated install menus for installing keyboards</li>
  <li>Add system globe action to show system keyboards</li>
</ul>

<h2 class="red underline">Keyman for iPhone and iPad 14</h2>
<h3>Beta</h3>
<p>Please register for the pre-release version through the links below for Keyman <a href=<?= $testflight_beta_link ?>>beta</a>
  pre-releases on your iOS device. This will grant access to the app through <a  href="https://developer.apple.com/testflight/testers/">Apple's
    Testflight app</a>, which facilitates direct installation on iOS devices.</p>

<?= iosTestFlightTable(); ?>

<h3>What's new in Keyman for iPhone and iPad 14?</h3>

<ul>
  <li>Select a language during keyboard package installation</li>
  <li>Improved batching of keyboard and dictionary downloads</li>
</ul>





<?php
downloadSection('KeymanWeb 14', 'web', 'keymanweb-$version.zip', 'beta');
?>

<h3>What's New in KeymanWeb 14?</h3>

<ul>
  <li>Add special keys for right-to-left keyboards</li>
  <li>Block key previews for blank/hidden keys</li>
</ul>



<h1 class='red underline'>Developer Software</h1>

<?php
downloadSection('Keyman Developer 14',    'developer', 'keymandeveloper-$version.exe', 'beta');
?>

<h3>What's new in Keyman Developer 14?</h3>

<ul>
  <li>Improve how casing is handled for lexical-models</li>
  <li>Add support for notany() and context()</li>
  <li>Remove IE dependency from Developer setup</li>
</ul>


<h2>Get Involved</h2>
<p>There are many ways you can help: <a href='/about/get-involved'>get involved</a> in the Keyman project now!
</p>

