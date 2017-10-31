<script type="text/javascript" src="<?php echo base_url();?>/assets/assets/js/verify_name_availability/check_subcategory_availability.js"></script><div id="content">
			<div class="container">
			<!-- Breadcrumbs line -->
			        <div class="crumbs">
            <ul class="breadcrumb">
                <li>
                    <a href="#">
                        <?php echo $this->lang->line('brd_organization') ?>
                    </a> 

                </li>
                <li>
                    <a href="<?php echo site_url("admin_company") . '/' . $this->uri->segment(2); ?>">
                        <?php echo $this->lang->line('brd_subdepartment') ?>
                    </a> 

                </li>
                <li class="active">
                    <a href="#"> <?php echo $this->lang->line('btn_edit') ?></a>
                </li>
            </ul>				      
        </div>
				
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
			
				<!-- /Page Header -->

				<!--=== Page Content ===-->
				<!--=== Statboxes ===-->
		
				<!-- /Statboxes -->
				<!--=== Normal ===-->
				<div class="row">
				 <?php	    
                    if(isset($message)){
      //flash messages

          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>'.$message;
              echo '</div>'; 
        }
      ?>
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i><?php echo $this->lang->line('lbl_edit_subdepartment');?></h4>								
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
										<label class="col-md-2 control-label required"><?php echo $this->lang->line('lbl_subdepartment');?></label>
										<div class="col-md-10"><input type="text"  id="name" name="name" value="<?php echo $subcategory_data[0]['name']; ?>" class="form-control"></div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_subdepartment_desc');?></label>
										<div class="col-md-10"><textarea class="form-control" id="" name="description"><?php echo $subcategory_data[0]['description']; ?></textarea></div>
									</div>
                                    
                                 <div class="form-group">
										<label class="col-md-2 control-label required"><?php echo $this->lang->line('lbl_department');?></label>
				<div class="col-md-4">
                                <select name="category_id"  id="category_id" class="form-control required">
													<option value=""><?php  echo $this->lang->line('opt_select');?> </option>
													<?php foreach($category_list as $category){ ?>									
													<option <?php if(isset($subcategory_data)) { if($subcategory_data[0]['category_id']==$category['id']) echo "selected"; }  ?> value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
												<?php } ?>
												</select></div>
                                                                                <div class="form-group" style="display:none;">
                                                                <div class="col-md-10"><input type="text"  name="id" class="form-control" value="<?php echo $subcategory_id; ?>" ></div>
										
										
									</div>
									</div>   

								
                                    
                                    
                                    <div class="form-actions">                                    	
										<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('btn_save');?></button>
                                        <button type="reset" class="btn"><?php echo  $this->lang->line('btn_cancel');?></button>                          
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