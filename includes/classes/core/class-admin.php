<?php
namespace ArsolPluginBoilerplate\Classes\Core;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Admin Class
 *
 * @package ArsolPluginBoilerplate\Classes\Core
 */
class Admin {
    /**
     * Admin instance
     *
     * @var Admin
     */
    private static $instance = null;

    /**
     * Get admin instance
     *
     * @return Admin
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
        $this->init_hooks();
    }

    /**
     * Initialize hooks
     */
    private function init_hooks() {
        add_action('admin_menu', [$this, 'add_menu_pages']);
    }

    /**
     * Add menu pages
     */
    public function add_menu_pages() {
        add_menu_page(
            __('ARSOL Plugin', 'arsol-plugin-boilerplate'),
            __('ARSOL Plugin', 'arsol-plugin-boilerplate'),
            'manage_options',
            'arsol-plugin',
            [$this, 'render_page'],
            'dashicons-admin-generic',
            30
        );
    }

    /**
     * Render admin page
     */
    public function render_page() {
        require_once ARSOL_PLUGIN_DIR . 'includes/ui/templates/admin/hello-world.php';
    }
} 