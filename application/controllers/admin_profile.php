<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_profile
 *
 * @author a
 */
class admin_profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));


        if ($this->session->userdata('is_logged_in') !== TRUE) {

            redirect('admin_company/login');
        } else {
           // $this->load->model('admin_profilemodel');
            $this->load->model('companyuser_model');
        }
    }

    function userprofile() {//add in user_profile
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
            $this->form_validation->set_rules('umobile', 'User Mobile no', 'trim|required|min_length[4]|numeric');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run()) {

                $data_to_store = array(
                    'phone_no' => $this->input->post('umobile'),
                    'modify_date' => date('Y-m-d'),
                    'modify_by' => $this->session->userdata('user_name'),
                    'is_active' => 'Y',
                );
                //if the insert has returned true then we show the flash message
                if ($this->companyuser_model->update_pwduseradminnew($id, $data_to_store) == TRUE) {
                    $this->session->set_flashdata('flash_message', 'updated');
                } else {
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin_company/userprofile/' . $id . '');
            }//validation run
        }


        $data['users'] = $this->companyuser_model->get_userdetails_by_id($this->session->userdata('id'));
        $data['footerdata'] = $this->companycmspage_model->list_cmspage();
        //load the view
        $data['main_content'] = 'admin_company/profile/edit';
        $this->load->view('includes/template', $data);
    }
    
      function pwdchange() {//add in user_profile
        //product id 
      
        $this->load->model('companyuser_model');
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
            $this->form_validation->set_rules('old_password', 'Old Password', 'trim|required');
            $this->form_validation->set_rules('new_password', 'Password', 'trim|required|min_length[4]|max_length[16]');
            $this->form_validation->set_rules('new_password_repeat', 'Password Confirmation', 'trim|required|matches[new_password]');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run()) {

                $nepassword = $this->encrypt->encrypt_password($this->input->post('new_password'));
                $data_to_store = array(
                    'password' => $nepassword,
                    'updated_at' => date('Y-m-d H:i:s'),
                    'updated_by' =>$this->session->userdata('id'),
                    'id'=>$this->session->userdata('id'),
                   
                );
                //if the insert has returned true then we show the flash message
                if ($this->companyuser_model->update_pwduseradminnew( $data_to_store) == TRUE) {
                    $this->session->set_flashdata('flash_message', 'updated');
                    $this->session->sess_destroy();
                    redirect('admin_company');
                } else {
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }

                redirect('admin_company/userprofile/' . $id . '');
            }//validation run
        }

        $data['users'] = $this->companyuser_model->get_userdetails_by_id($id);

        //load the view
        $data['main_content'] = 'admin_company/profile/edit';
        $this->load->view('includes/template', $data);
    }

}
