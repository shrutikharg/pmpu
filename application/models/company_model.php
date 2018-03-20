<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of company_model
 *
 * @author a
 */
class Company_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    function check_domain_availability($domain) {
        $this->db->select('domain_name');
        $this->db->from('lms_company');
        $this->db->where('domain_name', $domain);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function insert($data) {
        $this->db->insert('lms_company', $data);
        return $this->db->insert_id();
    }

    public function get_company_byDomain($subdomain) {
        $this->db->select('*');
        $this->db->from('lms_company');
        $this->db->where('domain_name', $subdomain);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_company_details() {
        $this->db->select('*');
        $this->db->from('lms_company');
        $this->db->where('id', $this->session->userdata('company_id'));
        $query = $this->db->get();
        return $query->row();
    }

    public function get_company_cms_bydomain($subdomain) {
        $this->db->select('*');
        $this->db->from('cmspage cp');
        $this->db->join('lms_company c', 'c.id=cp.company_id');
        $this->db->where('c.domain_name', $subdomain);
        $query = $this->db->get();
        return $query->row();
    }
     public function get_event_days() {
        $this->db->select('no_of_days');
        $this->db->from('lms_company');        
       $this->db->where('id', $this->session->userdata('company_id'));
        $query = $this->db->get();
        return $query->row();
    }

}
