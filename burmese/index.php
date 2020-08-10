<?php
  require_once('includes/template.php');
  require_once('../keyboards/session.php');
  require_once __DIR__ . '/../_includes/autoload.php';
  use Keyman\Site\Common\KeymanHosts;

  $head_options = [
    'title' =>'Burmese Keyboards'
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
    <img title="Mandalay Hill 3 &mdash; Image Courtesy of Stefan Fussan" src="<?= cdn('img/Mandalay_Hill_3.jpg') ?>" id="photo" style='float:right; margin: 8px 0px 8px 24px; width: 50%' />

    <h1 class="red">Burmese Keyboards</h1>
    <p>Type Burmese in all your favourite applications from your own hardware keyboard.</p>
    <p>These <a href='http://www.unicode.org/standard/WhatIsUnicode.html'>Unicode</a>
      layouts run on Keyman Desktop in any Unicode compliant Windows application. They allow intuitive typing of Burmese-script languages.</p>
  </div>

  <div id='downloads'>
    <div id='keyboards'>
      <h2 class="red">Keyboards</h2>
<?php

      $keyboardlayouts = array(
        array(
          'name' => 'myWin Extended (SIL) Keyboard',
          'desc' => 'This layout has been designed to resemble that used by WinMyanmar Systems, but much simplified.',
          'help' => 'sil_myanmar_mywinext',
          'web' => '#my,Keyboard_sil_myanmar_mywinext',
          'id' => 'sil_myanmar_mywinext'),

        array(
          'name' => 'Myanmar3 (SIL) Keyboard',
          'desc' => 'This is an updated and modified version of the Myanmar3 keyboard layout originally developed by Myanmar NLP on MSKLC software.',
          'help' => 'sil_myanmar_my3',
          'web' => '#my,Keyboard_sil_myanmar_my3',
          'id' => 'sil_myanmar_my3')
      );

      foreach ($keyboardlayouts as $kl) {
?>
        <div class='kbd'>
          <h3 class="red"><?= $kl['name'] ?></h3>
          <p class='desc'><?= $kl['desc'] ?></p>
          <div class='down' style="position:relative">
            <a href='https://keymanweb.com/<?= $kl['web'] ?>'><img src='<?= cdn('img/use_online.png') ?>' alt='Type Now' title='Try the <?= $kl['name'] ?> keyboard' /></a>
            <a href='<?= KeymanHosts::Instance()->help_keyman_com ?>/keyboard/<?= $kl['help'] ?>'><img src='<?= cdn('img/details_button.png') ?>' alt='Details' title='More information about the <?= $kl['name'] ?> keyboard' /></a>
            <a href='/keyboards/<?= $kl['id'] ?>'><img src='<?= cdn('img/download_button.png') ?>' alt='Download' title='Download the <?= $kl['name'] ?> keyboard' /></a>
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

    <p>Keyman Desktop will automatically configure your computer to work with Burmese.</p>

    <p><a href='/keyboards/languages/my'>Other Burmese Keyman keyboards</a></p>
  </div>
  <br/>

  <div id='attributions'>
    <p><a href='https://commons.wikimedia.org/wiki/File:Mandalay_Hill_3.jpg'>Mandalay Hill 3 image</a> courtesy of Stefan Fussan, under
      <a href='https://creativecommons.org/licenses/by-sa/3.0/deed.en'>Creative Commons Attribution-ShareAlike 3.0 Unported licence</a>.</p>
  </div>
