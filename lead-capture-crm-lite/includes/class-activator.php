<?php
/**
 * The activator class.
 *
 * This class is responsible for handling tasks that need to be performed
 * during the activation of the plugin, such as creating custom post types.
 */
class Lead_Capture_CRM_Lite_Activator {

    /**
     * Activation hook.
     */
    public static function activate() {
        // Create custom post types or any other activation tasks here.
        self::create_lead_post_type();
    }

    /**
     * Create the lead custom post type.
     */
    private static function create_lead_post_type() {
        register_post_type('lead', array(
            'labels' => array(
                'name' => __('Leads'),
                'singular_name' => __('Lead'),
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'custom-fields'),
        ));
    }
}