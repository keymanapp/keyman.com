if(typeof embed_query == 'undefined') {
  var embed_query = '';
}
var embed_query_q = embed_query == '' ? '' : '?'+embed_query;
var embed_query_x = embed_query == '' ? '' : '&'+embed_query;

/////////////////////////////////////////////////////////////////////////////////////
// Search functionality.
/////////////////////////////////////////////////////////////////////////////////////

var counter = 0;

function search(updateHistory) {
  wrapSearch(++counter, updateHistory);
}

function wrapSearch(localCounter, updateHistory) {
  var q = document.f.q.value;
  // Workaround for HTML form encoding spaces with "+", which breaks keyboard searches
  q = q.replace(/\+/g, ' ');
  document.f.q.value = q;
  if(q == '') {
    var resultsElement = $('#search-results');
    resultsElement.empty().append('<p>Enter the name of a keyboard or language to search for.</p>');
    return false;
  }

  if(!history.pushState && updateHistory) {
    location.href = '/keyboards?q='+encodeURIComponent(q)+embed_query_x;
    return false;
  }

  $('#search-box').addClass('searching');

  // TODO: setup a base hosts.js file?
  var base =
    location.host === 'staging-keyman-com.azurewebsites.net' ?
    location.protocol+'//staging-api-keyman-com-azurewebsites.net' :
    location.protocol+'//api.'+location.host; // this works on test sites as well as live, assuming we use the host pattern "keyman.com[.local]"

  var url = base+'/search/2.0?q='+encodeURIComponent(q);

  if(embed) {
    url += '&embed='+embed;
  }

  var xhr = createCORSRequest('GET', url);

  xhr.onload = function() {
    if(counter > localCounter) {
      // out of order response, or later query
      return;
    }

    var responseText = xhr.responseText;

    //hide_loading();
    $('#search-box').removeClass('searching');
    if(updateHistory && history.pushState) {
      var r = q.match(/^(c(ountry)?|l(anguage)?)\:(iso|id)\:(.+)$/);
      if(r && r[1].charAt(0) == 'c') {
        history.pushState({q: q, text: responseText}, q + ' - Keyboard search', '/keyboards/countries/'+r[5]);
      } else if(r && r[1].charAt(0) == 'l') {
        history.pushState({q: q, text: responseText}, q + ' - Keyboard search', '/keyboards/languages/'+r[5]);
      } else {
        history.pushState({q: q, text: responseText}, q + ' - Keyboard search', '/keyboards?q='+encodeURIComponent(q));
      }
    }
    process_response(q, xhr.responseText);
    // process the response.
  };

  xhr.onerror = function() {
    if(window.console) {
      console.log('There was an error: '+xhr.statusText);
    } else {
      alert('Error contacting Keyman server: '+xhr.statusText);
    }
  };

  //show_loading();

  xhr.send();

  return true;
}

window.onpopstate = function(e) {
  if(e.state) {
    process_response(e.state.q, e.state.text);
    $('#search-q').val(e.state.q);
    return true;
  } else return false;
};

function process_response(q, res) {
  var resultsElement = $('#search-results');
  res = JSON.parse(res);
  resultsElement.empty();

  if(res.keyboards) {
    var deprecatedElement = null;

    $('<h3>').addClass('red underline').text(res.rangetext ? res.rangetext : "Keyboards matching '"+q+"'").appendTo(resultsElement);

    document.title = q + ' - Keyboard search';

    res.keyboards.forEach(function(kbd) {

      // Remove irrelevant keyboards

      if(kbd.deprecated && !deprecatedElement) {
        // TODO: make title change depending on whether deprecated keyboards are shown or hidden
        deprecatedElement = $('<div class="keyboards-deprecated"><h4 class="red">Show obsolete keyboards</h4></div>');
        deprecatedElement.find('h4').click(function() {deprecatedElement.toggleClass('show');});
        resultsElement.append(deprecatedElement);
      }

      var k = $(
        "<div class='keyboard'>"+
          "<div class='title'><a></a><span class='match'></span></div>"+
          "<div class='detail'>"+
            "<div class='id-downloads'><div class='id'></div>"+
            "<div class='downloads'></div></div>"+
            "<div class='encoding'></div>"+
            "<div class='description'></div>"+
            "<div class='platforms'></div>"+
          "</div>"+
        "</div>");

      $('.title a', k).text(kbd.name).attr('href', '/keyboards/'+kbd.id+embed_query_q);

      if(kbd.match.downloads == 0)
        $('.downloads', k).text('No recent downloads');
      else if(kbd.match.downloads == 1)
        $('.downloads', k).text(kbd.match.downloads+' monthly download');
      else
        $('.downloads', k).text(kbd.match.downloads+' monthly downloads');

      if(!kbd.encodings.toString().match(/unicode/)) {
        $('.encoding', k).text('Note: Not a Unicode keyboard');
      }

      $('.id', k).text(kbd.id);
      $('.description', k).html(kbd.description);

      switch(kbd.match.type) {
        case 'keyboard': $('.title a', k).mark(q); break; // don't annotate
        case 'keyboard_id': $('.id', k).mark(q); break; // don't annotate
        case 'language': $('.title .match', k).text('('+kbd.match.name+' language)').mark(q); break;
        case 'region': $('.title .match', k).text('('+kbd.match.name+')').mark(q); break;
        case 'script': $('.title .match', k).text('('+kbd.match.name+' script)').mark(q); break;
        case 'description': $('.description', k).mark(q); break;
      }

      if(kbd.platformSupport) {
        for(var i in kbd.platformSupport) {
          if(kbd.platformSupport[i] != 'none') {
            // icon-android
            // icon-macos
            // icon-web
            // icon-ios
            // icon-linux
            // icon-windows
            var img = $('<img>').attr('src', '/cdn/dev/keyboard-search/icon-'+i+'.png').attr('title', 'Designed for '+i);
            $('.platforms', k).append(img);
          }
        }
      }
      $('.platforms', k).text();
      (deprecatedElement ? deprecatedElement : resultsElement).append(k);
    });
  }
  if(res.languages) {
    if(q != 'l:*') {
      $('<h3>').addClass('red underline').text(res.rangetext && !res.keyboards ? res.rangetext : "Languages matching '"+q+"'").appendTo(resultsElement);
    } else {
      $('<h3>').addClass('red underline').text('Choose a language').appendTo(resultsElement);
    }

    // Build the language list

    var p = null, first = '';
    res.languages.forEach(function(l) {

      var e = $(
        "<div class='language'>"+
          "<div class='title'><a></a></div>"+
        "</div>");
      var e2 = $('.title a', e).text(l.name).attr('href', '/keyboards/languages/'+l.id+embed_query_q);

      e2.click(function() {
        document.f.q.value = 'l:id:'+l.id;
        return do_search();
      });

      (p ? p : resultsElement).append(e);
    });
  }

  if(res.countries) {
    $('<h3>').addClass('red underline').text(res.rangetext && !res.keyboards ? res.rangetext : "Countries matching '"+q+"'").appendTo(resultsElement);
    res.countries.forEach(function(c) {
      var e = $(
        "<div class='country'>"+
          "<div class='title'><a></a></div>"+
        "</div>");
      var e2 = $('.title a', e).text(c.name).attr('href', '/keyboards/countries/'+c.id+embed_query_q);

      e2.click(function() {
        document.f.q.value = 'c:id:'+c.id;
        return do_search();
      });
      resultsElement.append(e);
    });
  }
  if(!res.keyboards && !res.languages && !res.countries) {
    $('<h3>').addClass('red').text("No matches found for '"+q+"'").appendTo(resultsElement);
  }
}

function do_search() {
  search(true);
  return false; // always return false from search box
}

function createCORSRequest(method, url) {
  var xhr = new XMLHttpRequest();
  xhr.open(method, url, true);
  return xhr;
}

var dynamic_search_timeout = 0;

var load_search_count = 0, load_search = function() {
  // Because load order of jQuery may be after load_search, we should wait
  // for it to load. Note: this could loop forever if jQuery fails to load.
  // Resolving that is more work than we want to undertake right now.
  if(typeof $ == 'undefined' ) {
    window.setTimeout(load_search, 10);
    return false;
  }

  if(typeof window.doInit != 'undefined') {
    window.doInit();
    return false;
  }

  $('#search-q').on('input', function() {
    if(dynamic_search_timeout) window.clearTimeout(dynamic_search_timeout);
    dynamic_search_timeout = window.setTimeout(function() {
      search(false);
    }, 250);
  });

  var init = function(value) {
    document.f.q.value = decodeURIComponent(value);
    search(false);
    return true;
  }


  var params = location.pathname.match(/\/keyboards\/languages\/(.+)$/);
  if(params) {
    return init('l:id:'+params[1]);
  }

  params = location.pathname.match(/\/keyboards\/countries\/(.+)$/);
  if(params) {
    return init('c:id:'+params[1]);
  }

  params = location.search.substr(1).split('&');
  for(var i = 0; i < params.length; i++) {
    var p = params[i].split('=');
    if(p.length == 2 && p[0] == 'q') {
      return init(p[1]);
    }
  }

  return false;
};

window.addEventListener('load', load_search, false);
