<link href="<?php echo base_url(); ?>assets/assets/css/responsive.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
	<!--=== JavaScript ===-->
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

		         $("#login_form").submit(function (event) {
                var datastring = $("#login_form").serialize();
                event.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>employee/login/validate_credentials",
                    data: datastring,
                    dataType: 'json',
                    success: function (data) {
                        if (data.status === 'Success') {
                            location.href = "<?php echo base_url(); ?>employee_company/dashboard";
                        } else if (data.status === "Fail") {
                           $("#wrongcreadential").css("display", "block");
                            $("#wrongcreadential").text("Please enter correct email");
                        }
                        else if(data.status === "Not Subscribed"){
                           location.href = "<?php echo base_url(); ?>employee/payment_subscribe"; 
                        }
                        else {
                            $("#wrongcreadential").css("display", "block");
                            $("#wrongcreadential").text(data.status);
                        }
                            
                    },
                    error: function () {
                        $("#wrongcreadential").css("display", "block");
                            $("#wrongcreadential").text('technical error please contact to system admin');
                        
                    }
                });
            });
	});
	</script>
<body class="login">
    <div id="wrongcreadential" class="alert alert-danger" style="display:none; margin-top:15px;margin-bottom:20px;max-width:700px;margin-left: auto; margin-right: auto;">              
        <strong>sorry !</strong> you have entered wrong Email Id / Password.
    </div>
<div style="padding-top:100px; text-align: center; " id="loading" class="loading" /> </div><div class="logo">
		
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
      $attributes = array('class' => 'form-vertical login-form','id' => "login_form");
      echo form_open('employee/login/validate_credentials', $attributes);
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
    echo '<div class="form-actions">'.anchor('employee/register', 'Signup!').'</div>';
	echo '<div class="form-actions">' . anchor('employee/request_password_reset', 'Forgot password!') . '</div>';
        
	?>
	



<?php
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
	    $ip = $_SERVER['REMOTE_ADDR'];
	}
	//echo $_SERVER['REMOTE_ADDR'];
	echo '<br />';
	//$ipaddr=
    //$ip = '168.192.0.1'; // your ip address here
    $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
	//var_dump($query);
    if($query && $query['status'] == 'success')
    {
    echo '<input type="hidden" name="city" id="city" value="'.$query['city'].'"/>';  
	
		 echo '<input type="hidden" name="region" id="region" value="'.$query['region'].'"/>';
		
	echo '<input type="hidden" name="country" id="country" value="'.$query['country'].'"/>';
	
	echo '<input type="hidden" name="zip" id="zip" value="'.$query['zip'].'"/>';
		
	echo '<input type="hidden" name="geoloc" id="geoloc" value="'.$query['lat'] . ', ' .$query['lon'].'"/>';
		echo '<br />';
	echo '<input type="hidden" name="ip" id="ip" value="'.$ip.'"/>';	
		
    }
    ?>
	
<?php
		
      echo form_close();
      ?>  
	  
	</div>
</div>
</div>

</div>
<script>
	
$.get("http://ipinfo.io", function (response) {
    //$("#ip").html("IP: " + response.ip);
    //$("#address").val("Location: " + response.city + ", " + response.region + ", " + response.country);
	$("#city").val(response.city);
	$("#region").val(response.region);
	$("#country").val(response.country);
	$("#post").val(response.postal);
	$("#loc").val(response.loc);
	
    $("#details").html(JSON.stringify(response, null, 4));}, "jsonp");

</script>
	
	