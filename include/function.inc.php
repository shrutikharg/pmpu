<?php
	/*=================== Functions ==============================*/
	
	$sql = "SELECT * FROM ggg_payment_setting WHERE payment_id = 1";
	$res = mysql_query($sql);
	$row = mysql_fetch_object($res);
	
	
	
	
	/*==================Payment URL =============================*/
	
	$paypal_url = $row->payment_url;
	$paypal_email = $row->payment_email;
?>