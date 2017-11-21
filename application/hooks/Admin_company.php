<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_company
 *
 * @author a
 */
class Admin_company {
    public $ci;
    public function __construct() {
       $this->ci =& get_instance(); 
    }
    //put your code here
    public function get_admin_details() {
     $this->ci->load->library('domain');         
      $this->ci->config->set_item('company_details',$this->ci->domain->get_company_byDomain());

    }
     function check_session() {
   $url_without_session_array=array('admin_company/login/validate_credentials');

        if ($this->ci->input->is_ajax_request()){
        
        
           if(!$this->ci->session->userdata('is_logged_in') && (!in_array(str_replace(base_url(), "",  current_url()),$url_without_session_array))){
         echo 'Session Expired';
               
        } 
        }
    }
}
