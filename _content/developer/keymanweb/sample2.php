<!DOCTYPE html>
<?php
  // This example was contributed by @linuxguist
  require_once("./keymanweb-version.inc.php");
  $cdnUrlBase = getKeymanWebHref();
?>

<html lang="en">

<head>
  <meta charset="utf-8" />

  <!-- Set the viewport width to match phone and tablet device widths -->
  <meta name="viewport" content="width=device-width,user-scalable=no" />

  <!-- Allow KeymanWeb to be saved to the iPhone home screen -->
  <meta name="apple-mobile-web-app-capable" content="yes" />

  <title>KeymanWeb Language Demo</title>

  <style type="text/css">
    html,
    body {
      background: violet !important;
    }

    .jumbotron,
    .container {
      background: transparent !important;
      font-family: 'Arial', sans-serif;
      font-size: 16px;
      padding-top: 12px !important;
      padding-bottom: 4px !important;
      height: 100px !important;
      margin-top: 10px;
      margin-bottom: 5px;
      width: 99%;
    }

    .center_ii {
      display: flex;
      justify-content: center;
      align-items: center;
      background: #086cdf !important;
      color: #fcfbfc !important;
      border: 3px solid white;
      padding: 10px;
    }

    .center_iv {
      display: flex;
      justify-content: center;
      align-items: center;
      background: #606060 !important;
      color: gold !important;
      border: 3px solid white;
      padding: 10px;
    }

    .kmw-osk-frame {
      display: block !important;
      margin-top: 10px !important;
      position: sticky !important;
    }

    .select2-search {
      background-color: Khaki;
    }

    .select2-search input {
      background-color: Khaki;
    }

    .select2-results {
      background-color: Khaki;
      height: auto !important;
    }

    .select2-container--default .select2-selection--single {
      background-color: Khaki;
    }

    .select2-search--dropdown {
      background-color: Khaki;
    }

    .select2-search__field {
      background-color: Khaki;
    }

    .select2-results {
      background-color: Khaki;
      height: auto !important;
    }

    /* Select option */
    .select2-results__option {
      font-size: 16px;
    }

    .select2-selection {
      height: auto !important;
    }

    .select2-container--default .select2-results>.select2-results__options {
      max-height: 200px;
      min-height: 200px;
      overflow-y: auto;
    }

    ::-webkit-input-placeholder {
      color: white;
      font-size: 18px;
    }

    :-moz-placeholder {
      /* Firefox 18- */
      color: white;
      font-size: 18px;
    }

    ::-moz-placeholder {
      /* Firefox 19+ */
      color: white;
      font-size: 18px;
    }

    :-ms-input-placeholder {
      color: white;
      font-size: 18px;
    }
  </style>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- Select2 CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

</head>

<body>
  <h1 style="margin-top: 10px; text-align: center">KeymanWeb Language Demo</h1>

  <div class="jumbotron center_ii">
    <div class="container bg-danger">
      <div class="col-md-6">
        <label>Please Select Your Language Here</label>
        <select id="single" class="js-states form-control" autofocus>
          <option value="" disabled selected>Select your option here</option>
          <option value='af'>Afrikaans</option>
          <option value='sq'>Albanian</option>
          <option value='am'>Amharic</option>
          <option value='an'>Aragonese</option>
          <option value='hy'>Armenian</option>
          <option value='as'>Assamese</option>
          <option value='ay'>Aymara</option>
          <option value='eu'>Basque</option>
          <option value='be'>Belarusian</option>
          <option value='bn'>Bengali</option>
          <option value='bi'>Bislama</option>
          <option value='bs'>Bosnian</option>
          <option value='br'>Breton</option>
          <option value='bg'>Bulgarian</option>
          <option value='my'>Burmese</option>
          <option value='ca'>Catalan, Valencian</option>
          <option value='km'>Central Khmer</option>
          <option value='kw'>Cornish</option>
          <option value='co'>Corsican</option>
          <option value='hr'>Croatian</option>
          <option value='cs'>Czech</option>
          <option value='da'>Danish</option>
          <option value='dv'>Divehi, Dhivehi, Maldivian</option>
          <option value='nl'>Dutch, Flemish</option>
          <option value='dz'>Dzongkha</option>
          <option value='en'>English</option>
          <option value='eo'>Esperanto</option>
          <option value='et'>Estonian</option>
          <option value='ee'>Ewe</option>
          <option value='fo'>Faroese</option>
          <option value='fj'>Fijian</option>
          <option value='fi'>Finnish</option>
          <option value='fr'>French</option>
          <option value='ff'>Fulah</option>
          <option value='gd'>Gaelic, Scottish Gaelic</option>
          <option value='gl'>Galician</option>
          <option value='ka'>Georgian</option>
          <option value='de'>German</option>
          <option value='el'>Greek, Modern (1453–)</option>
          <option value='gn'>Guarani</option>
          <option value='gu'>Gujarati</option>
          <option value='ht'>Haitian, Haitian Creole</option>
          <option value='ha'>Hausa</option>
          <option value='he'>Hebrew</option>
          <option value='hi'>Hindi</option>
          <option value='hu'>Hungarian</option>
          <option value='is'>Icelandic</option>
          <option value='ig'>Igbo</option>
          <option value='ik'>Inupiaq</option>
          <option value='ga'>Irish</option>
          <option value='it'>Italian</option>
          <option value='ja'>Japanese</option>
          <option value='kl'>Kalaallisut, Greenlandic</option>
          <option value='kn'>Kannada</option>
          <option value='kr'>Kanuri</option>
          <option value='ks'>Kashmiri</option>
          <option value='kk'>Kazakh</option>
          <option value='ky'>Kirghiz, Kyrgyz</option>
          <option value='la'>Latin</option>
          <option value='lv'>Latvian</option>
          <option value='li'>Limburgan, Limburger, Limburgish</option>
          <option value='lt'>Lithuanian</option>
          <option value='lb'>Luxembourgish, Letzeburgesch</option>
          <option value='mk'>Macedonian</option>
          <option value='ml'>Malayalam</option>
          <option value='mt'>Maltese</option>
          <option value='gv'>Manx</option>
          <option value='mi'>Maori</option>
          <option value='mr'>Marathi</option>
          <option value='nd'>North Ndebele</option>
          <option value='se'>Northern Sami</option>
          <option value='no'>Norwegian</option>
          <option value='nb'>Norwegian Bokmål</option>
          <option value='nn'>Norwegian Nynorsk</option>
          <option value='oc'>Occitan</option>
          <option value='or'>Oriya</option>
          <option value='om'>Oromo</option>
          <option value='ps'>Pashto, Pushto</option>
          <option value='fa'>Persian</option>
          <option value='pl'>Polish</option>
          <option value='pt'>Portuguese</option>
          <option value='pa'>Punjabi, Panjabi</option>
          <option value='qu'>Quechua</option>
          <option value='ro'>Romanian, Moldavian, Moldovan</option>
          <option value='rm'>Romansh</option>
          <option value='ru'>Russian</option>
          <option value='sm'>Samoan</option>
          <option value='sg'>Sango</option>
          <option value='sa'>Sanskrit</option>
          <option value='sc'>Sardinian</option>
          <option value='sr'>Serbian</option>
          <option value='sd'>Sindhi</option>
          <option value='si'>Sinhala, Sinhalese</option>
          <option value='sk'>Slovak</option>
          <option value='sl'>Slovenian</option>
          <option value='so'>Somali</option>
          <option value='es'>Spanish, Castilian</option>
          <option value='sw'>Swahili</option>
          <option value='ss'>Swati</option>
          <option value='sv'>Swedish</option>
          <option value='tl'>Tagalog</option>
          <option value='ty'>Tahitian</option>
          <option value='ta'>Tamil</option>
          <option value='tt'>Tatar</option>
          <option value='te'>Telugu</option>
          <option value='th'>Thai</option>
          <option value='bo'>Tibetan</option>
          <option value='ti'>Tigrinya</option>
          <option value='to'>Tonga (Tonga Islands)</option>
          <option value='tr'>Turkish</option>
          <option value='tk'>Turkmen</option>
          <option value='uk'>Ukrainian</option>
          <option value='ur'>Urdu</option>
          <option value='vi'>Vietnamese</option>
          <option value='wa'>Walloon</option>
          <option value='cy'>Welsh</option>
          <option value='fy'>Western Frisian</option>
          <option value='wo'>Wolof</option>
          <option value='xh'>Xhosa</option>
          <option value='yo'>Yoruba</option>
          <option value='za'>Zhuang, Chuang</option>
          <option value='zu'>Zulu</option>
        </select>
      </div>
    </div>
  </div>
  <!-- jQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- Select2 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
  <script>
    $("#single").select2({
      placeholder: "Please Select A Language Here",
      allowClear: true
    });
  </script>

  <textarea id="kwtextarea" class="center_iv" cols="20" rows="5" style="width: 99%; height: 220px; margin-top: -10px; font-size: 18px" placeholder="Please select a language from the above dropdown list and type according to the keyboard below. Press Shift Key to See the Other Characters."></textarea>

  <!--
      In this example, we are loading KeymanWeb late.  If you focus on a control early (e.g. a search box),
      you may want to place the KeymanWeb code into the head instead, to ensure it is available by the
      time the user wants to start typing.
    -->

  <!-- KeymanWeb script -->
  <script src='<?= $cdnUrlBase ?>/keymanweb.js'></script>
  <script>
    keyman.init({
      attachType: 'auto'
    });
    keyman.addKeyboards('@en');
  </script>

  <!--
      For desktop browsers, a script for the user interface must be inserted here.

      Standard UIs are toggle, button, float and toolbar.
      The toolbar UI is best for any page designed to support keyboards for
      a large number of languages.
    -->

  <script type="text/javascript">
    $('#single').on('change', async function() {
      await keyman.addKeyboards('@' + this.value);
      const keyboards = keyman.getKeyboards();
      const keyboard = keyboards.find(keyboard => keyboard.LanguageCode == this.value);
      if(keyboard) {
        keyman.setActiveKeyboard(keyboard.InternalName);
      }
      document.getElementById("kwtextarea").focus();
    });

    $('#single').on('select2:select', function(e) {
      setTimeout(function() {
        $('#kwtextarea').focus().select();
      }, 500);
    });
  </script>


</body>

</html>