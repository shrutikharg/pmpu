<?php

class Employeeuser_model extends CI_Model {

    /**
     * Validate the login's data with the database
     * @param string $user_name
     * @param string $password
     * @return void
     */
    function validate($user_name) {
        $this->db->select('u.id,u.company_id,u.password,u.email,u.first_name,u.last_name,u.phone_no as phone ,u.password,u.is_active,s.id as subscription_id');
        $this->db->from('users u');
        $this->db->join('users_groups ug', 'ug.user_id=u.id');
        $this->db->join('subscription s', 's.user_id=u.id', 'left');
        $this->db->where('u.email', $user_name);
        //   $this->db->where('u.password', $password);
        $this->db->where('u.is_active', 'Y');
        $this->db->where('ug.group_id', '7');
        $query = $this->db->get();

        return $query->row();
    }

    function select_by_username($user_name) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $user_name);

        $query = $this->db->get();
        return $query->result_array();
    }

    function select_authinteciate_user($userid, $user_name) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $user_name);
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

    function list_footercmspage() {
        $this->db->select('*');
        $this->db->from('cmspage');
        $this->db->where('company_id', $this->session->userdata('company_id'));

        $query = $this->db->get();
        return $query->row();
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

    function get_employeeuser_id($id) {
        $this->db->select('*');
        $this->db->from('users_groups');
        $this->db->join('user_group_type', 'user_group_type.id =users_groups.group_id');
        $this->db->join('users', 'users_groups.user_id =users.id');
        $this->db->where('users.id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

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
     * Store the new user's data into the database
     * @return boolean - check the insert
     */
    function create_member($new_member_insert_data) {



        $insert = $this->db->insert('users', $new_member_insert_data);
        return $this->db->insert_id();
        ;
    }

    function insert_payment_data($payment_data) {
        $insert = $this->db->insert('subscription', $payment_data);
    }

    function check_email_availability($email) {
        $this->db->select('u.email,u.first_name,u.last_name,s.user_id,s.id,u.created_at');
        $this->db->from('users u');
        $this->db->join('subscription s', 's.user_id=u.id');
        $this->db->join('users_groups ug', 'ug.user_id=u.id');
        $this->db->where('ug.group_id', '7');
        $this->db->where('u.email', $email);
        $query = $this->db->get();
        return $query->row();
    }

    function get_employee_by_email($email) {
        $this->db->select('u.email,u.password,u.first_name,u.last_name,u.id,u.created_at');
        $this->db->from('users u');
        $this->db->where('u.email', $email);
        $query = $this->db->get();
        return $query->row();
    }

    function insert_user_type($user_type_data) {
        $insert = $this->db->insert('users_groups', $user_type_data);
        return $this->db->insert_id();
    }

    function check_password($password) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id', $this->session->userdata('id'));       
        $query = $this->db->get();
        return $query->row();
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
     function update_user_by_email($data) {
        $this->db->where('email', $data['email']);
        $this->db->update('users',$data);
    }
  function get_course_list($company_id){
    $this->db->select('id,name,description,created_at,course_by,image_path');
    $this->db->from('courses');
    $this->db->where('company_id',$company_id);
   $this->db->where('is_active','Y');
   $this->db->order_by('id','desc');
   $this->db->limit(4,0);
  $query= $this->db->get();
  return $query->result_array();
   
   
  }


}
