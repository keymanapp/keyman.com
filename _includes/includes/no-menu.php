<?php
 if(!isset($device)){
    $device = '';
 }
?>
<body data-device="<?php echo $device; ?>">
    <div id="container">
<?php
  if($showHeader) {
?>
        <div class="header">
            <div id="show-phone-menu-spacer"></div>
            <a id="home-link" href="/"><img id="logo" src="<?php echo cdn("img/logo2.png"); ?>" alt='Keyman Logo' /></a>
            <div id="no-menu-spacer"></div>
            <img id="header-bottom" src="<?php echo cdn("img/headerbar.png"); ?>" alt='Header bottom' />
            <a id="help" href="http://help.keyman.com" target="blank"><p id="keyman-help">Support</p><img src="<?php echo cdn("img/helpIcon.png"); ?>"></a>
        </div>
        <div id="phone-header-spacer"></div>
<?php
  }
?>