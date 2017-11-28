<?php

class Companyuser extends CI_Controller {

    /**
     * Check if the user is logged in, if he's not, 
     * send him to the login page
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('Companyuser_model');
       
    }

    function index() {
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->view('admin_company/login');
    }
   

    /**
     * check the username and the password with the database
     * @return void
     */
    function validate_credentials() {
        $user_name = trim($this->input->post('user_name'));
        $password = trim($this->input->post('password'));

        $user_details = $this->Companyuser_model->validate($user_name, $password);

        $response = new stdClass();
        if (!(empty($user_details)) && ($this->encrypt->decrypt_password($user_details[0]['password']) == $password)) {

            // $user_plan_details = $this->Companyuser_model->get_user_plan_details($user_name);
            if ($user_details[0]['user_status'] == 'Success') {

                $userapptheme = $this->Companyuser_model->select_by_apptheme($user_details[0]['user_id']);
                $data = array('user_name' => $user_name,
                    'is_logged_in' => TRUE,
                    'id' => $user_details[0]['user_id'],
                    'userplan_id' => $user_details[0]['user_plan_id'],
                    'company_id' => $user_details[0]['company_id'],
                    'group_user' => 6,
                    'logocomp' => $userapptheme[0]['theme_logo'],
                    'bgappimg' => $userapptheme[0]['theme_bg_image'],
                    'csstheme' => $userapptheme[0]['theme_color_scheme'],
                    'customcss' => 'Y');
                $this->session->set_userdata($data);
            }
            $response->status = $user_details[0]['user_status'];
        } elseif (!(empty($user_details)) && ($this->encrypt->decrypt_password($user_details[0]['password']) !== $password)) {
            $response->status = "Please enter correct password";
        } else {
            $response->status = "Fail";
        }
        echo json_encode($response);
    }

    /**
     * The method just loads the signup view
     * @return void
     */
    function signup() {
        $this->load->model('companyplantable_model');
        $data['hostingdetails'] = $this->companyplantable_model->plantabledetails();
        /*$this->load->view('admin_company/signup_form');*/	
        $this->load->view('admin_company/signup_form', $data);
    }

    function register() {
        $id = $this->input->post('plan_id');
        $data['selected_plan_id'] = $id;
        $this->load->view('admin_company/register_form', $data);
    }

    function create_member() {
        $response = new stdClass();
        if ($this->form_validation->run() == FALSE) {
            $response->status = "Validation_Error";
            $response->message = validation_errors();
            echo json_encode($response);
        } else {
            $this->load->model('hostplanes_model');
            $this->load->model('user_hostingplan_model');


            $email_id = $this->input->post('email_address');
            $company_data = array('email' => $this->input->post('email_address'),
                'domain_name' => $this->input->post('domain_name'),
                'web_address' => $this->input->post('web_address'),
            );
            $trim_company_data_array = trim_array($company_data);
            $manadate_insert_details = $this->mandate_update->get_insert_admin_details();

            $company_id = $this->company_model->insert(array_merge($trim_company_data_array, $manadate_insert_details));
            $this->domain->create_subdomain($trim_company_data_array['domain_name']);
            $user_data = array(
                'email' => $email_id,
                'password' => $this->encrypt->encrypt_password(($this->input->post('password'))),
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'company_id' => $company_id
            );
            $trim_user_data_array = trim_array($user_data);
            $manadate_insert_details = $this->mandate_update->get_insert_admin_details();
            if ($user_id = $this->Companyuser_model->create_member(array_merge($trim_user_data_array, $manadate_insert_details))) {

                $user_group_details = array('user_id' => $user_id,
                    'group_id' => '6',
                    'company_id' => $company_id);
                $manadate_insert_details = $this->mandate_update->get_insert_admin_details();
                $this->Companyuser_model->insert_user_group_type(array_merge($user_group_details, $manadate_insert_details));
                $hosting_plan_details = $this->hostplanes_model->get_hostingplanes_by_id($this->input->post('plan_id'));
                $user_hostingplan_details_data = array('company_id' => $company_id,
                    'hosting_plan_id' => $this->input->post('plan_id'),
                    'available_disk_space' => $hosting_plan_details[0]['available_space_kb'],
                    'expire_date' => date('Y-m-d', strtotime('+' . $hosting_plan_details[0]['validity'] . 'days')),
                );
                $manadate_insert_details = $this->mandate_update->get_insert_admin_details();
                $this->user_hostingplan_model->store_userplan_details(array_merge($user_hostingplan_details_data, $manadate_insert_details));

                $user_login_link = $this->domain->create_subdomain($this->input->post('domain_name'));


                $admin_registeration_msg_details = create_admin_format($email_id, $this->input->post('password'), $user_login_link);

                $this->email->from($admin_registeration_msg_details->from, $admin_registeration_msg_details->from_alias);
                $this->email->to($email_id);
                //$this->email->cc("testcc@domainname.com");
                $this->email->subject($admin_registeration_msg_details->subject);
                $this->email->message($admin_registeration_msg_details->message);
                if ($this->email->send()) {
                    
                } else {
                    
                }
                /* $userdata_to_update = array('id' => $user_id,
                  'activation_code' => $user_activation_msg->activation_code);
                  $this->Companyuser_model->update_user($userdata_to_update); */
                $response->status = 'Success';
                $response->id = $this->encryption->encrypt($user_id);
                echo json_encode($response);
            } else {
                redirect('admin_company/signup');
            }
        }
    }

    function logout() {
        $this->session->sess_destroy();
        redirect('admin_company/login');
    }

    function apply_payment_index() {
        $id = $this->encryption->decrypt($this->input->post('id'));
        $data['id'] = $id;
        $this->load->view('admin_company/paymentmethod', $data);
    }

    function payment_subscribe() {
        
    }

    function username_check($email_id) {
        $emailid_available_count = $this->Companyuser_model->check_email_availability($email_id);
        if ($emailid_available_count > 0) {
            $this->form_validation->set_message('username_check', 'Email Id is already available');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function request_password_reset() {
        $response = new stdClass();
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->view('admin_company/forgotpassword');
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email_id = $this->input->post('email_id');
            $emailid_available_count = $this->Companyuser_model->check_email_availability($email_id);
            if ($emailid_available_count == 0) {
                $response->status = 'User Fail';
            } elseif ($emailid_available_count == 1) {
                $forgot_msg_details = create_forgot_password_format($email_id);

                $this->email->from($forgot_msg_details->from, $forgot_msg_details->from_alias);
                $this->email->to($email_id);
                //$this->email->cc("testcc@domainname.com");
                $this->email->subject($forgot_msg_details->subject);
                $this->email->message($forgot_msg_details->message);
                if ($this->email->send()) {
                    $response->status = 'Success';
                    $reset_password_array = array('email' => $email_id, 'reset_password_code' => $forgot_msg_details->reset_password_code);
                    $this->companyuser_model->update_user_by_email($reset_password_array);
                } else {
                    $response->status = 'Mail Error';
                }
            } else {
                $response->status = 'System Error';
            }
            echo json_encode($response);
        }
    }

    function get_hash() {
        $SALT = "K3wVyS3K";
        $posted = array();
        if (!empty($_POST)) {

            foreach ($_POST as $key => $value) {
                $posted[$key] = $value;
            }
        }
        $posted['txnid'] = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        $hash = '';
// Hash Sequence
        $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
        $hashVarsSeq = explode('|', $hashSequence);
        $hash_string = '';
        foreach ($hashVarsSeq as $hash_var) {
            $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
            $hash_string .= '|';
        }

        $hash_string .= $SALT;
       
        $hash = (hash('sha512', $hash_string));
        $response = new stdClass();
        $response->hash = $hash;
        $response->transaction_id = $posted['txnid'];
        //echo json_encode($response);
    }

    function verify_reset_password_code() {
        $response = new stdClass();
        $email_id = $this->input->post('email_id');
        $reset_password_code = $this->input->post('code');
        $email_availability_count = $this->Companyuser_model->check_email_availability($email_id);
        if ($email_availability_count == 1) {
            $verify_code_count = $this->Companyuser_model->verify_reset_password_code($reset_password_code, $email_id);
            if ($verify_code_count == 1) {
                $response->status = 'Success';
            } else {
                $response->status = 'Fail';
            }
        } else {
            $response->status = 'System_error';
        }
        echo json_encode($response);
    }

    function change_password() {
        $response = new stdClass();
        $email_id = $this->input->post('email_id');
        $password = $this->input->post('password');
        $retype_password = $this->input->post('retype_password');
        if ($password == $retype_password) {
            $query = $this->Companyuser_model->change_password($this->encrypt->encrypt_password($password), $email_id);
            if ($query !== NULL) {
                $reset_password_array = array('email' => $email_id, 'reset_password_code' => NULL);
                $this->companyuser_model->update_user_by_email($reset_password_array);
                $response->status = 'Success';
            } else {
                $response->status = 'Fail';
            }
        } else {
            $response->status = 'Both passwords are not same';
        }
        echo json_encode($response);
    }

    public function verify_user() {
      
        $activation_code = $this->input->get('active_link', true);
      
        $query = $this->Companyuser_model->verify_user($_GET['user'], $_GET['active_link']);
    }

    public function email_check_exist($email) {
        $email_count = $this->companyuser_model->check_email_availability($email);
        if ($email_count !== 0) {
            $this->form_validation->set_message('email_check_exist', 'Email is already exist');
            return false;
        }
        return TRUE;
    }

    public function check_domain_exist($domain) {
        $domain_result = $this->domain->check_domain_availability($domain.'.coolacharya.com');
       
       
        if (!empty($domain_result)) {
                      
            $this->form_validation->set_message('check_domain_exist', 'Doamin is alaready exist,please enter another Domain');
            return false;
        }
        
       
        
         
        return true;
    }
	

}
