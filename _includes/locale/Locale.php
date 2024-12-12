<?php
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
     * Returns an array of localized strings from the specified $domain-locale.po file
     * for the current locale.
     * @param $domain - base filename of the .po files (not including -xx-YY locale)
     * @param $strings - Array of msgid's in the .po files
     * @return Array of localized strings for the current locale
     */
    public static function localize($domain, $strings) {
      foreach(Locale::CROWDIN_LOCALES as $l) {
        if ($l == Locale::DEFAULT_LOCALE) {
          // Skip English
          continue;
        }

        bindtextdomain("$domain-$l", __DIR__);
      }

      $previousTextDomain = textdomain(NULL);
      Locale::setTextDomain($domain);
  
      $result = [];
      foreach($strings as $s) {
        $result[$s] = _($s);
      }
  
      // Restore textdomain
      textdomain($previousTextDomain);
      return $result;
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
