<?php
  require_once('includes/template.php');
  require_once __DIR__ . '/../_includes/autoload.php';
  use Keyman\Site\Common\KeymanHosts;

  // Required
  head([
    'title' =>'Contact Us | Keyman',
    'css' => ['template.css'],
    'showMenu' => true
  ]);
?>
<h2 class="red underline">Technical Support</h2>

<p>Technical support is available through a variety of sources:
</p>

<ul>
  <li><a href="<?= KeymanHosts::Instance()->help_keyman_com ?>"><?= KeymanHosts::Instance()->help_keyman_com_host ?></a> - online documentation</li>
  <li><a href='https://community.software.sil.org/c/keyman'>SIL Keyman Community</a> - for general Keyman technical support</li>
  <li><a href='https://stackoverflow.com/search?q=%5Bkeyman%5D'>Stack Overflow</a> - for support on creating keyboard layouts with Keyman Developer (<a href='https://stackoverflow.com/questions/ask?tags=keyman,keyman-developer,keyboard,unicode'>ask a question</a>)</li>
  <li><a href="https://secure.tavultesoft.com/forums/">Old Keyman Forums</a> - read only, for reference</li>
</ul>

<br/>

<p>
  Direct email support for Keyman products is no longer available.
  Please direct support enquiries to the <a href='https://community.software.sil.org/c/keyman'>Keyman Community</a>.
</p>

<h2 class="red underline">Social Media and Mailing Lists</h2>
<p>
  <a href="https://twitter.com/keyman"><img class="contact-social" src="<?php echo cdn("img/twitter2.png"); ?>"/>Twitter</a>
  <br/>
  <a href="https://www.facebook.com/KeymanApp"><img class="contact-social" src="<?php echo cdn("img/facebook2.png"); ?>"/>Facebook</a>
  <br/>
  <a href="https://community.software.sil.org/c/keyman"><img class="contact-social" src="<?php echo cdn("img/discourse-16.png"); ?>"/>SIL Keyman Community Forum</a>
  <br/>
  <a href="/about/list"><img class="contact-social" src="<?php echo cdn("img/email-16.png"); ?>"/>Keyman Announcements by Email</a>
</p>

<h2 class="red underline">Postal Address</h2>
<p>
  SIL International
  <br/>
  7500 W Camp Wisdom Rd
  <br/>
  Texas USA 75236
</p>
