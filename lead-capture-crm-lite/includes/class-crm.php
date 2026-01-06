<?php
/**
 * CRM Class for handling lead creation, storage, and management.
 */
class CRM {
    private $leads = [];

    public function __construct() {
        // Load leads from the database or initialize an empty array
        $this->leads = get_option('crm_leads', []);
    }

    public function add_lead($lead_data) {
        // Validate lead data
        if ($this->validate_lead($lead_data)) {
            $this->leads[] = $lead_data;
            update_option('crm_leads', $this->leads);
            return true;
        }
        return false;
    }

    public function get_leads() {
        return $this->leads;
    }

    public function delete_lead($lead_id) {
        if (isset($this->leads[$lead_id])) {
            unset($this->leads[$lead_id]);
            update_option('crm_leads', $this->leads);
            return true;
        }
        return false;
    }

    private function validate_lead($lead_data) {
        // Basic validation for lead data
        return isset($lead_data['name']) && isset($lead_data['email']);
    }
}
?>