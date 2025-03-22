<?php
  declare(strict_types=1);

  namespace Keyman\Site\com\keyman\templates;

use Keyman\Site\com\keyman\Util;
use Keyman\Site\com\keyman\KeymanComSentry;
use Keyman\Site\Common\KeymanHosts;

// *Don't* use autoloader here because of potential side-effects in older pages
require_once(__DIR__ . '/../Util.php');
require_once(__DIR__ . '/../KeymanComSentry.php');
require_once(__DIR__ . '/../../../_common/KeymanHosts.php');

class Head {
    static function render($fields = []) {
      $fields = (object)$fields;

      if(!isset($fields->title)) {
        $fields->title = 'Keyman | Type to the world in your language';
      }
      if(empty($fields->language)) {
        $fields->language = 'en'; // Default to English
      }
      if(!isset($fields->favicon)) {
        $fields->favicon = Util::cdn("img/favicon.ico");
      }
      if(!isset($fields->css)) {
        $fields->css = [Util::cdn("css/template.css")];
      }
      if(!isset($fields->js)) {
        $fields->js = [];
      }
?><!DOCTYPE html>
<?php
  if (!empty($fields->language)) {
    echo "<html lang='$fields->language'>";
  } else {
    echo "<html>";
  }
?>
<head>
  <meta charset="utf-8">
  <?php
  if(isset($fields->description) && !empty($fields->description)) {
    echo "<meta name='description' content='" . $fields->description . "'>\n";
  }
  if(KeymanHosts::Instance()->Tier() == KeymanHosts::TIER_STAGING) {
    echo '    <meta name="robots" content="none">';
  }
  if(isset($fields->keywords) && !empty($fields->keywords)) {
    $keywords = htmlspecialchars($fields->keywords, ENT_QUOTES, "UTF-8");
    echo "<meta name=\"keywords\" content=\"" . $keywords . "\" />\n";
  }
?>
  <title><?= $fields->title; ?></title>
  <?= KeymanComSentry::GetBrowserHtml(); ?>
  <meta content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" name="viewport">
  <link rel='shortcut icon' href="<?= $fields->favicon; ?>">
  <?php foreach($fields->css as $cssFile) { ?>
    <link rel="stylesheet" type="text/css" href="<?= $cssFile; ?>">
  <?php } ?>

  <link href='https://fonts.googleapis.com/css?family=Cabin:400,400italic,500,600,700,700italic|Source+Sans+Pro:400,700,900,600,300|Noto+Serif:400' rel='stylesheet' type='text/css'>

  <?php
    array_unshift($fields->js,
      Util::cdn('js/jquery1-11-1.min.js'),
      Util::cdn('js/bowser.es5.2.9.0.min.js'),
      Util::cdn('js/kmlive.js')
    );

    foreach($fields->js as $jsFile) { ?>
    <script src='<?=$jsFile?>'></script>
  <?php } ?>
</head>

<?php
    }
  }
