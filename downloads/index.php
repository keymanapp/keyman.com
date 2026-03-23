<?php
  require_once('includes/template.php');
  require_once('includes/ui/downloads.php');
  require_once('includes/appstore.php');
  require_once('includes/playstore.php');
  require_once('../keyboards/session.php');
  use Keyman\Site\Common\KeymanHosts;
  use Keyman\Site\com\keyman\Locale;

  Locale::definePageLocale('LOCALE_DOWNLOADS', 'downloads');
  $_m_Downloads = function($id, ...$args) { return Locale::m(LOCALE_DOWNLOADS, $id, ...$args); };
  function _m_Downloads($id, ...$args) {    return Locale::m(LOCALE_DOWNLOADS, $id, ...$args); }

  // Required
  head([
    'title' => _m_Downloads('downloads_page_title'),
    'description' => _m_Downloads('downloads_page_description'),
    'css' => ['template.css','index.css','app-store-links.css', 'prism.css'],
    'js' => ['prism.js'],
    'showMenu' => true
  ]);
?>

<h2 class="red underline large"><?= _m_Downloads('downloads_page_title') ?></h2>

<p>
  <?= _m_Downloads('get_the_latest', 
    sprintf('<a href=\'pre-release\'>%s</a>', _m_Downloads('downloads_pre_release_page')),
    sprintf('<a href=\'archive\'>%s</a>', _m_Downloads('downloads_old_versions_page')) ) ?>
</p>

<p>
  <a href='<?= KeymanHosts::Instance()->help_keyman_com?>/version-history'><?= _m_Downloads('keyman_version_history_1') ?></a> 
  <?= _m_Downloads('keyman_version_history_2') ?>
</p>


  <a class="button" href="all-versions"><?= _m_Downloads('browse_all_versions') ?></a>


<?php
  require_once('./_downloads.php');
?>
