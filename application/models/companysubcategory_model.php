<?php

class Companysubcategory_model extends CI_Model {

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
    public function get_subcategory_by_id($userid, $id) {
        $this->db->select('*');
        $this->db->from('subcategory');
        $this->db->where('id', $id);
        //  $this->db->where('created_by', $userid);
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Fetch subcategory data from the database
     * possibility to mix search, filter and order
     * @param string $search_string 
     * @param strong $order
     * @param string $order_type 
     * @param int $limit_start
     * @param int $limit_end
     * @return array
     */
    public function get_subcategory( $sidx, $sord, $start, $limit, $search_string_array, $count) {

        $this->db->select('category_id');
        $this->db->select('subcategory.id as id');
        $this->db->select('category.name as category');
        $this->db->select('subcategory.name as subcategory');
        $this->db->select('subcategory.description as description');
        $this->db->from('subcategory');
        $this->db->join('category', 'category.id = subcategory.category_id');
        // $this->db->where('subcategory.created_by', $userid);
        $this->db->where('subcategory.company_id', $this->session->userdata('company_id'));
        if ($search_string_array != "") {
            $this->db->like('category.id', $search_string_array->department);
            $this->db->like('subcategory.name', $search_string_array->subdepartment, 'after');
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

    /**
     * Count the number of rows
     * @param int $search_string
     * @param int $order
     * @return int
     */
   /* function count_subcategory($userid, $search_string = null, $order = null) {
        $this->db->select('*');
        $this->db->from('subcategory');
        $this->db->where('useracess_id', $userid);
        if ($search_string) {
            $this->db->like('subcategory_name', $search_string);
        }
        if ($order) {
            $this->db->order_by($order, 'Asc');
        } else {
            $this->db->order_by('id', 'Asc');
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_subcatlimitcategory($userid) {
        $this->db->select('*');
        $this->db->from('subcategory');
        //$this->db->where('created', $userid);

        $query = $this->db->get();
        return $query->num_rows();
    }*/

    /**
     * Store the new item into the database
     * @param array $data - associative array with data to store
     * @return boolean 
     */
    function store_subcategory($data) {
        $insert = $this->db->insert('subcategory', $data);
        return $insert;
    }

    /**
     * Update subcategory
     * @param array $data - associative array with data to store
     * @return boolean
     */
    function update_subcategory($id, $data) {
        $this->db->where('id', $id);
        $query = $this->db->update('subcategory', $data);
        return $query;
    }

    /**
     * Delete subcategoryr
     * @param int $id - subcategory id
     * @return boolean
     */
    function delete_subcategory($id) {
        $this->db->where('id', $id);
        $this->db->delete('subcategory');
    }

    public function get_subcategory_list() {
        $this->db->select('id,name');
        $this->db->from('subcategory');
        $this->db->where('is_active', 'Y');
        //  $this->db->where('created_by', $userid);
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $this->db->order_by('id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $return[''] = $this->lang->line('opt_select');
            foreach ($query->result_array() as $row) {
                $return[$row['id']] = $row['name'];
            }
        }
        return $return;
    }

    public function get_subcategory_dropdownlist($userid, $category_id) {
        $this->db->select('*');
        $this->db->from('subcategory');
        $this->db->where('is_active', 'Y');
        //  $this->db->where('created_by', $userid);
        $this->db->where('company_id', $this->session->userdata('company_id'));
        if (!is_null($category_id)) {
            $this->db->where('category_id', $category_id);
        }
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_subcategory_by_name($userid, $search_string_array) {
        $this->db->select('*');
        $this->db->from('subcategory');
        // $this->db->where('created_by', $userid);
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $this->db->like('name', $search_string_array['name'], 'after');
        $query = $this->db->get();
        return $query->num_rows();
    }

}
?>	
