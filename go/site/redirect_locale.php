<?php
  /*
   * Keyman is copyright (C) SIL Global. MIT License.
   *
   * Redirect a top-level page to the best locale available for the user; called
   * by the mod_rewrite i18n rules in .htaccess.
   */
  declare(strict_types=1);

  require_once _KEYMANCOM_INCLUDES . '/autoload.php';

  use Keyman\Site\com\keyman\Locale;
  use Keyman\Site\com\keyman\Session;

  if(isset($_SESSION['lang'])) {
    // We'll use the user's previously selected language if they've already been
    // browsing the site in the current session
    $lang = $_SESSION['lang'];
  } else if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
    // Use HTTP Accept-Language: header to determine default language
    $negotiator = new \Negotiation\LanguageNegotiator();

    $acceptLanguageHeader = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
    $availableLocales     = Locale::availableLocales();
    $bestLanguage = $negotiator->getBest($acceptLanguageHeader, $availableLocales);
    $lang = $bestLanguage->getType();

    // We'll use Locale to validate and do fallback on the $lang variable;
    // normally this will have been done by LanguageNegotiator already, so
    // this may not be necessary
    Locale::setOverrideLocale($lang, true);
    $lang = Locale::pageLocale();
  } else {
    // No language provided, fallback to the default locale
    $lang = Locale::DEFAULT_LOCALE;
  }

  // The url that was originally requested is passed in through the server
  // variable REQUEST_URI by mod_rewrite, including the initial slash (/).
  $url = $_SERVER['REQUEST_URI'];
  $localizedUrl = "/$lang$url";

  header("Location: $localizedUrl");
