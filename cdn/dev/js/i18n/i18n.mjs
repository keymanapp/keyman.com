/**
 * Keyman is copyright (c) SIL Global. MIT License
 * 
 * Vanilla JS for localizing keyboard search strings without a framework
 * Reference: https://medium.com/@mihura.ian/translations-in-vanilla-javascript-c942c2095170
 */
import translationEN from './en.json' with { type: 'json' };
import translationES from './es.json' with { type: 'json' };
import translationFR from './fr.json' with { type: 'json' };

export class I18n {

  static translations = {
  "en": translationEN,
  };

  constructor() {}


  /**
   * Load translation for a language if not already added
   * @param {String} lang 
   */
  static loadTranslation(lang) {
    if (!I18n.translations.hasOwnProperty(lang)) {
      switch(lang) {
        case 'es' : 
          I18n.translations['es'] = translationES;
          break;
        case 'fr' :
          I18n.translations['fr'] = translationFR;
          break;
        default:
      }
    }
  }

  /**
   * Navigates inside `obj` with `path` string,
   *
   * Usage:
   * objNavigate({a: {b: 123}}, "a.b") // returns 123
   *
   * Fails silently.
   * @param {obj} obj
   * @param {String} path to navigate into obj
   * @returns String or undefined if variable is not found.
   */
  static objNavigate(obj, path){
    var aPath = path.split('.');
    try {
      return aPath.reduce((a, v) => a[v].text, obj);
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
   * @param {string} key 
   * @param {obj} interpolations for optional formatted parameters
   * @returns localized string
   */
  static t(key, interpolations) {
    // embed_lang set by session.php
    var language = embed_lang ?? "en";

    I18n.loadTranslation(language);

    if (!I18n.translations[language]) {
      // Langage is missing, so fallback to "en"
      console.warn(`i18n for language: '${language}' missing, fallback to 'en'`);
      language = "en";
    }

    if (!I18n.translations[language].hasOwnProperty(key)) {
      // key is missing for current language
      console.warn(`key '${key}' missing in '${language}' translations`);
      return '';
    }

    const value = I18n.objNavigate(I18n.translations[language], key);
    return I18n.strObjInterpolation(value, interpolations);
  }

}
