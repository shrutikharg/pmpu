<?php

class Admin_companyspeaker extends CI_Controller {

   
    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));


        if ((!$this->session->userdata('is_logged_in')) && (!$this->input->is_ajax_request())) {
            redirect('admin_company/login');
        } else {
            $this->load->model('companyspeaker_model');
          
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
        $data['main_content'] = 'admin_company/speaker/list';
        $this->load->view('includes/template', $data);
    }

//index
    public function speaker_list() {
       
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
        $count = $this->companyspeaker_model->get_speakers($userid, $sidx, $sord, 0, $limit, $search_string_array, $is_count = true);

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

        $query = $this->companyspeaker_model->get_speakers($userid, $sidx, $sord, $start, $limit, $search_string_array, $is_count = false);
        $response = new stdClass();
        $response->page = $page;

        $response->total = $totalpages;
        $response->records = $count;
        $response->start = $start + 1;
        $response->end = $start + $limit;
        $i = 0;

        foreach ($query->result() as $row) {
       
            $response->rows[$i] = array('id' => $this->encryption->encrypt($row->id), 'name' => $row->name, 'designation' => $row->designation, 'description' => $row->description);
            $i++;
        }
        echo json_encode($response);
    }

    public function add() {
        $userid=$this->session->userdata('id');
        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            //if the form has passed through the validation
            if ($this->form_validation->run()) {

       $data_to_store = array(
                    'name' => $this->input->post('name'),
                    'designation' => $this->input->post('designation'),                 
                    'description' => $this->input->post('description')
                );
                $trim_insert_array = trim_array($data_to_store);
                $manadate_insert_details = $this->mandate_update->get_insert_details();
                $speaker_id = $this->companyspeaker_model->store_speaker(array_merge($trim_insert_array, $manadate_insert_details));
              
                if ($speaker_id > 0) {
                    
                    //$user_admin_id = $this->Companyuser_model->get_admin_id($userid);

                    $user_parent_directory_path = './uploads/chapter_documents/comp_' . $this->session->userdata('company_id');
                    $user_parent_directory = create_directory($user_parent_directory_path);
                    $user_directory_path = $user_parent_directory . '/user_' . $userid;
                    $user_directory = create_directory($user_directory_path);
                    $user_course_directory_path = $user_directory_path . '/speaker_' . $speaker_id;
                    $user_course_directory = create_directory($user_course_directory_path);
                    if ($_FILES['speaker_image']['size'] != 0) {
                          $config['upload_path'] = $user_course_directory;
                        $config['allowed_types'] = 'gif|jpg|png|jpeg';
                        $config['max_size'] = '1000';
                        $config['max_width'] = '1024';
                        $config['max_height'] = '768';
                        $config['overwrite'] = FALSE;
                        $upload_data = $this->upload->do_my_upload('speaker_image', $config);
                   
                        if ($upload_data['status']==TRUE) {
                            $user_course_image_path = $user_course_directory . '/' . $upload_data['details']['raw_name'].$upload_data['details']['file_ext'];
                            $course_image_path_data = array('image_path' => substr($user_course_image_path, 2));
                            $this->companyspeaker_model->update_speaker($speaker_id, $course_image_path_data);
                        }
                    }
                }

                if ($speaker_id) {
                    $this->session->set_flashdata('message', $this->lang->line('msg_speaker_insert_success'));
                    redirect('admin_company/speaker');
                }
            } else {
                $data['post_data'] = $this->input->post();              
                $data['message']=validation_errors();
            }
        }

      
        $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);

        //load the view
        $data['main_content'] = 'admin_company/speaker/add';
        $this->load->view('includes/template', $data);
    }

    /**
     * Update item by his id
     * @return void
     */
    public function update() {
        //product id 
        $id = $this->encryption->decrypt($this->input->post(speaker_id)); 
         $userid=$this->session->userdata('id');
        $data['speaker'] = $this->companyspeaker_model->get_speaker_by_id($id);
   

        if (array_key_exists("name", $_POST)) {

            //if the form has passed through the validation
            if ($this->form_validation->run()) {


                $data_to_store = array(
                    'name' => $this->input->post('name'),
                    'designation' => $this->input->post('designation'),                    
                    'description' => $this->input->post('description')
                );

                $trim_update_array = trim_array($data_to_store);
                $manadate_update_details = $this->mandate_update->get_update_details();
                $query = $this->companyspeaker_model->update_speaker($id, array_merge($trim_update_array, $manadate_update_details));


                if ($query == NULL) {
                    $data['message'] = "Admin, 'Unable to Edit please contact Administartor.'";
                } else {
                    // $user_admin_id = $this->Companyuser_model->get_admin_id($userid);
                   
                        $user_parent_directory_path = './uploads/chapter_documents/comp_' . $this->session->userdata('company_id');
                        $user_parent_directory = create_directory($user_parent_directory_path);
                        $user_directory_path = $user_parent_directory . '/user_' . $userid;
                        $user_directory = create_directory($user_directory_path);
                        $user_course_directory_path = $user_directory_path . '/speaker_' . $id;
                        $user_course_directory = create_directory($user_course_directory_path);
                        if ($_FILES['speaker_image']['size'] != 0) {
                               $config['upload_path'] = $user_course_directory;
                        $config['allowed_types'] = 'gif|jpg|png|jpeg';
                        $config['max_size'] = '1000';
                        $config['max_width'] = '1024';
                        $config['max_height'] = '768';
                        $config['overwrite'] = FALSE;
                        $upload_data = $this->upload->do_my_upload('speaker_image', $config);
                   
                        if ($upload_data['status']==TRUE) {//die();
                            $user_course_image_path = $user_course_directory . '/' . $upload_data['details']['raw_name'].$upload_data['details']['file_ext'];
                            $course_image_path_data = array('image_path' => substr($user_course_image_path, 2));
                            $this->companyspeaker_model->update_speaker($id, $course_image_path_data);
                        }
                        }
                        else{
                            die();
                        }                    
                   $this->session->set_flashdata('message',$this->lang->line('msg_speaker_update_success'));
                    redirect('admin_company/speaker');
                }
            } else {
                $data['courses'] = array($this->input->post());
                $data['message'] = validation_errors();
            }
        }

        


        $data['speaker_id'] = $this->input->post(speaker_id);
        $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);

        $data['main_content'] = 'admin_company/speaker/edit';
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
    public function get_user_comments(){
        $page = $this->input->post('page');
        $course_id = $this->input->post('course_id');

        $comments= json_decode($this->companycourses_model->get_user_comments($course_id));
        $response = new stdClass();

        if ($comments != null) {
            $response->status = 'Success';
            $limit =5; //no. of rows
           
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

}
