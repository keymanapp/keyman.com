function getBookmarkletCode(lang, kbd) {
  var code =
    "javascript:void((function(){try{var%20e=document.createElement('script');e.type='text/javascript';"+
    "e.src='"+resourceBase+"/code/bml20.php"+
    "?langid="+encodeURIComponent(lang.id)+
    "&keyboard="+encodeURIComponent(kbd.id)+
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
  var bm = '<div><a href="'+code+'">'+name+' Keyboard</a></div>';
  $('#bookmarklet-list-inner').append(bm);
}
 
// Get the keyboards and languages available from keymanweb.com
 
window.addEventListener('load', function() {
  if (languageCode == '' || kbdname == '') {
    $.get(resourceBase+'/api/4.0/languages', function(data) {
      data.languages.languages.forEach(function(lang) {
        lang.keyboards.forEach(function(kbd) {
          addBookmarkletToList(lang, kbd);
        });
      });
      $('#bookmarklet-search').show();
    });
  } else {
    $.get(resourceBase+'/api/4.0/languages/'+languageCode+'/'+kbdname, function(data) {
      createSingleBookmarklet(data.language, data.language.keyboards[0]);
    });
  }
});
