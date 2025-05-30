<?php
/**
 * Admin Hello World partial
 *
 * @package ArsolPluginBoilerplate
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Get saved value
$saved_message = get_option('arsol_hello_world_message', '');
?>

<div class="wrap">
    <h1><?php echo esc_html__('Hello World!', 'arsol-plugin-boilerplate'); ?></h1>
    
    <?php if (isset($_GET['settings-updated'])) : ?>
        <div class="notice notice-success is-dismissible">
            <p><?php echo esc_html__('Settings saved successfully!', 'arsol-plugin-boilerplate'); ?></p>
        </div>
    <?php endif; ?>

    <form method="post" action="">
        <?php wp_nonce_field('arsol_hello_world_save', 'arsol_hello_world_nonce'); ?>
        <table class="form-table">
            <tr>
                <th scope="row">
                    <label for="arsol_hello_world_message"><?php echo esc_html__('Message', 'arsol-plugin-boilerplate'); ?></label>
                </th>
                <td>
                    <input type="text" id="arsol_hello_world_message" name="arsol_hello_world_message" value="<?php echo esc_attr($saved_message); ?>" class="regular-text">
                </td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>

    <?php if ($saved_message) : ?>
        <div class="arsol-message-preview" style="margin-top: 20px; padding: 20px; background: #f8f9fa; border-radius: 5px;">
            <h3><?php echo esc_html__('Message Preview:', 'arsol-plugin-boilerplate'); ?></h3>
            <p><?php echo esc_html($saved_message); ?></p>
        </div>
    <?php endif; ?>
</div> 