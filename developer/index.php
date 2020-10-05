<?php
  require_once('includes/template.php');
  require_once __DIR__ . '/../_includes/autoload.php';
  use Keyman\Site\Common\KeymanHosts;

  // Required
  head([
    'title' => 'Keyman Developer | Build custom keyboard layouts for desktop, web, phone and tablets',
    'css' => ['template.css', 'index.css', 'dev.css'],
    'showMenu' => true,
    'banner' => [
        'title' => 'Create custom keyboards<br/><span id="title-small">for desktop, web and touch devices</span>',
        'image' => 'developer10.png',
        'background' => 'water'
    ]
  ]);
?>

<h2 class="red underline">Keyman Developer <?php echo $stable_version_int; ?></h2>
<p><a href="features.php">Keyman Developer <?php echo $stable_version_int; ?></a> is the most powerful tool for creating
  keyboard layouts for any popular platform for any language around the world. Build keyboards layouts for desktop,
  web, tablet and phone. Optimise your keyboards for each platform, including touch-and-hold keys and alternative layers.
</p>

<ul>
  <li><a href="features.php">See the features.</a></li>
  <li><a href='download.php'>Keyman Developer Downloads</a></li>
  <li><a href='<?= KeymanHosts::Instance()->help_keyman_com ?>/developer/<?php echo $stable_version; ?>/'>Keyman Developer Support</a></li>
</ul>

<?php
    if (betaTier()) {
?>
        <p>Want to try the Keyman Developer <?php echo $beta_version ?> Beta? <a href="/<?= $beta_version ?>/">Learn more</a></p>
<?php
    }
?>

<h2 class='red underline'>Open Source</h2>
<p>Keyman and Keyman Developer are open source: <a href='https://github.com/keymanapp/keyman'>GitHub home</a></p>

<h2 class="red underline">Keyman Engine</h2>
<p>Integrate our keyboards into your web, desktop and mobile applications with Keyman Engine.
  <br/><br/>
  <a href="../engine">Keyman Engine for Windows</a>
  <br/>
  <a href="../engine">Keyman Engine for macOS</a>
  <br/>
  <a href="../engine">Keyman Engine for iPhone and iPad</a>
  <br/>
  <a href="../engine">Keyman Engine for Android</a>
  <br/>
  <a href="keymanweb">Keyman Engine for Web</a>
</p>

<h2 class="red underline">Keyman Cloud Keyboard Repository</h2>
<p>Our keyboards are open source. Get involved, contribute, and learn from the source.
  <br/><br/>
  <a href="https://github.com/keymanapp/keyboards">Github repository</a>
  <br/>
  <a href="<?= KeymanHosts::Instance()->help_keyman_com ?>/developer/keyboards">Learn about the repository</a>
</p>

