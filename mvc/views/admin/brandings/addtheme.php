<!--=== JavaScript ===-->

	<script type="text/javascript" src="assets/js/libs/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>

	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/libs/lodash.compat.min.js"></script>

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script src="assets/js/libs/html5shiv.js"></script>
	<![endif]-->

	<!-- Smartphone Touch Events -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/touchpunch/jquery.ui.touch-punch.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/event.swipe/jquery.event.move.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/event.swipe/jquery.event.swipe.js"></script>

	<!-- General -->
	<script type="text/javascript" src="assets/js/libs/breakpoints.js"></script>
	<script type="text/javascript" src="plugins/respond/respond.min.js"></script> <!-- Polyfill for min/max-width CSS3 Media Queries (only for IE8) -->
	<script type="text/javascript" src="plugins/cookie/jquery.cookie.min.js"></script>
	<script type="text/javascript" src="plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script type="text/javascript" src="plugins/slimscroll/jquery.slimscroll.horizontal.min.js"></script>

	<!-- Page specific plugins -->
	<!-- Charts -->
	<script type="text/javascript" src="plugins/sparkline/jquery.sparkline.min.js"></script>

	<script type="text/javascript" src="plugins/daterangepicker/moment.min.js"></script>
	<script type="text/javascript" src="plugins/daterangepicker/daterangepicker.js"></script>
	<script type="text/javascript" src="plugins/blockui/jquery.blockUI.min.js"></script>

	<!-- Forms -->
	<script type="text/javascript" src="plugins/typeahead/typeahead.min.js"></script> <!-- AutoComplete -->
	<script type="text/javascript" src="plugins/autosize/jquery.autosize.min.js"></script>
	<script type="text/javascript" src="plugins/inputlimiter/jquery.inputlimiter.min.js"></script>
	<script type="text/javascript" src="plugins/uniform/jquery.uniform.min.js"></script> <!-- Styled radio and checkboxes -->
	<script type="text/javascript" src="plugins/tagsinput/jquery.tagsinput.min.js"></script>
	<script type="text/javascript" src="plugins/select2/select2.min.js"></script> <!-- Styled select boxes -->
	<script type="text/javascript" src="plugins/fileinput/fileinput.js"></script>
	<script type="text/javascript" src="plugins/duallistbox/jquery.duallistbox.min.js"></script>
	<script type="text/javascript" src="plugins/bootstrap-inputmask/jquery.inputmask.min.js"></script>
	<script type="text/javascript" src="plugins/bootstrap-wysihtml5/wysihtml5.min.js"></script>
	<script type="text/javascript" src="plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.min.js"></script>
	<script type="text/javascript" src="plugins/bootstrap-multiselect/bootstrap-multiselect.min.js"></script>

	<!-- Globalize -->
	<script type="text/javascript" src="plugins/globalize/globalize.js"></script>
	<script type="text/javascript" src="plugins/globalize/cultures/globalize.culture.de-DE.js"></script>
	<script type="text/javascript" src="plugins/globalize/cultures/globalize.culture.ja-JP.js"></script>
<!-- App -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/app.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/plugins.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/plugins.form-components.js"></script>

	<script>
	$(document).ready(function(){
		"use strict";

		App.init(); // Init layout and core plugins
		Plugins.init(); // Init all plugins
		FormComponents.init(); // Init all form-specific plugins
	});
	</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/custom.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/demo/form_components.js"></script>    
	<div id="content">
			<div class="container">
				<!-- Breadcrumbs line -->
				<div class="crumbs">
					<ul class="breadcrumb" id="breadcrumbs">
				        <li>
				          <i class="icon-home"></i>
						  <a href="<?php echo site_url("admin"); ?>">
				            <?php echo ucfirst($this->uri->segment(1));?>
				          </a> 
				          <span class="divider">/</span>
				        </li>
				        <li>
				          <a href="<?php //echo site_url("admin").'/'.$this->uri->segment(2); ?>">
				            <?php echo ucfirst($this->uri->segment(2));?>
				          </a> 
				          <span class="divider">/</span>
				        </li>
				        <li class="active">
				          <a href="#">New</a>
				        </li>
				      </ul>					
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>Adding <?php echo ucfirst($this->uri->segment(2));?></h3>
					</div>

					<!-- Page Stats -->
					<ul class="page-stats">
						<li>
							<div class="summary">
								<span>Total Disk SPace</span>
								<h3>500MB</h3>
							</div>
							<div id="sparkline-bar2" class="graph sparkline hidden-xs">20,15,8,50,20,40,20,30,20,15,30,20,25,20</div>
							<!-- Use instead of sparkline e.g. this:
							<div class="graph circular-chart" data-percent="73">73%</div>
							-->
						</li>
						<li>
							<div class="summary">
								<span>Available Disk SPace</span>
								<h3>400MB</h3>
							</div>
							<div id="sparkline-bar" class="graph sparkline hidden-xs">20,15,8,50,20,40,20,30,20,15,30,20,25,20</div>
						</li>
					</ul>
					<!-- /Page Stats -->
				</div>
				<!-- /Page Header -->

				<!--=== Page Content ===-->		

				<div class="row">
						<!--=== Inline Tabs ===-->
						<?php
      //flash messages
      if(isset($flash_message)){
        if($flash_message == TRUE)
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong>Your theme setting created with success.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
      ?>
      
      <?php
      //form data
      $attributes = array('class' => '', 'id' => '');
      $options_category = array('' => "Select");
      foreach ($category as $row)
      {
        $options_category[$row['id']] = $row['name'];
      }

      //form validation
      echo validation_errors();      
      echo form_open_multipart('admin/brandings/addtheme', $attributes);
      ?>
				<div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i>Create the course</h4>
							</div>
							<div class="widget-content">
								<form action="#" class="form-horizontal row-border">
									<div class="form-group">
										<label class="col-md-2 control-label">Upload Your Logo</label>
										<div class="col-md-10">
										<input type="file" name="theme_logo" id="theme_logo" />
               <!--<input type="text" id="" name="product_image" value="<?php echo set_value('theme_logo'); ?>">-->
              <!--<span class="help-inline">Cost Price</span>-->           
			<?php 			
			if($themesetuser[0]['theme_logo'])
			{
			?>
			<img src="<?php echo base_url(); ?>assets/user_theme/<?php echo $themesetuser[0]['theme_logo']; ?>" height="50" width="50" />
	      <input type="hidden" id="" name="theme_logo" value="<?php echo $themesetuser[0]['theme_logo']; ?>" >
			<?php
			}
			else
			{
				if($themeset[0]['theme_logo'])
				{
				?>
				<img src="<?php echo base_url(); ?>assets/logo/<?php echo $themeset[0]['theme_logo']; ?>" height="50" width="50" />
		      <input type="hidden" id="" name="theme_logo" value="<?php echo $themeset[0]['theme_logo']; ?>" >
				<?php
				}
			}
			?>
										
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Course category</label>
										<div class="col-md-8"><select class="form-control">
																		<option value="IT software" selected="selected">IT software</option>
																		<option value="IT hardware">IT hardware</option>
																		<option value="HR">HR</option>
																		<option value="HR">Accounting</option>
																	</select></div>
									</div>
									
									<div class="form-group">
										<label class="col-md-2 control-label">Course Description <br></label>
										<div class="col-md-10"><textarea class="form-control" name="textarea" placeholder="(max 200 words)" cols="5" rows="3"></textarea></div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Assign to group</label>
										<div class="col-md-8"><select class="form-control">
																		<option value="male" selected="selected">Group 1</option>
																		<option value="Group 1">Group 2</option>
																		<option value="Group 2">Group 3</option>
																		<option value="Group 3">Group 4</option>
																		<option value="Group 4">Group 5</option>
																	</select></div>
									</div>
									
																                                  
									<div class="form-actions">										
										<button class="btn">Reset</button>
										<button class="btn btn-primary">Submit</button>
									</div>
								</form>
								
							</div> <!-- /.widget-content -->
						</div> <!-- /.widget .box -->
					</div> <!-- /.col-md-12 -->
				</div> <!-- /.row -->
				<!-- /Inline Tabs -->
				</div> <!-- /.row -->
				<!-- /Page Content -->
			</div>
			<!-- /.container -->

		</div>
	</div>

	
	
	<div class="container top">
      
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li>
          <a href="<?php //echo site_url("admin").'/'.$this->uri->segment(2); ?>">
            <?php echo ucfirst($this->uri->segment(2));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li class="active">
          <a href="#">New</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Adding <?php echo ucfirst($this->uri->segment(2));?>
        </h2>
      </div>
 
      <?php
      //flash messages
      if(isset($flash_message)){
        if($flash_message == TRUE)
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong>Your theme setting created with success.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
      ?>
      
      <?php
      //form data
      $attributes = array('class' => 'form-horizontal', 'id' => '');
      $options_category = array('' => "Select");
      foreach ($category as $row)
      {
        $options_category[$row['id']] = $row['name'];
      }

      //form validation
      echo validation_errors();
      
      echo form_open_multipart('admin/brandings/addtheme', $attributes);
      ?>
        <fieldset>
	<div class="control-group">
            
			<div class="control-group">
            <label for="inputError" class="control-label">Upload Your Logo</label>
            <div class="controls">
			<input type="file" name="theme_logo" id="theme_logo" />
               <!--<input type="text" id="" name="product_image" value="<?php echo set_value('theme_logo'); ?>">-->
              <!--<span class="help-inline">Cost Price</span>-->           
			<?php 			
			if($themesetuser[0]['theme_logo'])
			{
			?>
			<img src="<?php echo base_url(); ?>assets/user_theme/<?php echo $themesetuser[0]['theme_logo']; ?>" height="50" width="50" />
	      <input type="hidden" id="" name="theme_logo" value="<?php echo $themesetuser[0]['theme_logo']; ?>" >
			<?php
			}
			else
			{
				if($themeset[0]['theme_logo'])
				{
				?>
				<img src="<?php echo base_url(); ?>assets/logo/<?php echo $themeset[0]['theme_logo']; ?>" height="50" width="50" />
		      <input type="hidden" id="" name="theme_logo" value="<?php echo $themeset[0]['theme_logo']; ?>" >
				<?php
				}
			}
			?>
          </div>
		</div>
		
		<div class="control-group">
            <label for="inputError" class="control-label">Choose Cool Background Image </label>
            <div class="controls">
		<input type="file" name="theme_bg_image" id="theme_bg_image" />
               <!--<input type="text" id="" name="product_image" value="<?php echo set_value('theme_bg_image'); ?>">-->
              <!--<span class="help-inline">Cost Price</span>-->         
			<?php
			if($themesetuser[0]['theme_bg_image'])
			{
			?>
			<img src="<?php echo base_url(); ?>assets/user_theme/<?php echo $themesetuser[0]['theme_bg_image']; ?>" height="50" width="50" />
	      <input type="hidden" id="" name="theme_bg_image" value="<?php echo $themesetuser[0]['theme_bg_image']; ?>" >
			<?php
			}
			else
			{
				if($themeset[0]['theme_bg_image'])
				{
				?>
				<img src="<?php echo base_url(); ?>assets/bg_image/<?php echo $themeset[0]['theme_bg_image']; ?>" height="50" width="50" />
		      <input type="hidden" id="" name="theme_bg_image" value="<?php echo $themeset[0]['theme_bg_image']; ?>" >
				<?php
				}
			}
			?>
          </div>			
		</div>		  
		  
		<div class="control-group">
            <label for="inputError" class="control-label">Choose Color Scheme</label>
            <div class="controls">
              <input type="text" id="" name="color_scheme" value="<?php echo set_value('color_scheme'); ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
        </div>
	  
	  
          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Save changes</button>
            <button class="btn" type="reset">Cancel</button>
          </div>
        </fieldset>

      <?php echo form_close(); ?>

    </div>
     