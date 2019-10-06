<?php
  global $loadJQueryEarly;
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
  if(!isset($robots)){
    $robots = true;
  }
  if(!isset($js)){ $js=array(); }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?php echo $title; ?></title>
  <?php if($robots == false){ ?>
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <?php } ?>
  <meta content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" name="viewport">
  <link rel='shortcut icon' href="<?php echo $favicon; ?>">
  <?php foreach($css as $cssFile){ ?>
    <link rel="stylesheet" type="text/css" href="<?php echo $cssFile; ?>">
  <?php } ?>

  <link href='https://fonts.googleapis.com/css?family=Cabin:400,400italic,500,600,700,700italic|Source+Sans+Pro:400,700,900,600,300|Noto+Serif:400' rel='stylesheet' type='text/css'>

	<script type="text/javascript">

	 // Add a script element as a child of the body

	 function downloadJS(src) {
		 var element = document.createElement("script");
		 element.src = src;
		 (document.body ? document.body : document.head) .appendChild(element);
	 }

	 function downloadJSAtOnload() {
		downloadJS("<?php echo cdn("js/jquery1-11-1.min.js"); ?>");
		downloadJS("<?php echo cdn("js/bowser.min.js"); ?>");
		downloadJS("<?php echo cdn("js/kmlive.js"); ?>");
		<?php foreach($js as $jsFile){ ?>
		  downloadJS("<?php echo $jsFile; ?>");
		<?php } ?>
	 }

<?php
  echo empty($loadJQueryEarly) ?
    "window.addEventListener ? window.addEventListener('load', downloadJSAtOnload) : window.attachEvent('onload', downloadJSAtOnload);" :
    "downloadJSAtOnload()";
?>
  </script>
  <?php require_once('includes/analytics.php'); ?>
</head>