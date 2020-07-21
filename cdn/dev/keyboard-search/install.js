// TODO: show arrow in window where download is likely to be accessible from;
//       this is browser+browser version dependent :(  don't forget to look
//       for a library that implements this which may save pain

/**
 * Returns a URL for a downloads.keyman.com bootstrap installer
 * for Windows. Assumes all parameters are legitimate and correctly
 * associated (e.g. tier + version are paired)
 * @param {string} host      https://downloads.keyman.com (or staging equivalent)
 * @param {string} tier      alpha, beta or stable
 * @param {string} version   version number to download (e.g 14.0.80)
 * @param {string} id        id of keyboard to download
 * @param {string} bcp47     bcp47 tag to associate with keyboard at install
 */
function buildStandardWindowsDownloadUrl(host, tier, version, id, bcp47) {
  const url =
    host + "/windows/" + encodeURIComponent(tier) + "/" + encodeURIComponent(version) +
    "/keyman-setup." + encodeURIComponent(id) +
    (bcp47 == '' ? '' : '.' + encodeURIComponent(bcp47)) + ".exe";
  return url;
}

/**
 * Build a keyman://download/keyboard/<id>?bcp47=<bcp47> link
 * @param {string} id     id of keyboard to download
 * @param {string} bcp47  bcp47 tag to associate with keyboard on install
 */
function buildStandardKeymanProtocolDownloadLink(id, bcp47) {
  const url =
    'keyman://download/keyboard/' + encodeURIComponent(id) +
    (bcp47 == '' ? '' : '?bcp47=' + encodeURIComponent(bcp47));
  return url;
}

/**
 * Redirects to keyman:// to trigger Keyman Configuration, and if that fails,
 * to the standard download url for the package to install. This currently only
 * applies to Windows users (it may apply in future for Linux as well).
 * @param {object} data from the object with properties for host, tier, version, id, bcp47
 */
function startAfterPageLoad_Windows(data) {
  window.setTimeout(function() {
    const platform = document.documentElement.getAttribute('data-platform'), browser = document.documentElement.getAttribute('data-browser');
    if(platform == 'windows') {
      // This only runs for Windows
      const downloadUrl = buildStandardWindowsDownloadUrl(
        data.host, data.tier, data.version, data.id, data.bcp47
      );

      const keymanUrl = buildStandardKeymanProtocolDownloadLink(
        data.id, data.bcp47
      );

      if(browser != "Internet Explorer" && browser != "Microsoft Edge Legacy") {
        // On IE and Edge Legacy, we will never try the keyman: protocol because
        // it gives a poor user experience.
        location.href = keymanUrl;
      }

      const fallbackHandle = window.setTimeout(function() {
          location.href = downloadUrl;
      }, 1000);

      window.addEventListener('blur', function() {
        window.clearTimeout(fallbackHandle);
       });
    }
  }, 10);
}

/**
 * Redirects to keyman:// to trigger Keyman Configuration, and if that fails,
 * to the standard download url for the package to install. This currently only
 * applies to Linux users.
 * @param {object} data from the object with properties for host, tier, version, id, bcp47, name
 */
function startAfterPageLoad_Linux(data) {
  window.setTimeout(function() {
    const platform = document.documentElement.getAttribute('data-platform'), browser = document.documentElement.getAttribute('data-browser');
    if(platform == 'linux') {
      const downloadKeymanUrl = '/linux/download';
      const installKeyboardUrl =
        "/keyboards/install/" + encodeURIComponent(data.id) +
        (data.bcp47 == "" ? "" : "?bcp47=" + encodeURIComponent(data.bcp47));

      const keymanUrl = buildStandardKeymanProtocolDownloadLink(
        data.id, data.bcp47
      );

      location.href = keymanUrl;

      const fallbackHandle = window.setTimeout(function() {
        document.getElementById("content").innerHTML =
          "<p>Keyman for Linux is not installed yet. Please install it first before installing the keyboard.</p> \
          <ol> \
            <li id='step1'><a href='" + downloadKeymanUrl + "' title='Download and install Keyman'>Install Keyman for Linux</a></li> \
            <li id='step2'><a class='download-link binary-download' href='" + installKeyboardUrl + "'>\
              <span>Install keyboard</span></a>\
              <div class='download-description'>Downloads " + data.name + " for Linux.</div> \
            </li> \
          </ol>";
      }, 1000);

      window.addEventListener('blur', function() {
        window.clearTimeout(fallbackHandle);
       });
    }
  }, 10);
}