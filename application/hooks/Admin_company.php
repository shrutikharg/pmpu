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
    //put your code here
    public function get_admin_details() {
      $ci =& get_instance();
     $ci->load->library('domain');         
      $ci->config->set_item('company_details',$ci->domain->get_company_byDomain());

    }
}
