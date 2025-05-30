<?php
/**
 * Plugin Name: ARSOL Plugin Boilerplate
 * Plugin URI: https://arsol.com
 * Description: A WordPress plugin boilerplate for ARSOL
 * Version: 1.0.0
 * Author: ARSOL
 * Author URI: https://arsol.com
 * Text Domain: arsol-plugin-boilerplate
 * Domain Path: /languages
 * Requires at least: 5.8
 * Requires PHP: 7.4
 * 
 * @package ARSOL_Plugin_Boilerplate
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Load plugin setup
require_once plugin_dir_path(__FILE__) . 'includes/setup.php';

// Initialize main plugin class
add_action('plugins_loaded', function() {
    \ArsolPluginBoilerplate\Classes\Core\Plugin::get_instance();
});

// Register activation and deactivation hooks
register_activation_hook(__FILE__, ['\ArsolPluginBoilerplate\Classes\Core\Plugin', 'activate']);
register_deactivation_hook(__FILE__, ['\ArsolPluginBoilerplate\Classes\Core\Plugin', 'deactivate']);
