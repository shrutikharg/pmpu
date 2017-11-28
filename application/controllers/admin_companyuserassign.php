<?php

class admin_companyuserassign extends CI_Controller {

    /**
     * name of the folder responsible for the views 
     * which are manipulated by this controller
     * @constant string
     */
    const VIEW_FOLDER = 'admin_company/userassign';

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
            $this->load->model('companyuserassign_model');
        }
    }

    function index() {

        $userid = $this->session->userdata('id');
        $usernm = $this->session->userdata('user_name');
        $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);
        $data['main_content'] = 'admin_company/userassign/emplist';
        $this->load->view('includes/template', $data);
    }

    /**
     * Load the main view with all the current model model's data.
     * @return void
     */
    public function employee_list() {
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
        $count = $this->companyuserassign_model->get_userassign($sidx, $sord, 0, $limit, $search_string_array, $is_count = true);

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

        $query = $this->companyuserassign_model->get_userassign($sidx, $sord, $start, $limit, $search_string_array, $is_count = false);

        $response = new stdClass();
        $response->page = $page;

        $response->total = $totalpages;
        $response->records = $count;
        $response->start = $start + 1;
        $response->end = $start + $limit;


        $i = 0;


        foreach ($query->result() as $row) {


            $response->rows[$i] = array('id' => $this->encryption->encrypt($row->id), 'email' => $row->email, 'first_name' => $row->first_name, 'last_name' => $row->last_name, 'phone_no' => $row->phone_no);
            $i++;
        }
        echo json_encode($response);
    }

//index
//update
//update

    public function add_user() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            if ($this->form_validation->run()) {

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

                                $email = trim($row['email']);
                                $result = trim_array($this->companyuserassign_model->get_userdetailspresent($email));

                                if (!empty($result)) {

                                    $user_id = "";


                                    $is_available = $this->check_value_by_usertype($result, 'group_id');

                                    if ($is_available == FALSE) {

                                        $user_data_to_update = array(
                                            'user_id' => $result[0]['id'],
                                            'group_id' => '7');
                                        $this->companyuserassign_model->insert_usergroupcsv($user_data_to_update);
                                    }
                                    $user_id = $result[0]['id'];
                                } else {

                                    $password_array = $this->encrypt->create_password();
                                    print_r($password_array);
                                    $insert_data = array(
                                        'email' => $email,
                                        'password' => $password_array['encrypted_password'],
                                        'company_id' => $this->session->userdata('company_id')
                                    );
                                    $trim_insert_array = trim_array($insert_data);
                                    $manadate_insert_details = $this->mandate_update->get_insert_details();
                                    $user_id = $this->companyuserassign_model->insert_csv(array_merge($trim_insert_array, $manadate_insert_details));
                                    $user_data_to_update = array(
                                        'user_id' => $user_id,
                                        'group_id' => '7');
                                    $this->companyuserassign_model->insert_usergroupcsv(array_merge($user_data_to_update, $manadate_insert_details));
                                    if (!empty($user_id)) {
                                        $company_details = $this->company_model->get_company_details();

                                        $subscription_link = 'http://' . $this->company_details->domain_name . '.coolacharya.com';
                                        $user_creation_mail_details = create_csv_user_format($email, $password_array['original_password'], $subscription_link, $company_details);
                                        $message = $user_creation_mail_details->message;

                                        $this->email->from('info@coolacharya.com', $user_creation_mail_details->from_alias);
                                        $this->email->to($email);
                                        $this->email->subject($user_creation_mail_details->subject);
                                        $this->email->message($user_creation_mail_details->message);
                                        $this->email->set_mailtype("html");
                                        if ($this->email->send()) {
                                            echo' mail sent ';
                                        } else {
                                            
                                        }
                                    } else {
                                        echo 'User has not registered';
                                    }
                                }

                                $subscription_data = array(
                                    'user_id' => $user_id,
                                    'payment_through' => 'Free',
                                    'product_name' => $company_details->product_name
                                );
                                $manadate_insert_details = $this->mandate_update->get_insert_details();
                                $query = $this->companyuserassign_model->insert_subscription(array_merge($subscription_data, $manadate_insert_details));
                            }
                        } else {
                            echo "Unable to  UPLOADED Read file";
                        }
                    } else {
                        echo "Unable to upload file";
                    }
                }
            } else {
                echo validation_errors();

                $data['message'] = validation_errors();
            }
        }
        $data['footerdata'] = $this->companycmspage_model->list_cmspage();

        $data['main_content'] = 'admin_company/userassign/add_user';
        $this->load->view('includes/template', $data);
    }

    function employee_details() {
        $user_id = $this->encryption->decrypt($this->input->post('employee_id'));
        $data['emp_details'] = $this->companyuserassign_model->employee_subscription_details($user_id);
        $data['employee_id'] = $this->input->post('employee_id');
        $data['main_content'] = 'admin_company/userassign/edit';
        $this->load->view('includes/template', $data);
    }

    public function update() {
        $user_id = $this->encryption->decrypt($this->input->post('id'));
        $data = array('id' => $user_id, 'is_active' => $this->input->post('is_active'));
        $query = $this->companyuserassign_model->update($data);
        if ($query != null) {
            $this->session->set_flashdata('flash_message', 'Employee Updated Successfully');
            redirect('admin_company/employeelist');
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

    function check_value_by_usertype($user_group_detail_array, $key) {

        foreach ($user_group_detail_array as $item) {
            //if (is_array($item) && find_key_value($item, $key, '7')) return true;

            if (isset($item[$key]) && $item[$key] == '7')
                return TRUE;
        }

        return FALSE;
    }

    function download_sample_file() {
        $file = "./uploads/sample/sample_user.csv";

        header('Content-Type: text/x-comma-separated-values');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Cache-Control: private', false); // required for certain browser
        header('Content-Disposition: attachment; filename="' . $file . '"');
        ob_clean();
        readfile($file);
    }

//update
}
