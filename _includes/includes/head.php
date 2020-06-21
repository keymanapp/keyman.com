<?php
  require_once('servervars.php');
  if(!isset($_SESSION)) session_start();
  if(!isset($title)){
    $title = 'Keyman | Type to the world in your language';
  }
  if(!isset($favicon)){
    $favicon = cdn("img/favicon.ico");
  }
  if(!isset($css)){
    $css = array(cdn("css/template.css"));
  }
  if(!isset($js)){ $js=array(); }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?php echo $title; ?></title>
  <meta content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" name="viewport">
  <link rel='shortcut icon' href="<?php echo $favicon; ?>">
  <?php foreach($css as $cssFile){ ?>
    <link rel="stylesheet" type="text/css" href="<?php echo $cssFile; ?>">
  <?php } ?>

  <link href='https://fonts.googleapis.com/css?family=Cabin:400,400italic,500,600,700,700italic|Source+Sans+Pro:400,700,900,600,300|Noto+Serif:400' rel='stylesheet' type='text/css'>

<?php
  array_unshift($js, cdn('js/jquery1-11-1.min.js'));
  array_unshift($js, cdn('js/bowser.min.js'));
  array_unshift($js, cdn('js/kmlive.js'));

  foreach($js as $jsFile) {
    echo "<script src='$jsFile'></script>\n";
  }

  require_once('includes/analytics.php');
?>
</head>