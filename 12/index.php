<?php
  require_once('includes/template.php');
  require_once('includes/ui/downloads.php');
  require_once('includes/appstore.php');
  require_once('includes/playstore.php');

  // Required
  head([
    'class' => 'keyman11',
    'title' => 'Keyman 12 is in beta!',
    'css' => ['template.css', 'dev.css', 'app-store-links.css', 'prism.css'],
    'js' => ['prism.js'],
    'showMenu' => true,
    'banner' => [
        'title' => 'Keyman 12.0 Beta',
        'image' => 'world.png',
        'background' => 'water'
    ]
]);
?>

<h2>Announcing the release of Keyman 12.0 Beta</h2>
<p class="red">7 August 2019</p>
<p>We are pleased to announce that Keyman 12.0 is now in beta!</p>
<br>

<h3>What's New?</h3>

<ul>
  <li>Predictive Text for Android and iOS</li>
</ul>
<br>

<h3>What's Next?</h3>
<ul>
  <li>Check the <a href="https://blog.keyman.com/2019/02/keyman-roadmap-february-2019/">Keyman Roadmap</a> for upcoming features.
</ul>
<br>

<h3>12.0 Beta Feedback</h3>
<ul>
  <li>Please send feedback about Keyman 12 to the
  <a href="https://community.software.sil.org/c/keyman">Keyman Community site</a> or submit bugs and feature requests to
  our <a href="https://github.com/keymanapp/keyman/issues/new/choose">Issue Tracker</a>.</li>
</ul>
<br>

<h1 class='red underline'>User Software</h1>

<?php
  downloadSection('Keyman for Android 12', 'android', 'keyman-$version.apk', 'beta');
?>

<p>You can also <a href="https://play.google.com/apps/testing/com.tavultesoft.kmapro">sign up</a> to access pre-release versions through Google Play.</p>

<h3>What's new in Keyman for Android 12?</h3>

<ul>
  <li>Predictive Text support</li>
  <li>New "Settings" menu</li>
  <li>Improved stability for app startup and loading keyboards</li>
  <li>Minimum supported version is now Android 4.4 (KitKat)</li>
</ul>

<h2 class="red underline">Keyman for iPhone and iPad 12</h2>
<h3>Beta</h3>
<p>Please register for the pre-release versions through the links below for Keyman <a href="https://testflight.apple.com/join/9W4XIoxQ">beta</a> 
pre-releases on your iOS device.  This will grant access to the app through <a href="https://developer.apple.com/testflight/testers/">Apple's 
TestFlight app</a>, which facilitates direct installation on iOS devices.</p>

<?= iosTestFlightTable(); ?>

<h3>What's new in Keyman for iPhone and iPad 12?</h3>

<ul>
  <li>Predictive Text support</li>
  <li>New "Settings" menu</li>
  <li>Installing a multilingual keyboard now only adds the first language by default</li>
  <li>Fix issue with LTR and RTL marks breaking Keyman context checks</li>
</ul>


<?php
  downloadSection('Keyman Desktop 12',   'windows',     'keymandesktop-$version.exe', 'beta');
?>

<h3>What's New in Keyman Desktop 12 for Windows?</h3>

<ul>
  <li>No significant changes</li>
</ul>



<?php
  downloadSection('Keyman 12 for macOS',   'mac',     'keyman-$version.dmg', 'beta');
?>

<h3>What's New in Keyman 12 for macOS?</h3>

<ul>
  <li>No significant changes</li>
</ul>



<h2 id='linux' class='red underline'>Keyman 12 for Linux</h2>

<h3>What's New in Keyman 12 for Linux?</h3>

<ul>
  <li>No significant changes</li>
</ul>

<li>Ubuntu, Wasta-Linux: Keyman for Linux can be installed via launchpad:</li>
<blockquote><pre class='language-bash code'><code>sudo add-apt-repository ppa:keymanapp/keyman
sudo apt-get update
sudo apt-get upgrade
sudo apt-get install keyman onboard</code></pre></blockquote>




<?php
  downloadSection('KeymanWeb 12', 'web', 'keymanweb-$version.zip', 'beta');
?>

<h3>What's New in KeymanWeb 12?</h3>

<ul>
<li>New Features:
<ul>
<li>Began adding support for our common LMLayer interface for predictive modeling.</li>
<li>Implemented WebWorker background thread for the heavy lifting; all API calls with relevant return values return Promises.</li>
<li>Provides API for the following language-modeling functions:
<ul>
<li>predict - Prediction of user's desired word based on context and recent input</li>
<li>Also returns a tagged prediction corresponding to the original context state.</li>
<li>Corrections are currently limited to the most recent input keystroke.</li>
<li>Accepts a probability distribution for the most recent keystroke, which is be used to weight prediction probabilities</li>
<li>wordbreak - Performs wordbreaking on the current context state</li>
<li>A default wordbreaker based on the Unicode specification is provided as a default.</li>
</ul></li>
<li>Implements a common "template" for weighted wordlist lexical model functionality:
<ul>
<li>Accepts a "search term to key" function to facilitate common corrections, such as diacritics,
during prediction lookups.</li>
<li>Predictions are weighted based on their frequency and their input likelihood (based on keystroke probabilities).</li>
</ul></li>
<li>Accepts fully-specified custom lexical models that do not rely on model "templates."</li>
</ul>
</li>
<li>Changes:
<ul>
<li>Resumed TypeScript conversion work, resulting in significant internal restructuring and reorganization while leaving our published API intact.</li>
<li>Mobile web "touch alias" elements have been refactored into their own type.</li>
<li>Heavily reorganizes and refactors the keystroke processing engine of KMW.
<ul>
<li>Attachment to all supported element types has now been abstracted, splitting keystroke processing from related DOM management.</li>
<li>Centralizes code paths to improve parity between hardware and OSK-based keystrokes.</li>
</ul></li>
<li>In both cases above, significant unit testing was facilitated and has been added as a result, further improving code maintainability into the future.</li>
</ul></li>
</ul>




<h1 class='red underline'>Developer Software</h1>

<?php
  downloadSection('Keyman Developer 12',    'developer', 'keymandeveloper-$version.exe', 'beta');
?>

<h3>What's new in Keyman Developer 12?</h3>

<ul>
  <li>Lexical model "predictive text" compiler (not yet integrated into GUI)</li>
  <li>KMAnalyze keyboard source analysis tool</li>
</ul>