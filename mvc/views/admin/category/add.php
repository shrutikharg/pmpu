    
	<br/><br/><br/><br/><br/>
	<div id="content">
	<div class="container">
	
			<div class="row">
						<!--=== Inline Tabs ===-->
				<div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i>Create the course</h4>
							</div>
							<div class="widget-content">
							<?php
      //flash messages
      if(isset($flash_message)){
        if($flash_message == TRUE)
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> new Category created with success.';
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
      $attributes = array('class' =>'form-horizontal row-border', 'id' => '');

      //form validation
      echo validation_errors();
      
      echo form_open('admin/category/add', $attributes);
      ?>
								
									<div class="alert fade in alert-danger" style="display: none;">
					<i class="icon-remove close" data-dismiss="alert"></i>
					Enter course name.
				</div>
									<div class="form-group">
			<label class="col-md-2 control-label">Category name</label>
			<div class="col-md-10">
			    <input type="text" data-msg-required="Please enter category name." data-rule-required="true" autofocus="autofocus" placeholder="Enter category name" name="name" class="form-control">
			</div>
		</div>
		
		
		<div class="form-group">
		<label class="col-md-2 control-label">Description <br></label>
		<div class="col-md-10">
		<textarea class="form-control" name="textarea" placeholder="(max 200 words)" cols="5" rows="3">
		<?php echo set_value('description'); ?>	
		</textarea>
		</div>									
		</div>	
								
																                                  
									<div class="form-actions">
										<button type="submit" class="btn btn-primary">Submit</button>
										<button class="btn" type="reset">Cancel</button>
									</div>
								<?php echo form_close(); ?>
								
							</div> <!-- /.widget-content -->
						</div> <!-- /.widget .box -->
					</div> <!-- /.col-md-12 -->
				</div> <!-- /.row -->
				<!-- /Inline Tabs -->
				</div> <!-- /.row -->
				<!-- /Page Content -->
</div> 

    </div>
  
   
   
			



			