<?php

class Admin_companycourses extends CI_Controller {

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
            $this->load->model('companycourses_model');
            $this->load->model('companysubcategory_model');
            $this->load->model('companycategory_model');
            $this->load->model('Companyuser_model');
            $this->load->model('companychapters_model');
        }
    }

    /**
     * Load the main view with all the current model model's data.
     * @return void
     */
    public function index() {
        $usernm = $this->session->userdata('user_name');
        $userid = $this->session->userdata('id');
        $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);
        $data['subcategory'] = $this->companysubcategory_model->get_subcategory_list();
        $data['main_content'] = 'admin_company/courses/list';
        $this->load->view('includes/template', $data);
    }

//index
    public function course_list() {
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
        $count = $this->companycourses_model->get_courses($userid, $sidx, $sord, 0, $startd, $endd, $limit, $search_string_array, $is_count = true);

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

        $query = $this->companycourses_model->get_courses($userid, $sidx, $sord, $start, $startd, $endd, $limit, $search_string_array, $is_count = false);
        $response = new stdClass();
        $response->page = $page;

        $response->total = $totalpages;
        $response->records = $count;
        $response->start = $start + 1;
        $response->end = $start + $limit;
        $i = 0;

        foreach ($query->result() as $row) {
            $response->rows[$i] = array('id' => $this->encryption->encrypt($row->id), 'name' => $row->course, 'subcategory' => $row->subcategory, 'assigner' => $row->course_by, 'description' => $row->description, 'startdate' => $row->start_date, 'enddate' => $row->end_date);
            $i++;
        }
        echo json_encode($response);
    }

    public function add() {
        $userid = $this->session->userdata('id');
        $usernm = $this->session->userdata('user_name');
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            //if the form has passed through the validation
            if ($this->form_validation->run()) {

       $data_to_store = array(
                    'name' => $this->input->post('name'),
                    'course_by' => $this->input->post('course_by'),                 
                    'description' => $this->input->post('description')
                );
                $trim_insert_array = trim_array($data_to_store);
                $manadate_insert_details = $this->mandate_update->get_insert_details();
                $course_id = $this->companycourses_model->store_courses(array_merge($trim_insert_array, $manadate_insert_details));
              
                if ($course_id > 0) {
                    
                    //$user_admin_id = $this->Companyuser_model->get_admin_id($userid);

                    $user_parent_directory_path = './uploads/chapter_documents/comp_' . $this->session->userdata('company_id');
                    $user_parent_directory = create_directory($user_parent_directory_path);
                    $user_directory_path = $user_parent_directory . '/user_' . $userid;
                    $user_directory = create_directory($user_directory_path);
                    $user_course_directory_path = $user_directory_path . '/course_' . $course_id;
                    $user_course_directory = create_directory($user_course_directory_path);
                    if ($_FILES['courseimage']['size'] != 0) {
                          $config['upload_path'] = $user_course_directory;
                        $config['allowed_types'] = 'gif|jpg|png|jpeg';
                        $config['max_size'] = '1000';
                        $config['max_width'] = '1024';
                        $config['max_height'] = '768';
                        $config['overwrite'] = FALSE;
                        $upload_data = $this->upload->do_my_upload('courseimage', $config);
                   
                        if ($upload_data['status']==TRUE) {
                            $user_course_image_path = $user_course_directory . '/' . $upload_data['details']['raw_name'].$upload_data['details']['file_ext'];
                            $course_image_path_data = array('image_path' => substr($user_course_image_path, 2));
                            $this->companycourses_model->update_courses($course_id, $course_image_path_data);
                        }
                    }
                }

                if ($course_id) {
                    $this->session->set_flashdata('message', $this->lang->line('msg_course_insert_success'));
                    redirect('admin_company/courses');
                }
            } else {
                $data['post_data'] = $this->input->post();              
                $data['message']=validation_errors();
            }
        }

      
        $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);

        //load the view
        $data['main_content'] = 'admin_company/courses/add';
        $this->load->view('includes/template', $data);
    }

    /**
     * Update item by his id
     * @return void
     */
    public function update() {
        //product id 
        $id = $this->encryption->decrypt($this->input->post(course_id));
        $userid = $this->session->userdata('id');
        $usernm = $this->session->userdata('user_name');
        $data['courses'] = $this->companycourses_model->get_courses_by_id($id);
        //if save button was clicked, get the data sent via post

        if (array_key_exists("name", $_POST)) {

            //if the form has passed through the validation
            if ($this->form_validation->run()) {


                $data_to_store = array(
                    'name' => $this->input->post('name'),
                    'course_by' => $this->input->post('course_by'),                    
                    'description' => $this->input->post('description')
                );

                $trim_update_array = trim_array($data_to_store);
                $manadate_update_details = $this->mandate_update->get_update_details();
                $query = $this->companycourses_model->update_courses($id, array_merge($trim_update_array, $manadate_update_details));


                if ($query == NULL) {
                    $data['message'] = "Admin, 'Unable to Edit please contact Administartor.'";
                } else {
                    // $user_admin_id = $this->Companyuser_model->get_admin_id($userid);
                   
                        $user_parent_directory_path = './uploads/chapter_documents/comp_' . $this->session->userdata('company_id');
                        $user_parent_directory = create_directory($user_parent_directory_path);
                        $user_directory_path = $user_parent_directory . '/user_' . $userid;
                        $user_directory = create_directory($user_directory_path);
                        $user_course_directory_path = $user_directory_path . '/course_' . $id;
                        $user_course_directory = create_directory($user_course_directory_path);
                        if ($_FILES['courseimage']['size'] != 0) {
                               $config['upload_path'] = $user_course_directory;
                        $config['allowed_types'] = 'gif|jpg|png|jpeg';
                        $config['max_size'] = '1000';
                        $config['max_width'] = '1024';
                        $config['max_height'] = '768';
                        $config['overwrite'] = FALSE;
                        $upload_data = $this->upload->do_my_upload('courseimage', $config);
                   
                        if ($upload_data['status']==TRUE) {
                            $user_course_image_path = $user_course_directory . '/' . $upload_data['details']['raw_name'].$upload_data['details']['file_ext'];
                            $course_image_path_data = array('image_path' => substr($user_course_image_path, 2));
                            $this->companycourses_model->update_courses($id, $course_image_path_data);
                        }
                        }
                    
                   $this->session->set_flashdata('message',$this->lang->line('msg_course_update_success'));
                    redirect('admin_company/courses');
                }
            } else {
                $data['courses'] = array($this->input->post());
                $data['message'] = validation_errors();
            }
        }

        


        $data['course_id'] = $this->input->post(course_id);
        $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);

        $data['main_content'] = 'admin_company/courses/edit';
        $this->load->view('includes/template', $data);
    }

//update

    /**
     * Delete product by his id
     * @return void
     */

    /**
     * Delete product by his id
     * @return void
     */
    public function delete() {
        //product id 
        $id = $this->uri->segment(4);
        //$this->courses_model->delete_courses($id);
        //redirect('admin/courses');

        $data_to_store = array(
            'modify_date' => date('Y-m-d'),
            'modify_by' => $this->session->userdata('user_name'),
            'IsActive' => 'N'
        );

        if ($this->companycourses_model->update_courses($id, $data_to_store) == TRUE) {
            $this->session->set_flashdata('flash_message', 'Retired');
        } else {
            $this->session->set_flashdata('flash_message', 'Not Retired');
        }
        //redirect('admin/courses/update/'.$id.'');
        redirect('admin_company/courses');
    }

//edit

    public function activate() {
        //product id 
        $id = $this->uri->segment(4);
        //$this->courses_model->delete_courses($id);
        //redirect('admin/courses');

        $data_to_store = array(
            'modify_date' => date('Y-m-d'),
            'modify_by' => $this->session->userdata('user_name'),
            'IsActive' => 'Y'
        );

        if ($this->companycourses_model->update_courses($id, $data_to_store) == TRUE) {
            $this->session->set_flashdata('flash_message', 'Activate');
        } else {
            $this->session->set_flashdata('flash_message', 'Not Activate');
        }
        //redirect('admin/courses/update/'.$id.'');
        redirect('admin_company/courses');
    }

//edit
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

    function search_by_name() {
        $userid = $this->session->userdata('id');

        $course_name = $this->input->post('name');
        $search_string_array = array('name' => $course_name);
        $count = $this->companycourses_model->get_course_by_name($userid, $search_string_array);
        echo $count;
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
