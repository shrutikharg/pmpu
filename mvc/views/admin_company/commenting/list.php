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

				      </ul>				      

				</div>				

				<!-- /Breadcrumbs line -->
				
				<div class="row">
				<br/>
				<div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h2>Comments List</h2>
							</div>
							<div class="widget-content">
						     <?php
           
            $attributes = array('class' => 'form-horizontal row-border', 'id' => 'myform');
        
			$options_category = array('course_name'=>'Course Name'); 		  
            echo form_open('admin_company/commenting', $attributes);
			
			echo '<div class="form-group">';
			echo '<label class="col-md-2   control-label">Search:</label>';
			
			echo '<div class="col-md-3">';			  
			  $data_search = array(
              'course_name' => 'search_string',
              'id'          => 'search_string',              
              'class'       => 'form-control',
			  'placeholder' => 'Enter course name',
				);
			  echo form_input($data_search, $search_string_selected);
			echo '</div>';
			
			echo '<label class="col-md-2   control-label">Order by:</label>';			
            //echo form_input('search_string', $search_string_selected);
			echo '<div class="col-md-2" id="col-md-dp">';
            echo form_dropdown('order', $options_category, $order, 'class="form-control"');
			echo '</div>';
			
              $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Go');
			
			echo '<div class="col-md-2" id="col-md-dp">';
              $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
              echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="form-control"');
			echo '</div>';
              echo form_submit($data_submit);
			echo '</div>';
            echo form_close();
            ?>
								
							</div> <!-- /.widget-content -->
						</div> <!-- /.widget .box -->
					</div> <!-- /.col-md-12 -->
				</div> <!-- /.row -->		
				</div> <!-- /.row -->		
				<!-- /Statboxes -->
				
				
				<!--=== Page Content ===-->
				<!--=== Statboxes ===-->		
				
				<!--=== Normal ===-->
				<div class="row">
					<div class="col-md-12">												
				<?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'publish')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">�</a>';
            echo '<strong>Well done!</strong> User Comments Published.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">�</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
      ?>
		
		
						<p>&nbsp;</p>
						<div class="widget box"><div class="row">

					<div class="col-md-12">

						<div class="widget box">

							<div class="widget-header">

								<h4><i class="icon-reorder"></i> View All Comments and Ratings</h4>

							</div>
							<?php
							foreach($category as $row)
							{
							?>
							<div class="widget-content">

								<blockquote>

									<p><?php echo $row['comments']; ?></p>

    <small style="font-size:14px !important;"><?php echo $row['course_name']; ?><cite title="Source Title">&nbsp;&nbsp;&nbsp;<?php echo date("d/m/Y", strtotime($row['created_date'])); ?></cite></small><br>

                          <?php echo '<a href="'.site_url("admin_company").'/commenting/update/'.$row['id'].'"><i class="icon-edit"></i> Edit</a>&nbsp;&nbsp;';
								echo '<a href="'.site_url("admin_company").'/commenting/delete/'.$row['id'].'"><i class="icon-remove"></i> Delete</a>&nbsp;&nbsp;';
								//echo '<a href="'.site_url("admin_company").'/commenting/publishcomment/'.$row['id'].'"><i class="icon-globe"></i> Publish</a>&nbsp;&nbsp;';
									?>

								</blockquote>
								<hr/>
							<?php
							}
							?>

								

							</div>

						</div>

					</div>

				</div>

				<!-- /Normal -->
						</div>
						
					</div>
				</div>
				<!-- /Normal -->
	</div>
				</div>		