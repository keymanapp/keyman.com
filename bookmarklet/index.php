<?php
  require_once('includes/template.php');
  require_once __DIR__ . '/../_includes/autoload.php';
  use Keyman\Site\Common\KeymanHosts;

  $lang = isset($_GET['language']) ? $_GET['language'] : '';
  $kbd = isset($_GET['keyboard']) ? $_GET['keyboard'] : '';

  // Required
  head([
    'title' =>'Keyman Bookmarklet',
    'css' => ['template.css','index.css'],
    'showMenu' => true
  ]);
?>

<script type="text/javascript">
  var resourceBase="<?php echo $KeymanHosts->r_keymanweb_com; ?>";
  var kbdname = '<?= $kbd ?>';
  var languageCode = '<?= $lang ?>';
</script>
<script type='text/javascript' src='install-bookmarklet.js'></script>

<h2 class="red underline">Keyman Bookmarklet</h2>
<p>
    The KeymanWeb bookmarklet allows you to use a KeymanWeb keyboard on nearly any web page just by clicking the KeymanWeb bookmark, after the page finishes loading.
</p>

<div id='bookmarklet'>
    <h3>Keyman Bookmarklet</h3>
    <div><a href='#'></a></div>
    <p>
        Drag this button to your Bookmarks toolbar to install this keyboard to your web browser!
        <a target="_blank" href="<?= KeymanHosts::Instance()->help_keyman_com ?>/products/bookmarklet/">Learn more</a>
    </p>
</div>
<div id="bookmarklet-search">
    <h3>Keyman Bookmarklet Search</h3>
    <div id="bookmarklet-list">
        <div id="bookmarklet-list-inner">

        </div>
    </div>
    <p>
        Drag a Bookmarklet to your Bookmarks toolbar to install the keyboard to your web browser!
    </p>
</div>

<h2 class="red underline">Use the bookmarklet on any website</h2>
<ol>
    <li>Load any web page, such as a search engine</li>
    <li>Click the Keyman Bookmarklet in your Bookmarks toolbar or menu</li>
    <li>You may need to wait a second or two for Keyman Bookmarklet to load. Then click in the text field you wish to type into. The Keyman Bookmarklet user interface will appear and you can type in your language</li>
</ol>

<h2 class="red underline">Try the bookmarklet</h2>
<p>You can try the Bookmarklet you just installed right here.  Click the bookmarklet in the toolbar once to load it.  Then
click in the box below and start typing in the language of your choice!</p>

<textarea cols='80' rows='6' style='width:80%; margin-left:10px'></textarea>
<div class="spacer"></div>