<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Communication
 *
 * @author a
 */
class Communication extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('communcation_model');
        $this->load->model('companyuser_model');
    }

    public function index() {
        $data['message_list'] = $this->communcation_model->get_message();
        $data['subject_specific_msg_list'] = $this->communcation_model->get_subject_specific_message($data['message_list'][0]->master_id);
        $data['main_content'] = 'admin_company/communication/list';
        $this->load->view('includes/template', $data);
    }

    public function get_users() {
        $name = $this->input->post('name');
        $user_list = $this->communcation_model->get_users($name);
        $response = new stdClass();
        $response->users = $user_list;
        echo json_encode($response);
    }

    public function send_message() {
        $response = new stdClass();
        $receiver_array = array();
        $master_id = $this->input->post('master_id');
        if (empty($this->input->post('master_id'))) {
            $subject_data = array('initiator' => $this->session->userdata('id'),
                'company_id' => $this->session->userdata('company_id'),
                'subject' => $this->input->post('subject'), 'created_by' => $this->session->userdata('id'),
                'created_at' => date('Y-m-d H:i:s'),);
            $master_id = $this->communcation_model->save_subject($subject_data);
        }
        $message_data = array('msg_master_id' => $master_id,
            'created_by' => $this->session->userdata('id'),
            'created_at' => date('Y-m-d H:i:s'),
            'message' => $this->input->post('message'));
        $message_id = $this->communcation_model->save_message($message_data);

        foreach ($this->input->post('users') as $user) {
            array_push($receiver_array, array('message_id' => $message_id, 'msg_master_id' => $master_id, 'receiver_id' => $user));
        }
        $query = $this->communcation_model->save_message_receiver($receiver_array);
        if ($query == NULL) {
            $response->status = 'Success';
        } else {
            $response->status = 'Fail';
        }
        echo json_encode($response);
    }

    public function get_subject_specific_message() {
        $response = new stdClass();
        $master_id = $this->input->post('master_id');
        $message_result = $this->communcation_model->get_subject_specific_message($master_id);
        echo json_encode($message_result);
    }

    public function get_message_receipient() {
        $response = new stdClass();
        $master_id = $this->input->post('master_id');
        $recever_list = $this->communcation_model->get_message_receipient($master_id);
        echo json_encode($recever_list);
    }

    public function send_reply() {

        $master_id = $this->input->post('master_id');
        $message_data = array('msg_master_id' => $master_id,
            'created_by' => $this->session->userdata('id'),
            'created_at' => date('Y-m-d H:i:s'),
            'message' => $this->input->post('message'));
        $message_id = $this->communcation_model->save_message($message_data);
        $receiver_array = array();
        foreach ($this->input->post('users') as $user) {
            array_push($receiver_array, array('message_id' => $message_id, 'msg_master_id' => $master_id, 'receiver_id' => $user));
        }
        $this->communcation_model->save_message_receiver($receiver_array);
        $ubject_specific_msg_list = $this->communcation_model->get_subject_specific_message($master_id);
        echo json_encode($ubject_specific_msg_list);
    }

    function supportmail() {
        $userid = $this->session->userdata('id');
        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            $this->form_validation->set_rules('subname', 'Subject Name', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('description', 'Description details', 'trim|required|min_length[4]');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            if ($this->form_validation->run()) {
                $user_details = $this->companyuser_model->get_userdetails($userid);
                $support_mail_details = create_admin_support_mail($user_details, $this->input->post());
                $this->email->from('info@coolacharya.com', $support_mail_details->from_alias);
                $this->email->to('info@coolacharya.com');
                $this->email->cc($usernm);
                $this->email->subject($this->input->post('subname'));
                $this->email->message($support_mail_details->message);
                //if the insert has returned true then we show the flash message
                if ($this->email->send()) {
                    $this->session->set_flashdata('flash_message', 'send');
                } else {
                    $this->session->set_flashdata('flash_message', 'not_send');
                    echo $this->email->print_debugger();
                }
                redirect('admin_company/supportmail');
            } else {
                echo validation_errors();
            }
        }

        $data['footerdata'] = $this->companycmspage_model->list_cmspage();
        $data['main_content'] = 'admin_company/communication/supportmail';
        $this->load->view('includes/template', $data);
    }

}
