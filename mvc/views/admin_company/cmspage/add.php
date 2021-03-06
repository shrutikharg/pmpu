   <div id="content">
	<div class="container">
	<div class="row">
	<div class="col-md-12">
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
      if(isset($flash_message)){
        if($flash_message == TRUE)
        {
			
			echo $id_course;
           echo '<div class="alert alert-success">';
           echo '<strong>Well done!</strong> new CMS created with success.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
	  
      ?>
		<?php
		//var_dump($count_cmslimit);
		if($count_cmslimit <= 0)
		{				
		?>	
		<!--=== Inline Tabs ===-->
				<div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h2><i class="icon-reorder"></i>&nbsp;&nbsp;Create the Cms page</h2>
							</div>
							<div class="widget-content">
								<?php
      //form data
      $attributes = array('class' => 'form-horizontal', 'id' => '');
      //form validation
      echo validation_errors();
	  
	echo form_open_multipart('admin_company/cmspage/add', $attributes);
      ?>
		<div class="alert fade in alert-danger" style="display: none;">
			<i class="icon-remove close" data-dismiss="alert"></i>
					Enter Contact Emailid
				</div>
									<div class="form-group">
							<label class="col-md-2 control-label">Contact Emailid</label>
										<div class="col-md-10"><input type="text" class="form-control" id="" name="emailid" placeholder="Enter Contact Emailid"  data-rule-required="true"  data-msg-required="Please enter Contact Emailid." /></div>
									</div>
									
			<div class="alert fade in alert-danger" style="display: none;">
			<i class="icon-remove close" data-dismiss="alert"></i>
					Enter Contact no
				</div>
									<div class="form-group">
							<label class="col-md-2 control-label">Contact no</label>
										<div class="col-md-10"><input type="text" class="form-control" id="" name="contactno" placeholder="Enter Contact no"  data-rule-required="true"  data-msg-required="Please enter Contact no" /></div>
									</div>
									
			<div class="alert fade in alert-danger" style="display: none;">
					<i class="icon-remove close" data-dismiss="alert"></i>
					Enter CMS Page Link1 Name
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Course CMS Page link1 Name</label>
						<div class="col-md-10"><input type="text" class="form-control" name="cmspagelink1_name" placeholder="Enter CMS Page link1 name"  data-rule-required="true"  data-msg-required="Please enter CMS Page link1 name" /></div>
									</div>
									
									
	<div class="alert fade in alert-danger" style="display: none;">
	<i class="icon-remove close" data-dismiss="alert"></i>Enter CMS Page link1</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Course CMS Page link1</label>
						<div class="col-md-10"><input type="text" class="form-control" name="cmspagelink1" placeholder="Enter CMS Page link1"  data-rule-required="true"  data-msg-required="Please enter CMS Page link1" /></div>
									</div>
									
					<div class="form-group">
					<label class="col-md-2 control-label">Enter CMS Page link2 name</label>
						<div class="col-md-10"><input type="text" class="form-control"  name="cmspagelink2_name"   placeholder="Enter CMS Page link2 name"  data-rule-required="true"  data-msg-required="Please enter CMS Page link2 name" /></div>
									</div>
									
					<div class="form-group">
						<label class="col-md-2 control-label">Enter CMS Page link2</label>
						<div class="col-md-10"><input type="text" class="form-control"  name="cmspagelink2"   placeholder="Enter CMS Page link2"  data-rule-required="true"  data-msg-required="Please enter CMS Page link2" /></div>
									</div>
									
				<div class="form-group">
					<label class="col-md-2 control-label">Enter CMS Page link3 name</label>
						<div class="col-md-10"><input type="text" class="form-control"  name="cmspagelink3_name"   placeholder="Enter CMS Page link3 name"  data-rule-required="true"  data-msg-required="Please enter CMS Page link3 name" /></div>
									</div>					
									
				<div class="form-group">
					<label class="col-md-2 control-label">Enter CMS Page link3</label>
						<div class="col-md-10"><input type="text" class="form-control" name="cmspagelink3" placeholder="Enter CMS Page link3"  data-rule-required="true"  data-msg-required="Please enter CMS Page link2" /></div>
									</div>
									
									
									<div class="form-group">
							<label class="col-md-2 control-label">Facebook Link </label>
										<div class="col-md-10"><input type="text" class="form-control" name="fblink"  placeholder="Enter facebook link"  data-rule-required="true"  data-msg-required="Please enter facebook link" /></div>
									</div>
									
								<div class="form-group">
							<label class="col-md-2 control-label">Google Plus Link </label>
										<div class="col-md-10"><input type="text" class="form-control" name="googlepluslink"  placeholder="Enter Google Plus link"  data-rule-required="true"  data-msg-required="Please enter Google Plus link" /></div>
									</div>	
									
								<div class="form-group">
							<label class="col-md-2 control-label">Twitter Link </label>
										<div class="col-md-10"><input type="text" class="form-control" name="twitterlink"  placeholder="Enter Twitter link"  data-rule-required="true"  data-msg-required="Please enter Twitter link" /></div>
									</div>	
									
								<div class="form-group">
							<label class="col-md-2 control-label">Linkedin Link </label>
										<div class="col-md-10"><input type="text" class="form-control" name="linkedinlink"  placeholder="Enter Linkedin link"  data-rule-required="true"  data-msg-required="Please enter Linkedin link" /></div>
									</div>	
									
									
    	 <div class="form-actions">										
					<button type="reset" class="btn">Reset</button>
					<button type="submit" class="btn btn-primary">Submit</button>
									</div>
								<?php echo form_close(); ?>
								
							 <!-- /.widget-content -->
						</div> <!-- /.widget .box -->
					</div> <!-- /.col-md-12 -->
				</div> <!-- /.row -->
				<!-- /Inline Tabs -->
				</div> <!-- /.row -->
				<!-- /Page Content -->
			</div>
		<?php
		}
		else
		{
		?>
		<?php
			echo "<br/></br></br></br>";
			echo "<h3> Sorry you can not add New CMS Page. You Already Created CMS page!!!</h3>";
		
		}
	?>
			<!-- /.container -->
			</div>
		</div>	 
</div>
	</div>