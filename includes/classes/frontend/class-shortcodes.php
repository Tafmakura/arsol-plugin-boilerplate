<?php
namespace ArsolPluginBoilerplate\Classes\Frontend;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Shortcodes class
 */
class Shortcodes {
    /**
     * Shortcodes instance
     * @var Shortcodes
     */
    private static $instance = null;

    /**
     * Constructor
     */
    private function __construct() {
        $this->init_hooks();
    }

    /**
     * Initialize hooks
     */
    private function init_hooks() {
        add_shortcode('arsol_plugin', array($this, 'render_shortcode'));
    }

    /**
     * Render shortcode
     * @param array $atts Shortcode attributes
     * @return string
     */
    public function render_shortcode($atts) {
        $atts = shortcode_atts(array(
            'title' => __('ARSOL Plugin', 'arsol-plugin-boilerplate'),
        ), $atts, 'arsol_plugin');

        ob_start();
        require ARSOL_PLUGIN_DIR . 'includes/frontend/views/shortcode.php';
        return ob_get_clean();
    }

    /**
     * Get shortcodes instance
     * @return Shortcodes
     */
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
