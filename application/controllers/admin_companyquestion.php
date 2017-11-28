<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_companyquestion
 *
 * @author abc
 */
class admin_companyquestion extends CI_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

        if ((!$this->session->userdata('is_logged_in')) && (!$this->input->is_ajax_request())) {
            redirect('admin_company/login');
        } else {
            $this->load->model('companyquestion_model');
            $this->load->library('Encryption');
            $this->load->model('companyquestionbank_model');
        }
    }

    public function add() {
        $userid = $this->session->userdata('id');
        $insert_data = array(
            'name' => $this->input->post('question'),
            'options' => json_encode($this->input->post('option')),
            'question_type' => $this->input->post('question_type'),
            'chapter_id' => $this->encryption->decrypt($this->input->post('chapter_id')),
            'question_by' => $userid
        );
        $question_id = $this->companyquestion_model->insert($insert_data);
        $response = new stdClass();
        if ($question_id !== null) {
            if (array_key_exists('questionbank_id', $_POST)) {

                $questionbank_id = $this->encryption->decrypt($this->input->post('questionbank_id'));
                $questionbank_question_list = $this->companyquestionbank_model->question_bank_question_list($questionbank_id);
                $questionbank_question_list = json_decode($questionbank_question_list);

                $array_count = array_push($questionbank_question_list, $question_id);

                $data = array('question_list' => json_encode($questionbank_question_list));

                $query = $this->companyquestionbank_model->update_questionbank_question_list($questionbank_id, $data);
                if ($query != NULL) {
                    $response->question_id = $question_id;
                    $response->status = 'Success';
                } else {
                    $response->question_id = $question_id;
                    $response->status = 'Problem while updating QuestionBank';
                }
            } else {
                $response->question_id = $question_id;
                $response->status = 'Success';
            }
        } else {
            $response->question_id = $question_id;
            $response->status = 'Fail';
        }
        echo json_encode($response);
    }

}
