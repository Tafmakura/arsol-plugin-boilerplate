<?php
namespace ArsolPluginBoilerplate\Classes\Admin;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class Admin {
    /**
     * Plugin path
     * @var string
     */
    private $plugin_path;

    /**
     * Hello World instance
     * @var HelloWorld
     */
    private $hello_world;

    /**
     * Constructor
     */
    public function __construct() {
        $this->plugin_path = plugin_dir_path(dirname(dirname(__FILE__)));
        $this->init();
    }

    /**
     * Initialize
     */
    public function init() {
        add_action('admin_menu', [$this, 'add_menu_pages']);
        $this->hello_world = new HelloWorld();
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
            [$this->hello_world, 'render_page'],
            'dashicons-admin-generic',
            30
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