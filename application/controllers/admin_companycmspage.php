<?php
class Admin_companycmspage extends CI_Controller {

    /**
     * name of the folder responsible for the views 
     * which are manipulated by this controller
     * @constant string
     */
    const VIEW_FOLDER = 'admin_company/cmspage';

    /**
     * Responsable for auto load the model
     * @return void
     */
    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('companycmspage_model');

        if (!$this->session->userdata('is_logged_in')) {
            redirect('admin_company/login');
        }
    }

    /**
     * Load the main view with all the current model model's data.
     * @return void
     */
    public function index() {

        $data['cmspage'] = $this->companycmspage_model->get_cmspage($userid, '', '', $order_type, $config['per_page'], $limit_end);
        $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);
        if (empty($data['cmspage'])) {
             $this->session->set_flashdata('flash_message','You do not have added CMS page yet,Please add it as it reflects at viewer side');
                       redirect('admin_company/cmspage/add');
        }
        //load the view
        $data['main_content'] = 'admin_company/cmspage/edit';
        $this->load->view('includes/template', $data);
    }

//index

    public function add() {
        $userid = $this->session->userdata('id');
        $usernm = $this->session->userdata('user_name');
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
            $this->form_validation->set_rules('emailid', 'emailid', 'trim|required|min_length[5]|xss_clean');
            $this->form_validation->set_rules('contactno', 'contactno', 'trim|required|numeric|xss_clean');
            $this->form_validation->set_rules('cmspagelink1', 'cmspagelink1', 'trim|required|xss_clean');
            $this->form_validation->set_rules('cmspagelink2', 'cmspagelink2', 'trim|xss_clean');
            $this->form_validation->set_rules('cmspagelink3', 'cmspagelink3', 'trim|xss_clean');
            $this->form_validation->set_rules('cmspagelink1_name', 'cmspagelink1_name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('cmspagelink2_name', 'cmspagelink2_name', 'trim|xss_clean');
            $this->form_validation->set_rules('cmspagelink3_name', 'cmspagelink3_name', 'trim|xss_clean');


            $this->form_validation->set_rules('fblink', 'fblink', 'trim|xss_clean');
            $this->form_validation->set_rules('googlepluslink', 'googlepluslink', 'trim|xss_clean');
            $this->form_validation->set_rules('twitterlink', 'twitterlink', 'trim|xss_clean');
            $this->form_validation->set_rules('linkedinlink', 'linkedinlink', 'trim|xss_clean');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');


            //if the form has passed through the validation
            if ($this->form_validation->run()) {
                $data_to_store = array(
                    'emailid' => $this->input->post('emailid'),
                    'contactno' => $this->input->post('contactno'),
                    'cmspagelink1' => $this->input->post('cmspagelink1'),
                    'cmspagelink2' => $this->input->post('cmspagelink2'),
                    'cmspagelink3' => $this->input->post('cmspagelink3'),
                    'cmspagelink1_name' => $this->input->post('cmspagelink1_name'),
                    'cmspagelink2_name' => $this->input->post('cmspagelink2_name'),
                    'cmspagelink3_name' => $this->input->post('cmspagelink3_name'),
                    'facebook_link' => $this->input->post('fblink'),
                    'google_link' => $this->input->post('googlepluslink'),
                    'twitter_link' => $this->input->post('twitterlink'),
                    'linkedin_link' => $this->input->post('linkedinlink'),
                    
                   
                );
                $mandate_insert_details=  $this->mandate_update->get_insert_details();
                //if the insert has returned true then we show the flash message
                if ($this->companycmspage_model->store_cmspage(array_merge($data_to_store,$mandate_insert_details))) {
                   
                } else {
                 
                }
            }
            else{
                $data['message']=validation_errors();
            }
        }
        //load the view
        $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);
        $data['count_cmslimit'] = $this->companycmspage_model->count_limitcmspage($userid);

        $data['main_content'] = 'admin_company/cmspage/add';
        $this->load->view('includes/template', $data);
    }

    /**
     * Update item by his id
     * @return void
     */
    public function update() {
        $userid = $this->session->userdata('id');
        $usernm = $this->session->userdata('user_name');
        //product id 
        $id = $this->uri->segment(4);

        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
            $this->form_validation->set_rules('emailid', 'emailid', 'trim|required|min_length[5]|xss_clean');
            $this->form_validation->set_rules('contactno', 'contactno', 'trim|required|numeric|xss_clean');
            $this->form_validation->set_rules('cmspagelink1', 'cmspagelink1', 'trim|required|xss_clean');
            $this->form_validation->set_rules('cmspagelink2', 'cmspagelink2', 'trim|xss_clean');
            $this->form_validation->set_rules('cmspagelink3', 'cmspagelink3', 'trim|xss_clean');
            $this->form_validation->set_rules('cmspagelink1_name', 'cmspagelink1_name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('cmspagelink2_name', 'cmspagelink2_name', 'trim|xss_clean');
            $this->form_validation->set_rules('cmspagelink3_name', 'cmspagelink3_name', 'trim|xss_clean');

            $this->form_validation->set_rules('fblink', 'fblink', 'trim|xss_clean');
            $this->form_validation->set_rules('googlepluslink', 'googlepluslink', 'trim|xss_clean');
            $this->form_validation->set_rules('twitterlink', 'twitterlink', 'trim|xss_clean');
            $this->form_validation->set_rules('linkedinlink', 'linkedinlink', 'trim|xss_clean');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()) {

                $data_to_store = array(
                    'emailid' => $this->input->post('emailid'),
                    'contactno' => $this->input->post('contactno'),
                    'cmspagelink1' => $this->input->post('cmspagelink1'),
                    'cmspagelink2' => $this->input->post('cmspagelink2'),
                    'cmspagelink3' => $this->input->post('cmspagelink3'),
                    'cmspagelink1_name' => $this->input->post('cmspagelink1_name'),
                    'cmspagelink2_name' => $this->input->post('cmspagelink2_name'),
                    'cmspagelink3_name' => $this->input->post('cmspagelink3_name'),
                    'facebook_link' => $this->input->post('fblink'),
                    'google_link' => $this->input->post('googlepluslink'),
                    'twitter_link' => $this->input->post('twitterlink'),
                    'linkedin_link' => $this->input->post('linkedinlink'),
                   
                );
                 $mandate_update_details=  $this->mandate_update->get_update_details();
                //if the insert has returned true then we show the flash message
                if ($this->companycmspage_model->update_cmspage($id, array_merge($data_to_store,$mandate_update_details)) == TRUE) {
                    $this->session->set_flashdata('flash_message', 'updated');
                } else {
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin_company/cmspage/update/' . $id . '');
            }//validation run
        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
        //product data 
        $data['cmspage'] = $this->companycmspage_model->get_cmspage();
        $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);

        //load the view
        $data['main_content'] = 'admin_company/cmspage/edit';
        $this->load->view('includes/template', $data);
    }

//update

    public function clearnotification() {
        //product id 
        $userid = $this->session->userdata('id');
        $usernm = $this->session->userdata('user_name');

        //if save button was clicked, get the data sent via post
        //if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $data_to_store = array(
                'IsRead' => 'Y'
            );

            if ($this->companycmspage_model->update_notifcation($userid, $data_to_store) == TRUE) {
                $this->session->set_flashdata('flash_message', 'updated');
            } else {
                $this->session->set_flashdata('flash_message', 'not_updated');
            }
        }
        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
        //load the view
        redirect('admin_company/cmspage/notificationslist');
    }

//update

    public function notificationslist() {

        //$this->output->enable_profiler(TRUE);
        //all the posts sent by the view

        $search_string = $this->input->post('search_string');
        $order = $this->input->post('order');
        $order_type = $this->input->post('order_type');
        $userid = $this->session->userdata('id');
        $usernm = $this->session->userdata('user_name');

        //pagination settings
        $config['per_page'] = 15;
        $config['base_url'] = base_url() . 'admin_company/cmspage';
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
                $order_type = 'DESC';
            }
        }
        //make the data type var avaible to our view
        $data['order_type_selected'] = $order_type;

        //filtered && || paginated
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
            $data['count_products'] = $this->companycmspage_model->count_notification($userid, $search_string, $order, $userid);
            $config['total_rows'] = $data['count_products'];

            //fetch sql data into arrays
            if ($search_string) {
                if ($order) {
                    $data['cmspage'] = $this->companycmspage_model->get_noticationdetails($userid, $search_string, $order, $order_type, $config['per_page'], $limit_end);
                } else {
                    $data['cmspage'] = $this->companycmspage_model->get_noticationdetails($userid, $search_string, '', $order_type, $config['per_page'], $limit_end);
                }
            } else {
                if ($order) {
                    $data['cmspage'] = $this->companycmspage_model->get_noticationdetails($userid, '', $order, $order_type, $config['per_page'], $limit_end);
                } else {
                    $data['cmspage'] = $this->companycmspage_model->get_noticationdetails($userid, '', '', $order_type, $config['per_page'], $limit_end);
                }
            }
        } else {

            //clean filter data inside section
            $filter_session_data['cmspage_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['count_products'] = $this->companycmspage_model->count_notification($userid);
            $data['cmspage'] = $this->companycmspage_model->get_noticationdetails($userid, '', '', $order_type, $config['per_page'], $limit_end);
            $config['total_rows'] = $data['count_products'];
        }//!isset($search_string) && !isset($order)
        //initializate the panination helper 
        $this->pagination->initialize($config);

        $data['count_cmslimit'] = $this->companycmspage_model->count_limitcmspage($userid);

        $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);

        //load the view
        $data['main_content'] = 'admin_company/cmspage/notificationslistpage';
        $this->load->view('includes/template', $data);
    }

//index

    /**
     * Delete product by his id
     * @return void
     */
    public function delete() {
        //product id 
        $id = $this->uri->segment(4);
        $this->companycmspage_model->delete_cmspage($id);
        redirect('admin_company/cmspage');
    }

//edit
}
