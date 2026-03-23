<?php
  require_once('includes/template.php');
  
  // Required
  head([
    'title' =>'Normalization Test',
    'css' => ['template.css'],
    'showMenu' => true
  ]);           
?>

<h1>Normalization Test</h1>

<p>This page lets you test what normalization form your keyboard layout uses. Turn on your language keyboard and type all your special
characters into the box below. The detected normalization form will be reported in real time below.</p>

<p>
  <textarea rows=5 cols=64 id='normalization'></textarea>
</p>
<p>Normalization form: <span id='result'>Unknown</span>
</p>

<script>
  var afterLoad = function() {
    if(typeof $ == 'undefined') {
      window.setTimeout(afterLoad, 100);
      return false;
    }
   
    $('#normalization').keyup(function() {
      var s = $('#normalization').val();
      var nfc = s.normalize('NFC');
      var nfd = s.normalize('NFD');
      $('#result').text( s === nfc ? 'NFC' : s === nfd ? 'NFD' : 'Mixed' );
    });
  }
  
  window.addEventListener('load', afterLoad, false);
</script>

<p>Note: this page requires a modern browser such as Edge, Chrome, Firefox or Safari. It will not work with Internet Explorer.</p>
