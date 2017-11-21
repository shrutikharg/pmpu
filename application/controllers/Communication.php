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
    }

    public function index() {
        $data['message_list'] = $this->communcation_model->get_message();
        $data['subject_specific_msg_list'] = $this->communcation_model->get_subject_specific_message($data['message_list'][0]->master_id);
        $data['main_content'] = 'admin_company/message/list';
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

}
