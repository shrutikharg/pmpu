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
				          <a href="#">Mail Support</a>
				        </li>
				      </ul>				      
				</div>				
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
					<h2>
				        <?php echo ucfirst($this->uri->segment(2));?>
				        </h2>	
					</div>
				</div>
				<!-- /Page Header -->

				<!--=== Page Content ===-->
				<!--=== Statboxes ===-->
				
				<!-- /Statboxes -->
				<!--=== Normal ===-->
				<div class="row">
			<?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'send')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> Your message send properly .';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
      ?>
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Mail Support</h4>								
							</div>
							<div class="widget-content">
							<?php
      //form data
      $attributes = array('class' => 'form-horizontal', 'id' => '');
		//form validation
		echo validation_errors();	  
		echo form_open_multipart('admin_company/supportmail', $attributes);     
      ?>

									
					<div class="form-group">
							<label class="col-md-2 control-label">Subject:</label>
	<div class="col-md-10"><input type="text"  name="subname" class="form-control" ></div>
									</div>
                                    
                                <div class="form-group">
							<label class="col-md-2 control-label">Description:</label>
			<div class="col-md-10"><textarea id="" class="form-control" name="description"></textarea></div>
									</div>
                                 		
                                    <div class="form-actions">                                    	
					<button class="btn btn-primary" type="submit">Send Mail</button>
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