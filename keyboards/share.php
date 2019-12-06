<?php
  require_once('includes/template.php');
  require_once('includes/ui/keyboard-details.php');
  require_once('./session.php');

  if(!isset($_REQUEST['id'])) {
    header('Location: /keyboards');
    exit;
  }

  $id = clean_id($_REQUEST['id']);

  function clean_id($id) {
    return preg_replace('/[^A-Za-z0-9_ .-]/', '', $id);
  }

  function find_keyboard($id) {
    global $apihost;
    $s = @file_get_contents($apihost.'/keyboard/'.$id);
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
    'title' => "Share Keyboard: $id"
  ];

  head($head_options);
?>

<h1>Sharing keyboard <?= $id ?></h1>

<p>You probably arrived here by scanning a QRCode or opening a link
to share a keyboard from the Keyman app. We are sorry, but unfortunately,
the keyboard you are interested in, called <b class='red'><?=$id?></b>, is not currently available from the
Keyman keyboards repository.</p>

<h2>How you can get this keyboard</h2>

<p>This keyboard has been distributed peer-to-peer rather than through
the Keyman keyboards repository, so the best way to access the keyboard
is to ask the person who shared this link or QRCode with you.</p>

<p>If you cannot locate the person who shared the keyboard with you,
please do feel free to ask on the <a href='https://community.software.sil.org/c/keyman'>
Keyman Community Forum</a> for assistance in locating the keyboard or
a suitable alternative.</p>