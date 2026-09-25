<?php
  use \Keyman\Site\com\keyman\DownloadUI;

  DownloadUI::downloadSection('windows', 'stable');
  DownloadUI::downloadSection('mac',     'stable');
  DownloadUI::downloadSection('android', 'stable');
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
  DownloadUI::downloadSection('web',       'stable');
  DownloadUI::downloadSection('developer', 'stable');
  DownloadUI::downloadSection('android',   'stable', 'android-engine');
  DownloadUI::downloadSection('ios',       'stable', 'ios-engine');
?>

<br/>
