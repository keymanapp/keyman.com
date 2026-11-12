<?php
  require_once _KEYMANCOM_INCLUDES . '/includes/template.php';
  require_once _KEYMANCOM_INCLUDES . '/autoload.php';
  use Keyman\Site\Common\KeymanHosts;
  use Keyman\Site\com\keyman\DownloadUI;

  // Required
  head([
    'title' =>'Download Keyman Developer ' . $stable_version,
    'css' => ['template.css','feature-grid.css','index.css','desktop-download.css','prism.css'],
    'js' => ['download.js','prism.js'],
    'showMenu' => true
  ]);
?>
<div class="download-stable" id="vista">
    <p>Keyman Developer <?php echo $stable_version; ?> is not compatible with Windows Vista. Please download Keyman Developer 8.0 instead from our <a href="../downloads/archive/">archived downloads page</a>.</p>
</div>
<div class="download-stable" id="xp">
    <p>Keyman Developer <?php echo $stable_version; ?> is not compatible with Windows XP. Please download Keyman Developer 8.0 instead from our <a href="../downloads/archive/">archived downloads page</a>.</p>
</div>

<h2 class="red underline">Download Keyman Developer <?php echo $stable_version; ?></h2>
<p>
    Keyman Developer <?php echo $stable_version; ?> is compatible with Windows 10 and Windows 11. If you have an older version of Windows, please download an earlier version of Keyman Developer from our <a href="../downloads/archive/">archived downloads page</a>.
</p>

<?php
  DownloadUI::downloadLargeCTA('developer', 'stable', true);
?>

<h2 class='red underline'>Keyman Developer Command Line Tools</h2>

<p>
  <code class="language-none">kmc</code> is a cross-platform command-line tool, running on Windows, Linux, and macOS, built in Node.js.
</p>

<p>
  <code class="language-none">kmc</code> is bundled with the Keyman Developer download above. In Keyman Developer, kmc is located in <code class="language-none">%ProgramFiles(x86)%\Keyman\Keyman Developer</code>.
</p>

<p>
  kmc is also available as an <a href="https://npmjs.com/@keymanapp/kmc" target="_blank">npm module</a> for Windows, macOS, and Linux developers (install <a href="https://nodejs.org/" target="_blank">Node.js</a> first):
</p>

<pre class="language-bash code"><code>
  npm install -g @keymanapp/kmc
</code></pre>

<p>For some setups, you may need to have admin permissions to install:</p>

<pre class="language-bash code"><code>
  sudo npm install -g @keymanapp/kmc
</code></pre>

<p>&rArr; <a href="https://help.keyman.com/developer/current-version/reference/kmc/">kmc documentation</a></p>

<p>&rArr; The older tool kmcomp, which was a Windows-only console application, has been replaced by kmc. kmcomp is still available from <a href="../downloads/archive/">archived downloads</a></p>
