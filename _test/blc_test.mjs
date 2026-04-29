/**
 * Keyman is copyright (C) SIL Global. MIT License.
 * 
 * Setup options and run the broken-link-checker on the site
 * @param excludeExternalLinks: boolean to skip external links. Default true
 *
 * package.json using bhttp 1.2.8 to resolve this exception
 * Reference: https://github.com/stevenvachon/broken-link-checker/issues/184
 */
import * as fs from 'node:fs';
import { argv } from 'node:process';
import * as path from 'node:path';
import blc from 'broken-link-checker';
import humanizeDuration from 'humanize-duration';
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

  return excluded;
}

/**
 * Run the broken link checker test. Prints results while running
 * @param excludeExternalLinks {boolean} to skip external links
 */
async function runTest(excludeExternalLinks) {
  const options = {
    cacheResponses: true, // Check each unique URL once
    excludedKeywords: generateExcludeList(),
    excludeExternalLinks: excludeExternalLinks,
    excludedSchemes: ['market'],
    filterLevel: 3,
    maintainLinkOrder: true,
    maxSocketsPerHost: 50,
    recursive: true
  };
  console.info(`options: ${JSON.stringify(options, null, 2)}`);

  let startTime = Date.now();
  console.info(`start time: ${new Date(startTime).toISOString()}`);

  const siteChecker = new SiteChecker(options, {
    html: (tree, robots, response, pageURL) => {
      console.info(`\nGetting links from: ${pageURL}`);
    },
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
      console.info(`\nLinks broken: TBD`);
      console.info(`\nTime elapsed: ${humanizeDuration(Date.now() - startTime, {largest: 2, round:true})}\n`);
    }
  });

  const firstPageUrl = `${KEYMAN_COM_BASE_URL}/_test`;
  siteChecker.enqueue(firstPageUrl);
}

/*
 * Setup options and run the broken-link-checker on the site
 * @param excludeExternalLinks: boolean to skip external links. Default true
 */
const excludeExternalLinks = argv.length >= 3 ? argv[2].toLowerCase() === 'true' : true;
await runTest(excludeExternalLinks);
