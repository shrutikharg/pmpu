<?php
class Admin_brandings extends CI_Controller {
 
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
		$this->load->model('brandings_model');

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
        $category_id = $this->input->post('category_id');        
        $search_string = $this->input->post('search_string');        
        $order = $this->input->post('order'); 
        $order_type = $this->input->post('order_type'); 

        //pagination settings
        $config['per_page'] = 15;
        $config['base_url'] = base_url().'admin/products';
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
        if($category_id !== false && $search_string !== false && $order !== false || $this->uri->segment(3) == true){ 
           
            /*
            The comments here are the same for line 79 until 99

            if post is not null, we store it in session data array
            if is null, we use the session data already stored
            we save order into the the var to load the view with the param already selected       
            */

            if($category_id !== 0){
                $filter_session_data['category_selected'] = $category_id;
            }else{
                $category_id = $this->session->userdata('category_selected');
            }
            $data['category_selected'] = $category_id;

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
            $this->session->set_userdata($filter_session_data);

            //fetch category data into arrays
            $data['category'] = $this->category_model->get_category();

            $data['count_products']= $this->products_model->count_products($category_id, $search_string, $order);
            $config['total_rows'] = $data['count_products'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['products'] = $this->products_model->get_products($category_id, $search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['products'] = $this->products_model->get_products($category_id, $search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['products'] = $this->products_model->get_products($category_id, '', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['products'] = $this->products_model->get_products($category_id, '', '', $order_type, $config['per_page'],$limit_end);        
                }
            }

        }else{

            //clean filter data inside section
            $filter_session_data['category_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['category_selected'] = 0;
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['category'] = $this->category_model->get_category();
            $data['count_products']= $this->products_model->count_products();
            $data['products'] = $this->products_model->get_products('', '', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_products'];

        }//!isset($category_id) && !isset($search_string) && !isset($order)

        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'admin/products/list';
        $this->load->view('includes/template', $data);  

    }//index

	public function addtheme()
    {
        //$this->output->enable_profiler(TRUE);
		$userid=$this->session->userdata('id');
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
                    'theme_logo' => $imagelogo,
					'theme_bg_image' => $imagebgimage,
					'theme_color_scheme' => $this->input->post('color_scheme')					
                );
			//var_dump($data_to_store);			
			//exit;
                //if the insert has returned true then we show the flash message
                if($this->brandings_model->store_theme_detailsofuser($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }
			
		
        //load the view
		$data['themeset'] = $this->brandings_model->get_themeset_default();
		$data['themesetuser'] = $this->brandings_model->get_themeset_user($userid);
        $data['main_content'] = 'admin/brandings/addtheme';
        $this->load->view('includes/template', $data);  
    }
	
public function add()
{
        //if save button was clicked, get the data sent via post
		//$this->output->enable_profiler(TRUE);
		$file_element_name = 'userfile';
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
	    $this->form_validation->set_rules('product_name', 'Product Name', 'trim|required|min_length[2]|xss_clean');
            $this->form_validation->set_rules('description', 'Description', 'trim|min_length[4]|xss_clean');
	    $this->form_validation->set_rules('generic_name', 'Generic Name', 'trim|required|min_length[4]|xss_clean');
            $this->form_validation->set_rules('avilable_strength', 'Available Strength', 'trim|min_length[1]|xss_clean');	    
            $this->form_validation->set_rules('brand', 'Brand','trim|min_length[1]|xss_clean');
	    $this->form_validation->set_rules('packing', 'Packing','trim|min_length[1]|xss_clean');
            $this->form_validation->set_rules('company_name', 'Company Name','trim|min_length[1]|xss_clean');
	    $this->form_validation->set_rules('origin', 'Origin','trim|min_length[1]|xss_clean');
            $this->form_validation->set_rules('min_order_qty', 'Minimum order quanitity','trim|required|min_length[1]|xss_clean|numeric');	    
            $this->form_validation->set_rules('category_id', 'Select Category', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
		if ($this->form_validation->run())
		{	
                $config['upload_path'] = './productimages/';
		        $config['allowed_types'] ='gif|jpg|png|jpeg|xml';
		        $config['max_size'] = 1024 * 20;
		        $config['encrypt_name'] = TRUE;
		 
		        $this->load->library('upload', $config);
		 
		        if (!$this->upload->do_upload($file_element_name))
		        {
		            $status = 'error';
		            $msg = $this->upload->display_errors('', '');
			    $data['file_name']='';
		        }
			else
		        {
				$data = $this->upload->data();			
			}
				
				$data_to_store = array
				(
		                    'product_name' => $this->input->post('product_name'),				    
		                    'description' => $this->input->post('description'),
				    'generic_name' => $this->input->post('generic_name'),
		                    'product_image' => $data['file_name'],		    
		                    'avilable_strength' => $this->input->post('avilable_strength'), 
		                    'min_order_qty' => $this->input->post('min_order_qty'),                        
		                    'category_id' => $this->input->post('category_id'),		   
		                    'entered_date' => date("Y-m-d"),
				    'entered_name' => $this->session->userdata('user_name')		   
						
		                );				
			
		                //if the insert has returned true then we show the flash message
		                if($this->products_model->store_product($data_to_store))
				{
					
					$txtbox = $_POST['txtbrand'];
					$country = $_POST['txtpacking'];
					$txtbox1 = $_POST['txtcompany'];
					$country1 = $_POST['txtorigin'];
					$id = $this->db->insert_id();	
					for($i=0;$i<count($txtbox);$i++)
					{
						$datasubstore1=array(
						    'brand' => $txtbox[$i],
						    'packing' => $country[$i],
						    'company_name' =>  $txtbox1[$i],
				                    'origin' =>$country1[$i],
						    'category_id' => $this->input->post('category_id'),
						    'productid' => $id,
						    'entered_date' => date("Y-m-d"),
						    'entered_name' => $this->session->userdata('user_name')
						);
						if($this->products_model->store_subproduct($datasubstore1))
						{
							$status='1';
						}else
						{
							$status='0';
						}
					}
					
					 $data['flash_message'] = TRUE; 
		                }else{
				    unlink($data['full_path']);
				    $data['flash_message'] = FALSE; 
				    
		                }
			@unlink($_FILES[$file_element_name]);	
		}
		
			
	}
	//fetch category data to populate the select field
		$data['category'] = $this->category_model->get_category();
		//load the view
		$data['main_content'] = 'admin/products/add';
		$this->load->view('includes/template', $data);
				
}       

    /**
    * Update item by his id
    * @return void
    */
    public function update()
    {
	$id = $this->uri->segment(4);
	
        //if save button was clicked, get the data sent via post
		//$this->output->enable_profiler(TRUE);
		$file_element_name = 'userfile';
		
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
		$data = $this->input->post();
		//var_dump($this->input->post('checklist'));
            //form validation
	    $this->form_validation->set_rules('product_name', 'Product Name', 'trim|required|min_length[2]|xss_clean');
            $this->form_validation->set_rules('description', 'Description', 'trim|min_length[4]|xss_clean');
	    $this->form_validation->set_rules('generic_name', 'Generic Name', 'trim|required|min_length[4]|xss_clean');
            $this->form_validation->set_rules('avilable_strength', 'Available Strength', 'trim|min_length[1]|xss_clean');	    
            $this->form_validation->set_rules('brand', 'Brand','trim|min_length[1]|xss_clean');
	    $this->form_validation->set_rules('packing', 'Packing','trim|min_length[1]|xss_clean');
            $this->form_validation->set_rules('company_name', 'Company Name','trim|min_length[1]|xss_clean');
	    $this->form_validation->set_rules('origin', 'Origin','trim|min_length[1]|xss_clean');
            $this->form_validation->set_rules('min_order_qty', 'Minimum order quanitity','trim|required|min_length[1]|xss_clean|numeric');	    
            $this->form_validation->set_rules('category_id', 'Select Category', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
		if ($this->form_validation->run())
		{	
			$config['upload_path'] = './productimages/';
		        $config['allowed_types'] ='gif|jpg|png|jpeg|xml';
		        $config['max_size'] = 1024 * 20;
		        $config['encrypt_name'] = TRUE;
		 
		        $this->load->library('upload', $config);
		 
		        if (!$this->upload->do_upload($file_element_name))
		        {
		            $status = 'error';
		            $msg = $this->upload->display_errors('', '');
			    $data['file_name']='';
		        }
			else
		        {
				$data = $this->upload->data();			
			}
				
				$data_to_store = array
				(
		                    'product_name' => $this->input->post('product_name'),				    
		                    'description' => $this->input->post('description'),
				    'generic_name' => $this->input->post('generic_name'),
		                    'product_image' => $data['file_name'],		    
		                    'avilable_strength' => $this->input->post('avilable_strength'), 
		                    'min_order_qty' => $this->input->post('min_order_qty'),                        
		                    'category_id' => $this->input->post('category_id'),		   
		                    'entered_date' => date("Y-m-d"),
				    'entered_name' => $this->session->userdata('user_name')		   
						
		                );				
			
		                //if the insert has returned true then we show the flash message
		                if($this->products_model->update_product($id, $data_to_store))
				{
					
					
					
					$txtbox = $_POST['txtbrand'];
					$country = $_POST['txtpacking'];
					$txtbox1 = $_POST['txtcompany'];
					$country1 = $_POST['txtorigin'];
					
					for($i=0;$i<count($txtbox);$i++)
					{
						$datasubstore1=array(
						    'brand' => $txtbox[$i],
						    'packing' => $country[$i],
						    'company_name' =>  $txtbox1[$i],
				                    'origin' =>$country1[$i],
						    'category_id' => $this->input->post('category_id'),
						    'productid' => $id,
						    'entered_date' => date("Y-m-d"),
						    'entered_name' => $this->session->userdata('user_name')
						);
						if($this->products_model->store_subproduct($datasubstore1))
						{
							$status='1';
						}else
						{
							$status='0';
						}
					}
					
					
					
		                }else{
				    unlink($data['full_path']);
				    $data['flash_message'] = FALSE; 
				    
		                }										
				$data['flash_message'] = TRUE; 
			@unlink($_FILES[$file_element_name]);	
		}
		
		//fetch category data to populate the select field
		$data['category'] = $this->category_model->get_category();
		$data['product'] = $this->products_model->get_product_by_id($id);
		$data['subproduct'] = $this->products_model->get_subprddetails($id);
		//load the view
		redirect('admin/products/update/'.$id.'');
			
	}
	
        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //product data 
        $data['product'] = $this->products_model->get_product_by_id($id);
	$data['subproduct'] = $this->products_model->get_subprddetails($id );
        //fetch category data to populate the select field
        $data['category'] = $this->category_model->get_category();
        //load the view
        $data['main_content'] = 'admin/products/edit';
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
        $this->products_model->delete_product($id);
        redirect('admin/products');
    }//edit
    
     public function delete_subproductdetails()
    {
        //product id 
        echo $id = $this->uri->segment(4);
        $this->products_model->delete_subproductdetails($id);
        redirect('admin/products');
    }//edit
	
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
	
	public function resize_image($file_path, $width, $height) 
	{

	    $this->load->library('image_lib');

	    $img_cfg['image_library'] = 'gd2';
	    $img_cfg['source_image'] = $file_path;
	    $img_cfg['maintain_ratio'] = TRUE;
	    $img_cfg['create_thumb'] = TRUE;
	    $img_cfg['new_image'] = $file_path;
	    $img_cfg['width'] = $width;
	    $img_cfg['quality'] = 100;
	    $img_cfg['height'] = $height;

	    $this->image_lib->initialize($img_cfg);
	    $this->image_lib->resize();

	}

}