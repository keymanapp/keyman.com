<?php
  require_once('includes/template.php');
  require_once('./session.php');
  require_once __DIR__ . '/../_includes/autoload.php';
  use Keyman\Site\Common\KeymanHosts;

  $head_options = [
    'title' =>'Keyboard Search',
    'css' => ['template.css', '../keyboard-search/search.css'],
    'js' => ['../keyboard-search/jquery.mark.js', '../keyboard-search/search.js']
];

  if($embed != 'none') {
    $head_options += [
      'showMenu' => false,
      'showHeader' => false,
      'foot' => false
    ];
    array_push($head_options['css'], '../keyboard-search/embed.css');
  }

  head($head_options);

  if($embed == 'none') {
?>
<script>
  var detail_page=false;
  var embed='none';
  var embed_query='';
</script>
<?php
  } else {
?>
<script>
  var detail_page=false;
  var embed='<?=$embed?>';
  var embed_query='<?=$session_query?>';
</script>

<div id='navigation'>
<?php
    if($embed != 'macos') { // TODO: check for Linux
?>
  <a class='nav-right' target='_blank' href='/keyboards'>Go to <?= KeymanHosts::Instance()->keyman_com_host ?>&nbsp;</a>
<?php
    }
    else {
?>
  <!–– The WebView class does not handle target='_blank' well.
  Keyman for macOS will be able to interpret the target session query variable
  and know to pop this page (without that variable) open in the default browser. ––>
  <a class='nav-right' href='keyman:link?url=<?= KeymanHosts::Instance()->keyman_com ?>/keyboards'>Go to <?= KeymanHosts::Instance()->keyman_com_host ?></a>
<?php
    }
?>
  <a href='/keyboards<?=$session_query_q?>'>Home</a>
</div>

<?php
  }
?>

<h2 class="red underline"><a href='/keyboards'>Keyboard Search</a></h2>

<div id='search-box'>
  <form method='get' action='/keyboards' name='f'>
    <input id="search-q" type="text" placeholder="Enter language or keyboard" name="q" autofocus>
    <input id="search-f" type="image" src="<?= cdn('img/search-button.png"') ?>" value="Search" onclick="return do_search()">
    <input id="search-obsolete" type="hidden" name="obsolete" value="0">
    <input id="search-page" type="hidden" name="page" value="1">
  </form>
</div>

<div id='search-results-container'>
<div id='search-results'></div>
<div id='search-results-empty'>
  <p>Enter the name of a keyboard or language to search for. (<a href="?q=p:*">Popular keyboards</a>)</p>
  <br />
  <p>Hints</p>
  <ul>
    <li>The search always returns a list of keyboards. It searches for keyboard names and details, language names, country names and script names.</li>
    <li>You can apply prefixes <code>k:</code> (keyboards), <code>l:</code> (languages), <code>s:</code> (scripts, writing systems)
    or <code>c:</code> (countries) to restrict your search results.</li>
    <li>Use prefix <code>l:id:</code> to search for a BCP 47 language tag.</li>
  </ul>
</div>
