<script> 
    $(document).ready(function () {
 $("#download_sample").click(function(){
      var form = $(document.createElement('form'));
            $(form).attr("action", "../../admin_company/coursesassign/download_sample_file");
            $(form).attr("method", "POST");           
            $(form).submit();
        });
 });
 </script>
<div id="content">
			<div class="container">
				<!-- Breadcrumbs line -->
				<div class="crumbs">
					<ul class="breadcrumb">
				        <li>
                    <a href="#">
                       <?php echo $this->lang->line('brd_courses'); ?>
                    </a> 
                   
                </li>
                <li>
                    <a href="<?php echo site_url("admin_company") . '/' . $this->uri->segment(2); ?>">
                       <?php echo $this->lang->line('nav_chapter'); ?>
                    </a> 

                </li>
				        <li >
				          <a href="#"><?php echo $this->lang->line('lbl_add_viewer'); ?></a>
				        </li>
				      </ul>				      
				</div>				
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					
				</div>
				<!-- /Page Header -->

				<!--=== Page Content ===-->
				<!--=== Statboxes ===-->
				 <!-- /.row -->
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
								<h4> <?php echo $this->lang->line('lbl_course_assign').'   <b>'.$courses[0]['name'].'</b>'; ?></h4>								
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
						<label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_upload_course_assignment_csv')?></label>
										<div class="col-md-2">
							<input type="file" name="userfile" id="userfile" /><span style="color:red"><input type="button" id="download_sample" value="Download Sample"></span>
										</div>
										
									</div>

					<div class="form-group">
										<label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_course_assignment_desc');?>:</label>
                                                                                <div class="col-md-10"><textarea class="form-control" id="" name="description"><?php echo set_value('description');?></textarea></div>
                                                                                
									</div>
                                                     
                                                                                <div class="col-md-10" style="display: none;"><input type="text"  name="course_id" class="form-control"  value="<?php echo $course_id; ?>"></div>
								
                                                                              
                                 		
                                    <div class="form-actions">                                    	
							<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('btn_save');?></button>
                                        <button type="reset" class="btn"><?php echo $this->lang->line('btn_reset');?></button>
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