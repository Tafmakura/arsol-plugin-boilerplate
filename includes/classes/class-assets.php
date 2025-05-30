<?php
namespace ArsolPluginBoilerplate\Classes;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class Assets
 * Handles loading of CSS and JS assets
 *
 * @package ArsolPluginBoilerplate\Classes
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
        $this->plugin_path = ARSOL_PLUGIN_PATH;
        $this->plugin_url = ARSOL_PLUGIN_URL;
    }

    /**
     * Register hooks
     */
    public function register() {
        // Admin assets
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_assets']);
        
        // Frontend assets
        add_action('wp_enqueue_scripts', [$this, 'enqueue_frontend_assets']);
    }

    /**
     * Enqueue admin assets
     */
    public function enqueue_admin_assets() {
        // Only load on plugin pages
        if (!$this->is_plugin_page()) {
            return;
        }

        // Admin CSS
        wp_enqueue_style(
            'arsol-plugin-admin',
            $this->plugin_url . 'assets/css/arsol-plugin-boilerplate-admin.css',
            [],
            ARSOL_PLUGIN_VERSION
        );

        // Admin JS
        wp_enqueue_script(
            'arsol-plugin-admin',
            $this->plugin_url . 'assets/js/arsol-plugin-boilerplate-admin.js',
            ['jquery'],
            ARSOL_PLUGIN_VERSION,
            true
        );

        // Localize script
        wp_localize_script('arsol-plugin-admin', 'arsolPluginAdmin', [
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('arsol-plugin-admin-nonce'),
        ]);
    }

    /**
     * Enqueue frontend assets
     */
    public function enqueue_frontend_assets() {
        // Frontend CSS
        wp_enqueue_style(
            'arsol-plugin-frontend',
            $this->plugin_url . 'assets/css/arsol-plugin-boilerplate-frontend.css',
            [],
            ARSOL_PLUGIN_VERSION
        );

        // Frontend JS
        wp_enqueue_script(
            'arsol-plugin-frontend',
            $this->plugin_url . 'assets/js/arsol-plugin-boilerplate-frontend.js',
            ['jquery'],
            ARSOL_PLUGIN_VERSION,
            true
        );

        // Localize script
        wp_localize_script('arsol-plugin-frontend', 'arsolPluginFrontend', [
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('arsol-plugin-frontend-nonce'),
        ]);
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