<?php
  require_once('includes/template.php');
  require_once('../../session.php');
  require_once __DIR__ . '/../../../_includes/autoload.php';
  use Keyman\Site\Common\KeymanHosts;

  $head_options = [
    'title' =>'Tibetan Keyboards'
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

  <div id='intro'>
    <img title="Chiyu Gompa and Mount Kailash &mdash; Image Courtesy of Reurinkjan" src="<?= cdn('img/Mount_Kailash_-_reurinkjan.jpg') ?>"
         id="photo" style='float:right; margin: 8px 0px 8px 24px' />

    <h1 class="red underline">Tibetan Keyboards</h1>

    <p>
      Choose from our selection of Tibetan keyboards and type Tibetan in all your favourite applications, without changing your hardware.<br/><br/>
      These <a href='http://www.unicode.org/standard/WhatIsUnicode.html' target='_blank'>Unicode</a> keyboards run on Keyman Desktop in any compliant Windows application. They allow intuitive typing of Tibetan-script languages using a standard hardware keyboard.
    </p>
  </div>

  <div id='downloads'>
    <div id='keyboards'>
      <h2 class="red">Keyboards</h2>
  <?php
      $keyboardlayouts = array(

      array(
        'name' => 'Tibetan Unicode Direct Input',
        'desc' => 'Tibetan Unicode Direct Input is designed to type all Tibetan characters and stacks directly. You get a Tibetan character every time you press a key, without having to use the Alt key or remember complex transliteration combinations. The keyboard types in a phonetic style based on the English (QWERTY) layout. This keyboard also features special menus for Tibetan symbols and lets you type Latin and Cyrillic letters.',
        'help' => 'tibetan_unicode_direct_input',
        'web' => '#bo,Keyboard_tibetan_unicode_direct_input',
        'id'  => 'tibetan_unicode_direct_input'),

      array(
        'name' => 'Tibetan Unicode EWTS',
        'desc' => 'Tibetan Unicode EWTS is based on the Extended Wylie Transliteration Scheme (EWTS), an approach to typing Tibetan which avoids most Shift, Alt, and Alt+Shift combinations. Tibetan characters are created from EWTS -transliteration each time you type a vowel or a Space (tsheg). Special rules apply for long-stacks. This keyboard also features special menus for Tibetan symbols and lets you type Latin and Cyrillic letters.',
        'help' => 'tibetan_unicode_ewts',
        'web' => '#bo,Keyboard_tibetan_unicode_ewts',
        'id'  => 'tibetan_unicode_ewts'),

      /*  array(
          'name' => 'Tibetan THDL',
          'desc' => 'Tibetan THDL includes EWTS and Sambhota keyboard layouts.',
          'help' => '',
          'id' => 363), */

      array(
        'name' => 'Dzongkha (SIL)',
        'desc' => 'The Dzongkha keyboard is designed for the Tibetan-script Dzongkha language of Bhutan. The keyboard follows the current (October 2009) official Dzongkha layout approved by the Department of Information Technology and Dzongkha Development Authority of the Government of Bhutan.',
        'help' => 'sil_dzongkha',
        'web' => '#dz-BT,Keyboard_sil_dzongkha',
        'id'  => 'sil_dzongkha')
      );

      foreach ($keyboardlayouts as $kl) {
  ?>
        <div class='kbd'>
          <h3 class="red"><?= $kl['name'] ?></h3>
          <p class='desc'><?= $kl['desc'] ?></p>
          <div class='down'>
            <a href='https://keymanweb.com/<?= $kl['web'] ?>' target='_blank'><img src="<?= cdn('img/use_online.png') ?>" alt='Type Now' title='Try the <?= $kl['name'] ?> keyboard' /></a>
            <a href='<?= KeymanHosts::Instance()->help_keyman_com ?>/keyboard/<?= $kl['help'] ?>' target='_blank'><img src="<?= cdn('img/details_button.png'); ?>" alt='Details' title='More information about the <?= $kl['name'] ?> keyboard' /></a>
            <a href='<?= KeymanHosts::Instance()->keyman_com ?>/keyboards/<?= $kl['id']?>'><img src="<?= cdn('img/download_button.png'); ?>" alt='Download' title='Download the <?= $kl['name'] ?> keyboard' /></a>
          </div>
        </div>
  <?php
      }
  ?>
    </div>
  </div>

  <div id='info'>
    <h2 class="red">More Information</h2>

    <p>The keyboard downloads come with Keyman Desktop, our multilingual typing application. <a href='/desktop'>Learn more…</a></p>

    <p>Keyman Desktop will automatically configure your computer to work with Tibetan.</p>

    <p><a href='/keyboards/languages/bo'>Other Tibetan Keyman keyboards</a></p>
  </div>
  <br/>

  <div id='attributions'>
      <p><a href='https://commons.wikimedia.org/wiki/File:Mount_Kailash_-_reurinkjan.jpg'>Chiyu Gompa and Mount Kailash image</a> courtesy of Reurinkjan, under <a href='http://creativecommons.org/licenses/by/2.0/deed.en'>Creative Commons Attribution 2.0 Generic licence</a>.</p>
  </div>
