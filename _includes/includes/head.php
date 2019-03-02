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
  <script>
    function isIEOnWin81orEarlier() {
      // If we are running IE11/or earlier on Windows 8.1 or earlier, then
      // the autolink generates filenames that are misrecognised for download links,
      // meaning users on those browesrs cannot easily download Keyman.
      // Easiest way to test this is to test against navigator.userAgent
      // Yes, we get some muddled analytics of cross-site of IE visitors but 
      // it's a small enough percentage that we don't need to worry about it.
      return (navigator.userAgent.indexOf('Trident/') >= 0 && navigator.userAgent.indexOf('Windows NT 6') >= 0) || 
             (document.documentMode < 11);
    }
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-249828-1',  'auto', {'allowLinker': !isIEOnWin81orEarlier()});
    if(!isIEOnWin81orEarlier()) { 
      ga('require', 'linker');
      ga('linker:autoLink', 
        ['keyman.com', 'www.keyman.com', 
         'keymanweb.com', 'www.keymanweb.com', 
         'help.keyman.com', 
         'blog.keyman.com',
        'www.tavultesoft.com', 'tavultesoft.com', 'secure.tavultesoft.com'] );
    }
    ga('send', 'pageview');
  </script>
</head>