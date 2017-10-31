<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of File_viewer
 *
 * @author a
 */
class File_viewer extends CI_Controller {
     public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));


        if (!($this->session->userdata('is_logged_in'))) {
            redirect('employee/logout');
        } else {
            $this->load->model('employeecourses_model');
           
        }
    }
      function index($chapter_id){
       $data['chapterdisp'] = $this->employeecourses_model->get_chapterby_id($chapter_id);
       print_r($data['chapterdisp']);
        // $this->load->view('employee_company/pdf_viewer/web/viewer.html', $data
        // echo ;
        
    }
}
