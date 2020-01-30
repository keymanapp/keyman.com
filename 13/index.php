<?php
require_once('includes/template.php');
require_once('includes/ui/downloads.php');
require_once('includes/appstore.php');
require_once('includes/playstore.php');

// Required
head([
  'class' => 'keyman11',
  'title' => 'Keyman 13 is now in beta!',
  'css' => ['template.css', 'dev.css', 'app-store-links.css', 'prism.css'],
  'js' => ['prism.js'],
  'showMenu' => true,
  'banner' => [
    'title' => 'Keyman 13.0 Beta',
    'image' => 'world.png',
    'background' => 'water'
  ]
]);
?>

<h2>Announcing the release of Keyman 13.0 Beta</h2>
<p class="red">29 January 2020</p>
<p>We are pleased to announce that Keyman 13.0 is now in beta!</p>
<br>

<h3>What's New?</h3>
<ul>
  <li>Share keyboard download links via QR Codes for all Keyman platforms<br>
    <img alt='Share keyboards via QR Codes' src='share-qr-code.png'></li>
  <li>Improved capability and stability on all platforms</li>
  <li>Dark mode support on Keyman for iPhone and iPad<br>
    <img alt='Dark mode for Keyman for iPhone and iPad' src='ios-dark.png'></li>
</ul>

<h3>What's Next?</h3>
<ul>
  <li>Check the <a href="https://blog.keyman.com/2019/11/keyman-roadmap-november-2019/">Keyman Roadmap</a> for upcoming features.</li>
</ul>
<br>

<h3>13.0 Beta Feedback</h3>
<ul>
  <li>Please send feedback about Keyman 13 to the
  <a href="https://community.software.sil.org/t/keyman-13-beta-feedback/2961">Keyman Community site</a> or submit bugs and feature requests to our
  <a href="https://github.com/keymanapp/keyman/issues/new/choose">Issue Tracker</a></li>
</ul>
<br>

<h1 class='red underline'>User Software</h1>

<?php
downloadSection('Keyman Desktop 13',   'windows',     'keymandesktop-$version.exe', 'beta');
?>

<h3>What's New in Keyman Desktop 13 for Windows?</h3>

<ul>
  <li>Hotkeys are now only triggered with left modifiers, avoiding conflicts with Right Alt</li>
  <li>Fix SMP character output which could break input in some applications</li>
</ul>



<?php
downloadSection('Keyman 13 for macOS',   'mac',     'keyman-$version.dmg', 'beta');
?>

<h3>What's New in Keyman 13 for macOS?</h3>

<ul>
  <li>Fix On Screen Keyboard bugs: Don't show base letters on blank keycaps and fix from being unexpectedly shown</li>
</ul>



<h2 id='linux' class='red underline'>Keyman 13 for Linux</h2>

<h3>Beta</h3>
<li>Ubuntu, Wasta-Linux: Keyman for Linux Beta can be installed via launchpad:</li>
<blockquote><pre class='language-bash code'><code>sudo add-apt-repository ppa:keymanapp/keyman-nightly
sudo apt-get update
sudo apt-get upgrade
sudo apt-get install keyman onboard</code></pre></blockquote>

<h3>What's New in Keyman 13 for Linux?</h3>

<ul>
  <li>In "About "keyboards, add QR Codes to share keyboards</li>
</ul>


<?php
  downloadSection('Keyman for Android 13', 'android', 'keyman-$version.apk', 'beta');
?>

<p>You can also <a href=<?= $playstore_signup_link ?>>sign up</a> to access pre-release versions through Google Play.</p>

<h3>What's new in Keyman for Android 13?</h3>

<ul>
  <li>Added a background download manager for downloading keyboards and dictionaries</li>
  <li>Show available keyboard updates as Android system notifications. These can be ignored for 3 months.</li>
</ul>

<h2 class="red underline">Keyman for iPhone and iPad 13</h2>
<h3>Beta</h3>
<p>Please register for the pre-release version through the links below for Keyman <a href=<?= $testflight_beta_link ?>>beta</a>
pre-releases on your iOS device. This will grant access to the app through <a  href="https://developer.apple.com/testflight/testers/">Apple's
Testflight app</a>, which facilitates direct installation on iOS devices.</p>

<?= iosTestFlightTable(); ?>

<h3>What's new in Keyman for iPhone and iPad 13?</h3>

<ul>
  <li>Add file browsing for installing KMPs</li>
  <li>Add support for iOS 13.0 dark mode theme</li>
</ul>





<?php
downloadSection('KeymanWeb 13', 'web', 'keymanweb-$version.zip', 'beta');
?>

<h3>What's New in KeymanWeb 13?</h3>

<ul>
  <li>Various bug fixes and compatibility improvements</li>
</ul>



<h1 class='red underline'>Developer Software</h1>

<?php
downloadSection('Keyman Developer 13',    'developer', 'keymandeveloper-$version.exe', 'beta');
?>

<h3>What's new in Keyman Developer 13?</h3>

<ul>
  <li>New lexical model editor</li>
  <li>Add unsupported kmdecomp decompiler utility</li>
  <li>Add x64 version of kmcomp</li>
  <li>Hotkeys defined in .kmn no longer need to be quoted</li>
  <li>F7 in Project window compiles the whole project</li>
  <li>Default Project Path is now <pre class="code bash">Documents\Keyman Developer\Projects</pre></li>
</ul>
