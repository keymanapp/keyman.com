<?php
  declare(strict_types=1);

  namespace Keyman\Site\com\keyman\templates;

  class PlayStore {
    // See also /go/developer/10.0/web.config for another redirect

    public const url = 'https://play.google.com/store/apps/details?id=com.tavultesoft.kmapro';

    static function getButtonImageSrc() {
      return "https://developer.android.com/images/brand/en_app_rgb_wo_60.png";
    }

    static function getTable() {
      $url = self::url;
      $img = self::getButtonImageSrc();
      return <<<END
<table class='app-store-links'>
  <tbody>
    <tr>
      <td>
        <a href="$url" target="play_store"><img id="app-store" src="{$img}" alt="Android app on Google Play"></a>
        <a href="$url">Get Keyman for Android</a>
      </td>
    </tr>
  </tbody>
</table>
END;
    }
  }
