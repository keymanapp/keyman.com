<?php
  declare(strict_types=1);

  namespace Keyman\Site\com\keyman\templates;

  use Keyman\Site\com\keyman\Util;

  class Body {
    static function render($fields = []) {
      echo '<div class="main">';
      echo '<div id="section2"><div class="wrapper">';
      echo <<<END
    <div id="locale-not-internationalized">This page has not yet been updated for languages other than English. <a href='/about/get-involved'>Help us do this</a></div>
    <div id="locale-not-localized">This page is not yet available in your selected language. <a href='https://translate.keyman.com'>Help us translate this page</a></div>
END;
    }
  }
