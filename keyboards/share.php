<?php
  require_once('includes/template.php');
  require_once('includes/ui/keyboard-details.php');
  require_once('./session.php');
  require_once __DIR__ . '/../_includes/autoload.php';
  use Keyman\Site\Common\KeymanHosts;
  use Keyman\Site\com\keyman\Locale;

  function _m($id, ...$args) {
    return Locale::m('keyboards-share', $id, $args);
  }

  if(!isset($_REQUEST['id'])) {
    header('Location: /keyboards');
    exit;
  }

  $id = clean_id($_REQUEST['id']);
  if(empty($id)) {
    header('Location: /keyboards');
    exit;
  }

  function clean_id($id) {
    return preg_replace('/[^A-Za-z0-9_ .-]/', '', $id);
  }

  function find_keyboard($id) {
    $s = @file_get_contents(KeymanHosts::Instance()->SERVER_api_keyman_com.'/keyboard/'.$id);
    if($s === FALSE) {
      return null;
    }
    return json_decode($s);
  }

  // If we find the keyboard, then we go direct to the
  // download page.
  if(find_keyboard($id)) {
    header("Location: /keyboards/$id");
    exit;
  }

  // Keyboard not found, so let's explain.

  $head_options = [
    'title' => _m("head_title", $id)
  ];

  head($head_options);
?>

<h1><?= _m("h1_sharing_keyboard", $id) ?></h1>

<p><?= _m("line1") ?> <?= _m("line2") ?> <b class='red'><?=$id?></b>, <?= _m("line3") ?></p>

<h2><?= _m("h2_how_to_get") ?></h2>

<p><?= _m("how_to_get_1") ?></p>

<p><?= _m("how_to_get_2") ?> <a href='https://community.software.sil.org/c/keyman'>
<?= _m("keyman_forum") ?></a> <?= _m("how_to_get_3") ?></p>