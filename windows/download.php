<?php
  require_once('includes/template.php');
  require_once('includes/ui/downloads.php');

  // Required
  head([
    'title' =>'Download Keyman for Windows ' . $stable_version,
    'css' => ['template.css','index.css','desktop-download.css'],
    'js' => ['download.js'],
    'showMenu' => true
  ]);
?>
<div class="download-stable" id="vista">
    <p>Keyman <?= $stable_version ?> for Windows is not compatible with Windows Vista. Please download Keyman Desktop 8.0 instead from our <a href="/downloads/archive/">archived downloads page</a>.</p>
</div>
<div class="download-stable" id="xp">
    <p>Keyman <?= $stable_version ?> for Windows is not compatible with Windows XP. Please download Keyman Desktop 8.0 instead from our <a href="/downloads/archive/">archived downloads page</a>.</p>
</div>

<h2 class="red underline">Download Keyman <?= $stable_version ?> for Windows - completely free</h2>
<p>
    Keyman is a program that reconfigures your keyboard to type in another language. This download provides a simple installer for Keyman for your language. Start by typing the name of your language and clicking the Search button.
</p>
<p>
    Keyman <?= $stable_version ?> for Windows is compatible with Windows 7 and later. If you have an older version of Windows, please download Keyman Desktop 8.0 from our <a href="/downloads/archive/">archived downloads page</a>.
</p>
<div class="download-stable" id="download-with-language">
    <h3>Keyman <?= $stable_version ?> for Windows for your language</h3>
    <form method="get" action="/keyboards" name="fsearch3">
        <label for="language-search3" id="lang-label">Language name:</label>
        <input id="language-search3" type="text" placeholder="Enter language" name="q">
        <input id="search-submit3" type="image" src="<?php echo cdn('img/search-button.png'); ?>" value="Search" onclick="if(document.getElementById('language-search3').value==''){return false;}">
    </form>
</div>

<div class="section section-languages">
    <h2 class="section-heading">Or select a language from the list below:</h2>
    <?php require_once('includes/ui/download-links.php'); ?>
</div>
<h2 class="red underline">Download Keyman <?= $stable_version ?> for Windows without any keyboards</h2>
<p>
    Keyman for Windows can be downloaded without any keyboard layouts. This is a good option if you wish to upgrade an existing installation, preserving your existing configuration and keyboard layouts, or if you wish to use Keyman for Windows for multiple languages. Keyboard layouts can be added after Keyman for Windows has been installed.
</p>

<a id='standalone'></a>
<?php
  downloadLargeCTA('Keyman for Windows', 'windows', 'stable', 'keyman-$version.exe');
?>
