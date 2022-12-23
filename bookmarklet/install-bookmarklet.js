var loaded = false;

function createSingleBookmarklet(lang, kbd) {
  var bml_element_old = document.getElementsByClassName('keyman-bookmarklet').item(0);
  var bml_parent = bml_element_old.parentElement;

  var label = kbd.name + ' Keyboard';
  var bml_element_new = construct_bookmarklet(bookmarkletParameters.resourceBase, kbd.id, lang.id, kbd.name, label);

  bml_parent.replaceChild(bml_element_new, bml_element_old); // unusual order:  needs 'new' before 'old'.
  $('#bookmarklet').show();
}

function addBookmarkletToList(lang, kbd) {
  var label = lang.name;
  if(label != kbd.name) {
    label += ' ('+kbd.name+')';
  }

  var kbd_bml = construct_bookmarklet(bookmarkletParameters.resourceBase, kbd.id, lang.id, kbd.name, label);

  var searchkey = lang.id.toLowerCase()+' '+kbd.id.toLowerCase()+' ' + label.toLowerCase().normalize('NFKC');
  kbd_bml.setAttribute('bml-search-key', searchkey);

  var list_inner = document.getElementById('bookmarklet-list-inner');
  list_inner.appendChild(kbd_bml);
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

  if (bookmarkletParameters.languageId == '' || bookmarkletParameters.keyboardId == '') {
    $.get(bookmarkletParameters.queryBase+'/api/4.0/languages?version='+bookmarkletParameters.keymanVersion+'&languageidtype=bcp47', function(data) {
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
    $('#bookmarklet-search').hide();
    $.get(bookmarkletParameters.queryBase+'/api/4.0/languages/'+bookmarkletParameters.languageId+'/'+bookmarkletParameters.keyboardId+'?version='+bookmarkletParameters.keymanVersion+'&languageidtype=bcp47', function(data) {
      createSingleBookmarklet(data.language, data.language.keyboards[0]);
    });
  }
});
