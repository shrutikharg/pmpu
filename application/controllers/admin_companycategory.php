<?php
class Admin_companycategory extends CI_Controller {

    /**
     * name of the folder responsible for the views 
     * which are manipulated by this controller
     * @constant string
     */
    const VIEW_FOLDER = 'admin_company/category';

    /**
     * Responsable for auto load the model
     * @return void
     */
    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
       
    
        if ($this->session->userdata('is_logged_in')!==TRUE ) {
           
            redirect('admin_company/login');
        
        }
        else{
        $this->load->model('companycategory_model');
        }
    }

    /**
     * Load the main view with all the current model model's data.
     * @return void
     */
    public function index() {               
       $userid = $this->session->userdata('id');
        $usernm = $this->session->userdata('user_name');
        $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);
        $data['main_content'] = 'admin_company/category/list';
        $this->load->view('includes/template', $data);
    }

    public function category_list() {
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
        $count = $this->companycategory_model->get_category($userid, $sidx, $sord, 0, $limit, $search_string_array, $is_count = true);

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

        $query = $this->companycategory_model->get_category($userid, $sidx, $sord, $start, $limit, $search_string_array, $is_count = false);
        $response = new stdClass();
        $response->page = $page;

        $response->total = $totalpages;
        $response->records = $count;
        $response->start = $start + 1;
         $response->end=  $start+$limit;
         
     
        $i = 0;

        foreach ($query->result() as $row) {


            $response->rows[$i] = array('id' => $this->encryption->encrypt($row->id), 'name' => $row->name, 'description' => $row->description);
            $i++;
        }
        echo json_encode($response);
    }

//index

    public function add() {
        $userid = $this->session->userdata('id');
        $usernm = $this->session->userdata('user_name');
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
             if ($this->form_validation->run()) {
                $data_to_store = array(
                    'name' => $this->input->post('name'),
                   'description' => $this->input->post('description'),                  
                   'is_active' => 'Y',
                );
                
               $trim_insert_array=trim_array($data_to_store);
               $manadate_insert_details=$this->mandate_update->get_insert_details();            
                           
              
                //if the insert has returned true then we show the flash message
                if ($this->companycategory_model->store_category(array_merge($trim_insert_array,$manadate_insert_details))) {
                    $this->session->set_flashdata('message', $this->lang->line('msg_dept_insert_success'));
                    redirect('admin_company/category');
                } else {
                    $data['message'] =$this->lang->line('error_add');
                }
            }
            else{
               // $data['category_data']=array($this->input->post());
                $data['message'] =  validation_errors();
            }
        }
        //load the view
        $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);
        $data['main_content'] = 'admin_company/category/add';
        $this->load->view('includes/template', $data);
    }

    /**
     * Update item by his id
     * @return void
     */
    public function update() {
        //product id 
        $id = $this->encryption->decrypt($this->input->post(category_id));
        $userid = $this->session->userdata('id');
        $usernm = $this->session->userdata('user_name');
        //if save button was clicked, get the data sent via post
        //  echo $this->input->post('description');
        if (array_key_exists("name", $_POST)) {
            //form validation
          
            if ($this->form_validation->run()) {

                $data_to_store = array(
                    'name' => $this->input->post('name'),
                    'description' => $this->input->post('description'),                   
                   
                );
                 $trim_insert_array=trim_array($data_to_store);
               $manadate_insert_details=$this->mandate_update->get_update_details();   
                 

                $query = $this->companycategory_model->update_category($id, array_merge($trim_insert_array,$manadate_insert_details));
                
                if ($query != NULL) {
                     $this->session->set_flashdata('message', $this->lang->line('msg_dept_insert_success'));
                    redirect('admin_company/category');
                } else {
                    $data['message'] = $this->lang->line('error_edit');
                            }
            }//validation run
            else{
                $data['message']=  validation_errors();
                
            }
        }

        $data['category'] = $this->companycategory_model->get_category_by_id($id);

        $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);
        $data['category_id'] = $this->input->post(category_id);

        $data['main_content'] = 'admin_company/category/edit';
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
        $this->companycategory_model->delete_category($id);
        redirect('admin_company/category');
    }

    public function search_by_name() {
        $userid = $this->session->userdata('id');
  $company_id=$this->session->userdata('company_id');
        $category_name = $this->input->post('name');
        $search_string_array = array('search_string' => $category_name);
        $count = $this->companycategory_model->get_category_by_name($company_id,$search_string_array);
        echo $count;
    }

    public function category_dropdown_list() {

        $userid = $this->session->userdata('id');
        $sidx = 'id';
        $sord = 'desc';
        $search_string_array = "";
        $query = $this->companycategory_model->get_category_droplist($userid);
       
        $response = new stdClass();
      
        $i = 0;
       
        foreach ($query as $row) {


            $response->rows[$i]= array('id' => $this->encryption->encrypt($row['id']),'name' =>$row['name']);
            $i++;
        }
        echo json_encode($response); 
    }

}
