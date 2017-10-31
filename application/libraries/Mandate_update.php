<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mandate_upodate
 *
 * @author a
 */
class Mandate_update {

    private $CI;

    public function __construct() {
        $this->CI = & get_instance();
    }

    public function get_insert_details() {
        $insert_array = array('created_at' => date('Y-m-d'),
            'created_by' => $this->CI->session->userdata('id'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $this->CI->session->userdata('id'),
            'company_id' => $this->CI->session->userdata('company_id')
        );
        return $insert_array;
    }

    public function get_update_details() {
        $update_array = array('updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $this->CI->session->userdata('id'),
            'company_id' => $this->CI->session->userdata('company_id')
        );
        return $update_array;
    }
    public function get_insert_admin_details() {
        $insert_array = array('created_at' => date('Y-m-d'),      
            'updated_at' => date('Y-m-d H:i:s'),          
           
        );
        return $insert_array;
    }
    public function get_update_admin_details() {
        $insert_array = array('updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $this->CI->session->userdata('id'),
        );
        return $insert_array;
    }

}
