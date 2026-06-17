<?php
  require_once _KEYMANCOM_INCLUDES . '/includes/template.php';
  require_once _KEYMANCOM_INCLUDES . '/autoload.php';

  use Keyman\Site\com\keyman\Locale;

  Locale::definePageScope('LOCALE_WINDOWS', 'windows');

  // Required
  head([
    'title' => _m_Windows('page_title', $stable_version),
    'description' => _m_Windows('page_description'),
    'css' => ['template.css','index.css','desktop.css','feature-grid.css'],
    'showMenu' => true,
    'banner' => [
      'title' => _m_Windows('page_banner_title', $stable_version) . '<br/><span id="title-small">' . _m_Windows('page_banner_subtext') . '</span>',
      'button' => '<div id="banner-buttons"><a class="banner-button" href="download"><img src="'.cdn('img/download_button.png').'" /></a></div>',
      'image' => 'screenshots/14/windows/osk-malayalam-566x226.png',
      'background' => 'water'
    ]
  ]);
?>
<br/>
<h2 class="red underline"><?= _m_Windows('intro_heading', $stable_version); ?></h2>
<?= _m_Windows('intro_paras', $stable_version); ?>
<ul>
  <li><a href="features"><?= _m_Windows('see_the_features') ?></a></li>
  <li><a href="keyboards"><?= _m_Windows('clever_keyboards') ?></a></li>
</ul>
<div class="button-div">
    <a href="download"><img src="<?php echo cdn('img/download_button.png'); ?>" /></a>
</div>

<?php
  if (betaTier()) {
    echo "<p>{$_m_Windows('try_beta', $beta_version)}</p>";
  }
?>

<h2 class="red underline"><?= _m_Windows('features_heading') ?></h2>
<p>
  <?= _m_Windows('keyman_is_free') ?>
</p>
<table class='feature-grid'>
    <thead>
        <tr>
            <th><?= _m_Windows('feature_column') ?></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><a href="features#keyboard-list"><?= _m_Windows('world_leading_im') ?></a></td>
            <td><img class="table-tick" src="<?php echo cdn("img/table-tick.png"); ?>"/></td>
        </tr>
        <tr>
            <td><a href="features#keyman-dev"><?= _m_Windows('create_custom_keyboards') ?></a></td>
            <td><img class="table-tick" src="<?php echo cdn("img/table-tick.png"); ?>"/></td>
        </tr>
        <tr>
            <td><?= _m_Windows('start_with_windows_login') ?></td>
            <td><img class="table-tick" src="<?php echo cdn("img/table-tick.png"); ?>"/></td>
        </tr>
        <tr>
            <td><a href="features#keyboard-limit"><?= _m_Windows('number_of_keyboards_install') ?></a></td>
            <td><?= _m_Windows('keyboards_unlimited') ?></td>
        </tr>
        <tr>
            <td><a href="features#language-association"><?= _m_Windows('associate_keyboards') ?></a></td>
            <td><img class="table-tick" src="<?php echo cdn("img/table-tick.png"); ?>"/></td>
        </tr>
        <tr>
            <td><a href="features#keyboard-information"><?= _m_Windows('advanced_keyboard_info') ?></a></td>
            <td><img class="table-tick" src="<?php echo cdn("img/table-tick.png"); ?>"/></td>
        </tr>
        <tr>
            <td><a href="features#hotkeys"><?= _m_Windows('keyboard_hotkeys') ?></a></td>
            <td><img class="table-tick" src="<?php echo cdn("img/table-tick.png"); ?>"/></td>
        </tr>
        <tr>
            <td><a href="features#hotkeys"><?= _m_Windows('interface_hotkeys') ?></a></td>
            <td><img class="table-tick" src="<?php echo cdn("img/table-tick.png"); ?>"/></td>
        </tr>
        <tr>
            <td><a href="features#language-switcher"><?= _m_Windows('language_switcher') ?></a></td>
            <td><img class="table-tick" src="<?php echo cdn("img/table-tick.png"); ?>"/></td>
        </tr>
        <tr>
            <td><a href="features#character-map"><?= _m_Windows('charmap') ?></a></td>
            <td><img class="table-tick" src="<?php echo cdn("img/table-tick.png"); ?>"/></td>
        </tr>
        <tr>
            <td><a href="features#font-helper"><?= _m_Windows('fonthelper') ?></a></td>
            <td><img class="table-tick" src="<?php echo cdn("img/table-tick.png"); ?>"/></td>
        </tr>
        <tr>
            <td><a href="features#character-map"><?= _m_Windows('charident') ?></a></td>
            <td><img class="table-tick" src="<?php echo cdn("img/table-tick.png"); ?>"/></td>
        </tr>
        <tr>
            <td><?= _m_Windows('hide_startup') ?></td>
            <td><img class="table-tick" src="<?php echo cdn("img/table-tick.png"); ?>"/></td>
        </tr>
        <tr>
            <td><a href="features#osk"><?= _m_Windows('basic_osk') ?></a></td>
            <td><img class="table-tick" src="<?php echo cdn("img/table-tick.png"); ?>"/></td>
        </tr>
        <tr>
            <td><a href="features#osk"><?= _m_Windows('advanced_osk') ?></a></td>
            <td><img class="table-tick" src="<?php echo cdn("img/table-tick.png"); ?>"/></td>
        </tr>
        <tr>
            <th><?= _m_Windows('tech_support') ?></th>
            <th></th>
        </tr>
        <tr>
            <td><a href="features#support"><?= _m_Windows('web_tech_support') ?></a></td>
            <td><img class="table-tick" src="<?php echo cdn("img/table-tick.png"); ?>"/></td>
        </tr>
    </tbody>
</table>
<p>
    <?= _m_Windows('learn_features', $stable_version) ?>
</p>
<div class="button-div">
    <a href="download"><img src="<?php echo cdn('img/download_button.png'); ?>" /></a>
</div>
<h2 class="red underline"><?= _m_Windows('faq') ?></h2>
<p>
    <span class="red"><?= _m_Windows('faq_q') ?></span> <?= _m_Windows('faq_free_q') ?>
</p>
<p>
    <span class="red"><?= _m_Windows('faq_a') ?></span> <?= _m_Windows('faq_free_a') ?>
</p>
<br/>
<p>
    <span class="red"><?= _m_Windows('faq_q') ?></span> <?= _m_Windows('faq_windows_q', $stable_version) ?>
</p>
<p>
    <span class="red"><?= _m_Windows('faq_a') ?></span> <?= _m_Windows('faq_windows_a', $stable_version) ?>
</p>
<br/>
<p>
    <span class="red"><?= _m_Windows('faq_q') ?></span> <?= _m_Windows('faq_languages_q') ?>
</p>
<p>
    <span class="red"><?= _m_Windows('faq_a') ?></span> <?= _m_Windows('faq_languages_a', $stable_version) ?>
</p>
<br/>
<p>
    <span class="red"><?= _m_Windows('faq_q') ?></span> <?= _m_Windows('faq_upgrade_q') ?>
</p>
<p>
    <span class="red"><?= _m_Windows('faq_a') ?></span> <?= _m_Windows('faq_upgrade_a', $stable_version) ?>
</p>
<br/>
