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

// Load plugin setup
require_once ARSOL_PLUGIN_DIR . 'includes/setup.php';

