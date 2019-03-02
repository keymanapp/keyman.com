<?php
  // See also /go/developer/10.0/web.config for another redirect
  $playstore = "https://play.google.com/store/apps/details?id=com.tavultesoft.kmapro";
  $playstoreTable = <<<END
<table class='app-store-links'><tr><td>
  <a href="$playstore" target="itunes_store"><img id="app-store" src="https://developer.android.com/images/brand/en_app_rgb_wo_60.png" alt="Android app on Google Play"></a>
  <a href="$playstore">Get Keyman for Android</a>
</td></tr></table>
END;
?>