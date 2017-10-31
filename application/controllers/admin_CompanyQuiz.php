<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_CompanyQuiz
 *
 * @author a
 */
class admin_CompanyQuiz extends CI_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('Companyquiz_model');
        $this->load->model('companycmspage_model');
        $this->load->library('Encryption');



        if (!$this->session->userdata('is_logged_in')) {
            redirect('admin_company/login');
        }
    }

    /**
     * Load the main view with all the current model model's data.
     * @return void
     */
    public function index() {

        $data['main_content'] = 'admin_company/quiz/list';
        $this->load->view('includes/template', $data);
    }

    public function quiz_list() {

        $usernm = $this->session->userdata('user_name');
        $userid = $this->session->userdata('id');
        $limit = $this->input->post(rows); //no. of rows
        $sidx = 'id';
        $sord = "desc";

        if ($this->input->post('search') == 'true') {
            $search_string_array = json_decode($this->input->post('search_string_array'));
        }
        $page = trim($this->input->post('page'));
        if ($page == "") {
            $page = 1;
        }
        $count = $this->Companyquiz_model->get_quiz($userid, $sidx, $sord, 0, $limit, $search_string_array, $is_count = true);

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

        $query = $this->Companyquiz_model->get_quiz($userid, $sidx, $sord, $start, $limit, $search_string_array, $is_count = false);
        $response = new stdClass();
        $response->page = $page;

        $response->total = $totalpages;
        $response->records = $count;
        $response->start = $start + 1;
        $response->end = $start + $limit;


        $i = 0;


        foreach ($query->result() as $row) {


            $response->rows[$i] = array('id' => $this->encryption->encrypt($row->id), 'name' => $row->name, 'description' => $row->description, 'start_date' => $row->start_date, 'end_date' => $row->end_date, 'allowed_time' => $row->allowd_time, 'no_of_attempt' => $row->no_of_attempt);
            $i++;
        }
        echo json_encode($response);
    }

//index

    public function get_question_from_questionbank() {
        $quiz_based_on = $this->input->post(quiz_based_on);
        $quiz_based_value = $this->input->post(quiz_based_value);
        $quiz_based_value_array = array();
        foreach ($quiz_based_value as $value) {
            array_push($quiz_based_value_array, $this->encryption->decrypt($value));
        }
        $i = 0;
        $response = new stdClass();


        $query = $this->Companyquiz_model->get_question_from_questionbank($quiz_based_on, $quiz_based_value_array);

        echo json_encode($query);
    }

    public function update_question_list() {
        $quiz_question_list_array = $this->input->post(question_list);
        $query = $this->Companyquiz_model->update_question_list($quiz_question_list_array);
    }

    public function add() {

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $insert_array = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'allowd_time' => $this->input->post('allowd_time'),
                'start_date' => $this->input->post('start_date'),
                'end_date' => $this->input->post('end_date'),
                'no_of_attempt' => $this->input->post('no_of_attempt'),
                'end_date' => $this->input->post('end_date'),
                'passing_percentage' => $this->input->post('passing_percentage'),
                'created_by' => $userid = $this->session->userdata('id'),
                'created_at' => date('Y-m-d')
            );
            $query = $this->Companyquiz_model->add($insert_array);
        } else {
            $data['main_content'] = 'admin_company/quiz/add';
            $this->load->view('includes/template', $data);
        }
    }

    public function update() {
        $id = $this->encryption->decrypt($this->input->post('quiz_id'));
        $userid = $this->session->userdata('id');
        $usernm = $this->session->userdata('user_name');
        if (array_key_exists("name", $_POST)) {
            //form validation
            $this->form_validation->set_rules('name', 'Course Name', 'required');

            $this->form_validation->set_rules('courseby', 'Course Author', 'trim|required|min_length[5]|xss_clean');
            $this->form_validation->set_rules('subcategory', 'Sub Category of Course', 'trim|required|numeric|xss_clean');
            $this->form_validation->set_rules('description', 'Course Description', 'trim|xss_clean');

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()) {


                $update_array = array(
                    'name' => $this->input->post('name'),
                    'description' => $this->input->post('description'),
                    'allowd_time' => $this->input->post('allowd_time'),
                    'start_date' => $this->input->post('start_date'),
                    'end_date' => $this->input->post('end_date'),
                    'no_of_attempt' => $this->input->post('no_of_attempt'),
                    'end_date' => $this->input->post('end_date'),
                    'passing_percentage' => $this->input->post('passing_percentage'),
                    'modified_by' => $userid,
                    'modified_at' => date('Y-m-d')
                );
                $query = $this->Companyquiz_model->edit($id, $update_array);
                $data['updated'] = TRUE;
                if ($query == NULL) {
                    $data['query_status'] = "Admin, 'Unable to Edit please contact Administartor.'";
                } else {
                    $user_admin_id = $this->Companyquiz_model->update($id, $update_array);

                    $data['query_status'] = "QuizCourse Updated Successfully";
                }
            }
        }

        $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);
        $data['quiz_data'] = $this->Companyquiz_model->get_quiz_by_id($id);
        $data['main_content'] = 'admin_company/quiz/edit';
        $this->load->view('includes/template', $data);
    }

    public function add_question() {
        $quiz_id = $this->input->post('quiz_id');
        if (array_key_exists('name', $_POST)) {
            $this->load->model('companyquestion_model');
            $insert_data = array(
                'name' => $this->input->post('name'),
                'options' => json_encode($this->input->post('options')),
                    //'question_type' => $this->input->post('question_type'),
                    //;'chapter_id' => $this->encryption->decrypt($this->input->post('chapter_id')),
                    //'question_by' => $userid
            );
            $question_id = $this->companyquestion_model->insert($insert_data);

            $query = $this->Companyquiz_model->add_question($this->encryption->decrypt($quiz_id), $question_id);
            if ($query != NULL) {
                echo 'Success';
            } else {
                echo 'Fail';
            }
        } else {
            $data['quiz_id'] = $quiz_id;
            $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);
            $data['quiz_data'] = $this->Companyquiz_model->get_quiz_by_id($quiz_id);
            $data['main_content'] = 'admin_company/quiz/add_question';
            $this->load->view('includes/template', $data);
        }
    }

    public function question_list() {

        $userid = $this->session->userdata('id');
        $quiz_id=$this->encryption->decrypt($this->input->post('quiz_id'));
        $limit = $this->input->post(rows); //no. of rows
        $sidx = 'id';
        $sord = "desc";

        if ($this->input->post('search') == 'true') {
            $search_string_array = json_decode($this->input->post('search_string_array'));
        }
        $page = trim($this->input->post('page'));
        if ($page == "") {
            $page = 1;
        }
        $count = $this->Companyquiz_model->get_question_list($userid,$quiz_id, $sidx, $sord, 0, $limit, $search_string_array, $is_count = true);

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

        $query = $this->Companyquiz_model->get_question_list($userid,$quiz_id, $sidx, $sord, $start, $limit, $search_string_array, $is_count = false);
        $response = new stdClass();
        $response->page = $page;

        $response->total = $totalpages;
        $response->records = $count;
        $response->start = $start + 1;
        $response->end = $start + $limit;
        $i = 0;

        foreach ($query->result() as $row) {
            $response->rows[$i] = array('id' => $this->encryption->encrypt($row->id), 'name' => $row->name, 'options' => $row->options, 'question_type' => $row->question_type);
            $i++;
        }
        echo json_encode($response);
    }

}
