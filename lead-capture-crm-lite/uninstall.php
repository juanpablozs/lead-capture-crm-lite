<?php
/**
 * Uninstall the Lead Capture CRM Lite plugin.
 *
 * This file is executed when the plugin is uninstalled.
 */

// If uninstall not called from WordPress, exit.
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Clean up options and data associated with the plugin.
delete_option('lead_capture_crm_settings');
$leads = get_posts(array(
    'post_type' => 'lead',
    'numberposts' => -1,
));

if ($leads) {
    foreach ($leads as $lead) {
        wp_delete_post($lead->ID, true);
    }
}

// Additional cleanup can be added here.
?>