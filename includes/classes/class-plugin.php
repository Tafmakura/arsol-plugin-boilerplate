<?php
namespace ArsolPluginBoilerplate;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class Plugin {
    /**
     * Singleton instance
     * @var Plugin
     */
    private static $instance = null;

    /**
     * Get singleton instance
     * @return Plugin
     */
    public static function instance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor
     */
    private function __construct() {
        $this->define_constants();
        add_action('plugins_loaded', [$this, 'init_plugin']);
    }

    /**
     * Define plugin constants
     */
    private function define_constants() {
        define('ARSOL_PLUGIN_VERSION', '1.0.0');
        define('ARSOL_PLUGIN_PATH', plugin_dir_path(dirname(dirname(__FILE__)))); // points to plugin root
        define('ARSOL_PLUGIN_URL', plugin_dir_url(dirname(dirname(__FILE__)))); // points to plugin root
    }

    /**
     * Initialize plugin
     */
    public function init_plugin() {
        // Initialize setup
        Setup::init();

        // Initialize assets
        $assets = new \ArsolPluginBoilerplate\Classes\Assets();
        $assets->register();

        // Initialize admin
        if (is_admin()) {
            $admin = new \ArsolPluginBoilerplate\Classes\Admin();
            $admin->register();
        }
    }

    /**
     * Activation hook
     */
    public static function activate() {
        // Activation logic here
    }

    /**
     * Deactivation hook
     */
    public static function deactivate() {
        // Deactivation logic here
    }
} 