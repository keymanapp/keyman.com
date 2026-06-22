<?php
  /*
   * Keyman is copyright (C) SIL Global. MIT License.
   */
  declare(strict_types=1);

  require_once _KEYMANCOM_INCLUDES . '/includes/template.php';
  require_once _KEYMANCOM_INCLUDES . '/autoload.php';

  // Avoid showing a HTML response for requests where the Accept: header is
  // missing or does not correspond to a text/html-type, so that the client
  // doesn't get HTML where it doesn't expect it

  $negotiator = new \Negotiation\Negotiator();

  if(empty($_SERVER['HTTP_ACCEPT'])) {
    $acceptHeader = 'unknown';
  } else {
    $acceptHeader = $_SERVER['HTTP_ACCEPT'];
  }

  $mediaType = $negotiator->getBest($acceptHeader, ['text/html']);
  if(!$mediaType) {
    header('HTTP/1.0 404 Page not found');
    return;
  }

  // We need to avoid saving any locale that is calculated on this page because
  // 404.php requests can arise unexpectedly, and the URL may be anything, so
  // calculating locale from page url could result in it being reset to
  // `DEFAULT_LOCALE`. For example, missing images or background requests like
  // Chrome requesting /.well-known/appspecific/com.chrome.devtools.json when
  // DevTools is open.

  use Keyman\Site\com\keyman\Locale;
  Locale::$saveLocale = false;

  head([
    'title' => "Page not found",
    'index' => false,
    'crumbs' => true,
  ]);

  $page = $_SERVER["REQUEST_URI"];

  function E($v)
  {
    $s = @htmlspecialchars($v, ENT_QUOTES, 'UTF-8');
    if(empty($s) && !empty($v))
      $s = @htmlspecialchars($v, ENT_QUOTES, 'ISO-8859-1');
    return $s;
  }

?>
<h1>Page not found</h1>

<p>Sorry, we couldn't find the page <a href="<?= E($page) ?>"><?= E($page) ?></a>.</p>

<p>Please tell us about this problem on the <a href="https://community.software.sil.org/c/keyman" target="_blank">Keyman Community</a>.</p>

<h2>Search Keyman</h2>

<script>
  (function() {
    var cx = '010681075583534798483:ox2qukyiv9c';
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
        '//cse.google.com/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
  })();
</script>
<gcse:searchbox-only as_sitesearch='keyman.com' resultsUrl="/search/"></gcse:searchbox-only>
