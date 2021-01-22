<?php
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    if(preg_match('/(ipad)|(iphone)|(android)/i',$user_agent)) {
      header('Location: /helabasa/');
    }
    else {
      header('Location: /sinhala/garp/');
    }
?>