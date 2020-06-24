<?php
  spl_autoload_register(function ($class_name) {
    if(preg_match('/^Keyman\\\\Site\\\\com\\\\keyman\\\\(.+)/', $class_name, $matches)) {
      include(__DIR__ . "/2020/" . $matches[1] . ".php");
    }
  });
