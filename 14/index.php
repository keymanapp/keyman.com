<?php

require_once('includes/template.php');
require_once('includes/ui/downloads.php');
require_once('includes/appstore.php');
require_once('includes/playstore.php');

use Keyman\Site\Common\KeymanHosts;

// Required
head([
  'class' => 'keyman11',
  'title' => 'Keyman 14 is now available!',
  'css' => ['template.css', 'dev.css', 'app-store-links.css', 'prism.css'],
  'js' => ['prism.js'],
  'showMenu' => true,
  'banner' => [
  'title' => 'Keyman 14.0 is now available!',
    'image' => 'screenshots/14/typewriter.jpg',
    'background' => 'black'
  ]
]);
?>

<h2>Announcing the release of Keyman 14.0</h2>
<p class="red">24 March 2021</p>
<p>We are pleased to announce that Keyman 14.0 is now available for download!</p>

<br>

<p><a href='https://blog.keyman.com/2021/03/keyman-14-0/'>Read our Keyman 14 launch blog post</a></p>
<p><a href='webinar'>Register to attend the Keyman 14 Launch webinar series</a> (late March/early April 2021)</p>

<h3>What's New?</h3>
<p>These major features are in all supported platforms:</p>
<ul>
  <li>
    Simpler and Smoother Keyboard Search<br>
    <img alt='Search for Khmer Keyboard' src='keyboard_search_khmer.png'>
  </li>
  <li>
    Localizable UI through <a href="<?= KeymanHosts::Instance()->translate_keyman_com ?>">translate.keyman.com</a> (not yet available for macOS).
  </li>
  <li>
    Mobile apps download and install keyboard packages from keyman.com
  </li>
  <li>
    Consolidated crash reporting to <a href="<?= KeymanHosts::Instance()->sentry_keyman_com ?>">sentry.keyman.com</a>
  </li>
  <li>
    Many bug fixes and improvements (see the <a href="<?= KeymanHosts::Instance()->help_keyman_com ?>/version-history">version history</a>)
  </li>
</ul>
<br>

<h3>What's Next?</h3>
<ul>
  <li>
    Check the <a href="https://blog.keyman.com/2020/03/keyman-roadmap-march-2020/">Keyman Roadmap</a> for upcoming features.
  </li>
</ul>
<br>

<h3>Keyman 14.0 Feedback</h3>
<ul>
  <li>Please send feedback about Keyman 14 to the
    <a href="https://community.software.sil.org/c/keyman">Keyman Community site</a> or submit bugs and feature requests to our
    <a href="https://github.com/keymanapp/keyman/issues/new/choose">Issue Tracker</a></li>
</ul>
<br>

<h1 class='red underline'>User Software</h1>

<?php
downloadSection('Keyman 14 for Windows',   'windows',     'keyman-$version.exe', 'stable');
?>

<h3>What's New in Keyman 14 for Windows?</h3>

<ul>
  <li>Renamed from <strong class="red">Keyman Desktop</strong> to <strong class="red">Keyman for Windows</strong></li>
  <li>Updated for latest release of Windows 10</li>
  <li>Keyman keyboards are no longer hidden from the Windows language picker when you exit Keyman. (This helps maintain input method language tag stability.)</li>
  <li>On Screen Keyboard loads much faster</li>
  <li>Added user interface for configuring all Keyman system-level options (#3733)</li>
  <li>Refreshed user interface no longer depends on Internet Explorer (#1720)</li>
  <li>Smoother and more reliable installation of keyboard languages (#3509)</li>
  <li>Choose associated language when keyboard is installed (#3524)</li>
  <li>Much improved keyboard download experience (#3326)</li>
  <li>Improved BCP 47 tag support (#3529)</li>
  <li>Much improved initial download and installation experience including bundled keyboards (#3304)</li>
  <li>Keyman Configuration changes now apply instantly (#3753)</li>
  <li>Improved user experience when many keyboards installed (#3626, #3627)</li>
  <li>Improved bootstrap installer</li>
  <li>Now uses Chromium to host all web-based UI (e.g. Keyman Configuration)</li>
</ul>



<?php
downloadSection('Keyman 14 for macOS',   'mac',     'keyman-$version.dmg', 'stable');
?>

<h3>What's New in Keyman 14 for macOS?</h3>

<ul>
  <li>Added icon for Keyman app (#3892)</li>
  <li>Improved compatibility with Java apps (#3944)</li>
  <li>Added support for European layouts in On Screen Keyboard (#3924)</li>
  <li>Made it possible to specify app compatibility modes as a user default (#3949)</li>
  <li>Improved input reliability with modifier keys and cursor keys (#2588, #3946)</li>
</ul>



<h2 id='linux' class='red underline'>Keyman 14 for Linux</h2>

<h3>What's New in Keyman 14 for Linux?</h3>

<ul>
  <li>Open a .kmp file with Keyman Config (#3183)</li>
  <li>Now supports Ubuntu 20.10 (Groovy) (#3876)</li>
  <li>Improved user interface</li>
  <li>Improved support for KDE, Gnome, Arch Linux</li>
</ul>

<li>Ubuntu, Wasta-Linux: Keyman for Linux can be installed via launchpad:</li>
<blockquote><pre class='language-bash code'><code>sudo add-apt-repository ppa:keymanapp/keyman
sudo apt upgrade
sudo apt install keyman onboard-keyman</code></pre></blockquote>


<?php
downloadSection('Keyman 14 for Android', 'android', 'keyman-$version.apk', 'stable');
?>

<?= $playstoreTable ?>

<h3>What's new in Keyman 14 for Android?</h3>

<ul>
  <li>Improved UI for installing keyboard packages (#3498)</li>
  <li>
    Select a language during keyboard package installation (#3481)<br>
    <img alt='Select language during keyboard installation' src='select_language.png'>
  </li>
  <li>Added new menu to add languages for an installed keyboard package (#3255)</li>
  <li>Consolidated install menus for installing keyboards (#3245)</li>
  <li>Fix slow input in the embedded browser (#3768)</li>
  <li>Add system globe action to show system keyboards (#3197)</li>
  <li>Improved corrections and predictions (#3555)</li>
  <li>Match user input capital letters when offering suggestions (#3845)</li>
  <li>Update minimum Android SDK to 21 (Android 5.0 Lollipop) (#2993)</li>
  <li>Keyman now works more reliably with WeChat and Telegram (#4254)</li>
  <li>Added new menu to change the display language (#4261)</li>
</ul>

<h2 id='ios' class="red underline">Keyman 14 for iPhone and iPad</h2>

<?= $appstoreTable ?>

<h3>What's new in Keyman 14 for iPhone and iPad?</h3>

<ul>
  <li>Choose associated language(s) when keyboard is installed (#3437)</li>
  <li>Improved batching of keyboard and dictionary downloads (#3458)</li>
  <li>Improved corrections and predictions (#3555)</li>
  <li>Match user input capital letters when offering suggestions (#3845)</li>
  <li>User interface now available in additional languages, including French, German and Khmer</li>
</ul>





<?php
downloadSection('KeymanWeb 14', 'web', 'keymanweb-$version.zip', 'stable');
?>

<h3>What's New in KeymanWeb 14?</h3>

<ul>
  <li>Adds special keys for right-to-left keyboards (#3851, #3937)</li>
  <li>Interaction with explicitly blank / hidden keys is now blocked (#3857, #3858)</li>
  <li>Sourcemap improvements (#2809)</li>
  <li>Fixes issues with keyboard rules involving system stores (#2884)</li>
  <li>Fixes issues with keyboard rules involving both 'notany' and 'context' (#3817)</li>
  <li>The OSK for KeymanWeb, Keyman for Android, and Keyman for iPhone and iPad now load more quickly (#4279)</li>
  <li>Improved OSK handling of large fonts for key text (#4270, #4255)</li>
</ul>



<h1 class='red underline'>Developer Software</h1>

<?php
downloadSection('Keyman Developer 14',    'developer', 'keymandeveloper-$version.exe', 'stable');
?>

<h3>What's new in Keyman Developer 14?</h3>

<ul>
  <li>Improve how casing is handled for lexical-models (#3770)</li>
  <li>Lexical models may now specify the '<code>languageUsesCasing</code>' flag (and, optionally, an '<code>applyCasing()</code>' function).
    These will allow predictive-text suggestions to detect and preserve capitalization when appropriate (#4291, 4299).</li>
  <li>Add support for notany() and context() (#3816)</li>
  <li>Remove IE dependency from Developer setup (#3839)</li>
  <li>New touch layout special key caps *RTLEnter*, *RTLBkSp*, *ZWNJ*, ... (#3878)</li>
  <li>Improved BCP 47 support and script mapping (#3818, #4563)</li>
  <li>Model compiler merges duplicate words and normalizes when compiling (#3338)</li>
  <li>Support ISO9995 key identifiers (e.g. E01) (#2741)</li>
  <li><a href="https://help.keyman.com/developer/language/guide/expansions">Range expansions</a> (#4584)</li>
  <li><a href="https://help.keyman.com/developer/language/reference/casedkeys">&amp;CasedKeys store</a> (#4586)</li>
</ul>

<br>

<h3>Breaking changes for keyboard developers</h3>

<p>We work hard to minimize the potential for breaking changes to Keyman. We sometimes must make a change which may
not be 100% backwardly compatible, either to correct a bug, or to address security issues. The following issues are
known breaking changes in Keyman 14.0:</p>

<ul>
  <li>Web: the element IDs for keys in the OSK, where a modifier does match the display layer, have changed. This may
      impact custom CSS rules for your keyboard. See <a href='https://github.com/keymanapp/keyman/issues/4703'>#4703</a>
      for more details.</li>
  <li>Windows: Keyman Engine no longer supports the keyboard usage page (usage.htm)</li>
  <li>Windows: the bootstrap installer has been sigificantly rewritten. Some install scripts may need to be adjusted.</li>
</ul>

<br>

<h3>Changes for Keyman Engine</h3>

<p><a href='keyman-engine-changes'>Changes for Keyman Engine</a></p>

<h2>Get Involved</h2>
<p>There are many ways you can help: <a href='/about/get-involved'>get involved</a> in the Keyman project now!
</p>
