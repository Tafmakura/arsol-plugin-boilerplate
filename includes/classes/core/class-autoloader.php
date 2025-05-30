<?php
/**
 * Autoloader class for the plugin
 *
 * @package ArsolPluginBoilerplate
 */

namespace ArsolPluginBoilerplate\Classes\Core;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class Autoloader
 */
class Autoloader {
    /**
     * Register the autoloader
     */
    public static function register() {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
     * Autoload classes
     *
     * @param string $class The class name to autoload.
     */
    public static function autoload($class) {
        // Only handle classes in our namespace
        if (strpos($class, 'ArsolPluginBoilerplate\\') !== 0) {
            return;
        }

        // Remove namespace from class name
        $class = str_replace('ArsolPluginBoilerplate\\', '', $class);

        // Convert class name format to file name format
        $class = strtolower(str_replace('\\', '-', $class));
        $class = 'class-' . $class . '.php';

        // Build the file path
        $file = ARSOL_PLUGIN_DIR . 'includes/classes/' . $class;

        // If the file exists, require it
        if (file_exists($file)) {
            require_once $file;
        }
    }
} 