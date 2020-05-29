var loadedCount = 50;

function loaded(){

  if(typeof($) == 'undefined') {
    if(--loadedCount <= 0) return;
    window.setTimeout(loaded, 100);
    return;
  }
  if(typeof(bowser) == 'undefined') {
    if(--loadedCount <= 0) return;
    window.setTimeout(loaded, 100);
    return;
  }

  $('#open-sales-form').click(function(e){
    window.open("http://tavultesoft.com/sendmessage.php","_blank","width=660,height=600,resizable=no,scrollbars=yes");
    e.preventDefault();
    e.stopPropagation();
  });


  $('#testimonial').click(function(){
    location.href="http://www.tavultesoft.com/testimonials.php";
  });

  $('#twitter-testimonial').click(function() {
      location.href="https://twitter.com/ibrahimasaar/status/1161753102527193088";
  });

  // Email subscribe form
  $('.subscribe').click(function(){
    $('#mc-embedded-subscribe-form').submit();
  });

  // Popup close
  $('#popup-close').click(function(){
    $('.popup').fadeOut(300);
  });
  $(document).keyup(function(e) {
    if (e.keyCode == 27) {
	$('.popup').fadeOut(300);
    }   // esc
  });
  $(document).mouseup(function (e)
  {
    var container = $('.popup');
    if (!container.is(e.target) && container.has(e.target).length === 0){
	$('.popup').fadeOut(300);
    }
  });

  // Scrolling top menu functionality (Non touch devices only)
  var device = $(document.body).data('device');
  if (device != 'Android' && device != 'iPhone' && device != 'iPad') {
    $(window).scroll(function(e) {
      var scroller_anchor = $(".header").height();
      if ($(this).scrollTop() >= scroller_anchor && $('#top-menu1').css('position') != 'fixed'){
	$('#top-menu1').addClass('faded-menu');
	$('#top-menu-icon,#help1').fadeIn();
	$('.info-left').addClass('fixed-pos');
      }else if ($(this).scrollTop() < (scroller_anchor + 1) && $('#top-menu1').css('position') != 'absolute'){
	$('#top-menu1').removeClass('faded-menu');
	$('#top-menu-icon,#help1').hide();
	$('.info-left').removeClass('fixed-pos');
      }
    });
    var scroller_anchor = $(".header").height();
    if ($(this).scrollTop() >= scroller_anchor && $('#top-menu1').css('position') != 'fixed'){
      $('#top-menu1').addClass('faded-menu');
      $('#top-menu-icon,#help1').show();
      $('.info-left').addClass('fixed-pos');
    }else if ($(this).scrollTop() < (scroller_anchor + 1) && $('#top-menu1').css('position') != 'absolute'){
      $('#top-menu1').removeClass('faded-menu');
      $('#top-menu-icon,#help1').hide();
      $('.info-left').removeClass('fixed-pos');
    }
  }

  $('#show-phone-menu').click(function(event) {
    $("#phone-menu").toggle();
  });

  // Downloads
  $('.download-cta-button').click(function(e){
    var platform = $(this).closest('.download-cta-big').attr('id');
    if (platform == undefined) {
      platform = 'Windows';
    }else{
      platform = platform.substr(8);
    }
    var language = $(this).closest('.download-cta-big').parent('#download-cta').data('language');
    var keyboard = $(this).closest('.download-cta-big').parent('#download-cta').data('keyboard');

    var url = $(this).closest('.download-cta-big').data('url');
    if(url) {
      window.location.href = url;
      return;
    }

    var link = '';
    if (platform == 'Web') {
      if (language && keyboard) {
        link = 'http://keymanweb.com/#'+language+',Keyboard_'+keyboard;
      }else{
        link = 'http://keymanweb.com';
      }
      window.location.href = link;
      return;
    }else if (device == 'iPhone' || device == 'iPad') {
      if (language && keyboard) {
        e.preventDefault();
        link = 'keyman://localhost/open?keyboard='+keyboard+'&language='+language;
            }else{
        link = 'keyman://localhost/open';
      }
      $('#ios-installed').attr('href',link);
      // display popup
      $('#ios-install, #install-modal').show();
      return;
    }else if(device == 'Android') {
      if (language && keyboard) {
        e.preventDefault();
        link = 'keyman://localhost/open?keyboard='+keyboard+'&language='+language;
            }else{
        link = 'keyman://localhost/open';
      }
      $('#android-installed').attr('href',link);
      // display popup
      $('#android-install, #install-modal').show();
      return;
    }else if (platform == 'mac') {
      if(keyboard && language) {
        window.location.href = '/keyboards/'+keyboard;
      } else {
        window.location.href = '/mac/download.php';
      }
    }else if (platform == 'Windows' || platform == 'Linux') {
      if (language && keyboard) {
        link = '/keyboards/'+keyboard;
      }else{
        link = '/keyboards/';
      }
      window.location.href = link;
    }
  });

  $('#android-install-cancel, #ios-install-cancel').click(function(e){
    $('#android-install, #ios-install, #install-modal').hide();
    e.preventDefault();
  });

  // Download CTA switching
  $('#cta-big-Holder').hide();
  if (device == 'Other') {
    device == 'Windows';
  }
  // $('#cta-big-'+device).addClass('selected');
  $('#cta-Bookmarklet').click(function(){
    var language = $(this).parent('#download-cta').data('language');
    var keyboard = $(this).parent('#download-cta').data('keyboard');
    var link = '/bookmarklet/?language='+language+'&keyboard=Keyboard_'+keyboard;
    window.location.href = link;
    return false;
  });

  function show_download_popup(language,keyboard){
    var promo = getCookie('promotion');
    if (promo != '') {
      $('#download-special').remove();
    }
    var downloadCookie = getCookie('signup');
    if (downloadCookie != '') {
      $('#download-signup').remove();
    }
    if (language == 'amh') {
      language = 'for Amharic';
    }
    if (language == 'tam') {
      language = 'for Tamil';
    }
    var d = new Date();
    d.setTime(d.getTime() + (60*24*60*60*1000));
    var expires = "expires="+d.toGMTString();
    document.cookie="promotion=true;path=/;"+ expires;
    $('#product-download-popup-name').text('Keyman Desktop '+language);
    $('#product-download-popup, #install-modal').fadeIn();
    // Google Analytics event
    ga('send', 'event', 'Keyboard Download', 'Start', keyboard);
  }

  $('#product-download-popup-close').click(function(){
    $('#product-download-popup, #install-modal').fadeOut();
    $('#download-signup-response').text('');
  });

  $('#download-signup .button').click(function(){
    var email = $('#download-signup').children('input').val();
    var keyboard = $('#download-cta').data('keyboard');
    var url = '/prog/download-log.php';
    if (email != '') {
      //submit to serverside
      $.ajax({
	type: "POST",
	url: url,
	data:
	{
	  "Keyboard" : keyboard,
	  "Email" : email
	}
      }).done(function( data ) {
	data = jQuery.parseJSON(data);
	if (data['result'] == 'success') {
	  var d = new Date();
	  d.setTime(d.getTime() + (60*24*60*60*1000));
	  var expires = "expires="+d.toGMTString();
	  document.cookie="signup=true;path=/;"+ expires;
	  $('#download-signup-response').text('Signup Success!');
	  // Google Analytics event
	  ga('send', 'event', 'Mailing List', 'Signup (no incentive)', keyboard);
	}else{
	  alert(data['error']);
	}
      });
    }
  });

  function getCookie(cname)
  {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++)
    {
      var c = ca[i].trim();
      if (c.indexOf(name)==0) return c.substring(name.length,c.length);
     }
    return "";
  }

  if (bowser.firefox) {
    $('#ie-dl,#chrome-dl').remove();
  }else if (bowser.chrome) {
    $('#ie-dl,#firefox-dl').remove();
  }else if (bowser.msie) {
    $('#firefox-dl,#chrome-dl').remove();
  }else{
    $('#product-download-popup-instruct').remove();
  }

  // Uninstall Feedback
  var uninstallFeedbackSent = false;
  $('.feedback').click(function(){
    if (uninstallFeedbackSent == false) {
      var reason = $(this).attr("value");
      $('.feedback').each(function(){
	$(this).removeClass('selected');
      });
      $(this).addClass('selected');
      $('#feedback-reason').val(reason);
      // Submit reason to uninstall feedback
      var url = "/prog/uninstall.php";
      var params = $('#feedback-message').serialize();
      $.post(url,params,function(data){
	// success
	if (data == 'success') {
	  $('#feedback-message').show();
	  $('#uninstall-feedback-buttons,#uninstall-question').hide();
	  uninstallFeedbackSent = true;
	  return;
	}
	alert(data);
      });
    }
  });
  $('#feedback-message').submit(function(event){
    event.preventDefault();
    var url = "/prog/uninstall2.php";
    var params = $('#feedback-message').serialize();
    $.post(url,params,function(data){
      // success
      console.log(data);
      $('#feedback-msg2').html(data).show();
      if (data == 'Your feedback was successfully sent') {
	$('#feedback-message').hide();
      }
    });
  });


  // GA event listeners

  // Click through download discount
  $('#discount-purchase-button a').on('click', function() {
    var keyboard = $('#download-cta').data('keyboard');
    ga('send', 'event', 'Keyboard Download Promotion (25%)', 'Click (step 1)', keyboard);
  });

  // Install keyboard into Keyman for iOS (already installed)
  $('#ios-installed').on('click', function() {
    var keyboard = $('#download-cta').data('keyboard');
    ga('send', 'event', 'Keyman for iOS', 'Keyboard Download', keyboard);
  });

  // Download Keyman for iOS
  $('#ios-install-confirm').on('click', function() {
    var keyboard = $('#download-cta').data('keyboard');
    ga('send', 'event', 'Keyman for iOS', 'App Store Link Click', keyboard);
  });

  // Install keyboard into Keyman for Android (already installed)
  $('#android-installed').on('touchend', function() {
    var keyboard = $('#download-cta').data('keyboard');
    ga('send', 'event', 'Keyman for Android', 'Keyboard Download', keyboard);
  });

  // Download Keyman for Android
  $('#android-install-confirm').on('click', function() {
    var keyboard = $('#download-cta').data('keyboard');
    ga('send', 'event', 'Keyman for Android', 'App Store Link Click', keyboard);
  });

  // Mailchimp form signup
  $('#mc-embedded-subscribe-form').on('submit', function() {
    var keyboard = $('#download-cta').data('keyboard');
    ga('send', 'event', 'Mailing List', 'Signup (footer)', keyboard);
  });

  // Desktop features clicker
  $('.info-left li').click(function(){
    $('.info-left>ul>li.active').removeClass('active');
    $(this).addClass('active');
  });

  // Desktop feature scroller
  $(window).on('scroll', function() {
    var scrollTop = $(this).scrollTop();
    $('.section').each(function() {
        var topDistance = $(this).offset().top;
        if ( (topDistance + 300) > scrollTop && (topDistance) < scrollTop + 90) {
          // Do something
	  $('.info-left>ul>li.active').removeClass('active');
	  $('a[href="#'+$(this).attr('id')+'"]').parent('li').addClass('active');
        }
    });
  });
}

/* Handling deprecated keyboards */

function toggleDeprecatedVersionDetails() {
  $('#deprecated-old').toggle();
}

loaded();
