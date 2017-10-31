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
    public function __construct()
    {
        parent::__construct();
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('companysubcategory_model');
		$this->load->model('companycategory_model');
		$this->load->model('companycmspage_model');		
        if(!$this->session->userdata('is_logged_in')){
            redirect('admin_company/login');
        }
    }
 
    /**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index()
    {

        //all the posts sent by the view
        $search_string = $this->input->post('search_string');        
        $order = $this->input->post('order'); 
        $order_type = $this->input->post('order_type'); 
		$userid=$this->session->userdata('id');	
		$userid=$this->session->userdata('id');	
		$usernm=$this->session->userdata('user_name');
        //pagination settings
        $config['per_page'] = 15;

        $config['base_url'] = base_url().'admin_company/subcategory';
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
        if ($limit_end < 0){
            $limit_end = 0;
        } 

        //if order type was changed
        if($order_type){
            $filter_session_data['order_type'] = $order_type;
        }
        else{
            //we have something stored in the session? 
            if($this->session->userdata('order_type')){
                $order_type = $this->session->userdata('order_type');    
            }else{
                //if we have nothing inside session, so it's the default "Asc"
                $order_type = 'Asc';    
            }
        }
        //make the data type var avaible to our view
        $data['order_type_selected'] = $order_type;        


        //filtered && || paginated
        if($search_string !== false && $order !== false || $this->uri->segment(3) == true){ 
		if ($order=='select')
        {
        	$this->session->set_flashdata('flash_message', 'error');
		}
		else{
            if($search_string){
                $filter_session_data['search_string_selected'] = $search_string;
            }else{
                $search_string = $this->session->userdata('search_string_selected');
            }
            $data['search_string_selected'] = $search_string;

            if($order){
                $filter_session_data['order'] = $order;
            }
            else{
                $order = $this->session->userdata('order');
            }
            $data['order'] = $order;

            //save session data into the session
            if(isset($filter_session_data)){
              $this->session->set_userdata($filter_session_data);    
            }
            
            //fetch sql data into arrays
            $data['count_products']= $this->companysubcategory_model->count_subcategory($userid,$search_string, $order);
            $config['total_rows'] = $data['count_products'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['subcategory'] = $this->companysubcategory_model->get_subcategory($userid,$search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['subcategory'] = $this->companysubcategory_model->get_subcategory($userid,$search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['subcategory'] = $this->companysubcategory_model->get_subcategory($userid,'', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['subcategory'] = $this->companysubcategory_model->get_subcategory($userid,'', '', $order_type, $config['per_page'],$limit_end);        
                }
             }
            }	
        }else{

            //clean filter data inside section
            $filter_session_data['subcategory_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['count_products']= $this->companysubcategory_model->count_subcategory($userid);
            $data['subcategory'] = $this->companysubcategory_model->get_subcategory($userid,'', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_products'];

        }//!isset($search_string) && !isset($order)
         
        //initializate the panination helper 
        $this->pagination->initialize($config);  
		
		$data['count_subcatlimit']= $this->companysubcategory_model->count_subcatlimitcategory($userid);	
$data['footerdata']= $this->companycmspage_model->list_cmspage($userid,$usernm);
		
        //load the view
        $data['main_content'] = 'admin_company/subcategory/list';
        $this->load->view('includes/template', $data);  

    }//index

    public function add()
    {
		$userid=$this->session->userdata('id');	
		 $userid=$this->session->userdata('id');	
		$usernm=$this->session->userdata('user_name');
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
			
            //form validation
            $this->form_validation->set_rules('name', 'Sub Category name', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
                    'subcategory_name' => $this->input->post('name'),
					'subcategory_description' => $this->input->post('description'),
					'category_id'=>$this->input->post('category'),
					'useracess_id'=>$this->session->userdata('id'),
					'created_date' => date('Y-m-d'),
					'created_by'=>$this->session->userdata('user_name'),
					'IsActive'=>'Y',					
                );
                //if the insert has returned true then we show the flash message
                if($this->companysubcategory_model->store_subcategory($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }
            }

        }
		$data['count_subcatlimit']= $this->companysubcategory_model->count_subcatlimitcategory($userid);
		$data['category'] = $this->companycategory_model->get_category_list($userid);
        //load the view
		$data['footerdata']= $this->companycmspage_model->list_cmspage($userid,$usernm);
		
        $data['main_content'] = 'admin_company/subcategory/add';
        $this->load->view('includes/template', $data);  
    }       

    /**
    * Update item by his id
    * @return void
    */
    public function update()
    {
        $userid=$this->session->userdata('id');	
		//product id 
        $id = $this->uri->segment(4);
		$userid=$this->session->userdata('id');	
		$usernm=$this->session->userdata('user_name');
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('name', 'Sub Category name', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                 $data_to_store = array(
                    'subcategory_name' => $this->input->post('name'),
					'subcategory_description' => $this->input->post('description'),
					'category_id'=>$this->input->post('category'),
					'modify_date' => date('Y-m-d'),
					'modify_by'=>$this->session->userdata('user_name'),
					'IsActive'=>'Y',					
                );
                //if the insert has returned true then we show the flash message
                if($this->companysubcategory_model->update_subcategory($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				
				//$data['category'] = $this->category_model->get_category_list();
                redirect('admin_company/subcategory/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //product data 
		//$data['category'] = $this->category_model->get_category_list();
		$data['category'] = $this->companycategory_model->get_category_droplist($userid);
		$data['count_subcatlimit']= $this->companysubcategory_model->count_subcatlimitcategory($userid);
        $data['subcategory'] = $this->companysubcategory_model->get_subcategory_by_id($userid,$id);
        //load the view
		$data['footerdata']= $this->companycmspage_model->list_cmspage($userid,$usernm);
		
        $data['main_content'] = 'admin_company/subcategory/edit';
        $this->load->view('includes/template', $data);            

    }//update

    /**
    * Delete product by his id
    * @return void
    */
    public function delete()
    {
        //product id 
        $id = $this->uri->segment(4);
        $this->companysubcategory_model->delete_subcategory($id);
        redirect('admin_company/subcategory');
    }//edit

}