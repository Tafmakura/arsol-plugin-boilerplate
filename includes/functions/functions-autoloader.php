<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Autoload all PHP files in the functions directory with functions-* prefix except this one
foreach (glob(__DIR__ . '/functions-*.php') as $file) {
    if (basename($file) !== basename(__FILE__)) {
        require_once $file;
    }
} 