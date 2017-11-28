<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_companyquestionbank
 *
 * @author a
 */
class admin_Companyquestionbank extends CI_Controller {

    /**
     * name of the folder responsible for the views 
     * which are manipulated by this controller
     * @constant string
     */
    const VIEW_FOLDER = 'admin_company/courses';

    /**
     * Responsable for auto load the model
     * @return void
     */
    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));



        if ((!$this->session->userdata('is_logged_in')) && (!$this->input->is_ajax_request())) {
            redirect('admin_company/login');
        } else {
            $this->load->model('companyquestionbank_model');
        }
    }

    /**
     * Load the main view with all the current model model's data.
     * @return void
     */
    public function index() {


        $data['main_content'] = 'admin_company/questionBank/list1';
        $this->load->view('includes/template', $data);
    }

//index

    public function questionbank_list() {

        $userid = $this->session->userdata('id');
        $limit = 10; //no. of rows
        $sidx = 'id';
        $sord = "desc";

        if ($this->input->post('search') == 'true') {
            $search_string_array = json_decode($this->input->post('search_string_array'));
        }
        $page = trim($this->input->post('page'));
        if ($page == "") {
            $page = 1;
        }
        $count = $this->companyquestionbank_model->get_questionbank($userid, $sidx, $sord, 0, $limit, $search_string_array, $is_count = true);

        if (!$sidx) {
            $sidx = 1;
        }
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

        $query = $this->companyquestionbank_model->get_questionbank($userid, $sidx, $sord, $start, $limit, $search_string_array, $is_count = false);
        $response = new stdClass();
        $response->page = $page;

        $response->total = $totalpages;
        $response->records = $count;
        $response->start = $start + 1;
        $i = 0;

        foreach ($query->result() as $row) {


            $response->rows[$i] = array('id' => $this->encryption->encrypt($row->id), 'name' => $row->name, 'chapter' => $row->Chapter, 'chapter_id' => $this->encryption->encrypt($row->chapter_id));
            $i++;
        }
        echo json_encode($response);
    }

    public function chapterquestion_list() {
        $chapter_id = $this->encryption->decrypt($this->input->post(chapter_id));
        $question_bank_id = $this->encryption->decrypt($this->input->post(question_bank_id));
        $chapterquestion_data = $this->companyquestionbank_model->get_chapters_question_list($chapter_id, $question_bank_id);
        $response = new stdClass();

        $i = 0;
        if ($chapterquestion_data != NULL) {
            foreach ($chapterquestion_data->result() as $row) {


                $response->rows[$i] = array('id' => $this->encryption->encrypt($row->id), 'name' => $row->name, 'question_added_status' => $row->status);
                $i++;
            }
            echo json_encode($response);
        }
    }

    public function update_question_list() {
        $question_bank_id = $this->encryption->decrypt($this->input->post(question_bank_id));
        $question_bank_chapter_list = array();
        foreach ($this->input->post(chapter_list) as &$value) {
            array_push($question_bank_chapter_list, $this->encryption->decrypt($value));
        }
        $data = array('question_list' => implode(",", $question_bank_chapter_list));
        $query = $this->companyquestionbank_model->update_questionbank_question_list($question_bank_id, $data);
        if ($query !== NULL) {
            echo 'successfully updated';
        } else {
            echo'Problem while updating';
        }
    }

    public function add() {
        $name = $this->input->post(name);
        $chapter_id = $this->encryption->decrypt($this->input->post(chapter_id));
        $insert_data = array(
            'name' => $name,
            'chapter_id' => $chapter_id,
            'created_by' => $userid = $this->session->userdata('id')
        );
        $query = $this->companyquestionbank_model->add($insert_data);
        if ($query != NULL) {
            echo "Success";
        } else {
            echo "Fail";
        }
    }

    public function question_list() {
        $questionbank_id = $this->encryption->decrypt($this->input->post(questionbank_id));
        $questionbank_question_list = $this->companyquestionbank_model->question_list($questionbank_id);
        $response = new stdClass();

        $i = 0;

        foreach ($questionbank_question_list->result() as $row) {


            $response->rows[$i] = array('id' => $this->encryption->encrypt($row->id), 'name' => $row->name);
            $i++;
        }
        echo json_encode($response);
    }

    public function get_questionbanks_question_list() {
        $quiz_based_on = $this->input->post(quiz_based_on);
        $quiz_based_value = $this->input->post(quiz_based_value);

        $questionbank_question_list = $this->companyquestionbank_model->get_questionbanks_question_list($$quiz_based_on, $quiz_based_value);
        $response = new stdClass();

        $i = 0;

        foreach ($questionbank_question_list->result() as $row) {


            $response->rows[$i] = array('id' => $this->encryption->encrypt($row->id), 'name' => $row->name);
            $i++;
        }
        echo json_encode($response);
    }

}
