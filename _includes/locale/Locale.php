<?php

/*
 * Keyman is copyright (C) SIL Global. MIT License.
 */

  declare(strict_types=1);

  namespace Keyman\Site\com\keyman;

  class Locale {
    public const DEFAULT_LOCALE = 'en';

    public const CROWDIN_LOCALES = array(
      'en',
      'es-ES',
      'fr-FR'
    );

    // xx-YY locale as specified in crowdin %locale%
    private static $currentLocale = Locale::DEFAULT_LOCALE;

    // If set to true, warn about untranslated strings
    private static $debugMode = false; // Keep false in production

    // Associative array to hold translated strings in "current locale" and English
    private static $langArray = [];
    private static $langArrayEn = [];

    /**
     * Return the current locale. Fallback to 'en'
     * @return $currentLocale
     */
    public static function currentLocale() {
      return Locale::$currentLocale;
    }

    /**
     * Validate and override the current locale
     * @param $locale - the new current locale (xx-YY as specified in crowdin %locale%)
     */
    public static function overrideCurrentLocale($locale) {
      if (Locale::validateLocale($locale)) {
        Locale::$currentLocale = $locale;
      }
    }

    /**
     * Validate $locale is an acceptable locale.
     * Using xx-YY as specified in crowdin %locale%
     * @param $locale - the locale to validate
     * @return true if valid locale
     */
    public static function validateLocale($locale) {
      return in_array($locale, Locale::CROWDIN_LOCALES);
    }

    /**
     * Reads localized strings from the specified $domain-locale.php file
     * @param $domain - base filename of the .php file containing localized strings
     * (name not including -xx-YY locale)
     * path is relative to _includes/locale/
     */
    public static function localize($domain) {
      $currentLocaleFilename = sprintf("%s/%s-%s",
        __DIR__ . '/en/LC_MESSAGES/',
        $domain,
        Locale::$currentLocale . '.php');
      $enLocaleFilename =  sprintf("%s/%s-%s",
        __DIR__ . '/en/LC_MESSAGES/',
        $domain,
        Locale::DEFAULT_LOCALE . '.php');

      if (Locale::$currentLocale != Locale::DEFAULT_LOCALE && 
          file_exists($currentLocaleFilename)) {
        self::$langArray = require $currentLocaleFilename;
      } else {
        self::$langArray = [];
      }
      if (file_exists($enLocaleFilename)) {
        self::$langArrayEn = require $enLocaleFilename;
      } else {
        die("English strings in $enLocaleFilename not found");
      }
    }

    /**
     * Wrapper to lookup string. Fallback to English
     * @param $id - the key
     */
    public static function _m($id) {
      if (!isset(self::$langArray[$id])) {
        if (self::$debugMode) {
          // Warn about untranslated strings
          echo "WARNING: $id untranslated for " . Locale::$currentLocale;
        }
        return self::$langArrayEn[$id];
      }

      return self::$langArray[$id];
    }

    /**
     * Wrapper to format string with gettext '_(' alias and variable args
     * Placeholders should escape like %1\$s
     * @param $s - the format string
     * @param $args - optional remaining args to the format string
     */ 
    public static function _s($s, ...$args) {
      return vsprintf(self::_m($s), $args);
    }
  }
