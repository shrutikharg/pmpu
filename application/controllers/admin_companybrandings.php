<?php

class Admin_companybrandings extends CI_Controller {

    /**
     * Responsable for auto load the model
     * @return void
     */
    public $logo_path;

    public function __construct() {
        
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('companybrandings_model');
        $this->load->model('companycmspage_model');
        $this->load->model('companyplantable_model');

        if (!$this->session->userdata('is_logged_in')) {
            redirect('admin_company/login');
        }
    }

    public function addtheme() {
      
        $userid = $this->session->userdata('id');
        $usernm = $this->session->userdata('user_name');
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            if ($this->form_validation->run()) {

                $data['imageupload'] = $this->uploadImagelogo($file_element_name);


                $data_to_update = array(
                    'name' => $this->input->post('name'),
                    'price'=>$this->input->post('price'),
                    'description' => $this->input->post('description'),
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('phone')
                );
                if (isset($this->logo_path)) {
                    $data_to_update['logo_path'] = $this->logo_path;
                }


                $mandate_update_details = $this->mandate_update->get_update_admin_details();
                if ($this->companybrandings_model->store_theme_detailsofuser(array_merge($data_to_update, $mandate_update_details))) {
                    $data['message'] = TRUE;
                } else {
                    $this->session->set_flashdata('flash_message', "System eRROR");
                }
            } else {

                $data['message'] = validation_errors();
            }
        }

        //load the view
        $data['company_details'] = $this->domain->get_company_byDomain();
        $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);

        $data['main_content'] = 'admin_company/brandings/addtheme';
        $this->load->view('includes/template', $data);
    }

    public function startpage_app() {
        //$this->output->enable_profiler(TRUE);		
        $userid = $this->session->userdata('id');
        $usernm = $this->session->userdata('user_name');

        $data['hostingdetails'] = $this->companyplantable_model->plantabledetails();
        $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);
        $data['main_content'] = 'admin_company/brandings/startpageapp';
        $this->load->view('includes/template', $data);
    }

    public function uploadImagelogo($file_element_name) {

        $config['upload_path'] = './assets/user_theme/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '100';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($file_element_name)) {
            return false;
        } else {
            $data = $this->upload->data();
            return $data;
        }
    }

    public function upload_logo() {
        $logo_file_name = 'logo_image';
        $user_parent_directory_path = './uploads/chapter_documents/comp_' . $this->session->userdata('company_id'); //set user_company directory path
        $user_admin_directory = create_directory($user_parent_directory_path); //directory is created for per chapter
        if ($_FILES[$logo_file_name]['size'] != 0) {

            $config['upload_path'] = $user_admin_directory;
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '1000';
            $config['max_width'] = '70';
            $config['max_height'] = '50';
            $config['overwrite'] = FALSE;
            $upload_data = $this->upload->do_my_upload($logo_file_name, $config);

            if ($upload_data['status'] == TRUE) {
                $this->logo_path = $user_admin_directory . '/' . $upload_data['details']['raw_name'] . $upload_data['details']['file_ext'];

                return TRUE;
            } else {
                $this->form_validation->set_message('upload_logo', $upload_data['details']);
                return false;
            }
        }
        else{
            return TRUE;
        }
    }
    }
    