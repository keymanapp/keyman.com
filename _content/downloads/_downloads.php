<?php
  downloadSection('Keyman for Windows',         'windows', 'keyman-$version.exe', 'stable');
  downloadSection('Keyman for macOS',           'mac',     'keyman-$version.dmg', 'stable');
  downloadSection('Keyman for Android',         'android', 'keyman-$version.apk', 'stable');
?>

<p>Keyman for Android is also available on the Play Store.</p>
<?= $playstoreTable ?>

<h2 id="iOS" class='red underline'>Keyman for iPhone and iPad</h2>
<p>Keyman for iPhone and iPad can be found on the App Store.</p>
<?= $appstoreTable ?>

<h2 id='linux' class='red underline'>Keyman for Linux</h2>

<li>Ubuntu, Wasta-Linux: Keyman for Linux can be installed via launchpad:</li>
<blockquote><pre class='language-bash code'><code>sudo add-apt-repository ppa:keymanapp/keyman
sudo apt install keyman onboard-keyman</code></pre></blockquote>

<h2 class='red underline large'>Products for Software Developers</h2>

<?php
  downloadSection('KeymanWeb',                     'web',       'keymanweb-$version.zip',             'stable');
  downloadSection('Keyman Developer',              'developer', 'keymandeveloper-$version.exe',       'stable');
  downloadSection('Keyman Engine for Android',     'android',   'keyman-engine-android-$version.zip', 'stable', 'android-engine');
  downloadSection('Keyman Engine for iOS',         'ios',       'keyman-engine-ios-$version.zip',     'stable', 'ios-engine');
?>

<br/>
