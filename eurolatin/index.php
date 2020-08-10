<?php
  require_once('includes/template.php');
  require_once('includes/ui/keyboard-details.php');
  require_once('../keyboards/session.php');
  require_once __DIR__ . '/../_includes/autoload.php';
  use Keyman\Site\Common\KeymanHosts;

  $head_options = [
    'title' =>'EuroLatin Keyboard for Keyman'
  ];

  if($embed != 'none') {
    $head_options += [
      'showMenu' => false,
      'showHeader' => false,
      'foot' => false,
      'css' => ['template.css','index.css', '../keyboard-search/embed.css']
    ];
  } else {
    $head_options += [
      'css' => ['template.css', 'index.css', '../keyboard-search/search.css']
    ];
  }

  head($head_options);
?>

  <h2 class="red underline large">EuroLatin Keyboard for Keyman</h2>
  <p>
    This keyboard enables easy input of <b>all</b> European Latin-script languages, and most Latin-script languages from
    around the world. If you need a simple solution for typing multiple Latin-script languages from the same keyboard,
    this keyboard was designed for you.
  </p>

  <p>The EuroLatin keyboard is ideal for:</p>
  <ul>
    <li>Home-users who occasionally type or web browse in several languages</li>
    <li>Professional translators</li>
    <li>Scholars and agencies working with multiple European languages</li>
    <li>Libraries running multilingual databases</li>
    <li>Anyone who frequently types in more than one Latin-script language</li>
  </ul>
  <br/>

<?php

  \UI\KeyboardDetails::render_keyboard_details('sil_euro_latin', 'stable', true);

?>

  <h2 class="red underline">Languages Supported</h2>
  <div class="wrapper">

    <div class="column">
      <div class='listhead'> A</div>
      <div>Afrikaans</div>
      <div>Albanian</div>
      <div>Aragonese</div>
      <div>Arpitan</div>
      <div>Asturian</div>
      <div>Aleut</div>
      <br/>

      <div class='listhead'> B</div>
      <div>Bahamas Creole</div>
      <div>Balearic</div>
      <div>Basque</div>
      <div>Bavarian</div>
      <div>Bislama</div>
      <div>Breton</div>
      <div>Bosnian</div>
      <br/>

      <div class='listhead'> C</div>
      <div>Catalan</div>
      <div>Cimbrian</div>
      <div>Corsican</div>
      <div>Cornish</div>
      <div>Crimean Tatar</div>
      <div>Croatian</div>
      <div>Czech</div>
      <br/>

      <div class='listhead'> D</div>
      <div>Danish</div>
      <div>Drents</div>
      <div>Dutch</div>
      <br/>

      <div class='listhead'> E</div>
      <div>Emiliano-Romagnolo</div>
      <div>Esperanto</div>
      <div>Estonian</div>
      <div>Extremaduran</div>
      <br/>
    </div>

    <div class="column">
      <div class='listhead'> F</div>
      <div>Fala</div>
      <div>Faroese</div>
      <div>Finnish</div>
      <div>Franconian</div>
      <div>French</div>
      <div>Frisian</div>
      <div>Friulian</div>
      <br/>

      <div class='listhead'> G</div>
      <div>Gaelic, Scottish</div>
      <div>Gagauz (Latin script)</div>
      <div>Galician</div>
      <div>German</div>
      <div>Greenlandic</div>
      <div>Gronings</div>
      <div>Guaraní</div>
      <div>Gullah</div>
      <br/>

      <div class='listhead'> H</div>
      <div>Hawaiian</div>
      <div>Haitian</div>
      <div>Hungarian</div>
      <br/>

      <div class='listhead'> I</div>
      <div>Icelandic</div>
      <div>Inuktitut</div>
      <div>Irish</div>
      <div>Istriot</div>
      <div>Italian</div>
      <br/>

      <div class='listhead'> J</div>
      <div>Jamaican Creole</div>
      <div>Jutish</div>
      <br/>
    </div>

    <div class="column">
      <div class='listhead'> K</div>
      <div>Karelian</div>
      <div>Kashubian</div>
      <div>Kölsch</div>
      <br/>

      <div class='listhead'> L</div>
      <div>Ladin</div>
      <div>Latin</div>
      <div>Latvian</div>
      <div>Ligurian</div>
      <div>Limburgish</div>
      <div>Lithuanian</div>
      <div>Lombard</div>
      <div>Luxembourgish</div>
      <br/>

      <div class='listhead'> M</div>
      <div>Maltese</div>
      <div>Manx</div>
      <div>Mirandese</div>
      <div>Mócheno</div>
      <br/>

      <div class='listhead'> N</div>
      <div>Neapolitan-Calabrese</div>
      <div>Norwegian</div>
      <div>Nynorsk</div>
      <br/>

      <div class='listhead'> O</div>
      <div>Occitan</div>
      <div>Oromo</div>
      <br/>
    </div>

    <div class="column">
      <div class='listhead'> P</div>
      <div>Papiamentu</div>
      <div>Pfaelzisch</div>
      <div>Picard</div>
      <div>Piemontese</div>
      <div>Polish</div>
      <div>Portuguese</div>
      <div>Prussian</div>
      <br/>

      <div class='listhead'> Q</div>
      <div>Quechua</div>
      <br/>

      <div class='listhead'> R</div>
      <div>Romani</div>
      <div>Romanian</div>
      <div>Romansch</div>
      <br/>

      <div class='listhead'> S</div>
      <div>Saami (Latin Script)</div>
      <div>Sallands</div>
      <div>Sardinian</div>
      <div>Saterfriesisch</div>
      <div>Saxon</div>
      <div>Scots</div>
      <div>Serbian (Latin script)</div>
      <div>Sicilian</div>
      <div>Silesian</div>
      <div>Slovak</div>
      <div>Slovenian</div>
      <div>Sorbian</div>
      <div>Spanish</div>
      <div>Stellingwerfs</div>
      <div>Swabian</div>
      <div>Swahili</div>
      <div>Swedish</div>
      <div>Swiss German</div>
      <br/>
    </div>

    <div class="column">
      <div class='listhead'> T</div>
      <div>Tagalog</div>
      <div>Tok Pisin</div>
      <div>Turkish</div>
      <div>Twents</div>
      <br/>
      <div class='listhead'> V</div>
      <div>Valencian</div>
      <div>Veluws</div>
      <div>Venetian</div>
      <div>Vlaams</div>
      <br/>
      <div class='listhead'> W</div>
      <div>Walloon</div>
      <div>Walser</div>
      <div>Welsh</div>
      <div>Westphalien</div>
      <div>Wolof</div>
      <br/>
      <div class='listhead'> X</div>
      <div>Xhosa</div>
      <br/>
      <div class='listhead'> Y</div>
      <div>Yupik</div>
      <br/>
      <div class='listhead'> Z</div>
      <div>Zapotec</div>
      <div>Zeeuws</div>
      <div>Zhuang</div>
      <div>Zulu</div>
      <br/>
      <br/>
      <div style='font-weight: bold; font-size: 10pt; color:#2F4B67'>...and more!</div>
      <br/>
    </div>

  </div>

  <h2 class="red underline">Technical Support</h2>
  <p>
    For technical support, please <a href='https://community.software.sil.org/c/keyman'>visit our forums</a> online.
  </p>
  <p>
    <a href='<?= KeymanHosts::Instance()->help_keyman_com ?>/keyboard/sil_euro_latin' target='_blank'>EuroLatin (SIL) Keyboard Documentation</a>
  </p>

</div>

</div>
