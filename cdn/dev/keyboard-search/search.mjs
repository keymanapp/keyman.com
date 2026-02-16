import { I18n } from '../js/i18n/i18n.mjs';

// Polyfill for String.prototype.includes

if (!String.prototype.includes) {
  String.prototype.includes = function(search, start) {
    'use strict';

    if (search instanceof RegExp) {
      throw TypeError('first argument must not be a RegExp');
    }
    if (start === undefined) { start = 0; }
    return this.indexOf(search, start) !== -1;
  };
}

const t = I18n.t;

/////////////////////////////

if(typeof embed_query == 'undefined') {
  var embed_query = '';
}

var embed_query_q = embed_query == '' ? '' : '?'+embed_query;
var embed_query_x = embed_query == '' ? '' : '&'+embed_query;

var dynamic_search_timeout = 0;

/////////////////////////////////////////////////////////////////////////////////////
// Search functionality.
/////////////////////////////////////////////////////////////////////////////////////

var counter = 0;

function getCurrentPath(q, page, obsolete) {
  q = q.trim();
  var r = q.match(/^(c|l)\:(id)\:(.+)$/);
  obsolete = obsolete ? '&obsolete=1' : '';
  page = page > 1 ? 'page='+page : '';
  var path = '';
  if(r && r[1].charAt(0) == 'c') {
    path = '/keyboards/countries/';
  } else if(r && r[1].charAt(0) == 'l') {
    path = '/keyboards/languages/'+r[3];
  } else if(q == '') {
    path = '/keyboards'
  } else {
    path = '/keyboards?q='+encodeURIComponent(q);
  }

  if(page + obsolete == '') {
    return path;
  }

  return path + (path.includes('?') ? '&' : '?') + page + obsolete;
}

function clearDynamicSearchTimeout() {
  if(dynamic_search_timeout) {
    window.clearTimeout(dynamic_search_timeout);
    dynamic_search_timeout = 0;
  }
}

function search(updateHistory) {
  clearDynamicSearchTimeout();
  wrapSearch(++counter, updateHistory);
}

function wrapSearch(localCounter, updateHistory) {
  $('#search-box').addClass('searching');

  var page = parseInt(document.f.page.value, 10);
  if(isNaN(page) || page < 1 || page > 999) page = 1;

  var obsolete = document.f.obsolete.value == 1;

  var q = document.f.q.value;
  // Workaround for HTML form encoding spaces with "+", which breaks keyboard searches
  q = q.replace(/\+/g, ' ');
  document.f.q.value = q;
  if((!updateHistory && q.trim().length < 2) || q.trim().length == 0) {
    var resultsElement = $('#search-results');
    resultsElement.empty();
    if(updateHistory)
      doUpdateHistory(q, page, obsolete, '{"context":{}}', updateHistory);
    $('#search-box').removeClass('searching');
    return false;
  }
  
  var base = 'https://api.keyman.com'; // Don't commit to production - location.protocol+'//api.'+location.host; // this works on test sites as well as live, assuming we use the host pattern "keyman.com[.localhost]"
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
    $('#search-box').removeClass('searching');
    if(counter > localCounter) {
      // out of order response, or later query
      return;
    }

    doUpdateHistory(q, page, obsolete, xhr.responseText, updateHistory);
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
  } else {
    prepareInitialSearch();
    return true;
  }
};

// https://tc39.github.io/ecma262/#sec-array.prototype.find
// Used for Android 5.0 and earlier with old old Chrome
if (!Array.prototype.find) {
  Object.defineProperty(Array.prototype, 'find', {
    value: function(predicate) {
      // 1. Let O be ? ToObject(this value).
      if (this == null) {
        throw TypeError('"this" is null or not defined');
      }

      var o = Object(this);

      // 2. Let len be ? ToLength(? Get(O, "length")).
      var len = o.length >>> 0;

      // 3. If IsCallable(predicate) is false, throw a TypeError exception.
      if (typeof predicate !== 'function') {
        throw TypeError('predicate must be a function');
      }

      // 4. If thisArg was supplied, let T be thisArg; else let T be undefined.
      var thisArg = arguments[1];

      // 5. Let k be 0.
      var k = 0;

      // 6. Repeat, while k < len
      while (k < len) {
        // a. Let Pk be ! ToString(k).
        // b. Let kValue be ? Get(O, Pk).
        // c. Let testResult be ToBoolean(? Call(predicate, T, « kValue, k, O »)).
        // d. If testResult is true, return kValue.
        var kValue = o[k];
        if (predicate.call(thisArg, kValue, k, o)) {
          return kValue;
        }
        // e. Increase k by 1.
        k++;
      }

      // 7. Return undefined.
      return undefined;
    },
    configurable: true,
    writable: true
  });
}

if (!String.prototype.startsWith) {
  Object.defineProperty(String.prototype, 'startsWith', {
      value: function(search, rawPos) {
          var pos = rawPos > 0 ? rawPos|0 : 0;
          return this.substring(pos, pos + search.length) === search;
      }
  });
}

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

  if(qq == '') {
    var resultsElement = $('#search-results');
    resultsElement.empty();
    return;
  }


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
      res.context.totalRows + ' ' + (res.context.totalRows == 1 ? t('resultOne') : t('resultMore') )+ ' ' +
      (res.context.totalPages < 2 ? '' : t('pageNumberOfTotalPages', {pageNumber: res.context.pageNumber, totalPages: res.context.totalPages}))
    ).appendTo(resultsElement);

    document.title = q + ' ' + t('keyboardSearchTitle');

    res.keyboards.forEach(function(kbd) {

      if(isKeyboardObsolete(kbd) && !deprecatedElement) {
        // TODO: make title change depending on whether deprecated keyboards are shown or hidden
        deprecatedElement = $(
          '<div class="keyboards-deprecated"><h4 class="red underline">' + t('obsoleteKeyboards') + '</h4></div>');
        resultsElement.append(deprecatedElement);
      }

      const keyboardClass = kbd.isDedicatedLandingPage ? 'keyboard keyboardLandingPage' : 'keyboard';

      var k = $(
        "<div class='"+keyboardClass+"'>"+
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
        $('.title a', k).text(kbd.name).attr('href', '/keyboards/h'+kbd.id+embed_query_q);
      } else {
        $('.title a', k).text(kbd.name).attr('href', '/keyboards/'+kbd.id+(kbd.match.tag ? '?bcp47='+kbd.match.tag+embed_query_x : embed_query_q));
      }

      if(kbd.isDedicatedLandingPage) {
        // We won't show the downloads text
      } else if(kbd.match.downloads == 0)
        $('.downloads', k).text(t('monthlyDownloadZero'));
      else if(kbd.match.downloads == 1)
        $('.downloads', k).text(kbd.match.downloads+' ' + t('monthlyDownloadOne'));
      else
        $('.downloads', k).text(kbd.match.downloads+' ' + t('monthlyDownloadMore'));

      if(!kbd.encodings.toString().match(/unicode/)) {
        $('.encoding', k).text(t('notUnicode'));
      }

      $('.id', k).text(kbd.id);
      $('.description', k).html(firstParagraph(kbd.description));

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
            var img = $('<img>').attr('src', '/cdn/dev/keyboard-search/icon-'+i+'.png').attr('title', t('designedForPlatform', {platform: i}));
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
    $('<h3>').addClass('red').text(t('noMatchesFoundForKeyboard', {keyboard: qq})).appendTo(resultsElement);
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

  appendPager(pager, t('previousPager'), res.context.pageNumber-1);
  if(res.context.pageNumber > 5) {
    $('<span>...</span>').appendTo(pager);
  }
  for(var i = Math.max(1, res.context.pageNumber - 4); i <= Math.min(res.context.totalPages, res.context.pageNumber + 4); i++) {
    appendPager(pager, i, i);
  }
  if(res.context.pageNumber < res.context.totalPages - 4) {
    $('<span>...</span>').appendTo(pager);
  }
  appendPager(pager, t('nextPager'), res.context.pageNumber+1);
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

export function do_search() {
  document.f.page.value = 1;
  search(true);
  return false; // always return false from search box
}

function createCORSRequest(method, url) {
  var xhr = new XMLHttpRequest();
  xhr.open(method, url, true);
  return xhr;
}


var load_search_count = 0, load_search = function() {
  // Because load order of jQuery may be after load_search, we should wait
  // for it to load. Note: this could loop forever if jQuery fails to load.
  // Resolving that is more work than we want to undertake right now.
  if(typeof $ == 'undefined' ) {
    window.setTimeout(load_search, 10);
    return false;
  }

  $('#search-q').on('input', function() {
    clearDynamicSearchTimeout();
    dynamic_search_timeout = window.setTimeout(function() {
      dynamic_search_timeout = 0;
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

  // Get initial search

  return prepareInitialSearch();
};

function prepareInitialSearch() {
  var page = 1, obsolete = 0, q = '', params = location.search.substr(1).split('&');
  for(var i = 0; i < params.length; i++) {
    var p = params[i].split('=');
    if(p.length == 2 && p[0] == 'q') {
      q = decodeURIComponent(p[1]);
    } else if(p.length == 2 && p[0] == 'page') {
      page = parseInt(decodeURIComponent(p[1]), 10);
      if(isNaN(page)) page = 1;
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

  document.f.q.value = q;
  document.f.page.value = page;
  document.f.obsolete.value = obsolete;
  search(false);
  return q != '';
};

function isKeyboardObsolete(kbd) {
  return kbd.deprecated || (typeof kbd.encodings.includes === 'function' && !kbd.encodings.includes('unicode'));
}

/**
 * Return the first paragraph of a HTML or plain text block, as HTML. This
 * function is a bit imprecise, but works well enough for our current needs; as
 * we improve the html descriptions of packages in the keyboards repository, we
 * may want to revisit this (or remove it entirely by supporting a shorter
 * summary field).
 *
 * For HTML strings (where the source description field in the .keyboard_info
 * was markdown and converted in the backend to HTML, this stops on first </p>
 * or <br>. It then adds a </p> in the case of <br> to keep the HTML hopefully
 * well-formed.
 *
 * For text strings, it stops on the first \r or \n (text strings in legacy
 * .keyboard_info tend to have CRLF line endings), and encloses the result in
 * <p></p>.
 *
 * @param {*} text A HTML or plain-text string
 * @returns A html snippet
 */
function firstParagraph(text) {
  // Yes, this is HTML parsing by regexp, but we will survive the apocalypse!
  const firstPara = /^(((?:.|[\r\n])+?)(<\/p>|<br>))/m.exec(text);
  if(!firstPara) {
    // No paragraph markers (e.g. legacy .keyboard_info files); it is a plain
    // text description, so we stop at first newline marker
    const firstPlainTextPara = /^(.+?)(\r|\n|$)/.exec(text);
    const html = $('<p>').text(firstPlainTextPara ? firstPlainTextPara[1] : text)[0].outerHTML;
    return html;
  }
  if(firstPara[3] == '<br>') {
    // We stop at first <br>, so will miss the end of paragraph, so close the
    // tag ourselves
    return firstPara[2] + '</p>';
  }
  // Return the whole paragraph
  return firstPara[1];
}

window.addEventListener('load', load_search, false);
