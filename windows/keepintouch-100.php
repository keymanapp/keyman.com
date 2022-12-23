<?php 
    // This page is hosted in Keyman Desktop Configuration.
    // Note that it must remain compatible with IE8/9 (yeuch).
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset='utf-8'>
  <title>Keep in touch with the Keyman team</title>
  <link href="https://fonts.googleapis.com/css?family=Cabin:400,400italic,500,600,700,700italic|Source+Sans+Pro:400,700,900,600,300|Noto+Serif:400" rel="stylesheet" type="text/css">
  <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
  <script>
    if(location.hash == '#embed' || location.search.indexOf('embed=1') >= 0) {
      if(window.top != self) {
        document.getElementsByTagName('html')[0].className = 'embed frame';
      } else {
        document.getElementsByTagName('html')[0].className = 'embed';
      }
    }
    
    
    $(document).ready( function () {
        // I only have one form on the page but you can be more specific if need be.
        var $form = $('form');

        if ( $form.length > 0 ) {
            $('form input[type="submit"]').bind('click', function ( event ) {
                if ( event ) event.preventDefault();
                // validate_input() is a validation function I wrote, you'll have to substitute this with your own.
                register($form); 
            });
        }
    });

    function register($form) {
      $.ajax({
        type: $form.attr('method'),
        url: $form.attr('action'),
        data: $form.serialize(),
        cache       : false,
        dataType    : 'json',
        contentType: "application/json; charset=utf-8",
        error       : function(err) { alert("Could not connect to the registration server. Please try again later."); },
        success     : function(data) {
            if (data.result != "success") {
              alert('Subscription failed: '+data.msg);
            } else {
              alert('Thank you for subscribing to the Keyman mailing list.\n\nYou will receive a confirmation email; if you don\'t find it in your inbox, please check your junk mail folders in case it has been miscategorised.'); //\n\n'+data.msg);
            }
        }
      });
    }    
    
    
    /* Placeholder fix for IE9 */
    
    $(document).ready( function () {
      $('[placeholder]').focus(function() {
        var input = $(this);
        if (input.val() == input.attr('placeholder')) {
          input.val('');
          input.removeClass('placeholder');
        }
      }).blur(function() {
        var input = $(this);
        if (input.val() == '' || input.val() == input.attr('placeholder')) {
          input.addClass('placeholder');
          input.val(input.attr('placeholder'));
        }
      }).blur();
      
      $('[placeholder]').parents('form').submit(function() {
        $(this).find('[placeholder]').each(function() {
          var input = $(this);
          if (input.val() == input.attr('placeholder')) {
            input.val('');
          }
        })
      });
    });    
  </script>
  <style>
    .placeholder {
      color: #aaa;
    }
    /* Styles for when displayed within Keyman Desktop */
    
    html .embed {
      display: none; 
    }

    html.embed .embed { 
      display: block;
    }
    
    html.embed.frame p.message {
      display: none;
      user-select: none;
    }
    
    html.embed.frame #ribbon {
      display: none;
    }
    
    html.embed.frame h1 {
      margin: 0;
      padding: 4px 0 8px 60px;
      background: url('/cdn/dev/img/keyman-48.png') 8px 8px no-repeat;
      background-color: #D6D6D6;
      user-select: none;
    }
    
    html.embed.frame .content {
      user-select: none;
    }
    
    /* Formatting */
    
    html, body {
      padding: 0;
      margin: 0;
    }
    
    .content {
      padding: 8px;
    }
    
    p.message {
      clear: both;
      font-size: 10pt;
      background: #D6D6D6;
      padding: 4px 8px;
      margin-bottom: 0;
      position: absolute;
      bottom: 0;
    }
    
    p.message input {
      float: right;
      clear: both;
      margin-top: 6px;
      font: 10pt Cabin;
    }
    
    p.browser {
      font: italic 12pt Cabin;
    }
    
    .fb-like {
      height: 20px;
    }
    
    .twitter-follow-button {
      display: block;
      height: 28px;
    }
    
    #google-plus {
      height: 24px;
    }
    
    h1 {
      margin: 4px 0 12px 0;
      padding-left: 60px;
      background: url('/cdn/dev/img/keyman-48.png') 8px 0 no-repeat;
      font: bold 24pt Cabin;
    }
    
    h2 { 
      float: left;
      clear: left;
      width: 140px;
      margin: 0 30px 20px 0;
      font: 22pt Cabin;
    }
    
    #mailchimp h2 {
      width: 250px;
    }
    
    p, li {
      font: 12pt Cabin;
    }
    
    .container {
      float: left;
    }
    
    #facebook .container {
      margin-top: 8px;
    }
    
    #twitter .container {
      margin-top: 2px;
    }
    
    #google-plus .container {
      margin-top: 6px;
    }
    
    #mailchimp .container {
      margin-top: 4px;
    }
    
    .mc-field-group, .mc-submit {
      float: left;
    }

    #mailchimp input {
      font: 14pt Cabin;
      height: 30px;
      box-sizing: border-box;
    }
    
    #ribbon { 
      position: absolute; 
      left: 0; 
      top: 0; 
      width: 100%; 
      height: 8px; 
      background: #79C3DA; 
    }

    #ribbon div {
      position: static;
      float: left;
      height: 8px;
    }

    #ribbon #ribbon1 {
      width: 56%;
      background: #F68924;
    }

    #ribbon #ribbon2 {
      width: 24%;
      background: #CC3846;
    }
    
    .twitter-follow-button {
      background: url('/cdn/dev/img/twitter-keep-in-touch.png');
      width: 144px;
      height: 28px;
      display: inline-block;
    }
    
  </style>
</head>
<body>
<div class='embed' id="ribbon">
  <div id="ribbon1"></div>
  <div id="ribbon2"></div>
  <div id="ribbon3"></div>
</div>

<h1>Keep in touch with the Keyman team</h1>

<div class='content'>
  <ul>
    <li>Communicate directly with the people who created Keyman
    <li>Learn tips and tricks for using your language more effectively on your computer
    <li>Get news of updates, features and special offers
  </ul>

  <p class='embed browser'>You can also <a href='keepintouch-100' target='_blank'>open this page in your browser</a></p>

  <div id='facebook'>
    <h2>Facebook</h2>

    <div class='container'>
      <div id="fb-root"></div>
      <div class="fb-like" data-href="https://facebook.com/KeymanApp" data-width="200" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
    </div>
  </div>

  <div id='twitter'>
    <h2>Twitter</h2>

    <div class='container'>
      <a href="https://twitter.com/keyman" class="twitter-follow-button" data-show-count="false" data-size="large" data-dnt="true" target='_blank'></a>
    </div>
  </div>

  <div id='mailchimp'>
    <h2>Keyman Mailing List</h2>

    <div class='container'>
      <!-- Begin MailChimp Signup Form -->
      <div id="mc_embed_signup">
      <form action="https://tavultesoft.us1.list-manage.com/subscribe/post-json?u=99fcab2b035a8a51cd2158ca9&amp;id=7ccdac1e32&amp;c=?" method="get" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate"  novalidate>
          <div class="mc-field-group">
              <input type="email" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="email address" value='' />
          </div>
          <div class="mc-submit">
            <input type='submit' value='Subscribe'>
          </div>
      </form>
      </div>
      <!--End mc_embed_signup-->
    </div>
  </div>
</div>

<p class='embed message'>
  <input type='button' value='Close' onclick='location.href="keyman:close"'>
  This screen will only show once after Keyman is installed. If you'd like to get to this screen again, open Keyman Configuration and click on the Keep in Touch tab.
</p>

<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.3&appId=168770849851289";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script -->


<!-- Place this tag in your head or just before your close body tag. -->
<script src="https://apis.google.com/js/platform.js" async defer></script>

</body>
</html>  