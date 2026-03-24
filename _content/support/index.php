<?php
  require_once _KEYMANCOM_INCLUDES . '/autoload.php';
  use Keyman\Site\Common\KeymanHosts;
  header('Location: '.KeymanHosts::Instance()->help_keyman_com);
?>