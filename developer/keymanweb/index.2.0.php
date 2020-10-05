<?php
  require_once('includes/template.php');
  require_once __DIR__ . '/../../_includes/autoload.php';
  use Keyman\Site\Common\KeymanHosts;

  // Required
  head([
    'title' =>'KeymanWeb | Source Code and Development',
    'css' => ['template.css','dev.css','prism.css','prism-keyman.css'],
    'showMenu' => true
  ]);

  // Hard coded now, because we cannot easily query for legacy 2.0 versions
  $build = "2.0.473";
?>
<script src='<?=cdn('js/clipboard.min.js')?>'></script>
<script src='<?=cdn('js/prism.js')?>'></script>

<h2 class="red underline">KeymanWeb Source Code and Development</h2>

<p class='note red'>Note: Please see <a href='index.php'>KeymanWeb <?= $stable_version ?></a> documentation for information on the latest version.</p>

<p>
  KeymanWeb 2.0 is an Open Source input method system for the web, supporting both desktops and touch devices. Keyboard layouts for
  use with KeymanWeb can be created with the free download <a href='http://www.tavultesoft.com/keymandev/download90.php'>Keyman Developer</a> (Windows).
</p>

<h2 class="red underline">Add KeymanWeb (minified version) to a Website</h2>

<p>KeymanWeb can be added to your website with just a few lines of code. The following example sources both the core <i>engine</i> and two keyboard
layouts from the Keyman Cloud CDN; the code can be hosted on your own servers just as easily.</p>

<p>View code snippet versions: <select id='show-code-select' onchange='return showCode(this)'>
  <option value='https-min'>https minified</option>
  <option value='https-src'>https full source</option>
  <option value='http-min'>http minified</option>
  <option value='http-src'>http full source</option>
</select>
</p>

<?php
  function writeKeyboardScript($proto, $type, $visible = false) {
    global $build;
    $keyboardLoad = <<<END
&lt;script&gt;
  (function(kmw) {
    kmw.init();
    kmw.addKeyboards('@eng'); // Loads default English keyboard from Keyman Cloud (CDN)
    kmw.addKeyboards('@tha'); // Loads default Thai keyboard from Keyman Cloud (CDN)
  })(tavultesoft.keymanweb);
&lt;/script&gt;
END;
    $url = KeymanHosts::Instance()->s_keyman_com . "/kmw/engine/$build";

    if($type === 'src') {
      $s = <<<END
&lt;script src="$url/src/kmwstring.js"&gt;&lt;/script&gt;
&lt;script src="$url/src/kmwbase.js"&gt;&lt;/script&gt;
&lt;script src="$url/src/keymanweb.js"&gt;&lt;/script&gt;
&lt;script src="$url/src/kmwosk.js"&gt;&lt;/script&gt;
&lt;script src="$url/src/kmwnative.js"&gt;&lt;/script&gt;
&lt;script src="$url/src/kmwcallback.js"&gt;&lt;/script&gt;
&lt;script src="$url/src/kmwkeymaps.js"&gt;&lt;/script&gt;
&lt;script src="$url/src/kmwlayout.js"&gt;&lt;/script&gt;
&lt;script src="$url/src/kmwinit.js"&gt;&lt;/script&gt;

&lt;script src='$url/src/ui/toggle/kmwuitoggle.js'&gt;&lt;/script&gt;
END;
    } else {
      $s = <<<END
&lt;script src='$url/keymanweb.js'&gt;&lt;/script&gt;
&lt;script src='$url/kmwuitoggle.js'&gt;&lt;/script&gt;
END;
    }
    $visible = !$visible ? " style='display:none'":"";

    return "<pre id='kmw-$proto-$type' class='language-markup code'$visible'><code>$s\n$keyboardLoad</code></pre>";
  }

?>

<div id='keymanweb-code'>
<?php echo writeKeyboardScript('http','min');?>
<?php echo writeKeyboardScript('http','src');?>
<?php echo writeKeyboardScript('https','min',true);?>
<?php echo writeKeyboardScript('https','src');?>
</div>

<script>
  function showCode(e) {
    $('pre', '#keymanweb-code').hide();
    $('pre#kmw-'+e.value, '#keymanweb-code').show();
  }
</script>

<p><a href='sample1.php' target='_blank'>Try it!</a></p>

<p>KeymanWeb has multiple user interface designs to fit into any site. The sample above uses the
Toggle User Interface for desktop browsers.  Mobile browsers all integrate the language selection into
the on screen keyboard.</p>

<ul>
  <li>Learn more about using KeymanWeb in the <a href='<?= KeymanHosts::Instance()->help_keyman_com ?>/developer/engine/web/'>KeymanWeb documentation</a></li>
</ul>

<h2 class='red underline'>Add custom keyboard to a Website</h2>

<p>The following code snippet shows how you can include a custom keyboard on your website. The keyboard .js file can be created with <a href='/developer'>Keyman Developer</a>.</p>

<pre class='code language-js'><code>
  &lt;script&gt;
    tavultesoft.keymanweb.addKeyboards({
      name: 'Tai Nua',
      id: 'tainua',
      filename: './tainua-1.0.js',
      version: '1.0',
      language: [{
        name: 'Tai Nua',
        id: 'tdd',
        region: 'as'
      }]
    });
  &lt;/script&gt;
</code></pre>

<ul>
  <li><a href='<?= KeymanHosts::Instance()->help_keyman_com ?>/developer/engine/web/2.0/reference/core/addKeyboards'>addKeyboards reference documentation</a></li>
</ul>

<h2 class='red underline'>Use the Keyman Cloud CDN</h2>

<p>The Keyman Cloud CDN is appropriate for smaller sites. HTTP and HTTPS endpoints are available. HTTPS is recommended.</p>

<table class='basic-table'><tbody>
<tr><td>HTTP endpoint:</td><td><input type='text' readonly size='60' value='<?= KeymanHosts::Instance()->s_keyman_com ?>/kmw/engine/<?=$build?>/keymanweb.js' onclick='this.select()'></td></tr>
<tr><td>HTTPS endpoint:</td><td><input type='text' readonly size='60' value='<?= KeymanHosts::Instance()->s_keyman_com ?>/kmw/engine/<?=$build?>/keymanweb.js' onclick='this.select()'></td></tr>
</tbody></table>

<br>

<ul>
  <li><a href='keyboards.php'>Keyman Cloud CDN Keyboard Catalogue</a></li>
  <li><a href='<?= KeymanHosts::Instance()->help_keyman_com ?>/developer/engine/web/get-version.php'>How to: retrieve the latest version of KeymanWeb from Keyman Cloud CDN</a></li>
</ul>

<br>

<h2 class="red underline">Get the code + Contribute</h2>
<p>
  There are additional samples in the code repository. We prefer git pull requests for code submissions.
</p>

<ul>
  <li><a href='https://github.com/keymanapp/keyman/tree/master/web'>KeymanWeb on GitHub</a></li>
  <li><a href='<?= KeymanHosts::Instance()->downloads_keyman_com ?>/web/'>Download KeymanWeb releases</a> (alpha, beta and stable)</li>
</ul>

<br>

<h3>License</h3>

<p>
  KeymanWeb is distributed under the <a href='https://github.com/keymanapp/keyman/blob/master/web/LICENSE'>MIT license</a>.
</p>
