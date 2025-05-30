<?php
/**
 * Helper functions
 *
 * @package ArsolSaasForWoo
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get plugin settings
 *
 * @param string $key Setting key
 * @param mixed $default Default value
 * @return mixed
 */
function arsol_get_setting($key, $default = '') {
    $settings = get_option('arsol_saas_settings', []);
    return isset($settings[$key]) ? $settings[$key] : $default;
}

/**
 * Update plugin settings
 *
 * @param string $key Setting key
 * @param mixed $value Setting value
 * @return bool
 */
function arsol_update_setting($key, $value) {
    $settings = get_option('arsol_saas_settings', []);
    $settings[$key] = $value;
    return update_option('arsol_saas_settings', $settings);
} 