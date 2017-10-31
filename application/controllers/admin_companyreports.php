<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_companyreports
 *
 * @author a
 */
class admin_companyreports extends CI_Controller{
 
    public function __construct()
    {
        parent::__construct();
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('companysubcategory_model');
		$this->load->model('companycategory_model');
		$this->load->model('companyanalytics_model');
		$this->load->model('companycourses_model');
		$this->load->model('subcategory_model');
		$this->load->model('category_model');
        $this->load->helper('url');
        $this->load->library('gcharts');
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
		//$this->output->enable_profiler(TRUE);
		$this->gcharts->load('ColumnChart');		
		$this->load->model('companycourses_model');		
		$userid=$this->session->userdata('id');	
		$usernm=$this->session->userdata('user_name');
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
			  //form validation
            $this->form_validation->set_rules('frmdate', 'Select Start Date', 'required');
			$this->form_validation->set_rules('todate', 'Select End Date', 'required');
			$this->form_validation->set_rules('courses', 'Select Course name', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
			$coursename=$this->input->post('courses');
			$datefrom=$this->input->post('frmdate');
			$dateto=$this->input->post('todate');
		
				$data['courses'] = $this->companycourses_model->get_graphcourses($userid,$datefrom,$dateto,$coursename);
				
		//$data['listdtils'] = $this->companycourses_model->get_reporttable_of_graph($userid,$datefrom,$dateto,$coursename);
		$data['listdtils'] = $this->companycourses_model->get_graphcourses($userid,$datefrom,$dateto,$coursename);
		        //echo count($data['courses']);
				//echo var_dump($data['courses']);			
				$this->gcharts->DataTable('Inventory');
				
				/*
				//for($i=0;$i<count($data['courses']);$i++)
				{
				echo $data['courses'][1]['clickcourse_date'];
		        $this->gcharts->DataTable('Inventory')->addColumn('number',$data['courses'][0]['clickcourse_date'], $data['courses'][0]['course_name']);
				$this->gcharts->DataTable('Inventory')->addColumn('number',$data['courses'][1]['clickcourse_date'], $data['courses'][1]['course_name']);
				//echo $data['courses'][$i]['clickcourse_date'];
				}
				*/
				//var_dump($data['courses']);
				$data['dispdata']=$data['courses'];
		if(count($data['courses'])>1)
		{
				$this->gcharts->DataTable('Inventory')->addColumn('string', 'Classroom', 'class');
				/*
				$this->gcharts->DataTable('Inventory')
	              ->addColumn('number',$data['courses'][$j]['clickcourse_date'],$data['courses'][$j]['clickcourse_date'])
				  */
				   $this->gcharts->DataTable('Inventory')->addColumn('number','Dates wise Count', 'Display the dates');		
				for($j=0;$j<count($data['courses']);$j++)
				{
					
		        $this->gcharts->DataTable('Inventory')->addRow(array(
		                        ($data['courses'][$j]['clickcourse_date']),                  
								($data['courses'][$j]['cnt']),							
		                      ));
							  
				}
						
			  $config = array(
	            'title' => 'Course Name'
				);
				$this->gcharts->ColumnChart('Inventory')->setConfig($config);
			}
			else
				{
					$this->session->set_flashdata('flash_message', 'nodata');
				}
		   }
		}
		$data['listcourse'] = $this->companycourses_model->get_courses_droplist($userid);
		$data['footerdata']= $this->companycmspage_model->list_cmspage($userid,$usernm);

		//$data['category'] = $this->category_model->get_category_droplist();
        $data['main_content'] = 'admin_company/reports/list';
        $this->load->view('includes/template', $data);  

    }//index

    public function add()
    {
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
		$data['footerdata']= $this->companycmspage_model->list_cmspage($userid,$usernm);
        //load the view
        $data['main_content'] = 'admin_company/analytics/add';
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
                redirect('admin_company/analytics/update/'.$id.'');

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
        $data['main_content'] = 'admin_company/analytics/edit';
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
        redirect('admin_company/analytics');
    }//edit
	
	
	
	public function analyticreports()
    {
        
        //all the posts sent by the view
        $search_string = $this->input->post('search_string');        
        $order = $this->input->post('order'); 
        $order_type = $this->input->post('order_type'); 
		$userid=$this->session->userdata('id');	
		$usernm=$this->session->userdata('user_name');	
		$this->load->model('category_model');
		$userid=$this->session->userdata('id');	
		$usernm=$this->session->userdata('user_name');
		
        //pagination settings
        $config['per_page'] = 15;

        $config['base_url'] = base_url().'admin_company/graphreports';
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
        else
		{
            
            //clean filter data inside section
            $filter_session_data['category_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['count_products']= $this->companycourses_model->count_assignanalytics();
            $data['users'] = $this->companycourses_model->get_assignedcourselist('', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_products'];

	    }//!isset($search_string) && !isset($order)
	         
	        //initializate the panination helper 
	        $this->pagination->initialize($config);   
       
        //make the data type var avaible to our view
        $data['order_type_selected'] = $order_type;     


        //initializate the panination helper 
        $this->pagination->initialize($config);
		$data['footerdata']= $this->companycmspage_model->list_cmspage($userid,$usernm);

        //load the view
        $data['main_content'] = 'admin_company/graphreports/uanalyticsrpt';
        $this->load->view('includes/template', $data);  
        
    }//edit
	
	
	
	public function reports()
    {
        $userid=$this->session->userdata('id');	
		$usernm=$this->session->userdata('user_name');	
		//product id 
        $id = $this->uri->segment(4);
  
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
                redirect('admin_company/analytics/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //product data 
		//$data['category'] = $this->category_model->get_category_list();
		$data['category'] = $this->companycategory_model->get_category_droplist($userid);
		$data['count_subcatlimit']= $this->companysubcategory_model->count_subcatlimitcategory($userid);
		
		$data['count_subcatlimit']= $this->companysubcategory_model->count_subcatlimitcategory($userid);
	
	$data['totcount']=$this->companyanalytics_model->count_clicksvisitcourses($userid);
	$data['assigncount']=$this->companyanalytics_model->count_assignedcourses($userid);
	$data['certcount']=$this->companyanalytics_model->count_totalcertficcount($userid);
	$data['totalrecentviewers']=$this->companyanalytics_model->count_totalrecentviewersusers($userid);
	
	
	$data['recentviewers']=$this->companyanalytics_model->total_viewerslist($userid);
	$data['footerdata']= $this->companycmspage_model->list_cmspage($userid,$usernm);
        $data['subcategory'] = $this->companysubcategory_model->get_subcategory_by_id($userid,$id);
        //load the view
        $data['main_content'] = 'admin_company/analytics/analyticdetails';
        $this->load->view('includes/template', $data);            

    }//update

}
