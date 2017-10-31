<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title> Cool Acharya - Online Courses</title>
	<!--=== CSS ===-->
	<!-- Bootstrap -->
	<link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

	<!-- jQuery UI -->
	<!--<link href="plugins/jquery-ui/jquery-ui-1.10.2.custom.css" rel="stylesheet" type="text/css" />-->
	<!--[if lt IE 9]>
		<link rel="stylesheet" type="text/css" href="plugins/jquery-ui/jquery.ui.1.10.2.ie.css"/>
	<![endif]-->

	<!-- Theme -->
	<?php
	
	if(($this->session->userdata('empuser_name')))
	{
		if(($this->session->userdata('csstheme'))=='1')
		{
		?>
			<link href="<?php echo base_url(); ?>assets/css/admin/globalaqua.css" rel="stylesheet" type="text/css">
			
	<?php
	$currentuserdt=$this->session->userdata('empuser_name');         
         if($currentuserdt==='mpauser@gmail.com')
         {
         ?>
         <link href="<?php echo base_url(); ?>assets/assets/css/main_2.css" rel="stylesheet" type="text/css" />
	<?php
	}
	else
	{
	?>
	<link href="<?php echo base_url(); ?>assets/assets/css/aqua.css" rel="stylesheet" type="text/css" />
	<?php
	}

		}elseif(($this->session->userdata('csstheme'))=='2')
		{
		?>
			<link href="<?php echo base_url(); ?>assets/css/admin/globalblue.css" rel="stylesheet" type="text/css">
	<?php
	if($currentuserdt==='mpauser@gmail.com')
         {
         ?>
       <link href="<?php echo base_url(); ?>assets/assets/css/blue.css" rel="stylesheet" type="text/css" />
         <?php
         }else
         {	
         ?>
		  <link href="<?php echo base_url(); ?>assets/assets/css/main_2.css" rel="stylesheet" type="text/css" />	
			
		<?php
		}
		}
		else
		{
		?>
		  <link href="<?php echo base_url(); ?>assets/css/admin/admin.css" rel="stylesheet" type="text/css">
		  <link href="<?php echo base_url(); ?>assets/assets/css/main.css" rel="stylesheet" type="text/css" />
		<?php
			
		}
	}
	
	?>
	<!--- <link href="<?php echo base_url(); ?>assets/assets/css/main.css" rel="stylesheet" type="text/css" /> ---->
	<link href="<?php echo base_url(); ?>assets/assets/css/plugins.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/assets/css/responsive.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/assets/css/icons.css" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/css/fontawesome/font-awesome.min.css">

	
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

	<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
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
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/slimscroll/jquery.slimscroll.horizontal.min.js"></script>

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
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/select2/select2.min.js"></script>

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

	<!-- Demo JS -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/custom.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/demo/pages_calendar.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/demo/charts/chart_filled_blue.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/demo/charts/chart_simple.js"></script>
	
	<!-- App -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/validation.js"></script>

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
				<li class="nav-toggle"><a href="javascript:void(0);" title=""><i class="icon-reorder"></i></a></li>
			</ul>

			<!-- Logo -->
			<a class="navbar-brand" href="#">
				<img src="<?php echo base_url(). $company_details->logo_path;; ?>" alt="logo" />
			</a>
			<!-- /logo -->

			<!-- Sidebar Toggler -->
			<a href="#" class="toggle-sidebar bs-tooltip" data-placement="bottom" data-original-title="Toggle navigation">
				<i class="icon-reorder"></i>
			</a>
			<!-- /Sidebar Toggler -->

			<div class="container">

			<!-- Top Right Menu -->
			<ul class="nav navbar-nav navbar-right">
				<!-- Notifications -->
				<!--- <li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-warning-sign"></i>
						<span class="badge">5</span>
					</a>
					<ul class="dropdown-menu extended notification">
						<li class="title">
							<p>You have 5 new notifications</p>
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
				<!-- Messages -->

	<?php if($log_id != ''){

	$sql_LC = "select assignedby_user_id, Video_Id,Time_Zone,Notification_Id, Notification_Title, Notification_Message, Notification_EmpMessage,Notification_On, IsRead, IsActive,Emp_name

				FROM notifications

				WHERE IsRead_employee = 'N' and IsActive = 'Y' and assignedby_user_id=".$log_id." order by Notification_Id desc";

				

	$res_LC = mysqli_query($dbhandle,$sql_LC);

	//print $sql_LC;

	?>

		

	<li class="dropdown hidden-xs hidden-sm">

		<a href="#" class="dropdown-toggle" data-toggle="dropdown">

			<i class="icon-envelope"></i>

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
	echo '<a href="'.site_url("employee_company").'/courses/clearnotification/" >Mark read </a>'; ?></p>

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

						<?php echo $row_LC->Notification_EmpMessage; ?>

					</span>

				</a>

			</li>

			

			<?php $i = $i + 1;

					}

				}

			} else { echo '<script>window.location="../coolAcharya";</script>';}?>

			

			<?php if($log_id != ''){

			$sql_LC = "select  assignedby_user_id, Video_Id,Time_Zone,Notification_Id, Notification_Title, Notification_Message,Notification_EmpMessage, Notification_On, IsRead, IsActive,IsRead_employee

						FROM notifications

						WHERE IsRead_employee = 'Y' and IsActive = 'Y' and assignedby_user_id=".$log_id." order by Notification_Id desc limit 0,4";

						

			$res_LC = mysqli_query($dbhandle,$sql_LC);

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

						<?php echo $row_LC->Notification_EmpMessage; ?>

					</span>

				</a>

			</li>

			

			<?php $i = $i + 1;

					}

				}

			} else { echo '<script>window.location="../coolAcharya";</script>';}?>

			

			<li class="footer">
			
			<?php			
			echo '<a href="'.site_url("employee_company").'/courses/notificationslist" class="btn btn-primary">View all messages</a>'; 			
			?>
				

			</li>

		</ul>

	</li>
				<!-- User Login Dropdown -->
				<li class="dropdown user">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<!--<img alt="" src="assets/img/avatar1_small.jpg" />-->
						<i class="icon-male"></i>
						<span id="username" class="username">
						<?php echo $this->session->userdata('empuser_name')	?></span>
						<i class="icon-caret-down small"></i>
					</a>
					<ul class="dropdown-menu">
		
				<li><a href="<?php echo base_url(); ?>employee/userprofile"><i class="icon-user"></i> My Profile</a></li>
			
						<li class="divider"></li>
						<li><a href="<?php echo base_url(); ?>employee/logout"><i class="icon-key"></i> Log Out</a></li>
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

				
		<?php

        $currentuserdtadd=$this->session->userdata('empuser_name'); 
         if($currentuserdtadd==='mpauser@gmail.com')
         {
?>


				<!--=== Navigation ===-->		
				<ul id="nav">
					<li class="current open">
						<a href="javascript:void(0);">
							<i class="icon-facetime-video"></i>
							Courses
						</a>
						<ul class="sub-menu">
							<li <?php if($this->uri->segment(2) == 'courses'){echo 'class="current_menu"';}?>>
								<a href="#">
								<i class="icon-angle-right"></i>
								  My Courses  list
								</a>
							</li>
	
		
			<li <?php if($this->uri->segment(2) == 'schedulecourselist'){echo 'class="disable_menu"';}?>>	
			<a href="#">
								<i class="icon-angle-right"></i>
								  Schedule Courses  list
								</a>
		</li>
						</ul>
					</li>
					
					<li>
						<a>
							<i class="icon-supportmail"></i>
							 Support
						</a>
						<ul class="sub-menu">
							<li <?php if($this->uri->segment(2) == 'supportmail'){echo 'class="current_menu"';}?>>
								<a href="#">
								<i class="icon-angle-right"></i>
								  Contact to Admin
								</a>
							</li>						
						</ul>
					</li>
				</ul>

<?php
}
else
{

?>		





				<!--=== Navigation ===-->		
				<ul id="nav">
                                    <li >
						<a>
							<i class="icon-home"></i>
							Dashboard
						</a>
						<ul class="sub-menu">
							<li <?php if($this->uri->segment(2) == 'dashboard'){echo 'class="current_menu"';}?>>
								<a href="<?php echo base_url(); ?>employee_company/dashboard">
								<i class="icon-briefcase"></i>
								 Dashboard
								</a>
							</li>
												
						</ul>
					</li>
					<li >
						<a href="javascript:void(0);">
							<i class="icon-facetime-video"></i>
							Courses
						</a>
						<ul class="sub-menu">
							<li <?php if($this->uri->segment(2) == 'courses'){echo 'class="current_menu"';}?>>
								<a href="<?php echo base_url(); ?>employee_company/courses">
								<i class="icon-angle-right"></i>
								  Courses  list
								</a>
							</li>
	
	<li <?php if($this->uri->segment(2) == 'schedulecourselist'){echo 'class="current_menu"';}?>>
			<a href="<?php echo base_url(); ?>employee_company/courses/schedulecourse/">
								<i class="icon-angle-right"></i>
								  Schedule Courses  list
								</a>
		</li>
						</ul>
					</li>
					
					<li>
						<a>
							<i class="icon-supportmail"></i>
							 Support
						</a>
						<ul class="sub-menu">
							<li <?php if($this->uri->segment(2) == 'supportmail'){echo 'class="current_menu"';}?>>
								<a href="<?php echo base_url(); ?>employee_company/supportmailemp">
								<i class="icon-angle-right"></i>
								  Contact to Admin
								</a>
							</li>
							
							
							<!-- <li <?php if($this->uri->segment(2) == 'courseassign'){echo 'class="active"';}?>>
								<a href="<?php echo base_url(); ?>employee_company/courseassign">
								<i class="icon-angle-right"></i>
								  Course Assignment
								</a>
							</li> --->						
						</ul>
					</li>
					
					
				</ul>

<?php
}
?>
			</div>
			<div id="divider" class="resizeable"></div>
		</div>
		
		<!-- /Sidebar -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>		
	