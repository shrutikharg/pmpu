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
             <a href="#">New</a>
        </li>
      </ul>      
      <div class="page-header">
        <h2>
          Adding <?php echo ucfirst($this->uri->segment(2));?>
        </h2>
      </div>
      <?php    
      if(isset($flash_message)){
        if($flash_message == TRUE)
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">�</a>';
            echo '<strong>Well done!</strong> new courses created with success.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">�</a>';
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
	echo form_open_multipart('admin_company/courses/add', $attributes);
      ?>
        <fieldset>    
		<div class="control-group">
            <label for="inputError" class="control-label">Name</label>
            <div class="controls">
              <input type="text" id="" name="name" value="<?php echo set_value('name'); ?>" >            
            </div>
        </div>
		<div class="control-group">
            <label for="inputError" class="control-label">Course Sub Title</label>
            <div class="controls">
              <input type="text" id="" name="subtitle" value="<?php echo set_value('subtitle'); ?>" >            
            </div>
        </div>		
		<div class="control-group">
            <label for="inputError" class="control-label">Author</label>
            <div class="controls">
              <input type="text" id="" name="courseby" value="<?php echo set_value('courseby'); ?>" >           
            </div>
                </div>		
		<div class="control-group">
            <label for="inputError" class="control-label">Course Requirements</label>
            <div class="controls">
              <input type="text" id="" name="requirements" value="<?php echo set_value('requirements'); ?>" >         
            </div>
          </div>		
		<div class="control-group">
            <label for="inputError" class="control-label">Course Price</label>
            <div class="controls">
              <input type="text" id="" name="price" value="<?php echo set_value('price'); ?>" >            
            </div>
        </div>		
		<div class="control-group">
            <label for="inputError" class="control-label">Course Validity</label>
            <div class="controls">
              <input type="text" id="" name="validity" value="<?php echo set_value('validity'); ?>" >            
            </div>
        </div>		
		<div class="control-group">
            <label for="inputError" class="control-label">Course Audience</label>
            <div class="controls">
              <input type="text" id="" name="audience" value="<?php echo set_value('audience'); ?>" >          
            </div>
        </div>		
		<div class="control-group">
            <label for="inputError" class="control-label">Course Goals</label>
            <div class="controls">
              <input type="text" id="" name="goals" value="<?php echo set_value('goals'); ?>" >           
            </div>
        </div>		
		<div class="control-group">
            <label for="inputError" class="control-label">Description</label>
            <div class="controls">
	    <textarea id="" name="description"><?php echo set_value('description'); ?></textarea>             
            </div>
           </div>			  
		<div class="control-group">
            <label for="inputError" class="control-label">Sub-Category</label>
            <div class="controls">
	           <?php echo form_dropdown('subcategory', $subcategory);  ?>            
            </div>
        </div> 		
		<div class="control-group">
            <label for="inputError" class="control-label">Course Image</label>
            <div class="controls">
	<input type="file" name="courseimage" id="courseimage" />            
            </div>
        </div>
          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Save changes</button>
            <button class="btn" type="reset">Cancel</button>
          </div>
        </fieldset>
                  <?php echo form_close(); ?>
	</div> 
	   </div>
    </div> 