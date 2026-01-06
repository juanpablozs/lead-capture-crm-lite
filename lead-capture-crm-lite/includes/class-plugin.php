<?php
/**
 * Lead Capture CRM Lite Plugin Class
 *
 * This class is responsible for initializing the plugin, registering hooks,
 * and including necessary files.
 */
class Lead_Capture_CRM_Lite {

    /**
     * The single instance of the class.
     *
     * @var Lead_Capture_CRM_Lite
     */
    protected static $instance = null;

    /**
     * Main Instance.
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @return Lead_Capture_CRM_Lite - Main instance.
     */
    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
            self::$instance->init();
        }
        return self::$instance;
    }

    /**
     * Initialize the plugin.
     */
    private function init() {
        // Load required files
        $this->includes();

        // Register hooks
        add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
        add_action( 'init', array( 'Lead_Capture_CRM_Lite_CRM', 'register_post_type' ) );
    }

    /**
     * Include necessary files.
     */
    private function includes() {
        require_once plugin_dir_path( __FILE__ ) . 'class-activator.php';
        require_once plugin_dir_path( __FILE__ ) . 'class-deactivator.php';
        require_once plugin_dir_path( __FILE__ ) . 'class-crm.php';
    }

    /**
     * Load plugin textdomain for translation.
     */
    public function load_textdomain() {
        load_plugin_textdomain( 'lead-capture-crm-lite', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
    }
}

// Initialize the plugin
Lead_Capture_CRM_Lite::instance();
?>