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


            $response->rows[$i] = array('id' => $this->encryption->encrypt($row->id), 'email' => $row->email, 'first_name' => $row->first_name, 'last_name' => $row->last_name, 'phone_no' => $row->phone_no);
            $i++;
        }
        echo json_encode($response);
    }

//index
//update
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

    function employee_details() {
        $employee_id = $this->encryption->decrypt($this->input->post('employee_id'));
        $data['emp_details'] = $this->companyuserassign_model->employee_subscription_details($employee_id);
        $data['employee_id'] = $this->input->post('employee_id');
        $data['main_content'] = 'admin_company/userassign/edit';
        $this->load->view('includes/template', $data);
    }

    public function update() {
        $employee_id = $this->encryption->decrypt($this->input->post('id'));
        $data = array('id' => $employee_id, 'is_active' => $this->input->post('is_active'));
        $query = $this->companyuserassign_model->update($data);
        if ($query != null) {
            $this->session->set_flashdata('flash_message', 'Employee Updated Successfully');
            redirect('admin_company/employeelist');
        }
    }

//update
}
