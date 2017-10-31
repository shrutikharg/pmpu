<?php

class Admin_companysubcategory extends CI_Controller {

    /**
     * name of the folder responsible for the views 
     * which are manipulated by this controller
     * @constant string
     */
    const VIEW_FOLDER = 'admin_company/subcategory';

    /**
     * Responsable for auto load the model
     * @return void
     */
    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));


        if ($this->session->userdata('is_logged_in') !== TRUE) {
            redirect('admin_company/login');
        } else {
            $this->load->model('companysubcategory_model');
            $this->load->model('companycategory_model');
            $this->load->model('companycmspage_model');
        }
    }

    /**
     * Load the main view with all the current model model's data.
     * @return void
     */
    public function index() {

        $usernm = $this->session->userdata('user_name');
        $userid = $this->session->userdata('id');
        $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);
        $data['category'] = $this->companycategory_model->get_category_droplist;
        $data['main_content'] = 'admin_company/subcategory/list';
        $this->load->view('includes/template', $data);
    }

//index
    public function subcategory_list() {
        $usernm = $this->session->userdata('user_name');
        $userid = $this->session->userdata('id');
        $limit = $this->input->post(rows);
        ; //no. of rows
        $sidx = 'id';
        $sord = "desc";

        if ($this->input->post('search') == 'true') {
            $search_string_array = json_decode($this->input->post('search_string_array'));
        }
        $page = trim($this->input->post('page'));
        if ($page == "") {
            $page = 1;
        }
        $count = $this->companysubcategory_model->get_subcategory($sidx, $sord, 0, $limit, $search_string_array, $is_count = true);

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

        $query = $this->companysubcategory_model->get_subcategory($sidx, $sord, $start, $limit, $search_string_array, $is_count = false);
        $response = new stdClass();
        $response->page = $page;

        $response->total = $totalpages;
        $response->records = $count;
        $response->start = $start + 1;
        $response->end = $start + $limit;
        $i = 0;

        foreach ($query->result() as $row) {


            $response->rows[$i] = array('id' => $this->encryption->encrypt($row->id), 'name' => $row->subcategory, 'category' => $row->category, 'description' => $row->description);
            $i++;
        }
        echo json_encode($response);
    }

    public function add() {
        $userid = $this->session->userdata('id');
        $usernm = $this->session->userdata('user_name');

        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            //if the form has passed through the validation
            if ($this->form_validation->run()) {
                $data_to_store = array(
                    'name' => $this->input->post('name'),
                    'description' => $this->input->post('description'),
                    'category_id' => $this->input->post('category_id'),
                    'is_Active' => 'Y',
                );
                $trim_insert_array = trim_array($data_to_store);
                $manadate_insert_details = $this->mandate_update->get_insert_details();
                if ($this->companysubcategory_model->store_subcategory(array_merge($trim_insert_array, $manadate_insert_details))) {
                    $this->session->set_flashdata('message', $this->lang->line('msg_course_insert_success'));
                    redirect('admin_company/subcategory');
                }
            } else {
                $data['post_data'] = $this->input->post();
                $data['message'] = validation_errors();
            }
        }

        $data['category_list'] = $this->companycategory_model->get_category_list();
       
        $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);
        $data['main_content'] = 'admin_company/subcategory/add';

        $this->load->view('includes/template', $data);
    }

    /**
     * Update item by his id
     * @return void
     */
    public function update() {
        $id = $this->encryption->decrypt($this->input->post('id'));
        echo $id;
        $userid = $this->session->userdata('id');
        $usernm = $this->session->userdata('user_name');

        //if save button was clicked, get the data sent via post
        $data['subcategory_data'] = $this->companysubcategory_model->get_subcategory_by_id($userid, $id); //   
        if (array_key_exists("name", $_POST)) {
            
            //if the form has passed through the validation
            if ($this->form_validation->run()) {
                $data_to_update = array(
                    'name' => $this->input->post('name'),
                    'description' => $this->input->post('description'),
                    'category_id' => $this->input->post('category_id'));
                $trim_update_array = trim_array($data_to_update);
                $manadate_update_details = $this->mandate_update->get_update_details();
                $query = $this->companysubcategory_model->update_subcategory($id, array_merge($trim_update_array, $manadate_update_details));

                if ($query == NULL) {
                    $data['query_status'] = "Admin, 'Unable to Edit please contact Administartor.'";
                } else {
                    $this->session->set_flashdata('message', $this->lang->line('msg_subdept_update_success'));
                    redirect('admin_company/subcategory');
                }
            } else {
                $data['subcategory_data'] = array($this->input->post());
                $data['message'] = validation_errors();
            }
        }

        $data['category_list'] = $this->companycategory_model->get_category_list();
        $data['subcategory_id'] = $this->input->post('id');
        $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);
        $data['main_content'] = 'admin_company/subcategory/edit';
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
        $this->companysubcategory_model->delete_subcategory($id);
        redirect('admin_company/subcategory');
    }

    public function subcategory_dropdown_list() {

        $userid = $this->session->userdata('id');
        $category_id = $this->encryption->decrypt($this->input->post(category));
        $sidx = 'id';
        $sord = 'desc';
        $search_string_array = "";
        $query = $this->companysubcategory_model->get_subcategory_dropdownlist($userid, $category_id);

        $response = new stdClass();

        $i = 0;

        foreach ($query as $row) {


            $response->rows[$i] = array('id' => $this->encryption->encrypt($row['id']), 'name' => $row['name']);
            $i++;
        }
        echo json_encode($response);
    }

    public function search_by_name() {
        $userid = $this->session->userdata('id');
        $sidx = 'id';
        $sord = 'desc';
        $subcategory_name = $this->input->post('name');
        $search_string_array = array('name' => $subcategory_name);
        $count = $this->companysubcategory_model->get_subcategory_by_name($userid, $search_string_array);
        echo $count;
    }

}
