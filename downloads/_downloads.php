<?php
  downloadSection('product_windows',            'windows', 'keyman-$version.exe', 'stable');
  downloadSection('product_macos',              'mac',     'keyman-$version.dmg', 'stable');
  downloadSection('product_android',            'android', 'keyman-$version.apk', 'stable');
?>

<p><?= _m_Downloads('available_on_play_store') ?></p>
<?= $playstoreTable ?>

<h2 id="iOS" class='red underline'><?= _m_Downloads('product_ios') ?></h2>
<p><?= _m_Downloads('available_on_app_store') ?></p>
<?= $appstoreTable ?>

<h2 id='linux' class='red underline'><?= _m_Downloads('product_linux') ?></h2>

<ul><li><?= _m_Downloads('install_via_launchpad') ?></li></ul>
<blockquote><pre class='language-bash code'><code>sudo add-apt-repository ppa:keymanapp/keyman
sudo apt install keyman onboard-keyman</code></pre></blockquote>

<h2 class='red underline large'><?= _m_Downloads('products_for_software_developers') ?></h2>

<?php
  downloadSection('product_keymanweb',             'web',       'keymanweb-$version.zip',             'stable');
  downloadSection('product_developer',             'developer', 'keymandeveloper-$version.exe',       'stable');
  downloadSection('product_engine_android',        'android',   'keyman-engine-android-$version.zip', 'stable', 'android-engine');
  downloadSection('product_engine_ios',            'ios',       'keyman-engine-ios-$version.zip',     'stable', 'ios-engine');
?>

<br/>
