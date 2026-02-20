/**
 * Keyman is copyright (c) SIL Global. MIT License
 * 
 * Vanilla JS for localizing keyboard search strings without a framework
 * Reference: https://medium.com/@mihura.ian/translations-in-vanilla-javascript-c942c2095170
 */

export class I18n {

  static DEFAULT_LOCALE = 'en';

  // Array of the supported locales
  static currentLocales = [];

  static currentDomain = '';

  // strings is an array of domains.
  // Each domain is an array of locales
  // Each locale is an object? with loaded flag and array of strings
  static strings = [];


  /**
   * Set the current locales, with an array of fallbacks, ending in 'en'
   * @param {locale} The new current locale
   */
  static setLocale(locale) {
    // Clean current locales
    I18n.currentLocales = [];

    if (!locale) {
      I18n.currentLocales = I18n.calculateFallbackLocales(locale);
    }

    // Push default ballback locale to the end
    I18n.currentLocales.push(I18n.DEFAULT_LOCALE);
  }

  /**
   * Load the strings for the given domain
   * @param {string} domain 
   */
  static loadDomain(domain) {
    if (!I18n.strings[domain]) {
      I18n.strings[domain] = [];
    }
    I18n.strings[domain][I18n.DEFAULT_LOCALE] = {
      strings: [],
      loaded: false
    }
  }

  /**
   * Defines a global variable for page locale strings and also
   * tells locale system that current page uses locales
   * @param $domain - 
   * @param $id - folder containing locale strings, relative to /cdn/dev/js/i18n
   */
  static async definePageLocale(domain, id) {
    I18n.currentDomain = domain;
    if (!I18n.strings.hasOwnProperty(id)) {
      I18n.strings[id] = [];
    }
    await I18n.loadStrings(domain, I18n.DEFAULT_LOCALE);
  }

  /**
   * Given a locale, return an array of fallback locales
   * For example: es-ES --> [es, es-ES]
   * TODO: Use an existing fallback algorthim like
   *  https://cldr.unicode.org/development/development-process/design-proposals/language-distance-data
   * @param $locale - the locale to determine fallback locales
   * @return array of fallback locales
   */
  static calculateFallbackLocales(locale) {
    // Start with the given locale
    var fallback = [locale];

    // Support other fallbacks such as es-419 -> es
    var parts = locale.split('-');
    for (var i = parts.length-1; i > 0; i--) {
      var lastPosition = locale.lastIndexOf(parts[i]) - 1;
      // Insert language tag substring to head
      fallback.unshift(locale.substr(0, lastPosition));
    }

    return fallback;
  }

  /**
   * Dynamically load translation for a language if not already added
   * @param {String} lang 
   */
  static async loadStrings(domain, lang) {
    var currentLocaleFilename = `./${domain}/${lang}.json`;
    I18n.currentDomain = domain;

    try {
      const jsModule = await import(currentLocaleFilename, {
        with: { type: 'json'}
      });
      I18n.strings[I18n.currentDomain][lang] = {
        strings: jsModule.default,
        loaded: true
      };
    } catch (ex) {
      // JSON localization file doesn't exist. Log to sentry?
      //console.warn(`${domain}/${lang}.json doesn't exist. Not loading...`);
    }
  }

  /**
   * Navigates inside `obj` with `path` string,
   *
   * Usage:
   * objNavigate({a: {b: {c: 123}}}, "a.b.c") // returns 123
   *
   * Fails silently.
   * @param {obj} obj
   * @param {String} path to navigate into obj
   * @returns String or undefined if variable is not found.
   */
  static objNavigate(obj, path){
    var aPath = path.split('.');
    try {
      return aPath.reduce((a, v) => a[v], obj);
    } catch {
      return;
    }
  };

  /**
   * Interpolates variables wrapped with `{}` in `str` with variables in `obj`
   * It will replace what it can, and leave the rest untouched
   *
   * Usage:
   *
   * named variables:
   * strObjInterpolation("I'm {age} years old!", { age: 29 });
   *
   * ordered variables
   * strObjInterpolation("The {0} says {1}, {1}, {1}!", ['cow', 'moo']);
   */
  static strObjInterpolation(str, obj){
    obj = obj || [];
    str = str ? str.toString() : '';
    return str.replace(
      /{([^{}]*)}/g,
      (a, b) => {
        const r = obj[b];
        return typeof r === 'string' || typeof r === 'number' ? r : a;
      },
    );
  };

  /**
   * Determine the display UI language for the keyboard search
   * Navigate the translation JSON 
   * @param {string} domain of the localized strings
   * @param {string} key for the string
   * @param {obj} interpolations for optional formatted parameters
   * @returns localized string
   */
  static async t(domain, key, interpolations) {
    // Load the domain if it doesn't exist
    if (!I18n.strings[domain]) {
      loadDomain(domain);
    }

    // embed_lang set by session.php
    var language = embed_lang ?? I18n.DEFAULT_LOCALE;
    if (I18n.currentDomain) {
      if (!I18n.strings[domain][language]) {
        var obj = {
          strings: {},
          loaded: false
        };
        I18n.strings[domain][language] = obj;
      }
      if (!I18n.strings[domain][language].loaded) {
        // Will set -> loaded = true
        await I18n.loadStrings(domain, language);
      }
    }

    if (!I18n.strings[I18n.currentDomain][language] || !I18n.strings[I18n.currentDomain][language].strings[key]) {
      // Langage or key is missing, so fallback to "en"
      // Log to Sentry?
      // console.warn(`i18n for language: '${language}' for '${key}' missing, fallback to 'en'`);
      language = I18n.DEFAULT_LOCALE;
    }

    const value = I18n.objNavigate(I18n.strings[I18n.currentDomain][language].strings, key);
    if (!value) {
      // Warn if string doesn't exist
      console.log(`Missing '${I18n.currentDomain}/${language}.json' string for '${key}'`);
    }
    return I18n.strObjInterpolation(value, interpolations);
  }

}
