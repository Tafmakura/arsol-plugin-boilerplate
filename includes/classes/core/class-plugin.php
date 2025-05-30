<?php
namespace ArsolPluginBoilerplate\Classes\Core;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Main Plugin Class
 */
class Plugin {
    /**
     * Plugin instance
     * @var Plugin
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
        // Add your hooks here
        add_action('init', array($this, 'init'));
    }

    /**
     * Initialize plugin
     */
    public function init() {
        // Initialize plugin
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
     * @return Plugin
     */
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
} 