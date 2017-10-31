    <div class="container top">
      
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li>
          <a href="<?php //echo site_url("admin").'/'.$this->uri->segment(2); ?>">
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
            echo '<strong>Well done!</strong>Your theme setting created with success.';
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
      $options_category = array('' => "Select");
      foreach ($category as $row)
      {
        $options_category[$row['id']] = $row['name'];
      }

      //form validation
      echo validation_errors();
      
      echo form_open_multipart('admin_company/brandings/addtheme', $attributes);
      ?>
        <fieldset>
	<div class="control-group">
            
			<input type="hidden" id="" readonly name="usertheme" value="<?php echo $this->session->userdata('customcss'); ?>">
			
			<div class="control-group">
            <label for="inputError" class="control-label">Upload Your Logo</label>
            <div class="controls">
			<input type="file" name="theme_logo" id="theme_logo" />
               <!--<input type="text" id="" name="product_image" value="<?php echo set_value('theme_logo'); ?>">-->
              <!--<span class="help-inline">Cost Price</span>-->           
			<?php 			
			if($themesetuser[0]['theme_logo'])
			{
			?>
			<img src="<?php echo base_url(); ?>assets/user_theme/<?php echo $themesetuser[0]['theme_logo']; ?>" height="50" width="50" />
	        <input type="text" id="" name="theme_logodata" value="<?php echo $themesetuser[0]['theme_logo']; ?>" >
			<?php
			}
			else
			{
				if($themeset[0]['theme_logo'])
				{
				?>
				<img src="<?php echo base_url(); ?>assets/logo/<?php echo $themeset[0]['theme_logo']; ?>" height="50" width="50" />
		      <input type="text" id="" name="theme_logodata" value="<?php echo $themeset[0]['theme_logo']; ?>" >
				<?php
				}
			}
			?>
          </div>
		</div>
		
		<div class="control-group">
            <label for="inputError" class="control-label">Choose Cool Background Image </label>
            <div class="controls">
		<input type="file" name="theme_bg_image" id="theme_bg_image" />
               <!--<input type="text" id="" name="product_image" value="<?php echo set_value('theme_bg_image'); ?>">-->
              <!--<span class="help-inline">Cost Price</span>-->         
			<?php
			if($themesetuser[0]['theme_bg_image'])
			{
			?>
			<img src="<?php echo base_url(); ?>assets/user_theme/<?php echo $themesetuser[0]['theme_bg_image']; ?>" height="50" width="50" />
	      <input type="text" id="" name="theme_bgimage" value="<?php echo $themesetuser[0]['theme_bg_image']; ?>" >
			<?php
			}
			else
			{
				if($themeset[0]['theme_bg_image'])
				{
				?>
				<img src="<?php echo base_url(); ?>assets/bg_image/<?php echo $themeset[0]['theme_bg_image']; ?>" height="50" width="50" />
		      <input type="text" id="" name="theme_bgimage" value="<?php echo $themeset[0]['theme_bg_image']; ?>" >
				<?php
				}
			}
			?>
          </div>			
		</div>

		<?php
				
				if(!isset($themesetuser[0]['theme_color_scheme']))
				{
					$settheme=2;
				}
				else
				{
					$settheme=$themesetuser[0]['theme_color_scheme'];
				}
		?>
		<div class="control-group">
            <label for="inputError" class="control-label">Choose Color Scheme</label>
            <div class="controls">
              <!--<input type="text" id="" name="color_scheme" value="<?php echo set_value('color_scheme'); ?>" >-->
              <!--<span class="help-inline">Woohoo!</span>-->
			  <img src="<?php echo base_url(); ?>assets/img/admin/themes/aqua.png" />	
	<input type="radio" name="color_scheme" value="1" <?php 
    echo set_value('color_scheme', $settheme) == 1 ? "checked" : ""; ?> />Aqua
	
			  <img src="<?php echo base_url(); ?>assets/img/admin/themes/blue.png" />		
			
			<input type="radio" name="color_scheme" value="2" <?php 
    echo set_value('color_scheme', $settheme) == 2 ? "checked" : ""; ?> />Blue
            </div>
        </div>	  
	  
        <div class="form-actions">
            <button class="btn btn-primary" type="submit">Save changes</button>
            <button class="btn" type="reset">Cancel</button>
          </div>
        </fieldset>

      <?php echo form_close(); ?>

    </div>
     