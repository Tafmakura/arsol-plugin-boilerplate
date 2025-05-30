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
define('ARSOL_PLUGIN_DIR', plugin_dir_path(dirname(__FILE__)));
define('ARSOL_PLUGIN_URL', plugin_dir_url(dirname(__FILE__)));

// Load autoloader class
require_once ARSOL_PLUGIN_DIR . 'includes/classes/core/class-autoloader.php';

// Initialize autoloader
$autoloader = new \ArsolPluginBoilerplate\Classes\Core\Autoloader();
$autoloader->register();

// Autoload all function files
require_once ARSOL_PLUGIN_DIR . 'includes/functions/functions-autoloader.php';