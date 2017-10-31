<?php

class Admin_companyuserassign extends CI_Controller {

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
        $this->load->model('companyuserassign_model');


        if (!$this->session->userdata('is_logged_in')) {
            redirect('admin_company/login');
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


            $response->rows[$i] = array('id' => $this->encryption->encrypt($row->id), 'email' => $row->email, 'first_name' => $row->first_name, 'last_name' => $row->last_name,'phone_no'=>$row->phone_no);
            $i++;
        }
        echo json_encode($response);
    }

//index

    public function employeelist() {

        //all the posts sent by the view
        $search_string = $this->input->post('search_string');
        $order = $this->input->post('order');
        $order_type = $this->input->post('order_type');
        $userid = $this->session->userdata('id');
        $usernm = $this->session->userdata('user_name');

        //pagination settings
        $config['per_page'] = 15;

        $config['base_url'] = base_url() . 'admin_company/employeelist';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 20;
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';

        //limit end
        $page = $this->uri->segment(3);

        //math to get the initial record to be select in the database
        $limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0) {
            $limit_end = 0;
        }

        //if order type was changed
        if ($order_type) {
            $filter_session_data['order_type'] = $order_type;
        } else {
            //we have something stored in the session? 
            if ($this->session->userdata('order_type')) {
                $order_type = $this->session->userdata('order_type');
            } else {
                //if we have nothing inside session, so it's the default "Asc"
                $order_type = 'Asc';
            }
        }
        //make the data type var avaible to our view
        $data['order_type_selected'] = $order_type;

        if ($search_string !== false && $order !== false || $this->uri->segment(3) == true) {

            if ($search_string) {
                $filter_session_data['search_string_selected'] = $search_string;
            } else {
                $search_string = $this->session->userdata('search_string_selected');
            }
            $data['search_string_selected'] = $search_string;

            if ($order) {
                $filter_session_data['order'] = $order;
            } else {
                $order = $this->session->userdata('order');
            }
            $data['order'] = $order;

            //save session data into the session
            if (isset($filter_session_data)) {
                $this->session->set_userdata($filter_session_data);
            }

            //fetch sql data into arrays
            $data['count_products'] = $this->companyuserassign_model->count_empusers($userid, $search_string, $order);
            $config['total_rows'] = $data['count_products'];

            //fetch sql data into arrays
            if ($search_string) {
                if ($order) {
                    $data['emplist'] = $this->companyuserassign_model->get_empuserdtils($userid, $search_string, $order, $order_type, $config['per_page'], $limit_end);
                } else {
                    $data['emplist'] = $this->companyuserassign_model->get_empuserdtils($userid, $search_string, '', $order_type, $config['per_page'], $limit_end);
                }
            } else {
                if ($order) {
                    $data['emplist'] = $this->companyuserassign_model->get_empuserdtils($userid, '', $order, $order_type, $config['per_page'], $limit_end);
                } else {
                    $data['emplist'] = $this->companyuserassign_model->get_empuserdtils($userid, '', '', $order_type, $config['per_page'], $limit_end);
                }
            }
        } else {

            //clean filter data inside section
            $filter_session_data['courses_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['count_products'] = $this->companyuserassign_model->count_empusers($userid);
            $data['emplist'] = $this->companyuserassign_model->get_empuserdtils($userid, '', '', $order_type, $config['per_page'], $limit_end);
            $config['total_rows'] = $data['count_products'];
        }//!isset($search_string) && !isset($order)
        //initializate the panination helper 
        $this->pagination->initialize($config);
        $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);
        //load the view
        $data['main_content'] = 'admin_company/userassign/emplist';
        $this->load->view('includes/template', $data);
    }

//index

    /**
     * Update item by his id
     * @return void
     */
    function employeeprofiledtil() {
        $this->load->model('companycmspage_model');
        //product id 
        $id = $this->uri->segment(3);
        $userid = $this->session->userdata('id');
        $usernm = $this->session->userdata('user_name');
        $this->load->model('Companyuser_model');
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
            $this->form_validation->set_rules('umobile', 'User Mobile no', 'trim|required|min_length[4]|numeric');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run()) {

                $data_to_store = array(
                    'phone_no' => $this->input->post('umobile'),
                    'modified_at' => date('Y-m-d'),
                    'modify_by' => $this->session->userdata('user_name'),
                    'Is_Active' => 'Y',
                );
                //if the insert has returned true then we show the flash message
                if ($this->Companyuser_model->update_pwduserprofile($id, $data_to_store) == TRUE) {
                    $this->session->set_flashdata('flash_message', 'updated');
                } else {
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin_company/employeeprofile/' . $id . '');
            }//validation run
        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
        //product data 
        $data['users'] = $this->Companyuser_model->get_employeeuser_id($id);
        $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);
        //load the view
        $data['main_content'] = 'admin_company/userassign/employedit';
        $this->load->view('includes/template', $data);
    }

//update

    /**
     * Update item by his id
     * @return void
     */
    function emppwdchange() {
        //product id 
        $id = $this->uri->segment(3);

        $this->load->model('Companyuser_model');
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
            $this->form_validation->set_rules('old_password', 'Old Password', 'required');
            $this->form_validation->set_rules('new_password', 'Password', 'trim|required|min_length[4]|max_length[16]');
            $this->form_validation->set_rules('new_password_repeat', 'Password Confirmation', 'trim|required|matches[new_password]');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run()) {

                $nepassword = $this->__encrip_password($this->input->post('new_password'));
                $data_to_store = array(
                    'password' => $nepassword,
                    'modify_date' => date('Y-m-d'),
                    'modify_by' => $this->session->userdata('user_name'),
                    'IsActive' => 'Y',
                );
                //if the insert has returned true then we show the flash message
                if ($this->Companyuser_model->update_pwduserprofile($id, $data_to_store) == TRUE) {
                    $this->session->set_flashdata('flash_message', 'updated');
                    redirect('admin_company/employeeprofile/' . $id . '');
                } else {
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }

                redirect('admin_company/employeeprofile/' . $id . '');
            }//validation run
        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
        //product data 
        //$data['users'] =$this->Companyuser_model->select_authinteciate_user($userid,$user_name);
        $data['users'] = $this->Companyuser_model->get_employeeuser_id($id);
        //load the view
        $data['main_content'] = 'admin_company/userassign/employedit';
        $this->load->view('includes/template', $data);
    }

//update

    public function add() {
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
            //$this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run()) {
                $data_to_store = array(
                    'name' => $this->input->post('name'),
                    'description' => $this->input->post('description'),
                    'usercat_id' => $this->session->userdata('id'),
                    'created_date' => date('Y-m-d'),
                    'created_by' => $this->session->userdata('user_name'),
                    'IsActive' => 'Y',
                );
                //if the insert has returned true then we show the flash message
                if ($this->companyuserassign_model->store_userassign($data_to_store)) {
                    $data['flash_message'] = TRUE;
                } else {
                    $data['flash_message'] = FALSE;
                }
            }

            $this->load->library('email');
            $this->email->initialize(array(
                'protocol' => 'smtp',
                'smtp_host' => 'smtp.googlemail.com',
                'smtp_user' => 'shridhar.s@modelcamtechnologies.com',
                'smtp_pass' => '2015@modelcam',
                'smtp_port' => 587,
                'crlf' => "\r\n",
                'newline' => "\r\n"
            ));
            $this->email->from('shridhar.s@modelcamtechnologies.com', 'Your Name');
            $this->email->to('shridhar.s@modelcamtechnologies.com');
            $this->email->subject('Email Test');
            $this->email->message('Testing the email class.');
            $this->email->send();
            //echo $this->email->print_debugger();
            echo $this->sendMail();
            //var_dump($msg);
        }
        //load the view
        $data['main_content'] = 'admin_company/userassign/add';
        $this->load->view('includes/template', $data);
    }

    /**
     * Update item by his id
     * @return void
     */
    public function update() {
        //product id 
        $id = $this->uri->segment(4);

        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
            $this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run()) {

                $data_to_store = array(
                    'name' => $this->input->post('name'),
                    'description' => $this->input->post('description'),
                    'modify_date' => date('Y-m-d'),
                    'modify_by' => $this->session->userdata('user_name'),
                    'IsActive' => $this->input->post('status')
                );
                //if the insert has returned true then we show the flash message
                if ($this->companyuserassign_model->update_userassign($id, $data_to_store) == TRUE) {
                    $this->session->set_flashdata('flash_message', 'updated');
                } else {
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin_company/userassign/update/' . $id . '');
            }//validation run
        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
        //product data 
        $data['userassign'] = $this->companyuserassign_model->get_userassign_by_id($id);
        //load the view
        $data['main_content'] = 'admin_company/userassign/edit';
        $this->load->view('includes/template', $data);
    }

//update

    /**
     * Delete product by his id
     * @return void
     */
    public function delete() {
        //product id 
        $id = $this->uri->segment(4);
        $this->companyuserassign_model->delete_userassign($id);
        redirect('admin_company/userassign');
    }

//edit

    function sendMail() {
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
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
        $this->email->to('mail4prtham@gmail.com');
        $this->email->subject('Your Subject');
        $this->email->message($message);
        if ($this->email->send()) {
            echo 'Email sent.';
        } else {
            show_error($this->email->print_debugger());
        }
    }

}
