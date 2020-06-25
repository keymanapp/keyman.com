<?php
  declare(strict_types=1);

  namespace Keyman\Site\com\keyman\templates;

  use Keyman\Site\com\keyman\Util;

  class Head {
    static function render($fields = []) {
      $fields = (object)$fields;

      if(!isset($fields->title)) {
        $fields->title = 'Keyman | Type to the world in your language';
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
<html>
<head>
  <meta charset="utf-8">
  <title><?= $fields->title; ?></title>
  <meta content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" name="viewport">
  <link rel='shortcut icon' href="<?= $fields->favicon; ?>">
  <?php foreach($fields->css as $cssFile) { ?>
    <link rel="stylesheet" type="text/css" href="<?= $cssFile; ?>">
  <?php } ?>

  <link href='https://fonts.googleapis.com/css?family=Cabin:400,400italic,500,600,700,700italic|Source+Sans+Pro:400,700,900,600,300|Noto+Serif:400' rel='stylesheet' type='text/css'>

  <?php
    array_unshift($fields->js,
      Util::cdn('js/jquery1-11-1.min.js'),
      Util::cdn('js/bowser.min.js'),
      Util::cdn('js/kmlive.js')
    );

    foreach($fields->js as $jsFile) { ?>
    <script src='<?=$jsFile?>'></script>
  <?php } ?>
  <?php require_once('includes/analytics.php'); // TODO: refactor to a class include ?>
</head>

<?php
    }
  }