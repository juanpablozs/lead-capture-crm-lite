<?php
/**
 * The public-facing functionality of the plugin.
 *
 * This class is responsible for handling the frontend functionality,
 * including the lead capture form.
 *
 * @package Lead_Capture_CRM_Lite
 */

class Lead_Capture_CRM_Lite_Public {

    /**
     * The constructor.
     */
    public function __construct() {
        // Add shortcode for lead capture form
        add_shortcode('lead_capture_form', [$this, 'render_lead_capture_form']);
    }

    /**
     * Render the lead capture form.
     *
     * @return string HTML output of the lead capture form.
     */
    public function render_lead_capture_form() {
        ob_start();
        include plugin_dir_path(__FILE__) . 'partials/lead-form.php';
        return ob_get_clean();
    }

    /**
     * Enqueue public styles and scripts.
     */
    public function enqueue_styles() {
        wp_enqueue_style('lead-capture-crm-lite-public', plugin_dir_url(__FILE__) . 'assets/css/public.css', [], '1.0.0', 'all');
    }

    public function enqueue_scripts() {
        wp_enqueue_script('lead-capture-crm-lite-public', plugin_dir_url(__FILE__) . 'assets/js/public.js', ['jquery'], '1.0.0', true);
    }
}
?>