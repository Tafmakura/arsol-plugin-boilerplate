<?php
namespace ArsolPluginBoilerplate\Classes\Core;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class Assets
 * Handles loading of CSS and JS assets
 *
 * @package ArsolPluginBoilerplate\Classes\Core
 */
class Assets {
    /**
     * Plugin path
     * @var string
     */
    private $plugin_path;

    /**
     * Plugin URL
     * @var string
     */
    private $plugin_url;

    /**
     * Constructor
     */
    public function __construct() {
        $this->plugin_path = plugin_dir_path(dirname(dirname(__FILE__)));
        $this->plugin_url = plugin_dir_url(dirname(dirname(__FILE__)));
        $this->init();
    }

    /**
     * Initialize
     */
    public function init() {
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_assets']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_frontend_assets']);
    }

    /**
     * Enqueue admin assets
     */
    public function enqueue_admin_assets() {
        // Enqueue admin styles
        wp_enqueue_style(
            'arsol-plugin-boilerplate-admin',
            $this->plugin_url . 'assets/css/admin.css',
            [],
            ARSOL_PLUGIN_VERSION
        );

        // Enqueue admin scripts
        wp_enqueue_script(
            'arsol-plugin-boilerplate-admin',
            $this->plugin_url . 'assets/js/admin.js',
            ['jquery'],
            ARSOL_PLUGIN_VERSION,
            true
        );
    }

    /**
     * Enqueue frontend assets
     */
    public function enqueue_frontend_assets() {
        // Enqueue frontend styles
        wp_enqueue_style(
            'arsol-plugin-boilerplate-frontend',
            $this->plugin_url . 'assets/css/frontend.css',
            [],
            ARSOL_PLUGIN_VERSION
        );

        // Enqueue frontend scripts
        wp_enqueue_script(
            'arsol-plugin-boilerplate-frontend',
            $this->plugin_url . 'assets/js/frontend.js',
            ['jquery'],
            ARSOL_PLUGIN_VERSION,
            true
        );
    }

    /**
     * Check if current page is a plugin page
     *
     * @return bool
     */
    private function is_plugin_page() {
        $screen = get_current_screen();
        return $screen && strpos($screen->id, 'arsol-plugin') !== false;
    }
} 