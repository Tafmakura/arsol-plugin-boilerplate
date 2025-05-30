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
     * Hello World instance
     * @var HelloWorld
     */
    private $hello_world;

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
        add_action('admin_menu', [$this, 'add_menu_pages']);
        add_action('admin_init', [$this, 'handle_form_submission']);
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
            [$this, 'render_page'],
            'dashicons-admin-generic',
            30
        );
    }

    /**
     * Handle form submission
     */
    public function handle_form_submission() {
        if (!isset($_POST['arsol_hello_world_nonce']) || !wp_verify_nonce($_POST['arsol_hello_world_nonce'], 'arsol_hello_world_save')) {
            return;
        }

        if (!current_user_can('manage_options')) {
            return;
        }

        if (isset($_POST['arsol_hello_world_message'])) {
            $message = sanitize_text_field($_POST['arsol_hello_world_message']);
            update_option('arsol_hello_world_message', $message);
            wp_redirect(add_query_arg('settings-updated', 'true'));
            exit;
        }
    }

    /**
     * Render admin page
     */
    public function render_page() {
        require_once ARSOL_PLUGIN_DIR . 'includes/ui/templates/admin/hello-world.php';
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