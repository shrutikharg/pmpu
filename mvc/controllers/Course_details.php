<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Course_details
 *
 * @author a
 */
class Course_details extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('chapter_details_model');
    }

    public function get_cmi_values() {
        $chapter_id = $this->uri->segment(3);
       
        $userid = $this->session->userdata('id');
        $this->chapter_details_model->check_user_chapter_details_availability($userid, $chapter_id);
        $cmi_parameter = $this->input->post('cmi_parameter');
        $query = $this->chapter_details_model->get_cmi_values($cmi_parameter, $userid, $chapter_id);
        echo $query;
    }

    public function set_cmi_values() {
        $chapter_id = $this->uri->segment(3);
        $userid = $this->session->userdata('id');
         $this->chapter_details_model->check_user_chapter_details_availability($userid, $chapter_id);
        $cmi_parameter = $this->input->post('cmi_parameter');
        $cmi_value = $this->input->post('cmi_value');
        $insert_array = array($cmi_parameter => $cmi_value);
        //$cmi_parameter='cmi_core_lesson_mode';

        $query = $this->chapter_details_model->set_cmi_values($insert_array, $userid, $chapter_id);
        if ($cmi_parameter == 'cmi_core_lesson_status' && $cmi_value == 'passed') {
            $completed_date = date("Y-m-d H:i:s");
            $obj = "{'complated':'y','completed_on':'$completed_date'}";
            $completion_details_array = array('completion_details' => $obj);
            $query = $this->chapter_details_model->set_cmi_values(($completion_details_array), 64, 122);
        }
        echo TRUE;
    }

    public function store_user_slide_details_array() {
        $user_slide_details_array = $this->input->post('user_slide_details_array');
$chapter_id = $this->uri->segment(3);
        $userid = $this->session->userdata('id');
        $insert_array = array('user_slide_details' => $user_slide_details_array);
        //$cmi_parameter='cmi_core_lesson_mode';
        $this->load->model('chapter_details_model');
       $query = $this->chapter_details_model->store_user_slide_details_array($insert_array,$userid, $chapter_id);
       echo TRUE;
    }

}
