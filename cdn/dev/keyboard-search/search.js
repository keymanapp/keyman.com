if(typeof embed_query == 'undefined') {
  var embed_query = '';
}

var embed_query_q = embed_query == '' ? '' : '?'+embed_query;
var embed_query_x = embed_query == '' ? '' : '&'+embed_query;

/////////////////////////////////////////////////////////////////////////////////////
// Search functionality.
/////////////////////////////////////////////////////////////////////////////////////

var counter = 0;

function getCurrentPath(q, page, obsolete) {
  var r = q.match(/^(c|l)\:(id)\:(.+)$/);
  obsolete = obsolete ? '&obsolete=1' : '';
  if(r && r[1].charAt(0) == 'c') {
    return '/keyboards/countries/'+r[3]+'?page='+page+obsolete;
  } else if(r && r[1].charAt(0) == 'l') {
    return '/keyboards/languages/'+r[3]+'?page='+page+obsolete;
  } else {
    return '/keyboards?q='+encodeURIComponent(q)+'&page='+page+obsolete;
  }
}

function search(updateHistory) {
  wrapSearch(++counter, updateHistory);
}

function wrapSearch(localCounter, updateHistory) {
  var page = parseInt(document.f.page.value, 10);
  if(isNaN(page) || page < 1 || page > 999) page = 1;

  var obsolete = document.f.obsolete.value == 1;

  var q = document.f.q.value;
  // Workaround for HTML form encoding spaces with "+", which breaks keyboard searches
  q = q.replace(/\+/g, ' ');
  document.f.q.value = q;
  if((!updateHistory && q.trim().length < 3) || q.trim().length == 0) {
    var resultsElement = $('#search-results');
    resultsElement.empty();
    doUpdateHistory(q, page, obsolete, '', updateHistory);
    return false;
  }

  $('#search-box').addClass('searching');

  var base = location.protocol+'//api.'+location.host; // this works on test sites as well as live, assuming we use the host pattern "keyman.com[.local]"

  var url = base+'/search/2.0?p='+page+'&q='+encodeURIComponent(stripCommonWords(q));

  if(embed) {
    url += '&platform='+embed;
  }

  if(obsolete) {
    url += '&obsolete='+obsolete;
  }

  var xhr = createCORSRequest('GET', url);

  function stripCommonWords(q) {
    return q.replace(/\b(keyboard|language|script|font)\b/g, '').trim();
  }

  xhr.onload = function() {
    if(counter > localCounter) {
      // out of order response, or later query
      return;
    }

    var responseText = xhr.responseText;

    //hide_loading();
    $('#search-box').removeClass('searching');
    doUpdateHistory(q, page, obsolete, responseText, updateHistory);
    process_response(q, obsolete, xhr.responseText);
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

function doUpdateHistory(q, page, obsolete, text, updateHistory) {
  var currentPath = getCurrentPath(q, page, obsolete);

  if(updateHistory) {
    history.pushState({q: q, obsolete: obsolete, text: text}, q + ' - Keyboard search', currentPath);
  } else if(history && history.replaceState) {
    history.replaceState({q: q, obsolete: obsolete, text: text}, q + ' - Keyboard search', currentPath);
  }
}

window.onpopstate = function(e) {
  if(e.state) {
    process_response(e.state.q, e.state.obsolete, e.state.text);
    $('#search-q').val(e.state.q);
    return true;
  } else return false;
};

function process_page_match(q) {
  q = q.toLowerCase();
  var page = dedicatedLandingPages.find(function(p) {
    var term = p.terms.find(function(t) {
      return t.startsWith(q);
    });
    return term !== undefined;
  });
  if(page === undefined) return null;

  var result = {
    description: page.description,
    id: page.id,
    name: page.name,
    encodings: ["unicode"],
    isDedicatedLandingPage: true,
    match: {type: "description"},
    platformSupport: {}
  };
  return result;
}

function process_response(q, obsolete, res) {
  var resultsElement = $('#search-results');
  res = JSON.parse(res);
  resultsElement.empty();

  var qq = res.context && res.context.text ? res.context.text : q;


  var pageMatch = process_page_match(q);
  if(pageMatch) {
    if(!res.keyboards) {
      res.keyboards = [];
    }
    if(res.context.pageNumber == 1) {
      res.keyboards.unshift(pageMatch);
    }
    res.context.totalRows++;
  }

  if(res.keyboards) {
    var deprecatedElement = null;

    $('<div class="statistics">').text(
      res.context.totalRows + (res.context.totalRows == 1 ? ' result' : ' results') +
      (res.context.totalPages < 2 ? '' : '; page '+res.context.pageNumber + ' of '+res.context.totalPages+'.')
    ).appendTo(resultsElement);

    document.title = q + ' - Keyboard search';

    res.keyboards.forEach(function(kbd) {

      if(isKeyboardObsolete(kbd) && !deprecatedElement) {
        // TODO: make title change depending on whether deprecated keyboards are shown or hidden
        deprecatedElement = $(
          '<div class="keyboards-deprecated"><h4 class="red underline">Obsolete keyboards</h4></div>');
        resultsElement.append(deprecatedElement);
      }

      $keyboardClass = kbd.isDedicatedLandingPage ? 'keyboard keyboardLandingPage' : 'keyboard';

      var k = $(
        "<div class='"+$keyboardClass+"'>"+
          "<div class='title'><a></a><span class='match'></span></div>"+
          "<div class='detail'>"+
            "<div class='id-downloads'><div class='id'></div>"+
            "<div class='downloads'></div></div>"+
            "<div class='encoding'></div>"+
            "<div class='description'></div>"+
            "<div class='platforms'></div>"+
          "</div>"+
        "</div>");

      if(kbd.isDedicatedLandingPage) {
        $('.title a', k).text(kbd.name).attr('href', kbd.id+embed_query_q);
      } else {
        $('.title a', k).text(kbd.name).attr('href', '/keyboards/'+kbd.id+(kbd.match.tag ? '?bcp47='+kbd.match.tag+embed_query_x : embed_query_q));
      }

      if(kbd.isDedicatedLandingPage) {
        // We won't show the downloads text
      } else if(kbd.match.downloads == 0)
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
        case 'description': $('.description', k).mark(qq); $('.title a', k).mark(qq); break;
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
      buildPager(res, q, obsolete).appendTo(resultsElement);
    }
  } else {
    $('<h3>').addClass('red').text("No matches found for '"+qq+"'").appendTo(resultsElement);
  }
}

function buildPager(res, q, obsolete) {
  var pager = $('<div class="pager">');
  function appendPager(pager, text, page) {
    if(page != res.context.pageNumber && page > 0 && page <= res.context.totalPages) {
      $('<a>'+text+'</a>').attr('href', getCurrentPath(q, page, obsolete)).click(function(event) { return goToPage(event, q, page)}).appendTo(pager);
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

  $('#search-q').on('input', function() {
    if(dynamic_search_timeout) window.clearTimeout(dynamic_search_timeout);
    dynamic_search_timeout = window.setTimeout(function() {
      document.f.page.value = 1;
      search(false);
    }, 250);
  });

  $('#search-results-empty code').click(function(tag) {
    const prefix = this.innerText;
    document.f.q.value = document.f.q.value.replace(/^.+:([^:]*)$/, '$1') +
      (document.f.q.value.startsWith(prefix) ? '' : prefix);
    document.f.q.focus();
  });

  var init = function(value, page, obsolete, updateHistory) {
    page = parseInt(page, 10);
    if(isNaN(page)) page = 1;
    document.f.q.value = decodeURIComponent(value);
    document.f.page.value = page;
    document.f.obsolete.value = obsolete;
    search(!!updateHistory);
    return value != '';
  }

  // Get initial search

  var page = 1, obsolete = 0, q = '', params = location.search.substr(1).split('&');
  for(var i = 0; i < params.length; i++) {
    var p = params[i].split('=');
    if(p.length == 2 && p[0] == 'q') {
      q = decodeURIComponent(p[1]);
    } else if(p.length == 2 && p[0] == 'page') {
      page = decodeURIComponent(p[1]);
    } else if(p.length == 2 && p[0] == 'obsolete') {
      obsolete = decodeURIComponent(p[1]);
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

  return init(q, page, obsolete);
};

function isKeyboardObsolete(kbd) {
  return kbd.deprecated || (typeof kbd.encodings.includes === 'function' && !kbd.encodings.includes('unicode'));
}

window.addEventListener('load', load_search, false);
