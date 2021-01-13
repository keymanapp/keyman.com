<?php
  require_once('includes/template.php');
  require_once('includes/ui/downloads.php');
  require_once('includes/appstore.php');
  require_once('includes/playstore.php');

  // Required
  head([
    'class' => 'keyman11',
    'title' => 'Keyman 12 is here and free!',
    'css' => ['template.css', 'dev.css', 'app-store-links.css'],
    'showMenu' => true
  ]);
?>

<h1 class='red underline'>Keyman 12 is now available!</h1>

<h2>Introducing Predictive Text for your language</h2>

<p>In Keyman 12, we have created predictive text services for iPhone, iPad and Android devices that can be used for any language.</p>

<p style='text-align: center'><img src='predictive-text-ios.png'></p>

<h2>You control the dictionaries for your language</h2>

<p>Add a dictionary for your language to Keyman to receive suggestions and corrections as you type.</p>

<p style='text-align: center'><img src='predictive-text-settings-android.png'></p>

<h2>Create dictionaries for your own language with Keyman Developer</h2>

<p>Keyman Developer includes all the functionality you need to create dictionaries for your language.
Distribute dictionaries directly through Keyman or peer-to-peer in your community.</p>

<p><a href='<?=$KeymanHosts->help_keyman_com?>/developer/12.0/guides/lexical-models/'>Learn more about creating dictionaries</a></p>

<p style='text-align: center'><img src='predictive-text-editor.png'></p>

<h2>There's more!</h2>

<p>We have made many other smaller changes and improvements to Keyman 12, such as a new Welcome screen in Keyman Developer,
and improvements to the stability of Keyman for MacOS. Read about all the changes in our <a href='<?=$KeymanHosts->help_keyman_com?>/version-history'>release notes</a>.</p>

<h1 class='red underline large'>Get Involved</h1>

<p style='cursor:pointer' onclick='location.href="/about/get-involved";return false;'>The success of Keyman is up to you! Keyman is a community-developed program and your involvement guarantees the ongoing usefulness of Keyman.
There are many ways you can help: <a href='/about/get-involved'>get involved</a> in the Keyman project now!</p>

<h1 class='red underline large'>Downloads</h1>

<?php require_once('../downloads/_downloads.php'); ?>
