<?php
/**
 * Plugin setup and initialization
 *
 * @package ArsolPluginBoilerplate
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('ARSOL_PLUGIN_VERSION', '1.0.0');
define('ARSOL_PLUGIN_DIR', plugin_dir_path(dirname(__FILE__)));
define('ARSOL_PLUGIN_URL', plugin_dir_url(dirname(__FILE__)));

// Load autoloader class
require_once ARSOL_PLUGIN_DIR . 'includes/classes/class-autoloader.php';

// Initialize autoloader
\ArsolPluginBoilerplate\Classes\Core\Autoloader::register();

// Autoload all function files
require_once ARSOL_PLUGIN_DIR . 'includes/functions/functions-autoloader.php';

/**
 * Initialize the plugin
 */
function arsol_plugin_init() {
    // Initialize main plugin class
    \ArsolPluginBoilerplate\Classes\Plugin::instance();
}

// Hook into WordPress
add_action('plugins_loaded', 'arsol_plugin_init');

/**
 * Plugin activation
 */
function arsol_plugin_boilerplate_activate() {
    // Activation tasks if needed
}

/**
 * Plugin deactivation
 */
function arsol_plugin_boilerplate_deactivate() {
    // Deactivation tasks if needed
}

// Register activation and deactivation hooks
register_activation_hook(dirname(__FILE__) . '/../arsol-plugin-boilerplate.php', 'arsol_plugin_boilerplate_activate');
register_deactivation_hook(dirname(__FILE__) . '/../arsol-plugin-boilerplate.php', 'arsol_plugin_boilerplate_deactivate'); 