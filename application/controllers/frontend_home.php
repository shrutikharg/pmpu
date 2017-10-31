<?php
class Frontend_home extends CI_Controller {

    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();

	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('products_model');
        $this->load->model('category_model');        
	$this->load->library('session');
	
	/*
        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }*/
    }
 
    /**
    * Load the main view with all the current model model's data.
    * @return void
    */
     public function index()
    {
        $data['main_content'] = 'frontend/index';
        $this->load->view('frontendincludes/template', $data);  

    }//index
    
     public function aboutus()
    {
        $data['main_content'] = 'frontend/about-us';
        $this->load->view('frontendincludes/template', $data);  

    }//index
    
    public function clients()
    {
        $data['main_content'] = 'frontend/clients';
        $this->load->view('frontendincludes/template', $data);  

    }//index
    
    public function contact()
    {
          
	
	$this->load->library('email');


	 if ($this->input->server('REQUEST_METHOD') === 'POST')
        {	
		$this->email->from('shri@example.com', 'Your Name');
		$this->email->to('shridhar.s@procezio.com'); 
		//$this->email->cc('another@another-example.com'); 
		//$this->email->bcc('them@their-example.com'); 

		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');
		$this->email->send();

		//echo $this->email->print_debugger();
	}
	
	$data['main_content'] = 'frontend/contact';
        $this->load->view('frontendincludes/template', $data);

    }//index
    
    
    
    
     public function cardiaccare()
    {

        //all the posts sent by the view
	//$this->output->enable_profiler(TRUE);
	$id='1'; 
        $data['cardiaccare'] = $this->products_model->get_productbycategory_id($id);
	
	//var_dump($data['subprddetails'])	;			
        //load the view
        $data['main_content'] = 'frontend/products';
        $this->load->view('frontendincludes/template', $data);  

    }//index
      public function diabeticcare()
    {

        //all the posts sent by the view
	//$this->output->enable_profiler(TRUE);
	$id='2'; 
        $data['cardiaccare'] = $this->products_model->get_productbycategory_id($id);
	
	//var_dump($data['subprddetails'])	;			
        //load the view
        $data['main_content'] = 'frontend/products';
        $this->load->view('frontendincludes/template', $data);  

    }//index
      public function cancercare()
    {

        //all the posts sent by the view
	//$this->output->enable_profiler(TRUE);
	$id='3'; 
        $data['cardiaccare'] = $this->products_model->get_productbycategory_id($id);
	
	//var_dump($data['subprddetails'])	;			
        //load the view
        $data['main_content'] = 'frontend/products';
        $this->load->view('frontendincludes/template', $data);  

    }//index
      public function gastriccare()
    {

        //all the posts sent by the view
	//$this->output->enable_profiler(TRUE);
	$id='4'; 
        $data['cardiaccare'] = $this->products_model->get_productbycategory_id($id);
	
	//var_dump($data['subprddetails'])	;			
        //load the view
        $data['main_content'] = 'frontend/products';
        $this->load->view('frontendincludes/template', $data);  

    }//index
      public function criticalcare()
    {

        //all the posts sent by the view
	//$this->output->enable_profiler(TRUE);
	$id='5'; 
        $data['cardiaccare'] = $this->products_model->get_productbycategory_id($id);
	
	//var_dump($data['subprddetails'])	;			
        //load the view
        $data['main_content'] = 'frontend/products';
        $this->load->view('frontendincludes/template', $data);  

    }//index
      public function hivcare()
    {

        //all the posts sent by the view
	//$this->output->enable_profiler(TRUE);
	$id='6'; 
        $data['cardiaccare'] = $this->products_model->get_productbycategory_id($id);
	
	//var_dump($data['subprddetails'])	;			
        //load the view
        $data['main_content'] = 'frontend/products';
        $this->load->view('frontendincludes/template', $data);  

    }//index
      public function antibiotic()
    {

        //all the posts sent by the view
	//$this->output->enable_profiler(TRUE);
	$id='7'; 
        $data['cardiaccare'] = $this->products_model->get_productbycategory_id($id);
	
	//var_dump($data['subprddetails'])	;			
        //load the view
        $data['main_content'] = 'frontend/products';
        $this->load->view('frontendincludes/template', $data);  

    }//index
      public function lifestyle()
    {

        //all the posts sent by the view
	//$this->output->enable_profiler(TRUE);
	$id='8'; 
        $data['cardiaccare'] = $this->products_model->get_productbycategory_id($id);
	
	//var_dump($data['subprddetails'])	;			
        //load the view
        $data['main_content'] = 'frontend/products';
        $this->load->view('frontendincludes/template', $data);  

    }//index
      public function respiratory()
    {

        //all the posts sent by the view
	//$this->output->enable_profiler(TRUE);
	$id='9'; 
        $data['cardiaccare'] = $this->products_model->get_productbycategory_id($id);
	
	//var_dump($data['subprddetails'])	;			
        //load the view
        $data['main_content'] = 'frontend/products';
        $this->load->view('frontendincludes/template', $data);  

    }//index
      public function eyecare()
    {

        //all the posts sent by the view
	//$this->output->enable_profiler(TRUE);
	$id='10'; 
        $data['cardiaccare'] = $this->products_model->get_productbycategory_id($id);
	
	//var_dump($data['subprddetails'])	;			
        //load the view
        $data['main_content'] = 'frontend/products';
        $this->load->view('frontendincludes/template', $data);  

    }//index
     
     public function indexnew()
    {

        //all the posts sent by the view
        
        //load the view
	$data['editorial'] = $this->editoral_model->get_homeeditoral_disp();	
	$data['articale'] = $this->articale_model->get_homearticale_disp();
	$data['dispdata'] = $this->homemenu_model->get_homedispl_disp();
	$data['free_articles'] = $this->articale_model->get_free_articles_disp();
	
        $data['main_content'] = 'frontend/index';
        $this->load->view('frontendincludes/template', $data);  

    }//index
    
     public function aticale()
    {

        //all the posts sent by the view
	
	 
        $data['articale'] = $this->articale_model->get_articale_by_id($id);
	 
        //load the view
        $data['main_content'] = 'frontend/aticale';
        $this->load->view('frontendincludes/template', $data);  

    }//index
    
    
   
     public function popupform()
    {

        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
            $this->form_validation->set_rules('emailiduser', 'Email Id User', ' trim|required|min_length[4]|xss_clean');
	    $this->form_validation->set_rules('phnouser', 'Phone No User', 'trim|required|min_length[4]|max_length[10]|xss_clean');	    
	    
	    $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
             
		
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
                    'emailiduser' => $this->input->post('emailiduser'),
		    'phnouser' => $this->input->post('phnouser'),
		    'entered_date' => date("Y-m-d"),		   
                );
                //if the insert has returned true then we show the flash message
               
		if($this->articale_model->store_visiteduser($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }	    
	    
	    }	
    
	}
	redirect('frontend/home');
    
    }//index
    
    
public function contactus()
{
	
	if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
            $this->form_validation->set_rules('username', 'Your Name', ' trim|required|min_length[2]|xss_clean');
	    $this->form_validation->set_rules('emailid', 'Email Id', ' trim|required|min_length[4]|valid_email|xss_clean');
	    $this->form_validation->set_rules('subject', 'Subject', 'trim|required|min_length[2]|xss_clean');	    
	    $this->form_validation->set_rules('message', 'Message', 'trim|required|min_length[2]|xss_clean');
	    
	    $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
             
		
            //if the form has passed through the validation
            if ($this->form_validation->run())
		{
			$data_to_store = array(
			'emailiduser' => $this->input->post('username'),
			'emailid' => $this->input->post('emailid'),
			'subject' => $this->input->post('emailid'),
			'message' => $this->input->post('emailid'),
			'entered_date' => date("Y-m-d"),		   
			);
			//if the insert has returned true then we show the flash message
               
		
		
			$config = Array(
			  'protocol' => 'smtp',
			  'smtp_host' => 'ssl://smtp.googlemail.com',
			  'smtp_port' => 465,
			  'smtp_user' => 'sawantshridhar460@gmail.com', // change it to yours
			  'smtp_pass' => 'shri23*sks.l', // change it to yours
			  'mailtype' => 'html',
			  'charset' => 'iso-8859-1',
			  'wordwrap' => TRUE
				);

			      $message = '';
			      $this->load->library('email', $config);
			      $this->email->set_newline("\r\n");
			      $this->email->from('shri@gmail.com'); // change it to yours
			      $this->email->to('sawantshridhar460@gmail.com');// change it to yours
			      $this->email->subject('Contact by website of Parivatarnacha watsaru.');
			      $this->email->message($message);
			      if($this->email->send())
			     {
				if($this->homemenu_model->store_contactusers($data_to_store))
				{
					$data['flash_message'] = TRUE; 
		                }else{
		                    $data['flash_message'] = FALSE; 
		                }
			     }
			     else
			    {
			     show_error($this->email->print_debugger());
			    }

			
	    
		}	
    
	}
	
	
	$data['main_content'] = 'frontend/contactus';
        $this->load->view('frontendincludes/template', $data); 
    
    }//index
    
    public function subscribe()
    {

        //all the posts sent by the view
	
	 
        $data['articale'] = $this->articale_model->get_articale_by_id($id);
	 
        //load the view
        $data['main_content'] = 'frontend/subscribe';
        $this->load->view('frontendincludes/template', $data);  

    }//index
    
     public function show()
    {

        //all the posts sent by the view
	 $id = $this->uri->segment(4);
	 
        $data['articale'] = $this->articale_model->get_articale_by_id($id);
	$data['dispdata'] = $this->homemenu_model->get_homedispl_disp();
	 
        //load the view
        $data['main_content'] = 'frontend/articalesingle';
        $this->load->view('frontendincludes/template', $data);  

    }//index
    
    
    
     public function articalecategory()
    {

        //all the posts sent by the view
	$id = $this->uri->segment(4);
	 
        $data['articalecategory'] = $this->articale_model->get_articalecategory_id($id);
	$data['dispdata'] = $this->homemenu_model->get_homedispl_disp();
	 
        //load the view
        $data['main_content'] = 'frontend/articalesingle';
        $this->load->view('frontendincludes/template', $data);  

    }//index
    

    
     public function visituser()
    {
    
	if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
            $this->form_validation->set_rules('emailiduser', 'Email Id User', ' trim|required|min_length[4]|xss_clean');
	    $this->form_validation->set_rules('phnouser', 'Phone No User', 'trim|required|min_length[4]|max_length[10]|xss_clean');	    
	    
	    $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
             
		
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
                    'emailiduser' => $this->input->post('emailiduser'),
		    'phnouser' => $this->input->post('phnouser'),
		    'entered_date' => date("Y-m-d"),		   
                );
                //if the insert has returned true then we show the flash message
               
		if($this->articale_model->store_visiteduser($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }	    
	    
	    }	
    
	}
	$this->load->view('frontend/coverpage',$data); 
    
    }
    
    
    public function add()
    {
        //if save button was clicked, get the data sent via post
	
	//$this->output->enable_profiler(TRUE);
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
            $this->form_validation->set_rules('articletitle', 'Article Title', ' trim|required|min_length[4]|xss_clean');
	    $this->form_validation->set_rules('articlecontent', 'Article Content', 'trim|required|min_length[4]|xss_clean');
	    $this->form_validation->set_rules('artpubdate', 'Article Publish date', 'trim|required|xss_clean');	    
	    $this->form_validation->set_rules('authorname', 'Author Name', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('status', 'Article Status', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('msg', 'Short Message', 'trim|required|xss_clean');
	       
	    
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            
	    $pubdate= date("Y-m-d", strtotime($this->input->post('artpubdate')));
		
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
                    'articletitle' => $this->input->post('articletitle'),
		    'articlecontent' => $this->input->post('articlecontent'),
		    'artpubdate' => $pubdate,
		    'authorname' => $this->input->post('authorname'),
		    'status' => $this->input->post('status'),
		    'msg' => $this->input->post('msg'),		    
		    'entered_date' => date("Y-m-d"),
		    'entered_name' => $this->session->userdata('user_name'),
		   
                );
                //if the insert has returned true then we show the flash message
               
		if($this->articale_model->store_articale($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }
		
            }

        }
        //load the view
        $data['main_content'] = 'admin/articale/add';
        $this->load->view('includes/template', $data);  
    }       


    /**
    * Delete product by his id
    * @return void
    */
    public function delete()
    {
        //product id 
        $id = $this->uri->segment(4);
        $this->articale_model->delete_articale($id);
        redirect('admin/articale');
    }//edit

}