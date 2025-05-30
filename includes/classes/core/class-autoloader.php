<?php
/**
 * Autoloader class for the plugin
 *
 * @package ArsolPluginBoilerplate
 */

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

        // Split the class name into parts
        $parts = explode('\\', $class);
        
        // Convert the class name to file name format
        $class_name = strtolower(str_replace('_', '-', end($parts)));
        $class_name = 'class-' . $class_name . '.php';

        // Build the directory path
        $dir_parts = array_slice($parts, 0, -1);
        $dir_path = '';
        if (!empty($dir_parts)) {
            $dir_path = strtolower(implode('/', $dir_parts)) . '/';
        }

        // Build the full file path
        $file = ARSOL_PLUGIN_DIR . 'includes/classes/' . $dir_path . $class_name;

        // If the file exists, require it
        if (file_exists($file)) {
            require_once $file;
        }
    }
} 