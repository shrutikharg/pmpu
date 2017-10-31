<?php

class Employeeuser extends CI_Controller {

    /**
     * Check if the user is logged in, if he's not, 
     * send him to the login page
     * @return void
     */
    function index() {
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        if ($this->session->userdata('is_logged_in')) {
            redirect('employee_company/products');
        } else {
            $this->load->view('employee_company/login');
        }
    }

    /**
     * encript the password 
     * @return mixed
     */
    function __encrip_password($password) {
        return md5($password);
    }

    /**
     * check the username and the password with the database
     * @return void
     */
    function validate_credentials() {

        //$this->output->enable_profiler(TRUE);

        $this->load->model('employeeuser_model');


        $user_name = $this->input->post('user_name');
        $password = $this->__encrip_password($this->input->post('password'));
        $is_valid = $this->employeeuser_model->validate($user_name, $password);

        if ($is_valid) {

            $userdetails = $this->employeeuser_model->select_by_username($user_name, $password);

            $userid = $userdetails[0]['id'];
            $userroledefine = $this->employeeuser_model->select_authinteciate_user($userid, $user_name);
            $usergroupassign = $userroledefine[0]['group_id'];
            $userappthemedefault = $this->employeeuser_model->select_by_appthemeefault();


            if ($is_valid && ($user_name == 'admin')) {

                $data = array(
                    'empuser_name' => $user_name,
                    'is_logged_in' => true,
                    'firstname' => $userdetails[0]['first_name'],
                    'id' => $userdetails[0]['id'],
                );
                $this->session->set_userdata($data);
                redirect('employee_company/products');
            } elseif ($is_valid && ($usergroupassign == '7')) {
                $userapptheme = $this->employeeuser_model->select_by_apptheme($userdetails[0]['id']);
                //var_dump($userapptheme);
                //exit;
                if (isset($userapptheme[0]['id'])) {
                    $data = array(
                        'empuser_name' => $user_name,
                        'is_logged_in' => true,
                        'firstname' => $userdetails[0]['first_name'],
                        'sessionlastname' => $userdetails[0]['last_name'],
                        'userplan_id' => $userdetails[0]['hosting_planid'],
                        'user_catlimit' => $userdetails[0]['category_limit'],
                        'user_subcatlimit' => $userdetails[0]['subcategory_limit'],
                        'id' => $userdetails[0]['id'],
                        'group_user' => $userroledefine[0]['group_id'],
                        'emp_companyuseradmin' => $userdetails[0]['company_id'],
                        'logocomp' => $userapptheme[0]['theme_logo'],
                        'bgappimg' => $userapptheme[0]['theme_bg_image'],
                        'csstheme' => $userapptheme[0]['theme_color_scheme'],
                        'customcss' => 'Y',
                        'city' => $this->input->post('city'),
                        'region' => $this->input->post('region'),
                        'country' => $this->input->post('country'),
                        'loc' => $this->input->post('loc'),
                        'post' => $this->input->post('post')
                    );
                    $this->session->set_userdata($data);
                } else {
                    $data = array(
                        'empuser_name' => $user_name,
                        'is_logged_in' => true,
                        'firstname' => $userdetails[0]['first_name'],
                        'sessionlastname' => $userdetails[0]['last_name'],
                        //'userplan_id'=>$userdetails[0]['hosting_planid'],
                        //'user_catlimit'=>$userdetails[0]['category_limit'],
                        //'user_subcatlimit'=>$userdetails[0]['subcategory_limit'],
                        'id' => $userdetails[0]['id'],
                        'emp_companyuseradmin' => $userdetails[0]['company_id'],
                        'group_user' => $userroledefine[0]['group_id'],
                        'logocomp' => $userappthemedefault[0]['theme_logo'],
                        'bgappimg' => $userappthemedefault[0]['theme_bg_image'],
                        'csstheme' => $userappthemedefault[0]['theme_color_scheme'],
                        'customcss' => 'N',
                        'city' => $this->input->post('city'),
                        'region' => $this->input->post('region'),
                        'country' => $this->input->post('country'),
                        'loc' => $this->input->post('loc'),
                        'post' => $this->input->post('post')
                    );
                    $this->session->set_userdata($data);
                }

                redirect('employee_company/courses');
            } else { // incorrect username or password
                $data['message_error'] = TRUE;
                $this->load->view('employee_company/login', $data);
            }
        } else { // incorrect username or password
            $data['message_error'] = TRUE;
            $this->load->view('employee_company/login', $data);
        }
        //exit;
    }

    /**
     * The method just loads the signup view
     * @return void
     */
    function signup() {
        $this->load->view('employee_company/signup_form');
    }

    function empregister() {
        //$this->output->enable_profiler(TRUE);
        $this->load->model('employeeuser_model');
        $this->load->model('category_model');

        $id = $this->uri->segment(3);
        //$data['compname']= $this->employeeuser_model->select_usercompany();
        $data['compname_list'] = $this->category_model->get_companyuser_list();

        $this->load->view('employee_company/register_form', $data);
    }

    /**
     * Create new user and store it in the database
     * @return void
     */
    function create_member() {
        $this->load->library('form_validation');

        // field name, error message, validation rules
        $this->form_validation->set_rules('first_name', 'Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('web_address', 'Web Address', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
        //$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
        $this->form_validation->set_error_delimiters('<div class="alert alert-warning"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('employee_company/create_member');
        } else {
            $this->load->model('employeeuser_model');

            if ($query = $this->employeeuser_model->create_member()) {
                $this->load->view('employee_company/signup_successful');
            } else {
                $this->load->view('employee_company/signup_form');
            }
        }
    }

    /**
     * Update item by his id
     * @return void
     */
    function userprofile() {
        //product id 
        $id = $this->uri->segment(3);
        $this->load->model('employeeuser_model');
        $userid = $this->session->userdata('id');
        $usernm = $this->session->userdata('empuser_name');
        $empcompid = $this->session->userdata('emp_companyuseradmin');
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
            $this->form_validation->set_rules('umobile', 'User Mobile no', 'trim|required|min_length[4]|numeric');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run()) {

                $data_to_store = array(
                    'phone_no' => $this->input->post('umobile'),
                    'modify_date' => date('Y-m-d'),
                    'modify_by' => $this->session->userdata('empuser_name'),
                    'IsActive' => 'Y',
                );
                //if the insert has returned true then we show the flash message
                if ($this->employeeuser_model->update_pwduserprofile($id, $data_to_store) == TRUE) {
                    $this->session->set_flashdata('flash_message', 'updated');
                } else {
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('employee/userprofile/' . $id . '');
            }//validation run
        }
        //product data 

        $data['users'] = $this->employeeuser_model->get_employeeuser_id($id);
        $data['footerdata'] = $this->employeeuser_model->list_footercmspage($empcompid);
        //load the view
        $data['main_content'] = 'employee_company/profile/edit';
        $this->load->view('includes/template', $data);
    }

//update

    /**
     * Update item by his id
     * @return void
     */
    function pwdchange() {
        //product id 
        $id = $this->uri->segment(3);
        $this->load->model('employeeuser_model');
        $empcompid = $this->session->userdata('emp_companyuseradmin');
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
                    'modify_by' => $this->session->userdata('empuser_name'),
                    'IsActive' => 'Y',
                );
                //if the insert has returned true then we show the flash message
                if ($this->employeeuser_model->update_pwduserprofile($id, $data_to_store) == TRUE) {
                    $this->session->set_flashdata('flash_message', 'updated');
                    $this->session->sess_destroy();
                    redirect('admin_company');
                } else {
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }

                redirect('employee/userprofile/' . $id . '');
            }//validation run
        }

        $data['users'] = $this->employeeuser_model->get_employeeuser_id($id);
        $data['footerdata'] = $this->employeeuser_model->list_footercmspage($empcompid);
        //load the view
        $data['main_content'] = 'employee_company/profile/edit';
        $this->load->view('includes/template', $data);
    }

//update

    /**
     * Destroy the session, and logout the user.
     * @return void
     */
    function logout() {
        $this->session->sess_destroy();
        redirect('employee/login');
    }

}
