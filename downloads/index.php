<?php
  require_once('includes/template.php');
  require_once('includes/ui/downloads.php');
  require_once('includes/appstore.php');
  require_once('includes/playstore.php');
  
  // Required
  head([
    'title' =>'Keyman Downloads',
    'css' => ['template.css','index.css','app-store-links.css'],
    'showMenu' => true
  ]);           
?>

<h2 class="red underline large">Keyman Downloads</h2>

<p>
  Get the latest version of Keyman here. These are standalone downloads and do not contain keyboard layouts
  for your language. See also the <a href='pre-release'>pre-release download page</a> and the <a href='archive'>old versions download page</a>.
</p>

<p><a href='<?=$helphost?>/version-history'>Keyman version history</a> (all products)</p>

<?php
  downloadSection('Keyman Desktop for Windows',   'windows',   'keymandesktop-$version.exe', 'stable');
?>
<p>Note: Keyman Desktop 9.0.528.0 and above do not require online activation. Earlier releases of 9.0 do require activation.</p>

<?php
  downloadSection('Keyman for macOS',           'mac',     'keyman-$version.dmg', 'stable');
  downloadSection('Keyman for Android',         'android', 'keyman-$version.apk', 'stable');
?>

<p>Keyman for Android is also available on the Play Store.</p>
<?= $playstoreTable ?>

<h2 id="iOS" class='red underline'>Keyman for iPhone and iPad</h2>
<p>Keyman for iPhone and iPad can be found on the App Store.</p>
<?= $appstoreTable ?>

<h2 class='red underline large'>Products for Software Developers</h2>

<?php
  downloadSection('KeymanWeb',                     'web',       'keymanweb-$version.zip',             'stable');
  downloadSection('Keyman Developer',              'developer', 'keymandeveloper-$version.exe',       'stable');
  downloadSection('Keyman Engine for Android',     'android',   'keyman-engine-android-$version.zip', 'stable', 'android-engine');
  downloadSection('Keyman Engine for iOS',         'ios',       'keyman-engine-ios-$version.zip',     'stable', 'ios-engine');
?>

<br/>
