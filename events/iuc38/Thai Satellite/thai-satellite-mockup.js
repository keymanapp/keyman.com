// Extend jQuery.fn with our new method
jQuery.extend( jQuery.fn, {
    // Name of our method & one argument (the parent selector)
    within: function( pSelector ) {
        // Returns a subset of items using jQuery.filter
        return this.filter(function(){
            // Return truthy/falsey based on presence in parent
            return $(this).closest( pSelector ).length;
        });
    }
});

$(function() {

  var selected = null, firstTime = true, vowelTimeout = null, pauseTimeout = null, pauseKey = null, newContent = null, ox, oy,
  
  documentTouchEnd = function(event) {
    var currentTarget = document.elementFromPoint(event.originalEvent.changedTouches[0].pageX, event.originalEvent.changedTouches[0].pageY);
    if($(currentTarget).hasClass('key') && $(currentTarget).within('.vowels')) {
      pauseKey = currentTarget;  
      pauseOnKey();
    }
    cleanup();
  },

  cleanup = function() {
    $('.base').removeClass('touched');
    $(selected).removeClass('touched');
    $(document).off('touchmove', documentTouchMove);
    $(document).off('touchend', documentTouchEnd);  
    $('.vowels').css('display', '');
    if(vowelTimeout) {
      window.clearTimeout(vowelTimeout);
      vowelTimeout = null;
    }
    if(pauseTimeout) {
      window.clearTimeout(pauseTimeout);
      pauseTimeout = null;
    }
    selected = null;
    pauseKey = null;
    newContent = null;
  },
  
  documentTouchCancel = function() {
    $('#text').val(newContent.original);
    cleanup();
  },
  
  showVowels = function() {
    if(firstTime) {
      $('.base').addClass('touched');
      $(selected).addClass('touched');
      $('.vowels')
        .css('left', $(selected).position().left)
        .css('top', $(selected).position().top);
      firstTime = false;
      if(vowelTimeout) {
        window.clearTimeout(vowelTimeout);
        vowelTimeout = null;
      }
    }
  },
  
  pauseOnKey = function() {
    var val = $(pauseKey).text();
    if($(pauseKey).hasClass('prefix')) {
      newContent.prefix = val;
      $('.vowels').attr('class', 'vowels show-left');
    } else if($(pauseKey).hasClass('suffix')) {
      newContent.suffix = val;
      $('.vowels').attr('class', 'vowels show-right');
    } else if($(pauseKey).hasClass('diacritic')) {
      newContent.diacritic = val;
      $('.vowels').attr('class', 'vowels show-above');
    } else if($(pauseKey).hasClass('diacritic-below')) {
      newContent.diacritic = val;
      $('.vowels').attr('class', 'vowels show-below');
    } else if($(pauseKey).hasClass('tone')) {
      newContent.tone = val;
    }
    constructText();
  },
  
  constructText = function() {
    $('#text').val( 
      newContent.original + 
      newContent.prefix + 
      newContent.consonant + 
      newContent.diacritic + 
      newContent.tone + 
      newContent.suffix );
  }
  
  distance = function(x1,y1,x2,y2) {
    return Math.sqrt((x2-x1)*(x2-x1) + (y2-y1)*(y2-y1));
  }
  
  documentTouchMove = function(event) {
    var currentTarget = document.elementFromPoint(event.originalEvent.touches[0].pageX, event.originalEvent.touches[0].pageY);
    if(distance(ox, oy, event.originalEvent.touches[0].pageX, event.originalEvent.touches[0].pageY) > 5) {
      showVowels();
    }
    if(pauseTimeout) {
      window.clearTimeout(pauseTimeout);
    }
    if($(currentTarget).hasClass('key') && $(currentTarget).within('.vowels')) {
      pauseTimeout = window.setTimeout(pauseOnKey, 50);
      pauseKey = currentTarget;
    } else {
      pauseKey = pauseTimeout = null;
    }
  };
  
  $('.base > .key').on('touchstart', function(event) {
    if($(this).attr('id') == 'spacebar') {
      $('#text').val($('#text').val() + ' ');
      event.preventDefault();
      return true;
    }
    else if($(this).attr('id') == 'bksp') {
      $('#text').val($('#text').val().slice(0,-1));
      event.preventDefault();
      return true;
    }
    selected = this;
    $('.vowels').attr('class', 'vowels');  // show no tones initially
    newContent = {
      original: $('#text').val(),
      consonant: $(selected).text(),
      prefix: '',
      suffix: '',
      diacritic: '',
      tone: ''
    };
    firstTime = true;
    ox = event.originalEvent.touches[0].pageX;
    oy = event.originalEvent.touches[0].pageY;
    vowelTimeout = window.setTimeout(showVowels, 250);
    $(document).on('touchmove', documentTouchMove);
    $(document).on('touchend', documentTouchEnd); 
    $(document).on('touchcancel', documentTouchCancel);
    constructText();
    event.preventDefault();
  });
  
  // Support bksp only for cleanup
  $(document).keydown(function(event) {
    if(event.which == 8) {
      $('#text').val($('#text').val().slice(0,-1));
      event.preventDefault();
    }
  });
  
  // This prevents long-hold showing the context menu on Chrome
  $(document).on('contextmenu', function(event) {
    event.preventDefault();
  });
});