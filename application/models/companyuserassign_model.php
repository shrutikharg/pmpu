<?php

class Companyuserassign_model extends CI_Model {

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
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_category_list($userid) {
        $this->db->from('category');
        $this->db->where('IsActive', 'Y');
        $this->db->where('usercat_id', $userid);
        $this->db->order_by('id');
        $result = $this->db->get();
        $return = array();
        if ($result->num_rows() > 0) {
            $return[''] = 'Please select';
            foreach ($result->result_array() as $row) {
                $return[$row['id']] = $row['name'];
            }
        }
        return $return;
    }

    public function get_category_droplist($userid) {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('IsActive', 'Y');
        $this->db->where('usercat_id', $userid);
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
    public function get_userassign($sidx, $sord, $start, $limit, $search_string_array, $count) {

        $this->db->select("email,id");
        $this->db->select("IF(isnull(first_name),' ',first_name) as first_name",false);
         $this->db->select("IF(isnull(last_name),' ',last_name) as last_name",false);
         $this->db->select("IF(isnull(phone_no),' ',phone_no) as phone_no",false);
        $this->db->from('users');
        $this->db->where('company_id', $this->session->userdata('company_id'));
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

    /**
     * Count the number of rows
     * @param int $search_string
     * @param int $order
     * @return int
     */
    function count_userassign($userid, $search_string = null, $order = null) {
        $this->db->select('*');
        $this->db->from('users');
        //$this->db->where('usercat_id', $userid);
        if ($search_string) {
            $this->db->like('user_name', $search_string);
        }
        if ($order) {
            $this->db->order_by($order, 'Asc');
        } else {
            $this->db->order_by('id', 'Asc');
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_empuserdtils($userid, $search_string = null, $order = null, $order_type = 'Asc', $limit_start = null, $limit_end = null) {

        $this->db->select('*');
        $this->db->from('users');
        $this->db->join('users_groups', 'users.id=users_groups.user_id');
        $this->db->where('group_id', '7');
        if ($search_string) {
            $this->db->like('user_name', $search_string);
        }
        $this->db->group_by('id');

        if ($order) {
            $this->db->order_by($order, $order_type);
        } else {
            $this->db->order_by('id', $order_type);
        }

        if ($limit_start && $limit_end) {
            $this->db->limit($limit_start, $limit_end);
        }

        if ($limit_start != null) {
            $this->db->limit($limit_start, $limit_end);
        }

        $query = $this->db->get();

        return $query->result_array();
    }

    function count_empusers($userid, $search_string = null, $order = null) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->join('users_groups', 'users.id=users_groups.user_id');
        $this->db->where('group_id', '7');
        if ($search_string) {
            $this->db->like('user_name', $search_string);
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
        $this->db->where('usercat_id', $userid);
        $query = $this->db->get();
        return $query->num_rows();
    }

    /**
     * Store the new item into the database
     * @param array $data - associative array with data to store
     * @return boolean 
     */
    function store_userassign($data) {
        //$insert = $this->db->insert('category', $data);
        //return $insert;
        return;
    }

    /**
     * Update category
     * @param array $data - associative array with data to store
     * @return boolean
     */
    function update_category($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('category', $data);
        $report = array();
        $report['error'] = $this->db->_error_number();
        $report['message'] = $this->db->_error_message();
        if ($report !== 0) {
            return true;
        } else {
            return false;
        }
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

}
?>	
