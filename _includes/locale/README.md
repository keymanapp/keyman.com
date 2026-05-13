# Locales

locales.json contains a list of all currently supported locales for the site.
Note that not all pages are necessarily localized.

locales.json is used by the root .htaccess.in (rewritten to .htaccess in
build.sh) and by Locale.php as the source of available locales. All requests
for other locales will be redirected.

The build.sh script avoids reliance on jq and does a basic pass of the file,
so do not change the layout of the file, with one line per language, like
this:

```
  "en": "English",
```
