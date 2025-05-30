<?php
/**
 * Hello World partial
 *
 * @package ArsolPluginBoilerplate
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="arsol-hello-world" style="text-align: center; padding: 20px; margin: 20px 0; background: #f8f9fa; border-radius: 5px;">
    <h2><?php echo esc_html($title); ?></h2>
    <p><?php echo esc_html($message); ?></p>
</div> 