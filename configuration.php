<?php

include('include/class.inc.php');

//$base_url 		 = 'http://localhost/coolacharya'; // Base-url path

//$base_url 		 = 'http://beta.coolacharya.com';

$base_url 		 = 'http://coolacharya.com/companyadminapp/employee/';

$admin_base_url  = 'http://cooladmin'; // Admin url path


$dbconfig = array(

	'host' => 'localhost',

	'user' => 'coolaffw_coolach',

	'pass' => 'G2XewgBLNTPv',

	'name' => 'coolaffw_coolacharyademo_db'

);


$db = db_mysql::getInstance();

$session = new Session('Script');

?>