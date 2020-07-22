<?php
  require_once __DIR__ . '/../_includes/autoload.php';
  use Keyman\Site\com\keyman\KeymanHosts;
  header('Location: '.KeymanHosts::Instance()->help_keyman_com);
?>