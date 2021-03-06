	<div id="content">
	<div class="container">
      
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
          <a href="#">Update</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Updating <?php echo ucfirst($this->uri->segment(2));?>
        </h2>
      </div>

 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> Sub-Category updated with success.';
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

      //form validation
      echo validation_errors();

      echo form_open('admin_company/subcategory/update/'.$this->uri->segment(4).'', $attributes);
      ?>
        <fieldset>
        <div class="control-group">
            <label for="inputError" class="control-label">Name</label>
            <div class="controls">
              <input type="text" id="" name="name" value="<?php echo $subcategory[0]['subcategory_name']; ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
        </div>
		  
		<div class="control-group">
            <label for="inputError" class="control-label">Description</label>
            <div class="controls">
			<textarea id="" name="description"><?php echo $subcategory[0]['subcategory_description']; ?></textarea>
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
		</div>
		
		<div class="control-group">
            <label for="inputError" class="control-label">Category</label>
            <div class="controls">

				<?php
				
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
				?>
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
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
            <button class="btn btn-primary" type="submit">Save changes</button>
            <button class="btn" type="reset">Cancel</button>
          </div>
        </fieldset>

      <?php echo form_close(); ?>

		</div>
	</div>

    