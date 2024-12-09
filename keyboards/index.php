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

  // Of array of strings at top of file
  // by msgid 
  $keyboardIndexStrings = localize('keyboards', [
    'Keyboard Search',
    'Keyman Keyboard Search',
    'Keyboard search%s',
    'Enter language or keyboard',
    'Search',
    'New search',
    'Enter the name of a keyboard or language to search for%s',
    'Popular keyboards',
    'All keyboards',
    'Hints',
    'The search always returns a list of keyboards. It searches for keyboard names and details, language names, country names and script names.',
    'You can apply prefixes',
    '%skeyboards%s',
    '%slanguages%s',
    '%sscripts, writing systems%s or',
    '%scountries%s to filter your search results. For example',
    'searches for keyboards for languages used in Thailand.',
    'Use prefix',
    'to search for a BCP 47 language tag, for example',
    'searches for Tigrigna %sEthiopia%s',    
  ]);

  function localize($domain, $strings) {
    bindtextdomain("$domain-fr-FR", __DIR__ . "/../_includes/locale");
    bindtextdomain("$domain-es-ES", __DIR__ . "/../_includes/locale");

    $previousTextDomain = textdomain(NULL);
    Locale::setTextDomain($domain);

    $result = [];
    foreach($strings as $s) {
      $result[$s] = _($s);
    }

    // Restore textdomain
    textdomain($previousTextDomain);
    return $result;
  }

  $head_options = [
    'title' => $keyboardIndexStrings['Keyboard Search'],
    'description' => $keyboardIndexStrings['Keyman Keyboard Search'],
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

  <h2 class="red underline"><a href='/keyboards'><?= $keyboardIndexStrings['Keyboard Search'] ?></a></h2>

  <div id='search-box'>
    <form method='get' action='/keyboards' name='f'>
      <label for="search-q"><?= Locale::_s($keyboardIndexStrings['Keyboard search%s'], ":") ?></label><input id="search-q" type="text" placeholder="<?= $keyboardIndexStrings['Enter language or keyboard'] ?>" name="q"
      <?php if($embed == 'none') echo 'autofocus'; ?>>
      <input id="search-f" type="image" src="<?= cdn('img/search-button.png"') ?>" value="<?= $keyboardIndexStrings['Search'] ?>" onclick="return do_search()">
      <label id="search-new"><a href='/keyboards<?=$session_query_q?>'><?= $keyboardIndexStrings['New search'] ?></a></label>
      <input id="search-obsolete" type="hidden" name="obsolete" value="0">
      <input id="search-page" type="hidden" name="page" value="1">
    </form>
  </div>

  <div id='search-results-container' class=''>
  <div id='search-results'></div>
  <div id='search-results-empty'>
    <p>
      <?= Locale::_s($keyboardIndexStrings['Enter the name of a keyboard or language to search for%s'], ". (") ?>
      <a href="?q=p:popular"><?= $keyboardIndexStrings['Popular keyboards'] ?></a> | 
      <a href="?q=p:alphabetical"><?= $keyboardIndexStrings['All keyboards'] ?></a>)
    </p>
    <br />
    <p><?= $keyboardIndexStrings['Hints'] ?></p>
    <ul>
      <li>
        <?= $keyboardIndexStrings['The search always returns a list of keyboards. ' .
          'It searches for keyboard names and details, language names, country names and script names.'] ?>
      </li>
      <li>
        <?= $keyboardIndexStrings['You can apply prefixes'] ?> 
        <code>k:</code> <?= Locale::_s($keyboardIndexStrings['%skeyboards%s'], "(", "), ") ?>
        <code>l:</code> <?= Locale::_s($keyboardIndexStrings['%slanguages%s'], "(", "), ") ?>
        <code>s:</code> <?= Locale::_s($keyboardIndexStrings['%sscripts, writing systems%s or'], "(", ")") ?>
        <code>c:</code> <?= Locale::_s($keyboardIndexStrings['%scountries%s to filter your search results. For example'], "(", ")") ?> 
        <code>c:thailand</code> <?= $keyboardIndexStrings['searches for keyboards for languages used in Thailand.'] ?>
      </li>
      <li>
        <?= $keyboardIndexStrings['Use prefix'] ?> 
        <code>l:id:</code> <?= $keyboardIndexStrings['to search for a BCP 47 language tag, for example'] ?> 
        <code>l:id:ti-et</code> <?= Locale::_s($keyboardIndexStrings['searches for Tigrigna %sEthiopia%s'], "(", ").") ?>
      </li>
    </ul>
  </div>
</div>

<?php
  if($embed == 'none')
    Foot::render();
