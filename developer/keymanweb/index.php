<?php
  require_once('includes/template.php');
  
  // Required
  head([
    'title' =>'KeymanWeb | Source Code and Development',
    'css' => ['template.css','dev.css','prism.css','prism-keyman.css'],
    'showMenu' => true
  ]);           
  
  $json = @file_get_contents("$apihost/version/web");
  if($json) {
    $json = json_decode($json);
  }
  if($json && property_exists($json, 'version')) {
    $build = $json->version;
  } else {
    // If the get-version API fails, we'll use the latest known version
    $build = "10.0.103"; // NOTE: we don't yet have a 11.0 stable so we'll add that once we have it
  }
  
  $cdnUrlBase = "$statichost/kmw/engine/$build";
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
  (function(kmw) {
    kmw.init({attachType:'auto'});
    kmw.addKeyboards('@en'); // Loads default English keyboard from Keyman Cloud (CDN)
    kmw.addKeyboards('@th'); // Loads default Thai keyboard from Keyman Cloud (CDN)
  })(keyman);
&lt;/script&gt;
</code></pre>
</div>
  
<p>Upgrade Note: with KeymanWeb <?= $stable_version; ?>, the unminified version is no longer served from our CDN.
Instead, we use source maps to make the full source available in web developer tools.</p>

<p><a href='sample1.php' target='_blank'>Try it!</a></p>

<p>KeymanWeb has multiple user interface designs to fit into any site. The sample above uses the 
Toggle User Interface for desktop browsers.  Mobile browsers all integrate the language selection into
the on screen keyboard.</p>

<ul>
  <li>Learn more about using KeymanWeb in the <a href='https://help.keyman.com/developer/engine/web/'>KeymanWeb documentation</a></li>
</ul>

<h2 class='red underline'>Add custom keyboard to a Website</h2>

<p>The following code snippet shows how you can include a custom keyboard on your website. The keyboard .js file can be created with <a href='/developer'>Keyman Developer</a>.</p>

<pre class='code language-js'><code>
  &lt;script&gt;
    keyman.addKeyboards({
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
  <li><a href='https://help.keyman.com/developer/engine/web/10.0/reference/core/addKeyboards'><code>addKeyboards</code> reference documentation</a></li>
</ul>

<h2 class='red underline'>Use the Keyman Cloud CDN</h2>

<p>The Keyman Cloud CDN is appropriate for smaller sites. While HTTP and HTTPS endpoints are available, HTTPS is always recommended.</p>

<table class='basic-table'><tbody>
  <tr><td>HTTPS endpoint:</td><td><input type='text' readonly size='60' value='https://s.keyman.com/kmw/engine/<?=$build?>/keymanweb.js' onclick='this.select()'></td></tr>
</tbody></table>

<br>

<ul>
  <li><a href='keyboards.php'>Keyman Cloud CDN Keyboard Catalogue</a></li>
  <li><a href='https://help.keyman.com/developer/cloud/version/2.0'>How to: retrieve the latest version of KeymanWeb from Keyman Cloud CDN</a></li>
  <li><a href='index.2.0.php'>Using older versions of KeymanWeb</a></li>
</ul>

<br>

<h2 class="red underline">Get the code + Contribute</h2>    
<p>
  There are additional samples in the code repository. We prefer git pull requests for code submissions.
</p>

<ul>
  <li><a href='https://github.com/keymanapp/keyman/tree/master/web'>KeymanWeb on GitHub</a></li>
  <li><a href='https://downloads.keyman.com/web/'>Download KeymanWeb releases</a> (alpha, beta and stable)</li>
</ul>

<br>

<h2 class="red underline">License</h2>

<p>
  KeymanWeb is distributed under the <a href='https://github.com/keymanapp/keyman/blob/master/web/LICENSE'>MIT license</a>.
</p>
