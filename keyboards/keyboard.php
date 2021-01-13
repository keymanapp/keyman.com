<?php
  require_once('includes/template.php');
  require_once('includes/ui/keyboard-details.php');
  require_once('./session.php');

  if(isset($_REQUEST['legacy'])) {
    $id = find_id_by_legacy(clean_id($_REQUEST['legacy']));
    if(!empty($id)) {
      header("Location: /keyboards/$id");
      exit;
    }
  }

  if(!isset($_REQUEST['id'])) {
    header('Location: /keyboards');
    exit;
  }

  $id = clean_id($_REQUEST['id']);

  $bcp47 = isset($_REQUEST['bcp47']) ? $_REQUEST['bcp47'] : null;

  function clean_id($id) {
    return preg_replace('/[^A-Za-z0-9_ .-]/', '', $id);
  }

  function find_id_by_legacy($legacy) {
    global $KeymanHosts;
    $s = @file_get_contents($KeymanHosts->api_keyman_com.'/search/?q=k:legacy:'.rawurlencode($legacy));
    if($s === FALSE) {
      return null;
    }
    $search = json_decode($s);
    if(!isset($search->keyboards) || sizeof($search->keyboards) == 0) {
      return null;
    }
    return $search->keyboards[0]->id;
  }

  \UI\KeyboardDetails::render_keyboard_details($id, 'stable', false, $bcp47);

?>
