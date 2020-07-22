<?php
  require_once('includes/template.php');
  require_once('includes/ui/downloads.php');
  require_once('includes/appstore.php');
  require_once('includes/playstore.php');

  require_once __DIR__ . '/../_includes/autoload.php';
  use Keyman\Site\com\keyman\KeymanHosts;

  // Required
  head([
    'class' => 'keyman11',
    'title' => 'Keyman 11 here and free!',
    'css' => ['template.css', 'dev.css', 'app-store-links.css', 'prism.css'],
    'js' => ['prism.js'],
    'showMenu' => true,
    'banner' => [
        'title' => 'Type to the world with the latest Keyman 11 products',
        'image' => 'world.png',
        'background' => 'water'
    ]
]);
?>

<h1>Keyman 11.0 Stable</h1>
<p class="red">27 February 2019</p>
<li>Keyman 11.0 is now officially released! Find the 11.0 download for your platform below.</li>

<h2>What's New?</h2>

<ul>
  <li>Keyman now runs on Linux</li>
  <li>Support for Metro-style (Windows Store) applications on Windows</li>
  <li>Rework of Keyman for Android user interface to use Material Design themes</li>
  <li>All new text editor, project templates and many internal updates to Keyman Developer</li>
  <li>Lots of bug fixes and tweaks on all platforms</li>
</ul>

<h2>What's Next?</h2>
<ul>
  <li>Looking for something else? Check the <a href="<?= KeymanHosts::Instance()->blog_keyman_com ?>/2019/02/keyman-roadmap-february-2019/">Keyman Roadmap</a> and see if it's tentatively scheduled.
</ul>

<h2>11.0 Stable Feedback</h2>
<ul>
  <li>Please send feedback about Keyman 11 Stable to the
  <a href="https://community.software.sil.org/c/keyman">Keyman Community site</a>.</li>
</ul>

<h1 class='red underline'>User Software</h1>

<h2 id='linux' class='red underline'>Keyman Desktop 11</h2>
<h3>Stable</h3>
<ul>
  <li><a href='/desktop/download.php'>Download Keyman Desktop 11</a></li>
</ul>

<br>

<h3> What's New in Keyman Desktop 11 for Windows?</h3>

<ul>
  <li>Improved stability when using modifier keys</li>
  <li>Introduce support for Metro-style (UWP) applications such as Edge and Skype</li>
  <li>Added Kannada localization</li>
</ul>

<?php
  downloadSection('Keyman 11 for macOS',   'mac',     'keyman-$version.dmg', 'stable');
?>

<h3>What's New in Keyman 11 for macOS?</h3>

<li>Fixed bug where Keyman for macOS sometimes would use the wrong rule in a keyboard</li>

<h2 id='linux' class='red underline'>Keyman 11 for Linux</h2>
<li>Ubuntu, Wasta-Linux: Keyman for Linux can be installed via launchpad:</li>
<blockquote><pre class='language-bash code'><code>sudo add-apt-repository ppa:keymanapp/keyman
sudo apt-get update
sudo apt-get upgrade
sudo apt-get install keyman onboard</code></pre></blockquote>

<h3>What is Keyman for Linux? <span class="red">New!</span></h3>

<ul>
  <li>Based on KMFL</li>
  <li>Allows use of .kmp Keyman keyboard packages with IBus</li>
  <li>Download any keyboard from the Keyman Cloud Repository</li>
  <li>GUI configuration and command line tools</li>
  <li>Adds on screen keyboard, integrated documentation support</li>
  <li>Continues to support KMFL keyboards</li>
</ul>

<?php
  downloadSection('Keyman for Android 11', 'android', 'keyman-$version.apk', 'stable');
?>
<li>Keyman for Android is available on the Play Store.</li>
<?= $playstoreTable ?>

<h3>What's new in Keyman for Android 11?</h3>

<ul>
  <li>Updated app to use Material Design theme</li>
  <li>Device vibrates when current keyboard signals an invalid keystroke (e.g. two identical diacritics in a row)</li>
  <li>Fixed issues with oversized key text and diacritics not displaying correctly</li>
  <li>Improved support for hardware keyboards (including 102nd key found on European keyboards)</li>
  <li>Fixed integration with hardware keyboard keys [tab] and [backspace]</li>
  <li>Updated minimum version of Android to 4.1 (Jelly Bean)</li>
</ul>

<h2 class="red underline">Keyman for iPhone and iPad 11</h2>
<h3>Stable</h3>
<li>Keyman for iPhone and iPad can be found on the App Store.</li>
<?= $appstoreTable ?>

<h3>What's new in Keyman for iPhone and iPad 11?</h3>

<ul>
  <li>Fixed issues with keyboard rotation and sizing, including the iPhone X notch</li>
  <li>Device vibrates when current keyboard signals an invalid keystroke (e.g. two identical diacritics in a row)</li>
  <li>Fixed issues with oversized key text and diacritics not displaying correctly</li>
</ul>

<?php
  downloadSection('KeymanWeb 11', 'web', 'keymanweb-$version.zip', 'stable');
?>

<!--h3>What's New in KeymanWeb 11?</h3-->


<h1 class='red underline'>Developer Software</h1>

<?php
  downloadSection('Keyman Developer 11',    'developer', 'keymandeveloper-$version.exe', 'stable');
?>

<h3>What's new in Keyman Developer 11?</h3>

<ul>
  <li>Brand new text editor (same as Visual Studio Code)</li>
  <li>Keyboard project templates</li>
</ul>