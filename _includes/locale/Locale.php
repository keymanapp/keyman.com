<?php
  declare(strict_types=1);

  namespace Keyman\Site\com\keyman;

  class Locale {
    private $currentLocale;

    private static $instance;

    public static function Instance(): Locale {
      if(!self::$instance)
        self::Rebuild();
      return self::$instance;
    }

    /**
     * Return the current locale. Fallback to 'en'
     */
    static function CurrentLocale() {
      return $this->currentLocale;
    }

    public static function Rebuild() {
      self::$instance = new Locale();
    }

    public function overrideCurrentLocale($locale) {
      $this->currentLocale = $locale;
    }

    function __construct() {
      $this->currentLocale = 'en';
    }
  }
