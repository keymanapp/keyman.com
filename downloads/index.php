<?php
  require_once('includes/template.php');
  require_once('includes/ui/downloads.php');
  require_once('includes/appstore.php');
  require_once('includes/playstore.php');

  // Required
  head([
    'title' =>'Keyman Downloads',
    'css' => ['template.css','index.css','app-store-links.css', 'prism.css'],
    'js' => ['prism.js'],
    'showMenu' => true
  ]);
?>

<h2 class="red underline large">Keyman Downloads</h2>

<p>
  Get the latest version of Keyman here. These are standalone downloads and do not contain keyboard layouts
  for your language. See also the <a href='pre-release'>pre-release download page</a> and the <a href='archive'>old versions download page</a>.
</p>

<p><a href='<?=$helphost?>/version-history'>Keyman version history</a> (all products)</p>

<?php
  require_once('./_downloads.php');
?>
