<!DOCTYPE html> 
<html lang="en-US">
  <head>
    <title>Sign Up Page of E-Learning</title>
    <meta charset="utf-8">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/css/style.css">
 <link href="<?php echo base_url(); ?>assets/assets/css/form.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
   <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
 <link href="<?php echo base_url(); ?>assets/assets/css/responsive.css" rel="stylesheet">
 
  </head>
<body class="bg">
<div class="container">

<div class="row">
    <div class="well col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
		<?php
//var_dump($compname);
echo validation_errors();			
$attributes = array('class' => 'form'); 

echo form_open('employee/create_member', $attributes);
echo '<h2 class="form-signin-heading"> Sign Up </h2>';
echo "<hr class='colorgraph2'><div class='form-group'>";

$first_name = array(
          'name'        => 'first_name',
          'id'          => 'first_name',
          'class'       => 'form-control input-lg',
          'Placeholder' => 'First Name',
		  'value'=>set_value('first_name')
        );
echo "<div class='form-group'>";
echo form_input($first_name);
echo "</div>";


$last_name = array(
          'name'        => 'last_name',
          'id'          => 'last_name',
          'class'       => 'form-control input-lg',
          'Placeholder' => 'Last Name',
		  'value'=>set_value('last_name')
        );
echo "<div class='form-group'>";
echo form_input($last_name);
echo "</div>";


$email_address = array(
          'name'        => 'email',
          'id'          => 'email_address',
          'class'       => 'form-control input-lg',
          'Placeholder' => 'Email Address',
		   'value'=>set_value('email')
        );
echo "<div class='form-group'>";
echo form_input($email_address);
echo "</div>";


$phone = array(
          'name'        => 'phone',
          'id'          => 'phone',
          'class'       => 'form-control input-lg',
          'Placeholder' => 'Phone',
		   'value'=>set_value('phone')
        );
echo "<div class='form-group'>";
echo form_input($phone);
echo "</div>";

$password = array(
          'name'        => 'password',
          'id'          => 'password',
          'class'       => 'form-control input-lg',
          'Placeholder' => 'Password',
        );
echo "<div class='row'><div class='col-xs-6 col-sm-6 col-md-6'><div class='form-group'>";
echo form_password($password);
echo "</div></div>";


$password2 = array(
          'name'        => 'passconf',
          'id'          => 'password2',
          'class'       => 'form-control input-lg',
          'Placeholder' => 'Confirm Password',
        );
echo "<div class='col-xs-6 col-sm-6 col-md-6'><div class='form-group'>";
echo form_password($password2);
echo "</div></div></div>";



echo "<hr class='colorgraph2'><div class='row'>";
echo "<div class='col-xs-6 col-md-6'>";
echo form_submit('submit', 'submit', 'class="btn btn-large btn-primary"');
echo"</div>";

?>
<?php
//var_dump($hostingplanselect);
?>


<?php
//echo form_submit('submit', 'submit', 'class="btn btn-large btn-primary"');
echo form_close();
?>
	
	</div>
</div>

</div>

</body>