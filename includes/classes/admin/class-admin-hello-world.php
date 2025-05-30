<?php
namespace ArsolPluginBoilerplate\Classes\Admin;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class HelloWorld {
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
     * Constructor
     */
    public function __construct() {
        $this->plugin_path = plugin_dir_path(dirname(dirname(dirname(__FILE__))));
        $this->init();
    }

    /**
     * Initialize
     */
    public function init() {
        add_action('admin_init', [$this, 'register_settings']);
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
        $this->get_template('admin/hello-world.php', [
            'option_group' => $this->option_group,
        ]);
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
