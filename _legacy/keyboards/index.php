<?php
  require_once('includes/template.php');
  require_once('./session.php');

  require_once __DIR__ . '/../_includes/autoload.php';
  use Keyman\Site\com\keyman\KeymanHosts;

  $head_options = [
    'title' =>'Keyboard Search'
  ];

  $head_options += [
    'showMenu' => false,
    'showHeader' => false,
    'foot' => false,
    'css' => ['template.css','../legacy-keyboard-search/embed.css']
  ];

  head($head_options);
?>

<script>
  var embed='<?=$embed?>';
  var embed_query='<?=$session_query?>';
</script>

<div id='navigation'>
  <a class='nav-right' target='_blank' href='/keyboards'>Go to <?= KeymanHosts::Instance()->keyman_com ?>&nbsp;</a>
  <a href='/keyboards<?=$session_query_q?>'>Home</a>
</div>

<form method='get' action='/keyboards' name='f'>
  <input type="hidden" name="embed" value="<?=$embed?>">
  <input type="hidden" name="version" value="<?$embed_version?>">
  <input id="search-q" type="hidden" name="q">
</form>

<div id='search-results'>
  <p>Loading...</p>
</div>

<script src="<?= cdn('legacy-keyboard-search/search.js'); ?>"></script>