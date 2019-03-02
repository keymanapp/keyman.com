<?php
  if(isset($_REQUEST['UninstallID']) && isset($_REQUEST['Reason']) && isset($_REQUEST['Token'])){
    // Do stuff here
    $post_data = array();
    $post_data['ID'] = $_REQUEST['UninstallID'];
    $post_data['Reason'] = $_REQUEST['Reason'];
    $post_data['Token'] = $_REQUEST['Token'];
    
    if(isset($_REQUEST['Email'])){
      $post_data['Email'] = $_REQUEST['Email'];
    }
    if(isset($_REQUEST['Name'])){
      $post_data['Name'] = $_REQUEST['Name'];
    }
    if(isset($_REQUEST['Description'])){
      $post_data['Description'] = $_REQUEST['Description'];
    }
    
    $post_items = array();
    foreach ( $post_data as $key => $value) {
      $post_items[] = $key . '=' . $value;
    }
    //create the final string to be posted using implode()
    $post_string = implode ('&', $post_items);
    
    $url = "https://secure.tavultesoft.com/prog/uninstall.php";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,10);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
    curl_setopt($ch, CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
    curl_setopt($ch, CURLOPT_URL, $url );
    $return = curl_exec($ch);
    curl_close($ch);
    
    echo $return;
    //if($return 
    
    //if($post_data['Email'] != ''){
      //echo 'success';
    //}    
    echo 'success';
    return;
  }
  echo 'There was an error processing your feedback!';
?>