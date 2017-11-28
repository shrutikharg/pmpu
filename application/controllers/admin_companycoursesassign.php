<?php

class admin_companycoursesassign extends CI_Controller {

    /**
     * name of the folder responsible for the views 
     * which are manipulated by this controller
     * @constant string
     */
    const VIEW_FOLDER = 'admin_company/coursesassign';

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
            $this->load->model('companycoursesassign_model');
            $this->load->model('companysubcategory_model');
            $this->load->model('companycategory_model');
            $this->load->model('companycmspage_model');
            $this->load->model('Companycourses_model');
            $this->load->model('Companyuser_model');
            $this->load->helper('email_format/course_assignment');
        }
    }

    /**
     * Load the main view with all the current model model's data.
     * @return void
     */
    public function index() {

        $userid = $this->session->userdata('id');
        $usernm = $this->session->userdata('user_name');
        $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);
        $data['main_content'] = 'admin_company/coursesassign/list';
        $this->load->view('includes/template', $data);
    }

    public function course_assign_list() {
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
        $count = $this->companycoursesassign_model->get_courses($userid, $sidx, $sord, 0, $limit, $search_string_array, $is_count = true);

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

        $query = $this->companycoursesassign_model->get_courses($userid, $sidx, $sord, $start, $limit, $search_string_array, $is_count = false);
        $response = new stdClass();
        $response->page = $page;

        $response->total = $totalpages;
        $response->records = $count;
        $response->start = $start + 1;
        $response->end = $start + $limit;
        $i = 0;

        foreach ($query->result() as $row) {

            $start_date = str_replace('-', '/', $row->start_date);
            $end_date = str_replace('-', '/', $row->end_date);
            $response->rows[$i] = array('id' => $this->encryption->encrypt($row->id), 'name' => $row->name, 'start_date' => $start_date, 'end_date' => $end_date);
            $i++;
        }
        echo json_encode($response);
    }

public function add(){
   $id = $this->encryption->decrypt($this->input->post('course_id'));
   $user_list=$this->companyuser_model->get_user_bycompany();
   $assigned_course_array=array();
   $manadate_update_array=$this->mandate_update->get_insert_details();
   foreach($user_list as $row){
      $assigned_user_array=array('assigned_to'=>$row['user_id'],
            'course_id'=>$id);
        array_push($assigned_course_array,array_merge($assigned_user_array,$manadate_update_array)); 
   }
   
  print_r($assigned_course_array); 
  $this->companycoursesassign_model->add_course_user_batch($assigned_course_array);
  
   
}

    /**
     * Update item by his id
     * @return void
     */
    public function update() {

        $id = $this->encryption->decrypt($this->input->post('course_id'));

        $userid = $this->session->userdata('id');

        $usernm = $this->session->userdata('user_name');

        if (array_key_exists("description", $_POST)) {

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            if ($this->form_validation->run()) {
                $data['courses'] = $this->companycoursesassign_model->get_courses_by_id($id);

                $file_element_name = 'userfile';
                if ($_FILES['userfile']['size'] != 0) {
                    // $user_admin_id = $this->Companyuser_model->get_admin_id($userid);
                    $user_parent_directory_path = './uploads/chapter_documents/comp_' . $this->session->userdata('company_id');
                    $user_parent_directory = create_directory($user_parent_directory_path);
                    $user_directory_path = $user_parent_directory . '/user_' . $userid;
                    $user_directory = create_directory($user_directory_path);
                    $user_course_directory_path = $user_directory . '/course_' . $id;
                    $user_course_directory = create_directory($user_course_directory_path);
                    $config['upload_path'] = $user_course_directory;
                    $config['allowed_types'] = 'csv';
                    $config['max_size'] = '1000';
                    $config['overwrite'] = TRUE;
                    $upload_data = $this->upload->do_my_upload('userfile', $config);


                    if ($upload_data['status'] == TRUE) {

                        $file_path = $user_course_directory . '/' . $upload_data['details']['file_name'];

                        $csv_array = $this->csvimport->get_array($file_path);


                        if (!empty($csv_array)) {


                            foreach ($csv_array as $row) {

$email=  trim($row['email']);
                                $result = trim_array($this->companycoursesassign_model->get_userdetailspresent($email));

                                if (!empty($result)) {




                                    $is_available = $this->check_value_by_usertype($result, 'group_id');

                                    if ($is_available == FALSE) {

                                        $user_data_to_update = array(
                                            'user_id' => $result[0]['id'],
                                            'group_id' => '7');
                                        $this->Companyuser_model->insert_user_group_type($user_data_to_update);
                                    }
                                    $employee_id = $result[0]['id'];
                                } else {
                                    $this->load->helper('email_format/user_create_update');


                                    $randomString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 3);
                                    $password = create_code();
                                    $insert_data = array(
                                        'email' => $email,
                                        'password' => md5($password),
                                        'company_id' => $this->session->userdata('company_id')
                                    );
                                    $trim_insert_array = trim_array($insert_data);
                                    $manadate_insert_details = $this->mandate_update->get_insert_details();
                                    $employee_id = $this->companycoursesassign_model->insert_csv(array_merge($trim_insert_array, $manadate_insert_details));

                                    if (!empty($employee_id)) {
                                        $user_creation_mail_details = create_user_format($email, $password);
                                        $message = $user_creation_mail_details->message;
                                        $activation_link = $user_creation_mail_details->activation_link;
                                        $receipient = $email;

                                        $subject = 'coolacharya.com -Rigistered Successfully ';

                                        $headers = 'MIME-Version: 1.0' . "\r\n";

                                        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                                        $headers .= 'From: coolacharya.com <info@coolacharya.com>' . "\r\n";
                                        mail($receipient, $subject, $message, $headers);
                                        // if (mail($receipient, $subject, $message, $headers)) {
                                        $activation_link_data = array('id' => $employee_id,
                                            'activation_code' => $activation_link);
                                        $this->Companyuser_model->update_user($activation_link_data);
                                    } else {
                                        echo 'User has not registered';
                                    }
                                }

                                $course_assign_data = array(
                                    'course_id' => $id,
                                    'assigned_to' => $employee_id,
                                );
                                $manadate_insert_details = $this->mandate_update->get_insert_details();
                                $query = $this->companycoursesassign_model->insert_assignedcourse(array_merge($course_assign_data, $manadate_insert_details));
                                if ($query !== NULL) {
                                    $course_details = $this->Companycourses_model->get_courses_by_id($id);
                                    $course_assignment_msg = course_assgnment_format($email, $course_details[0]['name']);
                                    $receipient = $email;

                                    $subject = 'coolacharya.com -Course Assignment';

                                    $headers = 'MIME-Version: 1.0' . "\r\n";

                                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                                    $headers .= 'From: coolacharya.com <info@coolacharya.com>' . "\r\n";
                                    mail($receipient, $subject, $course_assignment_msg, $headers);
                                }
                            }
                        } else {
                            echo "Unable to  UPLOADED Read file";
                        }
                    } else {
                        echo "Unable to upload file";
                    }
                }
            } else {
                $data['message'] = validation_errors();
            }
        }

        $data['category'] = $this->companycategory_model->get_category_list($userid);
        $data['subcategory'] = $this->companysubcategory_model->get_subcategory_dropdownlist($userid);
        $data['courses'] = $this->companycoursesassign_model->get_courses_by_id($id);
        $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);
        $data['course_id'] = $this->input->post('course_id');

        $data['main_content'] = 'admin_company/coursesassign/edit';
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

        if ($this->companycoursesassign_model->update_courses($id, $data_to_store) == TRUE) {
            $this->session->set_flashdata('flash_message', 'Retired');
        } else {
            $this->session->set_flashdata('flash_message', 'Not Retired');
        }
        //redirect('admin/courses/update/'.$id.'');
        redirect('admin_company/coursesassign');
    }

//edit

    public function assignall() {
        $this->output->enable_profiler(TRUE);

        $useremaildtils[] = $this->input->post('assign_course');
        var_dump($this->input->post('assign_course'));
        for ($i = 0; $i < count($this->input->post('assign_course')); $i++) {
            $data['userdetails'] = $this->companycoursesassign_model->get_userdetails($useremaildtils[$i]);

            $usermailid = $data['userdetails']['email'];
            {
                $config = Array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'ssl://smtp.gmail.com',
                    'smtp_port' => 465,
                    'smtp_user' => 'mail4prtham@gmail.com',
                    'smtp_pass' => 'qazpl@987',
                    'mailtype' => 'html',
                    'charset' => 'iso-8859-1',
                    'wordwrap' => TRUE
                );
                $message = '';
                $this->load->library('email', $config);
                $this->email->set_newline("\r\n");
                $this->email->from('shridhar.s@modelcamtechnologies.com');
                $this->email->to($usermailid);
                $this->email->subject('Your Subject');
                $this->email->message($message);
                if ($this->email->send()) {
                    echo 'Email sent.';
                } else {
                    show_error($this->email->print_debugger());
                }
            }
        }
    }

//index

    public function uploadImagelogo($file_element_name) {

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '1000';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($file_element_name)) {
            echo $this->upload->display_errors();
            die();
            return false;
        } else {
            $data = $this->upload->data();

            return $data;
        }
    }

    public function assginee_index() {
        $this->load->model('Companycourses_model');
        $userid = $this->session->userdata('id');
        $usernm = $this->session->userdata('user_name');

        $data['course_id'] = $this->input->post('course_id');
        $course_data = $this->Companycourses_model->get_courses_by_id($this->encryption->decrypt($this->input->post('course_id')));
        $data['course_name'] = $course_data[0]['course_name'];
        $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);
        $data['main_content'] = 'admin_company/coursesassign/course_assignee/list';
        $this->load->view('includes/template', $data);
    }

    public function assginee_list() {
        $course_id = $this->encryption->decrypt($this->input->post('course_id'));

        $usernm = $this->session->userdata('user_name');
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
        $count = $this->companycoursesassign_model->get_course_assignee($userid, $sidx, $sord, 0, $limit, $search_string_array, $is_count = true, $course_id);

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

        $query = $this->companycoursesassign_model->get_course_assignee($userid, $sidx, $sord, $start, $limit, $search_string_array, $is_count = false, $course_id);
        $response = new stdClass();
        $response->page = $page;

        $response->total = $totalpages;
        $response->records = $count;
        $response->start = $start + 1;
        $response->course = $this->input->post('course_id');
        $i = 0;

        foreach ($query->result() as $row) {

            $response->rows[$i] = array('id' => $this->encryption->encrypt($row->user_id), 'email_id' => $row->Email, 'full_name' => $row->Full_Name, 'is_active' => $row->is_active);
            $i++;
        }
        echo json_encode($response);
    }

    public function update_assignee_active_status() {

        $course_id = $this->encryption->decrypt($this->input->post('course_id'));
        $user_id = $this->encryption->decrypt($this->input->post('user_id'));
        $query = $this->companycoursesassign_model->change_assignee_active_status($user_id, $course_id);
        if ($query != NULL) {
            echo '1';
        } else {
            $error = & load_class('Exceptions', 'core');
            echo $error->show_error('Patient', 'Unable to add please contact Administartor.');
            exit;
        }
    }

    function check_value_by_usertype($user_group_detail_array, $key) {

        foreach ($user_group_detail_array as $item) {
            //if (is_array($item) && find_key_value($item, $key, '7')) return true;

            if (isset($item[$key]) && $item[$key] == '7')
                return TRUE;
        }

        return FALSE;
    }

    public function upload_assignee($file_path, $file_element_name) {

        $config['upload_path'] = $file_path;
        $config['allowed_types'] = 'csv';

        $this->load->library('upload');
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($file_element_name)) {
            return $this->upload->display_errors();
        } else {
            $data = $this->upload->data();
            return $data;
        }
    }

  

    public function file_check() {

        $allowed_mime_type_arr = array('application/csv', 'application/vnd.ms-excel');
        $mime = get_mime_by_extension($_FILES['userfile']['name']);

        if (isset($_FILES['userfile']['name']) && $_FILES['userfile']['name'] != "") {
            if (in_array($mime, $allowed_mime_type_arr)) {
                $file = fopen($_FILES['userfile']['tmp_name'], "r");
                $uploaded_file_column_array = fgetcsv($file);
                $sample_file_column_array = array('email');

                print_r($uploaded_file_column_array);
                $differed_array = array_diff($sample_file_column_array, $uploaded_file_column_array);
                if (empty($differed_array)) {
                    return true;
                } else {
                    $this->form_validation->set_message('file_check', 'Uploaded file is not same as that sample file.Please download sample file to upload users.');
                    return false;
                }
            } else {
                $this->form_validation->set_message('file_check', 'Please select only csv file.');
                return false;
            }
        } else {
            $this->form_validation->set_message('file_check', $_FILES['userfile']['name']);
            return false;
        }
    }

}

?>
