<?php
  // This thunk file exists for IE7 and earlier versions that do not support
  // CORS. It will be slower because of the redirect, so we use CORS when we
  // can and so we can one day hopefully deprecate this. It is used only in
  // the keyboard search (embedded dialog) where we cannot control for IE
  // version and have users with no other option.

  // Because of the limited use case, there is also minimal error checking.

  require_once('includes/servervars.php');

  $q = $_REQUEST['q'];
  echo file_get_contents("{$KeymanHosts->api_keyman_com}/search?q=".urlencode($q));
?>