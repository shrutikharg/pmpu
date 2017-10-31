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

      echo form_open('admin/subcategory/update/'.$this->uri->segment(4).'', $attributes);
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
				<?php echo form_dropdown('category', $category,$category_value);  ?>
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
     