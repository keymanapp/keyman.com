<?php
  declare(strict_types=1);

  namespace Keyman\Site\com\keyman\templates;

  use Keyman\Site\com\keyman\Util;

  class AppStore {
    // See also /go/developer/10.0/web.config for another redirect
    public const url = 'https://itunes.apple.com/us/app/keyman/id933676545?ls=1&mt=8';

    static function getButtonImageSrc() {
      return Util::cdn('img/Available_on_the_App_Store_Badge_US-UK_135x40_0824.png');
    }

    static function getTable() {
      $url = self::url;
      $img = self::getButtonImageSrc();
      return <<<END
<table class='app-store-links'>
  <tbody>
    <tr>
      <td>
        <a href="$url" target="itunes_store"><img id="app-store" src="{$img}" alt="Available on the App Store" /></a>
        <a href="$url">Get Keyman for iPhone and iPad</a>
      </td>
    </tr>
  </tbody>
</table>
END;
    }
  }
