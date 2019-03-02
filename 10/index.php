<?php
  require_once('includes/template.php');
  require_once('includes/ui/downloads.php');
  require_once('includes/appstore.php');
  require_once('includes/playstore.php');

  // Required
  head([
    'class' => 'keyman10',
    'title' => 'Keyman 10 is here and free!',
    'css' => ['template.css', 'dev.css', 'app-store-links.css'],
    'showMenu' => true,
    'banner' => [
        'title' => 'Type to the world with Keyman 10',
        'image' => 'world.png',
        'background' => 'water'
    ]
]);
?>

<h1>Keyman 10.0 Stable</h1>
<p class="red">July 2018</p>
<p>Keyman 10.0 is now officially released! Find the 10.0 download for your platform below.</p>

<h2>What's New?</h2>

<ul>
  <li>Keyman is open source and free, owned and distributed by SIL International.</li>
  <li><a href="https://help.keyman.com/developer/10.0/guides/distribute/packages">Distribution</a> of keyboards now uses
      the same .kmp format on Windows, macOS, iOS and Android.</li>
  <li>Includes support for Unicode 11.0</li>
  <li>All platforms include support for BCP 47 language identifiers</li>
  <li>Developer tools have been enhanced to ease creation of multi-platform keyboards</li>
</ul>

<h2>What's Next?</h2>
<p>Looking for something else? Check the <a href="https://community.software.sil.org/t/keyman-roadmap/822">Keyman Roadmap</a> and see if it's tentatively scheduled.

<h2>10.0 Stable Feedback</h2>
<p>Please send feedback about Keyman 10 Stable to the
  <!-- TODO: Update link for stable -->
  <a href="https://community.software.sil.org/t/keyman-10-beta-feedback/715">Keyman Community site</a>.</p>

<h1 class='red underline'>User Software</h1>


<?php
  downloadSection('Keyman Desktop 10',    'windows', 'keymandesktop-$version.exe', 'stable');
?>

<h3>What's New in Keyman Desktop 10 for Windows?</h3>

<p>Compatible with Windows 7 and later, <a href="https://help.keyman.com/products/desktop/10.0/">Keyman Desktop 10</a>
    supports Unicode 11.0 and BCP 47 language identifiers. Desktop 10 also includes additional user interface for Turkish.</p>

<?php
  downloadSection('Keyman 10 for macOS',   'mac',     'keyman-$version.dmg', 'stable');
?>

<h3>What's New in Keyman 10 for macOS?</h3>

<p>Compatible with macOS 10.7 and later, <a href="https://help.keyman.com/products/mac/10.0/docs/">Keyman 10 for macOS</a>
  adds support for Keyman version 10.0 keyboards. You can include L/R Alt and Ctrl modifiers for your keyboards,
  and easily install keyboard packages by double-clicking the kmp file.</p>

<?php
  downloadSection('Keyman for Android 10',            'android', 'keyman-$version.apk', 'stable');
?>
<p>Keyman for Android is also available on the Play Store.</p>
<?= $playstoreTable ?>

<h3>What's new in Keyman for Android 10?</h3>

<p><a href="https://help.keyman.com/developer/10.0/guides/distribute/install-kmp-android">Install custom keyboards</a>
  by clicking a link to your Keyman package (.kmp) file. Longpress behaviors on
  <a href="https://help.keyman.com/products/android/10.0/">Keyman for Android 10</a> also improved.</p>

<h2 class="red underline">Keyman for iPhone and iPad 10</h2>
<h3>Stable</h3>
<p>Keyman for iPhone and iPad can be found on the App Store.</p>
<?= $appstoreTable ?>

<h3>What's new in Keyman for iPhone and iPad 10?</h3>

<p><a href="https://help.keyman.com/developer/10.0/guides/distribute/install-kmp-ios">Install custom keyboards</a>
  by clicking a link to your Keyman package (.kmp) file.
  <a href="https://help.keyman.com/products/iphone-and-ipad/10.0/">Keyman for iPhone and iPad 10</a> is now built as a
  Swift 4.0 app.</p>

<?php
  downloadSection('KeymanWeb 10', 'web', 'keymanweb-$version.zip', 'stable');
?>

<h3>What's New in KeymanWeb 10?</h3>

<p><a href="https://help.keyman.com/products/web/10.0/">KeymanWeb 10</a> adds several fixes for using physical keyboards
  on touch-enabled inputs. Deadkey and longpress behaviors also improved, along with support for L/R Alt and Ctrl
  modifiers on keyboards.</p>
  
<h1 class='red underline'>Developer Software</h1>

<?php
  downloadSection('Keyman Developer 10',    'developer', 'keymandeveloper-$version.exe', 'stable');
?>

<p><a href="https://help.keyman.com/developer/10.0/">Keyman Developer 10</a> allows you to create
  keyboard layouts for any popular platform for any language around the world. Create keyboards for any script in
  Unicode 11.0 and associate them with BCP 47 language identifiers.</p>
