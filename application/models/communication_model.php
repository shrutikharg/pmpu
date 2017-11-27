<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of communcation_model
 *
 * @author a
 */
class communication_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_message( $start, $limit, $search_string_array, $count) {
        $this->db->select('distinct(mr.msg_master_id) as master_id,mr.message_id,mm.subject,u.id as user_id,concat(u.first_name," ",u.last_name) as full_name', FALSE);
        $this->db->from('message_receiver mr');
        $this->db->join('message_master mm', 'mm.id=mr.msg_master_id');
        $this->db->join('message m', 'm.id=mr.message_id');
        $this->db->join('users u', 'u.id=m.created_by');
        $this->db->where('mr.receiver_id', $this->session->userdata('id'));
        if ($search_string_array != "") {
            $this->db->like('name', $search_string_array->search_string);
        }

        $this->db->group_by('mr.msg_master_id');
        $this->db->order_by('m.created_at', 'desc');

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

    public function get_subject_specific_message($master_id,$start, $limit, $search_string_array, $count) {
        $this->db->select('distinct(m.id),m.message,u.email,concat_ws(u.first_name," ",u.last_name) as full_name,m.created_at', FALSE);
        $this->db->from('message m');
        $this->db->join('message_receiver mr', 'm.id=mr.message_id');
        $this->db->join('users u', 'u.id=m.created_by');
        $this->db->where('m.msg_master_id', $master_id);
        $this->db->where('mr.receiver_id', $this->session->userdata('id'));
        if ($search_string_array != "") {
            $this->db->like('name', $search_string_array->search_string);
        }
        $this->db->order_by('m.created_at', 'desc');
       if ($count == false) {
            $this->db->limit($limit, $start);
        }

        $query = $this->db->get();

        if ($count == false) {
            return $query->result();
        } else {
            return $query->num_rows();
        }
    }

    public function get_users($name) {
        $this->db->select('id,email,concat_ws(first_name," ",last_name)as full_name,phone_no', FALSE);
        $this->db->from('users');
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $this->db->or_like('email', $name);
        $this->db->or_like('first_name', $name);
        $this->db->or_like('last_name', $name);
        $this->db->or_like('phone_no', $name);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function save_subject($data) {
        $query = $this->db->insert('message_master', $data);
        return $this->db->insert_id();
    }

    public function save_message($data) {
        $query = $this->db->insert('message', $data);
        return $this->db->insert_id();
    }

    public function save_message_receiver($receiver_array) {
        $query = $this->db->insert_batch('message_receiver', $receiver_array);
        return $query;
    }

    public function get_message_receipient($master_id) {
        $this->db->select('u.id,concat_ws(u.first_name," ",u.last_name) as full_name,', FALSE);
        $this->db->from('message_receiver mr');
        $this->db->join('users u', 'u.id=mr.receiver_id');
        $this->db->where('mr.msg_master_id', $master_id);
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $query = $this->db->get();
        return $query->result();
    }

}
