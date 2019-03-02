<?php
  require_once('includes/template.php');
  require_once('includes/ui/downloads.php');
  
  // Required
  head([
    'title' =>'Download Keyman Desktop ' . $stable_version,
    'css' => ['template.css','index.css','desktop-download.css'],
    'js' => ['download.js'],
    'showMenu' => true
  ]);
?>
<div class="download-stable" id="vista">
    <p>Keyman Desktop <?php echo $stable_version; ?> is not compatible with Windows Vista. Please download Keyman Desktop 8.0 instead from our <a href="/downloads/archive/">archived downloads page</a>.</p>
</div>
<div class="download-stable" id="xp">
    <p>Keyman Desktop <?php echo $stable_version; ?> is not compatible with Windows XP. Please download Keyman Desktop 8.0 instead from our <a href="/downloads/archive/">archived downloads page</a>.</p>
</div>

<h2 class="red underline">Download Keyman Desktop <?php echo $stable_version; ?> - completely free</h2>
<p>
    Keyman Desktop is a program that reconfigures your keyboard to type in another language. This download provides a simple installer for Keyman Desktop for your language. Start by typing the name of your language and clicking the Search button.
</p>
<p>
    Keyman Desktop <?php echo $stable_version; ?> is compatible with Windows 7, Windows 8, Windows 8.1 and Windows 10. If you have an older version of Windows, please download Keyman Desktop 8.0 from our <a href="/downloads/archive/">archived downloads page</a>.
</p>
<div class="download-stable" id="download-with-language">
    <h3>Keyman Desktop <?php echo $stable_version; ?> for your language</h3>
    <form method="get" action="/keyboards" name="fsearch">
        <label for="language-search" id="lang-label">Language name:</label>
        <input id="language-search" type="text" placeholder="Enter language" name="q">
        <input id="search-submit" type="image" src="<?php echo cdn('img/search-button.png'); ?>" value="Search" onclick="if(document.getElementById('language-search').value==''){return false;}">
    </form>
</div>

<div class="section section-languages">
    <h2 class="section-heading">Or select a language from the list below:</h2>
    <?php require_once('includes/ui/download-links.php'); ?>
</div>
<h2 class="red underline">Download Keyman Desktop <?php echo $stable_version; ?> without any keyboards</h2>
<p>
    Keyman Desktop can be downloaded without any keyboard layouts. This is a good option if you wish to upgrade an existing installation, preserving your existing configuration and keyboard layouts, or if you wish to use Keyman Desktop for multiple languages. Keyboard layouts can be added after Keyman Desktop has been installed.
</p>

<?php
  downloadLargeCTA('Keyman Desktop', 'windows', 'stable', 'keymandesktop-$version.exe');
?>
