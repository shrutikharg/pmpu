<?php
// Merchant key here as provided by Payu
$key = "xa6Hhr";

// Merchant Salt as provided by Payu
$SALT = "K3wVyS3K";

// End point - change to https://secure.payu.in for LIVE mode
$PAYU_BASE_URL = "https://secure.payu.in";

$action = '';

$posted = array();
if(!empty($_POST)) {
    //print_r($_POST);
  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 
	
  }
}

$formError = 0;

if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
		  
  ) {
    $formError = 1;
  } else {
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
	$hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
	 
    }

    $hash_string .= $SALT;


    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}
$action='payment_success';
?>
<html>
  <head>
      <title>Sign Up Page of E-Learning</title>
    <meta charset="utf-8">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/css/style.css">
 <link href="<?php echo base_url(); ?>assets/assets/css/form.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
   <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
 <link href="<?php echo base_url(); ?>assets/assets/css/responsive.css" rel="stylesheet">
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
  <body onload="submitPayuForm()" class="bg">
      <div class="container">
          <div class="row">
              <div class="well col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                  <form action="<?php echo $action; ?>" method="post" name="payuForm">
                      <h2 class="form-signin-heading"><?php echo $this->session->userdata['registeration_data']['reg_message'] ?></h2>
                      <div class='form-group'>
                          <input type="hidden" name="key" value="xa6Hhr" />
                          <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
                          <table style="width: 100%;">
                              <tr>
                                  <td><b>Amount in Rupees:</b> </td>
                                  <td><input type="text" name="amount" class="text_style" readonly value="1" /></td>
                              </tr> 
                              <tr>
                                  <td><b>First Name:</b> </td>
                                  <td><input type="text" name="firstname" maxlength="32" pattern="[A-Za-z]{1,32}"  required id="firstname" class="text_style" value="<?php echo (empty($posted['firstname'])) ? $this->session->userdata['registeration_data']['reg_first_name'] : $posted['firstname']; ?>" /></td>
                              <input type="hidden" name="txnid" value="<?php echo $txnid ?>" /></tr>
                              <tr>
                                  <td><b>Email:</b> </td>
                                  <td><input type="email" name="email" required id="email" class="text_style" value="<?php echo (empty($posted['email'])) ? $this->session->userdata['registeration_data']['reg_email'] : $posted['email']; ?>" /></td>
                              </tr>
                              <tr>
                                  <td><b>Phone:</b> </td>
                                  <td><input type="text" pattern="[0-9]{10}" name="phone" required value="<?php echo (empty($posted['phone'])) ? $this->session->userdata['registeration_data']['reg_phone'] : $posted['phone']; ?>" /></td>
                              </tr>
                              <tr>
                                  <td><b>Product Info:</b> </td>
                                  <td colspan="3"><input type="text" class="text_style" name="productinfo" id="productinfo" readonly value="Sanskrit for Everyone"></td>
                              </tr>
                              <tr>
                                  <td><b>Coupen Code: </b> </td>
                                  <td><input type="text" class="text_style" name="productinfo" id="productinfo" readonly placeholder="Coupen Code"></td>
                                  <td><div id="DisableDiv" style="display: block;">
                                            
                                      </div>
                                  </td>
                              </tr>
                              <tr>
                                  <td>&nbsp;</td>
                                  <td colspan="3"><input type="button" id="applyCoupen" name="coupenCode" value="apply coupen" class="btn btn-primary"></td>
                              </tr>
                              <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
                              <script type="text/javascript">
                                  $(document).ready(function(){
                                   $('#applyCoupen').click(function() {
                                        $('#DisableDiv').fadeTo('slow', .6);
                                        $('#DisableDiv').append('<img src="../images/loading.gif">');
                                        setTimeout(function() { GetData() }, 1000)
                                     });
                                  });
                                     function GetData() {
                                         $('#DisableDiv').html('<p style="color: green;">Coupen Applied</p>');
                                     }
                              </script>
                              <tr>
                                <td colspan="3"><input type="hidden" name="surl" value="<?php echo base_url() . 'employee/'; ?>success.php" size="64" /></td>
                                <td colspan="3"><input type="hidden" name="furl" value="http://coolacharya.com/payumoney/failure.php" size="64" /></td>
                                <td colspan="3"><input type="hidden" name="udf1" value="<?php echo $this->session->userdata['registeration_data']['reg_id'] ?>" size="64" /></td>
                                <td colspan="3"><input type="hidden" name="udf2" value="<?php echo $this->session->userdata['registeration_data']['reg_company_id'] ?>" size="64" /></td>
                                <td><input type="hidden" name="service_provider" value="payu_paisa"  /></td>
                              </tr>
                              <tr>
                                  <?php if (!$hash) { ?>
                                      <td align="center" colspan="4"><br/><input style="text-align: center; color: #ffffff;" class="btn btn-success" type="submit" value="Submit" /></td>
                                  <?php } ?>
                              </tr>
                          </table>
                      </div>
                  </form>
              </div>
          </div>
  </body>
</html>

