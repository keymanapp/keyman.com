<?php
  require_once('includes/template.php');
  require_once(__DIR__ . '/../../vendor/erusev/parsedown/Parsedown.php');
  require_once(__DIR__ . '/../../vendor/erusev/parsedown-extra/ParsedownExtra.php');
  use Keyman\Site\Common\KeymanHosts;

  $pagetitle = 'TODO';

  if(!isset($_REQUEST['file'])) {
    die('Require file parameter');
  }

  $file = realpath(__DIR__ . '/../../') . DIRECTORY_SEPARATOR . $_REQUEST['file'];
  $contents = trim(file_get_contents($file));
  $contents = str_replace("\r\n", "\n", $contents);

  // Regex Keyman hosts
  $contents = str_replace("\$api.keyman.com", KeymanHosts::Instance()->api_keyman_com, $contents);
  $contents = str_replace("\$donate.keyman.com", KeymanHosts::Instance()->donate_keyman_com, $contents);
  $contents = str_replace("\$help.keyman.com", KeymanHosts::Instance()->help_keyman_com, $contents);
  $contents = str_replace("\$keyman.com", KeymanHosts::Instance()->keyman_com, $contents);

  //echo $contents;

  // This header specification comes from YAML originally and is not common across
  // markdown implementations. While Parsedown does not currently parse this out,
  // it seems a sensible approach to use. The header section is delineated by `---`
  // and `---` must be the first three characters of the file (no BOM!); note that
  // the full spec supports metadata sections anywhere but we only support top-of-file.
  //
  // Currently we support only the 'title' keyword, and it must be a plain text title.
  //
  // ---
  // keyword: content
  // keyword: content
  // ---
  //
  // source: https://yaml.org/spec/1.2/spec.html#id2760395
  // source: https://pandoc.org/MANUAL.html#extension-yaml_metadata_block
  //
  if(preg_match('/^---\n(.+)\n---\n(.+)/s', $contents, $match)) {
    $metadata = $match[1];
    $contents = $match[2];
  } else {
    $metadata = 'title: untitled';
  }

  if(preg_match('/^title: (.+)/', $metadata, $match)) {
    $pagetitle = $match[1];
  } else {
    $pagetitle = 'Untitled';
  }

  head([
    'title' => $pagetitle
  ]);
?>

<h1><?= $pagetitle ?></h1>

<?php
  // Performs the parsing + prettification of Markdown for display through PHP.
  $Parsedown = new ParsedownExtra();

  // Does the magic.
  echo $Parsedown->text($contents);
?>