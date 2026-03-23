<?php
  require_once('includes/template.php');
  require_once('includes/ui/downloads.php');

  // Required
  head([
    'title' =>'Download Keyman for macOS',
    'css' => ['template.css','index.css','desktop-download.css','prism.css'],
    'js' => ['download.js','prism.js'],
    'showMenu' => true
  ]);
?>
<h2 class="red underline">Download Keyman for macOS</h2>
<p>
    Keyman is a program that reconfigures your keyboard to type in another language. This download provides a simple installer for Keyman on macOS.
</p>
<p>
    Keyman <?php echo $stable_version; ?> for macOS is compatible with OS X Yosemite (10.10) and later.
</p>

<h3 class="red underline">Install directly from keyman.com</h3>

<?php
  downloadLargeCTA('Keyman for macOS', 'mac', 'stable', 'keyman-$version.dmg');
?>

<h3 class="red underline">Install via Homebrew</h3>
<p>You can also install Keyman with <a href='https://brew.sh'>Homebrew</a>:</p>

<pre><code class='language-shell'>brew install --cask keyman</code></pre>

<p>When installing Keyman with Homebrew, you must manually add the Keyman
   input source under:</p>

<p><b>Preferences → Keyboard → Input Sources</b></p>
