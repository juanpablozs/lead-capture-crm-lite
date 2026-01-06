<?php
// This file contains helper functions used throughout the plugin.

if ( ! function_exists( 'lc_crm_get_option' ) ) {
    /**
     * Get a plugin option.
     *
     * @param string $option_name The name of the option.
     * @param mixed $default The default value if the option does not exist.
     * @return mixed The option value.
     */
    function lc_crm_get_option( $option_name, $default = false ) {
        return get_option( $option_name, $default );
    }
}

if ( ! function_exists( 'lc_crm_update_option' ) ) {
    /**
     * Update a plugin option.
     *
     * @param string $option_name The name of the option.
     * @param mixed $value The value to set.
     * @return bool True on success, false on failure.
     */
    function lc_crm_update_option( $option_name, $value ) {
        return update_option( $option_name, $value );
    }
}

if ( ! function_exists( 'lc_crm_delete_option' ) ) {
    /**
     * Delete a plugin option.
     *
     * @param string $option_name The name of the option.
     * @return bool True on success, false on failure.
     */
    function lc_crm_delete_option( $option_name ) {
        return delete_option( $option_name );
    }
}

if ( ! function_exists( 'lc_crm_send_email' ) ) {
    /**
     * Send an email notification.
     *
     * @param string $to The recipient email address.
     * @param string $subject The email subject.
     * @param string $message The email message.
     * @param array $headers Optional. Additional headers.
     * @return bool True on success, false on failure.
     */
    function lc_crm_send_email( $to, $subject, $message, $headers = array() ) {
        return wp_mail( $to, $subject, $message, $headers );
    }
}

if ( ! function_exists( 'lc_crm_is_valid_email' ) ) {
    /**
     * Validate an email address.
     *
     * @param string $email The email address to validate.
     * @return bool True if valid, false otherwise.
     */
    function lc_crm_is_valid_email( $email ) {
        return filter_var( $email, FILTER_VALIDATE_EMAIL ) !== false;
    }
}
?>