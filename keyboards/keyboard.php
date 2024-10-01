<?php
  require_once('includes/template.php');
  require_once('includes/ui/keyboard-details.php');
  require_once('./session.php');
  require_once __DIR__ . '/../_includes/autoload.php';

  use Keyman\Site\Common\KeymanHosts;

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

  $platform = isset($_REQUEST['platform']) ? $_REQUEST['platform'] : null;

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

  if ($platform === null) {
    \UI\KeyboardDetails::render_keyboard_details($id, 'stable', false, $bcp47);
  } else {
    $s = @file_get_contents(KeymanHosts::Instance()->api_keyman_com . '/version/' . $platform);
    if ($s === FALSE) {
      // Will fail later in the script
      self::$error .= error_get_last()['message'] . "\n";
      self::$title = 'Failed to query Keyman for ' . $platform . ' version';
      header('HTTP/1.0 404 Keyman for ' . $platform . ' version not found');
      return;
    } 

    $s = json_decode($s);
    if($s && property_exists($s, 'version')) {
      $version = $s->version;
      // http://keyman.com.localhost/go/keyboard/sil_euro_latin/download/exe
      $target = KeymanHosts::Instance()->downloads_keyman_com . '/' . rawurlencode($platform)
        . '/stable/' . rawurlencode($version) . '/setup.exe';
      // Determine keyboard setup .exe bundle using filename
      $targetName = 'keyman-setup-stable.' . $id . '.exe';
      echo $targetName;
      header($_SERVER["SERVER_PROTOCOL"].' 302 Found');
      header('Cache-Control: no-cache');
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename*=${targetName}');
      header('Location: ' . $target);
    }
  }


?>
