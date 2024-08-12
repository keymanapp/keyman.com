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

  $versionWithHyphens = str_replace('.', '-', $version);
  $versionNumber = $versionWithHyphens . ($tier ? "-$tier" : "-stable");

  $versionTier = $version . ($tier == 'stable' ? "" : "-$tier");



  $versionsData = @json_decode(file_get_contents("https://downloads.keyman.com/api/version/all"));
  if (!$versionsData) {
    die("Failed to retrieve or parse the API data.");
  }

  $versionsList = [];

  foreach ($versionsData as $major => $tierData) {
    foreach ($tierData as $tierName => $versionArray) {
      foreach ($versionArray as $version) {
        $versionsList[] = [
            'version' => $version,
            'tier' => $tierName,
            'major' => $major
        ];
      }
    }
  }

  usort($versionsList, function($a, $b) {
    return version_compare($b['version'], $a['version']);
  });

  $currentVersion = $_REQUEST['version'];
  $index = array_search($currentVersion, array_column($versionsList, 'version'));

  if ($index === false) {
    die("Version parameter is not in the list of versions.");
  }

  $prevVersion = ($index < count($versionsList) - 1) ? $versionsList[$index + 1] : null;
  $nextVersion = ($index > 0) ? $versionsList[$index - 1] : null;

  $prevVersionLink = $prevVersion ? "" . urlencode($prevVersion['version']) : null;
  $nextVersionLink = $nextVersion ? "" . urlencode($nextVersion['version']) : null;

  head([
    'title' =>"Keyman $versionTier Downloads",
    'css' => ['template.css','index.css','app-store-links.css', 'prism.css'],
    'js' => ['prism.js'],
    'showMenu' => true
  ]);
?>

<div class="download-title red underline">
  <h2 class="large">Keyman <?= htmlspecialchars($versionTier) ?> Download</h2>

  <div class="navigation-buttons">
    <?php if ($prevVersionLink): ?>
      <a class="button" href="<?= htmlspecialchars($prevVersionLink) ?>">&lt; <?= htmlspecialchars($prevVersion['version']) ?></a>
    <?php else: ?>
      <span class="button disabled">&lt; No Previous Version</span>
    <?php endif; ?>

    <?php if ($nextVersionLink): ?>
      <a class="button" href="<?= htmlspecialchars($nextVersionLink) ?>"><?= htmlspecialchars($nextVersion['version']) ?> &gt;</a>
    <?php else: ?>
      <span class="button disabled">No Next Version &gt;</span>
    <?php endif; ?>
  </div>
</div>

<?php
  if(empty($versions->android)) {
    echo "<p>Version $currentVersion may be invalid, or may not yet be available.</p>";
    exit;
  }
?>

<a class ="button" href='<?=$KeymanHosts->help_keyman_com?>/version-history/all-versions.php#<?=$versionNumber?>'>View version's history</a>


<?php
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
