/**
 * Vanilla JS for localizing keyboard search strings without a framework
 * Reference: https://medium.com/@mihura.ian/translations-in-vanilla-javascript-c942c2095170
 */
import translationEN from './en.json' with { type: 'json' };
import translationES from './es.json' with { type: 'json' };
import translationFR from './fr.json' with { type: 'json' };

const translations = {
  "en": translationEN,
  "es": translationES,
  "fr": translationFR
};


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
function objNavigate(obj, path){
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
function strObjInterpolation(str, obj){
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
export default function t(key, interpolations) {
  // embed_lang set by session.php
  var language = embed_lang ?? "en";

  if (!translations[language]) {
    // Langage is missing, so fallback to "en"
    console.warn(`i18n for language: '${language}' missing, fallback to 'en'`);
    language = "en";
  }

  if (!translations[language].hasOwnProperty(key)) {
    // key is missing for current language
    console.warn(`key '${key}' missing in '${language}' translations`);
    return '';
  }

  const value = objNavigate(translations[language], key);
  return strObjInterpolation(value, interpolations);
}