if(typeof embed_query == 'undefined') {
  var embed_query = '';
}

var embed_query_q = embed_query == '' ? '' : '?'+embed_query;
var embed_query_x = embed_query == '' ? '' : '&'+embed_query;

/////////////////////////////////////////////////////////////////////////////////////
// Search functionality.
/////////////////////////////////////////////////////////////////////////////////////

var counter = 0;

function getCurrentPath(q, page) {
  var r = q.match(/^(c|l)\:(id)\:(.+)$/);
  if(r && r[1].charAt(0) == 'c') {
    return '/keyboards/countries/'+r[3]+'?page='+page;
  } else if(r && r[1].charAt(0) == 'l') {
    return '/keyboards/languages/'+r[3]+'?page='+page;
  } else {
    return '/keyboards?q='+encodeURIComponent(q)+'&page='+page;
  }
}

function search(updateHistory) {
  wrapSearch(++counter, updateHistory);
}

function wrapSearch(localCounter, updateHistory) {
  var page = parseInt(document.f.page.value, 10);
  if(isNaN(page) || page < 1 || page > 999) page = 1;

  var q = document.f.q.value;
  // Workaround for HTML form encoding spaces with "+", which breaks keyboard searches
  q = q.replace(/\+/g, ' ');
  document.f.q.value = q;
  if(q == '') {
    var resultsElement = $('#search-results');
    resultsElement.empty().append('<p>Enter the name of a keyboard or language to search for.</p>');
    return false;
  }

  $('#search-box').addClass('searching');

  // TODO: setup a base hosts.js file?
  var base =
    location.host === 'staging-keyman-com.azurewebsites.net' ?
    location.protocol+'//staging-api-keyman-com-azurewebsites.net' :
    location.protocol+'//api.'+location.host; // this works on test sites as well as live, assuming we use the host pattern "keyman.com[.local]"

  var url = base+'/search/2.0?p='+page+'&q='+encodeURIComponent(q);

  if(embed) {
    url += '&embed='+embed;
  }

  if(detail_page) {
    location.href = getCurrentPath(q, page);
    return false;
  }

  var xhr = createCORSRequest('GET', url);

  var currentPath = getCurrentPath(q, page);

  xhr.onload = function() {
    if(counter > localCounter) {
      // out of order response, or later query
      return;
    }

    var responseText = xhr.responseText;

    //hide_loading();
    $('#search-box').removeClass('searching');
    currentPath = getCurrentPath(q, page);
    if(updateHistory) {
      history.pushState({q: q, text: responseText}, q + ' - Keyboard search', currentPath);
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

  var qq = res.context && res.context.text ? res.context.text : q;

  if(res.keyboards) {
    var deprecatedElement = null;

    $('<h3>').addClass('red underline').text(res.context.range ? res.context.range : "Keyboards matching '"+q+"'").appendTo(resultsElement);

    $('<div class="statistics">').text(res.context.totalRows + ' results; page '+res.context.pageNumber + ' of '+res.context.totalPages+'.').appendTo(resultsElement);

    /* not sure if we want this here:
    if(res.context.totalPages > 1) {
      buildPager(res, q).appendTo(resultsElement);
    }*/

    document.title = q + ' - Keyboard search';

    console.log(res.context);

    res.keyboards.forEach(function(kbd) {

      // Remove irrelevant keyboards

      if(kbd.deprecated && !deprecatedElement) {
        // TODO: make title change depending on whether deprecated keyboards are shown or hidden
        deprecatedElement = $(
          '<div class="keyboards-deprecated"><h4 class="red underline">Obsolete keyboards</h4></div>');
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

      $('.title a', k).text(kbd.name).attr('href', '/keyboards/'+kbd.id+(kbd.match.tag ? '?tag='+kbd.match.tag+embed_query_x : embed_query_q));

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
        case 'keyboard': $('.title a', k).mark(qq); break; // don't annotate
        case 'keyboard_id': $('.id', k).mark(qq); break; // don't annotate
        // case keyboard_legacy_id: // nothing to annotate, currently, and it's a bit ancient so let's not stress over it
        case 'language': $('.title .match', k).text('('+kbd.match.name+' language)').mark(qq); break;
        case 'language_bcp47_tag': $('.title .match', k).text('(language, BCP 47 tag \''+kbd.match.name+'\')').mark(qq); break;
        case 'country': $('.title .match', k).text('('+kbd.match.name+')').mark(qq); break;
        case 'country_iso3166_code': $('.title .match', k).text('(country, ISO 3166 code \''+kbd.match.name+'\')').mark(qq); break;
        case 'script': $('.title .match', k).text('('+kbd.match.name+' script)').mark(qq); break;
        case 'script_iso15924_code': $('.title .match', k).text('(script, ISO 15924 code \''+kbd.match.name+'\')').mark(qq); break;
        case 'description': $('.description', k).mark(qq); break;
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

    if(res.context.totalPages > 1) {
      buildPager(res, q).appendTo(resultsElement);
    }
  } else {
    $('<h3>').addClass('red').text("No matches found for '"+qq+"'").appendTo(resultsElement);
  }
}

function buildPager(res, q) {
  var pager = $('<div class="pager">');
  function appendPager(pager, text, page) {
    if(page != res.context.pageNumber && page > 0 && page <= res.context.totalPages) {
      $('<a>'+text+'</a>').attr('href', getCurrentPath(q, page)).click((event) => goToPage(event, q, page)).appendTo(pager);
    } else {
      $('<span>'+text+'</span>').appendTo(pager);
    }
  }

  appendPager(pager, '&lt; Previous', res.context.pageNumber-1);
  if(res.context.pageNumber > 5) {
    ('<span>...</span>').appendTo(pager);
  }
  for(var i = Math.max(1, res.context.pageNumber - 4); i <= Math.min(res.context.totalPages, res.context.pageNumber + 4); i++) {
    appendPager(pager, i, i);
  }
  if(res.context.pageNumber < res.context.totalPages - 4) {
    $('<span>...</span>').appendTo(pager);
  }
  appendPager(pager, 'Next &gt;', res.context.pageNumber+1);
  return pager;
}

function goToPage(event, q, page) {
  page = parseInt(page, 10);
  if(isNaN(page)) page = 1;
  document.f.q.value = decodeURIComponent(q);
  document.f.page.value = page;

  event.preventDefault();
  search(true);
  window.scrollTo(0, 0);
  return false;
}

function do_search() {
  document.f.page.value = 1;
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

  if(!detail_page) {
    $('#search-q').on('input', function() {
      if(dynamic_search_timeout) window.clearTimeout(dynamic_search_timeout);
      dynamic_search_timeout = window.setTimeout(function() {
        if(document.f.q.value.length > 2) {
          document.f.page.value = 1;
          search(false);
        }
      }, 250);
    });
  }

  var init = function(value, page, updateHistory) {
    page = parseInt(page, 10);
    if(isNaN(page)) page = 1;
    document.f.q.value = decodeURIComponent(value);
    document.f.page.value = page;

    search(!!updateHistory);
    return value != '';
  }

  // Get initial search

  var page = 1, q = '', params = location.search.substr(1).split('&');
  for(var i = 0; i < params.length; i++) {
    var p = params[i].split('=');
    if(p.length == 2 && p[0] == 'q') {
      q = decodeURIComponent(p[1]);
    } else if(p.length == 2 && p[0] == 'page') {
      page = decodeURIComponent(p[1]);
    }
  }


  params = location.pathname.match(/\/keyboards\/languages\/(.+)$/);
  if(params) {
    q = 'l:id:'+params[1];
  } else {
    params = location.pathname.match(/\/keyboards\/countries\/(.+)$/);
    if(params) {
      q = 'c:id:'+params[1];
    }
  }

  return init(q, page);
};

window.addEventListener('load', load_search, false);
