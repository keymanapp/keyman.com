<?php
  require_once('includes/template.php');
  require_once __DIR__ . '/../_includes/autoload.php';
  use Keyman\Site\com\keyman\KeymanHosts;

  // Required
  head([
    'title' =>'KeymanWeb | Keyboard Catalogue',
    'css' => ['template.css','dev.css','prism.css','prism-keyman.css'],
    'showMenu' => true
  ]);

  $keyboardcdn = KeymanHosts::Instance()->s_keyman_com.'/keyboard';
?>
<script src='<?=cdn('js/clipboard.min.js')?>'></script>
<script src='<?=cdn('js/prism.js')?>'></script>

<br />
<p><a href='/developer/keymanweb/'>&lt; KeymanWeb Developer Home</a></p>

<h2 class="red underline">Keyman Cloud Keyboard Catalogue</h2>

<p>
  This catalogue lists all the keyboards currently available on the Keyman Cloud for use with KeymanWeb <?php echo $stable_version; ?>.
</p>

<p>
  You can access a JSON version of this catalogue at:
  <br/>
  <input type='text' readonly size='60' value='<?= KeymanHosts::Instance()->api_keyman_com ?>/cloud/4.0/keyboards/?languageidtype=bcp47&amp;version=<?=$stable_version?>' onclick='this.select()'>
</p>

<ul>
  <li><a href='<?= KeymanHosts::Instance()->api_keyman_com ?>/cloud/4.0/keyboards/?languageidtype=bcp47&amp;version=<?=$stable_version?>' target='_blank'>View current JSON data</a></li>
  <li><a href='<?= KeymanHosts::Instance()->help_keyman_com ?>/developer/cloud/4.0/' target='_blank'>JSON API Documentation</a></li>
</ul>

<h2 class="red underline">How to add a keyboard to your site</h2>

<h3 class="red">From the Keyman Cloud CDN</h3>

<p>Downloading from the Keyman Cloud CDN guarantees you have the latest version of the keyboard, and automatically loads
webfonts if needed for your platform. It is the simplest way to add a keyboard to your site and is suitable for
small-medium sized sites. Larger sites will need to maintain their own copy of the keyboard file for performance and
stability.</p>

<p>First, find the keyboard you want to use in the catalogue below, and note the id of the language and the filename.</p>

<p>Then, add the following code to your page; the following example is for the Hieroglyphic keyboard:</p>

<pre class='code language-markup'><code>&lt;script&gt;
  keyman.addKeyboards('hieroglyphic@egy');
&lt;/script&gt;
</code></pre>

<h3 class="red">From another location</h3>

<p>First, find the keyboard you want to use in the catalogue below, and note all the details for the keyboard.</p>

<p>Then, save the keyboard .js file (right click on filename, and save), and upload it to your site.</p>

<p>Finally, add the following code to your page; this example is for Lao 2008 Basic. Note that the font information
relies on font source paths being configured in <a href='<?= KeymanHosts::Instance()->help_keyman_com ?>/developer/engine/web/<?php echo $stable_version; ?>/reference/core/init' target='_blank'>keyman.init()</a>.</p>

<pre class='code language-markup'><code>&lt;script&gt;
  keyman.addKeyboards({
    id: 'lao_2008_basic',
    name: 'Lao 2008 Basic',
    language: {
      id: 'lo',
      name:'Lao',
      region:'Asia',
      font: {
        family: 'LaoWeb',
        source: ['saysettha_web.ttf','saysettha_web.woff']
      }
    },
    filename: 'http://example.com/keyboard/lao_2008_basic-1.1.js'
  });
&lt;/script&gt;
</code></pre>

<br>

<ul>
  <li><a href='<?= KeymanHosts::Instance()->help_keyman_com ?>/developer/engine/web/<?php echo $stable_version; ?>/reference/core/addKeyboards'>keyman.addKeyboards()</a> reference documentation</li>
</ul>

<br>

<h2 class="red underline">Keyboard Catalogue</h2>

<ul>
  <li>Click the name of the keyboard to try it directly on keymanweb.com (the same URL will work on mobile or tablet).
  <li>Clicking the filename will load the compiled keyboard (right-click to save).
  <li>If the keyboard is on Github, the Github link will be on the right of the table.
</ul>
<br />
<p id='catalogue-key'><span class='device-support-none'>&#x2718;</span> = Unsupported
  <span class='device-support-basic'>&#x2714;</span> = Supported
  <span class='device-support-optimised'>&#x2714;</span> = Optimised
  <span class='device-support-dictionary'>D</span> = Dictionary
</p>

<table id='catalogue'>
  <thead>
    <tr><th rowspan='2'>Name</th><th rowspan='2'>Filename</th><th rowspan='2'>Version</th><th rowspan='2' style='width:100px'>BCP 47 Code</th><th rowspan='2'>Language</th><th colspan='3'>Device Support</th><th>Source</th></tr>
    <tr><th>Desktop</th><th>Phone</th><th>Tablet</th></tr>
  </thead>
  <tbody>

<?php
  $data = @file_get_contents(KeymanHosts::Instance()->api_keyman_com . '/cloud/4.0/keyboards?languageidtype=bcp47&version='.$stable_version);
  if($data === FALSE) {
    // fallback if API is down, bad news anyway.
    $data = file_get_contents('keyboards.txt');
  }
  $data = json_decode($data);
  //var_dump($data);

  function devicestring($v) {
    switch($v) {
      case 0: return "<td class='device-support-none'>&#x2718;</td>";
      case 1: return "<td class='device-support-basic'>&#x2714;</td>";
      case 2: return "<td class='device-support-optimised'>&#x2714;</td>";
      case 3: return "<td class='device-support-dictionary'>D</td>";
    }
    return $v;
  }

  foreach($data->keyboard as $keyboard) {
    $id = htmlentities($keyboard->id, ENT_QUOTES);
    $name = htmlentities($keyboard->name, ENT_QUOTES);
    $deviceDesktop = devicestring($keyboard->devices->desktop);
    $devicePhone = devicestring($keyboard->devices->phone);
    $deviceTablet = devicestring($keyboard->devices->tablet);
    $version = $keyboard->version;
    $class = 'first-keyboard';
    if(isset($keyboard->source) && preg_match('/\/(release|experimental)\//', $keyboard->source)) {
      // We'll only give GitHub paths for keyboards that are in the release or experimental namespaces
      $source = "<a href='{$keyboard->source}' target='_blank'><img src='".cdn('img/github-86x26.png')."' class='inline' alt='GitHub' title='Keyboard source on GitHub'></a>";
    } else {
      $source = '';
    }
    foreach($keyboard->languages as $language) {
      $languagename = htmlentities($language->name, ENT_QUOTES);
      echo <<<END
    <tr class='$class'><td><a href='http://keymanweb.com/#{$language->id},Keyboard_$id' target='_blank'>$name</a></td><td><a href='$keyboardcdn/$id/$version/$id-$version.js' target='_blank'>$id</a></td><td class='keyboard-version'>$version</td><td>{$language->id}</td><td>$languagename</td>$deviceDesktop$devicePhone$deviceTablet<td>$source</td></tr>
END;
      $class = 'next-keyboard';
    }
  }
?>
  </tbody>
</table>

