<?php
  $keyboard = $_POST['Keyboard'];
  $email = $_POST['Email'];
  $token = '_keyman_com_internal_12_06_2014';
  $params = array('Keyboard' => $keyboard, 'Email' => $email, 'Token' => $token);
  $query = http_build_query($params);
  $contextData = array (
    'method' => 'POST',
    'header' => "Connection: close\r\n"."Content-Length: ".strlen($query)."\r\n",
    'content'=> $query
  );
  $context = stream_context_create (array ( 'http' => $contextData ));
  $result =  file_get_contents (
    'http://testsite.tavultesoft.local/prog/logdownload.php',
    false,
    $context
  );
  echo $result;
?>