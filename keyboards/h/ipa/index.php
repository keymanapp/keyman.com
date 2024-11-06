<?php
  require_once('includes/template.php');
  require_once('../../session.php');
  require_once __DIR__ . '/../../../_includes/autoload.php';
  use Keyman\Site\Common\KeymanHosts;

  $head_options = [
    'title' =>'IPA Keyboards'
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
    #ipa {
      float: right; font-family:'Gentium Plus', Cambria, Arial !important; font-size:18pt !important; border: solid 1px #D6AE7C; background: #FAF2E8;
      padding: 3px 8px; width: 40%; margin: -10px 32px 0px;
      border-radius: 6px; -moz-border-radius: 6px; -webkit-border-radius: 6px }
    #ipa p {
      margin:8px 0px;
    }
  </style>

  <div id='intro'>
    <h1 class="red">IPA Keyboards</h1>
    <div id='ipa' lang="und-fonipa">
      <p>tʰaɪpʰ ɪn <a href='https://www.internationalphoneticassociation.org/content/ipa-chart' target='_blank'>aɪ pʰiː eɪ</a> kʰeɹɛktɚz ɪn ɔl jɚ  faɪvɹɪt̚ pɹogɹæmz <!--ɪŋkludɪŋ jɚ imeɪl, wɛb bɹaʊzɚ, wɚd, ɛksɛl, aʊtlʊk ænd mɛni mɛni moɹ...--></p>
      <p>tʰaɪp̚ wɪðaʊt̚ tʃeɪndʒɪŋ jɚ hɔɹdwɛɹ wɪð ðiz <a href='http://www.unicode.org/standard/WhatIsUnicode.html'>junəkod</a> kiboɹdz</p>
    </div>
    <p>
    Type <a href='https://www.internationalphoneticassociation.org/content/ipa-chart'>IPA</a> characters in all your favourite programs, including your email, web browser, Word, Excel, Outlook and many, many more... <br/><br/>
    These keyboards and applications let you type
    IPA without changing your hardware. Each one is
    <a href='http://www.unicode.org/standard/WhatIsUnicode.html'>Unicode</a> compliant.
    </p>
  </div>

  <div id='downloads'>
    <div id='keyboards'>
      <h2 class="red">Keyboards</h2>

<?php

      $keyboardlayouts = array(
      array(
        'name' => 'SIL IPA Unicode',
        'desc' => 'This mnemonic keyboard, developed by Martin Hosken of SIL, is designed to provide easy access to any IPA character.',
        'id' => 'sil_ipa'),

      array(
        'name' => 'IPATotal',
        'desc' => 'This keyboard encodes all the characters of the IPA, as well as a host of additional characters and symbols. It includes help in English and Portuguese.',
        'id' => 'ipatotal'),

      array(
        'name' => 'LingfilSemitica',
        'desc' => 'An excellent keyboard for Latin transcription of Semitic languages, with support for the full IPA range. Optimised for Swedish keyboard layouts.',
        'id' => 'lingfilsemitica'),

      array(
        'name' => 'BU Phonetic',
        'desc' => 'This keyboard provides access to a wide range of characters for Latin-based scripts in Unicode 4.1.0.',
        'id' => 'bu_phonetic')

      );

      foreach ($keyboardlayouts as $kl) {
        $helpLink = KeymanHosts::Instance()->help_keyman_com . "/keyboard/" . $kl['id'];
?>
        <div class='kbd'>
          <h3 class='red'><?= $kl['name'] ?></h3>
          <p class='desc' ><?= $kl['desc'] ?></p>
          <div class='down'>
            <a href='/keyboards/<?= $kl['id'] ?>'><img
              src='<?= cdn('img/download_button.png') ?>' alt='Download' title='Download the <?= $kl['name'] ?> keyboard now' /></a>
            <a href='<?= $helpLink ?>'><img src='<?= cdn('img/details_button.png') ?>' alt='Details' title='More information about the <?= $kl['name'] ?> keyboard' /></a>
          </div>
        </div>
<?php
      }
?>
	  </div>

  </div>

  <div id='info'>
    <h2 class="red">More Information</h2>

    <p>These keyboards work with Keyman, the open source multilingual keyboard solution, on Windows, macOS, Linux, iPhone, iPad, Android and Web. All of these
    keyboards are available for use completely free of charge.</p>

    <p>Keyman will automatically configure your computer or device to work with IPA.</p>
  </div>
