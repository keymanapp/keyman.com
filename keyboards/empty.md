---
title: Keyboard Search
description: Blank keyboard search
showmenu: false
---

<script>
  var embed='<?=$embed?>';
  var embed_query='<?=$session_query?>';

  if(embed != 'none') {
    // For an iframe hosted in Download Keyboards dialog, we cannot use
    // autofocus because it is cross-origin. However, setting focus
    // programatically works here.
    window.addEventListener('load', function() {
      document.getElementById('search-q').focus();
    });
  }
</script>

  <div id='search-box'>
    <form method='get' action='/keyboards' name='f'>
      <label for="search-q">Keyboard search:</label><input id="search-q" type="text" placeholder="Enter language or keyboard" name="q"
      <?php if($embed == 'none') echo 'autofocus'; ?>>
      <input id="search-f" type="image" src="<?= cdn('img/search-button.png"') ?>" value="Search" onclick="return do_search()">
      <label id="search-new"><a href='/keyboards<?=$session_query_q?>'>New search</a></label>
      <input id="search-obsolete" type="hidden" name="obsolete" value="0">
      <input id="search-page" type="hidden" name="page" value="1">
    </form>
  </div>

<br/>

Enter the name of a keyboard or language to search for. ([Popular keyboards](/keyboards?q=p:popular) | [All keyboards](/keyboards?q=p:alphabetical))

Hints

  - The search always returns a list of keyboards. It searches for keyboard names and details, language names, country names and script names.
  - You can apply prefixes `k:` (keyboards), `l:` (languages), `s:` (scripts, writing systems) or `c:` (countries) to filter your search results. For example `c:thailand` searches for keyboards for languages used  in Thailand.
  - Use prefix `l:id:` to search for a BCP 47 language tag, for example `l:id:ti-et` searches for Tigrigna (Ethiopia).

```java
int main() {

}
```
