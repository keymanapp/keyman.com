<?php
require_once('includes/template.php');
require_once('includes/ui/downloads.php');
require_once('includes/appstore.php');
require_once('includes/playstore.php');

// Required
head([
  'class' => 'keyman11',
  'title' => 'Keyman 13 is here and free!',
  'css' => ['template.css', 'dev.css', 'app-store-links.css', 'prism.css'],
  'js' => ['prism.js'],
  'showMenu' => true
]);
?>

<h1 class='red underline'>Keyman 13 is now available!</h1>

<h2>Share Keyboard Download Links via QR Codes</h2>

<p>On all the Keyman platforms, keyboard information pages now show a QR code that lets you share
  keyboards which are available from Keyman cloud.</p>
<p style='text-align: center'><img alt='Share keyboards via QR Codes' src='share-qr-code.png'></p>

<h2>Dark mode support on Keyman for iPhone and iPad</h2>
<p style='text-align: center'><img alt='Dark mode for Keyman for iPhone and iPad' src='ios-dark.png'></p>

<h2>Simplified Keyman installer on macOS</h2>
<p>We've made it easier to install Keyman via an AppleScript that guides you through the process.
  This has been tested on macOS 10.13, 10.14, and 10.15.</p>

<h2>There's more!</h2>
<p>We have made many other smaller changes and improvements to Keyman 13, such as an improved Lexical Model editor in Keyman Developer,
improvements to context handling in Keyman for macOS, and setting keyboard options in Keyman for Linux. Read about all the changes in our
<a href='<?=$helphost?>/version-history'>release notes</a>.

<h1 class='red underline large'>Get Involved</h1>

<p style='cursor:pointer' onclick='location.href="/about/get-involved";return false;'>The success of Keyman is up to you! Keyman is a community-developed program and your involvement guarantees the ongoing usefulness of Keyman.
  There are many ways you can help: <a href='/about/get-involved'>get involved</a> in the Keyman project now!</p>

<h1 class='red underline large'>Downloads</h1>

<?php require_once('../downloads/_downloads.php'); ?>
