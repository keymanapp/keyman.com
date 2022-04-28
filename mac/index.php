<?php
  require_once('includes/template.php');
  require_once __DIR__ . '/../_includes/autoload.php';
  use Keyman\Site\Common\KeymanHosts;

  // Required
  head([
    'title' =>'Keyman ' . $stable_version . ' for macOS',
    'css' => ['template.css','index.css','desktop.css','feature-grid.css'],
    'showMenu' => true,
    'banner' => [
      'title' => 'Keyman for macOS<br/><span id="title-small">Type in your language</span>',
      'button' => '<div id="banner-buttons"><a class="banner-button" href="download.php"><img src="'.cdn('img/download_button.png').'" /></a></div>',
      'image' => 'mac-osk-hebrew.png',
      'background' => 'water'
    ]
  ]);

  $tick = '<img class="table-tick" src="'.cdn("img/table-tick.png").'"/>';

?>
<br/>
<h2 class="red underline">Introducing Keyman for macOS</h2>
<p>
    Keyman for macOS brings an extensive library of keyboards for over 2000 languages to macOS.
    You can even create your own custom keyboards with <a href="/developer/">Keyman Developer <?php echo $stable_version; ?></a> (a Windows product).
</p>
<p>
    Our unique virtual keyboard technology makes it easy to type in all your programs, including Microsoft Office,
    Adobe Creative Suite, internet browsers and more, as well as supporting the latest version of macOS.
</p>
<p class='center'>
    <a href="download.php"><img src="<?php echo cdn('img/download_button.png'); ?>" /></a>
</p>

<?php
    if (betaTier()) {
?>
        <p>Want to try the Keyman for macOS <?php echo $beta_version ?> Beta? <a href="/<?= $beta_version ?>/">Learn more</a></p>
<?php
    }
?>

<p>
    As with all Keyman products, Keyman for macOS is completely free. The feature grid below details what's available in the current version of Keyman for macOS:
</p>
<table class='feature-grid'>
  <thead>
      <tr>
          <th>Feature</th>
          <th>macOS Support</th>
      </tr>
  </thead>
  <tbody>
    <tr>
      <td>World-leading input methods for thousands of languages</td>
      <td><?=$tick;?></td>
    </tr>
    <tr>
      <td>Create your own custom keyboards</td>
      <td><?=$tick;?></td>
    </tr>
    <tr>
      <td>Keyboard switching hotkeys</td>
      <td></td>
    </tr>
    <tr>
      <td><a href='<?= KeymanHosts::Instance()->help_keyman_com ?>/developer/language/reference/baselayout'><code>baselayout()</code> statement</a></td>
      <td></td>
    </tr>
    <tr>
      <td><a href='<?= KeymanHosts::Instance()->help_keyman_com ?>/developer/language/reference/if'><code>if()</code> statement</a></td>
      <td><?=$tick;?> (except options forms)</td>
    </tr>
    <tr>
      <td><a href='<?= KeymanHosts::Instance()->help_keyman_com ?>/developer/language/reference/language'><code>&amp;language</code> store</a></td>
      <td></td>
    </tr>
    <tr>
      <td><a href='<?= KeymanHosts::Instance()->help_keyman_com ?>/developer/language/reference/mnemoniclayout'>mnemonic layouts</a> (always US base layout)</td>
      <td></td>
    </tr>
    <tr>
      <td><a href='<?= KeymanHosts::Instance()->help_keyman_com ?>/developer/<?php echo $stable_version; ?>/guides/develop/imx' target='_blank'>IMX support (e.g. Chinese keyboard)</a></td>
      <td></td>
    </tr>
  </tbody>
</table>

<p class='center'><img src='<?= cdn('img/mac-configuration.png'); ?>' alt='Keyman Configuration' /></p>

<h2 class="red underline">Frequently Asked Questions</h2>
<p>
    <span class="red">Q.</span> How do I install Keyman for macOS?
</p>
<p>
    <span class="red">A.</span> Visit <a href='<?= KeymanHosts::Instance()->help_keyman_com ?>/products/mac/current-version/start/install-keyman'>Keyman for macOS help</a>
    to learn how to install and start using Keyman on macOS.
</p>

<br/>
<p>
    <span class="red">Q.</span> What versions of macOS will Keyman work with?
</p>
<p>
    <span class="red">A.</span> Keyman is compatible with OS X Yosemite (10.10) and later.
</p>

<br/>
<p>
    <span class="red">Q.</span> Will my existing Keyman for Windows keyboards work with Keyman for macOS?
</p>
<p>
    <span class="red">A.</span> Most keyboards will work without change, and even without recompiling. A small subset of keyboards
    require features which are not yet available in Keyman for macOS. These features will be progressively implemented. Keyman for macOS
    will inform you when you attempt to install a keyboard if it is using a currently unsupported feature.
</p>

<br/>
<p>
    <span class="red">Q.</span> What languages does Keyman support?
</p>
<p>
    <span class="red">A.</span> The short answer is a lot! With keyboards for over 2000 languages,
    there's a very good chance we have yours covered. You can search for a keyboard for your language
    <a href="/keyboards">here</a>. If we don't already have a keyboard available, you can use
    <a href="/developer/">Keyman Developer <?php echo $stable_version; ?></a> (Windows only) to build one!
</p>

<br/>
<p>
    <span class="red">Q.</span> Are there any known issues?
</p>
<p>
    <span class="red">A.</span> Here are a few of the known issues:
    <ul>
        <li> Keyboards involving <a href="https://en.wikipedia.org/wiki/Plane_(Unicode)#Supplementary_Multilingual_Plane">SMP</a>
            characters (code points U+10000–​U+10FFFF) aren't correctly processing the characters.</li>
        <li>Keyman has compatibility <a href="https://github.com/keymanapp/keyman/issues?q=is%3Aopen+is%3Aissue+label%3Acompatibility+label%3Amac%2f">
            issues</a> with certain applications</li>
        <li> ​Dragging the Keyman app to the Input Methods alias on install does not work on OS X 10.8.5 Mountain Lion.</li>
        <li> On some computers, you need to allow “apps from anywhere” in security in order for Keyman to start.</li>
        <li> The ​Keyman Configuration window should not be on top of other applications.</li>
    </ul>
</p>
<br/>
