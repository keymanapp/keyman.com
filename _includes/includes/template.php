<?php
  require_once('servervars.php');

  // *Don't* use autoloader here because of potential side-effects in older pages
  require_once(__DIR__ . '/../2020/Util.php');
  require_once(__DIR__ . '/../2020/KeymanVersion.php');
  require_once(__DIR__ . '/../2020/templates/Head.php');

  function template_finish($foot) {
    //ob_end_flush();

    if($foot == true){
      foot();
    }
  }

  function head($args=[]){
    // Args are title='My Page Title', css='page.css' showMenu=true/false, showHeader=true/false, foot=true/false, keywords='comma,separated,list'

    $agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
    // Get device
    if (strstr($agent,'Windows')) {
        $device = 'Windows';
    }elseif(strstr($agent,'Macintosh')){
        $device = 'mac';
    }elseif(strstr($agent,'iPhone')){
        $device = 'iPhone';
    }elseif(strstr($agent,'iPad')){
        $device = 'iPad';
    }elseif(strstr($agent,'Android')){
        $device = 'Android';
    }elseif(strstr($agent,'Linux')){
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
    if(isset($args['description'])) {
      $description = $args['description'];
    }
    if(isset($args['language'])) {
      $language = $args['language'];
    }
    if(isset($args['keywords'])) {
      $keywords = $args['keywords'];
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
    $favicon = cdn("img/favicon.ico");
    if(isset($args['showHeader'])){
      $showHeader = $args['showHeader'];
    } else {
      $showHeader = true;
    }

    // This avoids the global variable plague of earlier templates!
    $head = [];
    if(isset($title)) $head['title'] = $title;
    if(isset($description)) $head['description'] = $description;
    if(isset($favicon)) $head['favicon'] = $favicon;
    if(isset($language)) $head['language'] = $language;
    if(isset($css)) $head['css'] = $css;
    if(isset($js)) $head['js'] = $js;
    if(isset($keywords)) $head['keywords'] = $keywords;
    \Keyman\Site\com\keyman\templates\Head::render($head);

    if($menu == true) {
      require_once(__DIR__ . '/../2020/templates/Menu.php');
      \Keyman\Site\com\keyman\templates\Menu::render([
        'pageClass' => $pageClass,
        'device' => (isset($device) ? $device : '')
      ]);
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
      require_once(__DIR__ . '/../2020/templates/Foot.php');
      \Keyman\Site\com\keyman\templates\Foot::render();
    }else{
      require_once('no-footer.php');
    }
  }

