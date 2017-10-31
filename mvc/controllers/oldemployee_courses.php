<?php
class Employee_courses extends CI_Controller {

    /**
    * name of the folder responsible for the views 
    * which are manipulated by this controller
    * @constant string
    */
    const VIEW_FOLDER = 'employee_company/courses';
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
	    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('employeecourses_model');
		$this->load->model('subcategory_model');
		$this->load->model('category_model');
		$this->load->library('user_agent');
		$this->load->model('employeeuser_model');

        if(!$this->session->userdata('is_logged_in')){
            redirect('employee/login');
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
		$empcompid=$this->session->userdata('emp_companyuseradmin');
        //pagination settings
        $config['per_page'] = 15;

        $config['base_url'] = base_url().'employee/courses';
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
            $data['count_products']= $this->employeecourses_model->count_courses($search_string, $order);
            $config['total_rows'] = $data['count_products'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['courses'] = $this->employeecourses_model->get_courses($search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['courses'] = $this->employeecourses_model->get_courses($search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['courses'] = $this->employeecourses_model->get_courses('', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['courses'] = $this->employeecourses_model->get_courses('', '', $order_type, $config['per_page'],$limit_end);        
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
            $data['count_products']= $this->employeecourses_model->count_courses();
            $data['courses'] = $this->employeecourses_model->get_courses('', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_products'];

        }//!isset($search_string) && !isset($order)
         
        //initializate the panination helper 
        $this->pagination->initialize($config);   
		$data['footerdata']= $this->employeeuser_model->list_footercmspage($empcompid);
        
        //load the view
        $data['main_content'] = 'employee/courses/list';
        $this->load->view('includes/template', $data);  

    }//index


	public function assigncourses()
    {
		//$this->output->enable_profiler(TRUE);
        //all the posts sent by the view
        $search_string = $this->input->post('search_string');        
        $order = $this->input->post('order'); 
        $order_type = $this->input->post('order_type'); 
		$userid=$this->session->userdata('id');	
		$empcompid=$this->session->userdata('emp_companyuseradmin');
        //pagination settings
        $config['per_page'] = 15;

        $config['base_url'] = base_url().'employee/assigncourses';
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

    if($search_string !== false && $order !== false || $this->uri->segment(3) == true)
	{ 
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
            $data['count_products']= $this->employeecourses_model->count_assigncourses($userid,$search_string, $order);
            $config['total_rows'] = $data['count_products'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                $data['courses'] = $this->employeecourses_model->get_assigncourses($userid,$search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                $data['courses'] = $this->employeecourses_model->get_assigncourses($userid,$search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                $data['courses'] = $this->employeecourses_model->get_assigncourses($userid,'', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                $data['courses'] = $this->employeecourses_model->get_assigncourses($userid,'', '', $order_type, $config['per_page'],$limit_end);        
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
    $data['count_products']= $this->employeecourses_model->count_assigncourses($userid);
            $data['courses'] = $this->employeecourses_model->get_assigncourses($userid,'', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_products'];

        }//!isset($search_string) && !isset($order)
         
        //initializate the panination helper 
        $this->pagination->initialize($config);   
		$data['footerdata']= $this->employeeuser_model->list_footercmspage($empcompid);
        //load the view
        $data['main_content'] = 'employee_company/courses/assignlist';
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
					'created_by'=>$this->session->userdata('empuser_name')	
                );
                //if the insert has returned true then we show the flash message
                if($this->employeecourses_model->store_courses($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }
            }
        }
		$data['category'] = $this->category_model->get_category_list();
		$data['subcategory'] = $this->subcategory_model->get_subcategory_list();
        //load the view
        $data['main_content'] = 'employee/courses/add';
        $this->load->view('includes/template', $data);  
    } 
	
	
	public function certificate()
    {
	/*
	$this->load->helper('pdfexport_helper.php');
  $urlId  = $this->uri->segment('3');

    if($urlId == "export") {

       $data['pageTitle'] = "Annual Report";
       $data['htmView'] = $this->load->view('annualreport_view',$data,TRUE);
       $templateView  = $this->load->view('../template_export',$data,TRUE);
       exportAsMPdf($templateView,$data['filename']);     
        /*  OR          
       exportAsDomPdf($htmView,$fileName)                                                              
    }	*/  
	//product id 
		//$this->output->enable_profiler(TRUE);
		$userid=$this->session->userdata('id');	
		
			//$ecourseid = $this->uri->segment(3); 
			//$empid = $this->uri->segment(4);
			
	$csid = $this->uri->segment(4);
	$data['courseassign'] = $this->employeecourses_model->get_coursesassignby_id($csid);
	$courseid=$data['courseassign'][0]['courseid'];	
	$data['coursetake'] = $this->employeecourses_model->get_coursesby_id($courseid);
	
	
	$assigned_user=$data['courseassign'][0]['assignedby_user'];
	if(count($assigned_user) > 0)
	{
	$data['themesset'] = $this->employeecourses_model->get_themeset_user($assigned_user);
	}else
	{
		$data['themesset'] = $this->employeecourses_model->get_themeset_default();
	}
	//var_dump($data['courseassign']);			
	$data['main_content'] = 'employee_company/courses/takecourse';
	$this->load->view('employee_company/courses/getcertificate', $data); 
			//exit;
//load mPDF library			
$this->load->library('m_pdf');	
	//load the view and saved it into $html variable
$html=$this->load->view('employee_company/courses/getcertificate', $data, true);
//this the the PDF filename that user will get to download
$pdfFilePath = "output_pdf_name.pdf";


 
//generate the PDF from the given html
$this->pdf->WriteHTML($html);
 
//download it.
$this->pdf->Output($pdfFilePath, "D");
		
/*		
		$data['courses'] = $this->employeecourses_model->get_coursesassignby_id($ecourseid);
		$courseid=$data['courseassign'][0]['courseid'];		
		$data['coursetake'] = $this->employeecourses_model->get_coursesby_id($courseid);
			
		$message  ='Hello,';
		$message  .="<br/>";
		$message  .='sdgsdgsdgsgsddsgdsgsdgs'.$courses[0]['course_name'];
		$message  .="<br/><br/>";									
		$message  .='Thank You.';
									
		$emlto = 'shridhar.s@modelcamtechnologies.com';

		$subject = 'Hello assign completed';

		$headers  = 'MIME-Version: 1.0' . "\r\n";

		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		$headers .= 'From: coolacharya.com <info@coolacharya.com>' . "\r\n";

		$flag=mail($emlto, $subject, $message, $headers);
		
				if($flag == TRUE)
				{
                    $this->session->set_flashdata('flash_message', 'send');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_send');
                }
				
		  
	*/	
		
		//$data['subcategory'] = $this->subcategory_model->get_subcategory_dropdownlist();
        //load the view
       // redirect('employee/courses/update/'.$ecourseid.'');        
       

    }

	/*
	* @return void
    */
    public function takecourses()
    {
        //product id 
		//$this->output->enable_profiler(TRUE);
		
       
        $id = $this->uri->segment(4); 
		
		$empcompid=$this->session->userdata('emp_companyuseradmin');
		
        //if save button was clicked, get the data sent via post
		//if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
        /*
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
							'modify_by'=>$this->session->userdata('empuser_name'),
							'IsActive'=> $this->input->post('status')
		                );
		                //if the insert has returned true then we show the flash message
		                if($this->employeecourses_model->update_courses($id, $data_to_store) == TRUE)
						{
		                    $this->session->set_flashdata('flash_message', 'updated');
		                }else{
		                    $this->session->set_flashdata('flash_message', 'not_updated');
		                }
						 redirect('employee/courses/update/'.$id.'');
		            }
		*/
		$data['courseassign'] = $this->employeecourses_model->get_coursesassignby_id($id);
			//var_dump($data['courseassign']);
			$courseid=$data['courseassign'][0]['courseid'];
			$coursename=$data['courseassign'][0]['course_name'];
		$data['coursetake'] = $this->employeecourses_model->get_coursesby_id($courseid);
			
			
			if ($this->agent->is_mobile())
			{
			    $mobstr = $this->agent->mobile();
			}
			else
			{
				$mobstr ='Desktop';
			}
			
			
			//echo $this->agent->browser();
			//echo $this->agent->platform(); 
			//exit;


			$data_to_store = array(
                    'userid' => $id,
					'courseid' => $courseid,
					'course_name' => $coursename,
					'clickcourse_date' => date('Y-m-d'),
					'created_by'=>$this->session->userdata('empuser_name'),					
					'user_browser'=>$this->agent->browser(),
					'version_browser'=>$this->agent->version,
					'type_browser'=>$mobstr,
					'platform'=>$this->agent->platform(),					
					'ip_addr'=>$_SERVER['REMOTE_ADDR'],
					'city'=> $this->session->userdata('city'),
					'region'=> $this->session->userdata('region'),
					'country'=> $this->session->userdata('country'),
					'geoloc'=> $this->session->userdata('loc'),
					'postalcode'=> $this->session->userdata('post')
                );
                //if the insert has returned true then we show the flash message
                if($this->employeecourses_model->store_takingcourse($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }
						
        }
		
		$data['category'] = $this->category_model->get_category_list();
		$data['subcategory'] = $this->subcategory_model->get_subcategory_dropdownlist();
        $data['courses'] = $this->employeecourses_model->get_courses_by_id($id);
		$data['footerdata']= $this->employeeuser_model->list_footercmspage($empcompid);
        //load the view
        $data['main_content'] = 'employee_company/courses/takecourse';
        $this->load->view('includes/template', $data);            

    }//update


    /**
    * Update item by his id
    * @return void
    */
    public function update()
    {
		//$this->output->enable_profiler(TRUE);
        //product id 
        $id = $this->uri->segment(4); 	
        //if save button was clicked, get the data sent via post
		if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
			
			$userid=$this->session->userdata('id');
		
			$data['courseassign'] = $this->employeecourses_model->get_coursesassignby_id($id);
			$courseid=$data['courseassign'][0]['courseid'];		
			$data['coursetake'] = $this->employeecourses_model->get_coursesby_id($courseid);
				$message  ='Hello,';
				$message  .="<br/>";
				$message  .='sdgsdgsdgsgsddsgdsgsdgs'.$courses[0]['course_name'];
				$message  .="<br/><br/>";									
				$message  .='Thank You.';
											
				$emlto = 'shridhar.s@modelcamtechnologies.com';

				$subject = 'Hello assign completed';

				$headers  = 'MIME-Version: 1.0' . "\r\n";

				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

				$headers .= 'From: coolacharya.com <info@coolacharya.com>' . "\r\n";

				$flag=mail($emlto, $subject, $message, $headers);
		
				if($flag == TRUE)
				{
                    $this->session->set_flashdata('flash_message', 'send');
					
					$data_to_store = array(
                    'userid' => $id ,
					'entry_date' => date('Y-m-d'),
					'created_by'=>$this->session->userdata('empuser_name')	
                );
                //if the insert has returned true then we show the flash message
                if($this->employeecourses_model->store_certificatemail($data_to_store)){
                    $data['flash_message'] = TRUE;
					$data_tocertificate =array(
                    'certificate_flag' =>'Y',
					'modify_date' => date('Y-m-d'),
					'modify_by'=>$this->session->userdata('empuser_name')	
					);
					
	        if($this->companycourses_model->update_assigncourses($id, $data_tocertificate) == TRUE)
						{
		                    $this->session->set_flashdata('flash_message', 'updated');
		                }else{
		                    $this->session->set_flashdata('flash_message', 'not_updated');
		                }
		                }else{
		                    $data['flash_message'] = FALSE; 
		                }	
                }else{
                    $this->session->set_flashdata('flash_message', 'not_send');
                }
				
		
        }
		
		$data['category'] = $this->category_model->get_category_list();
		$data['subcategory'] = $this->subcategory_model->get_subcategory_dropdownlist();
        $data['courses'] = $this->employeecourses_model->get_courses_by_id($id);
        //load the view
        $data['main_content'] = 'employee_company/courses/takecourse';
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
        $this->employeecourses_model->delete_courses($id);
        redirect('employee/courses');
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
	
	
	function supportmailemp()
    {
        //product id        
		$this->load->model('Companyuser_model');
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            
            //if ($this->form_validation->run())
            {    
									$message  ='Hello,';
									$message  .="<br/>";
									$message  .=$this->input->post('description');
									$message  .="<br/><br/>";
									$message  .='Thank You.';
									
									$emlto = 'shridhar.s@modelcamtechnologies.com';

									$subject = $this->input->post('subname');

									$headers  = 'MIME-Version: 1.0' . "\r\n";

									$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

									$headers .= 'From: coolacharya.com <info@coolacharya.com>' . "\r\n";

									$flag=mail($emlto, $subject, $message, $headers);
									
                //if the insert has returned true then we show the flash message
                if($flag == TRUE)
				{
                    $this->session->set_flashdata('flash_message', 'send');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_send');
                }
                 redirect('employee_company/supportmailemp');
            }//validation run
        }
        
        $data['main_content'] = 'employee_company/empprofile/supportmail';
        $this->load->view('includes/template', $data);            

    }//update
	
	
	public function empcomments()
    {
        $userid=$this->session->userdata('id');	
		$usernm=$this->session->userdata('user_name');
		$empcompid=$this->session->userdata('emp_companyuseradmin');
		$coursedispid = $this->uri->segment(4); 
		//if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('comments', 'comments', 'required');
			$this->form_validation->set_rules('courseid', 'courseid', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
                    'courseid_comment' => $this->input->post('courseid'),
					'course_subcat' => $this->input->post('coursesubcat'),
					'course_name' => $this->input->post('coursename'),
					'comments' => $this->input->post('comments'),
					'rating_star' => $this->input->post('star'),
					'empuserid'=>$this->session->userdata('id'),
					'companyadmin_id'=>$this->session->userdata('emp_companyuseradmin'),
					'created_date' => date('Y-m-d'),
					'created_by'=>$this->session->userdata('empuser_name')				
                );
                //if the insert has returned true then we show the flash message
                if($this->employeecourses_model->store_commentstbl($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }
            }
			redirect('employee_company/courses');
        }
        //load the view
		$data['footerdata']= $this->employeeuser_model->list_footercmspage($empcompid);
	 	$data['category'] = $this->category_model->get_category_list();
		$data['subcategory'] = $this->subcategory_model->get_subcategory_dropdownlist();
        $data['courses'] = $this->employeecourses_model->get_courses_by_id($id);
		
		redirect('employee_company/courses');
        //$data['main_content'] = 'employee_company/courses/takecourses/'.$coursedispid;
        //$this->load->view('includes/template', $data);  
    }

	public function topiclist()
    {
		//$this->output->enable_profiler(TRUE);
		$courseid = $this->uri->segment(3);
		$search_string = $this->input->post('search_string');        
        $order = $this->input->post('order'); 
        $order_type = $this->input->post('order_type'); 
		$userid=$this->session->userdata('id');	
		$empcompid=$this->session->userdata('emp_companyuseradmin');
        //pagination settings
        $config['per_page'] = 15;

        $config['base_url'] = base_url().'employee/coursetopicslist';
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
            $data['count_products']= $this->employeecourses_model->count_assigncoursestopics($empcompid,$courseid);
            $data['topiclist'] = $this->employeecourses_model->get_assigncoursestopics($empcompid,$courseid,'', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_products'];       
         
        //initializate the panination helper 
        $this->pagination->initialize($config);   
		$data['footerdata']= $this->employeeuser_model->list_footercmspage($empcompid);
        //load the view
        $data['main_content'] = 'employee_company/courses/coursetopic';
        $this->load->view('includes/template', $data);  

    }//index	
}