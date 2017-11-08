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
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" type="text/css">

        <style type="text/css">
            html, body {
                height: 100%;
            }
            .container {
                display: table;
                width: 100%;
                height: 100%;
                min-height: 100%;
            }
            .container .row {
                display: table-cell;
                vertical-align: middle;
            }
/*            .move-button {
                margin-bottom: -20px;
            }*/
            a.move {
                font-size: 16px;
                text-decoration: none;
                font-weight: 700;
            }
            .move span {
                margin-right: 5px;
            }
            .custom-button {
                padding: 6px 35px;
            }
            .well > p {
                color: maroon;
                font-weight: bold;
            }
        </style>
    </head>
<body class="bg">
<div class="container">

<div class="row">
    <div class="well col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
        <div class="move-button">
            <a href="<?php echo base_url();?>" class="move"><span class="fa fa-home fa-fw"></span>Back to Home</a>
         </div>
		<?php
//var_dump($compname);
echo validation_errors();			
$attributes = array('class' => 'form'); 

echo form_open('employee/create_member', $attributes);
echo '<h2 class="form-signin-heading" style="margin-top:0;"> Register </h2>';
echo "<hr class='colorgraph2'><div class='form-group'>";

$first_name = array(
          'name'        => 'first_name',
          'id'          => 'first_name',
          'class'       => 'form-control input-lg',
          'Placeholder' => 'First Name',
          'required'    => '',
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
          'required'    => '',
		  'value'=>set_value('last_name')
        );
echo "<div class='form-group'>";
echo form_input($last_name);
echo "</div>";


$email_address = array(
          'type'        => 'email',
          'name'        => 'email',
          'id'          => 'email_address',
          'class'       => 'form-control input-lg',
          'Placeholder' => 'Email Address',
          'required'    => '',
		   'value'=>set_value('email')
        );
echo "<div class='form-group'>";
echo form_input($email_address);
echo "</div>";


$phone = array(
          'type'        => 'number',
          'name'        => 'phone',
          'id'          => 'phone',
          'class'       => 'form-control input-lg',
          'Placeholder' => 'Phone',
          'required'    => '',
		   'value'=>set_value('phone')
        );
echo "<div class='form-group'>";
echo form_input($phone);
echo "</div>";

$password = array(
          'name'        => 'password',
          'id'          => 'password',
          'class'       => 'form-control input-lg pull-left',
          'Placeholder' => 'Password',
        );
echo "<div class='row'><div class='col-xs-6 col-sm-6 col-md-6' style='padding-left: 0;'><div class='form-group'>";
echo form_password($password);
echo "</div></div>";


$password2 = array(
          'name'        => 'passconf',
          'id'          => 'password2',
          'class'       => 'form-control input-lg',
          'Placeholder' => 'Confirm Password',
        );
echo "<div class='col-xs-6 col-sm-6 col-md-6' style='padding-right: 0;'><div class='form-group'>";
echo form_password($password2);
echo "</div></div></div>";



echo "<hr class='colorgraph2'><div class='row' style='display: block;'>";
echo "<div class='col-md-12' style='text-align: center;'>";
echo form_submit('submit', 'Sign Up', 'class="btn btn-large btn-primary custom-button"');
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