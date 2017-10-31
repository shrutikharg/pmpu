<?php

class Companycategory_model extends CI_Model {

    /**
     * Responsable for auto load the database
     * @return void
     */
    public function __construct() {
        $this->load->database();
    }

    /**
     * Get product by his is
     * @param int $product_id 
     * @return array
     */
    public function get_category_by_id($id) {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('id', $id);
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_category_list() {
        $this->db->from('category');
        $this->db->where('is_active', 'Y');
        // $this->db->where('created_by', $userid);
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_category_droplist($userid) {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('is_active', 'Y');
        // $this->db->where('created_by', $userid);
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Fetch category data from the database
     * possibility to mix search, filter and order
     * @param string $search_string 
     * @param strong $order
     * @param string $order_type 
     * @param int $limit_start
     * @param int $limit_end
     * @return array
     */
    public function get_category($userid, $sidx, $sord, $start, $limit, $search_string_array, $count) {

        $this->db->select('*');
        $this->db->from('category');
        //  $this->db->where('created_by', $userid);
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $this->db->where('is_active', 'Y');
        if ($search_string_array != "") {
            $this->db->like('name', $search_string_array->search_string);
        }
        $this->db->order_by("$sidx $sord");
        if ($count == false) {
            $this->db->limit($limit, $start);
        }

        $query = $this->db->get();

        if ($count == false) {
            return $query;
        } else {
            return $query->num_rows();
        }
    }

    public function get_category_by_name($userid, $search_string_array) {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('is_active', 'Y');
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $this->db->like('name', $search_string_array['search_string'], 'after');
        $query = $this->db->get();
        return $query->num_rows();
    }

    /**
     * Count the number of rows
     * @param int $search_string
     * @param int $order
     * @return int
     */
    function count_category($userid, $search_string = null, $order = null) {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('is_active', 'Y');
        $this->db->where('company_id', $this->session->userdata('company_id'));
        if ($search_string) {
            $this->db->like('name', $search_string);
        }
        if ($order) {
            $this->db->order_by($order, 'Asc');
        } else {
            $this->db->order_by('id', 'Asc');
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_catlimitcategory($userid) {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('is_active', 'Y');
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $query = $this->db->get();
        return $query->num_rows();
    }

    /**
     * Store the new item into the database
     * @param array $data - associative array with data to store
     * @return boolean 
     */
    function store_category($data) {
        $insert = $this->db->insert('category', $data);
        return $insert;
    }

    /**
     * Update category
     * @param array $data - associative array with data to store
     * @return boolean
     */
    function update_category($id, $data) {
        $this->db->where('id', $id);
        $query = $this->db->update('category', $data);
        print_r($query);
        return $query;
    }

    /**
     * Delete categoryr
     * @param int $id - category id
     * @return boolean
     */
    function delete_category($id) {
        $this->db->where('id', $id);
        $this->db->delete('category');
    }

    function insert($val) {
        $insert = $this->db->insert('inc', array('id1' => $val));
        return $insert;
    }

}
?>	
