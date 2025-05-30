<?php
namespace ArsolPluginBoilerplate\Classes\Admin;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class HelloWorld {
    /**
     * HelloWorld instance
     * @var HelloWorld
     */
    private static $instance = null;

    /**
     * Plugin path
     * @var string
     */
    private $plugin_path;

    /**
     * Settings group name
     * @var string
     */
    private $option_group = 'arsol_hello_world_options';

    /**
     * Settings page
     * @var string
     */
    private $page = 'arsol_hello_world_options';

    /**
     * Get HelloWorld instance
     * @return HelloWorld
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
        $this->init();
    }

    /**
     * Initialize
     */
    public function init() {
        add_action('admin_menu', [$this, 'add_menu_page']);
        add_action('admin_init', [$this, 'register_settings']);
    }

    /**
     * Add menu page
     */
    public function add_menu_page() {
        add_menu_page(
            __('Hello World', 'arsol-plugin-boilerplate'),
            __('Hello World', 'arsol-plugin-boilerplate'),
            'manage_options',
            'arsol-hello-world',
            [$this, 'render_page'],
            'dashicons-admin-generic',
            30
        );
    }

    /**
     * Register settings
     */
    public function register_settings() {
        // Register setting
        register_setting(
            $this->option_group,
            'arsol_hello_world_message',
            [
                'type' => 'string',
                'sanitize_callback' => [$this, 'sanitize_message'],
                'default' => '',
                'show_in_rest' => true,
            ]
        );

        // Add settings section
        add_settings_section(
            'arsol_hello_world_section',
            __('Hello World Settings', 'arsol-plugin-boilerplate'),
            [$this, 'render_section'],
            $this->page
        );

        // Add settings field
        add_settings_field(
            'arsol_hello_world_message',
            __('Custom Message', 'arsol-plugin-boilerplate'),
            [$this, 'render_field'],
            $this->page,
            'arsol_hello_world_section',
            [
                'label_for' => 'arsol_hello_world_message',
                'class' => 'arsol-hello-world-field',
            ]
        );
    }

    /**
     * Handle form submission
     */
    public function handle_form_submission() {
        if (!isset($_POST['arsol_hello_world_nonce']) || !wp_verify_nonce($_POST['arsol_hello_world_nonce'], 'arsol_hello_world_save')) {
            return;
        }

        if (!current_user_can('manage_options')) {
            return;
        }

        if (isset($_POST['arsol_hello_world_message'])) {
            $message = sanitize_text_field($_POST['arsol_hello_world_message']);
            update_option('arsol_hello_world_message', $message);
            wp_redirect(add_query_arg('settings-updated', 'true'));
            exit;
        }
    }

    /**
     * Render section description
     */
    public function render_section() {
        echo '<p>' . esc_html__('Configure your Hello World message settings.', 'arsol-plugin-boilerplate') . '</p>';
    }

    /**
     * Render field
     * 
     * @param array $args Field arguments
     */
    public function render_field($args) {
        $value = get_option('arsol_hello_world_message', '');
        ?>
        <input type="text" 
               id="<?php echo esc_attr($args['label_for']); ?>" 
               name="arsol_hello_world_message" 
               value="<?php echo esc_attr($value); ?>" 
               class="regular-text">
        <p class="description">
            <?php echo esc_html__('Enter a custom message to display.', 'arsol-plugin-boilerplate'); ?>
        </p>
        <?php
    }

    /**
     * Sanitize message
     * 
     * @param string $message Message to sanitize
     * @return string Sanitized message
     */
    public function sanitize_message($message) {
        return sanitize_text_field($message);
    }

    /**
     * Render page
     */
    public function render_page() {
        require_once ARSOL_PLUGIN_DIR . 'includes/ui/templates/admin/hello-world.php';
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
