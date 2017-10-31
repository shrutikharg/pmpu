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
	   
            
			//var_dump($category);
			
			$options_category = array();    
            foreach ($category as $array) 
			{
              foreach ($array as $key => $value) {
                $options_category[$key] = $key;
              }
              break;
            }
			
	    
      if(isset($flash_message)){
        if($flash_message == TRUE)
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> new Sub-Category created with success.';
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
      
      echo form_open('admin/subcategory/add', $attributes);
      ?>
        <fieldset>
          
		  
		<div class="control-group">
            <label for="inputError" class="control-label">Name</label>
            <div class="controls">
              <input type="text" id="" name="name" value="<?php echo set_value('name'); ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
        </div>
		  
		<div class="control-group">
            <label for="inputError" class="control-label">Description</label>
            <div class="controls">
	    <textarea id="" name="description"><?php echo set_value('description'); ?></textarea>
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
        </div>
		
		<div class="control-group">
            <label for="inputError" class="control-label">Category</label>
            <div class="controls">
				<?php echo form_dropdown('category', $category);  ?>
				<?php echo form_dropdown('categories', $categories, $categories_value);  ?>
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
    
	<!--    http://code.tutsplus.com/tutorials/basecamp-style-subdomains-with-codeigniter--net-16330 ---->