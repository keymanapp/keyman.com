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
    'title' => _('Keyboard Search'),
    'description' => _('Keyman Keyboard Search'),
    'language' => Locale::currentLocale(),
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

  <h2 class="red underline"><a href='/keyboards'><?= _('Keyboard Search') ?></a></h2>

  <div id='search-box'>
    <form method='get' action='/keyboards' name='f'>
      <label for="search-q"><?= _('Keyboard search:') ?></label><input id="search-q" type="text" placeholder="<?= _('Enter language or keyboard') ?>" name="q"
      <?php if($embed == 'none') echo 'autofocus'; ?>>
      <input id="search-f" type="image" src="<?= cdn('img/search-button.png"') ?>" value="<?= _('Search') ?>" onclick="return do_search()">
      <label id="search-new"><a href='/keyboards<?=$session_query_q?>'><?= _('New search') ?></a></label>
      <input id="search-obsolete" type="hidden" name="obsolete" value="0">
      <input id="search-page" type="hidden" name="page" value="1">
    </form>
  </div>

  <div id='search-results-container' class=''>
  <div id='search-results'></div>
  <div id='search-results-empty'>
    <p>
      <?= _('Enter the name of a keyboard or language to search for') ?> (
      <a href="?q=p:popular"><?= _('Popular keyboards') ?></a> | 
      <a href="?q=p:alphabetical"><?= _('All keyboards') ?></a>)
    </p>
    <br />
    <p><?= _('Hints') ?></p>
    <ul>
      <li>
        <?= _('The search always returns a list of keyboards. ' .
          'It searches for keyboard names and details, language names, country names and script names.') ?>
      </li>
      <li>
        <?= _('You can apply prefixes') ?> 
        <code>k:</code> <?= _('(keyboards)') ?>
        <code>l:</code> <?= _('(languages)') ?>
        <code>s:</code> <?= _('(scripts, writing systems) or') ?>
        <code>c:</code> <?= _('(countries) to filter your search results. For example') ?> 
        <code>c:thailand</code> <?= _('searches for keyboards for languages used in Thailand.') ?>
      </li>
      <li>
        <?= _('Use prefix') ?> 
        <code>l:id:</code> <?= _('to search for a BCP 47 language tag, for example') ?> 
        <code>l:id:ti-et</code> <?= _('searches for Tigrigna (Ethiopia)') ?>
      </li>
    </ul>
  </div>
</div>

<?php
  if($embed == 'none')
    Foot::render();
