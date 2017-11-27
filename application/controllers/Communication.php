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
        $this->load->model('communication_model');
        $this->load->model('companyuser_model');
    }

    public function index() {
        // $data['message_list'] = $this->communication_model->get_message();
        // $data['subject_specific_msg_list'] = $this->communication_model->get_subject_specific_message($data['message_list'][0]->master_id);
        $data['main_content'] = 'admin_company/communication/list';
        $this->load->view('includes/template', $data);
    }

    public function communication_list() {

        $limit = 10; //no. of rows
        $search_string_array = "";

        if ($this->input->post('search') == 'true') {
            $search_string_array = json_decode($this->input->post('search_string_array'));
        }
        $page = trim($this->input->post('page'));
        if ($page == "") {
            $page = 1;
        }
        $count = $this->communication_model->get_message(0, $limit, $search_string_array, $is_count = true);


        if ($count > 0 && $limit > 0) {
            $totalpages = ceil($count / $limit);
        } else {
            $totalpages = 0;
        }
        if ($page > $totalpages) {
            $page = $totalpages;
        }
        $start = ($limit * $page) - $limit;

        if ($start < 0) {
            $start = 0;
        }
        $response = new stdClass();
        $response->page = $page;

        $response->total = $totalpages;
        $response->records = $count;
        $response->start = $start + 1;
        $response->end = $start + $limit;
        $i = 0;


        $query = $this->communication_model->get_message($start, $limit, $search_string_array, $is_count = false);
        $subject_result = $query->result();

        foreach ($query->result() as $row) {
            $response->rows[$i] = array('master_id' => $this->encryption->encrypt($row->master_id), 'message_id' => $row->message_id, 'subject' => $row->subject, 'user_id' => $row->user_id, 'full_name' => $row->full_name);
            $i++;
        }
        $subject_specific_msg_count = $this->communication_model->get_subject_specific_message($subject_result[0]->master_id, 0, $limit, $search_string_array, $is_count = true);

        if ($subject_specific_msg_count > 0 && $limit > 0) {
            $totalpages = ceil($subject_specific_msg_count / $limit);
        } else {
            $totalpages = 0;
        }
        if ($page > $totalpages) {
            $page = $totalpages;
        }
        $start = ($limit * $page) - $limit;

        if ($start < 0) {
            $start = 0;
        }
        $subject_specific_msg_list = $this->communication_model->get_subject_specific_message($subject_result[0]->master_id, $start, $limit, $search_string_array, $is_count = false);


        $j = 0;

        $response->msg_page = $page;

        $response->msg_total = $totalpages;
        $response->msg_records = $subject_specific_msg_count;
        $response->msg_start = $start + 1;
        $response->msg_end = $start + $limit;
        foreach ($subject_specific_msg_list as $row) {
            $response->message[$j] = array('message' => $row->message, 'email' => $row->email, 'full_name' => $row->full_name, 'created_at' => $row->created_at);
            $j++;
        }

        echo json_encode($response);
    }

    public function get_users() {
        $name = $this->input->post('name');
        $user_list = $this->communication_model->get_users($name);
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
            $master_id = $this->communication_model->save_subject($subject_data);
        }
        $message_data = array('msg_master_id' => $master_id,
            'created_by' => $this->session->userdata('id'),
            'created_at' => date('Y-m-d H:i:s'),
            'message' => $this->input->post('message'));
        $message_id = $this->communication_model->save_message($message_data);

        foreach ($this->input->post('users') as $user) {
            array_push($receiver_array, array('message_id' => $message_id, 'msg_master_id' => $master_id, 'receiver_id' => $user));
        }
        $query = $this->communication_model->save_message_receiver($receiver_array);
        if ($query == NULL) {
            $response->status = 'Success';
        } else {
            $response->status = 'Fail';
        }
        echo json_encode($response);
    }

    public function get_subject_specific_message() {
        $limit = 10; //no. of rows
        $search_string_array = "";
        $master_id = $this->encryption->decrypt($this->input->post('master_id'));
        if ($this->input->post('search') == 'true') {
            $search_string_array = json_decode($this->input->post('search_string_array'));
        }
        $page = trim($this->input->post('page'));
        if ($page == "") {
            $page = 1;
        }
        $count = $this->communication_model->get_subject_specific_message($master_id, 0, $limit, $search_string_array, $is_count = TRUE);



        if ($count > 0 && $limit > 0) {
            $totalpages = ceil($count / $limit);
        } else {
            $totalpages = 0;
        }
        if ($page > $totalpages) {
            $page = $totalpages;
        }
        $start = ($limit * $page) - $limit;

        if ($start < 0) {
            $start = 0;
        }
        $response = new stdClass();
        $response->page = $page;

        $response->total = $totalpages;
        $response->records = $count;
        $response->start = $start + 1;
        $response->end = $start + $limit;
        $message_result = $this->communication_model->get_subject_specific_message($master_id, $start, $limit, $search_string_array, $is_count = false);

        $j = 0;
        foreach ($message_result as $row) {
            $response->message[$j] = array('message' => $row->message, 'email' => $row->email, 'full_name' => $row->full_name, 'created_at' => $row->created_at);
            $j++;
        }

        echo json_encode($response);
    }

    public function get_message_receipient() {
        $response = new stdClass();
        $master_id = $this->encryption->decrypt($this->input->post('master_id'));
        $recever_list = $this->communication_model->get_message_receipient($master_id);
        echo json_encode($recever_list);
    }

    public function send_reply() {

        $master_id = $this->encryption->decrypt($this->input->post('master_id'));
        $message_data = array('msg_master_id' => $master_id,
            'created_by' => $this->session->userdata('id'),
            'created_at' => date('Y-m-d H:i:s'),
            'message' => $this->input->post('message'));
        $message_id = $this->communication_model->save_message($message_data);
        $receiver_array = array();
        foreach ($this->input->post('users') as $user) {
            array_push($receiver_array, array('message_id' => $message_id, 'msg_master_id' => $master_id, 'receiver_id' => $user));
        }
        $this->communication_model->save_message_receiver($receiver_array);
        $limit = 10; //no. of rows
        $search_string_array = "";

        if ($this->input->post('search') == 'true') {
            $search_string_array = json_decode($this->input->post('search_string_array'));
        }
        $page = 1;
        if ($page == "") {
            $page = 1;
        }
        $count = $this->communication_model->get_subject_specific_message($master_id, 0, $limit, $search_string_array, $is_count = TRUE);



        if ($count > 0 && $limit > 0) {
            $totalpages = ceil($count / $limit);
        } else {
            $totalpages = 0;
        }
        if ($page > $totalpages) {
            $page = $totalpages;
        }
        $start = ($limit * $page) - $limit;

        if ($start < 0) {
            $start = 0;
        }
        $response = new stdClass();
        $response->page = $page;

        $response->total = $totalpages;
        $response->records = $count;
        $response->start = $start + 1;
        $response->end = $start + $limit;
        $message_result = $this->communication_model->get_subject_specific_message($master_id, $start, $limit, $search_string_array, $is_count = false);

        $j = 0;
        foreach ($message_result as $row) {
            $response->message[$j] = array('message' => $row->message, 'email' => $row->email, 'full_name' => $row->full_name, 'created_at' => $row->created_at);
            $j++;
        }

        echo json_encode($response);
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
