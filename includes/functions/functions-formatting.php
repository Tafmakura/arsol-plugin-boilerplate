<?php
/**
 * Formatting functions
 *
 * @package ArsolSaasForWoo
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Format subscription status for display
 *
 * @param string $status Subscription status
 * @return string Formatted status
 */
function arsol_format_subscription_status($status) {
    $statuses = [
        'active' => __('Active', 'arsol-saas-for-woo-subscriptions'),
        'pending' => __('Pending', 'arsol-saas-for-woo-subscriptions'),
        'cancelled' => __('Cancelled', 'arsol-saas-for-woo-subscriptions'),
        'expired' => __('Expired', 'arsol-saas-for-woo-subscriptions'),
    ];

    return isset($statuses[$status]) ? $statuses[$status] : $status;
}

/**
 * Format date for display
 *
 * @param string $date Date string
 * @param string $format Date format
 * @return string Formatted date
 */
function arsol_format_date($date, $format = 'Y-m-d H:i:s') {
    return date_i18n($format, strtotime($date));
} 