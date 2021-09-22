<?php
  require_once('includes/template.php');
  require_once('includes/ui/downloads.php');

  // Required
  head([
    'title' =>'Download Keyman for macOS',
    'css' => ['template.css','index.css','desktop-download.css'],
    'js' => ['download.js'],
    'showMenu' => true
  ]);
?>
<h2 class="red underline">Download Keyman for macOS</h2>
<p>
    Keyman is a program that reconfigures your keyboard to type in another language. This download provides a simple installer for Keyman.
</p>
<p>
    Keyman <?php echo $stable_version; ?> for macOS is compatible with OS X Yosemite (10.10) and later.
</p>

<?php
  downloadLargeCTA('Keyman for macOS', 'mac', 'stable', 'keyman-$version.dmg');
?>
