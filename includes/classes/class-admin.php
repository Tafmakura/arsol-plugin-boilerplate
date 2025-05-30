<?php
namespace ArsolSaasForWoo\Classes;

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
     * Constructor
     */
    public function __construct() {
        $this->plugin_path = ARSOL_SAAS_PLUGIN_DIR;
    }

    /**
     * Register hooks
     */
    public function register() {
        add_action('admin_menu', [$this, 'add_admin_menu']);
    }

    /**
     * Add admin menu items
     */
    public function add_admin_menu() {
        add_menu_page(
            __('ARSOL SaaS', 'arsol-saas-for-woo-subscriptions'),
            __('ARSOL SaaS', 'arsol-saas-for-woo-subscriptions'),
            'manage_options',
            'arsol-saas',
            [$this, 'render_dashboard_page'],
            'dashicons-admin-generic'
        );

        add_submenu_page(
            'arsol-saas',
            __('Dashboard', 'arsol-saas-for-woo-subscriptions'),
            __('Dashboard', 'arsol-saas-for-woo-subscriptions'),
            'manage_options',
            'arsol-saas',
            [$this, 'render_dashboard_page']
        );

        add_submenu_page(
            'arsol-saas',
            __('Settings', 'arsol-saas-for-woo-subscriptions'),
            __('Settings', 'arsol-saas-for-woo-subscriptions'),
            'manage_options',
            'arsol-saas-settings',
            [$this, 'render_settings_page']
        );
    }

    /**
     * Render dashboard page
     */
    public function render_dashboard_page() {
        $this->get_template('admin/dashboard.php');
    }

    /**
     * Render settings page
     */
    public function render_settings_page() {
        $this->get_template('admin/settings.php');
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