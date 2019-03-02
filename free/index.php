<?php
  require_once('includes/template.php');
  
  // Required
  head([
    'title' =>'Keyman is free! | Keyman',
    'css' => ['template.css', 'product-grid.css'],
    'showMenu' => true
  ]);           
?>
<style>
  dl { font-size: 14pt; }
  dl dt { font-weight: bold; margin: 24px 0 16px 10px; }
  dl dd { margin: 16px 0 16px 24px; }
  #section2 dl dd p { padding:0; margin: 10px 0 10px 0; }
</style>

<h2 class="red underline">Keyman is free on all platforms!</h2>

<p dir="ltr">Following <a href='/sil-acquisition'>SIL International&rsquo;s purchase of the Keyman intellectual property in September 2015</a>, SIL has now completed the acquisition of Keyman from Tavultesoft.</p>

<p dir="ltr"><a href="https://www.sil.org/about">About SIL International</a></p>

<p dir="ltr">As of August 2017, SIL has now made the entire Keyman product suite freely available to the world.</p>

<p><a href='https://blog.keyman.com/2017/08/keyman-is-now-free-and-open-source/'>Read the full announcement on our blog</a>!</p>

<h2 class="null">Frequently Asked Questions</h2>

<dl>
  <dt>If I bought a license of Keyman from Tavultesoft before the free version was available, can I get a refund?</dt>
  <dd>No. Tavultesoft is not offering refunds.</dd>

  <dt>Who do I go to for technical support?</dt>
  <dd>
    <p>Support has transitioned to be primarily community based. We have two new locations for Keyman technical support:</p>
    
    <ul>
      <li><a href='https://community.software.sil.org/c/keyman'>SIL Keyman Community</a> - for general Keyman technical support</li>
      <li><a href='https://stackoverflow.com/search?q=%5Bkeyman%5D'>Stack Overflow</a> - for support on creating keyboard layouts with Keyman Developer (<a href='https://stackoverflow.com/questions/ask?tags=keyman,keyman-developer,keyboard,unicode'>ask a question</a>)</li>
    </ul>
    <br/>
    <p>The <a href="https://secure.tavultesoft.com/forums">Tavultesoft Forums</a> are now read only.</p>
  </dd>

  <dt>I have an existing license for Keyman Desktop. What happens to that license?</dt>
  <dd>Your license will continue to work. SIL and Tavultesoft are committed to keeping the license servers running. However, we would encourage you to upgrade to version <?php echo $stable_version; ?>, which is completely free.</dd>
  
  <dt>What are SIL&rsquo;s long-term plans for Keyman?</dt>
  <dd>
    <p>SIL will continue to provide Keyman as a user-friendly downloadable program with the existing and growing catalogue of high quality keyboard layouts.</p>
    
    <p>SIL&rsquo;s long-term goal is to provide a freely available and extensible keyboarding platform, using Keyman as a foundation. SIL is working with standards organisations to create a global keyboarding standard, and will update Keyman to be the open source reference implementation for all major operating systems.</p>
  </dd>
  
  <dt>What is Marc Durdin doing?</dt>
  <dd>You may know Marc as the primary developer of Keyman. Marc is leading the SIL team developing the Keyman projects within SIL.</dd>
  
  <dt>What is happening to Tavultesoft?</dt>
  <dd>Tavultesoft will continue to operate as a consulting microbusiness, mostly for Keyman-related projects. As SIL now owns the Keyman IP, Tavultesoft has ceased all development and direct technical support on Keyman itself.</dd>

  <dt>How can I support the development of Keyman?</dt>
  <dd>
    <p>You can support the Keyman project through financially partnering with Marc&rsquo;s family. SIL members are funded through partnership with individuals and organisations that support the vision of SIL. Please visit&nbsp;<a href="https://durdin.net/">https://durdin.net/</a> to learn more about the Durdin family&rsquo;s journey.</p>
  
    <p>You can also donate directly to the Keyman project through the Keyman website at&nbsp;<a href="https://keyman.com/donate">https://keyman.com/donate</a>.</p>
  </dd>
</dl>

<h2 class="null">Keep in touch</h2>

<p dir="ltr">The Tavultesoft mailing list has now been closed down. If you would like to keep in touch, here are some options:</p>

<ol>
  <li>Keep in touch with the Durdins through&nbsp;<a href="https://durdin.net/">https://durdin.net/</a></li>
  <li>Sign up with the SIL Keyman mailing list at&nbsp;<a href="https://keyman.com/about/list.php">https://keyman.com/about/list.php</a></li>
  <li>Be a part of the communities on
    <a href='https://facebook.com/KeymanApp'>Facebook</a>,
    <a href='https://twitter.com/keyman'>Twitter</a>,
    <a href='https://community.software.sil.org/c/keyman'>SIL Language Software Community</a>.
  </li>
</ol>
