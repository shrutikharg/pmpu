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
    $(document).ready(function () {
        "use strict";
        Login.init(); // Init login JavaScript
            $("#login_form").submit(function (event) {
                $("#preloader").show();
                var datastring = $("#login_form").serialize();
                event.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>admin_company/login/validate_credentials",
                    data: datastring,
                    dataType: 'json',
                    success: function (data) {
                        $("#preloader").hide();
                        if (data.status === 'Success') {
                            location.href = "<?php echo base_url(); ?>admin_company/brandings/startpageapp";
                        } else if (data.status === "Fail") {
                            $("#wrongcreadential").css("display", "block");
                            $("#wrongcreadential").text("Please enter correct email");
                        } else {
                            $("#wrongcreadential").css("display", "block");
                            $("#wrongcreadential").text(data.status);
                        }
                    },
                    error: function () {
                        $("#preloader").show();
                        alert('technical error please contact to system admin');
                    }
                });
            });
    });
</script>
<style type="text/css">      
    .box{
        background-color: rgba(255,255,255,0.6)!important;
    }
    .form-actions{
        background-color: rgba(255,255,255,0)!important;
    }
</style>
<body class="login bg">
    <div id="wrongcreadential" class="alert alert-danger" style="display:none; margin-top:15px;margin-bottom:20px;max-width:700px;margin-left: auto; margin-right: auto;">              
        <strong>sorry !</strong> you have entered wrong Email Id / Password.
    </div>
    
   <div style="padding-top:100px; text-align: center; " id="loading" class="loading" /> </div><div class="logo">
    
    <img src="<?php echo base_url(); ?>assets/assets/img/logo.png" alt="logo" />
</div>
<div class="box">
    <div class="content">
        <div id="preloader" style="position: fixed; left: 0; top: 0; z-index: 999; width: 100%; height: 100%; overflow: visible; background: #333 url('http://files.mimoymima.com/images/loading.gif') no-repeat center center;opacity: 0.7;display: none;"></div>
        <?php
        echo '<div class="content">';
        if (isset($message_error) && $message_error) {
            echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">�</a>';
            echo '<strong>Oh snap!</strong> Change a few things up and try submitting again.';
            echo '</div>';
        } elseif ($errorlink == 'Error_expire') {
            echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">�</a>';
            echo '<strong>Sorry!</strong> Your Trial period of Free Expire.';
            echo '</div>';
        }
        $attributes = array('class' => 'form-vertical login-form', 'id' => "login_form");
        echo form_open('admin_company/login/validate_credentials', $attributes);
        echo '<h3 class="form-title">Sign In to your Account</h3>';
        echo'<div class="alert fade in alert-danger" style="display: none;">
		<i class="icon-remove close" data-dismiss="alert"></i>
		    Enter any username and password.
                    you have enterd wrong Email Id / password.
                    please enter valid email and password.
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
        echo '<div class="form-actions">' . anchor('admin_company/signup', 'Signup!') . '</div>';
        echo '<div class="form-actions">' . anchor('admin_company/request_password_reset', 'Forgot password!') . '</div>';
        echo form_close();
        ?>  	  
    </div>
</div>
</div>