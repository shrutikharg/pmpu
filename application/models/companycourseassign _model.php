<?php

class Companycoursesassignassign_model extends CI_Model {

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
    public function get_courses_by_id($id) {
        $this->db->select('*');
        $this->db->from('courses');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Fetch courses data from the database
     * possibility to mix search, filter and order
     * @param string $search_string 
     * @param strong $order
     * @param string $order_type 
     * @param int $limit_start
     * @param int $limit_end
     * @return array
     */
    public function get_courses($userid, $sidx, $sord, $start, $limit, $search_string_array, $count) {

        $this->db->select('*');
        $this->db->from('courses');
        $this->db->where('created_by', $userid);

        if ($search_string) {
            $this->db->like('course_name', $search_string,'after');
        }
        $this->db->group_by('id');

        if ($count == false) {
            $this->db->limit($limit, $start);
        }

        $query = $this->db->get();

        return $query->result_array();
    }

    /**
     * Count the number of rows
     * @param int $search_string
     * @param int $order
     * @return int
     */
    function count_coursesassign($userid, $search_string = null, $order = null) {
        $this->db->select('*');
        $this->db->from('courses');
        $this->db->where('creted_by', $userid);
        if ($search_string) {
            $this->db->like('course_name', $search_string);
        }
        if ($order) {
            $this->db->order_by($order, 'Asc');
        } else {
            $this->db->order_by('id', 'Asc');
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    /**
     * Store the new item into the database
     * @param array $data - associative array with data to store
     * @return boolean 
     */
    function store_courses($data) {
        $insert = $this->db->insert('courses', $data);
        return $insert;
    }

    /**
     * Update courses
     * @param array $data - associative array with data to store
     * @return boolean
     */
    function update_courses($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('courses', $data);
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
     * Delete coursesr
     * @param int $id - courses id
     * @return boolean
     */
    function delete_courses($id) {
        $this->db->where('id', $id);
        $this->db->delete('courses');
    }

    /* public function get_subcategory_list()
      {
      $this->db->from('courses');
      $this->db->where('IsActive','Y');
      $this->db->order_by('id');
      $result = $this->db->get();
      $return = array();
      if($result->num_rows() > 0){
      $return[''] = 'Please select';
      foreach($result->result_array() as $row){
      $return[$row['id']] = $row['subcategory_name'];
      }
      }
      return $return;
      }


      public function get_subcategory_dropdownlist()
      {
      $this->db->select('*');
      $this->db->from('courses');
      $this->db->where('IsActive', 'Y');
      $this->db->order_by('id');
      $query = $this->db->get();
      return $query->result_array();
      } */

    function insert_csv($data) {
        $this->db->insert('users', $data);
    }

    function insert_usergroupcsv($data) {
        $this->db->insert('users_groups', $data);
    }

    function insert_assignedcourse($course_assign_data) {
        $query = $this->db->insert('assigned_course', $course_assign_data);
        return $query;
    }

    function get_course_assignee() {
        
    }
    

}
?>	
