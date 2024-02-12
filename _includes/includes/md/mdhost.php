<?php
  require_once('includes/template.php');
  require_once __DIR__ . '/../../autoload.php';

  if(!isset($_REQUEST['file'])) {
    die('Require file parameter');
  }

  use \Keyman\Site\Common\MarkdownHost;

  $md = new MarkdownHost($_REQUEST['file']);

  head([
    'title' => $md->PageTitle(),
    'css' => ['template.css','prism.css'],
    'showMenu' => $md->ShowMenu(),
    'js' => ['prism.js']
  ]);

  echo $md->Content();
