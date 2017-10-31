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
      if(isset($flash_message)){
        if($flash_message == TRUE)
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> new Courses Videos created with success.';
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
	  
	echo form_open_multipart('admin/coursevideos/add', $attributes);
      ?>
        <fieldset>
          
		  
		<div class="control-group">
            <label for="inputError" class="control-label">Course Name</label>
            <div class="controls">
              <input type="text" id="" name="name" value="<?php echo set_value('name'); ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
        </div>
		
		<div class="control-group">
            <label for="inputError" class="control-label">Video Title</label>
            <div class="controls">
              <input type="text" id="" name="videotitle" value="<?php echo set_value('subtitle'); ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
        </div>
		
		<div class="control-group">
            <label for="inputError" class="control-label">Video Time</label>
            <div class="controls">
              <input type="text" id="" name="videotime" value="<?php echo set_value('courseby'); ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
        </div>
		
		<div class="control-group">
            <label for="inputError" class="control-label"> Video Description</label>
            <div class="controls">
	    <textarea id="" name="description"><?php echo set_value('description'); ?></textarea>
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
        </div>
		
		<div class="control-group">
            <label for="inputError" class="control-label">Video Number</label>
            <div class="controls">
              <input type="text" id="" name="videonumber" value="<?php echo set_value('requirements'); ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
        </div>
		
		<div class="control-group">
            <label for="inputError" class="control-label">Video For_Preview</label>
            <div class="controls">
              <input type="text" id="" name="forpreview" value="<?php echo set_value('price'); ?>" >
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
     