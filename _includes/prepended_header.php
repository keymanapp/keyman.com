<?php

// This file is automatically prepended to all PHP requests in order to define
// global constants. The setting is controlled via the root .htaccess, with the
// line:
//
//   php_value auto_prepend_file "/var/www/html/_includes/prepended_header.php"
//
// Do not add any other functionality to this file.

/** Defines the base folder for all keyman.com-specific includes */
define('_KEYMANCOM_INCLUDES', __DIR__);

/** Defines the base folder for all shared common includes */
define('_KEYMANCOM_COMMON', __DIR__ . '/../_common');

/*
global $lang;
if (!isset($lang)) {
    $lang = isset($_REQUEST['lang']) ? $_REQUEST['lang'] : 'en';
} 
*/
