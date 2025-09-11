<?php
  require_once('includes/template.php');
  require_once('./session.php');
  require_once __DIR__ . '/../_includes/autoload.php';
  use Keyman\Site\com\keyman\Util;
  use Keyman\Site\com\keyman\templates\Head;
  use Keyman\Site\com\keyman\templates\Menu;
  use Keyman\Site\com\keyman\templates\Body;
  use Keyman\Site\com\keyman\templates\Foot;
  use Keyman\Site\com\keyman\Locale;

  function _m($id) {
    return Locale::m('keyboards', $id);
  }

  $head_options = [
    'title' => _m('page_title'),
    'description' => _m('page_description'),
    'css' => [Util::cdn('css/template.css'), Util::cdn('keyboard-search/search.css')],
    'js' => [Util::cdn('keyboard-search/jquery.mark.js'), Util::cdn('keyboard-search/dedicated-landing-pages.js'),
      Util::cdn('keyboard-search/search.js')]
  ];

  if($embed != 'none') {
    $head_options += [
      'showMenu' => false,
      'showHeader' => false,
      'foot' => false
    ];
    array_push($head_options['css'], Util::cdn('keyboard-search/embed.css'));
  }
  Head::render($head_options);
  if($embed == 'none')
    Menu::render([]); // we'll be doing client-side os detection now
  Body::render();
?>

<script>
  var embed='<?=$embed?>';
  var embed_query='<?=$session_query?>';

  if(embed != 'none') {
    // For an iframe hosted in Download Keyboards dialog, we cannot use
    // autofocus because it is cross-origin. However, setting focus
    // programatically works here.
    window.addEventListener('load', function() {
      document.getElementById('search-q').focus();
    });
  }
</script>

<div class='<?= $embed == 'none' ? '' : 'embed embed-'.$embed ?>'>

  <h2 class="red underline"><a href='/keyboards'><?= _m('page_title') ?></a></h2>

  <div id='search-box'>
    <form method='get' action='/keyboards' name='f'>
      <label for="search-q"><?= _m('keyboard_search') ?></label><input id="search-q" type="text" placeholder="<?= _m('enter_language') ?>" name="q"
      <?php if($embed == 'none') echo 'autofocus'; ?>>
      <input id="search-f" type="image" src="<?= cdn('img/search-button.png"') ?>" value="<?= _m('search') ?>" onclick="return do_search()">
      <label id="search-new"><a href='/keyboards<?=$session_query_q?>'><?= _m('new_search')?></a></label>
      <input id="search-obsolete" type="hidden" name="obsolete" value="0">
      <input id="search-page" type="hidden" name="page" value="1">
    </form>
  </div>

  <div id='search-results-container' class=''>
  <div id='search-results'></div>
  <div id='search-results-empty'>
    <p><?= _m('enter_name') ?> (<a href="?q=p:popular"><?= _m('popular_keyboards') ?></a> | <a href="?q=p:alphabetical"><?= _m('all_keyboards') ?></a>)</p>
    <br />
    <p><?= _m('hints') ?></p>
    <ul>
      <li><?= _m('searchbox_description') ?></li>
      <li><?= _m('searchbox_hint') ?> <code>k:</code> <?= _m('(keyboards)') ?> <code>l:</code> <?= _m('(languages)') ?> <code>s:</code> <?= _m('(scripts, writing systems) or') ?>
        <code>c:</code> <?= _m('(countries) to filter your search results. For example') ?> <code>c:thailand</code> <?= _m('searches for keyboards for languages used in Thailand.') ?></li>
      <li><?= _m('use_prefix') ?> <code>l:id:</code> <?= _m('to search for a BCP 47 language tag, for example') ?> <code>l:id:ti-et</code> <?= _m('searches_tigrigna') ?></li>
    </ul>
  </div>
</div>

<?php
  if($embed == 'none')
    Foot::render();
