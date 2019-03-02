<?php
  require_once('includes/template.php');
  require_once('./session.php');
  
  $head_options = [
    'title' =>'Keyboard Search'
  ];
  
  if($embed != 'none') {
    $head_options += [
      'showMenu' => false,
      'showHeader' => false,
      'foot' => false,
      'css' => ['template.css','../keyboard-search/embed.css']
    ];
  } else {
    $head_options += [
      'css' => ['template.css','../keyboard-search/search.css']
    ];
  }
  
  head($head_options);
  
  if($embed != 'none') {
?>

<script>
  var embed='<?=$embed?>';
  var embed_query='<?=$session_query?>';
</script>

<div id='navigation'>
<?php
  if($embed != 'macos') {
?>
  <a class='nav-right' target='_blank' href='/keyboards'>Go to keyman.com&nbsp;</a>
<?php
  }
  else {
?>
  <!––The WebView class does not handle target='_blank' well.
  Keyman for macOS will be able to interpret the target session query variable
  and know to pop this page (without that variable) open in the default browser. ––>
  <a class='nav-right' href='keyman:link?url=https://keyman.com/keyboards'>Go to keyman.com</a>
<?php
}
?>
  <a href='/keyboards<?=$session_query_q?>'>Home</a>
</div>

<?php
  }
  if($embed == 'none' || $embed == 'macos' || $embed == 'linux') {
    if($embed == 'none') {
?>

<script>
  var embed=false;
  var embed_query='';
</script>

<?php
    } /* $embed == 'none' */
?>

<h2 class="red underline"><a href='/keyboards'>Keyboard Search</a></h2>

<div id='search-box'>
  <form method='get' action='/keyboards' name='f'>
    <input id="search-q" type="text" placeholder="Enter language or keyboard" name="q" autofocus>
    <input id="search-f" type="image" src="<?= cdn('img/search-button.png"') ?>" value="Search" onclick="return do_search()">
  </form>
</div>

<div id='search-results'>
  <p>Enter the name of a keyboard or language to search for.</p>
</div>

<?php
  }
  else {
    // We are going to show just a list of languages. This is not dynamic so we load from API once
    // In future we may allow a search box as well, if we can resolve the issues with focus and
    // embedded browser
?>

<form method='get' action='/keyboards' name='f'>
  <input type="hidden" name="embed" value="<?=$embed?>">
  <input type="hidden" name="version" value="<?$embed_version?>">
  <input id="search-q" type="hidden" name="q">
</form>

<div id='search-results'>
  <p>Loading...</p>
</div>
<?php
}
?>

<script src='<?=cdn('keyboard-search/search.js')?>'></script>