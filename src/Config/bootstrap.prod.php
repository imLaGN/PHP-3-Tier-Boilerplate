<?php

// Error reporting configuration
error_reporting(E_ALL);
ini_set('display_errors', '0'); // don't show errors to users
ini_set('log_errors', '1');     // enable error logging
ini_set('error_log', __DIR__ . '/../logs/php-error.log');