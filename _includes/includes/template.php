<?php
  require __DIR__ . '/../../vendor/autoload.php';
  Sentry\init(['dsn' => 'https://44d5544d7c45466ba1928b9196faf67e@sentry.keyman.com/3' ]);

  require_once('servervars.php');
  
  function template_finish($foot) {
    //ob_end_flush();
    
    if($foot == true){
      foot();
    }
  }

  function head($args=[]){
    // Args are title='My Page Title', css='page.css' showMenu=true/false, showHeader=true/false, foot=true/false
    
    // Get device
    if (strstr($_SERVER['HTTP_USER_AGENT'],'Windows')) {
        $device = 'Windows';
    }elseif(strstr($_SERVER['HTTP_USER_AGENT'],'Macintosh')){
        $device = 'mac';        
    }elseif(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone')){
        $device = 'iPhone';
    }elseif(strstr($_SERVER['HTTP_USER_AGENT'],'iPad')){
        $device = 'iPad';
    }elseif(strstr($_SERVER['HTTP_USER_AGENT'],'Android')){
        $device = 'Android';
    }elseif(strstr($_SERVER['HTTP_USER_AGENT'],'Linux')){
        $device = 'Linux';
    }else{
        $device = 'Unknown';
    }
    
    global $pageDevice, $pageClass;
    $pageDevice = $device;
    
    if(isset($args['class'])){
      $pageClass = $args['class'];
    } else {
      $pageClass = 'default';
    }
    
    if(isset($args['title'])){
        $title = $args['title'];
    }else{
        $title = 'Keyman | Type to the world in your language';
    }
    if(isset($args['css'])){
      $css = array();
      foreach($args['css'] as $cssFile){
        $file = cdn("css/$cssFile");
        $css[] = $file;
      }
    }else{
        $css = array(cdn('css/template.css'));
    }
    if(isset($args['js'])){
      $js = array();
      foreach($args['js'] as $jsFile){
        $file = cdn("js/$jsFile");
        $js[] = $file;
      }
    }
    if(isset($args['showMenu'])){
        $menu = $args['showMenu'];
    }else{
        $menu = true;
    }
    if(isset($args['robots'])){
      $robots = $args['robots'];
    }else{
      $robots = true;
    }
    $favicon = cdn("img/favicon.ico");
    if(isset($args['showHeader'])){
      $showHeader = $args['showHeader'];
    } else {
      $showHeader = true;
    }
    require_once('head.php');
    if($menu == true) {
        require_once ('phone-menu.php');
        require_once('top-menu.php');
    } else {
        require_once ('no-menu.php');
    }
    
    if(isset($args['banner'])) {
      banner($args['banner']);
    }
    
    $foot = isset($args['foot']) ? $args['foot'] : true;
    $addSection2 = !isset($args['addSection2']) || $args['addSection2'];
    $shutdown = 'template_finish';
    register_shutdown_function($shutdown,$foot);
    
    begin_main($addSection2);
  }
  
  function banner
  ($args=[]){
    // Args are title='Keyman for Android', button='<a><img /></a>', image='android-splash.png', background='water';
    
    if(isset($args['title'])){
      $title = $args['title'];
    }else{
      $title = '';
    }
    if(isset($args['button'])){
      // Regex to see if image is from CDN
      $pattern = '/src="cdn([^"]*)"/i';
      if(preg_match( $pattern, $args['button'], $matches )) {
        $src = $matches[1];
        $src = substr($src,1,-1);
        $src = 'src="'.cdn("img/".$src).'"';
        $button = preg_replace($pattern, $src, $args['button']);
      }else{
        $button = $args['button'];
      }
      $button = '<br/>'.$button;
    }else{
      $button = '';
    }
    if(isset($args['image'])){
      $img = $args['image'];
    }else{
      $img = '';
    }
    if(isset($args['background'])){
      $bg = $args['background'];
    }else{
      $bg = 'water';
    }
    $title = '<h1>'.$title.'</h1>'.$button;
    $img = cdn("img/".$img);
    $img = '<img src="'.$img.'" />';
    $bg = 'section1-bg'.$bg;
    require_once('banner.php');
  }
  
  function begin_main($addSection2){
    echo '<div class="main">';
    if($addSection2) echo '<div id="section2"><div class="wrapper">';
  }
  
  function foot($args=[]){
    // Args are display=true/false;
    
    if(isset($args['display'])){
      $display = $args['display'];
    }else{
      $display = true;
    }
    if($display == true){
      require_once('footer.php');
    }else{
      require_once('no-footer.php');
    }
  }

