<?php
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    if(preg_match('/(ipad)|(iphone)|(android)/i',$user_agent)) {
      /* TODO: Use a better mobile version */
      header('Location: /basic_kbdsn1/');
    }
    else {
      header('Location: /sinhala/garp/');
    }
?>