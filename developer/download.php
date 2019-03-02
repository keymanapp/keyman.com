<?php
  require_once('includes/template.php');
  require_once('includes/ui/downloads.php');
  
  // Required
  head([
    'title' =>'Download Keyman Developer ' . $stable_version,
    'css' => ['template.css','feature-grid.css','index.css','desktop-download.css'],
    'js' => ['download.js'],
    'showMenu' => true
  ]);
?>
<div class="download-stable" id="vista">
    <p>Keyman Developer <?php echo $stable_version; ?> is not compatible with Windows Vista. Please download Keyman Developer 8.0 instead from our <a href="/downloads/archive/">archived downloads page</a>.</p>
</div>
<div class="download-stable" id="xp">
    <p>Keyman Developer <?php echo $stable_version; ?> is not compatible with Windows XP. Please download Keyman Developer 8.0 instead from our <a href="/downloads/archive/">archived downloads page</a>.</p>
</div>

<h2 class="red underline">Download Keyman Developer <?php echo $stable_version; ?></h2>
<p>
    Keyman Developer <?php echo $stable_version; ?> is compatible with Windows 7, Windows 8, Windows 8.1 and Windows 10. If you have an older version of Windows, please download Keyman Developer 8.0 from our <a href="/downloads/archive/">archived downloads page</a>.
</p>

<?php
  downloadLargeCTA('Keyman Developer', 'developer', 'stable', 'keymandeveloper-$version.exe');
  downloadLargeCTA('kmcomp Compiler', 'developer', 'stable', 'kmcomp-$version.zip');
?>
