<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of frontend
 *
 * @author a
 */
class frontend extends CI_Controller {
      public function __construct() {
        parent::__construct();
        $this->load->model('Companyuser_model');
        $this->load->model('company_model');
    }

    function index() {
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->view('admin_company/login');
    }
    //put your code here
}
