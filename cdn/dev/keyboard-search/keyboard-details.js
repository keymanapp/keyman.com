/**
 * Add the current platform as a data-platform attribute on the html element
 * so that we can use it for CSS selectors to display the appropriate content.
 */
(function() {
  // Allow for a platform-override parameter for testing of
  // the keyboard install page.
  const params = typeof URLSearchParams == 'function' ?
    new URLSearchParams(location.search) : null;
  const bowserParser = bowser.getParser(window.navigator.userAgent);
  const browser = bowserParser.getBrowser();
  const engine = bowserParser.getEngine();
  const os = bowserParser.getOSName({toLowerCase: true});
  const platform = params && params.get('platform-override') ?
    params.get('platform-override') :
    (
      // Detect iOS Safari in 'Desktop Mode' -- we still want iOS downloads!
      os == 'macos' && navigator.maxTouchPoints > 1 && browser == 'Safari' ? 'ios' : os
    );

  document.documentElement.setAttribute("data-platform",
    platform === 'chrome os' ? 'android' : // This is not ideal but works on most Chromebooks for now
    platform.match(/^(android|ios|linux|macos|windows)$/) ? platform :
    'unknown');

  document.documentElement.setAttribute("data-browser",
    engine.name == 'EdgeHTML' ? 'Microsoft Edge Legacy' : // We need to treat Edge Legacy differently to Edge Chromium
    browser.name);
})();
