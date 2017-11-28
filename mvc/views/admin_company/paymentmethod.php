<!DOCTYPE html> 
<html lang="en-US">
  <head>
    <title>Payment Method Of Coolacharya </title>
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

echo validation_errors();			
$attributes = array('class' => 'form'); 

echo form_open('admin_company/payment_subscribe', $attributes);
echo '<h2 class="form-signin-heading">Payment Details</h2>';
echo "<hr class='colorgraph2'><div class='form-group'>";

?>
<div class='col-xs-6 col-sm-6 col-md-6'>
<div class='form-group'>
<label> Select Payment Methods</label>
</div>
</div>
<div class='col-xs-6 col-sm-6 col-md-6'>
<div class='form-group'>
<select name="paymentsubscribe">
  <option value="1">Paypal</option>
  <option value="2">Google Account</option>
  <option value="3">PayUMoney</option>
</select>
</div>
</div>
<?php
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
<input type="hidden" name="planid" value="<?php 
if(count($hostingplanselect)>0)
{ echo $hostingplanselect;}
 else{
	echo $this->uri->segment(3);
	}
?>">

<?php
//echo form_submit('submit', 'submit', 'class="btn btn-large btn-primary"');
echo form_close();
?>
	
	</div>
</div>

</div>

</body>