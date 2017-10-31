<?php
class Admin_companybrandings extends CI_Controller {
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		$this->load->model('companybrandings_model');
        $this->load->model('companycmspage_model');
		$this->load->model('companyplantable_model');
		
        if(!$this->session->userdata('is_logged_in')){
            redirect('admin_company/login');
        }
    }
 

	public function addtheme()
    {
        //$this->output->enable_profiler(TRUE);		
		$userid=$this->session->userdata('id');	
		$usernm=$this->session->userdata('user_name');
		//if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
            //$this->form_validation->set_rules('theme_logo', 'File', 'trim|xss_clean');
			//$this->form_validation->set_rules('theme_bg_image', 'File', 'trim|xss_clean');
            //$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            
			
            //if the form has passed through the validation
            //if ($this->form_validation->run())
			if($this->input->post('usertheme')=='Y')
            {
				
               echo 'no';
			}
				$file_element_name ='theme_logo';
				$data['imageupload'] = $this->uploadImagelogo($file_element_name);
				$file_element_bg ='theme_bg_image';
				$data['imagebgupload'] = $this->uploadImagelogo($file_element_bg);
				
				
				if (!empty($data['imageupload']['file_name'])) 
				{
					
					echo $imagelogo=$data['imageupload']['file_name'];
				}
				else
				{
					echo $imagelogo=$this->input->post('theme_logodata');
					
				}
				if (!empty($data['imagebgupload']['file_name']))
				{
					echo $imagebgimage=$data['imagebgupload']['file_name'];
					
				}
				else
				{
					echo $imagebgimage=$this->input->post('theme_bgimage');
					
				}
				
				$data_to_store = array(
				    'theme_compname' => $this->input->post('theme_compname'),
                    'theme_logo' => $imagelogo,
					'theme_bg_image' => $imagebgimage,
					'theme_color_scheme' => $this->input->post('color')					
                );
			//var_dump($data_to_store);			
			//exit;
                //if the insert has returned true then we show the flash message
            if($this->companybrandings_model->store_theme_detailsofuser($data_to_store))
				{
                    $data['flash_message'] = TRUE; 
                }else
				{
                    $data['flash_message'] = FALSE; 
                }
        }
		
        //load the view
		$data['themeset'] = $this->companybrandings_model->get_themeset_default();
		$data['themesetuser'] = $this->companybrandings_model->get_themeset_user($userid);
		$data['footerdata']= $this->companycmspage_model->list_cmspage($userid,$usernm);

        $data['main_content'] = 'admin_company/brandings/addtheme';
        $this->load->view('includes/template', $data);  
    }
	
	public function startpage_app()
    {
        //$this->output->enable_profiler(TRUE);		
		$userid=$this->session->userdata('id');	
		$usernm=$this->session->userdata('user_name');
		
		$data['hostingdetails']=$this->companyplantable_model->plantabledetails();		
		$data['footerdata']= $this->companycmspage_model->list_cmspage($userid,$usernm);
        $data['main_content'] = 'admin_company/brandings/startpageapp';
        $this->load->view('includes/template', $data);  
	}
	public function uploadImagelogo($file_element_name)
	{
	    
		$config['upload_path']      = './assets/user_theme/';
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