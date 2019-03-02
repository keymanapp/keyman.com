<?php
  if(!isset($_POST['projectId']) || !isset($_POST['description']) || !isset($_POST['page'])) {
    echo "Invalid parameters.";
    exit;
  }
  
  ini_set('SMTP', 'mail.tavultesoft.com');
  
  $project = $_POST['projectId'];
  //$issueType = 4; 
  $description = $_POST['description'];
  //$summary = explode('.',$description) ;
  //$summary = $summary[0];
  $page = $_POST['page'];
  if(isset($_POST['email'])) $email = $_POST['email']; else $email = 'marc@keyman.com';
  
  mail('marc@keyman.com', 'Page Feedback: '.$page, <<<END
Page Feedback for $page

Email: $email

Description: 

$description
END
    , 'From: '.$email);
  
  if($email != 'marc@keyman.com') {
    echo "Thank you for your feedback.  Your message has been sent through to our support team.";
  } else {
    echo "Thank you for your feedback.";
  }
?>