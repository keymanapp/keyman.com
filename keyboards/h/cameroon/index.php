<?php
  require_once('includes/template.php');
  require_once('../../session.php');
  require_once __DIR__ . '/../../../_includes/autoload.php';
  use Keyman\Site\Common\KeymanHosts;

  $head_options = [
    'title' =>'Cameroon Keyboards'
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
    <img title="Mont Mbapit14 &mdash; Image Courtesy of Noel Coston" src="<?= cdn('img/Mont_Mbapit14.jpg') ?>"
         id="photo" style='float:right; margin: 8px 0px 8px 24px; width: 50%' />

    <h1 class="red underline">Cameroon Keyboards</h1>

    <p>
      Choose from our selection of Cameroon keyboards to match your physical hardware: QWERTY (US Keyboard) or AZERTY (French Keyboard).<br/><br/>
      These <a href='http://www.unicode.org/standard/WhatIsUnicode.html' target='_blank'>Unicode</a> keyboards run on Keyman for Windows in any compliant Windows application.
    </p>
  </div>

  <div id='downloads'>
    <div id='keyboards'>
      <h2 class="red">Keyboards</h2>
  <?php
      $keyboardlayouts = array(

      array(
        'name' => 'Cameroon QWERTY (SIL) Unicode',
        'desc' => 'This keyboard layout seeks to follow the General Alphabet of Cameroonian languages for a QWERTY (US Keyboard)',
        'help' => 'sil_cameroon_qwerty',
        'web'  => '#aal-Latn,Keyboard_sil_cameroon_qwerty',
        'id'   => 'sil_cameroon_qwerty'),

      array(
        'name' => 'Cameroon AZERTY (SIL) Unicode',
        'desc' => 'Cameroon AZERTY keyboard supporting the Standardized Alphabet for Cameroonian languages - designed for a French (AZERTY) keyboard',
        'help' => 'sil_cameroon_azerty',
        'web'  => '#aal-Latn,Keyboard_sil_cameroon_azerty',
        'id'   => 'sil_cameroon_azerty')

      );

      foreach ($keyboardlayouts as $kl) {
  ?>
        <div class='kbd'>
          <h3 class="red"><?= $kl['name'] ?></h3>
          <p class='desc'><?= $kl['desc'] ?></p>
          <div class='down'>

  <?php
          // Use keyboard online if available
          if (isset($kl['web'])) {
  ?>
            <a href='https://keymanweb.com/<?= $kl['web'] ?>' target='_blank'><img src="<?= cdn('img/use_online.png') ?>"
              alt='Type Now' title='Try the <?= $kl['name'] ?> keyboard'/></a>
  <?php
          } else {
  ?>
            <span class="no_keyboard_online"></span>
  <?php
          }

          // Keyboard Details if available
          if (isset($kl['help'])) {
  ?>
            <a href='<?= KeymanHosts::Instance()->help_keyman_com ?>/keyboard/<?= $kl['help'] ?>' target='_blank'><img src="<?= cdn('img/details_button.png'); ?>" alt='Details' title='More information about the <?= $kl['name'] ?> keyboard' /></a>
  <?php
          } else {
  ?>
            <span class="no_keyboard_details"></span>
  <?php
          }
  ?>
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

    <p>The keyboard downloads come with Keyman for Windows, our multilingual typing application. <a href='/windows'>Learn more…</a></p>

    <p>For technical support, please <a href='https://community.software.sil.org/c/keyman'>visit our forums</a> online.</p>

    <p><a href='/keyboards?q=cameroon'>Other Cameroon Keyman keyboards</a></p>

  </div>
  <br/>

  <div id='attributions'>
      <p><a href='https://commons.wikimedia.org/wiki/File:Mont_Mbapit14.jpg'>Mont Mbapit14 image</a> courtesy of Noel Coston, under <a href='https://creativecommons.org/licenses/by-sa/4.0/deed.en'>Creative Commons Attribution - Share Alike 4.0 International licence</a>.</p>
  </div>
