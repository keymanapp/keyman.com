<?php
  // See also /go/developer/10.0/web.config for another redirect
  $appstore = 'https://itunes.apple.com/us/app/keyman/id933676545?ls=1&mt=8';
  $appstoreTable_cdn = cdn('img/Available_on_the_App_Store_Badge_US-UK_135x40_0824.png');
  $appstoreTable = <<<END
<table class='app-store-links'><tr><td>
  <a href="$appstore" target="itunes_store"><img id="app-store" src="{$appstoreTable_cdn}" alt="Available on the App Store" /></a>
  <a href="$appstore">Get Keyman for iPhone and iPad</a>
</td></tr></table>
END;
?>