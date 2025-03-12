<?php
  declare(strict_types=1);

  namespace Keyman\Site\com\keyman\templates;

use Keyman\Site\com\keyman\Util;
use Keyman\Site\Common\Assets;
use Keyman\Site\Common\KeymanHosts;

class Head {
    static function render($fields = []) {
      $fields = (object)$fields;

      if(!isset($fields->title)) {
        $fields->title = 'Keyman | Type to the world in your language';
      }
      if(empty($fields->language)) {
        $fields->language = 'en'; // Default to English
      }
      if(!isset($fields->favicon)) {
        $fields->favicon = Util::cdn("img/favicon.ico");
      }
      if(!isset($fields->css)) {
        $fields->css = [Util::cdn("css/template.css")];
      }
      if(!isset($fields->js)) {
        $fields->js = [];
      }
?><!DOCTYPE html>
<?php
  if (!empty($fields->language)) {
    echo "<html lang='$fields->language'>";
  } else {
    echo "<html>";
  }
?>
<head>
  <meta charset="utf-8">
  <?php
  if(isset($fields->description) && !empty($fields->description)) {
    echo "<meta name='description' content='" . $fields->description . "'>\n";
  }
  if(KeymanHosts::Instance()->Tier() == KeymanHosts::TIER_STAGING) {
    echo '    <meta name="robots" content="none">';
  }
?>
  <title><?= $fields->title; ?></title>
  <script
    src="https://js.sentry-cdn.com/bba22972ad6b4c2ab03a056f549cc23d.min.js"
    crossorigin="anonymous"
  ></script>
  <script
    src="https://browser.sentry-cdn.com/9.1.0/bundle.tracing.min.js"
    integrity="sha384-MCeGoX8VPkitB3OcF9YprViry6xHPhBleDzXdwCqUvHJdrf7g0DjOGvrhIzpsyKp"
    crossorigin="anonymous"
  ></script>
  <script
    src="https://browser.sentry-cdn.com/9.1.0/captureconsole.min.js"
    integrity="sha384-gkHY/HxnL+vrTN/Dn6S9siimRwqogMXpX4AetFSsf6X2LMQFsuXQGvIw7h2qWCt+"
    crossorigin="anonymous"
  ></script>
  <script
    src="https://browser.sentry-cdn.com/9.1.0/httpclient.min.js"
    integrity="sha384-ZsomH91NyAZy+YSYhJcpL3sSDFlkL310CJnpKNqL9KerB92RvfsH9tXRa2youKLM"
    crossorigin="anonymous"
  ></script>
  <script>
    const sentryEnvironment = {
      dsn: 'https://44d5544d7c45466ba1928b9196faf67e@o1005580.ingest.us.sentry.io/5983516',
      tier: '<?=KeymanHosts::Instance()->TierName()?>',
    }
  </script>
  <script src="<?= Assets::Get('js/sentry.js'); ?>"></script>
  <meta content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" name="viewport">
  <link rel='shortcut icon' href="<?= $fields->favicon; ?>">
  <?php foreach($fields->css as $cssFile) { ?>
    <link rel="stylesheet" type="text/css" href="<?= $cssFile; ?>">
  <?php } ?>

  <link href='https://fonts.googleapis.com/css?family=Cabin:400,400italic,500,600,700,700italic|Source+Sans+Pro:400,700,900,600,300|Noto+Serif:400' rel='stylesheet' type='text/css'>

  <?php
    array_unshift($fields->js,
      Util::cdn('js/jquery1-11-1.min.js'),
      Util::cdn('js/bowser.es5.2.9.0.min.js'),
      Util::cdn('js/kmlive.js')
    );

    foreach($fields->js as $jsFile) { ?>
    <script src='<?=$jsFile?>'></script>
  <?php } ?>
</head>

<?php
    }
  }