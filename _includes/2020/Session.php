<?php
  /*
   * Keyman is copyright (C) SIL Global. MIT License.
   */
  declare(strict_types=1);

  namespace Keyman\Site\com\keyman;

  class Session {
    public static function Start() {
      if(!isset($_SESSION)) {
        session_set_cookie_params(["SameSite" => "None"]);   // Allow use in iframe, needed for Download Keyboards dialog
        session_set_cookie_params(["Secure" => "true"]);     // None requires Secure to be set
        session_start();
        $session_started = true;
      }
    }
  }
