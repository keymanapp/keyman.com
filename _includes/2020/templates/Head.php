<?php
  declare(strict_types=1);

  namespace Keyman\Site\com\keyman\templates;

use Keyman\Site\com\keyman\Util;
use Keyman\Site\Common\KeymanHosts;

class Head {
    static function render($fields = []) {
      $fields = (object)$fields;

      if(!isset($fields->title)) {
        $fields->title = 'Keyman | Type to the world in your language';
      }
      if(!isset($fields->language)) {
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
<html lang="<?= $fields->language; ?>">
<head>
  <meta charset="utf-8">
  <?php
  if(KeymanHosts::Instance()->Tier() == KeymanHosts::TIER_STAGING) {
    echo '    <meta name="robots" content="none">';
  }
?>
  <title><?= $fields->title; ?></title>
  <?php
/* Our local CDN version is identical to this file:
  <script
    src="https://browser.sentry-cdn.com/5.28.0/bundle.min.js"
    integrity="sha384-1HcgUzJmxPL9dRnZD2wMIj5+xsJfHS+WR+pT2yJNEldbOr9ESTzgHMQOcsb2yyDl"
    crossorigin="anonymous"
  ></script>*/
  ?>
  <script src="<?= Util::cdn('js/sentry.bundle.5.28.0.min.js'); ?>"></script>
  <script>
    Sentry.init({
      dsn: "https://44d5544d7c45466ba1928b9196faf67e@o1005580.ingest.sentry.io/5983516",
      environment: location.host.match(/\.localhost$/) ? 'development' : location.host.match(/(^|\.)keyman-staging\.com$/) ? 'staging' : 'production',
    });
  </script>
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