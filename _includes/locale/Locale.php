<?php
  declare(strict_types=1);

  namespace Keyman\Site\com\keyman;

  class Locale {
    public const DEFAULT_LOCALE = 'en';

    // xx-YY locale as specified in crowdin %locale%
    private static $currentLocale = Locale::DEFAULT_LOCALE;

    /**
     * Return the current locale. Fallback to 'en'
     * @return $currentLocale
     */
    public static function currentLocale() {
      return Locale::$currentLocale;
    }

    /**
     * Override the current locale
     * @param $locale - the new current locale (xx-YY as specified in crowdin %locale%)
     */
    public static function overrideCurrentLocale($locale) {
      Locale::$currentLocale = $locale;
    }

    /**
     * Validate $locale is an acceptable locale.
     * Using xx-YY as specified in crowdin %locale%
     * @param $locale - the locale to validate
     * @return true if valid locale
     */
    public static function validateLocale($locale) {

    }

    /**
     * Use textdomain to specify the localization file for "localization".
     * Ignore if locale is "en" or the filename doesn't exist
     * Filename expected to be "$basename-$locale.mo"
     * @param $basename - base name of the .mo file to use
     * @return current message domain
     */
    public static function setTextDomain($basename) {
      // Container uses English locale, and then we use textdomain to change "localization" files
      setLocale(LC_ALL, 'en_US.UTF-8');

      if (Locale::$currentLocale == Locale::DEFAULT_LOCALE) {
        return;
      }

      $filename = sprintf("%s-%s", $basename, Locale::$currentLocale);
      $fullPath = sprintf("%s/en/LC_MESSAGES/%s.mo", __DIR__, $filename);
      if(file_exists($fullPath)) {
        return textdomain($filename);
      } else {
        //echo "textdomain $fullPath doesn't exist";
        return;
      }
    }

    /**
     * Wrapper to format string with gettext '_(' alias and variable args
     * @param $s - the format string
     * @param $args - optional remaining args to the format string
     */ 
    public static function _s($s, ...$args) {
      return vsprintf($s, $args);
    }
  }
