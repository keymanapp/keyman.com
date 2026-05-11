/**
 * Keyman is copyright (c) SIL Global. MIT License
 *
 * Vanilla JS for localizing keyboard search strings without a framework
 * Reference: https://medium.com/@mihura.ian/translations-in-vanilla-javascript-c942c2095170
 *
 * Domains are loaded by Head::render() with the js_i18n_domains property, e.g.
 *
 *    'js_i18n_domains' => [
 *      'keyboards' => Locale::domain_js('keyboards'),
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

  static _pageLocale;

  /**
   * @returns the current page locale based on the URL. Note that the PHP
   * Locale.php is responsible for parsing and avoiding invalid locales.
   */
  static pageLocale() {
    if(!this._pageLocale) {
      let langMatch = location.pathname.match(/^\/([^/]+)/);
      this._pageLocale = langMatch ? langMatch[1] : 'en';
    }
    return this._pageLocale;
  }

  /**
   * Load the strings for the given domain
   * @param {string} domain
   * @return {boolean} Status if domain was successfully loaded
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
      console.error(`Invalid JSON for 'i18n_${domain}': ${e}`);
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
   * @param {Object} obj
   * @param {string} path to navigate into obj
   * @return {string} or undefined if variable is not found.
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
   * @param {string} str containing interpolated variables wrapped in `{}`
   * @param {Object} JSON containing values for the variables
   * @return {string} Resulting string where variables are replaced
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
   * @param {Object} interpolations for optional formatted parameters
   * @return {string} localized string
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
