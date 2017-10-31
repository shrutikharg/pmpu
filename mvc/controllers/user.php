<?php

class User extends CI_Controller {


    /**
    * Check if the user is logged in, if he's not, 
    * send him to the login page
    * @return void
    */	
	function index()
	{
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		if($this->session->userdata('is_logged_in')){
			redirect('admin/products');
        }else{
        	$this->load->view('admin/login');	
        }
	}

    /**
    * encript the password 
    * @return mixed
    */	
    function __encrip_password($password) {
        return md5($password);
    }	

    /**
    * check the username and the password with the database
    * @return void
    */
	function validate_credentials()
	{/*	

		$this->load->model('Users_model');

		$user_name = $this->input->post('user_name');
		$password = $this->__encrip_password($this->input->post('password'));

		$is_valid = $this->Users_model->validate($user_name, $password);
		$userdetails = $this->Users_model->select_by_username($user_name,$password);
		$userappthemedefault = $this->Users_model->select_by_appthemeefault();
		
		if($is_valid && ($user_name=='admin'))
		{			
			
			$data = array(
				'user_name' => $user_name,
				'is_logged_in' => true,
				'firstname'=>$userdetails[0]['first_name'],
				'id'=>$userdetails[0]['id'],
				
			);
			$this->session->set_userdata($data);
			redirect('admin/products');
		}
		elseif($is_valid && ($user_name!='admin'))
		{
			$userapptheme = $this->Users_model->select_by_apptheme($userdetails[0]['id']);
			var_dump($userapptheme);
			//exit;
                        
			if(isset($userapptheme[0]['id']))
			{
                                                       
				$data = array(
				'user_name' => $user_name,
				'is_logged_in' => true,
				'firstname'=>$userdetails[0]['first_name'],
				'id'=>$userdetails[0]['id'],
				'logocomp'=>$userapptheme[0]['theme_logo'],
				'bgappimg'=>$userapptheme[0]['theme_bg_image'],
				'csstheme'=>$userapptheme[0]['theme_color_scheme'],
				'customcss'=>'Y'
				);
				$this->session->set_userdata($data);
			}
			else
			{
				$data = array(
				'user_name' => $user_name,
				'is_logged_in' => true,
				'firstname'=>$userdetails[0]['first_name'],
				'id'=>$userdetails[0]['id'],
				'logocomp'=>$userappthemedefault[0]['theme_logo'],
				'bgappimg'=>$userappthemedefault[0]['theme_bg_image'],
				'csstheme'=>$userappthemedefault[0]['theme_color_scheme'],
				'customcss'=>'N'
				);
				$this->session->set_userdata($data);
				
			}			
			
			
			//redirect('admin/brandings/addtheme');
		}
		else // incorrect username or password
		{
			$data['message_error'] = TRUE;
			$this->load->view('admin/login', $data);	
		}*/
	}	

    /**
    * The method just loads the signup view
    * @return void
    */
	function signup()
	{
		$this->load->view('admin/signup_form');	
	}
	

    /**
    * Create new user and store it in the database
    * @return void
    */	
	function create_member()
	{
		$this->load->library('form_validation');
		
		// field name, error message, validation rules
		$this->form_validation->set_rules('first_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('web_address', 'Web Address', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		//$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/signup_form');
		}
		
		else
		{			
			$this->load->model('Users_model');
			
			if($query = $this->Users_model->create_member())
			{
				$this->load->view('admin/signup_successful');			
			}
			else
			{
				$this->load->view('admin/signup_form');			
			}
		}
		
	}
	
	/**
    * Destroy the session, and logout the user.
    * @return void
    */		
	function logout()
	{
		$this->session->sess_destroy();
		redirect('admin_company/login');
	}

}