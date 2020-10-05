<?php
  require_once('includes/template.php');
  require_once('includes/appstore.php');
  require_once __DIR__ . '/../_includes/autoload.php';
  use Keyman\Site\Common\KeymanHosts;

  // Required
  head([
    'title' =>'Keyman for iPhone and iPad',
    'css' => ['template.css','feature-grid.css','app-store-links.css'],
    'showMenu' => true,
    'banner' => [
      'title' => '600 languages,<br/>all your apps.',
      'button' => '<a href="'.$appstore.'" target="itunes_store"><img id="app-store" src="cdn(Available_on_the_App_Store_Badge_US-UK_135x40_0824.png)"
        alt="Available on the App Store" /></a>',
      'image' => 'ios-splash.png',
      'background' => 'water'
    ]
  ]);
?>
<h2 class="red underline">Keyman for iPhone and iPad</h2>

<?= $appstoreTable ?>

<?php
    if (betaTier()) {
?>
        <p>Want to try the Keyman for iPhone and iPad <?php echo $beta_version ?> Beta? <a href="/<?= $beta_version ?>/">Learn more</a></p>
<?php
    }
?>

<p>
  Keyman for iPhone and iPad makes it possible to type in over 600 languages on your iPhone or iPad.
  Keyman provides system-wide keyboards in iOS 9 and later, allowing you to use your keyboard in all your favourite apps.
  <br/><br/>
  Keyman also adds font rendering for languages that even Apple doesn't support.
  You can now have a seamless language experience on the world's easiest to use touch-oriented devices!
</p>


<h2>What can Keyman do on your iPhone or iPad?</h2>

<br/>

<table class='feature-grid'>
  <thead>
    <tr>
      <th>Feature</th>
      <th>Keyman</th>
    </tr>
  </thead>
  <tbody>
    <tr>
        <td>World-leading input methods for hundreds of languages</td>
        <td><img class="table-tick" src="<?php echo cdn("img/table-tick.png"); ?>"/></td>
    </tr>
    <tr>
        <td>Create your own custom keyboards</td>
        <td><img class="table-tick" src="<?php echo cdn("img/table-tick.png"); ?>"/></td>
    </tr>
    <tr>
      <td>Create your own custom dictionary for use with predictive text</td>
      <td><img class="table-tick" src="<?php echo cdn("img/table-tick.png"); ?>"/></td>
    </tr>
    <tr>
        <td>System-wide installable fonts</td>
        <td><img class="table-tick" src="<?php echo cdn("img/table-tick.png"); ?>"/></td>
    </tr>
    <tr>
        <td>System keyboard support</td>
        <td><img class="table-tick" src="<?php echo cdn("img/table-tick.png"); ?>"/></td>
    </tr>
    <tr>
        <td>Built in browser for full font support</td>
        <td><img class="table-tick" src="<?php echo cdn("img/table-tick.png"); ?>"/></td>
    </tr>
    <tr>
        <td>Install custom keyboard and dictionary packages</td>
        <td><img class="table-tick" src="<?php echo cdn("img/table-tick.png"); ?>"/></td>
    </tr>
  </tbody>
</table>

<h2>New in Keyman 13.0 (Feb 2020)</h2>
<ul>
  <li>App migrated to compile against iOS 13.0, now supports dark mode.</li>
  <li>Fixed issues with keyboard size, matching it far more closely to the default iOS keyboard.</li>
  <li>Adds file browsing option for easier installation of ad-hoc resources</li>
  <li>Adds QR codes to keyboard information pages to facilitate sharing</li>
  <li>Reworked predictive text styling.</li>
</ul>

<h2>New in Keyman 12.0 (Oct 2019)</h2>

<ul>
  <li>Added support for basic autocorrect and predictive text for languages with supported dictionaries.</li>
  <li>Addition of a new Settings menu, which manages installed keyboards, dictionaries, and their settings.</li>
</ul>

<h2>New in Keyman 11.0 (Mar 2019)</h2>

<ul>
    <li>Fixed issues with keyboard rotation and sizing, including the iPhone X notch</li>
    <li>Device vibrates when current keyboard signals an invalid keystroke (e.g. two identical diacritics in a row)</li>
</ul>

<h2>New in Keyman 10.0 (Jul 2018)</h2>

<ul>
    <li>App migrated to Swift 4.0 and built with iOS 11.0 SDK</li>
    <li>Support installing Keyman Packages (KMP) for ad-hoc distribution</li>
    <li>Fixed occasional repeated characters when typing rapidly</li>
    <li>Fixed output for certain punctuation longpress keys </li>
</ul>

<h2>New in Keyman 2.6.3 (18 Aug 2017)</h2>

<ul>
  <li>Numerous keyboarding bugfixes</li>
  <li>Replaced an outdated internal library</li>
</ul>

<h2>New in Keyman 2.5.2 (21 Feb 2017)</h2>

<ul>
  <li>Fixed bug with long-press keys not working on some newer iPhones</li>
</ul>

<h2>New in Keyman 2.5.1 (9 Feb 2017)</h2>

<ul>
  <li>Keyman is now distributed by SIL International</li>
</ul>

<h2>New in Keyman 2.4.2 (14 Oct 2016)</h2>

<ul>
  <li>Keyman Pro is renamed to Keyman and is now free!</li>
  <li>Separate free edition discontinued</li>
</ul>

<h2>Version 2.4.1 (3 Nov 2015)</h2>

<ul>
  <li>Now rotates correctly on iOS 9</li>
  <li>Optimised for iOS 9</li>
  <li>Fixed performance issues on iOS 8</li>
</ul>

<h2>New in Keyman Pro 2.2 (29 Jun 2015)</h2>

<ul>
  <li>Faster load, keyboard switching and more responsive touches</li>
  <li>More stable, reduced memory requirements and addressed crashes</li>
  <li>Improved look and feel including smaller banner and improved long-press menus</li>
  <li>Smoother touch interactions and rapid touch interactions</li>
  <li>Handles touches just outside a key more intelligently</li>
  <li>Minor bug fixes and improvements</li>
</ul>

<h2>New in Keyman Pro 2.1 (27 Jan 2015)</h2>

<ul>
  <li><strong class='red'>Built-in browser</strong> avoids rendering square boxes by dynamically loading language font</li>
</ul>
<br/>

<p>
  <a href="<?= $KeymanHosts->help_keyman_com ?>/products/iphone-and-ipad/version-history/">View all version history</a>
</p>

<?= $appstoreTable ?>

<h2 class="red underline">Keyman Engine for iPhone and iPad</h2>
<p>
  As always, we make our technology available to app developers!  Keyman Engine for iPhone and iPad is our programming interface for Keyman for iPhone and iPad.  Bringing with it over 600 languages and multiple keyboards for many of those languages, as well as automatic embedded font support, Keyman Engine for iPhone and iPad makes it straightforward to take your app to the world!
</p>
<br/>
<p>
  You can develop your own keyboard layouts for Keyman for iPhone and iPad with <a href='/developer'>Keyman Developer</a>.  If you have existing keyboards, they can be ported to iOS with just a recompile.  And of course, we include support for touch-oriented features such as touch-and-hold menus, dynamic keyboard layers and more!
</p>
<p>
  <a href='<?= KeymanHosts::Instance()->help_keyman_com ?>/developer/engine/iphone-and-ipad/<?php echo $stable_version?>'>Keyman Engine for iPhone and iPad Documentation</a>
</p>
<p>
  <a href="/downloads/#ios-engine">Download the latest Keyman Engine for iOS</a>
</p>
