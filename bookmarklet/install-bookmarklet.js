var loaded = false;

function getBookmarkletCode(lang, kbd) {
  var code =
    "javascript:void((function(){try{var%20e=document.createElement('script');e.type='text/javascript';"+
    "e.src='"+resourceBase+"/code/bml20.php"+
    "?langid="+encodeURIComponent(lang.id)+
    "&amp;keyboard="+encodeURIComponent(kbd.id)+
    "';document.body.appendChild(e);}catch(v){}})())";
  return code;
}

function createSingleBookmarklet(lang, kbd) {
  var code = getBookmarkletCode(lang, kbd);
  $('#bookmarklet div a').text(kbd.name+' Keyboard').attr('href', code);
  $('#bookmarklet div a').unbind('mousedown').bind('mousedown',
    function() {
      if(typeof _gaq != 'undefined')
        _gaq.push(['_trackEvent', 'Bookmarklet', 'Installing', kbd.LanguageCode+','+kbd.Name]);
  });
  $('#bookmarklet').show();
}

function addBookmarkletToList(lang, kbd) {
  var code = getBookmarkletCode(lang, kbd);
  var name = lang.name;
  if(name != kbd.name) name += ' ('+kbd.name+')';
  var searchkey = lang.id.toLowerCase()+' '+kbd.id.toLowerCase()+' '+name.toLowerCase().normalize('NFKC');
  var bm = '<div><a href="'+code+'">'+name+' Keyboard</a></div>';
  bm = $(bm).attr('bml-search-key', searchkey);
  $('#bookmarklet-list-inner').append(bm);
}

function filterList() {
  if(!loaded) return;
  var filter = CSS.escape($("#bookmarklet-search-box").val().toLowerCase().normalize('NFKC'));
  $('#bookmarklet-list-inner div').removeClass('filter-out');
  if(filter != '')
    $('#bookmarklet-list-inner div').not('[bml-search-key*="'+filter+'"]').addClass('filter-out');
}

// Get the keyboards and languages available from keymanweb.com

window.addEventListener('load', function() {
  $("#bookmarklet-search-box")
    .on('keyup', filterList)
    .on('change', filterList);

  if (languageCode == '' || kbdname == '') {
    $.get(resourceBase+'/api/4.0/languages?languageidtype=bcp47', function(data) {
      $('#bookmarklet-search #spinner').hide();
      data.languages.languages.forEach(function(lang) {
        lang.keyboards.forEach(function(kbd) {
          addBookmarkletToList(lang, kbd);
        });
      });
      loaded = true;
      filterList();
    });
  } else {
    $.get(resourceBase+'/api/4.0/languages/'+languageCode+'/'+kbdname, function(data) {
      createSingleBookmarklet(data.language, data.language.keyboards[0]);
    });
  }
});
