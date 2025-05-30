<?php
namespace ArsolPluginBoilerplate\Classes\Core;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Assets Class
 *
 * @package ArsolPluginBoilerplate\Classes\Core
 */
class Assets {
    /**
     * Assets instance
     *
     * @var Assets
     */
    private static $instance = null;

    /**
     * Plugin path
     * @var string
     */
    private $plugin_path;

    /**
     * Get assets instance
     *
     * @return Assets
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
        $this->plugin_path = plugin_dir_path(dirname(dirname(dirname(__FILE__))));
        $this->init_hooks();
    }

    /**
     * Initialize hooks
     */
    private function init_hooks() {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
    }

    /**
     * Get file version based on last modified time
     * 
     * @param string $file_path Path to the file
     * @return string|bool File modification time or false if file doesn't exist
     */
    private function get_file_version($file_path) {
        $full_path = $this->plugin_path . $file_path;
        return file_exists($full_path) ? filemtime($full_path) : false;
    }

    /**
     * Enqueue scripts
     */
    public function enqueue_scripts() {
        $css_version = $this->get_file_version('assets/css/arsol-plugin-boilerplate-frontend.css');
        $js_version = $this->get_file_version('assets/js/arsol-plugin-boilerplate-frontend.js');

        wp_enqueue_style(
            'arsol-plugin',
            \ARSOL_PLUGIN_URL . 'assets/css/arsol-plugin-boilerplate-frontend.css',
            array(),
            $css_version
        );

        wp_enqueue_script(
            'arsol-plugin',
            \ARSOL_PLUGIN_URL . 'assets/js/arsol-plugin-boilerplate-frontend.js',
            array('jquery'),
            $js_version,
            true
        );
    }
} 