<?php
  declare(strict_types=1);

  namespace Keyman\Site\com\keyman;

  class Validation {
    /**
     * validate_tier - checks that tier  is one of stable, alpha or beta, and lower-cases and trims.
     * @param string $tier    - ['stable', 'alpha', or 'beta']
     * @param string $default - what to return if it isn't valid
     * @return string a valid tier (or $default if not valid)
     */
    public static function validate_tier($tier, $default = null) {
      if($tier === null) return $default;
      $tier = trim(strtolower($tier));
      if (in_array($tier, array('alpha', 'beta', 'stable'))) {
        return $tier;
      }
      return $default;
    }

    /**
     * validate_bcp47 - check that a BCP 47 code is valid, and lower-cases and trims
     * @param string $bcp47   - a BCP 47 code
     * @param string $default - what to return if it is not valid
     * @return string either the valid BCP 47 code or default
     */
    public static function validate_bcp47($bcp47, $default = null) {
      if($bcp47 === null) return $default;
      $bcp47 = trim(strtolower($bcp47));
      // RegEx from https://stackoverflow.com/questions/7035825/regular-expression-for-a-language-tag-as-defined-by-bcp47, https://stackoverflow.com/a/34775980/1836776
      if(preg_match("/^(?<grandfathered>(?:en-GB-oed|i-(?:ami|bnn|default|enochian|hak|klingon|lux|mingo|navajo|pwn|t(?:a[oy]|su))|sgn-(?:BE-(?:FR|NL)|CH-DE))|(?:art-lojban|cel-gaulish|no-(?:bok|nyn)|zh-(?:guoyu|hakka|min(?:-nan)?|xiang)))|(?:(?<language>(?:[A-Za-z]{2,3}(?:-(?<extlang>[A-Za-z]{3}(?:-[A-Za-z]{3}){0,2}))?)|[A-Za-z]{4}|[A-Za-z]{5,8})(?:-(?<script>[A-Za-z]{4}))?(?:-(?<region>[A-Za-z]{2}|[0-9]{3}))?(?:-(?<variant>[A-Za-z0-9]{5,8}|[0-9][A-Za-z0-9]{3}))*(?:-(?<extension>[0-9A-WY-Za-wy-z](?:-[A-Za-z0-9]{2,8})+))*)(?:-(?<privateUse>x(?:-[A-Za-z0-9]{1,8})+))?$/Di",
          $bcp47)) {
        return $bcp47;
      }
      return $default;
    }

    /**
     * validate_platform - checks provided $platform is valid, and lower-cases and trims
     * @param string $platform - ['android', 'ios', 'linux', 'macos', 'windows']. 'mac' converts to 'macos'
     * @param string $default  - what to return if it isn't valid
     * @return string a valid platform (or $default if not valid)
     */
    public static function validate_platform($platform, $default = null) {
      if($platform === null) return $default;
      $platform = trim(strtolower($platform));
      if(in_array($platform, ['android','ios','linux','macos','windows'])) {
        return $platform;
      }
      if($platform == 'mac') {
        return 'macos';
      }
      return $default;
    }
  }