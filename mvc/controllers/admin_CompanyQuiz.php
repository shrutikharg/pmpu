<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_CompanyQuiz
 *
 * @author a
 */
class admin_CompanyQuiz extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('companycourses_model');		
        $this->load->model('companysubcategory_model');
		$this->load->model('companycategory_model');
		$this->load->model('Companyuser_model');
		$this->load->model('companycmspage_model');
		$this->load->model('companychapters_model');
		

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
		$usernm=$this->session->userdata('user_name');
		
	$data['sessionuserdata'] = $this->Companyuser_model->get_userdetails_by_id($userid);
		
        //pagination settings
        $config['per_page'] = 15;

        $config['base_url'] = base_url().'admin_company/courses';
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
            $data['count_products']= $this->companycourses_model->count_courses($userid,$search_string, $order);
            $config['total_rows'] = $data['count_products'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['courses'] = $this->companycourses_model->get_courses($userid,$search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['courses'] = $this->companycourses_model->get_courses($userid,$search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['courses'] = $this->companycourses_model->get_courses($userid,'', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['courses'] = $this->companycourses_model->get_courses($userid,'', '', $order_type, $config['per_page'],$limit_end);        
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
            $data['count_products']= $this->companycourses_model->count_courses($userid);
            $data['courses'] = $this->companycourses_model->get_courses($userid,'', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_products'];

        }//!isset($search_string) && !isset($order)
         
        //initializate the panination helper 
        $this->pagination->initialize($config);  
		
		$data['diskspace'] = $this->companycourses_model->get_diskspaceuseddtils($userid);
		$bytes=$data['diskspace'][0]['disk_sizespace'];
		$spacebytes=$data['diskspace'][0]['current_diskspace'];
		$remainsize=$bytes-$spacebytes;
		$data['totaldiskspace'] = $this->bytesToSize($bytes);
		$data['remainspace'] = $this->bytesToSize($remainsize);
		$data['footerdata']= $this->companycmspage_model->list_cmspage($userid,$usernm);
        //load the view
        $data['main_content'] = 'admin_company/quiz/list1';
        $this->load->view('includes/template', $data);  

    }//index
    public function bytesToSize($bytes) {
   
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}

}
