<?php
class Admin_courses extends CI_Controller {

    /**
    * name of the folder responsible for the views 
    * which are manipulated by this controller
    * @constant string
    */
    const VIEW_FOLDER = 'admin/courses';
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('courses_model');
		$this->load->model('subcategory_model');
		$this->load->model('category_model');

        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
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

        //pagination settings
        $config['per_page'] = 15;

        $config['base_url'] = base_url().'admin/courses';
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


        //we must avoid a page reload with the previous session data
        //if any filter post was sent, then it's the first time we load the content
        //in this case we clean the session filter data
        //if any filter post was sent but we are in some page, we must load the session data

        //filtered && || paginated
        if($search_string !== false && $order !== false || $this->uri->segment(3) == true){ 
           
            /*
            The comments here are the same for line 79 until 99

            if post is not null, we store it in session data array
            if is null, we use the session data already stored
            we save order into the the var to load the view with the param already selected       
            */
            if($search_string){
                $filter_session_data['search_string_selected'] = $search_string;
            }else{
                $search_string = $this->session->userdata('search_string_selected');
            }
            $data['search_string_selected'] = $search_string;

            if($order){
                $filter_session_data['order'] = $order;
            }
            else
			{
                $order = $this->session->userdata('order');
            }
            $data['order'] = $order;

            //save session data into the session
            if(isset($filter_session_data)){
              $this->session->set_userdata($filter_session_data);    
            }
            
            //fetch sql data into arrays
            $data['count_products']= $this->courses_model->count_courses($search_string, $order);
            $config['total_rows'] = $data['count_products'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['courses'] = $this->courses_model->get_courses($search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['courses'] = $this->courses_model->get_courses($search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['courses'] = $this->courses_model->get_courses('', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['courses'] = $this->courses_model->get_courses('', '', $order_type, $config['per_page'],$limit_end);        
                }
            }

        }else{

            //clean filter data inside section
            $filter_session_data['courses_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['count_products']= $this->courses_model->count_courses();
            $data['courses'] = $this->courses_model->get_courses('', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_products'];

        }//!isset($search_string) && !isset($order)
         
        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'admin/courses/list';
        $this->load->view('includes/template', $data);  

    }//index

    public function add()
    {
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('name', 'Course Name', 'required');
			$this->form_validation->set_rules('subtitle', 'Course Subtitle', 'trim|required|min_length[3]|xss_clean');
			$this->form_validation->set_rules('courseby', 'Course Author', 'trim|required|min_length[5]|xss_clean');
			$this->form_validation->set_rules('requirements', 'Course Requirements', 'trim|required|xss_clean');
			$this->form_validation->set_rules('price', 'Course Price', 'trim|required|numeric|xss_clean');
			$this->form_validation->set_rules('validity', 'Course Validaty', 'trim|required|numeric|xss_clean');
			$this->form_validation->set_rules('audience', 'Course Audience', 'trim|xss_clean');
			$this->form_validation->set_rules('goals', 'Course Name', 'trim|xss_clean');
			$this->form_validation->set_rules('subcategory', 'Sub Category of Course', 'trim|required|numeric|xss_clean');
			$this->form_validation->set_rules('description', 'Course Description', 'trim|xss_clean');
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
           
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                
				$file_element_name ='courseimage';
				$data['imageupload'] = $this->uploadImage($file_element_name);
				if (!empty($data['imageupload']['file_name'])) 
				{
					
					$imagelogo=$data['imageupload']['file_name'];
				}
				else
				{
					$imagelogo='default_course.png';
					
				}
				
				$data_to_store = array(
                    'course_name' => $this->input->post('name'),
					'course_subtitle' => $this->input->post('subtitle'),
					'course_by' => $this->input->post('courseby'),
					'course_requirements' => $this->input->post('requirements'),
					'course_price' => $this->input->post('price'),
					'course_validity' => $this->input->post('validity'),
					'course_audience' => $this->input->post('audience'),
					'course_goals' => $this->input->post('goals'),
					'subcategory_id' => $this->input->post('subcategory'),
					'course_image' => $imagelogo,					            
					'course_description' => $this->input->post('description'),
					'created_date' => date('Y-m-d'),
					'created_by'=>$this->session->userdata('user_name')	
                );
                //if the insert has returned true then we show the flash message
                if($this->courses_model->store_courses($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }
            }
        }
		$data['category'] = $this->category_model->get_category_list();
		$data['subcategory'] = $this->subcategory_model->get_subcategory_list();
        //load the view
        $data['main_content'] = 'admin/courses/add';
        $this->load->view('includes/template', $data);  
    }       

    /**
    * Update item by his id
    * @return void
    */
    public function update()
    {
        //product id 
        $id = $this->uri->segment(4); 	
        //if save button was clicked, get the data sent via post
		if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('name', 'Course Name', 'required');
			$this->form_validation->set_rules('subtitle', 'Course Subtitle', 'trim|required|min_length[3]|xss_clean');
			$this->form_validation->set_rules('courseby', 'Course Author', 'trim|required|min_length[5]|xss_clean');
			$this->form_validation->set_rules('requirements', 'Course Requirements', 'trim|required|xss_clean');
			$this->form_validation->set_rules('price', 'Course Price', 'trim|required|numeric|xss_clean');
			$this->form_validation->set_rules('validity', 'Course Validaty', 'trim|required|numeric|xss_clean');
			$this->form_validation->set_rules('audience', 'Course Audience', 'trim|xss_clean');
			$this->form_validation->set_rules('goals', 'Course Name', 'trim|xss_clean');
			$this->form_validation->set_rules('subcategory', 'Sub Category of Course', 'trim|required|numeric|xss_clean');
			$this->form_validation->set_rules('description', 'Course Description', 'trim|xss_clean');
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
           
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                
				$file_element_name ='courseimage';
				$data['imageupload'] = $this->uploadImage($file_element_name);
				if (!empty($data['imageupload']['file_name'])) 
				{
					
					$imagelogo=$data['imageupload']['file_name'];
				}
				elseif(count($this->input->post('courseimagedisp')>4))
				{					
					$imagelogo=$this->input->post('courseimagedisp');
				}
				else
				{
					$imagelogo='default_course.png';
				}
				
				$data_to_store = array(
                    'course_name' => $this->input->post('name'),
					'course_subtitle' => $this->input->post('subtitle'),
					'course_by' => $this->input->post('courseby'),
					'course_requirements' => $this->input->post('requirements'),
					'course_price' => $this->input->post('price'),
					'course_validity' => $this->input->post('validity'),
					'course_audience' => $this->input->post('audience'),
					'course_goals' => $this->input->post('goals'),
					'subcategory_id' => $this->input->post('subcategory'),
					'course_image' => $imagelogo,					            
					'course_description' => $this->input->post('description'),
					'modify_date' => date('Y-m-d'),
					'modify_by'=>$this->session->userdata('user_name'),
					'IsActive'=> $this->input->post('status')
                );
                //if the insert has returned true then we show the flash message
                if($this->courses_model->update_courses($id, $data_to_store) == TRUE)
				{
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				 redirect('admin/courses/update/'.$id.'');
            }
        }
		$data['category'] = $this->category_model->get_category_list();
		$data['subcategory'] = $this->subcategory_model->get_subcategory_dropdownlist();
        $data['courses'] = $this->courses_model->get_courses_by_id($id);
        //load the view
        $data['main_content'] = 'admin/courses/edit';
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
        $this->courses_model->delete_courses($id);
        redirect('admin/courses');
    }//edit

	public function uploadImage($file_element_name)
	{
	    
		$config['upload_path']      = './assets/course_image/';
	    $config['allowed_types']    = 'gif|jpg|png|jpeg';
	    $config['max_size']         = '100';
	    $config['max_width']        = '1024';
	    $config['max_height']       = '768';

	    $this->load->library('upload', $config);        

		if (!$this->upload->do_upload($file_element_name))
	    {
	        return false;
	    }
	    else
	    {
	        $data = $this->upload->data();
	        return $data;
	    }       

	}
}