<?php
  require_once('includes/template.php');
  require_once('includes/ui/downloads.php');
  require_once __DIR__ . '/../_includes/autoload.php';
  use Keyman\Site\Common\KeymanHosts;

  // Required
  head([
    'title' =>'Download Keyman for Linux',
    'css' => ['template.css','index.css','desktop-download.css','prism.css'],
    'js' => ['download.js','prism.js'],
    'showMenu' => true
  ]);
?>
<h2 class="red underline">Download Keyman for Linux</h2>
<p>
  Keyman is a program that reconfigures your keyboard to type in another language. The installation for Keyman for Linux depends on your Linux distribution.
</p>
<br/>

<h3 class='red underline'>Ubuntu, Wasta-Linux</h3>
<p>
  Keyman for Linux is currently available via Launchpad:
</p>
<pre><code class='language-bash'>sudo add-apt-repository ppa:keymanapp/keyman
sudo apt install keyman onboard-keyman</code></pre>

<h3 class='red underline'>Debian</h3>

<p>
  Keyman for Linux packages are also available in any current Debian at:
  <a href='https://packages.debian.org/keyman'>https://packages.debian.org/keyman</a>
</p>

<h3 class='red underline'>Compile from source</h3>

<p>
  The source for Keyman <?php echo $stable_version; ?> for Linux can be cloned from <a href='https://github.com/keymanapp/keyman'>GitHub</a> and once cloned,
  follow the instructions at <a href='https://github.com/keymanapp/tree/master/linux/README.md'>README.md</a> to build and install on your system.
</p>

<ul>
  <li><a href='<?= KeymanHosts::Instance()->downloads_keyman_com ?>/linux'>All Linux downloads</a>
  <li>apt install ...
</ul>
