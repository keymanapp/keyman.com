<?php
  require_once('includes/template.php');
  require_once __DIR__ . '/../../_includes/autoload.php';
  use Keyman\Site\Common\KeymanHosts;
  use Keyman\Site\com\keyman\KeymanWebHost;

  // Required
  head([
    'title' =>'KeymanWeb | Source Code and Development',
    'css' => ['template.css','dev.css','prism.css'],
    'showMenu' => true
  ]);

  $cdnUrlBase = KeymanWebHost::getKeymanWebUrlBase();
?>
<script src='<?=cdn('js/clipboard.min.js')?>'></script>
<script src='<?=cdn('js/prism.js')?>'></script>

<h2 class="red underline">KeymanWeb Source Code and Development</h2>
<p>
  KeymanWeb <?= $stable_version; ?> is an Open Source input method system for the web, supporting both desktops and touch devices. Keyboard layouts for
  use with KeymanWeb can be created with the free download <a href='/developer/download.php'>Keyman Developer</a> (Windows).
</p>

<h2 class="red underline">Add KeymanWeb to a Website</h2>

<p>KeymanWeb can be added to your website with just a few lines of code. The following example sources both the core <i>engine</i> and two keyboard
layouts from the Keyman Cloud CDN; the code can be hosted on your own servers just as easily.</p>

<div id='keymanweb-code'>
<pre class='language-markup code'><code>
&lt;script src='<?=$cdnUrlBase?>/keymanweb.js'&gt;&lt;/script&gt;
&lt;script src='<?=$cdnUrlBase?>/kmwuitoggle.js'&gt;&lt;/script&gt;
&lt;script&gt;
  (function() {
    keyman.init({attachType:'auto'});
    keyman.addKeyboards('@en'); // Loads default English keyboard from Keyman Cloud (CDN)
    keyman.addKeyboards('@th'); // Loads default Thai keyboard from Keyman Cloud (CDN)
  })();
&lt;/script&gt;
</code></pre>
</div>

<h3>Live Examples</h3>

<ul>
  <li>
    <a href='sample1.php' target='_blank'>Basic Example</a>
    (<a href="https://github.com/keymanapp/keyman.com/blob/master/developer/keymanweb/sample1.php">source code</a>)
  </li>
  <li>
    <a href='sample2.php' target='_blank'>Multi-language example</a>
    (<a href="https://github.com/keymanapp/keyman.com/blob/master/developer/keymanweb/sample2.php">source code</a>)
  </li>
</ul>

<p>KeymanWeb has multiple user interface designs to fit into any site. The Basic Example above uses the
Toggle User Interface for desktop browsers.  Mobile browsers all integrate the language selection into
the on screen keyboard.</p>

<ul>
  <li>Learn more about using KeymanWeb in the <a href='<?= KeymanHosts::Instance()->help_keyman_com ?>/developer/engine/web/'>KeymanWeb documentation</a></li>
</ul>

<h2 class='red underline'>Add custom keyboard to a Website</h2>

<p>The following code snippet shows how you can include a custom keyboard on your website. The keyboard .js file can be created with <a href='/developer'>Keyman Developer</a>.</p>

<pre class='code language-js'><code>
  &lt;script&gt;
    keyman.addKeyboards({
      name: 'Tai Nua',
      id: 'tainua',
      filename: './tainua.js',
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
  <li><a href='<?= KeymanHosts::Instance()->help_keyman_com ?>/developer/engine/web/<?= $stable_version; ?>/reference/core/addKeyboards'><code>addKeyboards</code> reference documentation</a></li>
</ul>

<h2 class='red underline'>Use the Keyman Cloud CDN</h2>

<p>The Keyman Cloud CDN is appropriate for smaller sites.</p>

<table class='basic-table'><tbody>
  <tr><td>Endpoint:</td><td><input type='text' readonly size='60' value='<?= KeymanWebHost::getKeymanWebUrlBase() ?>/keymanweb.js' onclick='this.select()'></td></tr>
</tbody></table>

<br>

<ul>
  <li><a href='keyboards.php'>Keyman Cloud CDN Keyboard Catalogue</a></li>
  <li><a href='<?= KeymanHosts::Instance()->help_keyman_com ?>/developer/cloud/version/2.0'>How to: retrieve the latest version of KeymanWeb from Keyman Cloud CDN</a></li>
  <li><a href='index.2.0.php'>Using older versions of KeymanWeb</a></li>
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

<h2 class="red underline">License</h2>

<p>
  KeymanWeb is distributed under the <a href='https://github.com/keymanapp/keyman/blob/master/web/LICENSE'>MIT license</a>.
</p>
