<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />

  <!-- Set the viewport width to match phone and tablet device widths -->
  <meta name="viewport" content="width=device-width,user-scalable=no" />

  <!-- Allow KeymanWeb to be saved to the iPhone home screen -->
  <meta name="apple-mobile-web-app-capable" content="yes" />

  <title>KeymanWeb Sample 1</title>
</head>
<body>
  <h1>KeymanWeb Sample 1</h1>
  <textarea cols="20" rows="5"></textarea>

  <?php
    // We use this small piece of PHP just to find the most recent version of
    // KeymanWeb server-side, but you may prefer to pin a specific version
    require_once("./keymanweb-version.inc.php");
    $cdnUrlBase = getKeymanWebHref();
  ?>

  <!--
      In this example, we are loading KeymanWeb late.  If you focus on a control early (e.g. a search box),
      you may want to place the KeymanWeb code into the head instead, to ensure it is available by the
      time the user wants to start typing.
    -->

  <!-- KeymanWeb script -->
  <script src='<?= $cdnUrlBase ?>/keymanweb.js'></script>

  <!--
      For desktop browsers, a script for the user interface must be inserted here.

      Standard UIs are toggle, button, float and toolbar.
      The toolbar UI is best for any page designed to support keyboards for
      a large number of languages.
    -->
  <script src='<?= $cdnUrlBase ?>/kmwuitoggle.js'></script>

  <!-- Initialization: set paths to keyboards, resources and fonts as required -->
  <script>
    keyman.init({
      attachType: 'auto'
    });
    keyman.addKeyboards('@en');
    keyman.addKeyboards('@th');
  </script>
</body>

</html>