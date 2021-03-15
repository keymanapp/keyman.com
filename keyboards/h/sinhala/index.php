<?php
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    if(preg_match('/(ipad)|(iphone)|(android)/i',$user_agent)) {
      /* TODO: Fix this broken link */
      header('Location: /helabasa/');
    }
    else {
      header('Location: /sinhala/garp/');
    }
?>