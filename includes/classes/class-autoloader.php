<?php
namespace ArsolSaasForWoo\Classes;

/**
 * Class Autoloader
 * Handles autoloading of plugin classes
 *
 * @package ArsolSaasForWoo\Classes
 */
class Autoloader {
    /**
     * Plugin directory path
     *
     * @var string
     */
    private $plugin_dir;

    /**
     * Constructor
     */
    public function __construct() {
        $this->plugin_dir = ARSOL_SAAS_PLUGIN_DIR;
        $this->register();
    }

    /**
     * Register the autoloader
     */
    public function register() {
        spl_autoload_register([$this, 'autoload']);
    }

    /**
     * Autoload classes
     *
     * @param string $class Class name
     */
    public function autoload($class) {
        // Only handle classes in our namespace
        if (strpos($class, 'ArsolSaasForWoo\\') !== 0) {
            return;
        }

        // Remove namespace from class name
        $class = str_replace('ArsolSaasForWoo\\', '', $class);

        // Handle Classes namespace
        if (strpos($class, 'Classes\\') === 0) {
            $class = str_replace('Classes\\', '', $class);
            $path = $this->plugin_dir . 'includes/classes/';
        } else {
            $path = $this->plugin_dir . 'includes/';
        }

        // Convert class name to file path
        $file = str_replace('\\', DIRECTORY_SEPARATOR, $class);
        $file = strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', $file));
        $file = 'class-' . $file . '.php';

        // Build full path
        $full_path = $path . $file;

        // Load file if it exists
        if (file_exists($full_path)) {
            require_once $full_path;
        }
    }
} 