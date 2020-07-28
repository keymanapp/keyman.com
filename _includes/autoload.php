<?php
  require_once __DIR__ . '/../vendor/autoload.php';

  spl_autoload_register(function ($class_name) {
    if(preg_match('/^Keyman\\\\Site\\\\com\\\\keyman\\\\(.+)/', $class_name, $matches)) {
      include(__DIR__ . "/2020/{$matches[1]}.php");
    }
  });

  spl_autoload_register(function ($class_name) {
    if(preg_match('/^Keyman\\\\Site\\\\Common\\\\(.+)/', $class_name, $matches)) {
      include(__DIR__ . "/../_common/{$matches[1]}.php");
    }
  });
