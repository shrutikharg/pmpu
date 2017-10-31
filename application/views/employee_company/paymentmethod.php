<!----- 

Name of File:paymentmethod.php
Date Of Creation:1st Dec 2015
Created By :Shridhar K. Sawant.
Purpose of file:After the registration form payment methods.

Update file History :

Copyright(C)  2015-2016 Coolacharya.com All rights Reserved.
----->
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
echo '<h2 class="form-signin-heading">Payment Details page</h2>';
echo "<hr class='colorgraph2'><div class='form-group'>";


?>
<!--
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
</div>---->
<?php
echo "<hr class='colorgraph2'><div class='row'>";
echo "<div class='col-xs-6 col-md-6'>";
//echo form_submit('submit', 'submit', 'class="btn btn-large btn-primary"');
echo"</div>";
//echo "<div class='col-xs-6 col-md-6'><a href='#' class='btn btn-success btn-block btn-lg'>Reset</a></div>";
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
<?php
				$attributes = array('class' => 'paypal', 'id' => 'paypal_form', 'style'=>'text-align: center;');   	
						echo form_open_multipart('admin_company/paypalpayments', $attributes);
						?>
							<input type="hidden" name="cmd" id="cmd" value="_xclick"/> 
							<input type="hidden" name="no_note" id="no_note" value="1"/>
							<input type="hidden" name="lc" id="lc" value="UK"/>
							<input type="hidden" name="currency_code" id="currency_code" value="USD"/>
				<input type="hidden" name="bn" id="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest"/>
		<input type="hidden" name="first_name" id="first_name" value="<?php echo $paypaldata['first_name']; ?>"/>
		<input type="hidden" name="last_name" id="last_name" value="<?php echo $paypaldata['last_name']; ?>"/>
		<input type="hidden" name="payer_email" id="payer_email" value="<?php echo $paypaldata['payer_email']; ?>"/>
		<input type="hidden" name="item_number" id="item_number" value="<?php echo $paypaldata['item_number']; ?>">
		<input type="hidden" name="item_name" id="item_name" value="<?php echo $paypaldata['item_name']; ?>">
		<input type="hidden" name="item_amount" id="item_amount" value="<?php echo $paypaldata['item_amount']; ?>">
		<input type="hidden" name="return" value="http://localhost/cool_trainer/admin_company/sucesspay">
		<input type="submit" id="paywithpaypal" class="btn inline btn-warning paypalbtn" value="Pay $<?php echo $paypaldata['item_amount']; ?> " onClick='onpay();' style="width: 90%;"/>
		<h2>Bank details</h2>					
						<?php echo form_close(); ?>
						
						
						
		<?php
// Merchant key here as provided by Payu
$MERCHANT_KEY = "xa6Hhr";
$SALT = "K3wVyS3K";
$PAYU_BASE_URL = " https://secure.payu.in";

//var_dump($payudata["amount"]);

// End point - change to https://secure.payu.in for LIVE mode
//$PAYU_BASE_URL = "https://test.payu.in";

$action = '';

/*
$payudata = array();
if(!empty($_POST)) {
    //print_r($_POST);
  foreach($_POST as $key => $value) {    
    $payudata[$key] = $value; 
	
  }
}
*/
$formError = 0;

if(empty($payudata['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $payudata['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($payudata['payudatahash']) && sizeof($payudata) > 0) {
  if(
          empty($payudata["key"])
          || empty($payudata["txnid"])
          || empty($payudata["firstname"])
          || empty($payudata["email"])
          || empty($payudata["phone"])
          || empty($payudata["productinfo"])
          || empty($payudata["surl"])
          || empty($payudata["furl"])
		  || empty($payudata["service_provider"])
  ) {
    $formError = 1;
  } else {
    //$payudata['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
	
$productinfo1 = '{"paymentParts":[{"name":"Designs","description":"Qty : 33","value":null,"isRequired":"true"}],"paymentIdentifiers":[{"field":"CompletionDate","value":"31/10/2012"},{"field":"txnid","value":"21827f29b9e7c4a3b211"}]}';
	$productinfo = json_decode(json_encode($productinfo1));

	$name="shri123";
	$id="544";
	$email="shri@gmail.com";
	$total="700";
$hash_string = $MERCHANT_KEY . '|' . $txnid . '|' . number_format($total, 2, '.', '')  . '|' . $productinfo . '|' . $name . '|' . $email . '|' . $id . '||||||||||' . $SALT;
$hash = hash('sha512', $hash_string);

    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($payudata['hash'])) {
  $hash = $payudata['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}

//var_dump($payudatahash);
?>
<!--<html>
  <head>
  <script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>
  </head>
  <body>
    <h2>PayU Form</h2>
    <br/>
    <?php if($formError) { ?>
	
      <span style="color:red">Please fill all mandatory fields.</span>
      <br/>
      <br/>
    <?php } ?>
   <form action="<?php echo $PAYU_BASE_URL . '/_payment'; ?>" method="post" name="payuForm">
      <input type="text" name="key" value="<?php echo $MERCHANT_KEY ?>" />
      <input type="text" name="hash" value="<?php echo $payudatahash ?>"/>
      <input type="text" name="txnid" value="<?php echo $txnid ?>" />
      <table>
        <tr>
          <td><b>Mandatory Parameters</b></td>
        </tr>
        <tr>
          <td>Amount: </td>
          <td><input name="amount" value="<?php echo (empty($payudata["amount"])) ? '' : $payudata["amount"]; ?>" /></td>
          <td>First Name: </td>
          <td><input name="firstname" id="firstname" value="<?php echo (empty($payudata["firstname"])) ? '' : $payudata["firstname"]; ?>" /></td>
        </tr>
        <tr>
          <td>Email: </td>
          <td><input name="email" id="email" value="<?php echo (empty($payudata["email"])) ? '' : $payudata["email"]; ?>" /></td>
          <td>Phone: </td>
          <td><input name="phone" value="<?php echo (empty($payudata["phone"])) ? '' : $payudata["phone"]; ?>" /></td>
        </tr>
        <tr>
          <td>Product Info: </td>
          <td colspan="3"><textarea name="productinfo"><?php echo (empty($payudata["productinfo"])) ? '' : $payudata["productinfo"] ?></textarea></td>
        </tr>
        <tr>
          <td>Success URI: </td>
          <td colspan="3"><input name="surl" value="<?php echo (empty($payudata["surl"])) ? '' : $payudata["surl"] ?>" size="64" /></td>
        </tr>
        <tr>
          <td>Failure URI: </td>
          <td colspan="3"><input name="furl" value="<?php echo (empty($payudata["furl"])) ? '' : $payudata["furl"] ?>" size="64" /></td>
        </tr>

        <tr>
          <td colspan="3"><input type="hidden" name="service_provider" value="payu_paisa" size="64" /></td>
        </tr>

        <tr>
          <td><b>Optional Parameters</b></td>
        </tr>
        <tr>
          <td>Last Name: </td>
          <td><input name="lastname" id="lastname" value="<?php echo (empty($payudata["lastname"])) ? '' : $payudata["lastname"]; ?>" /></td>
          <td>Cancel URI: </td>
          <td><input name="curl" value="" /></td>
        </tr>
        <tr>
          <td>Address1: </td>
          <td><input name="address1" value="<?php echo (empty($payudata['address1'])) ? '' : $payudata['address1']; ?>" /></td>
          <td>Address2: </td>
          <td><input name="address2" value="<?php echo (empty($payudata['address2'])) ? '' : $payudata['address2']; ?>" /></td>
        </tr>
        <tr>
          <td>City: </td>
          <td><input name="city" value="<?php echo (empty($payudata['city'])) ? '' : $payudata['city']; ?>" /></td>
          <td>State: </td>
          <td><input name="state" value="<?php echo (empty($payudata['state'])) ? '' : $payudata['state']; ?>" /></td>
        </tr>
        <tr>
          <td>Country: </td>
          <td><input name="country" value="<?php echo (empty($payudata['country'])) ? '' : $payudata['country']; ?>" /></td>
          <td>Zipcode: </td>
          <td><input name="zipcode" value="<?php echo (empty($payudata['zipcode'])) ? '' : $payudata['zipcode']; ?>" /></td>
        </tr>
        <tr>
          <td>UDF1: </td>
          <td><input name="udf1" value="<?php echo (empty($payudata["udf1"])) ? '' : $payudata["udf1"]; ?>" /></td>
          <td>UDF2: </td>
          <td><input name="udf2" value="<?php echo (empty($payudata["udf2"])) ? '' : $payudata["udf2"]; ?>" /></td>
        </tr>
        <tr>
          <td>UDF3: </td>
          <td><input name="udf3" value="<?php echo (empty($payudata['udf3'])) ? '' : $payudata['udf3']; ?>" /></td>
          <td>UDF4: </td>
          <td><input name="udf4" value="<?php echo (empty($payudata['udf4'])) ? '' : $payudata['udf4']; ?>" /></td>
        </tr>
        <tr>
          <td>UDF5: </td>
          <td><input name="udf5" value="<?php echo (empty($payudata['udf5'])) ? '' : $payudata['udf5']; ?>" /></td>
          <td>PG: </td>
          <td><input name="pg" value="<?php echo (empty($payudata['pg'])) ? '' : $payudata['pg']; ?>" /></td>
        </tr>
        <tr>
          <?php //if(!$hash) { ?>
            <td colspan="4"><input type="submit" value="Submit" onClick="submitPayuForm()"/></td>
          <?php //} ?>
        </tr>
      </table>
    </form>
  </body>
</html>--->

						

	
	</div>
</div>

</div>

</body>