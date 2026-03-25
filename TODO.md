Other tasks:

* PHP upgrade to 8.x
* localizing markdown files


Questions for url scheme:

* URL scheme - very little overlap with langtags (/cdn)
* How do we lay out files in the repo?
* How do we manage relative links?


keyman.com/windows --> has link to /linux

keyman.com/en/windows --> /en/linux
keyman.com/de/windows --> /de/linux

navigate to keyman.com/linux ->> keyman.com/de/linux (based on geography or by browser lang tag info, by default)

keyman.com/km/linux --> selects 'km' language, stays there.


Fallback?
 keyman.com/de/windows --> if no fallback available, use en content, and maybe have a banner saying 'content not yet available in German, please help us translate this!'


* transition from existing links? must ensure we have redirections (e.g. /windows --> /en/windows)
* canonical links?
* links embedded in pages on keyman.com:
  * should be using relative rather than absolute links (i.e. ../windows rather than /windows)
  * Link types:
    * dynamic by Javascript
    * dynamic links from api.keyman.com data
    * dynamic by PHP script / static in HTML (91 .php files)
    * static in Markdown (39 files)
    * .htaccess redirects and rewrites (16 files)
* external links from other keyman.com sites
* external links from other sites --> should be handled by redirections


One plan:
* Move all content pages into a subfolder, including root index.php, e.g. '_content'. All folders except `_common`, `_...`, `.github`, `.well-known`, `cdn`, and `go`, (`resources` and others!) as a starting point.
* In the top-level .htaccess, split out redirects from markdown/php/file extension handling
* Add rewrites for all content pages, to, e.g.:
  1. redirect /windows -> /<lang>/windows (initially, always redirect to /en/windows)
     This could be a static redirect map for the known pages (similar to # per-language landing pages in /.htaccess)
  2. rewrite /<lang>/windows to /_content/windows?lang=<lang> --> redesigning the PHP and Markdown rewriting section of .htaccess to work with localization.

    PSEUDOCODE:

     # Rewrite /<lang>/...
    RewriteCond "$1" !-f
    RewriteCond "$1" !-d
    RewriteRule "^/([a-z][a-z])/(.+)$/" "/_content/$2?lang=$1" [??? include query string, last]

    Perhaps `([a-z][a-z])` should be a better quality match, e.g. exclude known strings such as cdn,web,go,...?

  3. rewrite for .md would embed the lang parameter and the appropriate _content path also.

* Fixup absolute links in _content/ files to relative links
* Fixup absolute links in header files to relative links (make a helper function?)
