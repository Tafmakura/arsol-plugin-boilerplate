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
     * @var Admin
     */
    private $admin;

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
     * Constructor
     */
    private function __construct() {
        $this->init_hooks();
    }

    /**
     * Initialize hooks
     */
    private function init_hooks() {
        // Initialize admin
        if (is_admin()) {
            $this->admin = new Admin();
        }
    }

    /**
     * Plugin activation
     */
    public static function activate() {
        // Activation tasks
    }

    /**
     * Plugin deactivation
     */
    public static function deactivate() {
        // Deactivation tasks
    }
} 