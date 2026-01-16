var loadedCount = 50;

function loaded(){
  // keymanapp/keyman#7915: Fix for iPadOS fudging its user-agent into 'mac' when running in 'desktop' mode
  if(document.body && document.body.dataset.device == 'mac' && navigator.maxTouchPoints > 0) {
    document.body.dataset.device = 'iPad';
  }

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

  $('#testimonial').click(function(){
    location.href="/testimonials/";
  });

  $('#twitter-testimonial').click(function() {
      location.href=this.dataset.href;//"https://twitter.com/ibrahimasaar/status/1161753102527193088";
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
  $('#top-menu-icon,#help1').addClass('help1-on-scroll');
	$('.info-left').addClass('fixed-pos');
      }else if ($(this).scrollTop() < (scroller_anchor + 1) && $('#top-menu1').css('position') != 'absolute'){
	$('#top-menu1').removeClass('faded-menu');
	$('#top-menu-icon,#help1').hide();
  $('#top-menu-icon,#help1').removeClass('help1-on-scroll');
	$('.info-left').removeClass('fixed-pos');
      }
    });
    var scroller_anchor = $(".header").height();
    if ($(this).scrollTop() >= scroller_anchor && $('#top-menu1').css('position') != 'fixed'){
      $('#top-menu1').addClass('faded-menu');
      $('#top-menu-icon,#help1').show();
      $('#top-menu-icon,#help1').addClass('help1-on-scroll');
      $('.info-left').addClass('fixed-pos');
    }else if ($(this).scrollTop() < (scroller_anchor + 1) && $('#top-menu1').css('position') != 'absolute'){
      $('#top-menu1').removeClass('faded-menu');
      $('#top-menu-icon,#help1').hide();
      $('#top-menu-icon,#help1').removeClass('help1-on-scroll');
      $('.info-left').removeClass('fixed-pos');
    }
  }
  $('#show-phone-menu').click(function(event) {
    $("#phone-menu").toggleClass('menu-visible');
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
    }else if (platform == 'Linux') {
      if(keyboard && language) {
        window.location.href = '/keyboards/'+keyboard;
      } else {
        window.location.href = '/linux/download.php';
      }
    }else if (platform == 'Windows') {
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

  /* While search box in Keyboards menu is focused, make its parent always visible */

  $("#language-search").on('focus', function() {
    $('#keyboards').addClass('menu-item-force');
  }).on('blur', function() {
    $('#keyboards').removeClass('menu-item-force');
  });
}

/* Handling deprecated keyboards */

function toggleDeprecatedVersionDetails() {
  $('#deprecated-old').toggle();
}

$(loaded);
