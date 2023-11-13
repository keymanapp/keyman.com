<?php
    $env = getenv();
    $agent = isset($env['HTTP_USER_AGENT']) ? $env['HTTP_USER_AGENT'] : '';
    if(preg_match('/(ipad)|(iphone)|(android)/i',$agent)) {
      /* TODO: Use a better mobile version */
      header('Location: /basic_kbdsn1/');
    }
    else {
      header('Location: /sinhala/garp/');
    }
?>