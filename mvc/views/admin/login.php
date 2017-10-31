<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title>Login | Cool Acharya - Online Courses</title>

	<!--=== CSS ===-->

	<!-- Bootstrap -->
	<link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<!-- Theme -->
	<link href="<?php echo base_url(); ?>assets/assets/css/main.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/assets/css/plugins.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/assets/css/responsive.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/assets/css/icons.css" rel="stylesheet" type="text/css" />

	<!-- Login -->
	<link href="<?php echo base_url(); ?>assets/assets/css/login.css" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/css/fontawesome/font-awesome.min.css">
	<!--[if IE 7]>
		<link rel="stylesheet" href="assets/css/fontawesome/font-awesome-ie7.min.css">
	<![endif]-->

	<!--[if IE 8]>
		<link href="assets/css/ie8.css" rel="stylesheet" type="text/css" />
	<![endif]-->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>

	<!--=== JavaScript ===-->

	<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/libs/jquery-1.10.2.min.js"></script>

	<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/libs/lodash.compat.min.js"></script>

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script src="assets/js/libs/html5shiv.js"></script>
	<![endif]-->

	<!-- Beautiful Checkboxes -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/uniform/jquery.uniform.min.js"></script>

	<!-- Form Validation -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/validation/jquery.validate.min.js"></script>

	<!-- Slim Progress Bars -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/nprogress/nprogress.js"></script>

	<!-- App -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/login.js"></script>
	<script>
	$(document).ready(function(){
		"use strict";

		Login.init(); // Init login JavaScript
                
                
	});
	</script>
</head>

<body class="login">
	<!-- Logo -->
	<div class="logo">
		<img src="<?php echo base_url(); ?>assets/assets/img/logo.png" alt="logo" />
	</div>
	<!-- /Logo -->

	<!-- Login Box -->
	<div class="box">
		<div class="content">
		

	
<!-- /Login Formular -->
<div class="content">
<!-- Login Formular -->
<form class="form-vertical login-form" action="<?php echo base_url(); ?>admin/login/validate_credentials" method="post">
<!-- Title -->
<h3 class="form-title">Sign In to your Account</h3>

<!-- Error Message -->
<div class="alert fade in alert-danger" style="display: none;">
<i class="icon-remove close" data-dismiss="alert"></i>
Enter any username and password.
</div>

<!-- Input Fields -->
<div class="form-group">
<!--<label for="username">Username:</label>-->
<div class="input-icon">
<i class="icon-envelope"></i>

<input type="text" name="user_name" class="form-control" placeholder="Username" autofocus="autofocus" data-rule-required="true" data-msg-required="Please enter your username." />
</div>
</div>
<div class="form-group">
<!--<label for="password">Password:</label>-->
<div class="input-icon">
<i class="icon-lock"></i>
<input type="password" name="password" class="form-control" placeholder="Password" data-rule-required="true" data-msg-required="Please enter your password." />
</div>
</div>
<!-- /Input Fields -->

<!-- Form Actions -->
<div class="form-actions">
<label class="checkbox pull-left"><input type="checkbox" class="uniform" name="remember"> Remember me</label>
<button  type="submit" class="submit btn btn-warning pull-right">
Sign In <i class="icon-angle-right"></i>
</button>
</div>
</form>
<!-- /Login Formular -->
</div>
</div>
</div>
