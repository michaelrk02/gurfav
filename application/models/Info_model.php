<?php

class Info_model extends CI_Model {

    public function __construct() {
        $this->load->database();
        $this->load->helper('fetch');
    }

    public function get($key) {
        $this->db->select('value')->from('info');
        $this->db->where('key =', $key);

        $entry = fetch($this->db);
        if (isset($entry)) {
            return $entry->value;
        }

        return NULL;
    }

}

?>
