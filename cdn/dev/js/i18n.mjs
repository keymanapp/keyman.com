/**
 * Keyman is copyright (c) SIL Global. MIT License
 *
 * Vanilla JS for localizing keyboard search strings without a framework
 * Reference: https://medium.com/@mihura.ian/translations-in-vanilla-javascript-c942c2095170
 *
 * Domains are loaded by Head::render() with the js_i18n_domains property, e.g.
 *
 *    'js_i18n_domains' => [
 *      'keyboard-search' => Locale::domain_js('keyboard-search'),
 *    ],
 *
 */

export class I18n {
  // domains member has the following structure:
  //   [
  //     { "locale": "fr", "strings": { "key": "value", ... } },
  //     { "locale": "en", "strings": { "key": "value", ... } },
  //     ...
  //   ]
  static domains = [];

  /**
   * Load the strings for the given domain
   * @param {string} domain
   */
  static loadDomain(domain) {

    // avoid reporting domain-load errors more than once
    I18n.domains[domain] = { locales: [] };

    const json = document.getElementById('i18n_'+domain)?.text;
    if(!json) {
      console.error(`i18n domain '${domain}' was not loaded`);
      return false;
    }

    try {
      I18n.domains[domain] = {
        locales: JSON.parse(json)
      };
    } catch(e) {
      // Handle JSON parse errors so we get a functioning page, even if it has
      // no localized strings visible
      console.error(e);
      return false;
    }

    return true;
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
    if(!obj) return undefined;
    var aPath = path.split('.');
    try {
      return aPath.reduce((a, v) => a[v], obj);
    } catch {
      return undefined;
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
  static t(domain, key, interpolations) {
    if (!I18n.domains[domain]) {
      if(!I18n.loadDomain(domain)) {
        return key;
      }
    }

    // Find best matching string in the available locales
    for(const locale of I18n.domains[domain].locales) {
      const value = I18n.objNavigate(locale.strings, key);
      if(value) {
        return I18n.strObjInterpolation(value, interpolations);
      }
    }

    console.warn(`Missing localization string in '${domain}' for '${key}' in all loaded locales`);
    // TODO: log to sentry?
    return key;
  }
}
