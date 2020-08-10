<?php

  require_once __DIR__ . '/../../autoload.php';
  use Keyman\Site\Common\KeymanHosts;

  $versions = @json_decode(file_get_contents(KeymanHosts::Instance()->downloads_keyman_com . '/api/version/2.0'));
  //if($versions === NULL || $versions === FALSE) {
  //  echo "<p class='error'>WARNING: unable to retrieve latest versions of Keyman from download server</p>";
  //}

  function formatSizeUnits($bytes) {
    if ($bytes >= 1073741824) {
      $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
      $bytes = number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
      $bytes = number_format($bytes / 1024, 2) . ' KB';
    } elseif ($bytes > 1) {
      $bytes = $bytes . ' bytes';
    } elseif ($bytes == 1) {
      $bytes = $bytes . ' byte';
    } else {
      $bytes = '0 bytes';
    }

    return $bytes;
  }

  function downloadSection($product, $platform, $filepattern, $tiers = '', $target = '') {
    if($target == '') $target = $platform;

    echo "<h2 id='$target' class='red underline'>$product</h2>\n\n";
    $tiers = explode(' ',$tiers);
    foreach($tiers as $tier) {
      echo downloadLinks($product, $platform, $tier, $filepattern);
    }
  }

  function downloadLinks($product, $platform, $tier, $filepatterns) {
    global $versions;
    $tierTitle = ucFirst($tier);
    echo "<h3>$tierTitle</h3>\n";
    echo "<ul>\n";
    if(!empty($versions->$platform->$tier)) {
      if(!is_array($filepatterns)) $filepatterns = array($filepatterns);
      foreach($filepatterns as $filepattern) {
        $file = str_replace('$version', $versions->$platform->$tier->version, $filepattern);
        $file = str_replace('$tier', $tier, $file);

        if(!empty($versions->$platform->$tier->files->$file)) {
          $fileData = $versions->$platform->$tier->files->$file;
          $fileSize = formatSizeUnits($fileData->size);
          echo "<li><a href=" . KeymanHosts::Instance()->downloads_keyman_com . "/$platform/$tier/{$versions->$platform->$tier->version}/$file'>$file $tier</a> (released $fileData->date, $fileSize)</li>\n";
        }
      }
    }
    echo "<li><a href='" . KeymanHosts::Instance()->downloads_keyman_com . "/$platform/$tier/'>All $product $tier releases</a></li>\n";
    echo "</ul><br/>\n";
  }

  function downloadLargeCTA($product, $platform, $tier, $filepattern) {
    global $versions;

    if(empty($versions)) return;
    $file = str_replace('$version', $versions->$platform->$tier->version, $filepattern);
    $file = str_replace('$tier', $tier, $file);

    if(empty($versions->$platform->$tier->files->$file)) {
      echo "<p>No downloads found for $product.</p>";
      return false;
    }

    $fileData = $versions->$platform->$tier->files->$file;
    $fileSize = formatSizeUnits($fileData->size);
    $host = KeymanHosts::Instance()->downloads_keyman_com;

    echo <<<END
<div class="download-cta-big selected" id="cta-big-Windows" data-url='$host/$platform/$tier/{$versions->$platform->$tier->version}/$file' data-version='{$versions->$platform->$tier->version}'>
    <div class="download-stable-email">
    <h3>$product {$versions->$platform->$tier->version}</h3>
    <p>Released: {$fileData->date}</p>
    <p>Size: $fileSize</p>
    </div>
    <div class="download-cta-button">
      <h4>Download Now</h4>
    </div>
    <div class="download-cta-base"></div>
</div>
END;
  }

  function iosTestflightTable() {
    $testflight = 'https://itunes.apple.com/us/app/testflight/id899247664?mt=8';
    $testflight_beta_signup = 'https://testflight.apple.com/join/9W4XIoxQ';
    $testflight_alpha_signup = 'https://testflight.apple.com/join/vnCV2EiH';
    $testflightTable_cdn = cdn('img/testflight-64x64.png');
    $testflight_about = 'https://developer.apple.com/testflight/testers/';
    $testflightTable = <<<END
<table class='app-store-links'><tr><td>
  <a href="$testflight_about" target="itunes_store">Available through TestFlight</a>
  <a href="$testflight" target="itunes_store"><img id="app-store" src="{$testflightTable_cdn}" alt="TestFlight app in the App Store" /></a>
  <a href="$testflight_beta_signup">Sign up here for beta-only Keyman access.</a>
  <a href="$testflight_alpha_signup">Sign up for here alpha-only Keyman access.</a>
</td></tr></table>
END;
    return $testflightTable;
  }
?>