/**
 * Keyman is copyright (C) SIL Global. MIT License.
 */
import * as fs from 'node:fs';
import { argv } from 'node:process';
import * as path from 'node:path';
import blc from 'broken-link-checker';
const { SiteChecker } = blc;

const KEYMAN_COM_BASE_URL = 'http://localhost:8053';

/**
 * Searches through ../_includes/locale/strings/keyboards/ for the localized .php files.
 * Generate list of excludedKeywords: non-en locales
 * @returns string[]
 */
function generateExcludeList() {
  // Determine list of "locales" to exclude
  const excluded = fs.readdirSync('../_includes/locale/strings/keyboards/')
    .filter(file => path.extname(file).toLowerCase() === '.php')
    .filter(file => file !== 'en.php')
    .map(file => `${KEYMAN_COM_BASE_URL}/${path.basename(file, '.php')}/`);
  console.debug(`excludedKeywords: [${excluded}]`);

  return excluded;
}

/**
 * Run the broken link checker test. Prints results while running
 * @param excludeExternalLinks {boolean} to skip external links
 */
function runTest(excludeExternalLinks) {
  const options = {
    cacheResponses: true, // Check each unique URL once
    excludedKeywords: generateExcludeList(),
    excludeExternalLinks: excludeExternalLinks,
    filterLevel: 3,
    // TODO: CLI --ordered option doesn't seem to exist?
    recursive: true,
  };

  const siteChecker = new SiteChecker(options, {
    link: (result) => {
      //console.info(`${JSON.stringify(result)}`);
      if (result.broken) {
        const brokenUrl = (result.url.resolved) ? result.url.resolved : result.url.original;
        console.error(`├─BROKEN─ ${brokenUrl} because ${result.brokenReason}`);
      } else if (result.excluded) {
        console.info(`├─EXCLUDED─ ${result.url.resolved} for ${link.excludedReason}`);
      } else {
        // For troubleshooting valid links
        //console.info(`├───OK─── ${result.url.resolved}`);
      }
    },
    end: () => {
      // Summary
      console.info(new Date().toDateString());
      console.info('Finished! X links found, X excluded. X broken');
    }
  });

  const firstPageUrl = `${KEYMAN_COM_BASE_URL}/_test`;
  console.info(`Getting links from ${firstPageUrl}`);
  console.info(new Date().toISOString());
  siteChecker.enqueue(firstPageUrl);
}

/*
 * Setup options and run the broken-link-checker on the site
 * Excludes the following: non-en locales
 * @param excludeExternalLinks: boolean to skip external links. Default true
 */
try {
  const excludeExternalLinks = argv.length >= 3 ? argv[2].toLowerCase() === 'true' : true;
  runTest(excludeExternalLinks);
} catch (e) {
  // Attempt to catch bhttp TypeError: Cannot assign to read only property 'response' of object
  console.error(`Exception ${(e??'unknown error').toString()}`);
}
