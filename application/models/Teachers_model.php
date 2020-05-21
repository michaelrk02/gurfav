<?php

class Teachers_model extends CI_Model {

    public $items = 15;

    public function __construct() {
        $this->load->database();
        $this->load->helper('fetch');
    }

    public function get($name) {
        $this->db->select('*')->from('teachers');
        $this->db->where('name =', $name);

        return fetch($this->db);
    }

    public function get_all($search, $page) {
        $items = $this->items;

        $this->db->select('name, course')->from('teachers');
        $this->db->like('name', $search);
        $this->db->limit($items, ($page - 1) * $items);

        return fetch($this->db, -1);
    }

    public function get_all_count($search) {
        $items = $this->items;

        $this->db->select('*')->from('teachers');
        $this->db->like('name', $search);

        return $this->db->count_all_results();
    }

    public function get_all_nofilter() {
        $this->db->select('name, course')->from('teachers');

        return fetch($this->db, -1);
    }

    public function vote($name, $category) {
        $teacher = $this->get($name);
        if (isset($teacher)) {
            $category_col = 'voters_'.$category;
            $this->db->where('name =', $name);
            $this->db->update('teachers', array($category_col => $teacher->$category_col + 1));

            return TRUE;
        }
        return FALSE;
    }

    public function get_winner($category) {
        $this->db->select('*')->from('teachers');
        $this->db->order_by('voters_'.$category, 'DESC');
        $this->db->limit(1);

        return fetch($this->db);
    }

}

?>
