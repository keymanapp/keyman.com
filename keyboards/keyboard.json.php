<?php
  require_once('includes/servervars.php');
  require_once __DIR__ . '/../_includes/autoload.php';
  use Keyman\Site\Common\KeymanHosts;

  if(!isset($_REQUEST['id'])) {
    header('HTTP/1.0 404 id parameter is required');
    exit;
  }

  $id = $_REQUEST['id'];
  $version = $stable_version;

  header('Content-Type: application/json; charset=utf-8');
  header('Access-Control-Allow-Origin: *');

  $kmw = @file_get_contents("{$KeymanHosts->api_keyman_com}/cloud/4.0/keyboards/$id?version=$version&languageidtype=bcp47");
  if($kmw === FALSE) {
    header('HTTP/1.0 404 Keyboard not found');
    exit;
  }

  header('Link: <' . KeymanHosts::Instance()->api_keyman_com . '/schemas/keyboard_json.json#>; rel="describedby"');

  $kmw = json_decode($kmw);

  $result = array(
    'options' => array(
      'device' => 'any',
      'keyboardBaseUri' => $kmw->options->keyboardBaseUri,
      'fontBaseUri' => $kmw->options->fontBaseUri
    )
  );

  $resultKeyboard = array(
    'id' => $id,
    'name' => $kmw->keyboard->name,
    'filename' => $kmw->keyboard->filename,
    'version' => $kmw->keyboard->version,
    'lastModified' => fullISODate($kmw->keyboard->lastModified)
  );

  function fullISODate($date) {
    if(strlen($date) == 10) {
      return $date."T00:00:00+00:00";
    } else {
      return $date;
    }
  }

  if(isset($kmw->keyboard->languages) && count($kmw->keyboard->languages) > 0) {
    $l = $kmw->keyboard->languages[0];
    $lang = array('id' => $l->id, 'name' => $l->name);
    if(isset($l->font)) {
      $resultKeyboard['font'] = $l->font;
    }
    if(isset($l->oskFont)) {
      $resultKeyboard['oskFont'] = $l->oskFont;
    }
  } else {
    $lang = array('id' => 'en', 'name' => 'English');
  }
  $resultKeyboard['languages'] = array($lang);
  if(isset($kmw->keyboard->rtl)) {
    $resultKeyboard['rtl'] = $kmw->keyboard->rtl;
  }
  $result['keyboard'] = $resultKeyboard;

  echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
?>