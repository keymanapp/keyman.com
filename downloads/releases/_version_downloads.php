<?php
  require_once('includes/template.php');
  require_once('includes/ui/downloads.php');
  require_once('includes/appstore.php');
  require_once('includes/playstore.php');

  if(!isset($_REQUEST['version'])) {
    echo "version parameter is required.";
    exit;
  }

  $version = $_REQUEST['version'];
  if(!preg_match('/^\d+\.\d+\.\d+$/', $version)) {
    echo "Invalid version parameter.";
    exit;
  }

  // POLYFILL for keyman.com which is on an
  // older version of PHP
  if (!function_exists('array_key_first')) {
    function array_key_first(array $arr) {
      foreach($arr as $key => $unused) {
        return $key;
      }
      return NULL;
    }
  }

  // note: we currently ignore the tier parameter

  $versions = @json_decode(file_get_contents("https://downloads.keyman.com/api/version/2.0?targetVersion=$version")); // TODO: use KeymanHosts in the future

  if(empty($versions->android))
    $tier = 'unknown';
  else {
    // test against alpha, beta, stable
    $tier = array_key_first(get_object_vars($versions->android));
  }

  $versionTier = $version . ($tier == 'stable' ? "" : "-$tier");

  // Required
  head([
    'title' =>"Keyman $versionTier Downloads",
    'css' => ['template.css','index.css','app-store-links.css', 'prism.css'],
    'js' => ['prism.js'],
    'showMenu' => true
  ]);
?>
<h2 class="red underline large">Keyman <?= $versionTier ?> Downloads</h2>

<?php
  if(empty($versions->android)) {
    echo "<p>Version $version may be invalid, or may not yet be available.</p>";
    exit;
  }

  downloadSection('Keyman for Windows',         'windows',   ['keyman-$version.exe', 'keymandesktop-$version.exe'], $tier);
  downloadSection('Keyman for macOS',           'mac',     'keyman-$version.dmg', $tier);
  downloadSection('Keyman for Android',         'android', 'keyman-$version.apk', $tier);
?>

<p>Keyman for Android is also available on the Play Store.</p>
<?= $playstoreTable ?>

<h2 id="iOS" class='red underline'>Keyman for iPhone and iPad</h2>
<p>Keyman for iPhone and iPad can be found on the App Store.</p>
<?= $appstoreTable ?>

<h2 id='linux' class='red underline'>Keyman for Linux</h2>

<li>Ubuntu, Wasta-Linux: Keyman for Linux can be installed via launchpad:</li>
<blockquote><pre class='language-bash code'><code>sudo add-apt-repository ppa:keymanapp/keyman
sudo apt-get update
sudo apt-get upgrade
sudo apt-get install keyman ibus-keyman onboard</code></pre></blockquote>

<h2 class='red underline large'>Products for Software Developers</h2>

<?php
  downloadSection('KeymanWeb',                     'web',       'keymanweb-$version.zip',             $tier);
  downloadSection('Keyman Developer',              'developer', 'keymandeveloper-$version.exe',       $tier);
  downloadSection('Keyman Engine for Android',     'android',   'keyman-engine-android-$version.zip', $tier, 'android-engine');
  downloadSection('Keyman Engine for iOS',         'ios',       'keyman-engine-ios-$version.zip',     $tier, 'ios-engine');
?>

<br/>
