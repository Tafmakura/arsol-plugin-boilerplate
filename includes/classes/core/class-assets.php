<?php
namespace ArsolPluginBoilerplate\Classes\Core;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Assets class
 */
class Assets {
    /**
     * Assets instance
     * @var Assets
     */
    private static $instance = null;

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
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
    }

    /**
     * Enqueue frontend scripts
     */
    public function enqueue_scripts() {
        wp_enqueue_style(
            'arsol-plugin',
            ARSOL_PLUGIN_URL . 'assets/css/frontend.css',
            array(),
            ARSOL_PLUGIN_VERSION
        );

        wp_enqueue_script(
            'arsol-plugin',
            ARSOL_PLUGIN_URL . 'assets/js/frontend.js',
            array('jquery'),
            ARSOL_PLUGIN_VERSION,
            true
        );
    }

    /**
     * Get assets instance
     * @return Assets
     */
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
} 