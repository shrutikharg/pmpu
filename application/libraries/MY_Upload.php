<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of My_upload
 *
 * @author a
 */
class MY_Upload extends CI_Upload {

    //put your code here
    private $CI;
    private $config;

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model('companyuser_model');
    }

    function check_for_space_availability($user_id, $current_document_size, $previous_document_size = 0) {
        $available_disk_space = $this->CI->companyuser_model->check_for_space_availability($user_id);

        if (($available_disk_space - $previous_document_size) > $current_document_size) {


            return true;
        } else {
            return FALSE;
        }
    }

    function update_space_availability($user_id, $updated_document_size, $previous_document_size = 0) {
        $query = $this->CI->companyuser_model->update_space_availability($user_id, $updated_document_size, $previous_document_size);
    }

    public function do_my_upload($file_name,$config) {
      
        $this->config = $config;
        $this->initialize($this->config);
        if (parent::do_upload($file_name)) {
            $this->CI->data['status'] = TRUE;
            $this->CI->data['details'] = $this->data();
        } else {
            $this->CI->data['details'] = $this->display_errors();
            $this->CI->data['status'] = FALSE;
        }
        return $this->CI->data;
    }

}
