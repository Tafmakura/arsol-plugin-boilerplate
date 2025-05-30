<?php
/**
 * Plugin setup and initialization
 *
 * @package ArsolSaasForWoo
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('ARSOL_SAAS_VERSION', '1.0.0');
define('ARSOL_SAAS_PLUGIN_DIR', plugin_dir_path(dirname(__FILE__)));
define('ARSOL_SAAS_PLUGIN_URL', plugin_dir_url(dirname(__FILE__)));
define('ARSOL_SAAS_PLUGIN_BASENAME', plugin_basename(dirname(__FILE__)));

// Load autoloader class - this needs to be loaded manually since it can't load itself
require_once ARSOL_SAAS_PLUGIN_DIR . 'includes/classes/class-autoloader.php';

// Initialize autoloader
new \ArsolSaasForWoo\Classes\Autoloader();

// Load all function files
$function_files = glob(ARSOL_SAAS_PLUGIN_DIR . 'includes/functions/functions-*.php');
foreach ($function_files as $function_file) {
    require_once $function_file;
}

/**
 * Initialize the plugin
 */
function arsol_saas_init() {
    // Initialize main plugin class
    \ArsolSaasForWoo\Classes\Plugin::instance();
}

// Hook into WordPress
add_action('plugins_loaded', 'arsol_saas_init');

/**
 * Plugin activation
 */
function arsol_saas_activate() {
    // Create necessary database tables
    // Set default options
    // etc.
}

/**
 * Plugin deactivation
 */
function arsol_saas_deactivate() {
    // Cleanup if necessary
}

// Register activation and deactivation hooks
register_activation_hook(dirname(__FILE__) . '/../arsol-saas-for-woo-subscriptions.php', 'arsol_saas_activate');
register_deactivation_hook(dirname(__FILE__) . '/../arsol-saas-for-woo-subscriptions.php', 'arsol_saas_deactivate'); 