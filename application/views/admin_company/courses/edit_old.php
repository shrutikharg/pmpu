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
     
                               if($updated){
      //flash messages

          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>'.$query_status;
              echo '</div>'; 
        }
      ?>
						<!--=== Inline Tabs ===-->
				<div class="row">
					<div class="col-md-12">
                                            <br/>
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
										<div class="col-md-10"><input type="text" class="form-control" id="name" name="name" placeholder="Enter course name"  data-rule-required="true"  data-msg-required="Please enter course name." value="<?php echo $courses[0]['name']; ?>" /></div>
									</div>
									
									
									<div class="form-group">
										<label class="col-md-2 control-label">Author</label>
										<div class="col-md-10"><input type="text" class="form-control"  name="courseby"  value="<?php echo $courses[0]['course_by']; ?>"  placeholder="Enter Author name"  data-rule-required="true"  data-msg-required="Please enter Author name" /></div>
									</div>
										<div class="form-group">
										<label class="col-md-2 control-label">Course Description <br></label>
										<div class="col-md-10"><textarea class="form-control"  name="description" placeholder="(max 200 words)" cols="5" rows="3"><?php echo $courses[0]['description']; ?></textarea></div>
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
				        $options [$row['id']] = $row['name'];
				        $select= $row['id'] ; 
				    }else{
				        $options [$row['id']] = $row['name'];
				    }
				}
				//var_dump($options);
				//var_dump($select);
				echo form_dropdown('subcategory' , $options , $select);
				?>	</div>
									</div>
									
                                                             <div class="form-group" style="display:none;">
                                                                <div class="col-md-10"><input type="text"  name="course_id" class="form-control" value="<?php echo $course_id; ?>" ></div>
										
										
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
				
						
					</div>
				<!-- /Inline Tabs -->
				</div> <!-- /.row -->
				<!-- /Page Content -->
			</div>
			<!-- /.container -->


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/thumbnail/jquery-smartvimeoembed.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/thumbnail/local.js"></script>