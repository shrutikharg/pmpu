<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of companyspeaker_model
 *
 * @author a
 */
class companyday_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_days($userid, $sidx, $sord, $start, $limit, $search_string_array, $count) {

        $this->db->select('id,name,description,day_no');
        $this->db->from('day');

        $this->db->where('company_id', $this->session->userdata('company_id'));

        if ($search_string_array != "") {
            $this->db->like('name', $search_string_array->course);
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

    function store_day($data) {
        $insert = $this->db->insert('day', $data);
        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    /**
     * Update courses
     * @param array $data - associative array with data to store
     * @return boolean
     */
    function update_day($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('day', $data);
        $report = array();
        $report['error'] = $this->db->_error_number();
        $report['message'] = $this->db->_error_message();
        if ($report !== 0) {
            return true;
        } else {
            return false;
        }
    } 
       public function get_day_by_id($id) {
        $this->db->select('*');
        $this->db->from('day');
        $this->db->where('id', $id);
          $this->db->where('company_id', $this->session->userdata('company_id'));
        $query = $this->db->get();
        return $query->result_array();
    }
    function check_day_availabilty($day_id){
        $this->db->select('id,name,description,day_no');
        $this->db->from('day');
        $this->db->where('company_id', $this->session->userdata('company_id'));
         $this->db->where('day_no',$day_id);
           $query = $this->db->get();
           return $query->row();

        
    }

}
