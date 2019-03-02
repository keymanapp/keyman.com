<?php
  require_once('includes/template.php');
  require_once('includes/ui/downloads.php');
  
  // Required
  head([
    'title' =>'Clever Keyboards',
    'css' => ['template.css','index.css'],
    'showMenu' => true
  ]);           
?>

<h1>Clever Keyboards</h1>

<h2>Smart &amp; Flexible</h2>
<p>Keyman Desktop keyboards are cleverly built to adapt to you: </p>

<h3>Any Hardware Standard</h3>
<p>Whether you're on QWERTY, QWERTZ, AZERTY or any other standard, you can use your hardware keyboard with any Keyman keyboard.</p>

<h3>Mnemonic Optimisation</h3>
<p>Mnemonic or 'phonetic' Keyman keyboards take adaptation even further. Keys shift to match the layout and display of your hardware keyboard.</p>

<p class='notie67'><img src='<?= cdn('img/desktop/osk-qwerty-big.png')?>' alt='Keyman Keyboards Adapt <br/>To Your Standard Hardware Keyboard ' style='margin-left: 0px; width:721px; z-index: 2'/></p>
<p class='notie67'><img src='<?= cdn('img/desktop/osk-qwertz-big.png')?>' alt='Keyman Keyboards Adapt <br/>To Your Standard Hardware Keyboard ' style='margin-top:-135px; margin-left: 35px; width:721px; z-index: 3'/></p>
<p class='notie67'><img src='<?= cdn('img/desktop/osk-azerty-big.png')?>' alt='Keyman Keyboards Adapt <br/>To Your Standard Hardware Keyboard ' style='margin-top:-135px; width:721px; margin-left: 70px; z-index: 4'/></p>

<h3 style='margin-top:4px;'>Keyboard Options</h3>
<p>Keyboards with options give you even more control. With options you can type French accents first or last, Lao with or without spaces, or Tigrigna with Ethiopian or Eritrean punctuation, as you prefer.</p>
<p><img src='<?= cdn('img/desktop/options.png') ?>' alt='Keyboard Options for Yorùbá ' /></p>

<h3>Automatic Normalisation</h3>
<p>Keyman keyboards are smart enough to handle character normalisation for you. Your data stays consistent however you typed that character.</p>
<p><img class='borderless'  src='<?= cdn('img/desktop/normalisationb.png')?>' alt='Combining & Precomposed Accents ' /></p>
 
<h2>Language-Specific Features</h2>
<p>Many keyboards also come with language-specific features to make them smarter.  For example:</p>

<h3>Tibetan Stacking</h3>
<p>Tibetan Unicode keyboards make it easy to build complex stacks.</p>
<p><img src='<?= cdn('img/desktop/example-tibetan.png')?>' alt='Tibetan Stacking ' /></p>

<h3>Logical &amp; Visual Tamil</h3>
<p>Type Tamil as it's written or in logical order. We provide keyboards to suit either preference.</p>
<p><img class='borderless' src='<?= cdn('img/desktop/example-tamil.png')?>' alt='Visual Vs Logical Order Tamil ' /></p>

<h3>Chinese IME</h3>
<p>A popup IME simplifies typing thousands of Chinese characters.</p>
<p><img src='<?= cdn('img/desktop/example-chinese.png')?>' alt='The Keyman Chinese IME ' /></p>

<h3>EuroLatin Usage Chart</h3>
<p>EuroLatin comes with a clickable usage chart, allowing rapid access to any of the hundreds of characters included in the keyboard.</p>
<p><img src='<?= cdn('img/desktop/usagec.png')?>' alt='EuroLatin Keyboard Usage ' /></p>

<h3>Lao Syllable Splitting</h3>
<p>Lao keyboards split syllables behind the scenes, giving easy-to-search seamless text with correct line breaks.</p>
<p><img class='borderless' src='<?= cdn('img/desktop/example-lao.png')?>' alt='Lao Syllables Splitting '/></p>

<p><a href='/desktop'>Back to Keyman Desktop home</a></p>