<?php
/**
 * Setup class for the plugin
 *
 * @package ArsolPluginBoilerplate
 */

namespace ArsolPluginBoilerplate\Classes;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class Setup
 * Handles manual loading of plugin classes
 *
 * @package ArsolPluginBoilerplate\Classes
 */
class Setup {
    /**
     * Setup instance
     * @var Setup
     */
    private static $instance = null;

    /**
     * Get setup instance
     * @return Setup
     */
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor
     */
    private function __construct() {
        $this->load_classes();
    }

    /**
     * Load plugin classes
     */
    private function load_classes() {
        // Core classes
        require_once ARSOL_PLUGIN_DIR . 'includes/classes/core/class-assets.php';

        // Admin classes
        require_once ARSOL_PLUGIN_DIR . 'includes/classes/admin/class-admin.php';
        require_once ARSOL_PLUGIN_DIR . 'includes/classes/admin/class-admin-hello-world.php';

        // Frontend classes
        require_once ARSOL_PLUGIN_DIR . 'includes/classes/frontend/class-shortcodes.php';

        // Initialize main plugin classes
        Core\Assets::get_instance();
        Admin\Admin::get_instance();
        Admin\HelloWorld::get_instance();
        Frontend\Shortcodes::get_instance();
    }
} 