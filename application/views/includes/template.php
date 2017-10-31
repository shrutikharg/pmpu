<?php 


$useradmintype=$this->session->userdata('group_user');

if($useradmintype=='6')
{
	$this->load->view('includes/companyadminheader'); 
}
elseif($useradmintype=='7')
{
	
	
		$this->load->view('includes/employeeheader'); 
		//$this->load->view('includes/videoemployeeheader');
	
}

?>

<?php $this->load->view($main_content); ?>

<?php

if($useradmintype=='6')
{
	//echo 'added';
	$this->load->view('includes/companyfooter'); 
}
elseif($useradmintype=='7')
{
	
	$functname= $this->uri->segment(3); 
	if($functname==='takecourses')
	{
		$this->load->view('includes/empfooter');
	}
	else
	{
		$this->load->view('includes/empfooter'); 
	}
}

?>