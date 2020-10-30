/**
 * Add the current platform as a data-platform attribute on the html element
 * so that we can use it for CSS selectors to display the appropriate content.
 */
(function() {
  const bowserParser = bowser.getParser(window.navigator.userAgent);
  const platform = bowserParser.getOSName({toLowerCase: true});
  const browser = bowserParser.getBrowser();
  const engine = bowserParser.getEngine();

  document.documentElement.setAttribute("data-platform",
    platform === 'chrome os' ? 'android' : // This is not ideal but works on most Chromebooks for now
    platform.match(/^(android|ios|linux|macos|windows)$/) ? platform :
    'unknown');

  document.documentElement.setAttribute("data-browser",
    engine.name == 'EdgeHTML' ? 'Microsoft Edge Legacy' : // We need to treat Edge Legacy differently to Edge Chromium
    browser.name);
})();
