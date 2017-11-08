<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of companycoupon model
 *
 * @author a
 */
class companycoupon_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_couponcode($sidx, $sord, $start, $limit, $search_string_array, $count) {
        $this->db->select('*');
        $this->db->from('coupon_code');
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

    public function add($data) {
        $query = $this->db->insert('coupon_code', $data);
        return $query;
    }

    public function update_couponcode($id, $data) {
        $this->db->where('id', $id);
        $query = $this->db->update('coupon_code', $data);
        return $query;
    }

    public function get_code_by_id($id) {
        $this->db->select('*');
        $this->db->from('coupon_code');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function apply_coupon($coupon_code, $company_id) {
        $this->db->select('*');
        $this->db->from('coupon_code');
        $this->db->where('company_id', $company_id);
        $this->db->where('start_date <=', date('Y-m-d'));
        $this->db->where('end_date >=', date('Y-m-d'));
        $this->db->where('name', $coupon_code);
        $this->db->where('is_active', 'Y');
        $query=$this->db->get();
        return $query->row();
    }

    //put your code here
}
