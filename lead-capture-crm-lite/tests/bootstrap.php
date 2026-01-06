<?php
// This file sets up the testing environment for PHPUnit.

require_once dirname(__DIR__) . '/lead-capture-crm-lite.php';

function _manually_load_plugin() {
    // Load the plugin for testing
    lead_capture_crm_lite();
}

tests_add_filter('muplugins_loaded', '_manually_load_plugin');