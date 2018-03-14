<?php

class admin_companyday extends CI_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));


        if ((!$this->session->userdata('is_logged_in')) && (!$this->input->is_ajax_request())) {
            redirect('admin_company/login');
        } else {
            $this->load->model('companyday_model');
        }
    }

    /**
     * Load the main view with all the current model model's data.
     * @return void
     */
    public function index() {
        $usernm = $this->session->userdata('user_name');
        $userid = $this->session->userdata('id');
        $data['footerdata'] = $this->companycmspage_model->list_cmspage();
        $data['main_content'] = 'admin_company/day/list';
        $this->load->view('includes/template', $data);
    }

//index
    public function day_list() {

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
        $count = $this->companyday_model->get_days($userid, $sidx, $sord, 0, $limit, $search_string_array, $is_count = true);

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

        $query = $this->companyday_model->get_days($userid, $sidx, $sord, $start, $limit, $search_string_array, $is_count = false);
        $response = new stdClass();
        $response->page = $page;

        $response->total = $totalpages;
        $response->records = $count;
        $response->start = $start + 1;
        $response->end = $start + $limit;
        $i = 0;

        foreach ($query->result() as $row) {

            $response->rows[$i] = array('id' => $this->encryption->encrypt($row->id), 'name' => $row->name, 'day_no' => 'Day ' . $row->day_no, 'description' => $row->description);
            $i++;
        }
        echo json_encode($response);
    }

    public function add() {
        $userid = $this->session->userdata('id');
        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            //if the form has passed through the validation
            if ($this->form_validation->run()) {

                $data_to_store = array(
                    'name' => $this->input->post('name'),
                    'day_no' => $this->input->post('day_no'),
                    'description' => $this->input->post('description')
                );
                $trim_insert_array = trim_array($data_to_store);
                $manadate_insert_details = $this->mandate_update->get_insert_details();
                $day_id = $this->companyday_model->store_day(array_merge($trim_insert_array, $manadate_insert_details));



                if ($day_id) {
                    $this->session->set_flashdata('message', $this->lang->line('msg_day_insert_success'));
                    redirect('admin_company/day');
                }
            } else {
                $data['post_data'] = $this->input->post();
                $data['message'] = validation_errors();
            }
        }


        $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);
        $no_of_days = $this->company_model->get_event_days()->no_of_days;
        $days_array = array('' => $this->lang->line('opt_select'));
        for ($i = 1; $i <= $no_of_days; $i++) {
            $days_array[$i] = 'Day ' . $i;
        }
        $data['days_array'] = $days_array;
        $data['main_content'] = 'admin_company/day/add';
        $this->load->view('includes/template', $data);
    }

    /**
     * Update item by his id
     * @return void
     */
    public function update() {
        //product id 
        $id = $this->encryption->decrypt($this->input->post(id));
        $userid = $this->session->userdata('id');
        $data['day'] = $this->companyday_model->get_day_by_id($id);


        if (array_key_exists("name", $_POST)) {

            //if the form has passed through the validation
            if ($this->form_validation->run()) {


                $data_to_store = array(
                    'name' => $this->input->post('name'),
                    'day_no' => $this->input->post('day_no'),
                    'description' => $this->input->post('description')
                );

                $trim_update_array = trim_array($data_to_store);
                $manadate_update_details = $this->mandate_update->get_update_details();
                $query = $this->companyday_model->update_day($id, array_merge($trim_update_array, $manadate_update_details));


                if ($query == NULL) {
                    $data['message'] = "Admin, 'Unable to Edit please contact Administartor.'";
                } else {
               
                    $this->session->set_flashdata('message', $this->lang->line('msg_speaker_update_success'));
                    redirect('admin_company/day');
                }
            } else {
                $data['courses'] = array($this->input->post());
                $data['message'] = validation_errors();
            }
        }
        $data['day_id'] = $this->input->post(id);
        $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);
        $no_of_days = $this->company_model->get_event_days()->no_of_days;
        $days_array = array('' => $this->lang->line('opt_select'));
        for ($i = 1; $i <= $no_of_days; $i++) {
            $days_array[$i] = 'Day ' . $i;
        }
        $data['days_array'] = $days_array;
        $data['main_content'] = 'admin_company/day/edit';
        $this->load->view('includes/template', $data);
    }

    public function course_dropdown_list() {
        $userid = $this->session->userdata('id');
        $subcategory_id = $this->encryption->decrypt($this->input->post(sub_category));
        $sidx = 'id';
        $sord = 'desc';
        $search_string_array = "";
        $query = $this->companycourses_model->get_course_dropdownlist($userid, $subcategory_id);

        $response = new stdClass();

        $i = 0;

        foreach ($query as $row) {


            $response->rows[$i] = array('id' => $this->encryption->encrypt($row['id']), 'name' => $row['name']);
            $i++;
        }
        echo json_encode($response);
    }

    public function set_user_chapter_comments() {
        $course_id = $this->input->post('course_id');
        $chapter_comment = $this->input->post('comment');
        $commment_obj = new stdClass();
        $commment_obj->comment_text = $chapter_comment;
        $commment_obj->comment_by = $this->session->userdata('empuser_name');
        $commment_obj->commented_at = date('Y-m-d');
        $course_specific_comment_array = $this->companycourses_model->get_user_comments($course_id);

        if (empty($course_specific_comment_array) || is_null($course_specific_comment_array)) {
            $course_comment_array = json_encode(array($commment_obj));
        } else {

            $course_comment_array = json_decode($course_specific_comment_array);
            array_push($course_comment_array, $commment_obj);
            $course_comment_array = json_encode($course_comment_array);
        }

        $comment_details_array = array('comments' => $course_comment_array, 'id' => $course_id);
        $this->companycourses_model->update_courses($course_id, $comment_details_array);
        $query = $this->companycourses_model->get_user_comments($course_id);
        $comments_array = json_decode($query);
        // print_r($comments_array);

        $response = new stdClass();
        if ($query != null) {
            $response->status = 'Success';
            $response->comments = json_encode(array_reverse(array_slice($comments_array, -5)));
            $response->commented_at = date('Y-m-d H:I:S');
        } else {
            $response->status = "Fail";
        }
        echo json_encode($response);
    }

    public function get_user_comments() {
        $page = $this->input->post('page');
        $course_id = $this->input->post('course_id');

        $comments = json_decode($this->companycourses_model->get_user_comments($course_id));
        $response = new stdClass();

        if ($comments != null) {
            $response->status = 'Success';
            $limit = 5; //no. of rows

            $page = trim($this->input->post('page'));
            if ($page == "") {
                $page = 1;
            }
            $count = sizeof($comments);
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
            $response = new stdClass();
            $response->page = $page;
            $response->rows = array_slice(array_reverse($comments), $start, $limit);
            $response->total = $totalpages;
            $response->records = $count;
            $response->start = $start + 1;
            $response->end = $start + $limit;
        } else {
            $response->status = "Fail";
        }

        echo json_encode($response);
    }

    function check_day_availabilty() {
        $day_no = $this->input->post('day_no');
        $day_id = $this->encryption->decrypt($this->input->post('id'));
        $day_result = $this->companyday_model->check_day_availabilty($day_no);

        if (isset($day_id) && ($day_id != $day_result->id) && ($day_no == $day_result->day_no)) {
            $this->form_validation->set_message('check_day_availabilty', 'Record is already available for Day ' . $day_no);
            return False;
        } elseif ((!isset($day_id)) && ($day_no == $day_result->day_no)) {
            $this->form_validation->set_message('check_day_availabilty', 'Record is already available for Day ' . $day_no);
            return False;
        }
        return TRUE;
    }

}
