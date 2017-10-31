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
        );
echo "<div class='form-group'>";
echo form_input($first_name);
echo "</div>";


$last_name = array(
          'name'        => 'last_name',
          'id'          => 'last_name',
          'class'       => 'form-control input-lg',
          'Placeholder' => 'Last Name',
        );
echo "<div class='form-group'>";
echo form_input($last_name);
echo "</div>";

$web_address = array(
          'name'        => 'web_address',
          'id'          => 'web_address',
          'class'       => 'form-control input-lg',
          'Placeholder' => 'Web Address',
        );
echo "<div class='form-group'>";
echo form_input($web_address);
echo "</div>";

$email_address = array(
          'name'        => 'email_address',
          'id'          => 'email_address',
          'class'       => 'form-control input-lg',
          'Placeholder' => 'Email Address',
        );
echo "<div class='form-group'>";
echo form_input($email_address);
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
          'name'        => 'password2',
          'id'          => 'password2',
          'class'       => 'form-control input-lg',
          'Placeholder' => 'Confirm Password',
        );
echo "<div class='col-xs-6 col-sm-6 col-md-6'><div class='form-group'>";
echo form_password($password2);
echo "</div></div></div>";



$companyname = array(
          'name'        => 'companyname',
          'id'          => 'companyname',
          'class'       => 'form-control input-lg',
          'Placeholder' => 'Company Name',
        );
echo "<div class='row'><div class='col-xs-6 col-sm-6 col-md-6'><div class='form-group'>";
//var_dump($compname_list);
echo "<select class='form-control input-lg'>";
for($i=0;$i<count($compname_list);$i++){ 
        ?>
<option value="<?php echo $compname_list[$i]["id"]; ?>"><?php echo $compname_list[$i]["company_name"]; ?></option>
    <?php
	}
echo "</select>";
echo "</div></div>";


$password2 = array(
          'name'        => 'password2',
          'id'          => 'password2',
          'class'       => 'form-control input-lg',
          'Placeholder' => 'Confirm Password',
        );
echo "<div class='col-xs-6 col-sm-6 col-md-6'><div class='form-group'>";
echo form_password($password2);
echo "</div></div></div>";


echo "</p>";


//echo form_input('', set_value('username'), 'placeholder="Username"');
//echo form_password('password', '', 'placeholder="Password"');
//echo form_password('password2', '', 'placeholder="Password confirm"');

echo "<hr class='colorgraph2'><div class='row'>";
echo "<div class='col-xs-6 col-md-6'>";
echo form_submit('submit', 'submit', 'class="btn btn-large btn-primary"');
echo"</div>";
echo "<div class='col-xs-6 col-md-6'><a href='#' class='btn btn-success btn-block btn-lg'>Reset</a></div>";
echo "</div>";
?>
<?php
//var_dump($hostingplanselect);
?>
<!--
<input type="hidden" name="planid" value="<?php 
if(count($hostingplanselect)>0)
{ echo $hostingplanselect;}
 else{
	echo $this->uri->segment(3);
	}
?>">-->

<?php
//echo form_submit('submit', 'submit', 'class="btn btn-large btn-primary"');
echo form_close();
?>
	
	</div>
</div>

</div>

</body>