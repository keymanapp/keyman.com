<?php

/*
 * Keyman is copyright (C) SIL Global. MIT License.
 */

  declare(strict_types=1);

  namespace Keyman\Site\com\keyman;

  use \Keyman\Site\Common\KeymanHosts;

  function define_display_locales() {
    $_defined_locales = json_decode(file_get_contents(__DIR__ . '/locales.json'), true);
    define('DISPLAY_NAMES', $_defined_locales);
  }

  define_display_locales();

  class Locale {
    public const DEFAULT_LOCALE = 'en';

    // array of the support locales
    // xx-YY locale as specified in crowdin %locale%
    private static $currentLocales = [];

    // strings is an array of domains.
    // Each domain is an array of locales
    // Each locale is an object? with loaded flag and array of strings
    private static $strings = [];

    private static $invalidLocale = false;

    /**
     * Return the current locales. Fallback to 'en'
     * @return $currentLocales
     */
    public static function currentLocales() {
      if(count(self::$currentLocales) == 0) {
        Locale::setLocaleFromURL();
      }
      return self::$currentLocales;
    }

    /**
     * Return the user-selected page locale, which is always embedded at the
     * front of the URL path
     */
    public static function pageLocale() {
      return self::currentLocales()[0];
    }

    /**
     * Returns true if the locale determined from the URL is not a known locale,
     * based on the list in DISPLAY_NAMES. If we are loaded in a context outside
     * localized content, and where the top-level folder name would be valid
     * BCP47, e.g. /go/, Locale::invalidLocale() will return true. See root
     * /.htaccess for list of all non-localized content where this may arise.
     */
    public static function invalidLocale() {
      self::currentLocales(); // ensure locale is set
      return self::$invalidLocale;
    }

    /**
     * Set the current locale based on the first path component
     * /<locale>/rest/of/path for the current page URL
     */
    private static function setLocaleFromURL() {
      // First component of the URL is always the locale
      if(preg_match('/^\/(([a-z]{2,3})(-([A-Z][a-z]{3}))?(-([A-Z]{2}|[0-9]{3}))?)\//', $_SERVER['REQUEST_URI'], $matches)) {
        $fallbackLocales = self::calculateFallbackLocales($matches[1]);
        if (isset($fallbackLocales[0])) {
          $pageLocale = $fallbackLocales[0];
        } else {
          // Note: this is an unsupported locale, so we'll end up redirecting in head.php to /en/...
          $pageLocale = Locale::DEFAULT_LOCALE;
          self::$invalidLocale = true;
        }
      } else {
        $pageLocale = Locale::DEFAULT_LOCALE;
        // Don't set invalid locale so pages like /_test/ work
      }
      self::setLocale($pageLocale);
    }

    /**
     * Set the current locales, with an array of fallbacks, ending in 'en'.
     * @param $locale - the new current locale (xx-YY as specified in crowdin %locale%)
     */
    private static function setLocale($locale) {
      // Clear current locales
      self::$currentLocales = [];

      if (!empty($locale)) {
        self::$currentLocales = self::calculateFallbackLocales($locale);
      }

      if(!in_array(Locale::DEFAULT_LOCALE, self::$currentLocales)) {
        // Push default fallback locale to the end
        array_push(self::$currentLocales, Locale::DEFAULT_LOCALE);
      }
    }

    /**
     * Load the strings for the given domain
     * @param $domain - the domain of strings
     * @return boolean - true if successfully loaded strings
     */
    public static function loadDomain($domain) {
      self::$strings[$domain] = [];
      $path = _KEYMANCOM_INCLUDES . '/locale/strings/' . $domain . '/*.php';
      $files = glob(_KEYMANCOM_INCLUDES . '/locale/strings/' . $domain . '/*.php');
      if ($files == false) {
        return false;
      }
      foreach ($files as $file) {
        // files are named by locale
        $file = pathinfo($file, PATHINFO_FILENAME);
        self::$strings[$domain][$file] = (object)[
          'strings' => [],
          'loaded' => false
        ];
      }
      return true;
    }

    /**
     * Reads localized strings from the specified $domain-locale.php file
     * @param $domain - base filename of the .php file containing localized strings
     * (name not including -xx-YY locale)
     * path is relative to _includes/locale/
     * @param $locale - locale for the strings to load
     */
    public static function loadStrings($domain, $locale) {
      $currentLocaleFilename = sprintf("%s/%s/%s",
        _KEYMANCOM_INCLUDES . '/locale/strings/',
        $domain,
        $locale . '.php');

      if (file_exists($currentLocaleFilename)) {
        self::$strings[$domain][$locale]-> strings = require $currentLocaleFilename;
        self::$strings[$domain][$locale]-> loaded = true;
      }
    }

    /**
     * Return an array of javascript locales available for the given domain, in
     * priority order.
     */
    public static function domain_js($domain) {
      $root = _KEYMANCOM_INCLUDES . "/locale/strings/$domain";
      $locales = [];
      foreach (self::currentLocales() as $locale) {
        if(file_exists("$root/$locale.json")) {
          array_push($locales, $locale);
        }
      }

      return $locales;
    }

    /**
     * Defines a global variable for page locale strings and also
     * tells locale system that current page uses locales
     * @param $define -
     * @param $id - folder containing locale strings, relative to /_includes/locale/strings
     */
    public static function definePageScope($define, $id) {
      global $page_is_using_locale;
      $page_is_using_locale = true;
      define($define, $id);
    }

    /**
     * Given a locale, return an array of fallback locales
     * For example: es-ES --> [es, es-ES]
     * TODO: Use an existing fallback algorthim like
     *  https://cldr.unicode.org/development/development-process/design-proposals/language-distance-data
     * @param $locale - the locale to determine fallback locales
     * @return array of fallback locales
     */
    private static function calculateFallbackLocales($locale) {
      // Start with the given locale
      $fallback = [$locale];

      // Support other fallbacks such as es-419 -> es
      $parts = explode('-', $locale);
      for ($i = count($parts)-1; $i > 0; $i--) {
        $lastPosition = strrpos($locale, $parts[$i]) - 1;
        // Insert language tag substring to head
        array_unshift($fallback, substr($locale, 0, $lastPosition));
      }

      return $fallback;
    }

    /**
     * Wrapper to lookup string. Fallback to English
     * @param $domain - the domain file
     * @param $id - the key
     * @return localized string, or fallback to English string, and then $id
     */
    private static function getString($domain, $id) {
      if (!array_key_exists($domain, self::$strings)) {
        // Load the domain if it doesn't exist
        if (!self::loadDomain($domain)) {
          die('Domain ' . $domain . "doesn't exist");
        }
      }

      if (count(self::currentLocales()) == 0) {
        die('Current locales haven\'t been set by session');
      }

      foreach (self::currentLocales() as $locale) {
        if (!array_key_exists($locale, self::$strings[$domain])) {
          continue;
        }

        if (!self::$strings[$domain][$locale]->loaded) {
          // Will set -> loaded = true
          self::loadStrings($domain, $locale);
        }

        if (array_key_exists($id, self::$strings[$domain][$locale]->strings)) {
          return self::$strings[$domain][$locale]->strings[$id];
        }
      }

      // String not found in any localization -
      if(KeymanHosts::Instance()->Tier() == KeymanHosts::TIER_DEVELOPMENT) {
        die('string ' . $id . ' is missing in all the l10ns');
      }
      return $id;
    }

    /**
     * Wrapper to lookup localized string for webpage domain.
     * Formatted string using optional variable args for placeholders
     * should escape like %1\$s
     * @param $domain - the PHP file using the localized strings
     * @param $id - the id for the string
     * @param $args - optional remaining args to the format string
     */
    public static function m($domain, $id, ...$args) {
      $str = self::getString($domain, $id);
      if (count($args) == 0) {
        return $str;
      }
      return vsprintf($str, array(...$args));
    }
  }
