<?php
  require_once('includes/template.php');
  require_once('includes/ui/legacy-keyboard-details.php');
  require_once('./session.php');

  if(isset($_REQUEST['legacy'])) {
    $id = find_id_by_legacy(clean_id($_REQUEST['legacy']));
    if(!empty($id)) {
      header("Location: /_legacy/keyboards/$id");
      exit;
    }
  }

  if(!isset($_REQUEST['id'])) {
    header('Location: /_legacy/keyboards');
    exit;
  }

  $id = clean_id($_REQUEST['id']);

  function clean_id($id) {
    return preg_replace('/[^A-Za-z0-9_ .-]/', '', $id);
  }

  function find_id_by_legacy($legacy) {
    global $apihost;
    $s = @file_get_contents($apihost.'/search/?q=k:legacy:'.rawurlencode($legacy));
    if($s === FALSE) {
      return null;
    }
    $search = json_decode($s);
    if(!isset($search->keyboards) || sizeof($search->keyboards) == 0) {
      return null;
    }
    return $search->keyboards[0]->id;
  }

  \UI\KeyboardDetails::render_keyboard_details($id);

?>
