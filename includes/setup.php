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

// Load autoloader class
require_once ARSOL_PLUGIN_DIR . 'includes/classes/core/class-autoloader.php';

// Initialize autoloader
\ArsolPluginBoilerplate\Classes\Core\Autoloader::register();

/**
 * Initialize plugin
 */
function arsol_plugin_init() {
    // Add your initialization code here
    add_action('init', 'arsol_plugin_setup');
}

/**
 * Setup plugin
 */
function arsol_plugin_setup() {
    // Add your setup code here
    load_plugin_textdomain('arsol-plugin-boilerplate', false, dirname(plugin_basename(ARSOL_PLUGIN_DIR)) . '/languages');
}

/**
 * Plugin activation
 */
function arsol_plugin_activate() {
    // Add your activation code here
    flush_rewrite_rules();
}

/**
 * Plugin deactivation
 */
function arsol_plugin_deactivate() {
    // Add your deactivation code here
    flush_rewrite_rules();
}

// Load function files
require_once ARSOL_PLUGIN_DIR . 'includes/functions/functions-autoloader.php';