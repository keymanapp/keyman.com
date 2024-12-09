<?php
  declare(strict_types=1);

  namespace Keyman\Site\com\keyman;

  class Locale {
    private static $currentLocale = 'en';

    /**
     * Return the current locale. Fallback to 'en'
     * @return $currentLocale
     */
    public static function currentLocale() {
      return Locale::$currentLocale;
    }

    /**
     * Override the current locale
     * @param $locale - the new current locale
     */
    public static function overrideCurrentLocale($locale) {
      Locale::$currentLocale = $locale;
    }
  }
