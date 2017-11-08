<?php
// Merchant key here as provided by Payu
$key = "xa6Hhr";

// Merchant Salt as provided by Payu
$SALT = "K3wVyS3K";

// End point - change to https://secure.payu.in for LIVE mode
$PAYU_BASE_URL = "https://secure.payu.in";

$action = '';

$posted = array();
if (!empty($_POST)) {
    //print_r($_POST);
    foreach ($_POST as $key => $value) {
        $posted[$key] = $value;
    }
}

$formError = 0;

if (empty($posted['txnid'])) {
    // Generate random transaction id
    $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
    $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if (empty($posted['hash']) && sizeof($posted) > 0) {
    if (
            empty($posted['key']) || empty($posted['txnid']) || empty($posted['amount']) || empty($posted['firstname']) || empty($posted['email']) || empty($posted['phone']) || empty($posted['productinfo']) || empty($posted['surl']) || empty($posted['furl'])
    ) {
        $formError = 1;
    } else {
        //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
        $hashVarsSeq = explode('|', $hashSequence);
        $hash_string = '';
        foreach ($hashVarsSeq as $hash_var) {
            $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
            $hash_string .= '|';
        }

        $hash_string .= $SALT;


        $hash = strtolower(hash('sha512', $hash_string));
        $action = $PAYU_BASE_URL . '/_payment';
    }
} elseif (!empty($posted['hash'])) {
    $hash = $posted['hash'];
    $action = $PAYU_BASE_URL . '/_payment';
}
$action = 'payment_success';
?>
<html>
    <head>
        <title>Sign Up Page of E-Learning</title>
        <meta charset="utf-8">
        <script src="<?php echo base_url(); ?>assets/assets/js/demo/jquery_1.9.1.js"></script> 
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/css/style.css">
        <link href="<?php echo base_url(); ?>assets/assets/css/form.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/assets/css/responsive.css" rel="stylesheet">
        <script>
            var hash = '<?php echo $hash ?>';
            function submitPayuForm() {
                if (hash == '') {
                    return;
                }
                var payuForm = document.forms.payuForm;
                payuForm.submit();
            }   
	         </script>
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
            .custom-button {
                padding: 6px 35px;
            }
        </style>
    </head>
    <body onload="submitPayuForm()" class="bg">
        <div class="container">
            <div class="row">
                <div class="well col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                    <form action="<?php echo $action; ?>" method="post" name="payuForm" id="payuForm">
                        <h2 class="form-signin-heading"><?php echo $this->session->userdata['registeration_data']['reg_message'] ?></h2>
                        <div class='form-group'>
                            <input type="hidden" name="key" value="xa6Hhr" />
                            <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
                            <table style="width: 100%;">
                                <tr>
                                    <td><b>Amount in Rupees:</b> </td>
                                    <td><input type="text" name="amount"  id="amount"class="text_style" readonly value="<?php echo $this->session->userdata['registeration_data']['reg_price'] ?>" /></td>
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
                                    <td><input type="text" class="text_style" name="productinfo" id="productinfo" readonly value="Sanskrit for Everyone"></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><a id="couponText" style="color: #00b9f5; cursor: pointer; text-decoration: none;">Have a Coupon code?</a></td>
                                </tr>
                                <tr class="couponDiv" style="display: none;">
                                    <td><b>Coupon Code: </b> </td>
                                    <td><input type="text" class="text_style" name="udf3" id="coupon_code"  placeholder="Coupon Code"></td>
                                    <td><div id="DisableDiv" style="display: block;">

                                        </div>
                                    </td>
                                </tr>
                                <tr id="msgDiv" style="display: none;">
                                    <td>&nbsp;</td>
                                    <td></td>
                                </tr>
                                <tr class="couponDiv" style="display: none;">
                                    <td>&nbsp;</td>
                                    <td colspan="3"><input type="button" id="applyCoupon" name="couponCode" value="Apply" class="btn btn-primary"></td>
                                </tr>

                                <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $('a#couponText').unbind('click').bind('click', function(){
                                            $(this).parent().parent().hide();
                                            $('.couponDiv').show();
                                        });
                                        $('#applyCoupon').unbind('click').bind('click', function() {
                                            if($('#coupon_code').val() == '') {
                                                alert('Please enter promocode');
                                                return false;
                                            }
                                            $('#DisableDiv').fadeTo('slow', .6);
                                            $('#DisableDiv').append('<img src="<?php echo base_url();?>assets/images/loading.gif">');
                                            $.ajax({
                                                type: "POST",
                                                url: "<?php echo base_url(); ?>employee/coupon_code/check",
                                                data: {'coupon_code': $('#coupon_code').val()},
                                                dataType: 'json',
                                                success: function (data) {
                                                    if (data.status == 'Success') {
                                                        $('#DisableDiv').hide();
                                                        $('#msgDiv').show();
                                                        $("#amount").val(data.discount_cost);
                                                        $("#original_price").val(data.original_cost);
                                                        $("#coupon_code").val(data.coupon_code);
                                                        $("#percentage_off").val(data.percentage_off);
                                                        $('#msgDiv > td:last-child').html('<p style="color: green;font-size: 1.1em; font-weight: 700;background: cyan;padding: 4px 15px;">Coupon Applied</p>');
                                                    } 
                                                    else if (data.status == 'Fail') {
                                                        $('#msgDiv').show();
                                                        $('#DisableDiv').hide();
                                                        $("#amount").val(data.discount_cost);
                                                        $("#original_price").val(data.original_cost);
                                                        $("#coupon_code").val(data.coupon_code);
                                                        $("#percentage_off").val(data.percentage_off);
                                                        $('#msgDiv > td:last-child').html('<p style="color: maroon;font-size: 1em; font-weight: 700;">Please Enter correct coupon Code</p>');
                                                    }
                                                },
                                                error: function () {
                                                    $('#msgDiv').show();
                                                    $('#msgDiv > td:last-child').text('technical error please contact to system admin');
                                                }
                                            });
                                        });
                                    });
                                </script>

                                <tr>
                                    <td colspan="3"><input type="hidden" name="surl" value="<?php echo base_url() . 'employee/'; ?>success.php" size="64" /></td>
                                    <td colspan="3"><input type="hidden" name="furl" value="http://coolacharya.com/payumoney/failure.php" size="64" /></td>
                                    <td colspan="3"><input type="hidden" name="udf1" value="<?php echo $this->session->userdata['registeration_data']['reg_id'] ?>" size="64" /></td>
                                    <td colspan="3"><input type="hidden" name="udf2" value="<?php echo $this->session->userdata['registeration_data']['reg_company_id'] ?>" size="64" /></td>
                                    <td colspan="3"><input type="hidden" name="udf4"  id="original_price"value="<?php echo $this->session->userdata['registeration_data']['reg_price'] ?>" size="64" /></td>
                                    <td colspan="3"><input type="hidden" name="udf5"  id="percentage_off"  size="64" /></td>

                                    <td><input type="hidden" name="service_provider" value="payu_paisa"  /></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <?php if (!$hash) { ?>
                                    <td><br/><input class="btn btn-large btn-primary custom-button" type="submit" style="padding: 6px 35px;" value="Submit" /></td>
                                        <?php } ?>
                                </tr>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
    </body>
</html>

