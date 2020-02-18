 <?php
  require_once('includes/template.php');

  // Required
  head([
    'title' =>'Download Archives',
    'css' => ['template.css', 'feature-grid.css'],
    'showMenu' => true
  ]);

  require_once('./static-keys.php');

  // These variables should be progressively added if we update older versions.
  $ver_windows_12 = "12.0.66.0";
  $ver_windows_11 = "11.0.1361.0";
  $ver_windows_10 = "10.0.1208.0";
?>
<h2 class="red underline">Keyman Desktop Download Archive</h2>
<ul>
    <!-- TODO: use downloads API to get the latest 12.0 version -->
    <li><a href="https://downloads.keyman.com/windows/stable/<?= $ver_windows_12 ?>/keymandesktop-<?= $ver_windows_12 ?>.exe">Keyman Desktop <?= $ver_windows_12 ?> Download</a> (No activation required)</li>
    <li><a href="https://downloads.keyman.com/windows/stable/<?= $ver_windows_11 ?>/keymandesktop-<?= $ver_windows_11 ?>.exe">Keyman Desktop <?= $ver_windows_11 ?> Download</a> (No activation required)</li>
    <li><a href="https://downloads.keyman.com/windows/stable/<?= $ver_windows_10 ?>/keymandesktop-<?= $ver_windows_10 ?>.exe">Keyman Desktop <?= $ver_windows_10 ?> Download</a> (No activation required)</li>
    <li><a href="https://downloads.keyman.com/windows/stable/9.0.528.0/keymandesktop-9.0.528.0.exe">Keyman Desktop 9.0.528.0 Download</a> (No activation required)</li>
    <li><a href="https://downloads.keyman.com/windows/stable/8.0.361.0/keymandesktop-8.0.361.0.exe">Keyman Desktop 8.0.361.0 Download</a> (No activation required)</li>
    <li><a href="https://downloads.keyman.com/windows/stable/8.0.360.0/keymandesktop-8.0.360.0.exe">Keyman Desktop 8.0.360.0 Download</a> (Online static activation required)</li>
    <li><a href="https://downloads.keyman.com/windows/stable/7.1.273.0/keymandesktoplight-7.1.273.0.exe">Keyman Desktop Light 7.1.273.0 Download</a> (Online static activation required)</li>
    <li><a href="https://downloads.keyman.com/windows/stable/7.1.273.0/keymandesktoppro-7.1.273.0.exe">Keyman Desktop Pro 7.1.273.0 Download</a> (Online static activation required)</li>
    <li><a href="https://downloads.keyman.com/windows/stable/6.2.183.0/keyman6-2-183-0.exe">Keyman 6.2.183.0 Download</a> (Offline static activation required)</li>
</ul>

<h2 class="red underline">Keyman Developer Download Archive</h2>
<ul>
    <!-- TODO: use downloads API to get the latest 12.0 version -->
    <li><a href="https://downloads.keyman.com/developer/stable/<?= $ver_windows_12 ?>/keymandeveloper-<?= $ver_windows_12 ?>.exe">Keyman Developer <?= $ver_windows_12 ?> Download</a> (No activation required)</li>
    <li><a href="https://downloads.keyman.com/developer/stable/<?= $ver_windows_11 ?>/keymandeveloper-<?= $ver_windows_11 ?>.exe">Keyman Developer <?= $ver_windows_11 ?> Download</a> (No activation required)</li>
    <li><a href="https://downloads.keyman.com/developer/stable/<?= $ver_windows_10 ?>/keymandeveloper-<?= $ver_windows_10 ?>.exe">Keyman Developer <?= $ver_windows_10 ?> Download</a> (No activation required)</li>
    <li><a href="https://downloads.keyman.com/developer/stable/9.0.526.0/keymandeveloper-9.0.526.0.exe">Keyman Developer 9.0.526.0 Download</a> (No activation required)</li>
    <li><a href="https://downloads.keyman.com/developer/stable/8.0.360.0/keymandeveloper-8.0.360.0.exe">Keyman Developer 8.0.360.0 Download</a> (Online static activation required)</li>
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
