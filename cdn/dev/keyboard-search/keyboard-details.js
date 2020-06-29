(function() {
  const bowserParser = bowser.getParser(window.navigator.userAgent);
  const platform = bowserParser.getOSName({toLowerCase: true});
  document.documentElement.setAttribute("data-platform",
    platform === 'chrome os' ? 'android' : // This is not ideal but works on most Chromebooks for now
    platform.match(/^(android|ios|linux|macos|windows)$/) ? platform :
    'unknown');
})();

var binaryFileClientId = null;
function downloadBinaryFile(a) {
  if(!a.href.match(/cid=/) && binaryFileClientId) {
    a.href = a.href + "&cid="+binaryFileClientId;
  }
  //alert(a.href);
  return true;
}

try {
  if(ga) ga(function(tracker) {
    binaryFileClientId = tracker.get("clientId");
  });
} catch(error) {
}
