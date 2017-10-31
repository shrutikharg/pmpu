<?php

class Companyuser_model extends CI_Model {

    /**
     * Validate the login's data with the database
     * @param string $user_name
     * @param string $password
     * @return void
     */
    function validate($user_name, $password) {
        $this->db->where('user_name', $user_name);
        $this->db->where('password', $password);
        $query = $this->db->get('users');

        if ($query->num_rows == 1) {
            return true;
        }
    }

    function select_by_username($user_name, $password) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('user_name', $user_name);
        $this->db->where('password', $password);
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
        $this->db->order_by('id', 'DESC');
        $this->db->limit('1');
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
        $this->db->select('user.*,upd.hosting_plan_id,upd.occupied_disk_space,upd.available_disk_space,hostingplan_tbl.host_space_kb');
        $this->db->from('users user');
        $this->db->join('user_plan_details upd', 'upd.user_id = user.id');
        $this->db->join('groups grp', 'grp.id =user.group_type');
        $this->db->join('hostingplan_tbl', 'hostingplan_tbl.id =upd.hosting_plan_id');
        $this->db->where('user.id', $id);
        $query = $this->db->get();
        return $query->result_array();
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
    function create_member() {

        $this->db->where('email', $this->input->post('email_address'));
        $query = $this->db->get('users');

        if ($query->num_rows > 0) {//if user is alredy with given email_id
            echo '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>';
            echo "Username already taken";
            echo '</strong></div>';
        } else {

            $hostplanid = $this->input->post('planid');

            $usertype_group = '6';
            $IsActive = 'Y';
            $todays_timestamp = date('Y-m-d');
            if ($hostplanid == 1) {
                $expire_timestamp = date('Y-m-d', strtotime('+7 day'));
            } else {
                $expire_timestamp = date('Y-m-d', strtotime('+1year'));
            }


            $new_member_insert_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'company_name' => $this->input->post('comp_name'),
                'email' => $this->input->post('email_address'),
                'user_name' => $this->input->post('email_address'),
                'password' => md5($this->input->post('password')),
                'IsActive' => $IsActive,
                'usertype_group' => $usertype_group,
                'activated_at' => $todays_timestamp,
            );
            $inserteddata = $this->db->insert('users', $new_member_insert_data);

            if (is_bool($inserteddata) === true) {
                $newuserid = $this->db->insert_id();
                //$usergrp=(int)$usertype_group;

                $user_plan_data = array(
                    'user_id' => $newuserid,
                    'payment_mode' => 'DD',
                    'payment_status' => 'Partially',
                    'paid_amount' => '700',
                    'remaining_amount' => '1500',
                    'hosting_plan_id' => $hostplanid,
                    'transaction_id' => '546734563',
                    'expire_date' => $expire_timestamp
                );
                $insert = $this->db->insert('user_plan_details', $user_plan_data);
                return $insert;
            }
        }
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

}
