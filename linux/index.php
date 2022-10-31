<?php
  require_once('includes/template.php');
  require_once __DIR__ . '/../_includes/autoload.php';
  use Keyman\Site\Common\KeymanHosts;

  // Required
  head([
    'title' =>'Keyman ' . $stable_version . ' for Linux',
    'css' => ['template.css','index.css','desktop.css','feature-grid.css', 'prism.css'],
    'js' => ['prism.js'],
    'showMenu' => true,
    'banner' => [
      'title' => 'Keyman for Linux<br/><span id="title-small">Type in your language</span>',
      'button' => '<div id="banner-buttons"><a class="banner-button" href="download.php"><img src="'.cdn('img/download_button.png').'" /></a></div>',
      'image' => 'linux-osk-khmer.png',
      'background' => 'water'
    ]
  ]);

  $tick = '<img class="table-tick" src="'.cdn("img/table-tick.png").'"/>';

?>
<br/>
<h2 class="red underline">Introducing Keyman for Linux</h2>
<p>
    Keyman for Linux makes it possible to type in over 2000 languages in any Linux application. Create your own custom
    keyboards with <a href="/developer/">Keyman Developer <?php echo $stable_version; ?></a>*.
</p>
<p>
    Keyman for Linux also supports KMFL keyboards, so your existing KMFL keyboards will continue to work.
</p>
<p>
    * Keyman Developer is currently a Windows-only product; however, the command line compiler kmcomp runs in WINE.
</p>
<p class='center'>
    <a href="download.php"><img src="<?php echo cdn('img/download_button.png'); ?>" /></a>
</p>

<?php
    if (betaTier()) {
?>
        <p>Want to try the Keyman for Linux <?php echo $beta_version ?> Beta? <a href="/beta/">Learn more</a></p>
<?php
    }
?>

<p>
    As with all Keyman products, Keyman for Linux is completely free and open-source. The feature grid below details the technical differences in functionality between Keyman for Windows, and the current version of Keyman for Linux:
</p>
<table class='feature-grid'>
  <thead>
      <tr>
          <th>Feature</th>
          <th>Windows Support</th>
          <th>Linux Support</th>
      </tr>
  </thead>
  <tbody>
    <tr>
      <td>World-leading input methods for thousands of languages</td>
      <td><?=$tick;?></td>
      <td><?=$tick;?></td>
    </tr>
    <tr>
      <td>Create your own custom keyboards</td>
      <td><?=$tick;?></td>
      <td><?=$tick;?></td>
    </tr>
    <tr>
      <td>Keyboard switching hotkeys</td>
      <td><?=$tick;?></td>
      <td></td>
    </tr>
    <tr>
      <td><a href='<?= KeymanHosts::Instance()->help_keyman_com ?>/developer/language/reference/baselayout'><code>baselayout()</code> statement</a></td>
      <td><?=$tick;?></td>
      <td></td>
    </tr>
    <tr>
      <td><a href='<?= KeymanHosts::Instance()->help_keyman_com ?>/developer/language/reference/if'><code>if()</code> statement</a></td>
      <td><?=$tick;?></td>
      <td><?=$tick;?><br></td>
    </tr>
    <tr>
      <td><a href='<?= KeymanHosts::Instance()->help_keyman_com ?>/developer/language/reference/mnemoniclayout'>mnemonic layouts</a> (always US base layout)</td>
      <td><?=$tick;?></td>
      <td></td>
    </tr>
    <tr>
      <td><a href='<?= KeymanHosts::Instance()->help_keyman_com ?>/developer/<?= $stable_version; ?>/guides/develop/imx' target='_blank'>IMX support (e.g. Chinese keyboard)</a></td>
      <td><?=$tick;?></td>
      <td></td>
    </tr>
  </tbody>
</table>

<p class='center'><img src='<?= cdn('img/linux-configuration.png'); ?>' alt='Keyman Configuration' /></p>

<h2 class="red underline">Frequently Asked Questions</h2>
<p>
  <span class="red">Q.</span> What Linux distros will Keyman work with?
</p>
<p>
  <span class="red">A.</span> Keyman is built for amd64 architecture and runs on Debian, Ubuntu, Wasta Linux.
  It can be compiled to run from source in most distributions.
</p>

<br/>
<p>
    <span class="red">Q.</span> How do I install Keyman for Linux?
</p>
<p>
    <span class="red">A.</span> Ubuntu: Keyman for Linux can be installed via launchpad:
<pre class='language-bash code'><code>sudo add-apt-repository ppa:keymanapp/keyman
sudo apt install keyman onboard-keyman</code></pre>
</p>

<br />
<p>
  Keyman for Linux can also be installed from <a href="http://packages.sil.org/">packages.sil.org</a>:
</p>

<pre><code class='language-bash'>
(wget -O- https://packages.sil.org/keys/pso-keyring-2016.gpg | \
  sudo tee /etc/apt/trusted.gpg.d/pso-keyring-2016.gpg)&>/dev/null
(. /etc/os-release && sudo tee /etc/apt/sources.list.d/packages-sil-org.list >/dev/null \
  <<< "deb http://packages.sil.org/ubuntu $UBUNTU_CODENAME main")
sudo apt update
sudo apt install keyman onboard-keyman
</code></pre>

<br />
<p>
    <span class="red">Q.</span> How do I install a Keyman keyboard?
</p>
<p>
    <span class="red">A.</span> From the launcher, enter: <code class='language-bash'>Keyman keyboards</code>
</p>
<p>
    This brings up a configuration panel where you can "Download" Keyman keyboards from the cloud repository. You can also "Install"
    keyboards via local .kmp keyboard packages. In some keyboard packages, you might need to add the keyboard to
    IBus by adding an "Other" input source. See <a href='<?= KeymanHosts::Instance()->help_keyman_com ?>/products/linux/<?= $stable_version; ?>/start/installing-keyboard'>
    <?= KeymanHosts::Instance()->help_keyman_com_host ?></a> for more details on installing a keyboard.
</p>

<br/>
<p>
    <span class="red">Q.</span> How do I get the on-screen keyboard?
</p>
<p>
    <span class="red">A.</span> From the launcher, enter: <code class='language-bash'>onboard</code>
</p>

<br/>
<p>
  <span class="red">Q.</span> Does Keyman for Linux work with Wayland?
</p>
<p>
  <span class="red">A.</span> Currently, there's <a href="https://github.com/keymanapp/keyman/issues/4273">issue #4273</a>
  to add support for Wayland. As a workaround, use X11.
</p>

<br/>
<p>
    <span class="red">Q.</span> What's the relationship between Keyman for Linux and KMFL?
</p>
<p>
    <span class="red">A.</span> Keyman for Linux and KMFL are released together in the Keyman
    <a href="https://en.wikipedia.org/wiki/Ubuntu#Package_Archives">PPA</a>, but are separate. The installation
    instructions above will install Keyman, not KMFL.
</p>

<br/>
<p>
    <span class="red">Q.</span> Can I have Keyman for Linux and KMFL installed at the same time?
</p>
<p>
    <span class="red">A.</span> Yes. To install KMFL on Ubuntu:
<pre class='language-bash code'><code>sudo add-apt-repository ppa:keymanapp/keyman
sudo apt install ibus-kmfl</code></pre>
</p>

<br/>
<p>
    <span class="red">Q.</span> If I already had KMFL installed, how can I uninstall KMFL before installing Keyman?
</p>
<p>
    <span class="red">A.</span> It is good to remove any keyboards from ibus e.g. KMFL keyboards before you remove KMFL.
    Then, to remove KMFL:
<pre class='language-bash code'><code>sudo dpkg --purge ibus-kmfl libkmfl</code></pre>
</p>

<br/>
<p>
    <span class="red">Q.</span> Will my existing Windows Keyman keyboard work with Keyman for Linux?
</p>
<p>
    <span class="red">A.</span> Most keyboards will work without change. A small subset of keyboards
    require features which are not yet available in Keyman for Linux. These features will be progressively implemented.
</p>

<br/>
<p>
    <span class="red">Q.</span> I found a bug. Where can I report it?
</p>
<p>
    <span class="red">A.</span> Please report bugs through the <a href='https://community.software.sil.org/c/keyman'>SIL Keyman Community</a>.
</p>

<br/>
<p>
    <span class="red">Q.</span> What languages does Keyman support?
</p>
<p>
    <span class="red">A.</span> The short answer is a lot! With keyboards for over 2000 languages,
    there's a very good chance we have yours covered. You can search for a keyboard for your language
    <a href="/keyboards">here</a>. If we don't already have a keyboard available, you can use
    <a href="/developer/">Keyman Developer</a> to build one!
</p>

<br/>
<p>
    <span class="red">Q.</span> Will you help me install Keyman?
</p>
<p>
    <span class="red">A.</span> Because we are offering this as a free download, we can not provide direct technical support.
    Please direct support enquiries to the <a href='https://community.software.sil.org/c/keyman'>SIL Keyman Community</a>.
</p>

<br/>
<p>
    <span class="red">Q.</span> Are there any known issues?
</p>
<p>
    <span class="red">A.</span> All known issues are listed in our <a href='https://github.com/keymanapp/keyman/issues?q=is%3Aopen+is%3Aissue+label%3Alinux/'>GitHub repository</a>.
</p>
<br/>
