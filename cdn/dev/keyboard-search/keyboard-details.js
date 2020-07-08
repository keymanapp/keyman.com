/**
 * Add the current platform as a data-platform attribute on the html element
 * so that we can use it for CSS selectors to display the appropriate content.
 */
(function() {
  const bowserParser = bowser.getParser(window.navigator.userAgent);
  const platform = bowserParser.getOSName({toLowerCase: true});
  document.documentElement.setAttribute("data-platform",
    platform === 'chrome os' ? 'android' : // This is not ideal but works on most Chromebooks for now
    platform.match(/^(android|ios|linux|macos|windows)$/) ? platform :
    'unknown');
})();
