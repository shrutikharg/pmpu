<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/thumbnail/css/jquery-smartvimeoembed.css" type="text/css" /> 
    <style>
     
    
   
  #drop_zone {
      border: 2px dashed #bbb;
      -moz-border-radius: 5px;
      -webkit-border-radius: 5px;
      border-radius: 5px;
      padding: 25px;
      text-align: center;
      font: 20pt bold 'Helvetica';
      color: #bbb;
    }
    
    </style>
   <div id="content">
	<div class="container">
	<div class="row">
	<div class="col-md-12">
				
   <!--- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">  -->
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin_company"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li>
          <a href="<?php echo site_url("admin_company").'/'.$this->uri->segment(2); ?>">
            <?php echo ucfirst($this->uri->segment(2));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li class="active">
          <a href="#">New</a>
        </li>
      </ul>
      
      <!--<div class="page-header">
        <h2>
          Adding <?php //echo ucfirst($this->uri->segment(2));?>
        </h2>
      </div>-->

    <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> courses updated with success.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
      ?>
						<!--=== Inline Tabs ===-->
				<div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h2><i class="icon-reorder"></i>&nbsp;&nbsp;Updating the course</h2>
							</div>
							<div class="widget-content">
	<?php
      //form data
      $attributes = array('class' => 'form-horizontal', 'id' => '');
		//form validation
		echo validation_errors();	  
		echo form_open_multipart('admin_company/courses/update/'.$this->uri->segment(4).'', $attributes);     
      ?>
									<div class="alert fade in alert-danger" style="display: none;">
					<i class="icon-remove close" data-dismiss="alert"></i>
					Enter course name.
				</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Course name</label>
										<div class="col-md-10"><input type="text" class="form-control" id="" name="name" placeholder="Enter course name"  data-rule-required="true"  data-msg-required="Please enter course name." value="<?php echo $courses[0]['course_name']; ?>" /></div>
									</div>
									<div class="alert fade in alert-danger" style="display: none;">
					<i class="icon-remove close" data-dismiss="alert"></i>
					Enter course Sub Title.
				</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Course Sub Title</label>
										<div class="col-md-10"><input type="text" class="form-control" name="subtitle" value="<?php echo $courses[0]['course_subtitle']; ?>" placeholder="Enter Course Sub Title"  data-rule-required="true"  data-msg-required="Please enter Course Sub Title" /></div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Author</label>
										<div class="col-md-10"><input type="text" class="form-control"  name="courseby"  value="<?php echo $courses[0]['course_by']; ?>"  placeholder="Enter Author name"  data-rule-required="true"  data-msg-required="Please enter Author name" /></div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Course requirements</label>
										<div class="col-md-10"><input type="text" class="form-control" name="requirements" placeholder="Enter Course requirements"  data-rule-required="true"  value="<?php echo $courses[0]['course_requirements']; ?>"  data-msg-required="Please enter Course requirements" /></div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Course price</label>
										<div class="col-md-10"><input type="text" class="form-control" name="price" value="<?php echo $courses[0]['course_price']; ?>"  placeholder="Enter Course price"  data-rule-required="true"  data-msg-required="Please enter Course price" /></div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Course Validity</label>
										<div class="col-md-10"><input type="text" class="form-control" name="validity"  value="<?php echo $courses[0]['course_validity']; ?>" placeholder="Enter Course validity"  data-rule-required="true"  data-msg-required="Please enter Course validity" /></div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Course Description <br></label>
										<div class="col-md-10"><textarea class="form-control" name="textarea"  name="description" placeholder="(max 200 words)" cols="5" rows="3"><?php echo $courses[0]['course_description']; ?></textarea></div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Sub-Category <br></label>
										<div class="col-md-6">	<?php
				
				$options = array();
				$select = array();
				$selected=$courses[0]['subcategory_id'];
				foreach($subcategory as $row)
				{
				    /////////Your Condition ////////////
				    if($row['id'] == $selected)
				    {            
				        $options [$row['id']] = $row['subcategory_name'];
				        $select= $row['id'] ; 
				    }else{
				        $options [$row['id']] = $row['subcategory_name'];
				    }
				}
				//var_dump($options);
				//var_dump($select);
				echo form_dropdown('subcategory' , $options , $select);
				?>	</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Course Goals <br></label>
										<div class="col-md-10"><textarea class="form-control" name="goals" placeholder="(max 200 words)" cols="5" rows="3"><?php echo $courses[0]['course_goals']; ?></textarea></div>
									</div>
								
								<!--	<div class="form-group">
										<label class="col-md-2 control-label">Course Video Thumbnail:</label>
									<div class="col-md-10"> <img width="340px"  src="http://placehold.it/640x360" class="video-thumb" data-vimeo-id="<?php echo $courses[0]['course_videoid']; ?>" /></div>
	
	</div>-->
 
    	
    	 <div class="form-actions">										
					<button type="reset" class="btn">Reset</button>
					<button type="submit" class="btn btn-primary">Submit</button>
									</div>
								<?php echo form_close(); ?>
								
							 <!-- /.widget-content -->
						</div> <!-- /.widget .box -->
					</div> <!-- /.col-md-12 -->
				</div> <!-- /.row -->
				<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i>View All Chapters</h4>								
							</div>

	<div class="res_table">
		<div class="res_table-head">
           <div class="column" data-label="Sr no"> Sr no</div>
           <div class="column" data-label="Course name"> Course name</div>
           <div class="column" data-label="Course price"> Course Price</div>
           <div class="column" data-label="Chapter name"> Chapter name</div>
           <div class="column" data-label="Chapter thumbanil"> Chapter thumbanil</div>
		   <div class="column" data-label="Course status"> Course status</div>
           <div class="column" data-label="action">Action</div>
       </div>     
            <tbody>
              <?php
			  //var_dump($chapters);
              foreach($chapters as $row)
              {
			    echo '<div class="res_row">';  
				$chapters[''][''];				
				if($row['chapterstatus'] == "N")
				{
					$clstr='deactivate';
				}
				else
				{
					$clstr='';
				}
					$chapid=$row['chapterid'];
				{
	           
	echo '<div class="column '.$clstr.'" data-label="Sr no">'.$row['chapterid'].'</div>';
	echo '<div class="column '.$clstr.'" data-label="Course name">'.$row['coursename'].'</div>';
	echo '<div class="column '.$clstr.'" data-label="Course price">'.$row['courseprice'].'</div>';
	echo '<div class="column '.$clstr.'" data-label="Chapter name">'.$row['chaptername'].'</div>';
	echo '<div class="column '.$clstr.'" data-label="Chapter thumbanil">'.$row['chaptervideo'].'</div>';					
echo '<div class="column '.$clstr.'" data-label="Course status">'.$row['chapterstatus'].'</div>';
echo '<div class="column '.$clstr.'" data-label="action">
	                  <a href="'.site_url("admin_company").'/chapters/update/'.$row['chapterid'].'" class="btn" onclick="return false;">view & edit</a>';  
						echo '<a href="'.site_url("admin_company").'/chapters/delete/'.$row['chapterid'].'" class="btn btn-primary">Delete chapter</a></div>'; 
					/*
					if($row['chapterstatus']== "N")
					{
						echo '<div class="column '.$clstr.'" data-label="action">
	                  <a href="'.site_url("admin_company").'/chapters/update/'.$row['chapterid'].'" class="btn" onclick="return false;">view & edit</a>';  
						echo '<a href="'.site_url("admin_company").'/chapters/activate/'.$row['chapterid'].'" class="btn btn-primary">Active chapter</a>'; 
						//echo '<a href="'.site_url("admin_company").'/chapters/activate/'.$row['chapterid'].'" class="btn btn-primary">Publish</a></div>';	
					}
					else
					{
						echo '<div class="column '.$clstr.'" data-label="action">
	                  <a href="'.site_url("admin_company").'/chapters/update/'.$row['chapterid'].'" class="btn btn-info" >view & edit</a>';  
						echo '<a href="'.site_url("admin_company").'/chapters/delete/'.$row['chapterid'].'" class="btn btn-warning">Delete chapter</a>';
						//echo '<a href="'.site_url("admin_company").'/chapters/activate/'.$row['chapterid'].'" class="btn btn-primary">Publish</a></div>';	
					} 	*/          
	                echo '</div>';
				}
				
              }
              ?>       
            </tbody>
          </table>

    <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

							</div>
						
						</div>
						
					</div>
				<!-- /Inline Tabs -->
				</div> <!-- /.row -->
				<!-- /Page Content -->
			</div>
			<!-- /.container -->


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/thumbnail/jquery-smartvimeoembed.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/thumbnail/local.js"></script>