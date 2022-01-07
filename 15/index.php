<?php

require_once('includes/template.php');
require_once('includes/ui/downloads.php');
require_once('includes/appstore.php');
require_once('includes/playstore.php');

use Keyman\Site\Common\KeymanHosts;

// Required
head([
  'class' => 'keyman11',
  'title' => 'Keyman 15 is now in Beta!',
  'css' => ['template.css', 'dev.css', 'app-store-links.css', 'prism.css'],
  'js' => ['prism.js'],
  'showMenu' => true,
  'banner' => [
  'title' => 'Keyman 15.0 Beta',
    'image' => 'screenshots/14/typewriter.jpg',
    'background' => 'black'
  ]
]);
?>

<h2>Announcing the release of Keyman 15.0 Beta</h2>
<p class="red">TBD 2022</p>
<p>We are pleased to announce that Keyman 15.0 is now in beta!</p>
<br>

<h3>What's New?</h3>
<p>These major features are in all supported platforms:</p>
<ul>
  <li>
    Moved crash reporting to sentry.io
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

<h3>Keyman 15.0 Feedback</h3>
<ul>
  <li>Please send feedback about Keyman 15 to the
    <a href="https://community.software.sil.org/t/keyman-15-beta-feedback/5755">Keyman Community site</a> or submit bugs and feature requests to our
    <a href="https://github.com/keymanapp/keyman/issues/new/choose">Issue Tracker</a></li>
</ul>
<br>

<h1 class='red underline'>User Software</h1>

<?php
downloadSection('Keyman 15 for Windows',   'windows',     'keyman-$version.exe', 'beta');
?>

<h3>What's New in Keyman 15 for Windows?</h3>

<ul>
  <li>Keyman Core integration (#5443)</li>
</ul>



<?php
downloadSection('Keyman 15 for macOS',   'mac',     'keyman-$version.dmg', 'beta');
?>

<h3>What's New in Keyman 15 for macOS?</h3>

<ul>
  <li>Localizable UI through <a href="<?= KeymanHosts::Instance()->translate_keyman_com ?>">translate.keyman.com</a> (#5869)</li>
  <li>Display Unicode package name correctly instead of '????' (#6016)</li>
  <li>Add support for M1 processor (#5701)</li>
</ul>



<h2 id='linux' class='red underline'>Keyman 15 for Linux</h2>

<h3>What's New in Keyman 15 for Linux?</h3>

<ul>
  <li>Now supports Ubuntu 21.04 (Hirsute), 21.10 (Impish), and 22.04 (Jammy)</li>
  <li>Consolidated Debian source packages from three to one source package: keyman (#5022)</li>
  <li>Fix crash when displaying certain keyboard details (#5758)</li>
</ul>

<?php
downloadSection('Keyman 15 for Android', 'android', 'keyman-$version.apk', 'beta');
?>

<?= $playstoreTable ?>

<h3>What's new in Keyman 15 for Android?</h3>

<ul>
  <li>Add a menu to adjust keyboard height (#5606)</li>
  <li>Add a settings option to change the displayed keyboard name on the spacebar</li>
  <li>Improve the globe key experience for switching keyboards (#5437, #5973):
    <ol>
      <li>Short press and release the globe key to immediately switch to next keyboard</li>
      <li>Long press and release the globe key to bring up the keyboard picker menu</li>
      <li>Allow switching to other system IME's in the keyboard picker menu</li>
    </ol>
  </li>
  <li>Allow uninstall of sil_euro_latin keyboard (#5838)</li>
  <li>Select numeric layer when entering a number field (#5664)</li>
</ul>

<h2 id='ios' class="red underline">Keyman 15 for iPhone and iPad</h2>

<?= $appstoreTable ?>

<h3>What's new in Keyman 15 for iPhone and iPad?</h3>

<ul>
  <li>Add controls for spacebar caption (#5365)</li>
  <li>Update minimum iOS version to 12.1 (#5165)</li>
</ul>





<?php
downloadSection('KeymanWeb 15', 'web', 'keymanweb-$version.zip', 'beta');
?>

<h3>What's New in KeymanWeb 15?</h3>

<ul>
  <li>Imrpove keyboard switch performance (#5958)</li>
  <li>Enable mouse interaction for the predictive banner (#5739)</li>
</ul>



<h1 class='red underline'>Developer Software</h1>

<?php
downloadSection('Keyman Developer 15',    'developer', 'keymandeveloper-$version.exe', 'beta');
?>

<h3>What's new in Keyman Developer 15?</h3>

<ul>
  <li>Debugger uses Keyman Core (#5513)</li>
  <li>
    Add support for <code class='language-java'>U_xxxx_yyyy_...</code> 
    indentifiers so you can emit more than a single Unicode character with 
    touch keys without additional kmn code (#5894)
  </li>
  <li>Keyman Developer debugger no longer depends on Keyman for Windows (#5588)</li>
  <li>Add support for testing touch layouts without requiring use of device emulation (#5723)</li>
  <li>live reload of web debugger (#6035)</li>
</ul>

<br>

<h3>Breaking changes for keyboard developers</h3>

<p>We work hard to minimize the potential for breaking changes to Keyman. We sometimes must make a change which may
not be 100% backwardly compatible, either to correct a bug, or to address security issues. The following issues are
known breaking changes in Keyman 15.0:</p>

<ul>
  <li>Keyman for Android now enforces minimum Chrome version 37.0 (#5017)</li>
  <li>KeymanWeb's OSK field (keyman.osk) is now only available after the promise returned from keyman.init is fulfilled (#5412)
</ul>

<br>

<h3>Changes for Keyman Engine</h3>

<!--p><a href='keyman-engine-changes'>Changes for Keyman Engine</a></p-->

<h2>Get Involved</h2>
<p>There are many ways you can help: <a href='/about/get-involved'>get involved</a> in the Keyman project now!
</p>
