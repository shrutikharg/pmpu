<?php

class Companyuser_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    /**
     * Validate the login's data with the database
     * @param string $user_name
     * @param string $password
     * @return void
     */
    function validate($user_name) {
        $this->db->_protect_identifiers = false;
        $this->db->select('u.id as user_id,u.password,upd.id as user_plan_id,u.company_id,
            CASE 
            WHEN upd.expire_date< curdate() THEN "Subscription has expired"  
            WHEN  isnull(upd.is_active)THEN "Subscription has  not activated yet.Please check yor mail for activation link"
            when upd.is_active="N" THEN "Subscription is not active"
            when u.is_active="N" THEN "User is not active"
            when isnull(u.is_active) THEN "User is not activated yet.Please check your mail"
               ELSE "Success" END as user_status');
        $this->db->from('users u');
         $this->db->join('lms_company c','u.company_id=c.id');
        $this->db->join('user_plan_details upd', 'upd.company_id=c.id');
        $this->db->join('users_groups ug', 'ug.user_id=u.id');
        $this->db->where('u.email', $user_name);
      //  $this->db->where('password', $password);
        $this->db->where('u.is_active', 'Y');
        $this->db->where('ug.group_id', '6');
        $query = $this->db->get();
        $this->db->_protect_identifiers = true;

        return $query->result_array();
    }

    function get_user_plan_details($user_name) {
        $this->db->select('upd.*,u.id as loggedin_user_id');
        $this->db->from('user_plan_details upd');
        $this->db->join('users u', 'upd.user_id=u.admin_id');
        $where = "user_id  in( select admin_id from users where id in(select id from users where email='" . $user_name . "' ))";
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result_array();
    }

    function store_usergroups($dataadded) {
        $insert = $this->db->insert('users_groups', $dataadded);
        return $insert;
    }

    function select_authinteciate_user($userid, $user_name) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('user_name', $user_name);
        $this->db->where('id', $userid);
        $this->db->join('users_groups', 'users_groups.user_id = users.id');
        //$this->db->join('groups','groups.id =users_groups.group_id');		
        $query = $this->db->get();
        return $query->result_array();
    }

    function select_by_apptheme($userid) {
        $this->db->select('*');
        $this->db->from('themes_users');
        $this->db->where('userid', $userid);
        $query = $this->db->get();

        $this->db->select('*');
        $this->db->from('themes_users');
        if ($query->row() == NULL) {
            $query = $this->db->where('id', 1);
        } else {
            $query = $this->db->where('id', $query->row()->id);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    function select_by_appthemeefault() {
        $this->db->select('*');
        $this->db->from('theme_default');
        $this->db->order_by('theme_created', 'DESC');
        $this->db->limit('1');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_userdetails_by_id($id) {
        $this->db->select('u.email,c.name as comp_name,c.id as company_id,u.first_name,u.last_name,u.phone_no');
        $this->db->from('users u');
        $this->db->join('lms_company c', 'c.id=u.company_id');
        $this->db->where('u.company_id', $this->session->userdata('company_id'));
        $this->db->where('u.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function get_employeeuser_id($id) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('users.id', $id);
        $this->db->where('users.usertype_group', '7');
        $this->db->join('users_groups', 'users_groups.user_id = users.id');
        $this->db->join('groups', 'groups.id =users_groups.group_id');

        $query = $this->db->get();
        return $query->result_array();
    }

    function get_userdetailsid($userid) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('users.id', $userid);
        $query = $this->db->get();
        return $query->result_array();
    }

    function plandetails($planid) {
        $this->db->select('*');
        $this->db->from('hostingplan_tbl');
        $this->db->where('hostingplan_tbl.id', $planid);
        $this->db->join('criteria', 'criteria.hosting_planid = hostingplan_tbl.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Update courses
     * @param array $data - associative array with data to store
     * @return boolean
     */
    function update_pwduser($id, $data) {
        $this->db->where('id', $id);
        $this->db->where('users.usertype_group', '7');
        $this->db->update('users', $data);
        $report = array();
        $report['error'] = $this->db->_error_number();
        $report['message'] = $this->db->_error_message();
        if ($report !== 0) {
            return true;
        } else {
            return false;
        }
    }

    function update_pwduseradminnew($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('users', $data);
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
     * Update courses
     * @param array $data - associative array with data to store
     * @return boolean
     */
    function update_pwduserprofile($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('users', $data);
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
     * Update courses
     * @param array $data - associative array with data to store
     * @return boolean
     */
    function update_filesizeacct($userid, $data) {
        $this->db->where('id', $userid);
        $this->db->update('users', $data);
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
     * Serialize the session data stored in the database, 
     * store it in a new array and return it to the controller 
     * @return array
     */
    function get_db_session_data() {
        $query = $this->db->select('user_data')->get('ci_sessions');
        $user = array(); /* array to store the user data we fetch */
        foreach ($query->result() as $row) {
            $udata = unserialize($row->user_data);
            /* put data in array using username as key */
            $user['user_name'] = $udata['user_name'];
            $user['is_logged_in'] = $udata['is_logged_in'];
            $user['id'] = $udata['id'];
            $user['firstname'] = $udata['first_name'];
        }
        return $user;
    }

    /**
     * Store the new user's data into the database
     * @return boolean - check the insert
     */
    function create_member($insert_data) {

        $this->db->insert('users', $insert_data);
        return $this->db->insert_id();
    }

//create_member
    function select_user_plan_details($user_company_id) {
        $this->db->select('*');
        $this->db->from('user_plan_details');
        $this->db->where("user_id", $user_company_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_company_id($user_id) {
        $this->db->select('company_id');
        $this->db->from('users');
        $this->db->where("id", $user_company_id);
        $query = $this->db->get();
        return $query->row()->company_id;
    }

    function check_email_availability($email_id) {
        $this->db->select('email');
          $this->db->from('users u ');
          $this->db->join('users_groups ug','ug.user_id=u.id');
          $this->db->where('ug.group_id','6');
        $this->db->where('email', $email_id);
      $query=   $this->db->get();
         return $query->num_rows();
        
       
    }

    function update_user_by_email($data) {
        $this->db->where('email', $data['email']);
        $this->db->update('users',$data);
    }

    function verify_reset_password_code($reset_password_code, $email_id) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('reset_password_code', $reset_password_code);
        $this->db->where('email', $email_id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function change_password($password, $email_id) {
        $this->db->where('email', $email_id);
        $query = $this->db->update('users', array('password' =>$password));
        return $query;
    }

    public function get_admin_id($user_id) {
        $this->db->select('company_id');
        $this->db->from('users');
        $this->db->where('id', $user_id);
        $query = $this->db->get();
        return $query->row()->admin_id;
    }

    public function update_user($data) {
        $this->db->where('id', $data['id']);
        $this->db->update('users', $data);
    }

    public function verify_user($email_id, $activation_code) {
        $verify_user_query = "UPDATE users AS u ,(SELECT email,activation_code FROM USERS WHERE email = '$email_id') AS p 
                SET u.is_active ='Y' 
                WHERE u.email = p.email AND sha1(P.activation_code)='$activation_code'";
        $query = $this->db->query($verify_user_query);
        return $query;
    }

    function check_for_space_availability($user_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('available_disk_space');
        $this->db->from('user_plan_details');
        // $get_user_admin_query = "user_id=(select company_id from users where id= $this->session->userdata('company_id')";
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $query = $this->db->get();
        $this->db->_protect_identifiers = true;

        return $query->row()->available_disk_space;
    }

    function update_space_availability($company_id, $updated_document_size, $previous_document_size) {
        $update_space_availability_query = "UPDATE user_plan_details AS upd ,(SELECT available_disk_space,company_id FROM user_plan_details WHERE company_id = '$company_id') AS up 
                SET upd.available_disk_space =up.available_disk_space+$previous_document_size-$updated_document_size
                   
                WHERE upd.company_id = up.company_id";
        $query = $this->db->query($update_space_availability_query);
        return $query;
    }

    function insert_user_group_type($user_data_array) {
        $this->db->insert('users_groups', $user_data_array);
    }

    function get_userdetails() {
        $this->db->select('u.id as user_id,u.email,c.name as comp_name,c.id as company_id,u.first_name,u.last_name');
        $this->db->from('users u');
        $this->db->join('lms_company c', 'c.id=u.company_id');
        $this->db->where('u.company_id', $this->session->userdata('company_id'));
        $query = $this->db->get();
        return $query->row();
    }
    function get_user_bycompany(){
      $this->db->select('u.id as user_id,u.email,c.name as comp_name,c.id as company_id,u.first_name,u.last_name');
        $this->db->from('users u');
        $this->db->join('lms_company c', 'c.id=u.company_id');
        $this->db->where('u.company_id', $this->session->userdata('company_id'));
        $query = $this->db->get();
        return $query->result_array();   
    }

    

}
