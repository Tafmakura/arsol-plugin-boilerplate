<?php
namespace ArsolPluginBoilerplate\Classes\Core;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class Autoloader
 * Handles autoloading of plugin classes
 *
 * @package ArsolPluginBoilerplate\Classes\Core
 */
class Autoloader {
    /**
     * Register autoloader
     */
    public static function register() {
        spl_autoload_register([self::class, 'autoload']);
    }

    /**
     * Autoload classes
     * 
     * @param string $class Class name
     */
    public static function autoload($class) {
        // Only handle our namespace
        if (strpos($class, 'ArsolPluginBoilerplate\\') !== 0) {
            return;
        }

        // Remove namespace
        $class = str_replace('ArsolPluginBoilerplate\\', '', $class);

        // Convert namespace to file path
        $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

        // Convert class name to file name
        $class = strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', $class));

        // Build file path
        $file = ARSOL_PLUGIN_DIR . 'includes/classes/' . $class . '.php';

        // Load file if it exists
        if (file_exists($file)) {
            require_once $file;
        }
    }
} 