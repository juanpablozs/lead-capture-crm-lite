<?php
/**
 * Lead Capture CRM Lite Admin Class
 *
 * This class handles the admin UI, including settings and lead management.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Lead_Capture_CRM_Lite_Admin {
    
    /**
     * Constructor
     */
    public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );
        add_action( 'admin_init', array( $this, 'settings_init' ) );
    }

    /**
     * Add admin pages
     */
    public function add_admin_pages() {
        add_menu_page( 'Lead Capture CRM Lite', 'Lead Capture', 'manage_options', 'lead_capture_crm_lite', array( $this, 'admin_index' ), 'dashicons-forms', 110 );
        add_submenu_page( 'lead_capture_crm_lite', 'Settings', 'Settings', 'manage_options', 'lead_capture_crm_lite_settings', array( $this, 'settings_page' ) );
        add_submenu_page( 'lead_capture_crm_lite', 'Leads', 'Leads', 'manage_options', 'lead_capture_crm_lite_leads', array( $this, 'leads_page' ) );
    }

    /**
     * Admin index
     */
    public function admin_index() {
        // Load the main admin page
        include_once plugin_dir_path( __FILE__ ) . 'pages/settings-page.php';
    }

    /**
     * Settings page
     */
    public function settings_page() {
        // Load the settings page
        include_once plugin_dir_path( __FILE__ ) . 'pages/settings-page.php';
    }

    /**
     * Leads page
     */
    public function leads_page() {
        // Load the leads management page
        include_once plugin_dir_path( __FILE__ ) . 'pages/leads-page.php';
    }

    /**
     * Initialize settings
     */
    public function settings_init() {
        register_setting( 'leadCaptureCRM', 'lead_capture_crm_settings' );

        add_settings_section(
            'lead_capture_crm_section',
            __( 'Settings', 'lead-capture-crm-lite' ),
            null,
            'leadCaptureCRM'
        );

        add_settings_field(
            'admin_email',
            __( 'Admin Email', 'lead-capture-crm-lite' ),
            array( $this, 'admin_email_render' ),
            'leadCaptureCRM',
            'lead_capture_crm_section'
        );

        add_settings_field(
            'webhook_url',
            __( 'Webhook URL', 'lead-capture-crm-lite' ),
            array( $this, 'webhook_url_render' ),
            'leadCaptureCRM',
            'lead_capture_crm_section'
        );

        add_settings_field(
            'rate_limit',
            __( 'Rate Limit', 'lead-capture-crm-lite' ),
            array( $this, 'rate_limit_render' ),
            'leadCaptureCRM',
            'lead_capture_crm_section'
        );
    }

    /**
     * Render admin email setting
     */
    public function admin_email_render() {
        $options = get_option( 'lead_capture_crm_settings' );
        ?>
        <input type='email' name='lead_capture_crm_settings[admin_email]' value='<?php echo esc_attr( $options['admin_email'] ); ?>'>
        <?php
    }

    /**
     * Render webhook URL setting
     */
    public function webhook_url_render() {
        $options = get_option( 'lead_capture_crm_settings' );
        ?>
        <input type='url' name='lead_capture_crm_settings[webhook_url]' value='<?php echo esc_attr( $options['webhook_url'] ); ?>'>
        <?php
    }

    /**
     * Render rate limit setting
     */
    public function rate_limit_render() {
        $options = get_option( 'lead_capture_crm_settings' );
        ?>
        <input type='number' name='lead_capture_crm_settings[rate_limit]' value='<?php echo esc_attr( $options['rate_limit'] ); ?>'>
        <?php
    }
}
?>