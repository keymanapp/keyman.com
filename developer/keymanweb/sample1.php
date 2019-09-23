<!DOCTYPE html>
<?php

require_once("includes/servervars.php");

$json = @file_get_contents("$apihost/version/web");
if($json) {
  $json = json_decode($json);
}
if($json && property_exists($json, 'version')) {
  $build = $json->version;
} else {
  // If the get-version API fails, we'll use the latest known version
  $build = "12.0.85"; // NOTE: we don't yet have a 12.0 version; this is late, late Beta.
}

$cdnUrlBase = "$statichost/kmw/engine/$build";
?>

<html lang="en">
  <head>
    <!-- Set the viewport width to match phone and tablet device widths -->                         
    <meta name="viewport" content="width=device-width,user-scalable=no" /> 

    <!-- Allow KeymanWeb to be saved to the iPhone home screen -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    
    <!-- Enable IE9 Standards mode -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" /> 
    
    <title>KeymanWeb Sample 1</title>
  </head>
  <body>
    <h1>KeymanWeb Sample 1</h1>
    <textarea cols="20" rows="5"></textarea>
    
    <!--
      In this example, we are loading KeymanWeb late.  If you focus on a control early (e.g. a search box), 
      you may want to place the KeymanWeb code into the head instead, to ensure it is available by the
      time the user wants to start typing.
    -->

    <!-- KeymanWeb script -->
    <script src='<?=$cdnUrlBase?>/keymanweb.js'></script>

    <!-- 
      For desktop browsers, a script for the user interface must be inserted here.
       
      Standard UIs are toggle, button, float and toolbar.  
      The toolbar UI is best for any page designed to support keyboards for 
      a large number of languages.
    -->
    <script src='<?=$cdnUrlBase?>/kmwuitoggle.js'></script>
    
    <!-- Initialization: set paths to keyboards, resources and fonts as required -->
    <script>
      (function(kmw) {
        kmw.init({attachType:'auto'});
        kmw.addKeyboards('@en');
        kmw.addKeyboards('@th');
      })(keyman);
    </script>
  </body>
</html>