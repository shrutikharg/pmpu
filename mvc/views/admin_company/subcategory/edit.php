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
				          <a href="#">New</a>
				        </li>
				      </ul>				      
				</div>
				
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
					<h2>
				          Edit Sub-Department
				        </h2>	
					</div>

					<!-- Page Stats -->
					<!---<ul class="page-stats">
						<li>
							<div class="summary">
								<span>Total Disk SPace</span>
								<h3>500MB</h3>
							</div>
							
						</li>
						<li>
							<div class="summary">
								<span>Available Disk SPace</span>
								<h3>400MB</h3>
							</div>
							
						</li>
					</ul>--->
					
				</div>
				<!-- /Page Header -->

				<!--=== Page Content ===-->
				<!--=== Statboxes ===-->
				<div class="row row-bg"> <!-- .row-bg -->
					<div class="col-sm-6 col-md-2">
						<div class="statbox widget box box-shadow">
							<div class="widget-content">
								<div class="visual cyan">
									<i class="icon-user"></i>
								</div>
								<div class="title">View All Sub-Department</div>
								<a class="more" href="<?php echo base_url(); ?>admin_company/subcategory">Click Here<i class="pull-right icon-angle-right"></i></a>
							</div>
						</div> <!-- /.smallstat -->
					</div> <!-- /.col-md-2 -->

									
				</div> <!-- /.row -->
				<!-- /Statboxes -->
				<!--=== Normal ===-->
				<div class="row">
				 <?php	    
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Sub-Department updated with success.';
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
								<h4><i class="icon-reorder"></i>Create A Sub Category</h4>								
							</div>
							<div class="widget-content">
							 <?php
      //form data
      $attributes = array('class' => 'form-horizontal', 'id' => '');

      //form validation
      echo validation_errors();
      
       echo form_open('admin_company/subcategory/update/'.$this->uri->segment(4).'', $attributes);
      ?>
									<div class="form-group required">
										<label class="col-md-2 control-label">Sub-Department name:</label>
										<div class="col-md-10"><input type="text"  name="name" value="<?php echo $subcategory[0]['subcategory_name']; ?>" class="form-control"></div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">Description:</label>
										<div class="col-md-10"><textarea class="form-control" id="" name="description"><?php echo $subcategory[0]['subcategory_description']; ?></textarea></div>
									</div>
                                    
                                 <div class="form-group">
										<label class="col-md-2 control-label">Department name:</label>
										<div class="col-md-10"><?php
				
				$options = array();
				$select = array();
				$selected=$subcategory[0]['category_id'];
				foreach($category as $row)
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
				echo form_dropdown('category' , $options , $select);
				?></div>
									</div>   

								<!-- <div class="control-group">
            <label for="inputError" class="control-label">Status</label>
            <div class="controls">
			<?php
			$dd_list = array(
                  'Y'   => 'Active',
                  'N'   => 'In Active'
                );

			 $select = $subcategory[0]['IsActive']; 

			 echo form_dropdown('status', $dd_list, $select);
			?>
            </div>
		</div>--->	
                                    
                                    
                                    
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
			
			</div>
		</div>

		</div>
	</div>