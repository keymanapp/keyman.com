<?php
  declare(strict_types=1);

  namespace Keyman\Site\com\keyman;

  use Keyman\Site\Common\KeymanSentry;

  const SENTRY_DSN = 'https://44d5544d7c45466ba1928b9196faf67e@sentry.keyman.com/3';

  class KeymanComSentry {
    static function init() {
      KeymanSentry::Init(SENTRY_DSN);
    }
  }