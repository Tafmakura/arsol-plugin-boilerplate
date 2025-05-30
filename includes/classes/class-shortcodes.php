<?php
namespace ArsolPluginBoilerplate\Classes\Frontend;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class Shortcodes {
    /**
     * Plugin path
     * @var string
     */
    private $plugin_path;

    /**
     * Constructor
     */
    public function __construct() {
        $this->plugin_path = plugin_dir_path(dirname(dirname(__FILE__)));
        $this->init();
    }

    /**
     * Initialize
     */
    public function init() {
        add_shortcode('arsol_hello_world', [$this, 'hello_world_shortcode']);
    }

    /**
     * Hello World shortcode
     * 
     * @param array $atts Shortcode attributes
     * @return string
     */
    public function hello_world_shortcode($atts) {
        $atts = shortcode_atts([
            'message' => get_option('arsol_hello_world_message', 'Hello World!'),
        ], $atts, 'arsol_hello_world');

        ob_start();
        $this->get_template('frontend/hello-world.php', [
            'message' => $atts['message'],
        ]);
        return ob_get_clean();
    }

    /**
     * Get template
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
}
