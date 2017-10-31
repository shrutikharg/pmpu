 <div id="content">
	<div class="container">
      
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
			
				<div class="row">
						<!--=== Inline Tabs ===-->
				<div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i>Change theme</h4>
							</div>
							<div class="widget-content">
								<form   class="form-horizontal row-border" action="#" method="post">
									<div class="alert fade in alert-danger" style="display: none;">
					<i class="icon-remove close" data-dismiss="alert"></i>
					Enter course name.
				</div>
								
	<div class="form-group required">
				<label class="col-md-3   control-label">Upload your logo:</label>
			<div class="col-md-2">
					<!--<input type="file" name="theme_logo" id="theme_logo" />--->
<a class='btn ' href='javascript:;'>
Choose File...
<input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="theme_logo" size="40" id="theme_logo"  onchange='$("#upload-file-info").html($(this).val());'>
</a>	
</div>
			<div class="col-md-2">				
		<?php 			
			if($themesetuser[0]['theme_logo'])
			{
			?>
			<img src="<?php echo base_url(); ?>assets/user_theme/<?php echo $themesetuser[0]['theme_logo']; ?>" height="75" width="75" />
	        <input type="hidden"  readonly id="" name="theme_logodata" value="<?php echo $themesetuser[0]['theme_logo']; ?>" >
			<?php
			}
			else
			{
				if($themeset[0]['theme_logo'])
				{
				?>
				<img src="<?php echo base_url(); ?>assets/logo/<?php echo $themeset[0]['theme_logo']; ?>" height="75" width="75" />
		      <input type="hidden" readonly id="" name="theme_logodata" value="<?php echo $themeset[0]['theme_logo']; ?>" >
				<?php
				}
			}
			?>
		</div>
<div class="col-md-4">
											<span><b>(Please upload logo of size (50X50))</b></span>
										</div>			
	</div>
								
										<div class="form-group required">
										<label class="col-md-3 control-label">Choose cool background image:<br></label>
			<div class="col-md-2">
				<!---<input type="file" name="theme_bg_image" id="theme_bg_image" />-->
				<a class='btn ' href='javascript:;'>
Choose File...
<input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="theme_bg_image" size="40" id="theme_bg_image"  onchange='$("#upload-file-info").html($(this).val());'></a>				
				</div>
                                    <div class="col-md-2">
											<?php
			if($themesetuser[0]['theme_bg_image'])
			{
			?>
			<img src="<?php echo base_url(); ?>assets/user_theme/<?php echo $themesetuser[0]['theme_bg_image']; ?>" height="75" width="75" />
	      <input type="hidden" id="" name="theme_bgimage" value="<?php echo $themesetuser[0]['theme_bg_image']; ?>" >
			<?php
			}
			else
			{
				if($themeset[0]['theme_bg_image'])
				{
				?>
				<img src="<?php echo base_url(); ?>assets/bg_image/<?php echo $themeset[0]['theme_bg_image']; ?>" height="75" width="75" />
		      <input type="hidden" id="" name="theme_bgimage" value="<?php echo $themeset[0]['theme_bg_image']; ?>" >
				<?php
				}
			}
			?>
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
										</div>											
										</div>
										<div class="form-group required">
										<label class="col-md-3   control-label">Change color theme:</label>
									<div class="col-md-theme">
		<img src="<?php echo base_url(); ?>assets/img/admin/themes/aqua.png" height="75" width="75" />	
	<input type="radio" name="color_scheme" value="1" <?php 
    echo set_value('color_scheme', $settheme) == 1 ? "checked" : ""; ?> />Aqua	
	</div>
	<div class="col-md-theme">	
		<img src="<?php echo base_url(); ?>assets/img/admin/themes/blue.png"  height="75" width="75" />			
			<input type="radio" name="color_scheme" value="2" <?php 
    echo set_value('color_scheme', $settheme) == 2 ? "checked" : ""; ?> />Blue
	</div>
	<div class="col-md-theme">	
										
<img src="<?php echo base_url(); ?>assets/img/admin/themes/green.png"  height="75" width="75" />			
			<input type="radio" name="color_scheme" value="3" <?php 
    echo set_value('color_scheme', $settheme) == 3 ? "checked" : ""; ?> />Blue
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
	