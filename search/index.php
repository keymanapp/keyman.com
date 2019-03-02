<?php
  require_once('includes/template.php');
  head([
    'title' => "Search Keyman Sites",
    'css' => ['template.css'],
    'showMenu' => true
  ]);
?>

<h1>Search</h1>

<script>
  (function() {
    var cx = '010681075583534798483:ox2qukyiv9c';
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
        '//cse.google.com/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
  })();
</script>
<div class='keyman-search'>
<gcse:search></gcse:search>
</div>