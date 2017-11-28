<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title> Cool Acharya - Online Courses</title>

	<!--=== CSS ===-->

	<!-- Bootstrap -->
	<link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

	<?php

	if(($this->session->userdata('user_name')))
	{
		$planid_currentuser=$this->session->userdata['userplan_id'];
		
		if(($this->session->userdata('csstheme'))=='1')
		{
		?>
			<link href="<?php echo base_url(); ?>assets/css/admin/globalaqua.css" rel="stylesheet" type="text/css">
			<link href="<?php echo base_url(); ?>assets/assets/css/aqua.css" rel="stylesheet" type="text/css" />
		<?php
		}elseif(($this->session->userdata('csstheme'))=='2')
		{
		?>
			<link href="<?php echo base_url(); ?>assets/assets/css/blue.css" rel="stylesheet" type="text/css">
			<link href="<?php echo base_url(); ?>assets/assets/css/blue.css" rel="stylesheet" type="text/css" />
		<?php
		}
		elseif(($this->session->userdata('csstheme'))=='3')
		{
		?>
			<link href="<?php echo base_url(); ?>assets/css/admin/globalblue.css" rel="stylesheet" type="text/css">
			<link href="<?php echo base_url(); ?>assets/assets/css/green.css" rel="stylesheet" type="text/css" />
		<?php
		}
		elseif(($this->session->userdata('csstheme'))=='4')
		{
		?>
			<link href="<?php echo base_url(); ?>assets/css/admin/globalred.css" rel="stylesheet" type="text/css">
			<link href="<?php echo base_url(); ?>assets/assets/css/red.css" rel="stylesheet" type="text/css" />
		<?php
		}
		else
		{
		?>
		  <link href="<?php echo base_url(); ?>assets/css/admin/admin.css" rel="stylesheet" type="text/css">
		  <link href="<?php echo base_url(); ?>assets/assets/css/main.css" rel="stylesheet" type="text/css" />
		<?php
			
		}
	}
	else
	{
	?>
	<link href="<?php echo base_url(); ?>assets/css/admin/global.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/assets/css/main.css" rel="stylesheet" type="text/css" />	
	
	<?php
	}
	?>
	<!--- <link href="<?php echo base_url(); ?>assets/assets/css/main.css" rel="stylesheet" type="text/css" /> ---->
	<link href="<?php echo base_url(); ?>assets/assets/css/plugins.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/assets/css/responsive.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/assets/css/icons.css" rel="stylesheet" type="text/css" />

	<!--<link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/css/fontawesome/font-awesome.min.css">-->
        <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" />
	<!--[if IE 7]>
		<link rel="stylesheet" href="assets/css/fontawesome/font-awesome-ie7.min.css">
	<![endif]-->

	<!--[if IE 8]>
		<link href="assets/css/ie8.css" rel="stylesheet" type="text/css" />
	<![endif]-->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>

	<!--=== JavaScript ===-->

	<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/libs/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>

	
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/libs/lodash.compat.min.js"></script>

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script src="assets/js/libs/html5shiv.js"></script>
	<![endif]-->

	<!-- Smartphone Touch Events -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/touchpunch/jquery.ui.touch-punch.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/event.swipe/jquery.event.move.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/event.swipe/jquery.event.swipe.js"></script>

	<!-- General -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/libs/breakpoints.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/respond/respond.min.js"></script> <!-- Polyfill for min/max-width CSS3 Media Queries (only for IE8) -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/cookie/jquery.cookie.min.js"></script>
	 <!------
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/slimscroll/jquery.slimscroll.horizontal.min.js"></script>
	 ------>

	<!-- Page specific plugins -->
	<!-- Charts -->
	<!--[if lt IE 9]>
		<script type="text/javascript" src="plugins/flot/excanvas.min.js"></script>
	<![endif]-->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.tooltip.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.resize.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.time.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.growraf.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/easy-pie-chart/jquery.easy-pie-chart.min.js"></script>

	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/daterangepicker/moment.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/blockui/jquery.blockUI.min.js"></script>

	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/fullcalendar/fullcalendar.min.js"></script>

	<!-- Noty -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/noty/jquery.noty.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/noty/layouts/top.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/noty/themes/default.js"></script>

	<!-- Forms -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/uniform/jquery.uniform.min.js"></script>
	
	<!-- App -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/app.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/plugins.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/plugins.form-components.js"></script>

    <!-- Form Validation -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/validation/jquery.validate.min.js"></script>
 
    <!-- Slim Progress Bars -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/nprogress/nprogress.js"></script>
	<script>
	$(document).ready(function(){
		"use strict";

		App.init(); // Init layout and core plugins
		Plugins.init(); // Init all plugins
		FormComponents.init(); // Init all form-specific plugins
	});
	</script>
	<link href="<?php echo base_url(); ?>assets/assets/css/login.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/login.js"></script>
	<!-- Demo JS -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/custom.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/demo/pages_calendar.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/demo/charts/chart_filled_blue.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/demo/charts/chart_simple.js"></script>
	
	<!-- App -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/validation.js"></script>

<script>


	function closemsg_count()

	{

		document.getElementById("msg_count").style.display = 'none';

	}

	function notification_update(notification_id)

	{

		alert('Hii');

		var dataString = 'notification_id=' + notification_id;

		$.ajax({

		type: "POST",
		url:"<?php echo base_url(); ?>admin_company/cmspage/notification_process/",
		//url: "<?php echo base_url(); ?>application/views/includes/notification_process.php",

		data: dataString,

		cache: false,

		success: function(result){

		//alert(result);

			if(result == 'Failed')

			{

			}

			if(result == 'Success')

			{

				notification_getcount();

				document.getElementById("notification"+notification_id).style.backgroundColor  = "#ddd";

				

			}

		}

		});

	}

	function notification_getcount()

	{

		var dataString = 'yes=y' ;

		$.ajax({

		type: "POST",

		url: "notification_getcount.php",

		data: dataString,

		cache: false,

		success: function(result){

		//alert(result);

			if(result == 'Failed')

			{

			}

			if(result == '0')

			{

				closemsg_count();

				document.getElementById("count_msg").textContent = "You have "+result+" new messages";



			}

			else

			{

				document.getElementById("msg_count").textContent = result;

				document.getElementById("count_msg").textContent = "You have "+result+" new messages";

				

			}

		}

		});

	}

</script>

<!-- Top Right Menu -->

<?php 
$username = "root";
$password = "root";
$hostname = "localhost"; 

//connection to the database
$dbhandle = mysqli_connect($hostname, $username, $password) 
or die("Unable to connect to MySQL");
//echo "Connected to MySQL<br>";

//select a database to work with
$selected = mysqli_select_db($dbhandle,"coolaffw_coolacharyademo_db") 
  or die("Could not select examples");


$log_id=$this->session->userdata('id');	


function time_elapsed_string($ptime)

{

    $etime = time() - $ptime;



    if ($etime < 1)

    {

        return 'Just Now';

    }



    $a = array( 365 * 24 * 60 * 60  =>  'year',

                 30 * 24 * 60 * 60  =>  'month',

                      24 * 60 * 60  =>  'day',

                           60 * 60  =>  'hour',

                                60  =>  'minute',

                                 1  =>  'second'

                );

    $a_plural = array( 'year'   => 'years',

                       'month'  => 'months',

                       'day'    => 'days',

                       'hour'   => 'hours',

                       'minute' => 'minutes',

                       'second' => 'seconds'

                );



    foreach ($a as $secs => $str)

    {

        $d = $etime / $secs;

        if ($d >= 1)

        {

            $r = round($d);

            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';

        }

    }

}

?>	

</head>

<body>
	<!-- Header -->
	<header class="header navbar navbar-fixed-top" role="banner">
		<!-- Top Navigation Bar -->
		<div class="container">

			<!-- Only visible on smartphones, menu toggle -->
			<ul class="nav navbar-nav">
				<li class="nav-toggle"><a href="javascript:void(0);" title=""><i class="fa fa-reorder"></i></a></li>
			</ul>

	
			<!-- Logo -->
	<?php
		if(($this->session->userdata('customcss'))=='Y')
		{
		?>
		<a href="<?php echo base_url(); ?>admin_company/category" class="navbar-brand">
		<div class="company_logo">
                    <img src="<?php echo base_url().$this->config->item('company_details')->logo_path; ?>"" alt="company_logo"  width="70" height="50"/>
		<!--<img src="<?php echo base_url(); ?>assets/assets/img/logo.png"  />-->
	</a>
	</div>
	<?php
		}
		else
		{
	?>
			<div class="company_logo">
		<a href="<?php echo base_url(); ?>admin_company/category" class="navbar-brand">
		<img src="<?php echo base_url(); ?>assets/user_theme/<?php echo $this->session->userdata('logocomp'); ?>"  alt="company_logo" width="70" height="50"/>
	</a>
	</div>
	<?php
		}
	?>
			
			<!-- <a class="navbar-brand" href="index.html">
				<img src="<?php echo base_url(); ?>assets/assets/img/logo.png" alt="logo" />
			</a>-->
			<!-- /logo -->

			<!-- Sidebar Toggler -->
			<a href="#" class="toggle-sidebar bs-tooltip" data-placement="bottom" data-original-title="Toggle navigation">
				<i class="fa fa-reorder"></i>
			</a>
			<!-- /Sidebar Toggler -->

			<div class="container">

			<!-- Top Right Menu -->
			
			<ul class="nav navbar-nav navbar-right">				
				<!---<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-warning-sign"></i>
						<span class="badge"><?php echo $data['msgnotifcation'];?></span>
					</a>
					<ul class="dropdown-menu extended notification">
						<li class="title">
							<p>You have <?php echo $data['msgnotifcation'];?> new notifications</p>
						</li>
						<li>
							<a href="javascript:void(0);">
								<span class="label label-success"><i class="icon-plus"></i></span>
								<span class="message">New user registration.</span>
								<span class="time">1 mins</span>
							</a>
						</li>
						<li>
							<a href="javascript:void(0);">
								<span class="label label-danger"><i class="icon-warning-sign"></i></span>
								<span class="message">High CPU load on cluster #2.</span>
								<span class="time">5 mins</span>
							</a>
						</li>
						<li>
							<a href="javascript:void(0);">
								<span class="label label-success"><i class="icon-plus"></i></span>
								<span class="message">New user registration.</span>
								<span class="time">10 mins</span>
							</a>
						</li>
						<li>
							<a href="javascript:void(0);">
								<span class="label label-info"><i class="icon-bullhorn"></i></span>
								<span class="message">New items are in queue.</span>
								<span class="time">25 mins</span>
							</a>
						</li>
						<li>
							<a href="javascript:void(0);">
								<span class="label label-warning"><i class="icon-bolt"></i></span>
								<span class="message">Disk space to 85% full.</span>
								<span class="time">55 mins</span>
							</a>
						</li>
						<li class="footer">
							<a href="javascript:void(0);">View all notifications</a>
						</li>
					</ul>
				</li>
				<!---
				<li class="dropdown hidden-xs hidden-sm">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-tasks"></i>
						<span class="badge">7</span>
					</a>
					<ul class="dropdown-menu extended notification">
						<li class="title">
							<p>You have 7 pending tasks</p>
						</li>
						<li>
							<a href="javascript:void(0);">
								<span class="task">
									<span class="desc">Preparing new release</span>
									<span class="percent">30%</span>
								</span>
								<div class="progress progress-small">
									<div style="width: 30%;" class="progress-bar progress-bar-info"></div>
								</div>
							</a>
						</li>
						<li>
							<a href="javascript:void(0);">
								<span class="task">
									<span class="desc">Change management</span>
									<span class="percent">80%</span>
								</span>
								<div class="progress progress-small progress-striped active">
									<div style="width: 80%;" class="progress-bar progress-bar-danger"></div>
								</div>
							</a>
						</li>
						<li>
							<a href="javascript:void(0);">
								<span class="task">
									<span class="desc">Mobile development</span>
									<span class="percent">60%</span>
								</span>
								<div class="progress progress-small">
									<div style="width: 60%;" class="progress-bar progress-bar-success"></div>
								</div>
							</a>
						</li>
						<li>
							<a href="javascript:void(0);">
								<span class="task">
									<span class="desc">Database migration</span>
									<span class="percent">20%</span>
								</span>
								<div class="progress progress-small">
									<div style="width: 20%;" class="progress-bar progress-bar-warning"></div>
								</div>
							</a>
						</li>
						<li class="footer">
							<a href="javascript:void(0);">View all tasks</a>
						</li>
					</ul>
				</li>

				<li class="dropdown hidden-xs hidden-sm">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-envelope"></i>
						<span class="badge">1</span>
					</a>
					<ul class="dropdown-menu extended notification">
						<li class="title">
							<p>You have 3 new messages</p>
						</li>
						<li>
							<a href="javascript:void(0);">
								<span class="photo"><img src="<?php echo base_url(); ?>assets/assets/img/demo/avatar-1.jpg" alt="" /></span>
								<span class="subject">
									<span class="from">Bob Carter</span>
									<span class="time">Just Now</span>
								</span>
								<span class="text">
									Consetetur sadipscing elitr...
								</span>
							</a>
						</li>
						<li>
							<a href="javascript:void(0);">
								<span class="photo"><img src="<?php echo base_url(); ?>assets/assets/img/demo/avatar-2.jpg" alt="" /></span>
								<span class="subject">
									<span class="from">Jane Doe</span>
									<span class="time">45 mins</span>
								</span>
								<span class="text">
									Sed diam nonumy...
								</span>
							</a>
						</li>
						<li>
							<a href="javascript:void(0);">
								<span class="photo"><img src="<?php echo base_url(); ?>assets/assets/img/demo/avatar-3.jpg" alt="" /></span>
								<span class="subject">
									<span class="from">Patrick Nilson</span>
									<span class="time">6 hours</span>
								</span>
								<span class="text">
									No sea takimata sanctus...
								</span>
							</a>
						</li>
						<li class="footer">
							<a href="javascript:void(0);">View all messages</a>
						</li>
					</ul>
				</li>
				----->
					<!-- Messages -->

	<?php if($log_id != ''){

	$sql_LC = "select User_Id, Video_Id,Time_Zone,Notification_Id, Notification_Title, Notification_Message, Notification_On, IsRead, IsActive,Emp_name

				FROM notifications

				WHERE IsRead = 'N' and IsActive = 'Y' and User_Id=".$log_id." order by Notification_Id desc";

				

	$res_LC = mysqli_query($dbhandle,$sql_LC);

	//print $sql_LC;

	?>

		

	<li class="dropdown hidden-xs hidden-sm">

		<a href="#" class="dropdown-toggle" data-toggle="dropdown">

			<i class="fa fa-envelope"></i>

			<?php if(mysqli_num_rows($res_LC) > 0) { ?>

			<span class="badge" id="msg_count"><?php echo mysqli_num_rows($res_LC); ?></span>

			<?php } ?>

		</a>

		<ul class="dropdown-menu extended notification">

			<?php

			if(mysqli_num_rows($res_LC) > 0)

			{ ?>

				<li class="title">
				
					<p><span id="count_msg">Notifcation <?php echo mysqli_num_rows($res_LC); ?> new messages</span><?php			
	echo '<a href="'.site_url("admin_company").'/cmspage/clearnotification/" >Mark read </a>'; ?></p>

				</li>

			<?php  $i = 1;

			  

			while($row_LC = mysqli_fetch_object($res_LC))

				{

			?>

			<li>

				<a id="notification<?php echo $row_LC->Notification_Id; ?>" href="javascript:void(0);" style="background-color: turquoise;" onClick="notification_update(<?php echo $row_LC->Notification_Id; ?>);">

					

					<span class="subject">

						<span class="from"><?php echo $row_LC->Notification_Title; ?></span>

						<span class="time">

							<?php  

								date_default_timezone_set($row_LC->Time_Zone); 

								$date = date($row_LC->Notification_On);

								$time = strtotime($date);  

								echo time_elapsed_string($time);  

							?>

						</span>

					</span>

					<span class="text">

						<?php echo $row_LC->Notification_Message; ?>

					</span>

				</a>

			</li>

			

			<?php $i = $i + 1;

					}

				}

			} else { echo '<script>window.location="../coolAcharya";</script>';}?>

			

			<?php if($log_id != ''){

			$sql_LC = "select  User_Id, Video_Id,Time_Zone,Notification_Id, Notification_Title, Notification_Message, Notification_On, IsRead, IsActive

						FROM notifications

						WHERE IsRead = 'Y' and IsActive = 'Y' and User_Id=".$log_id." order by Notification_Id desc limit 0,4";

						

			$res_LC = mysqli_query($sql_LC);

			//print $sql_LC;

			if(mysqli_num_rows($res_LC) > 0)

			{ 

			while($row_LC = mysqli_fetch_object($res_LC))

				{

			?>

			<li>

				<a href="javascript:void(0);">

					

					<span class="subject">

						<span class="from"><?php echo $row_LC->Notification_Title; ?></span>

						<span class="time">

							<?php  

								date_default_timezone_set($row_LC->Time_Zone); 

								$date = date($row_LC->Notification_On);

								$time = strtotime($date);  

								echo time_elapsed_string($time);  

							?>

						</span>

					</span>

					<span class="text">

						<?php echo $row_LC->Notification_Message; ?>

					</span>

				</a>

			</li>

			

			<?php $i = $i + 1;

					}

				}

			} else { echo '<script>window.location="../coolAcharya";</script>';}?>

			

			<li class="footer">
			
			<?php			
			echo '<a href="'.site_url("admin_company").'/cmspage/notificationslist/" class="btn btn-primary">View all messages</a>'; 			
			?>
				

			</li>

		</ul>

	</li>
				<!-- User Login Dropdown -->
				<li class="dropdown user">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						
						<i class="fa fa-user"></i>
						<span id="username" class="username"><?php //var_dump($this->session->userdata('user_name')); 
						echo $this->session->userdata('user_name'); ?></span>
						<i class="fa fa-caret-down"></i>
					</a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo base_url(); ?>admin_company/userprofile"><i class="fa fa-user"></i> My Profile</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo base_url(); ?>admin_company/logout"><i class="fa fa-key"></i> Log Out</a></li>
					</ul>
				</li>
				<!-- /user login dropdown -->
			</ul>
			<!-- /Top Right Menu -->
		</div>
		</div>
		<!-- /top navigation bar -->	
	</header> <!-- /.header -->
	
	<div id="container">
		<div id="sidebar" >
		<div id="sidebar-content">	

		
		
<ul id="nav">
    <li <?php if(($this->uri->segment(2) == 'brandings') || ($this->uri->segment(2) == 'cmspage')){echo 'class="current open"';}?>>
						<a href="javascript:void(0);">
							<i class="fa fa-cogs"></i>
							<?php echo $this->lang->line('nav_master');?>
						</a>
						<ul class="sub-menu">
							<li <?php if($this->uri->segment(2) == 'brandings'){echo 'class="current_menu"';}?>>
								<a href="<?php echo base_url(); ?>admin_company/brandings/addtheme">
								<i class="fa fa-angle-right"></i>
								<?php echo $this->lang->line('nav_comapny');?>
								</a>
							</li>
							<li <?php if($this->uri->segment(2) == 'cmspage'){echo 'class="current_menu"';}?>>
								<a href="<?php echo base_url(); ?>admin_company/cmspage">
								<i class="fa fa-angle-right"></i>
								<?php echo $this->lang->line('nav_cms');?>
								</a>
							</li>
						</ul>
					</li>
					<li <?php if(($this->uri->segment(2) == 'category') || ($this->uri->segment(2) == 'subcategory')){echo 'class="current open"';}?>>
						<a href="javascript:void(0);">
							<i class="fa fa-list"></i>
							<?php echo $this->lang->line('brd_organization');?>
						</a>
						<ul class="sub-menu">
							<li <?php if($this->uri->segment(2) == 'category'){echo 'class="current_menu"';}?>>
								<a href="<?php echo base_url(); ?>admin_company/category">
								<i class="fa fa-angle-right"></i>
								<?php echo $this->lang->line('brd_department');?>
								</a>
							</li>
							<li <?php if($this->uri->segment(2) == 'subcategory'){echo 'class="current_menu"';}?>>
								<a href="<?php echo base_url(); ?>admin_company/subcategory">
								<i class="fa fa-angle-right"></i>
								<?php echo $this->lang->line('brd_subdepartment');?>
								</a>
							</li>
						</ul>
					</li>
					
					<li <?php if(($this->uri->segment(2) == 'courses') || ($this->uri->segment(3) == 'schedulecourse')||($this->uri->segment(2) == 'chapters') || ($this->uri->segment(2) == 'coursesassign'|| ($this->uri->segment(2) == 'coupon_code'))){echo 'class="current open"';}?>>
						<a href="javascript:void(0);" >
							<i class="fa fa-video-camera"></i>
							<?php echo $this->lang->line('brd_courses');?>
						</a>
						<ul class="sub-menu">
							<li <?php if($this->uri->segment(2) == 'courses'){echo 'class="current_menu"';}?>>
								<a href="<?php echo base_url(); ?>admin_company/courses">
								<i class="fa fa-angle-right"></i>
								<?php echo $this->lang->line('nav_course');?>
								</a>
							</li>
							 <li <?php if($this->uri->segment(2) == 'chapters'){echo 'class="current_menu"';}?>>
								<a href="<?php echo base_url(); ?>admin_company/chapters">
								<i class="fa fa-angle-right"></i>
								<?php echo $this->lang->line('nav_chapter');?>
								</a>
							</li>
							 <li <?php if($this->uri->segment(2) == 'coursesassign'){echo 'class="current_menu"';}?>>
								<a href="<?php echo base_url(); ?>admin_company/coursesassign">
								<i class="fa fa-angle-right"></i>
								  <?php echo $this->lang->line('nav_course_assignment');?>
								</a>
							</li>	
                                                       <li <?php if($this->uri->segment(2) == 'coursesassign'){echo 'class="current_menu"';}?>>
								<a href="<?php echo base_url(); ?>admin_company/coursesassign">
								<i class="fa fa-angle-right"></i>
								  <?php echo $this->lang->line('nav_course_assignment');?>
								</a>
							</li>	
                                                         <li <?php if($this->uri->segment(2) == 'coupon_code'){echo 'class="current_menu"';}?>>
								<a href="<?php echo base_url(); ?>admin_company/coupon_code">
								<i class="fa fa-angle-right"></i>
								  <?php echo $this->lang->line('nav_coupon_code');?>
								</a>
							</li>
								
						</ul>
					</li>
					<!--<li <?php if(($this->uri->segment(2) == 'add_question_bank') || ($this->uri->segment(2) == 'add_question')){echo 'class="current open"';}?>>
						<a href="javascript:void(0);" >
							<i class="icon-facetime-video"></i>
							Question Bank
						</a>
						<ul class="sub-menu">
							<li <?php if($this->uri->segment(2) == 'add_question_bank'){echo 'class="current_menu"';}?>>
								<a href="<?php echo base_url(); ?>admin_company/question_bank">
								<i class="icon-angle-right"></i>
								 Add question bank
								</a>
							</li>
							 <li <?php if($this->uri->segment(2) == 'add_question'){echo 'class="current_menu"';}?>>
								<a href="<?php echo base_url(); ?>admin_company/add_question">
								<i class="icon-angle-right"></i>
								  Add Question
								</a>
							</li>
														
								
						</ul>
					</li>-->
                                        <li <?php if(($this->uri->segment(2) == 'quiz') ){echo 'class="current open"';}?>>
						<a href="javascript:void(0);" >
							<i class="icon-question-sign"></i>
							Quiz
						</a>
						<ul class="sub-menu">
							<li <?php if($this->uri->segment(2) == 'quiz'){echo 'class="current_menu"';}?>>
								<a href="<?php echo base_url(); ?>admin_company/quiz">
								<i class="icon-angle-right"></i>
								 Quiz List
								</a>
							</li>
                                                        <li <?php if($this->uri->segment(2) == 'quiz' &&  $this->uri->segment(3) == 'add'){echo 'class="current_menu"';}?>>
								<a href="<?php echo base_url(); ?>admin_company/quiz/add">
								<i class="icon-angle-right"></i>
								 Add Quiz
								</a>
							</li>
							
														
								
						</ul>
					</li>
                                        <li <?php if(($this->uri->segment(2) == 'employeelist')){echo 'class="current open"';}?>>
						<a>
							<i class="icon-employeegroup"></i>
							<?php echo $this->lang->line('brd_employee');?>
						</a>
						<ul class="sub-menu">
							<li <?php if($this->uri->segment(2) == 'employeelist'){echo 'class="current_menu"';}?>>
								<a href="<?php echo base_url(); ?>admin_company/employeelist">
								<i class="icon-angle-right"></i>
								<?php echo $this->lang->line('nav_employee_list');?>
								</a>
							</li>
													
						</ul>
					</li>
                                          <li <?php if( ($this->uri->segment(2) == 'reports')){echo 'class="current open"';}?>>
						<a>
							<i class="icon-reporticon"></i>
							<?php echo $this->lang->line('nav_report');?>
						</a>
						<ul class="sub-menu">
							<li <?php if(($this->uri->segment(2) == 'reports')&&(($this->uri->segment(3) == 'coursewise'))){echo 'class="current_menu"';}?>>
								<a href="<?php echo base_url(); ?>admin_company/reports/coursewise">
								<i class="icon-angle-right"></i>
								<?php echo $this->lang->line('nav_course_report');?>
								</a>
							</li>
							<li <?php if(($this->uri->segment(2) == 'reports')&&(($this->uri->segment(3) == 'userwise'))){echo 'class="current_menu"';}?>>
								<a href="<?php echo base_url(); ?>admin_company/reports/userwise">
								<i class="icon-angle-right"></i>
								<?php echo $this->lang->line('nav_user_report');?>
								</a>
							</li>
							<li <?php if(($this->uri->segment(2) == 'reports')&&(($this->uri->segment(3) == 'chapterwise'))){echo 'class="current_menu"';}?>>
								<a href="<?php echo base_url(); ?>admin_company/reports/chapterwise">
								<i class="icon-angle-right"></i>
								<?php echo $this->lang->line('nav_chapter_report');?>
								</a>
							</li>
							
				
						</ul>
					</li>
                                        <li <?php if(($this->uri->segment(2) == 'analytics') || ($this->uri->segment(2) == 'graphreports') || ($this->uri->segment(2) == 'analyreports') || ($this->uri->segment(2) == 'analyticreports')){echo 'class="current open"';}?>>
						<a>
							<i class="icon-reporticon"></i>
							ANALYTICS
						</a>
						<ul class="sub-menu">
							<li <?php if($this->uri->segment(2) == 'analytics'){echo 'class="current_menu"';}?>>
								<a href="<?php echo base_url(); ?>admin_company/analytics">
								<i class="icon-angle-right"></i>
								Chapter list
								</a>
							</li>
							<li <?php if($this->uri->segment(2) == 'graphreports'){echo 'class="current_menu"';}?>>
								<a href="<?php echo base_url(); ?>admin_company/graphreports">
								<i class="icon-angle-right"></i>
								Graph Report
								</a>
							</li>
							
					<!--<li <?php if($this->uri->segment(2) == 'analyreports'){echo 'class="current_menu"';}?>>
								<a href="<?php echo base_url(); ?>admin_company/analyreports">
								<i class="icon-angle-right"></i>
								Analytics details
								</a>
							</li>--->
							
							<li <?php if($this->uri->segment(2) == 'analyticreports'){echo 'class="current_menu"';}?>>
								<a href="<?php echo base_url(); ?>admin_company/analyticreports">
								<i class="icon-angle-right"></i>
								Analytics
								</a>
							</li>
                                                        <li <?php if($this->uri->segment(2) == 'reports'){echo 'class="current_menu"';}?>>
								<a href="<?php echo base_url(); ?>admin_company/reports">
								<i class="icon-angle-right"></i>
								Reports
								</a>
							</li>
							
							<!-- <li <?php if($this->uri->segment(2) == 'analyticsgraph'){echo 'class="active"';}?>>
								<a href="<?php //echo base_url(); ?>admin_company/analyticsgraphs">
								<i class="icon-angle-right"></i>
								Analytics Reports
								</a>
							</li>--->
						</ul>
					</li>
					<li <?php if(($this->uri->segment(2) == 'supportmail')){echo 'class="current open"';}?>>
						<a>
							<i class="icon-supportmail"></i>
							Mail Support
						</a>
						<ul class="sub-menu">
							<li <?php if($this->uri->segment(2) == 'supportmail'){echo 'class="current_menu"';}?>>
								<a href="<?php echo base_url(); ?>admin_company/supportmail">
								<i class="icon-angle-right"></i>
								  Contact Support
								</a>
							</li>
													
						</ul>
					</li>
					
					
					<li <?php if(($this->uri->segment(2) == 'brandings')){echo 'class="current open"';}?>>
						<a>
							<i class="icon-tag"></i>
							Branding
						</a>
						<ul class="sub-menu" >
							<li <?php if($this->uri->segment(2) == 'brandings'){echo 'class="current_menu"';}?>>
								<a href="<?php echo base_url(); ?>admin_company/brandings/addtheme">
								<i class="icon-angle-right"></i>
								Change Theme
								</a>
							</li>
							
							<!--  <li <?php if($this->uri->segment(2) == 'subcategory'){echo 'class="active"';}?>>
								<a href="<?php echo base_url(); ?>admin_company/subcategory">
								<i class="icon-angle-right"></i>
								Customized Url
								</a>
							</li>--->
						</ul>
					</li>
					
					
					
					<li <?php if(($this->uri->segment(2) == 'cmspage')){echo 'class="current open"';}?>>
						<a>
							<i class="icon-cmspage"></i>
							CMS pages
						</a>
						<ul class="sub-menu">
			<li <?php if($this->uri->segment(2) == 'cmspage'){echo 'class="current_menu"';}?>>
								<a href="<?php echo base_url(); ?>admin_company/cmspage">
								<i class="icon-angle-right"></i>
								  Setting CMS Page
								</a>
							</li>
													
						</ul>
					</li>
					
					<li <?php if(($this->uri->segment(2) == 'plantable')){echo 'class="current open"';}?>>
						<a>
							<i class="icon-plantable"></i>
							Plan Table
						</a>
						<ul class="sub-menu">
			<li <?php if($this->uri->segment(2) == 'plantable'){echo 'class="current_menu"';}?>>
								<a href="<?php echo base_url(); ?>admin_company/plantable">
								<i class="icon-angle-right"></i>
									Choose Your Plan
								</a>
							</li>
													
						</ul>
					</li>
					
					<li <?php if(($this->uri->segment(2) == 'message')){echo 'class="current open"';}?>>
                                            <a href="<?php echo base_url(); ?>admin_company/communication">							
							<i class="icon-commenting"></i>
							<?php echo $this->lang->line('nav_message');?>
						</a>
					
					</li>
					
				</ul>
			</div>
					
			
			
			<div id="divider" class="resizeable"></div>
		</div>
		
	<!-- /Sidebar -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>	
	