<?php
/**
 * Plugin Name: Lead Capture CRM Lite
 * Description: A lightweight CRM plugin for capturing leads and managing them effectively.
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://yourwebsite.com
 * License: MIT
 * Text Domain: lead-capture-crm-lite
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define plugin constants
define( 'LCCRL_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'LCCRL_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Include necessary files
require_once LCCRL_PLUGIN_DIR . 'includes/class-activator.php';
require_once LCCRL_PLUGIN_DIR . 'includes/class-deactivator.php';
require_once LCCRL_PLUGIN_DIR . 'includes/class-plugin.php';
require_once LCCRL_PLUGIN_DIR . 'includes/class-crm.php';
require_once LCCRL_PLUGIN_DIR . 'includes/functions.php';
require_once LCCRL_PLUGIN_DIR . 'admin/class-admin.php';
require_once LCCRL_PLUGIN_DIR . 'public/class-public.php';

// Activation and deactivation hooks
register_activation_hook( __FILE__, array( 'LCCRL_Activator', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'LCCRL_Deactivator', 'deactivate' ) );

// Initialize the plugin
add_action( 'plugins_loaded', array( 'LCCRL_Plugin', 'get_instance' ) );
?>