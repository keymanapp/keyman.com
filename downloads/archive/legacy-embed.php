 <?php
  require_once('includes/template.php');
  require_once __DIR__ . '/../../_includes/autoload.php';
  use Keyman\Site\Common\KeymanHosts;

  // Required
  head([
    'title' =>'Activate Older Versions',
    'css' => ['template.css', 'feature-grid.css'],
    'showMenu' => false,
    'showHeader' => false,
    'foot' => false,
    'addSection2' => false // also avoids adding <div class='wrapper'> which is what we want
  ]);

  require_once('./static-keys.php');
?>
<div id='section2'>
<h2 class="red underline">About Keyman</h2>

<p>Keyman is now a free program. We recommend you download the latest version of Keyman from <a href='keyman:link?url=<?= KeymanHosts::Instance()->keyman_com ?>/downloads/'><?= KeymanHosts::Instance()->keyman_com_host ?></a>.</p>

<p>If you wish to continue using this version, please use the table below to find a free license key for activation:</p>

<?php
  render_static_keys(true);
?>

<script>
function activationResult(code, result, message, canElevate, wasElevated) {
  if(result) {
    alert('Your license has now been activated.');
    location.href = 'keyman:finishpurchase';
  } else {
    alert(message);
  }
}
</script>