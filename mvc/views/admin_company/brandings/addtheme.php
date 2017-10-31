	<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/libs/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/themes/popupwindow.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/themes/demo.js"></script>
	
<link href="<?php echo base_url(); ?>assets/themes/popupwindow.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/themes/preview_demo.css" rel="stylesheet" type="text/css" />
	


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
          Change Theme
        </h2>
      </div>
      <?php
	  $planid_currentuser=$this->session->userdata['userplan_id'];
		
		//flash messages
      if(isset($flash_message)){
        if($flash_message == TRUE)
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Congratulations!</strong>Your theme settings have been created. Please wait for a few minutes for the settings to apply and login again.';
          echo '</div>';
			$urlstr=base_url().'admin_company/logout';		  
			header('Refresh:5; URL="'.$urlstr.'"');
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
											<span><b>(Please upload logo of size (70X50))</b></span>
										</div>			
	</div>
								
									<div class="alert fade in alert-danger" style="display: none;">
					<i class="icon-remove close" data-dismiss="alert"></i>
					Enter Company Name
				</div>
				<?php
				//var_dump($themesetuser);
				
				if(count($themesetuser[0]['theme_compname'])< 1)
				{
					$setcompaname='Cool Acharya';
				}
				else
				{
					$setcompaname=$themesetuser[0]['theme_compname'];
				}

?>				
	<div class="form-group required">
				<label class="col-md-3 control-label">Enter Company Name:</label>
			<div class="col-md-5">
<input type="text" class="form-control" name="theme_compname"  placeholder="Enter Company Name"  data-rule-required="true"  value="<?php echo $setcompaname; ?>" data-msg-required="Please Enter Company Name" />			
</div>			
<div class="col-md-4">
											<span><b>(Company Name like Coolacharya)</b></span>
										</div></div>			
	</div>
								
										<!--<div class="form-group required">
										<label class="col-md-3 control-label">Choose cool background image:<br></label>
			<div class="col-md-2">
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
			
										</div>											
										</div>--->
										<div class="form-group required">
										<label class="col-md-3   control-label">Change color theme:</label><?php
				
				if(!isset($themesetuser[0]['theme_color_scheme']))
				{
					$settheme=2;
				}
				else
				{
					$settheme=$themesetuser[0]['theme_color_scheme'];
				}
		?>
		<div class="col-md-theme">									
		<img src="<?php echo base_url(); ?>assets/img/admin/themes/red.png"  height="75" width="75" />			
			<input type="radio" name="color" value="4" <?php 
    echo set_value('color', $settheme) == 4 ? "checked" : ""; ?> />Red
	</div>
									<div class="col-md-theme">
		<img src="<?php echo base_url(); ?>assets/img/admin/themes/aqua.png" height="75" width="75" />	
	<input type="radio" name="color" value="1" <?php 
    echo set_value('color', $settheme) == 1 ? "checked" : ""; ?>/>Orange	
	</div>
	<div class="col-md-theme">
	
		<img src="<?php echo base_url(); ?>assets/img/admin/themes/blue.png"  height="75" width="75" />			
			<input type="radio" name="color" value="2"  <?php 
    echo set_value('color', $settheme) == 2 ? "checked" : ""; ?>   />Blue
	</div>
	<div class="col-md-theme">									
<img src="<?php echo base_url(); ?>assets/img/admin/themes/green.png"  height="75" width="75" />			
			<input type="radio" name="color" value="3" <?php 
    echo set_value('color', $settheme) == 3 ? "checked" : ""; ?> />Green
	</div>
											
										</div></div>
										

        <div class="form-actions">
		<?php
		
		if($planid_currentuser !=='1')
		{
		?>
            <button class="btn btn-primary" type="submit">Save</button>
            <button class="btn" type="reset">Cancel</button>
			<button class="btn btn-success" id="open-pop-up-1">Preview</button>	
			<?php
			}
		else
		{
			?>
			<button class="btn btn-primary"  disabled type="submit">Save</button>
            <button class="btn" type="reset" disabled >Cancel</button>
			<button class="btn btn-success" disabled id="open-pop-up-1">Preview</button>
			<?php
		}
			?>
			
<div class="container">
<div id="pop-up-1" class="pop-up-display-content">
	<div class="wrapper" >		
	<header class="navbar2" id="navbar2">
	
	<div class="logo2" >
	<?php 			
			if($themesetuser[0]['theme_logo'])
			{
			?>
			<img id="logo" src="<?php echo base_url(); ?>assets/user_theme/<?php echo $themesetuser[0]['theme_logo']; ?>" height="40" width="40" />
			<?php
			}
			else
			{
				if($themeset[0]['theme_logo'])
				{
				?>
				<img id="logo" src="<?php echo base_url(); ?>assets/logo/<?php echo $themeset[0]['theme_logo']; ?>" height="40" width="40" />
				<?php
				}
			}
			?>
		
	</div>	
	<div class="login2">
	<li class="dropdown2 user2">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<!--<img alt="" src="assets/img/avatar1_small.jpg" />-->
						<i class="icon-male"></i>
						<span id="preview_username" class="username">companyadmin1@gmail.com</span>
						<i class="icon-caret-down small"></i>
					</a>
					
				</li>
	</div>			
		
	</header>	
	<div class="preview_content">
		
	<div class="sidebar2" id="sidebar2">	
	<ul class="nav">	
		
	<li class="current open">
						<a href="javascript:void(0);">
							<i class="icon-bars"></i>
							Category
						<i class="arrow icon-angle-down"></i></a>
						<ul class="sub-menu">
							<li>
								<a href="http://coolacharya.com/companyadminapp/admin_company/category">
								<i class="icon-angle-right"></i>
								Levels List
								</a>
							</li>
							<li>
								<a href="http://coolacharya.com/companyadminapp/admin_company/subcategory">
								<i class="icon-angle-right"></i>
								Sub Levels List
								</a>
							</li>
						</ul>
					</li>
					<li>
					<a href="javascript:void(0);">
							<i class="icon-level-down"></i>
							Course
						<i class="arrow icon-angle-left"></i></a>
					</li>	
					<li>
								<a href="myactivity.html">
								<i class="icon-user"></i>
								My Profile
								</a>
							</li>
					<li>
						<a href="javascript:void(0);">
							<i class="icon-desktop"></i>
							Analytics
						<i class="arrow icon-angle-left"></i></a>
						
					</li>
					<li>
						<a href="javascript:void(0);">
							<i class="icon-tag"></i>
							
							Branding
						
						</a>
					</li>
					<li>
						<a href="javascript:void(0);">
							<i class="icon-question-sign"></i>
							Help Desk
						</a>
					</li>	
					</ul>
					
	
			
	</div>
	
	</div>	
	<div class="crubs">
	<ul class="breadcrub2">
	<li>
          <a href="http://coolacharya.com/companyadminapp/admin">
            Admin_company          </a> 
          <span class="divider">/</span>
        </li>
        <li>
          <a href="">
            Brandings          </a> 
          <span class="divider">/</span>
        </li>
        <li class="active">
          <a href="#">New</a>
        </li>	
	</ul>		
	</div>
	<br/><br/><br/>
	<div class="col-md-12_2">
						<div class="widget-box2">
							<div class="widget-header2">
								<h4><i class="icon-reorder"></i>Change theme</h4>
							</div>
							<div class="widget-content2">
								<form class="form-horizontal row-border" action="#" method="post" novalidate="novalidate">
									<div class="alert fade in alert-danger" style="display: none;">
					<i class="icon-remove close" data-dismiss="alert"></i>
					Enter course name.
				</div>
									
									
									
									
									
									
										<div class="form-group2 required">
										<label class="col-md-3_2 control-label2">Upload your logo:</label>
									
									<div class="col-md-2_2">
					<!--<input type="file" name="theme_logo" id="theme_logo" />--->
<a class="btn2" href="javascript:;">
Choose File...
<input type="file" style="position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:&quot;progid:DXImageTransform.Microsoft.Alpha(Opacity=0)&quot;;opacity:0;background-color:transparent;color:transparent;" name="theme_logo" size="35" id="theme_logo" ">
</a>	
</div>		
										
					                <div class="col-md-2_2" >
											<!--<img id="new_logo" src="images/task-pune-who-we-are-new.jpg">-->
											<?php 			
			if($themesetuser[0]['theme_logo'])
			{
			?>
			<img id="new_logo" src="<?php echo base_url(); ?>assets/user_theme/<?php echo $themesetuser[0]['theme_logo']; ?>" height="40" width="30" />
			<?php
			}
			else
			{
				if($themeset[0]['theme_logo'])
				{
				?>
				<img id="new_logo" src="<?php echo base_url(); ?>assets/logo/<?php echo $themeset[0]['theme_logo']; ?>" height="40" width="30" />
				<?php
				}
			}
			?>
										</div>	
										<div class="col-md-4_2" >
											<span style="font-size: 12px;"><b>(Please upload logo of size 70 by 50)</b></span>
										</div>				
										</div>
										
										
										<div class="form-group2 required">
										<label class="col-md-3_2 control-label2">Change color theme:</label>
										<div class="col-md-theme2">
											<img src="<?php echo base_url(); ?>assets/img/admin/themes/red.png" height="40" width="40">
									<input type="radio" value="red" name="color_preview">Red	
										</div>
									<div class="col-md-theme2">
		<img src="<?php echo base_url(); ?>assets/img/admin/themes/aqua.png" height="40" width="40">
									<input type="radio" value="orange" name="color_preview">Orange	
										</div>
					                <div class="col-md-theme2">
											<img src="<?php echo base_url(); ?>assets/img/admin/themes/blue.png" height="40" width="40">
											<input type="radio" value="blue" name="color_preview">Blue	
										</div>		
										<div class="col-md-theme2">
											<img src="<?php echo base_url(); ?>assets/img/admin/themes/green.png" height="40" width="40">
											<input type="radio" value="green" name="color_preview">	Green
										</div>	
										
										</div>
										<br/>
									
																                                  
									<div class="form-actions2">
            <button class="btn btn-primary2" id="btn-primary2" type="submit">Save changes</button>
            <button class="btn" id="btn" type="reset">Cancel</button>
          </div>
									
								</form>
								
							</div> <!-- /.widget-content -->
						</div> <!-- /.widget .box -->
					</div>
<div style="margin-left: 0px !important; margin-right: 0px !important;" class="row">    
<footer>
<div class="footer2" id="footer2">
<div class="footer2_inner">    
<div class="col-md-3_2">    
&nbsp;    
    
</div>    
<div class="col-md-2_2">  
<ul>
<li>		  
<a id="preview_link1" href="">Link1</a>
</li>

<li>
<a id="preview_link2"  href="">Link2</a>	
</li>
<li>
<a id="preview_link3" href="">Link3</a>	
</li>
</ul> 
</div>
<div class="col-md-4_2">    
<ul>
        <li>
<a href=""><img src="<?php echo base_url(); ?>assets/footerimages/fb_share.png" width="30" /></a>
</li>    
<li>
<a href=""><img src="<?php echo base_url(); ?>assets/footerimages/linkedin_share.png" width="30" pagespeed_url_hash="609827853"></a>
</li>
<li>
<a href=""><img src="<?php echo base_url(); ?>assets/footerimages/twitter_share.png" width="30" pagespeed_url_hash="2998535610"></a>
</li>
<li>
<a href=""><img src="<?php echo base_url(); ?>assets/footerimages/Google_plus_share.png" width="30" pagespeed_url_hash="1847318463"></a>
</li>
</ul>            
</div>
<div class="col-md-3_2" style="text-align: center; ">    



<h4><b>Contact:</b><span id="preview_contact_no">+91-9922557788</span> </h4>
<h4><b>Email:</b> <a id="preview_contact_email" href="#"> test@gmail.com</a></h4>

        
</div>
</div>
</div>
<div class="footer2_2">
<span>© 2015 Cool Acharya, All rights reserved | Terms of Service | Privacy policy</span>    
</div>
</footer>    
</div>					
		
	</div>
<div id="sidebar2" class="sidebar2-fixed">
			
			
		</div>
</div>

</div>
									</div>
          </div>
        </fieldset>

      <?php echo form_close(); ?>

     </div>
    </div> 
	