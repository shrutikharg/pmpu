<?php

class Employeeuser extends CI_Controller {

    /**
     * Check if the user is logged in, if he's not, 
     * send him to the login page
     * @return void
     */
    public $company_details;

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('employeeuser_model');
        $this->company_details = $this->domain->get_company_byDomain();
    }

    function index() {

        $data['footerdata'] = $this->domain->get_company_cms_bydomain();
        $this->load->view('employee_company/login', $data);
    }

    function home() {
        $data['course_list'] = $this->employeeuser_model->get_course_list($this->company_details->id);
        $data['footerdata'] = $this->domain->get_company_cms_bydomain();
        $data['company_details'] = $this->company_details;

        // die();
        $this->load->view('employee_company/home', $data);
    }

    /**
     * check the username and the password with the database
     * @return void
     */
    function validate_credentials() {

        //$this->output->enable_profiler(TRUE);

        $this->load->model('employeeuser_model');


        $user_name = $this->input->post('user_name');
        $password = $this->input->post('password');
        $user_details = $this->employeeuser_model->validate($user_name, $password);

        $response = new stdClass();
        if (!(empty($user_details)) && ($this->encrypt->decrypt_password($user_details->password) == $password)) {
            if ($user_details->subscription_id !== NULL) {
                $userdetails = $this->employeeuser_model->select_by_username($user_name, $password);
                $userid = $userdetails[0]['id'];




                $userapptheme = $this->employeeuser_model->select_by_apptheme($userdetails[0]['id']);


                $data = array(
                    'empuser_name' => $user_name,
                    'is_logged_in' => true,
                    'company_id' => $userdetails[0]['company_id'],
                    'firstname' => $userdetails[0]['first_name'],
                    'lastname' => $userdetails[0]['last_name'],
                    'id' => $userdetails[0]['id'],
                    'group_user' => 7,
                    'emp_companyuseradmin' => $userdetails[0]['company_id'],
                    'logocomp' => $userapptheme[0]['theme_logo'],
                    'bgappimg' => $userapptheme[0]['theme_bg_image'],
                    'csstheme' => $userapptheme[0]['theme_color_scheme'],
                );
                $this->session->set_userdata($data);
                $response->status = "Success";
            } else {
                $registeration_data = array(
                    'reg_first_name' => $user_details->first_name,
                    'reg_last_name' => $user_details->last_name,
                    'reg_email' => $user_details->email,
                    'reg_phone' => $user_details->phone,
                    'reg_id' => $this->encryption->encrypt($user_details->id),
                    'reg_message' => 'You have not subscribed Yet. Please subscribe to this course through our payment gateway to get full access.',
                    'reg_company_id' => $this->encryption->encrypt($user_details->company_id)
                );
                $this->session->set_userdata('registeration_data', $registeration_data);
                $response->status = "Not Subscribed";
            } {
                
            }
        } elseif (!(empty($user_details)) && ($this->encrypt->decrypt_password($user_details->password) !== $password)) {
            $response->status = "Please enter correct password";
        } else { // incorrect username or password
            $response->status = "Fail";
        }
        echo json_encode($response);
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

        $this->load->model('category_model');

        //$data['compname']= $this->employeeuser_model->select_usercompany();
        //   $data['compname_list'] = $this->category_model->get_companyuser_list();

        $this->load->view('employee_company/register_form');
    }

    /**
     * Create new user and store it in the database
     * @return void
     */
    function create_member() {


        if ($this->form_validation->run() == FALSE) {

            $this->load->view('employee_company/register_form');
        } else {

            $company_id = $this->company_details->id;
            $email = $this->input->post('email');
            $user_details = $this->employeeuser_model->get_employee_by_email($email);
            $company_details=$this->config->item('company_details');
           
            if (!empty($user_details)) {

                $registeration_data = array(
                    'reg_first_name' => $user_details->first_name,
                    'reg_last_name' => $user_details->last_name,
                    'reg_email' => $user_details->email,
                    'reg_phone' => $user_details->phone,
                    'reg_id' => $this->encryption->encrypt($user_details->id),
                    'reg_message' => 'User is already registered,left with  subscription',
                    'reg_company_id' => $this->encryption->encrypt($company_id),
                     'reg_price' =>$company_details->price ,
                    
                );
                $this->session->set_userdata('registeration_data', $registeration_data);
                redirect('employee/payment_subscribe');
            } else {
                $first_name = $this->input->post('first_name');
                $last_name = $this->input->post('last_name');
                $email = $this->input->post('email');
                $new_member_insert_data = array(
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email' => $email,
                    'password' => $this->encrypt->encrypt_password($this->input->post('password')),
                    'phone_no' => $this->input->post('phone'),
                    'company_id' => $company_id
                );

                if ($insert_id = $this->employeeuser_model->create_member($new_member_insert_data)) {
                    $user_type_data = array('user_id' => $insert_id,
                        'group_id' => '7',
                        'created_at' => date('Y-m-d'));
                    $subscription_link = 'http://' . $this->company_details->domain_name . '.coolacharya.com';
                    $subscriber_registeration_format_details = create_user_format($email, ($first_name . ' ' . $last_name), $subscription_link, $this->company_details->domain_name);
                    $this->employeeuser_model->insert_user_type($user_type_data);
                    $this->email->from('info@coolacharya.com', $subscriber_registeration_format_details->from_alias);
                    $this->email->to($email);
                    $this->email->subject($subscriber_registeration_format_details->subject);
                    $this->email->message($subscriber_registeration_format_details->message);
                    $this->email->set_mailtype("html");
                    if ($this->email->send()) {
                        echo' mail sent ';
                    } else {
                        
                    }

                    $registeration_data = array(
                        'reg_first_name' => $this->input->post('first_name'),
                        'reg_last_name' => $this->input->post('last_name'),
                        'reg_email' => $this->input->post('email'),
                        'reg_phone' => $this->input->post('phone'),
                        'reg_id' => $this->encryption->encrypt($insert_id),
                        'reg_message' => 'Registered Successfully',
                        'reg_company_id' => $this->encryption->encrypt($company_id),
                            'reg_price' =>$company_details->price 
                    );
                    $this->session->set_userdata('registeration_data', $registeration_data);
                    redirect('employee/payment_subscribe');
                } else {

                    $this->load->view('employee_company/payumoney_subscribe');
                }
            }
        }
    }

    function payment_subscribe() {

        $this->load->view('employee_company/payumoney_subscribe');
    }

    function payment_success() {
        $this->company_details = $this->domain->get_company_byDomain();
        $status = $_POST["status"];
        $firstname = $_POST["firstname"];
        $amount = $_POST["amount"];
        $txnid = $_POST["txnid"];
        $posted_hash = $_POST["hash"];
        $key = $_POST["key"];
        $productinfo = $_POST["productinfo"];
        $email = $_POST["email"];
        $salt = "K3wVyS3K";

        if (isset($_POST["additionalCharges"])) {
            $additionalCharges = $_POST["additionalCharges"];
            $retHashSeq = $additionalCharges . '|' . $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        } else {

            $retHashSeq = $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        }
        $hash = hash("sha512", $retHashSeq);

        $insert_data = array('user_id' => $this->encryption->decrypt($this->input->post('udf1')),
            'txn_id' => $this->input->post('txnid'),
            'company_id' => $this->encryption->decrypt($this->input->post('udf2')),
            'payment_through' => 'Payu',
            'created_at' => date('Y-m-d H:m:s'),
            'posted_hash' => $posted_hash,
            'hash' => $hash
        );
        $user_detail = $this->employeeuser_model->get_employee_by_email($email);
        $password = $this->encrypt->decrypt_password($user_detail->password);
        $this->employeeuser_model->insert_payment_data($insert_data);
        $data['payment_data'] = array('status' => $status,
            'email' => $email,
            'first_name' => $firstname,
            'amount' => $amount,
            'txn_id' => $txnid,
            'amount' => $amount,
            'hash' => $hash,
            'posted_hash' => $posted_hash
        );
        $this->session->unset_userdata($registeration_data);
        $subscription_link = 'http://' . $this->company_details->domain_name . '.coolacharya.com';
        $subscription_format_details = user_subscription_success_mail_format($email, $firstname, $password, $subscription_link, $this->company_details->domain_name);
        //print_r($subscription_format_details);
        $this->email->set_newline("\r\n");
        $this->email->from('info@coolacharya.com', $subscription_format_details->from_alias);
        $this->email->to($email);
        $this->email->subject($subscription_format_details->subject);
        $this->email->message($subscription_format_details->message);
        if ($this->email->send()) {
            
        } else {
            die();
        }
        $this->load->view('employee_company/payumoney_success', $data);
    }

    function payment_failure() {
        $data['failed_trans_data'] = $this->input->post();
        $this->load->view('employee_company/payumoney_failure');
    }

    /**
     * Update item by his id
     * @return void
     */
    function userprofile() {
        //product id 
        //$id = $this->uri->segment(3);
        $this->load->model('employeeuser_model');
        $id = $this->session->userdata('id');
        $usernm = $this->session->userdata('empuser_name');
        $empcompid = $this->session->userdata('emp_companyuseradmin');
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
            $this->form_validation->set_rules('umobile', 'User Mobile no', 'trim|required|min_length[10]|numeric');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run()) {

                $data_to_store = array(
                    'phone_no' => $this->input->post('umobile'),
                    'updated_at' => date('Y-m-d'),
                        // 'modify_by' => $this->session->userdata('empuser_name'),
                );
                //if the insert has returned true then we show the flash message
                if ($this->employeeuser_model->update_pwduserprofile($id, $data_to_store) == TRUE) {
                    $this->session->set_flashdata('flash_message', 'updated');
                } else {
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
            }//validation run
        }
        //product data 

        $data['users'] = $this->employeeuser_model->get_employeeuser_id($id);
        $data['footerdata'] = $this->employeeuser_model->list_footercmspage();
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
        $id = $this->session->userdata('id');

        $empcompid = $this->session->userdata('company_id');
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
            $this->form_validation->set_rules('old_password', 'Old Password', 'required|callback_check_password');
            $this->form_validation->set_rules('new_password', 'Password', 'trim|required|min_length[4]|max_length[16]');
            $this->form_validation->set_rules('new_password_repeat', 'Password Confirmation', 'trim|required|matches[new_password]');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run()) {

                $nepassword = $this->encrypt->encrypt_password($this->input->post('new_password'));
                $data_to_store = array(
                    'password' => $nepassword,
                    'updated_at' => date('Y-m-d'),
                );
                //if the insert has returned true then we show the flash message
                if ($this->employeeuser_model->update_pwduserprofile($id, $data_to_store) == TRUE) {
                    echo 'in updates';
                    $this->session->set_flashdata('flash_message', 'updated');
                    $this->session->sess_destroy();
                    redirect('employee');
                } else {
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
            }//validation run
        }

        $data['users'] = $this->employeeuser_model->get_employeeuser_id($id);
        $data['footerdata'] = $this->employeeuser_model->list_footercmspage();
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

    public function email_check_exist($email) {
        $email_availability = $this->employeeuser_model->check_email_availability(strtolower($email));
        if (!empty($email_availability)) {
            $this->form_validation->set_message('email_check_exist', 'Email is already exist');
            return false;
        }
        return TRUE;
    }

    public function check_password($password) {
        $password_availability_result = $this->employeeuser_model->get_employee_by_email($this->session->userdata('empuser_name'));
        if (empty($password_availability_result)) {
            $this->form_validation->set_message('check_password', 'System Error');
            return false;
        } else {
            if ($password != $this->encrypt->decrypt_password($password_availability_result->password)) {
                $this->form_validation->set_message('check_password', 'Please enter correct old password');
                return false;
            }
        }
        return TRUE;
    }

    function request_password_reset() {
        $response = new stdClass();
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->view('employee_company/forgotpassword');
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email_id = $this->input->post('email_id');
            $emailid_available_result = $this->employeeuser_model->check_email_availability($email_id);

            if (empty($emailid_available_result)) {
                $response->status = 'User Fail';
            } elseif (count($emailid_available_result) == 1) {
                $forgot_msg_details = create_forgot_password_format($email_id);

                $this->email->from($forgot_msg_details->from, $forgot_msg_details->from_alias);
                $this->email->to($email_id);

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

    function verify_reset_password_code() {
        $response = new stdClass();
        $email_id = $this->input->post('email_id');
        $reset_password_code = $this->input->post('code');
        $email_availability_result = $this->employeeuser_model->check_email_availability($email_id);
        if (count($email_availability_result) == 1) {
            $verify_code_count = $this->employeeuser_model->verify_reset_password_code($reset_password_code, $email_id);
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
            $query = $this->employeeuser_model->change_password($this->encrypt->encrypt_password($password), $email_id);
            if ($query !== NULL) {
                $reset_password_array = array('email' => $email_id, 'reset_password_code' => NULL);
                $this->employeeuser_model->update_user_by_email($reset_password_array);
                $response->status = 'Success';
            } else {
                $response->status = 'Fail';
            }
        } else {
            $response->status = 'Both passwords are not same';
        }
        echo json_encode($response);
    }

    function get_coursedetails() {
        $course_id = $this->input->post('course_id');
        $this->load->model('companycourses_model');
        $course_details = $this->companycourses_model->get_course_details($course_id);
        $response = new stdclass();
        $response->details = $course_details;
        echo json_encode($response);
    }

    function apply_couponcode() {
        $this->load->model('companycoupon_model');
        $coupon_code = trim($this->input->post('coupon_code'));
        $company_details = $this->config->item('company_details');  
        $result= $this->companycoupon_model->apply_coupon($coupon_code, $company_details->id);
        $response=new stdClass();
 
        if(!empty($result)){
            $response->status='Success' ;
             $response->original_cost=$company_details->price;
               $response->discount_cost=($company_details->price)*(1-(((float)$result->percentage_off)/100)) ;
           $response->coupon_code=$result->name ;
           $response->percentage_off=$result->percentage_off;
        }
        else{
             $response->status='Fail' ;
             $response->original_cost=$company_details->price;
               $response->discount_cost=$company_details->price ;
           $response->coupon_code='';
           $response->percentage_off=0;
       
        }
        echo json_encode($response);
    }

}
