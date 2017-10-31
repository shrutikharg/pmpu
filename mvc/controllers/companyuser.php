<?php

class Companyuser extends CI_Controller {

    /**
     * Check if the user is logged in, if he's not, 
     * send him to the login page
     * @return void
     */
    function index() {
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        if ($this->session->userdata('is_logged_in')) {
            redirect('admin_company');
        } else {
            $this->load->view('admin_company/login');
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

        $this->load->model('Companyuser_model');

        $user_name = $this->input->post('user_name');
        $password = $this->__encrip_password($this->input->post('password'));

        $is_valid = $this->Companyuser_model->validate($user_name, $password);
        $userdetails = $this->Companyuser_model->select_by_username($user_name, $password);

        $company_id = $userdetails[0]['company_id'];
        $user_plan_details = $this->Companyuser_model->select_user_plan_details($company_id);
        // var_dump($user_plan_details);
        if (isset($userdetails[0]['id']) > 0) {


            $usergroupassign = $userdetails[0]['group_type'];
            $userappthemedefault = $this->Companyuser_model->select_by_appthemeefault();


            if ($is_valid && ($user_name == 'admin')) {

                $data = array(
                    'user_name' => $user_name,
                    'is_logged_in' => true,
                    'firstname' => $userdetails[0]['first_name'],
                    'id' => $userdetails[0]['id'],
                );
                $this->session->set_userdata($data);
                redirect('admin_company/category');
            }

            if ($is_valid && ($usergroupassign == '6')) {
                $userapptheme = $this->Companyuser_model->select_by_apptheme($userdetails[0]['id']);


                $todays_timestamp = date('Y-m-d');
                $validity = $user_plan_details[0]['expire_date'];
                //$activated=$userdetails[0]['activated'];
                $hostplanid = $user_plan_details[0]['hosting_plan_id'];


                if (strtotime($validity) < strtotime($todays_timestamp)) {
                    //echo 'disp';
                    $data['errorlink'] = 'Error_expire';
                    $this->load->view('admin_company/login', $data);
                    //exit;
                } else {
                    if (isset($userapptheme[0]['id'])) {
                        $data = array(
                            'user_name' => $user_name,
                            'is_logged_in' => true,
                            'firstname' => $userdetails[0]['first_name'],
                            'id' => $userdetails[0]['id'],
                            'userplan_id' => $user_plan_details[0]['hosting_plan_id'],
                            'company_id' => $company_id,
                            'group_user' => $usergroupassign,
                            'logocomp' => $userapptheme[0]['theme_logo'],
                            'bgappimg' => $userapptheme[0]['theme_bg_image'],
                            'csstheme' => $userapptheme[0]['theme_color_scheme'],
                            'customcss' => 'Y'
                        );
                        $this->session->set_userdata($data);
                    } else {
                        $data = array(
                            'user_name' => $user_name,
                            'is_logged_in' => true,
                            'firstname' => $userdetails[0]['first_name'],
                            'id' => $userdetails[0]['id'],
                            'userplan_id' => $user_plan_details[0]['hosting_plan_id'],
                            'company_id' => $company_id,
                            'group_user' => $usergroupassign,
                            'logocomp' => $userappthemedefault[0]['theme_logo'],
                            'bgappimg' => $userappthemedefault[0]['theme_bg_image'],
                            'csstheme' => $userappthemedefault[0]['theme_color_scheme'],
                            'customcss' => 'N'
                        );
                        $this->session->set_userdata($data);
                    }
                    redirect('admin_company/brandings/startpageapp');
                }
            } else {
                $data['message_error'] = TRUE;
                $this->load->view('admin_company/login', $data);
            }
        }

        //exit;
    }

    /**
     * The method just loads the signup view
     * @return void
     */
    function signup() {
        $this->load->model('companyplantable_model');
        $data['hostingdetails'] = $this->companyplantable_model->plantabledetails();
        //$this->load->view('admin_company/signup_form');	
        $this->load->view('admin_company/signup_form', $data);
    }

    function register() {
        $id = $this->uri->segment(3);
        $this->load->model('Companyuser_model');
        //$data['hostingdetails']=$this->companyplantable_model->plantabledetails();
        $data['hostingplanselect'] = $id;
        $this->load->view('admin_company/register_form', $data);
    }

    function create_member() {
        $this->load->library('form_validation');

        // field name, error message, validation rules
        $this->form_validation->set_rules('first_name', 'Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('web_address', 'Web Address', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
        //$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
        //$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

        if ($this->form_validation->run() == FALSE) {

            $this->load->model('companyplantable_model');
            $this->load->model('Companyuser_model');
            $planid = $this->input->post('planid');
            $data['hostingdetails'] = $this->companyplantable_model->plantabledetails();
            $data['hostingplanselect'] = $planid;
            $this->load->view('admin_company/register_form', $data);
        } else {
            $this->load->model('companyplantable_model');
            $this->load->model('Companyuser_model');
            $planid = $this->input->post('planid');
            $data['hostingdetails'] = $this->companyplantable_model->plantabledetails();
            $data['hostingplanselect'] = $planid;
            if ($query = $this->Companyuser_model->create_member()) {



                $id = $this->input->post('planid');
                $this->load->model('Companyuser_model');
                echo 'success';
            } else {
                redirect('admin_company/signup');
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
        $this->load->model('Companyuser_model');
        $this->load->model('companycmspage_model');
        $userid = $this->session->userdata('id');
        $usernm = $this->session->userdata('user_name');
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
                    'modify_by' => $this->session->userdata('user_name'),
                    'IsActive' => 'Y',
                );
                //if the insert has returned true then we show the flash message
                if ($this->Companyuser_model->update_pwduseradminnew($id, $data_to_store) == TRUE) {
                    $this->session->set_flashdata('flash_message', 'updated');
                } else {
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin_company/userprofile/' . $id . '');
            }//validation run
        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
        //product data 
        //$data['users'] =$this->Companyuser_model->select_authinteciate_user($userid,$user_name);
        $data['users'] = $this->Companyuser_model->get_userdetails_by_id($id);
        $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);
        //load the view
        $data['main_content'] = 'admin_company/profile/edit';
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
                if ($this->Companyuser_model->update_pwduseradminnew($id, $data_to_store) == TRUE) {
                    $this->session->set_flashdata('flash_message', 'updated');
                    $this->session->sess_destroy();
                    redirect('admin_company');
                } else {
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }

                redirect('admin_company/userprofile/' . $id . '');
            }//validation run
        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
        //product data 
        //$data['users'] =$this->Companyuser_model->select_authinteciate_user($userid,$user_name);
        $data['users'] = $this->Companyuser_model->get_userdetails_by_id($id);
        //load the view
        $data['main_content'] = 'admin_company/profile/edit';
        $this->load->view('includes/template', $data);
    }

//update

    function supportmail() {
        //product id        
        $this->load->model('Companyuser_model');
        $this->load->model('companycmspage_model');
        $userid = $this->session->userdata('id');
        $usernm = $this->session->userdata('user_name');
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            $this->form_validation->set_rules('subname', 'Subject Name', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('description', 'Description details', 'trim|required|min_length[4]');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            if ($this->form_validation->run()) {
                $message = 'Hello,';
                $message .="<br/>";
                $message .=$this->session->userdata('description');
                $message .="<br/><br/>";
                $message .='Thank You.';

                $emlto = 'shridhar.s@modelcamtechnologies.com';

                $subject = $this->input->post('subname');

                $headers = 'MIME-Version: 1.0' . "\r\n";

                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                $headers .= 'From: coolacharya.com <info@coolacharya.com>' . "\r\n";

                $flag = mail($emlto, $subject, $message, $headers);

                //if the insert has returned true then we show the flash message
                if ($flag == TRUE) {
                    $this->session->set_flashdata('flash_message', 'send');
                } else {
                    $this->session->set_flashdata('flash_message', 'not_send');
                }
                redirect('admin_company/supportmail');
            }//validation run
        }
        $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);
        $data['main_content'] = 'admin_company/profile/supportmail';
        $this->load->view('includes/template', $data);
    }

//update

    /**
     * Destroy the session, and logout the user.
     * @return void
     */
    function logout() {
        $this->session->sess_destroy();
        redirect('admin_company');
    }

    function payment_subscribe() {
        
    }

}
