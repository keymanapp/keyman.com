 <?php
  require_once('includes/template.php');
  require_once __DIR__ . '/../../_includes/autoload.php';
  use Keyman\Site\Common\KeymanHosts;

  // Required
  head([
    'title' =>'Download Archives',
    'description' => 'Keyman download archive: static activation license keys',
    'css' => ['template.css', 'feature-grid.css'],
    'showMenu' => true
  ]);

  require_once('./static-keys.php');
',
    <meta name="description" content=”
  // These variables should be progressively added if we update older versions.
  // 14.0 onward uses 3 numbers instead of 4
  $ver_windows_16 = "16.0.147";
  $ver_windows_15 = "15.0.274";
  $ver_windows_14 = "14.0.294";
  $ver_windows_13 = "13.0.118.0";
  $ver_windows_12 = "12.0.66.0";
  $ver_windows_11 = "11.0.1361.0";
  $ver_windows_10 = "10.0.1208.0";
?>
<h2 class="red underline">Keyman Desktop Download Archive</h2>
<ul>
    <!-- TODO: use downloads API to get the latest 15.0 version -->
    <li><a href="<?= KeymanHosts::Instance()->downloads_keyman_com ?>/windows/stable/<?= $ver_windows_16 ?>/keyman-<?= $ver_windows_16 ?>.exe">Keyman for Windows <?= $ver_windows_16 ?> Download</a> (No activation required)</li>
    <li><a href="<?= KeymanHosts::Instance()->downloads_keyman_com ?>/windows/stable/<?= $ver_windows_15 ?>/keyman-<?= $ver_windows_15 ?>.exe">Keyman for Windows <?= $ver_windows_15 ?> Download</a> (No activation required)</li>
    <li><a href="<?= KeymanHosts::Instance()->downloads_keyman_com ?>/windows/stable/<?= $ver_windows_14 ?>/keyman-<?= $ver_windows_14 ?>.exe">Keyman for Windows <?= $ver_windows_14 ?> Download</a> (No activation required)</li>
    <li><a href="<?= KeymanHosts::Instance()->downloads_keyman_com ?>/windows/stable/<?= $ver_windows_13 ?>/keymandesktop-<?= $ver_windows_13 ?>.exe">Keyman Desktop <?= $ver_windows_13 ?> Download</a> (No activation required)</li>
    <li><a href="<?= KeymanHosts::Instance()->downloads_keyman_com ?>/windows/stable/<?= $ver_windows_12 ?>/keymandesktop-<?= $ver_windows_12 ?>.exe">Keyman Desktop <?= $ver_windows_12 ?> Download</a> (No activation required)</li>
    <li><a href="<?= KeymanHosts::Instance()->downloads_keyman_com ?>/windows/stable/<?= $ver_windows_11 ?>/keymandesktop-<?= $ver_windows_11 ?>.exe">Keyman Desktop <?= $ver_windows_11 ?> Download</a> (No activation required)</li>
    <li><a href="<?= KeymanHosts::Instance()->downloads_keyman_com ?>/windows/stable/<?= $ver_windows_10 ?>/keymandesktop-<?= $ver_windows_10 ?>.exe">Keyman Desktop <?= $ver_windows_10 ?> Download</a> (No activation required)</li>
    <li><a href="<?= KeymanHosts::Instance()->downloads_keyman_com ?>/windows/stable/9.0.528.0/keymandesktop-9.0.528.0.exe">Keyman Desktop 9.0.528.0 Download</a> (No activation required)</li>
    <li><a href="<?= KeymanHosts::Instance()->downloads_keyman_com ?>/windows/stable/8.0.361.0/keymandesktop-8.0.361.0.exe">Keyman Desktop 8.0.361.0 Download</a> (No activation required)</li>
    <li><a href="<?= KeymanHosts::Instance()->downloads_keyman_com ?>/windows/stable/8.0.360.0/keymandesktop-8.0.360.0.exe">Keyman Desktop 8.0.360.0 Download</a> (Online static activation required)</li>
    <li><a href="<?= KeymanHosts::Instance()->downloads_keyman_com ?>/windows/stable/7.1.273.0/keymandesktoplight-7.1.273.0.exe">Keyman Desktop Light 7.1.273.0 Download</a> (Online static activation required)</li>
    <li><a href="<?= KeymanHosts::Instance()->downloads_keyman_com ?>/windows/stable/7.1.273.0/keymandesktoppro-7.1.273.0.exe">Keyman Desktop Pro 7.1.273.0 Download</a> (Online static activation required)</li>
    <li><a href="<?= KeymanHosts::Instance()->downloads_keyman_com ?>/windows/stable/6.2.183.0/keyman6-2-183-0.exe">Keyman 6.2.183.0 Download</a> (Offline static activation required)</li>
</ul>

<h2 class="red underline">Keyman Developer Download Archive</h2>
<ul>
    <!-- TODO: use downloads API to get the latest 13.0 version -->
    <li><a href="<?= KeymanHosts::Instance()->downloads_keyman_com ?>/developer/stable/<?= $ver_windows_16 ?>/keymandeveloper-<?= $ver_windows_16 ?>.exe">Keyman Developer <?= $ver_windows_16 ?> Download</a> (No activation required)</li>
    <li><a href="<?= KeymanHosts::Instance()->downloads_keyman_com ?>/developer/stable/<?= $ver_windows_15 ?>/keymandeveloper-<?= $ver_windows_15 ?>.exe">Keyman Developer <?= $ver_windows_15 ?> Download</a> (No activation required)</li>
    <li><a href="<?= KeymanHosts::Instance()->downloads_keyman_com ?>/developer/stable/<?= $ver_windows_14 ?>/keymandeveloper-<?= $ver_windows_14 ?>.exe">Keyman Developer <?= $ver_windows_14 ?> Download</a> (No activation required)</li>
    <li><a href="<?= KeymanHosts::Instance()->downloads_keyman_com ?>/developer/stable/<?= $ver_windows_13 ?>/keymandeveloper-<?= $ver_windows_13 ?>.exe">Keyman Developer <?= $ver_windows_13 ?> Download</a> (No activation required)</li>
    <li><a href="<?= KeymanHosts::Instance()->downloads_keyman_com ?>/developer/stable/<?= $ver_windows_12 ?>/keymandeveloper-<?= $ver_windows_12 ?>.exe">Keyman Developer <?= $ver_windows_12 ?> Download</a> (No activation required)</li>
    <li><a href="<?= KeymanHosts::Instance()->downloads_keyman_com ?>/developer/stable/<?= $ver_windows_11 ?>/keymandeveloper-<?= $ver_windows_11 ?>.exe">Keyman Developer <?= $ver_windows_11 ?> Download</a> (No activation required)</li>
    <li><a href="<?= KeymanHosts::Instance()->downloads_keyman_com ?>/developer/stable/<?= $ver_windows_10 ?>/keymandeveloper-<?= $ver_windows_10 ?>.exe">Keyman Developer <?= $ver_windows_10 ?> Download</a> (No activation required)</li>
    <li><a href="<?= KeymanHosts::Instance()->downloads_keyman_com ?>/developer/stable/9.0.526.0/keymandeveloper-9.0.526.0.exe">Keyman Developer 9.0.526.0 Download</a> (No activation required)</li>
    <li><a href="<?= KeymanHosts::Instance()->downloads_keyman_com ?>/developer/stable/8.0.360.0/keymandeveloper-8.0.360.0.exe">Keyman Developer 8.0.360.0 Download</a> (Online static activation required)</li>
</ul>

<h2 class="red underline">Keyman Developer kmcomp Download Archive</h2>
<ul>
  <li><a href="<?=KeymanHosts::Instance()->downloads_keyman_com ?>/developer/stable/<?= $ver_windows_16 ?>/kmcomp-<?= $ver_windows_16 ?>.zip">Keyman Developer kmcomp <?= $ver_windows_16 ?> zip Download</a></li>
</ul>

<h2 class="red underline">Obsolete Keyboards</h2>

<p>Keyboards that are non-Unicode or older versions may be downloaded from the following link. Generally, unless you know you have a specific
need for an older keyboard, you should download the latest version from the <a href='/keyboards/'>Keyboard Search</a>. Note that the search
for obsolete keyboards will return both current and obsolete keyboards.</p>

<ul>
  <li><a href='/keyboards/?obsolete=1'>Obsolete keyboard search</a></li>
</ul>

<h2 class="red underline">Static activation license keys</h2>

<p>Keyman Desktop 9.0 and earlier versions are now available for free. We have made special builds of two older versions of Keyman Desktop available which do not require any activation: 9.0.528.0 and 8.0.361.0. These are feature identical to the Professional Editions.</p>

<p>All other downloads listed with "static activation required" still require a license number to complete activation. However, the license number can be used without limitation on as many computers as needed.
Those that are listed with "Online static activation" require connection to an online license server.</p>

<p>If you have a license for an older version of Keyman, your old license numbers will continue to work.</p>

<p>Please note: manual activation support requests will not be accepted. <a href='https://secure.tavultesoft.com/support/activate.php'>Self-service manual activation</a>.</p>

<?php
  render_static_keys(false);
?>
