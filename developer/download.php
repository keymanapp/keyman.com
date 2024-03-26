<?php
  require_once('includes/template.php');
  require_once('includes/ui/downloads.php');
  require_once __DIR__ . '/../_includes/autoload.php';
  use Keyman\Site\Common\KeymanHosts;

  // Required
  head([
    'title' =>'Download Keyman Developer ' . $stable_version,
    'css' => ['template.css','feature-grid.css','index.css','desktop-download.css','prism.css'],
    'js' => ['download.js','prism.js'],
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
    Keyman Developer <?php echo $stable_version; ?> is compatible with Windows 10 and Windows 11. If you have an older version of Windows, please download an earlier version of Keyman Developer from our <a href="/downloads/archive/">archived downloads page</a>.
</p>

<?php
  downloadLargeCTA('Keyman Developer', 'developer', 'stable', 'keymandeveloper-$version.exe');
?>

<h2 class='red underline'>Keyman Developer Command Line Tools</h2>

<p>
  The Keyman Developer command line tool kmcomp, which was a Windows-only console application, has been replaced by kmc.
  kmc is a cross-platform application, running on Windows, Linux, and macOS, built in node.js.
</p>

<p>
  In Keyman Developer, kmc is located in "%ProgramFiles(x86)%\Keyman\Keyman Developer".
</p>

<p>
  kmc is also available as an npm module for Windows, macOS, and Linux developers:
</p>

<pre class="language-bash code"><code>
  npm install -g @keymanapp/kmc
</code></pre>

<p>
  For kmcomp, please download from our <a href="/downloads/archive/">archived downloads page</a>.
</p>
