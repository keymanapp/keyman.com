<?php
  declare(strict_types=1);

  namespace Keyman\Site\com\keyman\templates;

use Keyman\Site\com\keyman\Util;
use Keyman\Site\com\keyman\KeymanComSentry;
use Keyman\Site\Common\KeymanHosts;

// *Don't* use autoloader here because of potential side-effects in older pages
require_once _KEYMANCOM_INCLUDES . '/2020/Util.php';
require_once _KEYMANCOM_INCLUDES . '/2020/KeymanComSentry.php';
require_once _KEYMANCOM_COMMON . '/KeymanHosts.php';

class Head {
    static function render($fields = []) {
      $fields = (object)$fields;

      if(!isset($fields->title)) {
        $fields->title = 'Keyman | Type to the world in your language';
      }
      // Fallback to 'en'
      // TODO-I18N-URL-SCHEME: integrate with Locale.php
      $fields->lang = isset($_REQUEST['lang']) ? $_REQUEST['lang'] : 'en';

      if(!isset($fields->favicon)) {
        $fields->favicon = Util::cdn("img/favicon.ico");
      }
      if(!isset($fields->css)) {
        $fields->css = [Util::cdn("css/template.css")];
      }
      if(!isset($fields->js)) {
        $fields->js = [];
      }
      if(!isset($fields->js_i18n_domains)) {
        $fields->js_i18n_domains = [];
      }
?><!DOCTYPE html>
<?php
  if (!empty($fields->lang)) {
    echo "<html lang='$fields->lang'>";
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
    /* Embed json i18n strings for each domain */
    foreach($fields->js_i18n_domains as $domain => $locales) {
      $localization = '';
      foreach($locales as $locale) {
        if($localization != '') $localization .= ",\n";
        $localization .= "{ \"locale\": \"$locale\", \"strings\": " . file_get_contents(_KEYMANCOM_INCLUDES . "/locale/strings/$domain/$locale.json") . "}";
      }
      echo "<script id='i18n_$domain' type='application/json'>[\n$localization\n]</script>\n";
    }

    array_unshift($fields->js,
      Util::cdn('js/jquery1-11-1.min.js'),
      Util::cdn('js/bowser.es5.2.9.0.min.js'),
      Util::cdn('js/kmlive.js')
    );

    foreach($fields->js as $jsFile) {
      $jsFileType = str_ends_with($jsFile, '.mjs') ? "type='module'" : "";
      echo "<script src='$jsFile' $jsFileType></script>\n";
    }
  ?>
</head>

<?php
    }
  }