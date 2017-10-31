<?php

class Companycoursesassign_model extends CI_Model {

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
    function count_courses($userid, $search_string = null, $order = null) {
        $this->db->select('*');
        $this->db->from('courses');
        $this->db->where('created_by', $userid);
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

    public function get_userdetails($id) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_userdetailspresent($email) {
        $this->db->select('u.id,u.email,ug.group_id');
        $this->db->from('users u');
        $this->db->join('users_groups ug','u.id=ug.user_id','left');
        $this->db->where('email',$email);
       // $this->db->where('ug.group_id','7');
        $query = $this->db->get();
      return $query->result_array();
    }

    public function get_userdetailsinfouser($email) {

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $email);
        $query = $this->db->get();
        return $query->result_array();
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
       $last_insert_id=$this->db->insert_id();
        $this->db->insert('users_groups', array('user_id'=>$last_insert_id,'group_id'=>'7'));
       return $last_insert_id;
       
    }

    function insert_usergroupcsv($data) {
        $this->db->insert('users_groups', $data);
    }

    function insert_assignedcourse($insert_assigned_course) {
        /*$this->db->ignore();

        $this->db->insert('assigned_course', $insert_assigned_course);*/
        $insert_query = $this->db->insert_string('assigned_course', $insert_assigned_course);
$insert_query = str_replace('INSERT INTO','INSERT IGNORE INTO',$insert_query);
$query=$this->db->query($insert_query);
return $query;
    }

    function check_user_assignedcourse($check_user_course_assign_array) {
        $this->db->select('courseid,assignuserid');
        $this->db->from('assigned_course');
        $this->db->where('courseid', $check_user_course_assign_array['course_id']);
        $this->db->where('assignuserid', $check_user_course_assign_array['assign_user_id']);
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        return $rowcount;
    }

    public function get_course_assignee($userid, $sidx, $sord, $start, $limit, $search_string_array, $count, $course_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('u.id as user_id,u.email as Email,CONCAT_WS(" ",u.first_name,u.last_name)as Full_Name,ac.is_active');
        $this->db->from('users u');
        $this->db->join('assigned_course ac', 'ac.assigned_to=u.id');
        $this->db->join('courses c', 'c.id=ac.course_id');
        
        $this->db->where('ac.course_id', $course_id);
       $this->db->where('ac.company_id', $this->session->userdata('company_id'));
        if ($search_string_array != "") {
            $this->db->like('CONCAT_WS(" ",u.first_name,u.last_name)', $search_string_array->name);
            $this->db->like('email', $search_string_array->email_id);
            $this->db->like('ac.is_active', $search_string_array->is_active);
        }
        $this->db->order_by("ac.$sidx $sord");
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

    public function change_assignee_active_status($user_id, $course_id) {
        $sql = "UPDATE  assigned_course SET is_active = CASE WHEN is_active = 'Y' THEN  'N' WHEN is_active = 'N' THEN  'Y'  END where course_id=$course_id and assigned_to=$user_id";
        $query = $this->db->query($sql);
        return $query;
    }
    function add_course_user_batch($assigned_course_array){
        $query=$this->db->insert_batch('assigned_course', $assigned_course_array); 
        return $query;
    }

}
?>	
