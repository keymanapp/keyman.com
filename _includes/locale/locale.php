<?php

  $locales = [
    'en'    => 'English', // Default
    'es-ES' => 'Española',
    'fr-FR' => 'Français'
  ];

  /**
   * Use textdomain to specify the localization file for "localization".
   * Ignore if locale is "en" or the filename doesn't exist
   * Filename expected  to be "$basename-$locale.mo"
   * locale - xx-YY locale as specified in crowdin %locale%
   * basename - base name of the .mo file to use
   */
  function setTextDomain($locale, $basename) {
    $filename = sprintf("%s-%s", $basename, $locale);
    $fullPath = __DIR__ . "/en/LC_MESSAGES/" . $filename . ".mo";
    if(file_exists($fullPath)) {
      textdomain($filename);
    } else {
      # Log or warn?
      return;
    }
  }

  /**
   * Wrapper to format string with gettext '_(' alias and variable args
   * s - the format string
   * args - optional remaining args to the format string
   */
  function _s($s, ...$args) {
    return vsprintf(_($s), $args);    
  }

  /**
   * Wrapper of echo and _s
   */
  function echo_s($s, ...$args) {
    $tempString = _s($s, $args);
    echo '$tempString';
  }


