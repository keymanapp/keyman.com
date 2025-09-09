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

  Locale::localize('keyboards');

  $head_options = [
    'title' =>Locale::_m('page_title'),
    'description' => Locale::_m('page_description'),
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

  <h2 class="red underline"><a href='/keyboards'><?= Locale::_m('page_title') ?></a></h2>

  <div id='search-box'>
    <form method='get' action='/keyboards' name='f'>
      <label for="search-q"><?= Locale::_m('keyboard_search') ?></label><input id="search-q" type="text" placeholder="<?= Locale::_m('enter_language') ?>" name="q"
      <?php if($embed == 'none') echo 'autofocus'; ?>>
      <input id="search-f" type="image" src="<?= cdn('img/search-button.png"') ?>" value="<?= Locale::_m('search') ?>" onclick="return do_search()">
      <label id="search-new"><a href='/keyboards<?=$session_query_q?>'><?= Locale::_m('new_search')?></a></label>
      <input id="search-obsolete" type="hidden" name="obsolete" value="0">
      <input id="search-page" type="hidden" name="page" value="1">
    </form>
  </div>

  <div id='search-results-container' class=''>
  <div id='search-results'></div>
  <div id='search-results-empty'>
    <p><?= Locale::_m('enter_name') ?> (<a href="?q=p:popular"><?= Locale::_m('popular_keyboards') ?></a> | <a href="?q=p:alphabetical"><?= Locale::_m('all_keyboards') ?></a>)</p>
    <br />
    <p><?= Locale::_m('hints') ?></p>
    <ul>
      <li><?= Locale::_m('searchbox_description') ?></li>
      <li><?= Locale::_m('searchbox_hint') ?> <code>k:</code> <?= Locale::_m('(keyboards)') ?> <code>l:</code> <?= Locale::_m('(languages)') ?> <code>s:</code> <?= Locale::_m('(scripts, writing systems) or') ?>
        <code>c:</code> <?= Locale::_m('(countries) to filter your search results. For example') ?> <code>c:thailand</code> <?= Locale::_m('searches for keyboards for languages used in Thailand.') ?></li>
      <li><?= Locale::_m('use_prefix') ?> <code>l:id:</code> <?= Locale::_m('to search for a BCP 47 language tag, for example') ?> <code>l:id:ti-et</code> <?= Locale::_m('searches_tigrigna') ?></li>
    </ul>
  </div>
</div>

<?php
  if($embed == 'none')
    Foot::render();
