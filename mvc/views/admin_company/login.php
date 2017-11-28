<link href="<?php echo base_url(); ?>assets/assets/css/responsive.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
	<!--=== JavaScript ===-->
	<link href="<?php echo base_url(); ?>assets/assets/css/icons.css" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/css/fontawesome/font-awesome.min.css">
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/libs/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
	<link href="<?php echo base_url(); ?>assets/assets/css/login.css" rel="stylesheet" type="text/css" />
		<!-- Bootstrap -->
<link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/css/admin/global.css" rel="stylesheet" type="text/css">
	<!-- App -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/login.js"></script>
	<script>
	$(document).ready(function(){
		"use strict";

		Login.init(); // Init login JavaScript
	});
	</script>
<body class="login">
 <?php
		
		echo '<div style="padding-top:100px; text-align: center; " id="loading" class="loading" /> </div><div class="logo">';
		?>
	<img src="<?php echo base_url(); ?>assets/assets/img/logo.png" alt="logo" />
	</div>
	<div class="box">
		<div class="content">
	<?php	
	echo '<div class="content">';
	if(isset($message_error) && $message_error)
	{
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">�</a>';
            echo '<strong>Oh snap!</strong> Change a few things up and try submitting again.';
          echo '</div>';             
      }
      elseif($errorlink=='Error_expire')
      {
      	echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">�</a>';
            echo '<strong>Sorry!</strong> Your Trial period of Free Expire.';
          echo '</div>';   
      }	
      $attributes = array('class' => 'form-vertical login-form');
      echo form_open('admin_company/login/validate_credentials', $attributes);
      echo '<h3 class="form-title">Sign In to your Account</h3>';
	  echo'<div class="alert fade in alert-danger" style="display: none;">
		<i class="icon-remove close" data-dismiss="alert"></i>
		Enter any username and password.
		</div>';
		echo '<div class="form-group">';
		echo '<div class="input-icon">
<i class="icon-envelope"></i>';
		echo '<input type="text" name="user_name" class="form-control" placeholder="Username" autofocus="autofocus" data-rule-required="true" data-msg-required="Please enter your username." /></div></div>';
		echo '<div class="form-group">';
		echo '<div class="input-icon"><i class="icon-lock"></i>';
		
		echo '<input type="password" name="password" class="form-control" placeholder="Password" data-rule-required="true" data-msg-required="Please enter your password." /></div></div>';
		
		echo '<div class="form-actions">
<label class="checkbox pull-left"><input type="checkbox" class="uniform" name="remember"> Remember me</label>';

		echo '<button type="submit" class="submit btn btn-warning pull-right">
Sign In <i class="icon-angle-right"></i></button></div>';

	echo '<br/>';	
    echo '<div class="form-actions">'.anchor('admin_company/signup', 'Signup!').'</div>';
	  
		
      echo form_close();
      ?>  
	  
	</div>
</div>
</div>