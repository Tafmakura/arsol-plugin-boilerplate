<?php
namespace ArsolPluginBoilerplate\Classes\Admin;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Admin Class
 *
 * @package ArsolPluginBoilerplate\Classes\Admin
 */
class Admin {
    /**
     * Admin instance
     *
     * @var Admin
     */
    private static $instance = null;

    /**
     * Plugin path
     * @var string
     */
    private $plugin_path;

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
        $this->plugin_path = plugin_dir_path(dirname(dirname(__FILE__)));
        $this->init_hooks();
    }

    /**
     * Initialize hooks
     */
    private function init_hooks() {
        add_action('admin_enqueue_scripts', [$this, 'enqueue_scripts']);
    }

    /**
     * Enqueue admin scripts
     */
    public function enqueue_scripts() {
        wp_enqueue_style(
            'arsol-plugin-admin',
            ARSOL_PLUGIN_URL . 'assets/css/admin.css',
            array(),
            ARSOL_PLUGIN_VERSION
        );

        wp_enqueue_script(
            'arsol-plugin-admin',
            ARSOL_PLUGIN_URL . 'assets/js/admin.js',
            array('jquery'),
            ARSOL_PLUGIN_VERSION,
            true
        );
    }

    /**
     * Get template part
     * @param string $template Template path
     * @param array $args Arguments to pass to template
     */
    public function get_template($template, $args = []) {
        if (!empty($args)) {
            extract($args);
        }

        $template_path = $this->plugin_path . 'includes/ui/templates/' . $template;

        if (file_exists($template_path)) {
            include $template_path;
        }
    }

    /**
     * Get partial
     * @param string $partial Partial path
     * @param array $args Arguments to pass to partial
     */
    public function get_partial($partial, $args = []) {
        if (!empty($args)) {
            extract($args);
        }

        $partial_path = $this->plugin_path . 'includes/ui/partials/admin/' . $partial;

        if (file_exists($partial_path)) {
            include $partial_path;
        }
    }
} 