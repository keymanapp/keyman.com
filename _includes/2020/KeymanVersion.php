<?php
  declare(strict_types=1);

  namespace Keyman\Site\com\keyman;

  class KeymanVersion {
    /* These constant values must be updated manually when we do a beta or stable release. */
    public const stable_version_int = 17;
    public const beta_version_int = 17;
    public const stable_version = '17.0';
    public const beta_version = '17.0';

    public const unicode_version = '15.0';

    static function IsBetaTier(): bool {
      return self::beta_version_int > self::stable_version_int;
    }
  }
