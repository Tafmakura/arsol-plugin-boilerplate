<?php
namespace ArsolPluginBoilerplate\Classes\Core;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Main Plugin Class
 *
 * @package ArsolPluginBoilerplate\Classes\Core
 */
class Plugin {
    /**
     * Plugin instance
     *
     * @var Plugin
     */
    private static $instance = null;

    /**
     * Admin instance
     *
     * @var \ArsolPluginBoilerplate\Classes\Admin\Admin
     */
    private $admin;

    /**
     * Shortcodes instance
     * @var \ArsolPluginBoilerplate\Classes\Frontend\Shortcodes
     */
    private $shortcodes;

    /**
     * Assets instance
     * @var \ArsolPluginBoilerplate\Classes\Core\Assets
     */
    private $assets;

    /**
     * Constructor
     */
    private function __construct() {
        $this->define_constants();
        $this->init_hooks();
    }

    /**
     * Define plugin constants
     */
    private function define_constants() {
        define('ARSOL_PLUGIN_VERSION', '1.0.0');
        define('ARSOL_PLUGIN_PATH', plugin_dir_path(dirname(dirname(dirname(__FILE__))))); // points to plugin root
        define('ARSOL_PLUGIN_URL', plugin_dir_url(dirname(dirname(dirname(__FILE__))))); // points to plugin root
    }

    /**
     * Initialize hooks
     */
    private function init_hooks() {
        // Initialize admin
        if (is_admin()) {
            $this->admin = new \ArsolPluginBoilerplate\Classes\Admin\Admin();
        }

        // Initialize shortcodes
        $this->shortcodes = new \ArsolPluginBoilerplate\Classes\Frontend\Shortcodes();

        // Initialize assets
        $this->assets = new \ArsolPluginBoilerplate\Classes\Core\Assets();
    }

    /**
     * Plugin activation
     */
    public static function activate() {
        // Activation logic here
    }

    /**
     * Plugin deactivation
     */
    public static function deactivate() {
        // Deactivation logic here
    }

    /**
     * Get plugin instance
     *
     * @return Plugin
     */
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Get admin instance
     *
     * @return \ArsolPluginBoilerplate\Classes\Admin\Admin
     */
    public function get_admin() {
        return $this->admin;
    }

    /**
     * Get shortcodes instance
     *
     * @return \ArsolPluginBoilerplate\Classes\Frontend\Shortcodes
     */
    public function get_shortcodes() {
        return $this->shortcodes;
    }

    /**
     * Get assets instance
     *
     * @return \ArsolPluginBoilerplate\Classes\Core\Assets
     */
    public function get_assets() {
        return $this->assets;
    }
} 