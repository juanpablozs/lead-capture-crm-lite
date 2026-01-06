<?php
// leads-page.php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class Leads_Page {

    public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_leads_page' ) );
    }

    public function add_leads_page() {
        add_menu_page(
            __( 'Leads', 'lead-capture-crm-lite' ),
            __( 'Leads', 'lead-capture-crm-lite' ),
            'manage_options',
            'leads_page',
            array( $this, 'render_leads_page' ),
            'dashicons-list-view',
            6
        );
    }

    public function render_leads_page() {
        ?>
        <div class="wrap">
            <h1><?php esc_html_e( 'Manage Leads', 'lead-capture-crm-lite' ); ?></h1>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th><?php esc_html_e( 'ID', 'lead-capture-crm-lite' ); ?></th>
                        <th><?php esc_html_e( 'Name', 'lead-capture-crm-lite' ); ?></th>
                        <th><?php esc_html_e( 'Email', 'lead-capture-crm-lite' ); ?></th>
                        <th><?php esc_html_e( 'Date', 'lead-capture-crm-lite' ); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch leads from the database and display them here
                    // Example data for demonstration
                    $leads = array(
                        array( 'id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com', 'date' => '2023-10-01' ),
                        array( 'id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com', 'date' => '2023-10-02' ),
                    );

                    foreach ( $leads as $lead ) {
                        echo '<tr>';
                        echo '<td>' . esc_html( $lead['id'] ) . '</td>';
                        echo '<td>' . esc_html( $lead['name'] ) . '</td>';
                        echo '<td>' . esc_html( $lead['email'] ) . '</td>';
                        echo '<td>' . esc_html( $lead['date'] ) . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
    }
}

new Leads_Page();
?>