   <div id="content">
	<div class="container">
				<div class="row">
				<br/>
				<div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h2>Department List</h2>
							</div>
							<div class="widget-content">
						     <?php
           
            $attributes = array('class' => 'form-horizontal row-border', 'id' => 'myform');
        
			$options_category = array('name'=>'Department Name'); 		  
            echo form_open('admin_company/category', $attributes);
			
			echo '<div class="form-group">';
			echo '<label class="col-md-1   control-label">Search:</label>';
			
			echo '<div class="col-md-3">';			  
			  $data_search = array(
              'name'        => 'search_string',
              'id'          => 'search_string',              
              'class'       => 'form-control',
			  'placeholder' => 'Enter Category name',
				);
			  echo form_input($data_search, $search_string_selected);
			echo '</div>';
			
			echo '<label class="col-md-2   control-label">Order by:</label>';			
            //echo form_input('search_string', $search_string_selected);
			echo '<div class="col-md-2" id="col-md-dp">';
            echo form_dropdown('order', $options_category, $order, 'class="form-control"');
			echo '</div>';
			echo '<div class="col-md-12" >';
              $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Go');
			echo '</div>';
			echo '<div class="col-md-1" id="col-md-dp" >';
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
		/*$catlimit=$this->session->userdata('user_catlimit');		
		$planid_currentuser=$this->session->userdata['userplan_id'];
		
		if($planid_currentuser !=='1')
		{
			if($catlimit &&  ($catlimit > $count_catlimit))
			{*/				
			?>
			<a  href="<?php echo site_url("admin_company").'/'.$this->uri->segment(2); ?>/add" class="btn btn-primary">Add New</a>
	        </h2>
			 <?php /*
			}
		}*/
		?>
						<p>&nbsp;</p>
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i>View All Department</h4>								
							</div>
							
			<div class="res_table">
		<div class="res_table-head">
           <div class="column" data-label="Sr no"> Sr no</div>
           <div class="column" data-label="Category name">Name</div>
           <div class="column" data-label="action">Action</div>
       </div> 
              <?php
              foreach($category as $row)
              {
                echo '<div class="res_row">';  
                echo '<div class="column" data-label="Sr no">'.$row['id'].'</div>';
                echo '<div class="column" data-label="Category name">'.$row['name'].'</div>';
            if($planid_currentuser !=='1')
			{
				echo '<div class="column" data-label="action">
                  <a href="'.site_url("admin_company").'/category/update/'.$row['id'].'" class="btn btn-info">view & edit</a></div>'; 
			}
			else
			{
				echo '<div class="column" data-label="action">
                  <a href="'.site_url("admin_company").'/category/update/'.$row['id'].'" class="btn btn-info" disabled>view & edit</a></div>'; 
			}			
                echo '</div>';
				
              }
              ?> 
			</div>  
    <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

							</div>
						
						</div>
						
					</div>
				</div>
				<!-- /Normal -->
	</div>
				</div>		