<div id="content">
			<div class="container">
				<!-- Breadcrumbs line -->
				<div class="crumbs">
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
				          <a href="#">Edit</a>
				        </li>
				      </ul>				      
				</div>				
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
					<h2>
				          Assign Course of - <?php echo $courses[0]['course_name']; ?>
				        </h2>	
					</div>
				</div>
				<!-- /Page Header -->

				<!--=== Page Content ===-->
				<!--=== Statboxes ===-->
				<div class="row row-bg"> <!-- .row-bg -->
					

									
				</div> <!-- /.row -->
				<!-- /Statboxes -->
				<!--=== Normal ===-->
				<div class="row">
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
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Assign Course of - <?php echo $courses[0]['course_name']; ?></h4>								
							</div>
							<div class="widget-content">
							<?php
      //form data
      $attributes = array('class' => 'form-horizontal', 'id' => '');
		//form validation
		echo validation_errors();	  
		echo form_open_multipart('admin_company/coursesassign/update/'.$this->uri->segment(4).'', $attributes);     
      ?>
									<div class="form-group">
						<label class="col-md-2 control-label">Upload User CSV:</label>
										<div class="col-md-2">
							<input type="file" name="userfile" id="userfile" />
										</div>
										<div class="col-md-6">
				<span><b>( * Please upload documents (csv,xls) FileSize Upto 2mb )</b></span>
		</div>
									</div>

									
									<div class="form-group">
										<label class="col-md-2 control-label">Subject:</label>
										<div class="col-md-10"><input type="text"  name="subname" class="form-control" ></div>
									</div>
                                    
                                <div class="form-group">
										<label class="col-md-2 control-label">Description:</label>
										<div class="col-md-10"><textarea class="form-control" id="" name="description"></textarea></div>
									</div>
                                 		
                                    <div class="form-actions">                                    	
							<button type="submit" class="btn btn-primary">Save</button>
                                        <button type="reset" class="btn">Cancel</button>
                                    </div>
								 <?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
				<!-- /Normal -->
			
				<!-- /Page Content -->
			</div>
			<!-- /.container -->

		</div>
	</div>