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
 * @package ArsolPluginBoilerplate
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('ARSOL_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('ARSOL_PLUGIN_URL', plugin_dir_url(__FILE__));
define('ARSOL_PLUGIN_VERSION', '1.0.0');

// Load autoloader class
require_once ARSOL_PLUGIN_DIR . 'includes/classes/core/class-autoloader.php';

// Initialize autoloader
\ArsolPluginBoilerplate\Classes\Core\Autoloader::register();

// Load plugin setup
require_once ARSOL_PLUGIN_DIR . 'includes/setup.php';

// Initialize main plugin class
function arsol_plugin_init() {
    \ArsolPluginBoilerplate\Classes\Core\Plugin::get_instance();
}
add_action('plugins_loaded', 'arsol_plugin_init');

// Register activation and deactivation hooks
function arsol_plugin_activate() {
    \ArsolPluginBoilerplate\Classes\Core\Plugin::activate();
}
register_activation_hook(__FILE__, 'arsol_plugin_activate');

function arsol_plugin_deactivate() {
    \ArsolPluginBoilerplate\Classes\Core\Plugin::deactivate();
}
register_deactivation_hook(__FILE__, 'arsol_plugin_deactivate');
