if(typeof embed_query == 'undefined') {
  var embed_query = '';
}
var embed_query_q = embed_query == '' ? '' : '?'+embed_query;
var embed_query_x = embed_query == '' ? '' : '&'+embed_query;

/////////////////////////////////////////////////////////////////////////////////////
// We need these polyfills for IE8 for downlevel embedded search
// boxes on Keyman Desktop 7, 8, 9... Wow.
/////////////////////////////////////////////////////////////////////////////////////

// Production steps of ECMA-262, Edition 5, 15.4.4.21
// Reference: http://es5.github.io/#x15.4.4.21
// https://tc39.github.io/ecma262/#sec-array.prototype.reduce
if (!Array.prototype.reduce) {
  // Note: cannot use Object.defineProperty because IE8.
  Array.prototype.reduce = function(callback /*, initialValue*/) {
    if (this === null) {
      throw new TypeError( 'Array.prototype.reduce ' +
        'called on null or undefined' );
    }
    if (typeof callback !== 'function') {
      throw new TypeError( callback +
        ' is not a function');
    }

    // 1. Let O be ? ToObject(this value).
    var o = Object(this);

    // 2. Let len be ? ToLength(? Get(O, "length")).
    var len = o.length >>> 0;

    // Steps 3, 4, 5, 6, 7
    var k = 0;
    var value;

    if (arguments.length >= 2) {
      value = arguments[1];
    } else {
      while (k < len && !(k in o)) {
        k++;
      }

      // 3. If len is 0 and initialValue is not present,
      //    throw a TypeError exception.
      if (k >= len) {
        throw new TypeError( 'Reduce of empty array ' +
          'with no initial value' );
      }
      value = o[k++];
    }

    // 8. Repeat, while k < len
    while (k < len) {
      // a. Let Pk be ! ToString(k).
      // b. Let kPresent be ? HasProperty(O, Pk).
      // c. If kPresent is true, then
      //    i.  Let kValue be ? Get(O, Pk).
      //    ii. Let accumulator be ? Call(
      //          callbackfn, undefined,
      //          « accumulator, kValue, k, O »).
      if (k in o) {
        value = callback(value, o[k], k, o);
      }

      // d. Increase k by 1.
      k++;
    }

    // 9. Return accumulator.
    return value;
  };
}

// https://tc39.github.io/ecma262/#sec-array.prototype.find
if (!Array.prototype.find) {
  // Note: cannot use Object.defineProperty because IE8.
  Array.prototype.find = function(predicate) {
   // 1. Let O be ? ToObject(this value).
    if (this == null) {
      throw new TypeError('"this" is null or not defined');
    }

    var o = Object(this);

    // 2. Let len be ? ToLength(? Get(O, "length")).
    var len = o.length >>> 0;

    // 3. If IsCallable(predicate) is false, throw a TypeError exception.
    if (typeof predicate !== 'function') {
      throw new TypeError('predicate must be a function');
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
  };
}

if (!window.JSON) {
  window.JSON = {
    parse: function(sJSON) { return eval('(' + sJSON + ')'); },
    stringify: function() { alert('Not implemented'); }
  }
}

// Production steps of ECMA-262, Edition 5, 15.4.4.18
// Reference: http://es5.github.io/#x15.4.4.18
if (!Array.prototype.forEach) {

  Array.prototype.forEach = function(callback/*, thisArg*/) {

    var T, k;

    if (this == null) {
      throw new TypeError('this is null or not defined');
    }

    // 1. Let O be the result of calling toObject() passing the
    // |this| value as the argument.
    var O = Object(this);

    // 2. Let lenValue be the result of calling the Get() internal
    // method of O with the argument "length".
    // 3. Let len be toUint32(lenValue).
    var len = O.length >>> 0;

    // 4. If isCallable(callback) is false, throw a TypeError exception.
    // See: http://es5.github.com/#x9.11
    if (typeof callback !== 'function') {
      throw new TypeError(callback + ' is not a function');
    }

    // 5. If thisArg was supplied, let T be thisArg; else let
    // T be undefined.
    if (arguments.length > 1) {
      T = arguments[1];
    }

    // 6. Let k be 0.
    k = 0;

    // 7. Repeat while k < len.
    while (k < len) {

      var kValue;

      // a. Let Pk be ToString(k).
      //    This is implicit for LHS operands of the in operator.
      // b. Let kPresent be the result of calling the HasProperty
      //    internal method of O with argument Pk.
      //    This step can be combined with c.
      // c. If kPresent is true, then
      if (k in O) {

        // i. Let kValue be the result of calling the Get internal
        // method of O with argument Pk.
        kValue = O[k];

        // ii. Call the Call internal method of callback with T as
        // the this value and argument list containing kValue, k, and O.
        callback.call(T, kValue, k, O);
      }
      // d. Increase k by 1.
      k++;
    }
    // 8. return undefined.
  };
}

/////////////////////////////////////////////////////////////////////////////////////
// Search functionality. If embed = 'windows', disable all 'modern' browser functionality
// for the Keyman Desktop 7-9 living-in-the-past experience.
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

  var base = location.protocol+'//api.keyman.com'; //+location.host; // this works on test sites as well as live, assuming we use the host pattern "keyman.com[.local]"

  var url = base+'/search?q='+encodeURIComponent(q);

  if(embed) {
    url += '&embed='+embed;
  }

  var xhr = createCORSRequest('GET', url);

  var xhronload = function() {
    if(counter > localCounter) {
      // out of order response, or later query
      return;
    }

    var responseText = xhr.responseText;

    //hide_loading();
    $('#search-box').removeClass('searching');
    if(updateHistory && history.pushState && embed != 'windows') {
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

  if (!xhr) {
    // Use a thunk through keyman.com to api.keyman.com. Slower but still works without CORS
    // We need this because existing Keyman users on Windows XP etc will be using IE<8. Sad but true.
    base = location.protocol+'//'+location.host;
    url = base+'/_ie_thunk/search.php?q='+encodeURIComponent(q);
    xhr = new XMLHttpRequest();
    xhr.open('GET', url);

    xhr.onreadystatechange = function() {
      if(xhr.readyState == 4) xhronload();
    }
  } else {
    xhr.onload = xhronload;
  }


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

if(embed != 'windows') {
  window.onpopstate = function(e) {
    if(e.state) {
      process_response(e.state.q, e.state.text);
      $('#search-q').val(e.state.q);
      return true;
    } else return false;
  };
}

function process_response(q, res) {
  var resultsElement = $('#search-results');
  res = JSON.parse(res);
  resultsElement.empty();

  if(res.keyboards) {
    $('<h3>').addClass('red underline').text(res.rangetext ? res.rangetext : "Keyboards matching '"+q+"'").appendTo(resultsElement);

    document.title = q + ' - Keyboard search';

    res.keyboards.forEach(function(kbd) {

      // Remove irrelevant keyboards

      if(embed=='windows' && (!kbd.platformSupport || !kbd.platformSupport['windows'] || kbd.platformSupport['windows'] == 'none')) {
        return;
      }

      if(embed=='macos' && (!kbd.platformSupport || !kbd.platformSupport['macos'] || kbd.platformSupport['macos'] == 'none')) {
        return;
      }

      // TODO: remove irrelevant Linux keyboards?

      var k = $(
        "<div class='keyboard'>"+
          "<div class='title'><a></a></div>"+
          "<div class='detail'>"+
            "<div class='id'></div>"+
            "<div class='encoding'></div>"+
            "<div class='description'></div>"+
            "<div class='platforms'></div>"+
          "</div>"+
        "</div>");

      $('.title a', k).text(kbd.name).attr('href', '/keyboards/'+kbd.id+embed_query_q);

      if(!kbd.encodings.toString().match(/unicode/)) {
        $('.encoding', k).text('Note: Not a Unicode keyboard');
      }

      $('.id', k).text(kbd.id);
      $('.description', k).html(kbd.description);

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
      resultsElement.append(k);
    });
  }
  if(res.languages) {
    if(q != 'l:*') {
      $('<h3>').addClass('red underline').text(res.rangetext && !res.keyboards ? res.rangetext : "Languages matching '"+q+"'").appendTo(resultsElement);
    } else {
      $('<h3>').addClass('red underline').text('Choose a language').appendTo(resultsElement);
    }

    var letterPrefix = 'letter-'; // Needed for links on IE
    if(embed == 'windows') {
      // Build a shortcut index - for Windows only at this stage

      function firstAlpha(s) {
        var m = s.match(/[a-zA-Z]/);
        if(!m) return null
        return m[0].toUpperCase();
      }

      // https://stackoverflow.com/questions/14446511/most-efficient-method-to-groupby-on-a-array-of-objects#comment64856953_34890276
      function groupByArray(xs, key) {
        return xs.reduce(function (rv, x) {
          var v = key instanceof Function ? key(x) : x[key];
          var el = rv.find(function(r) { return r && r.key === v });
          if (el) {
            el.values.push(x);
          } else {
            rv.push({ key: v, values: [x] });
          }
          return rv;
        }, []);
      }

      var ix = groupByArray(res.languages, function(lang) { return firstAlpha(lang.name) });
      var hindex = $('<h3>');
      hindex.append('<span>Index: </span>');
      ix.forEach(function(letter) {
        var e = $("<span class='index'><a href='#"+letterPrefix+letter.key+"'>"+letter.key+"</a> </span> ");
        hindex.append(e);
      });
      hindex.append("<span class='index'><a href='#other'>Other</a> </span>");
      resultsElement.append(hindex);
    }

    // Build the language list

    var p = null, first = '';
    res.languages.forEach(function(l) {
      if(embed == 'windows') {
        var f = firstAlpha(l.name);
        if(first != f) {
          first = f;
          var e = $("<h2 id='"+letterPrefix+f+"'>"+f+"</h2>");
          resultsElement.append(e);
          p = $("<div style='column-count: 3'></div>");
          resultsElement.append(p);
        }
      }

      var e = $(
        "<div class='language'>"+
          "<div class='title'><a></a></div>"+
        "</div>");
      var e2 = $('.title a', e).text(l.name).attr('href', '/keyboards/languages/'+l.id+embed_query_q);
      if(embed != 'windows') {
        // We use ajaxy search only when not embedded
        e2.click(function() {
          document.f.q.value = 'l:id:'+l.id;
          return do_search();
        });
      }
      (p ? p : resultsElement).append(e);
    });

    if(embed == 'windows') {
      // Add a separate copy of the 'Undetermined' language for IPA, etc.
      var e = $(
        "<h2 id='other'>Other</h2>"+
        "<div class='language'>"+
          "<div class='title'><a>Non-language keyboards</a></div>"+
        "</div>");
      var e2 = $('.title a', e).attr('href', '/keyboards/languages/und'+embed_query_q);
      resultsElement.append(e);
    }
  }

  if(res.countries) {
    $('<h3>').addClass('red underline').text(res.rangetext && !res.keyboards ? res.rangetext : "Countries matching '"+q+"'").appendTo(resultsElement);
    res.countries.forEach(function(c) {
      var e = $(
        "<div class='country'>"+
          "<div class='title'><a></a></div>"+
        "</div>");
      var e2 = $('.title a', e).text(c.name).attr('href', '/keyboards/countries/'+c.id+embed_query_q);
      if(embed != 'windows') {
        // We use ajaxy search only when not embedded
        e2.click(function() {
          document.f.q.value = 'c:id:'+c.id;
          return do_search();
        });
      }
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
  if ("withCredentials" in xhr) {

    // Check if the XMLHttpRequest object has a "withCredentials" property.
    // "withCredentials" only exists on XMLHTTPRequest2 objects.
    xhr.open(method, url, true);

  } /*else if (typeof XDomainRequest != "undefined") {
    // This is still not reliable in IE8, so we will use thunk -- managed outside here
    // Otherwise, check if XDomainRequest.
    // XDomainRequest only exists in IE, and is IE's way of making CORS requests.
    xhr = new XDomainRequest();
    xhr.open(method, url);

  }*/ else {

    // Otherwise, CORS is not supported by the browser.
    xhr = null;

  }
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

  if(embed == 'windows') {
    return init('l:*');
  }

  return false;
};

window.addEventListener ? window.addEventListener('load', load_search, false) : window.attachEvent('onload', load_search);
