    <div class="container top">
      
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li>
          <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>">
            <?php echo ucfirst($this->uri->segment(2));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li class="active">
          <a href="#">New</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Adding <?php echo ucfirst($this->uri->segment(2));?>
        </h2>
      </div>
     
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
      
      <?php
      //form data
      $attributes = array('class' => 'form-horizontal', 'id' => '');
		//form validation
		echo validation_errors();	  
		echo form_open_multipart('admin/courses/update/'.$this->uri->segment(4).'', $attributes);     
      ?>
        <fieldset>
          
		  
		<div class="control-group">
            <label for="inputError" class="control-label">Name</label>
            <div class="controls">
              <input type="text" id="" name="name" value="<?php echo $courses[0]['course_name']; ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
        </div>
		
		<div class="control-group">
            <label for="inputError" class="control-label">Course Sub Title</label>
            <div class="controls">
              <input type="text" id="" name="subtitle" value="<?php echo $courses[0]['course_subtitle']; ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
        </div>
		
		<div class="control-group">
            <label for="inputError" class="control-label">Author</label>
            <div class="controls">
              <input type="text" id="" name="courseby" value="<?php echo $courses[0]['course_by']; ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
        </div>
		
		<div class="control-group">
            <label for="inputError" class="control-label">Course Requirements</label>
            <div class="controls">
              <input type="text" id="" name="requirements" value="<?php echo $courses[0]['course_requirements']; ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
        </div>
		
		<div class="control-group">
            <label for="inputError" class="control-label">Course Price</label>
            <div class="controls">
              <input type="text" id="" name="price" value="<?php echo $courses[0]['course_price']; ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
        </div>
		
		<div class="control-group">
            <label for="inputError" class="control-label">Course Validity</label>
            <div class="controls">
              <input type="text" id="" name="validity" value="<?php echo $courses[0]['course_validity']; ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
        </div>
		
		<div class="control-group">
            <label for="inputError" class="control-label">Course Audience</label>
            <div class="controls">
              <input type="text" id="" name="audience" value="<?php echo $courses[0]['course_audience']; ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
        </div>
		
		<div class="control-group">
            <label for="inputError" class="control-label">Course Goals</label>
            <div class="controls">
              <input type="text" id="" name="goals" value="<?php echo $courses[0]['course_goals']; ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
        </div>
		
		<div class="control-group">
            <label for="inputError" class="control-label">Description</label>
            <div class="controls">
	    <textarea id="" name="description"><?php echo $courses[0]['course_description']; ?></textarea>
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
        </div>		
		  
		<div class="control-group">
            <label for="inputError" class="control-label">Sub-Category</label>
            <div class="controls">			
				<?php
				
				$options = array();
				$select = array();
				$selected=$courses[0]['subcategory_id'];
				foreach($subcategory as $row)
				{
				    /////////Your Condition ////////////
				    if($row['id'] == $selected)
				    {            
				        $options [$row['id']] = $row['subcategory_name'];
				        $select= $row['id'] ; 
				    }else{
				        $options [$row['id']] = $row['subcategory_name'];
				    }
				}
				//var_dump($options);
				//var_dump($select);
				echo form_dropdown('subcategory' , $options , $select);
				?>				
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
        </div> 
		
		<div class="control-group">
            <label for="inputError" class="control-label">Course Image</label>
            <div class="controls">
				<input type="file" name="courseimage" id="courseimage" />
				<input type="hidden" readonly id="" name="courseimagedisp" value="<?php echo $courses[0]['course_image']; ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
        </div>
		<div class="control-group">
            <label for="inputError" class="control-label">Status</label>
            <div class="controls">
			<?php
			$dd_list = array(
                  'Y'   => 'Active',
                  'N'   => 'In Active'
                );

			 $select = $courses[0]['IsActive']; 

			 echo form_dropdown('status', $dd_list, $select);
			?>
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
		</div>
		
		  
          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Save changes</button>
            <button class="btn" type="reset">Cancel</button>
          </div>
        </fieldset>

      <?php echo form_close(); ?>

    </div>
     