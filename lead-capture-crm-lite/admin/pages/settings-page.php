<?php
// settings-page.php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class Lead_Capture_CRM_Lite_Settings_Page {

    public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_settings_page' ) );
    }

    public function add_settings_page() {
        add_options_page(
            'Lead Capture CRM Lite Settings',
            'Lead Capture CRM Lite',
            'manage_options',
            'lead-capture-crm-lite-settings',
            array( $this, 'create_settings_page' )
        );
    }

    public function create_settings_page() {
        ?>
        <div class="wrap">
            <h1>Lead Capture CRM Lite Settings</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields( 'lead_capture_crm_lite_options_group' );
                do_settings_sections( 'lead_capture_crm_lite_settings' );
                ?>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">Admin Email</th>
                        <td>
                            <input type="email" name="lead_capture_crm_lite_admin_email" value="<?php echo esc_attr( get_option('lead_capture_crm_lite_admin_email') ); ?>" />
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Webhook URL</th>
                        <td>
                            <input type="url" name="lead_capture_crm_lite_webhook_url" value="<?php echo esc_attr( get_option('lead_capture_crm_lite_webhook_url') ); ?>" />
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Rate Limit</th>
                        <td>
                            <input type="number" name="lead_capture_crm_lite_rate_limit" value="<?php echo esc_attr( get_option('lead_capture_crm_lite_rate_limit') ); ?>" />
                        </td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }
}

new Lead_Capture_CRM_Lite_Settings_Page();
?>