<div id="content">
	<div class="container">

      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin_company"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li class="active">
          <?php echo ucfirst($this->uri->segment(2));?>
        </li>
      </ul>
     
      <div class="row">
        <div class="span12 columns">
          <div class="well">
           
           
             <?php
           
            $attributes = array('class' => 'form-horizontal row-border', 'id' => 'myform');        
			    
			$options_category = array('name'=>'Employee Name'); 		  
            echo form_open('admin_company/userassign', $attributes);     
			
			echo '<div class="form-group">';
			echo '<label class="col-md-1   control-label">Search:</label>';
			
			echo '<div class="col-md-3">';			  
			  $data_search = array(
              'name'        => 'search_string',
              'id'          => 'search_string',              
              'class'       => 'form-control',
			  'placeholder' => 'Enter Employee name',
				);
			  echo form_input($data_search, $search_string_selected);
			echo '</div>';
			
			echo '<label class="col-md-2   control-label">Order by:</label>';			
            //echo form_input('search_string', $search_string_selected);
			echo '<div class="col-md-2" style="padding-left:0px !important; padding-right:0px !important;">';
            echo form_dropdown('order', $options_category, $order, 'class="form-control"');
			echo '</div>';
			
              $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Go');
			
			echo '<div class="col-md-1" style="padding-left:0px !important; padding-right:0px !important;">';
              $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
              echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="form-control"');
			echo '</div>';
              echo form_submit($data_submit);
			echo '</div>';
            echo form_close();
            ?>	
						

          </div>

          <div class="res_table">
		<div class="res_table-head">
           <div class="column" data-label="Sr no"> Sr no</div>
           <div class="column" data-label="User Name">User Name</div>
		   <div class="column" data-label="First Name">First Name</div>
		   <div class="column" data-label="Last Name">Last Name</div>
           <div class="column" data-label="action">Action</div>
       </div>
              <?php
               foreach($emplist as $row)
              {
                echo '<div class="res_row">';  
                echo '<div class="column" data-label="Sr no">'.$row['id'].'</div>';
               echo '<div class="column" data-label="User name">'.$row['user_name'].'</div>';
				echo '<div class="column" data-label="First Name">'.$row['first_name'].'</div>';
				echo '<div class="column" data-label="Last Name">'.$row['last_name'].'</div>';				
                echo '<div class="column" data-label="action">
                  <a href="'.site_url("admin_company").'/employeeprofile/'.$row['id'].'" class="btn btn-info">view & edit</a></div>';  
                echo '</div>';
              }
              ?>      
            </div>
    <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

</div>
    </div>
	</div>
</div>	
	</div>