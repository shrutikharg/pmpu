<div id="content">
	<div class="container">


      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("employee_company"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li class="active">
          <?php echo ucfirst($this->uri->segment(2));?>
        </li>
      </ul>

      <div class="page-header users-header">
        <h2>
          Assigned <?php echo ucfirst($this->uri->segment(2));?>
    
        </h2>
      </div>
      
      <div class="row">
        <div class="span12 columns">
          <div class="well">
            <?php
		      //flash messages
		    if($this->session->flashdata('flash_message'))
			{
		        if($this->session->flashdata('flash_message') == 'Retired')
		        {
		          echo '<div class="alert alert-success">';
		            echo '<a class="close" data-dismiss="alert">�</a>';
		            echo '<strong>Well done!!</strong> Courses Retired with success now its not to assign anyone.';
		          echo '</div>';       
		        }
				else if($this->session->flashdata('flash_message') == 'Added')
		        {
		          echo '<div class="alert alert-success">';
		            echo '<a class="close" data-dismiss="alert">�</a>';
		            echo '<strong>Well done!</strong> Chapter Scheduled with success.';
		          echo '</div>';       
		        }				
				else
				{
		          echo '<div class="alert alert-error">';
		            echo '<a class="close" data-dismiss="alert">�</a>';
		            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
		          echo '</div>';          
		        }
		    }			 
			  
		    ?>
	<div class="widget-content">
		<?php  

        $attributes = array('class' => 'form-horizontal row-border', 'id' => 'myform');    
			$options_category = array('name'=>'Course Name'); 		  
           // echo form_open('employee_company/courses', $attributes);			
			echo '<div class="form-group">';
			echo '<label class="col-md-2   control-label">Search:</label>';
			
			echo '<div class="col-md-3">';			  
			  $data_search = array(
              'name'        => 'search_string',
              'id'          => 'search_string',              
              'class'       => 'form-control',
			  'placeholder' => 'Enter course name',
				);
			  echo form_input($data_search, $search_string_selected);
			echo '</div>';
			
			echo '<label class="col-md-2   control-label">Order by:</label>';			
            //echo form_input('search_string', $search_string_selected);
			echo '<div class="col-md-2" style="padding-left:0px !important; padding-right:0px !important;">';
            echo form_dropdown('order', $options_category, $order, 'class="form-control"');
			echo '</div>';
			
              $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Go');
			
			echo '<div class="col-md-2" style="padding-left:0px !important; padding-right:0px !important;">';
              $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
              echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="form-control"');
			echo '</div>';
              echo form_submit($data_submit);
			echo '</div>';
            echo form_close();
            ?>
								
		</div>
    </div>

         <?php
          //var_dump($this->session->userdata);
          $currentuserdt=$this->session->userdata('empuser_name');
         
         if($currentuserdt==='mpauser@gmail.com')
         {
         	//echo "<h2>Added see this</h2>";
         ?>
         
         				
					<!-- /Statboxes -->
					<!--=== Normal ===-->
					<div class="row" class="Training_videos">
						<h3 style="text-align: center; font-size: 36px; ">INTERNAL TRAINING</h3>
						<div class="banner">
						<img src="<?php echo base_url(); ?>assets/mpaimages/MPA_banner.jpg" alt="Mpa Banner" />
		
	    </div>
	    <br/>
					<h1 style="text-align: center; !important">COURSES</h1>				
					<div class="col-md-4">
						<div class="widget box">
							<div class="widget-header">
								<h4>Investigation and Prosecution of Economic Offences 1</h4>								
							</div>
							<div class="widget-content">
						<img src="<?php echo base_url(); ?>assets/mpaimages/Investigation_prosecution_ecommerce_1.jpg" width="400"  /><br><br>
                                
                                <table width="100%" border="0" cellspacing="2" cellpadding="2">
								  <tbody>
								  
								  <tr>
									<td>
										                                        	
                                    								                                        	
										
									</td>
								  </tr>
								</tbody></table>

							</div>
							<h5 style="font-size: 15px;
    color: #ffffff;
    background: #e1261c;
    text-align: center;
    margin: 0px;
    opacity: 0.7;
    -webkit-box-shadow: 3px 2px 11px -4px rgba(0, 0, 0, 0.75);
    -moz-box-shadow: 3px 2px 11px -4px rgba(0, 0, 0, 0.75);
    box-shadow: 3px 2px 11px -4px rgba(0, 0, 0, 0.75);
    -webkit-box-shadow: 3px 2px 11px -4px rgba(0, 0, 0, 0.75);
    -moz-box-shadow: 3px 2px 11px -4px rgba(0, 0, 0, 0.75);
    box-shadow: 3px 2px 11px -4px rgba(0, 0, 0, 0.75);
    padding: 5px;">Speaker - MR. Gyan Barah</h5>
						</div>
					</div>
                    
									
					<div class="col-md-4">
						<div class="widget box">
							<div class="widget-header">
								<h4>Investigation and Prosecution of Economic Offences 2</h4>								
							</div>
							<div class="widget-content">
								<img src="<?php echo base_url(); ?>assets/mpaimages/Investigation_prosecution_ecommerce_2.jpg" width="400"  /><br><br>
                                   
                                <table width="100%" border="0" cellspacing="2" cellpadding="2">
								  <tbody>
								  <tr>
									<td>
										                                        	
                                    							    
										
									</td>
								  </tr>
								</tbody></table>

							</div>
							<h5 style="font-size: 15px;
    color: #ffffff;
    background: #e1261c;
    text-align: center;
    margin: 0px;
    opacity: 0.7;
    -webkit-box-shadow: 3px 2px 11px -4px rgba(0, 0, 0, 0.75);
    -moz-box-shadow: 3px 2px 11px -4px rgba(0, 0, 0, 0.75);
    box-shadow: 3px 2px 11px -4px rgba(0, 0, 0, 0.75);
    -webkit-box-shadow: 3px 2px 11px -4px rgba(0, 0, 0, 0.75);
    -moz-box-shadow: 3px 2px 11px -4px rgba(0, 0, 0, 0.75);
    box-shadow: 3px 2px 11px -4px rgba(0, 0, 0, 0.75);
    padding: 5px;">Speaker - MR. Gyan Barah</h5>
						</div>
					</div>
					<div class="col-md-4">
						<div class="widget box">
							<div class="widget-header">
								<h4>Investigation and Prosecution of Economic Offences 3</h4>								
							</div>
							<div class="widget-content">
								<img src="<?php echo base_url(); ?>assets/mpaimages/Investigation_prosecution_ecommerce_3.jpg" width="400"  /><br><br>
                                   
                                <table width="100%" border="0" cellspacing="2" cellpadding="2">
								  <tbody>
								  
								</tbody></table>

							</div>
							<h5 style="font-size: 15px;
    color: #ffffff;
    background: #e1261c;
    text-align: center;
    margin: 0px;
    opacity: 0.7;
    -webkit-box-shadow: 3px 2px 11px -4px rgba(0, 0, 0, 0.75);
    -moz-box-shadow: 3px 2px 11px -4px rgba(0, 0, 0, 0.75);
    box-shadow: 3px 2px 11px -4px rgba(0, 0, 0, 0.75);
    -webkit-box-shadow: 3px 2px 11px -4px rgba(0, 0, 0, 0.75);
    -moz-box-shadow: 3px 2px 11px -4px rgba(0, 0, 0, 0.75);
    box-shadow: 3px 2px 11px -4px rgba(0, 0, 0, 0.75);
    padding: 5px;">Speaker - MR. Gyan Barah</h5>
						</div>
					</div>
                    
									
					
                    
									
					
                    
											</div>
<br/><br/>											
<div class="row">
					<!--=== Table with Footer ===-->
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4>CURRICULUM</h4>
								
							</div>
							<div class="widget-content">
								<table class="table table-hover table-striped table-bordered table-highlight-head">
									<thead>
										<tr>
											<th width="15%">No of Videos</th>
											<th width="38%">Topics</th>
											<th width="23%" class="hidden-xs">Duration</th>
											<th width="24%">Watch</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td><a href="#">Investigation and Prosecution of Economic Offences 1</a></td>
											 <td class="hidden-xs"><button class="btn btn-xs btn-inverse">00:15:58</button></td>
										  <td><a href="#"><button class="btn btn-xs btn-success">Watch</button></a></td>
										</tr>
										<tr>
											<td>2</td>
											<td><a href="#">Investigation and Prosecution of Economic Offences 2</a></td>
											 <td class="hidden-xs"><button class="btn btn-xs btn-inverse">00:13:33</button></td>
										  <td><button class="btn btn-xs btn-success">Watch</button></td>
										</tr>
										<tr>
											<td>3</td>
											<td><a href="#">Investigation and Prosecution of Economic Offences 3</a></td>
											 <td class="hidden-xs"><button class="btn btn-xs btn-inverse">00:12:24</button></td>
										  <td><button class="btn btn-xs btn-success">Watch</button></td>
										</tr>
										
									</tbody>
								</table>
						  </div>
						</div>
					</div>
					<!-- /Table with Footer -->
				</div>											
				<!-- /Normal -->
         	
         <?php
         }
         else
         {
         
         ?>
           <div class="row">

<div class="col-md-12">
<div class="widget box">
<div class="widget-header">
<h4><i class="icon-reorder"></i> You Have These Course</h4>
</div>
<div class="widget-content">
 <?php
			  //var_dump($courses);
              foreach($courses as $row)
              {
?>

<div class="row">
<div class="col-md-6">
<?php
if(!isset($row['course_image']))
{
?>
<img src="<?php echo base_url();?>assets/course_image/default_course_new.png" >
<?php
}else
{
?>
<img src="<?php echo base_url();?>assets/course_image/<?php echo $row['course_image'];?>" >
<?php
}
?>
 <br><br>
<div class="well">
<span class="show text-16 textb">Price</span> 
                                       <span class="sitedc text-40">Total courseprice  <?php echo '&nbsp'.$row['course_name']; ?> </span>
                                       <!--<span class="sitedc text-40">  / <span style="font-family:rupee;">R</span>12444.00</span>-->
                <?php
		//echo '<a href="'.site_url("employee_company").'/courses/satartcourse/'.$row['courseid'].'" class="btn btn-success btn-block">Start Your Course Now </a>';  ?>
<!--<a href="../course?course=12" class="btn btn-success btn-block">Start Your Course Now</a>--><br>

<?php
	echo '<a href="'.site_url("employee_company").'/topiclist/'.$row['courseid'].'" class="btn btn-success btn-block">View All Topics </a>'; ?>
	
<!--<a href="course_topics?course=12" class="btn btn-success btn-block">View All Topics</a>--><br>
<!---<button class="btn btn-sm dropdown-toggle" data-toggle="dropdown" onclick="showStream('http://www.coolacharya.com/course?course=12','http://www.coolacharya.com/images/CourseImages/sanskritforeveryone.jpg','Course By: Minal Avachat','Sanskrit for Everyone');"><i class="icol-clipboard-text"></i> Share This Course</button>--->
</div> <!-- /.well -->	
</div> <!-- /.col-md-6 -->

</div> <!-- /.row -->
</div> <!-- /.widget-content -->
</div> <!-- /.widget .box -->
<?php
}
?>
</div> <!-- /.col-md-12 -->
         
         <?php
         	echo "<h2>other users</h2>";
         }
        
         ?>
         
		
	