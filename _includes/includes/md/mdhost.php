<?php
  require_once _KEYMANCOM_INCLUDES . '/includes/template.php';
  require_once _KEYMANCOM_INCLUDES . '/autoload.php';

  if(!isset($_REQUEST['file'])) {
    die('Require file parameter');
  }

  use \Keyman\Site\Common\MarkdownHost;

  $md = new MarkdownHost($_REQUEST['file']);

  head([
    'title' => $md->PageTitle(),
    'css' => ['template.css','prism.css'],
    'showMenu' => $md->ShowMenu(),
    'description' => $md->PageDescription(),
    'js' => ['prism.js']
  ]);

  echo $md->Content();
