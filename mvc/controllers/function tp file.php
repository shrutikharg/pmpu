//product id 
        $id = $this->uri->segment(4);
		
		$userid=$this->session->userdata('id');
		
 
        $data['error'] = '';    //initialize image upload error array to empty
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '1000';

        $this->load->library('upload', $config);
			echo 'hello to see';

        // If upload failed, display error
        //if (!$this->upload->do_upload()) 
		//{
       //     $data['error'] = $this->upload->display_errors();
       // } 
		//else 
		/*
		{
            $file_data = $this->upload->data();
            $file_path =  './uploads/'.$file_data['file_name'];
            
			$length =4;
				
            if ($this->csvimport->get_array($file_path)) 
			{
                $csv_array = $this->csvimport->get_array($file_path);
                foreach ($csv_array as $row) 
				{
				echo $randomString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
				echo $randdate=substr(str_shuffle("0123456789"), 0, $length);
				echo "<br/>";echo "<br/>";
				echo $stringpass=$second.$randomString.$randdate;
				echo "<br/>";echo "<br/>";
                    $insert_data = array(					 
					'user_name'=>$row['email'],
                    'email'=>$row['email'],
					'password'=>md5($stringpass),
                    );
                    $this->companycoursesassign_model->insert_csv($insert_data);
					
					
                }
                $this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
                //redirect(base_url().'csv');
                echo "<pre>"; print_r($insert_data);
            }
		}
		*/