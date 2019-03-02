<?php
  require_once('includes/template.php');
  require_once('includes/ui/downloads.php');
  
  // Required
  head([
    'title' =>'Keyman Pre-release Versions',
    'css' => ['template.css','index.css', 'app-store-links.css','prism.css'],
    'showMenu' => true
  ]);           
?>
<script src='<?=cdn('js/clipboard.min.js')?>'></script>
<script src='<?=cdn('js/prism.js')?>'></script>

<h2 class="red underline large">Keyman Pre-release Versions</h2>

<p>
  This page contains links for downloading all pre-release versions of Keyman. The downloads
  are split into two different streams: <b>alpha</b> and <b>beta</b>.
</p>

<p>
  A beta version of Keyman is a version that is nearing full 'stable' release. It will still have 
  bugs, but it will be essentially feature-complete. This version is great for getting the latest
  features if you are willing to risk occasionally running into problems.
</p>

<p>
  An alpha version of Keyman contains the very latest code. Alpha versions are released daily, 
  whenever we have code changes. As such, alpha versions can be very unstable. They may not install,
  or they may go wrong in unpredictable ways. We try not to do break things that badly, of course!
  Installing an alpha version is a great way to get involved in the development of Keyman and test
  the latest and greatest functionality before it makes it to the mainstream!
</p>  

<p>
  If neither of these sound like what you wanted: <a href='/downloads/'>download a stable release version of Keyman</a>.
</p>

<p><a href='<?=$helphost?>/version-history'>Keyman version history</a> (all products)</p>

<?php
  downloadSection('Keyman Desktop for Windows', 'windows', 'keymandesktop-$version.exe', 'beta alpha');
  downloadSection('Keyman for macOS',           'mac',     'keyman-$version.dmg', 'beta alpha');
?>

<h2 id='linux' class='red underline'>Keyman for Linux</h2>
<p>Ubuntu: Keyman for Linux can be installed via <a href='https://launchpad.net/keyman'>launchpad</a>:</p>
<pre class='language-bash code'><code>
sudo add-apt-repository ppa:keymanapp/keyman-daily
sudo apt-get update
sudo apt-get install keyman onboard</code></pre>

<?php
  downloadSection('Keyman for Android',         'android', 'keyman-$version.apk', 'beta alpha');
  //downloadSection('Keyman for iPhone and iPad',    'ios',     'keyman-ios-$version.ipa', 'beta alpha');
?>

<p>You can also <a href="https://play.google.com/apps/testing/com.tavultesoft.kmapro">sign up</a> to access pre-release versions through Google Play.</p>

<h2 id='ios' class='red underline'>Keyman for iPhone and iPad</h2>
<p>Please register for the pre-release versions through the links below for Keyman <a href="https://testflight.apple.com/join/9W4XIoxQ">beta</a> or 
<a href="https://testflight.apple.com/join/vnCV2EiH">alpha</a> pre-releases on your iOS device.  This will grant access to the respective app version
through <a href="https://developer.apple.com/testflight/testers/">Apple's TestFlight app</a>, which facilitates direct installation on iOS devices.</p>
<?= iosTestFlightTable(); ?>

<?php
  downloadSection('KeymanWeb',                     'web',     'keymanweb-$version.zip', 'beta alpha');
?>

<ul>
  <li><a href='https://keymanweb.com/?tier=beta'>KeymanWeb latest beta on keymanweb.com</a></li>
  <li><a href='https://keymanweb.com/?tier=alpha'>KeymanWeb latest alpha on keymanweb.com</a></li>
</ul>

<?php
  downloadSection('Keyman Developer',              'developer', array('keymandeveloper-$version.exe', 'kmcomp-$version.zip'), 'beta alpha');
?>
