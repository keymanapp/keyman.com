<?php
  require_once('includes/template.php');
  require_once('../keyboards/session.php');

  $head_options = [
    'title' =>'Classical Greek Keyboards'
  ];

  if($embed != 'none') {
    $head_options += [
      'showMenu' => false,
      'showHeader' => false,
      'foot' => false,
      'css' => ['template.css', 'feature-grid.css', 'index.css', '../keyboard-search/embed.css']
    ];
  } else {
    $head_options += [
      'css' => ['template.css', 'feature-grid.css', 'index.css', '../keyboard-search/search.css']
    ];
  }

  head($head_options);
?>

<style>

  /* Features table */
  table.features {
    border-collapse: collapse;
    margin: 16px 8px;
  }

  table.features tr th,
  table.features tr td {
    text-align: center;
    vertical-align: middle;
    font: 8pt Tahoma;
    padding: 4px;
    margin: 0;
  }

  table.features thead tr th {
    text-align: center;
  }

  table.features tbody tr th {
    text-align: left;
  }

  table.features tr th {
    background: #ccccdd;
    border: solid 1px #888899;
    font-weight: bold;
  }

  table.features tr td {
    background: white;
    border: solid 1px #ccccdd;
  }

  table.features th#feature_topleft {
    background: #F2F2F2;;
    border: none;
  }

  table.features tr#feature_author th,
  table.features tr#feature_author td,
  table.features tr#feature_diacpredict th,
  table.features tr#feature_diacpredict td,
  table.features tr#feature_phonetic th,
  table.features tr#feature_phonetic td {
    border-bottom: solid 1px black;
  }

  table.features tr#feature_help td img {
    width: 58px; height: 20px;
  }

  table.features tr#feature_download td img {
    width: 82px; height: 20px;
  }

  /* Feature help */

  th a.featurehelp span {
    color: black;
    cursor: default;
  }

  th a.featurehelp img {
    vertical-align: bottom;
    float: right;
  }

  a.featurehelp {
    display: block;
    left: 0;
    top: 0;
    position: relative;
    text-decoration: none;
    width: 100%;
  }

  a.featurehelp img {
    border: none;
  }

  a.featurehelp div {
    position: relative; // give positioning to child div
  }

  a.featurehelp div div {
    display: none;
    position: absolute;
    border: solid 1px #6060c0;-webkit-border-radius: 0px 4px 4px; -moz-border-radius: 0px 4px 4px; border-radius: 0px 4px 4px;
    background: #e0e0ff;
    padding: 4px;
    color: black;
    top: 6px;
    left: 6px;
    margin: 0;
    font-size: 8pt;
    text-align: left;
    width: 150px;
    z-index: 100;
  }

  a.featurehelp:hover div {
    display: block;
  }

  #greek {
    font: 12pt "Palatino Linotype",Tahoma !important; border: solid 1px #D6AE7C; background: #FAF2E8;
    padding: 2px 3px; width:500px; margin: 15px 5px -5px;
    border-radius: 6px; -moz-border-radius: 6px; -webkit-border-radius: 6px
  }
  #greek div {
    margin: 3px 6px;
  }
  #greek div b {
    font-weight: bold;
  }
  #greek div i {
    font-style: italic;
  }

</style>

<h2 class="red underline">Classical Greek Keyboards</h2>
<p class='info'>
  Need to type in Biblical or Classical Greek? Choose from our selection of Polytonic Greek keyboards. These
  <a href='http://www.unicode.org/standard/WhatIsUnicode.html' target='_blank'>Unicode</a> keyboards run on Keyman Desktop in any Unicode Windows application.
</p>

<div id='greek' lang='gr'>
  <div title='The glorious gifts of the gods are not to be cast aside &mdash; Homer, The Iliad'>οὔ τοι ἀπόβλητ' ἐστὶ θεῶν ἐρικυδέα δῶρα &mdash; <b>Ὅμηρος</b>, &nbsp; <i>Ἰλιάς</i></div>
  <div title='No human thing is of serious importance &mdash; Plato'>οὔτε τι τῶν ἀνθρωπίνων ἄξιον ὂν μεγάλης σπουδῆς &mdash; <b>Πλάτων</b></div>
</div>

<h2 class='red underline'>Downloads</h2>

<?php

$keyboardlayouts = array(
  array(
    'nid' => 'galaxie',
    'name' => 'Galaxie Greek/Hebrew Mnemonic',
    'designkoine' => 'Y',
    'designattic' => 'N',
    'designmodern' => 'N',
    'desc' => 'Easy to use keyboard layouts designed for Biblical Greek and Hebrew. Optimised for US and European hardware keyboards.',
    'help' => 'galaxie_greek_hebrew_mnemonic',
    'author' => 'Galaxie and Tavultesoft',
    'id' => 'galaxie_greek_hebrew_mnemonic'),

  array(
    'nid' => 'lopez',
    'name' => 'Greek Classical',
    'designkoine' => 'N',
    'designattic' => 'Y',
    'designmodern' => 'N',
    'desc' => 'Classical Greek keyboard compatible with full visual feedback on accentuation.',
    'help' => 'greekclassical',
    'author' => 'Manuel Lopez',
    'id' => 'greekclassical'),

  array(
    'nid' => 'stanthony',
    'name' => 'Greek Polytonic SA',
    'designkoine' => 'Y',
    'designattic' => 'Y',
    'designmodern' => 'Y',
    'desc' => 'Comprehensive keyboard for serious students of classical and modern Greek. EZ features smart diacritics and auto-correct.',
    'help' => 'greek_polytonic_sa',
    'author' => "St. Anthony's Greek Orthodox Monastery",
    'id' => 'greek%20polytonic%20sa'),

  array(
    'nid' => 'stanthonyez',
    'name' => 'Greek Polytonic SA EZ',
    'designkoine' => 'Y',
    'designattic' => 'Y',
    'designmodern' => 'Y',
    'desc' => 'A very complete Greek Polytonic keyboard for serious students of classical and modern Greek, with intelligent rules for diacritics and spelling auto-correction.',
    'help' => 'greek_polytonic_sa',
    'author' => "St. Anthony's Greek Orthodox Monastery",
    'id' => 'greek%20polytonic%20sa'),

  array(
    'nid' => 'perry',
    'name' => 'Greek Polytonic Unicode',
    'designkoine' => 'N',
    'designattic' => 'Y',
    'designmodern' => 'N',
    'desc' => 'Follows the modern Greek hardware layout with additional keys for polytonic accents and Coptic letters.',
    'help' => 'grkpoly2',
    'author' => 'David J. Perry',
    'id' => 'grkpoly2'),

    array(
      'nid' => 'sil',
      'name' => 'Polytonic Greek (SIL)',
      'designkoine' => 'Y',
      'designattic' => 'N',
      'designmodern' => 'N',
      'desc' => 'Greek keyboard layout supporting Polytonic Greek, using precomposed characters.',
      'help' => 'sil_greek_polytonic',
      'author' => 'SIL International',
      'id' => 'sil_greek_polytonic')
  );

$features = array(
  array(
    'name' => 'Author',
    'id' => 'author'
  ),

  array(
    'name' => 'Diacritics typing order',
    'help' => 'Does the keyboard type diacritics before or after their base letter?',
    'id' => 'diacorder',
    'map' => array(
      'galaxie'     => 'After',
      'lopez'       => 'After',
      'stanthony'   => 'After',
      'stanthonyez' => 'After',
      'perry'       => 'Before',
      'sil'         => array('Either', 'Diacritics on capital base letters and word-initial base letters should be typed before, otherwise type the diacritics after the base letter'),
    )),

  array(
    'name' => 'Multiple diacritic order',
    'help' => 'In which order does the keyboard type double or triple diacritics (e.g. ᾢ)?',
    'id' => 'diac',
    'map' => array(
      'galaxie'     => 'Any',
      'lopez'       => 'Any',
      'stanthony'   => 'Any',
      'stanthonyez' => 'Any',
      'perry'       => 'Iota subscript last',
      'sil'         => 'Any'
    )),

  array(
    'name' => 'Standalone diacritics',
    'help' => 'Does the keyboard let you type diacritics as standalone characters, independent of the base letter?',
    'id' => 'diacindependent',
    'icon' => 'yes',
    'map' => array(
      'galaxie'     => 'yes',
      'lopez'       => 'no',
      'stanthony'   => 'yes',
      'stanthonyez' => 'yes',
      'perry'       => array('yes', 'Type the diacritic followed by the spacebar'),
      'sil'         => 'yes'
    )),

  array(
    'name' => 'Extended diacritics',
    'help' => 'Does the keyboard support the extended diacritics vrachy and macron?',
    'id' => 'diacextended',
    'icon' => 'yes',
    'map' => array(
      'galaxie'     => 'yes',
      'lopez'       => 'yes',
      'stanthony'   => 'no',
      'stanthonyez' => 'no',
      'perry'       => 'yes',
      'sil'         => 'no'
    )),

  array(
    'name' => 'Editable diacritics',
    'help' => 'Can you change or remove diacritics without deleting the base letter?',
    'id' => 'diacsmart',
    'icon' => 'yes',
    'map' => array(
      'galaxie'     => 'yes',
      'lopez'       => 'yes',
      'stanthony'   => 'yes',
      'stanthonyez' => array('1/2', 'Except for automatic diacritics which cannot be edited independently of the base letter'),
      'perry'       => 'no',
      'sil'         => array('1/2', 'Diacritics can be changed but not removed without deleting the base letter')
    )),

  array(
    'name' => 'Smart diacritics',
    'help' => 'Will diacritics be added automatically based on the rules of Greek grammar?',
    'id' => 'diacpredict',
    'icon' => 'yes',
    'map' => array(
      'galaxie'     => 'no',
      'lopez'       => 'no',
      'stanthony'   => 'no',
      'stanthonyez' => 'yes',
      'perry'       => 'no',
      'sil'         => 'yes'
    )),

  array(
    'name' => 'Automatic final sigma',
    'help' => 'Will sigma change to final sigma automatically at the end of a word?',
    'id' => 'finalsigma',
    'icon' => 'yes',
    'map' => array(
      'galaxie'     => 'yes',
      'lopez'       => 'yes',
      'stanthony'   => 'yes',
      'stanthonyez' => 'yes',
      'perry'       => 'no',
      'sil'         => 'yes'
    )),

  array(
    'name' => 'Spelling auto-correct',
    'help' => 'Does the keyboard automatically correct common misspellings?',
    'id' => 'autocorrect',
    'icon' => 'yes',
    'map' => array(
      'galaxie'     => 'no',
      'lopez'       => 'no',
      'stanthony'   => 'no',
      'stanthonyez' => 'yes',
      'perry'       => 'no',
      'sil'         => 'no'
    )),

  array(
    'name' => 'Greek numeral support',
    'id' => 'greeknumerals',
    'icon' => 'yes',
    'map' => array(
      'galaxie'     => 'no',
      'lopez'       => 'no',
      'stanthony'   => 'yes',
      'stanthonyez' => 'yes',
      'perry'       => 'yes',
      'sil'         => 'no'
    )),

  array(
    'name' => 'EU hardware optimised',
    'help' => 'Is the keyboard also optimised for European hardware layouts?',
    'id' => 'baselayout',
    'icon' => 'yes',
    'map' => array(
      'galaxie'     => 'yes',
      'lopez'       => 'no',
      'stanthony'   => 'no',
      'stanthonyez' => 'no',
      'perry'       => 'no',
      'sil'         => 'no'
    )),

  array(
    'name' => 'Layout type',
    'help' => 'Is the keyboard based on a phonetic Latin layout or on the Modern Greek keyboard?',
    'id' => 'phonetic',
    'map' => array(
      'galaxie'     => 'Phonetic Latin',
      'lopez'       => 'Phonetic Latin',
      'stanthony'   => 'Phonetic Latin',
      'stanthonyez' => 'Phonetic Latin',
      'perry'       => 'Modern Greek',
      'sil'         => 'Phonetic Latin'
    )),

  array(
    'name' => 'On screen keyboard',
    'help' => 'Is a Greek On Screen Keyboard included with the keyboard?',
    'id' => 'osk',
    'icon' => 'yes',
    'map' => array(
      'galaxie'     => 'yes',
      'lopez'       => 'yes',
      'stanthony'   => 'no',
      'stanthonyez' => 'no',
      'perry'       => 'yes',
      'sil'         => 'yes'
    )),

  array(
    'name' => 'Integrated help',
    'help' => 'Is keyboard help documentation accessible from the Keyman Desktop help icon?',
    'id' => 'doc',
    'icon' => 'yes',
    'map' => array(
      'galaxie'     => 'yes',
      'lopez'       => 'yes',
      'stanthony'   => array('1/2', 'Documentation is available in the Start Menu but not integrated into Keyman Desktop help'),
      'stanthonyez' => array('1/2', 'Documentation is available in the Start Menu but not integrated into Keyman Desktop help'),
      'perry'       => 'yes',
      'sil'         => 'yes'
    ))
);

/* List of keyboards */

foreach ($keyboardlayouts as $n => $kl) {
?>
  <div class='kbd'>
    <h3 class='red'><?= $kl['name'] ?></h3>
    <p class='desc'><?= $kl['desc'] ?></p>
    <div class='down'>
      <a href='https://help.keyman.com/keyboard/<?= $kl['help'] ?>'><img src="<?= cdn('img/details_button.png'); ?>" alt='Details' title='More information about the <?= $kl['name'] ?> keyboard' /></a>
      <a href='https://keyman.com/keyboard/<?= $kl['id'] ?>'><img src="<?= cdn('img/download_button.png'); ?>" alt='Download' title='Download the <?= $kl['name'] ?> keyboard now' /></a>
    </div>
  </div>
<?php
}

/* Table of features */

?>
<h2 class='red underline' id='features'>Feature Comparison</h2>
<table class='features'>
  <col width='20%' /><colgroup span='5' width='16%'></colgroup>
  <thead>
  <tr><th id='feature_topleft'>&nbsp;</th>
<?php

  foreach ($keyboardlayouts as $kl) {
    echo "<th>{$kl['name']}</th>";
  }

  echo "</th></tr></thead><tbody>";

  foreach ($features as $feature) {
    echo "<tr id='feature_{$feature['id']}'><th>";
    if(isset($feature['help'])) {
?>
      <a href='#' onclick='return false;' class='featurehelp'>
      <img alt='(?)' src='<?= cdn('img/helpIcon.png'); ?>' />
      <span><?= $feature['name']?></span>
      <div><div><?= $feature['help'] ?></div></div></a>
<?php
    } else {
      echo $feature['name'];
    }
    echo "</th>";
    foreach ($keyboardlayouts as $kl) {
      if (isset($feature['map'])) {
        $value = $feature['map'][$kl['nid']];
      } else {
        $value = $kl[$feature['id']];
      }

      if(is_array($value)) {
        $valuehelp = $value[1];
        $value = $value[0];
      } else {
        unset($valuehelp);
      }

      if (isset($feature['icon']) && $feature['icon'] == 'yes') {
        switch($value)
        {
          case 'yes':
            $s = "<img src='" . cdn("img/fullcircle.gif") . "' alt='y' />";
            break;
          case '1/2':
            $s = "<img src='" . cdn("img/halfcircle.gif") . "' alt='1/2' />";
            break;
          case 'no':
            $s = "";
            break;
          default:
            $s = "";
            break;
        }
      } else {
        $s = $value;
      }

      if(isset($valuehelp)) {
        echo "<td><a href='#' onclick='return false;' class='featurehelp'>$s*<div><div>$valuehelp</div></div></a></td>";
      } else {
        echo "<td>$s</td>";
      }
    }
    echo "</tr>";
  }

  echo "<tr id='feature_help'><th>Online help</th>";

  foreach ($keyboardlayouts as $kl) {
?>
    <td><a href='https://help.keyman.com/keyboard/<?= $kl['help'] ?>'><img src='<?= cdn("img/tiny_help.png"); ?>' border='0' alt='Help' /></a></td>
<?php
  }
  echo "</th></tr>";

  echo "<tr id='feature_download'><th>Downloads</th>";
  foreach ($keyboardlayouts as $kl) {
?>
    <td><a href='https://keyman.com/keyboards/<?= $kl['id'] ?>'><img border='0' src='<?= cdn("img/tiny_download.png"); ?>' alt='Download' /></a></td>
<?php
  }

  echo "</tbody></table>";

?>

<h2 class="red underline">Frequently Asked Questions</h2>

<ul id='faq'>
  <li>
    <span class='question'>Which Greek keyboard do I need?</span>
    <span class='answer'>
      If you are using a European or UK hardware keyboard, we only recommend the Galaxie BibleScript Greek Mnemonic keyboard.<br/><br/>
	    If you are using a US or other hardware keyboard, we recommend each keyboard for different situations.
      Try Manuel Lopez's Greek Classical keyboard if you are studying Classical Greek;
      the Galaxie BibleScript Greek Mnemonic keyboard if you are studying Biblical Greek;
      Greek Polytonic SA for advanced functions, monotonic, and polytonic Greek support;
      and Greek Polytonic Unicode if you are more comfortable with a modern Greek hardware layout.
      <br/><br/>
    </span>
  </li>
  <li>
    <span class='question'>Which Classical Greek font should I use in Microsoft Word and other programs?</span>
    <span class='answer'>
    Each of these packages comes with two free Greek fonts: <b>Galaxie Greek Unicode</b>, and <b>Galatia SIL</b>.  You can
    also use the font <b>Palatino Linotype</b>, which is available in Windows XP and later versions.
    <br/><br/>
  </span>
  </li>
  <li>
    <span class='question'>Whenever I type a sigma, a vowel, and then a diacritic or breathing mark in Microsoft Word, the sigma changes to a final sigma</span>
    <span class='answer'>
    This is a bug in Microsoft Word.  Visit <a href='https://help.keyman.com/kb/43'>knowledge base article KMKB0043</a> for a resolution.
  </span>
  </li>
</ul>

<div id='info'>
  <h2 class='red underline'>More Information</h2>

  <p><a href='/keyboards/languages/el'>Other Greek Keyman keyboards</a></p>
</div>
