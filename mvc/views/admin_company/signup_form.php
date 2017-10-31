<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>Cool Acharya Price Plans</title>
		<meta name="description" content="">
		<meta name="author" content="PC3">

		<meta name="viewport" content="width=device-width; initial-scale=1.0">

		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="/favicon.ico">
		<link rel="apple-touch-icon" href="/apple-touch-icon.png">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assets/plans_assets/css/prices.css" /> 
		<link href="<?php echo base_url(); ?>assets/assets/css/responsive.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/assets/css/icons.css" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/css/fontawesome/font-awesome.min.css"> 
	</head>

	<body>
		<div id="pricing_header"></div>
		<div id="main-table">
	<div class="head table">

		<div class="logo cell middle">
			<h3 class="header_style">Pricing</h3>
					</div>

		<div class="pricing cell bottom">

			<div class="standard" id="standard">
				<h2><?php echo $hostingdetails[0]['hostingplan_name'];?></h2>
<h3><span class="rupee_style">R</span>0.00</h3>
				
			</div>

		</div>
		<div class="pricing cell">

			<div class="prime" id="pro">
				<h2><?php echo $hostingdetails[1]['hostingplan_name'];?></h2>

				<h3><span class="rupee_style">R</span>3683</h3>
				<span>Per Month</span>

				<p><span class="rupee_style">R</span> 34000 per year <br/></p>
				<p>&nbsp;</p>
			</div>

		</div>
		<div class="pricing cell bottom">

			<div class="standard" id="enterprise">
				<h2><?php echo $hostingdetails[2]['hostingplan_name'];?></h2>

				<h3><span class="rupee_style">R</span>4875</h3>
				<span>Per Month</span>

				<p><span class="rupee_style">R</span> 45000  per year <br/></p>
			</div>

		</div>
		<div class="pricing cell">

			<div class="prime" id="pro">
				<h2><?php echo $hostingdetails[3]['hostingplan_name'];?></h2>

				<h3><span class="rupee_style">R</span>14516</h3>
				<span>Per Month</span>

				<p><span class="rupee_style">R</span>134000 per year <br/></p>
			</div>

		</div>

	</div>

	<div class="table">
		<!-- <div class="cell features">

		</div> -->
		<!-- <div class="cell special-offer">

			<div class="table">
				<div class="col-70 middle cell">
					<p>The price for Advanced Memberships is going up! Purchase now and lock in our lowest rate for as
						long as you remain a member.</p>
				</div>
				<div class="col-30 middle cell timer">
					<div class="ends">OFFER ENDS:</div>
					<div class="countdown"></div>
					<ul class="labels">
						<li>days</li>
						<li class="spacer">hours</li>
						<li>seconds</li>
					</ul>
				</div>
			</div>

		</div> -->
		<!-- <div class="cell corporate">
			&nbsp;
		</div> -->
	</div>

	<div class="table">

		<div class="general cell">

			<div class="table">

				<div class="features cell">
					<div class="box ">
						<strong>Admin login</strong>
						<span class="tooltip tooltip-effect-1">
                            <span class="tooltip-item">?</span>
                            <span class="tooltip-content clearfix">
                                <span class="tooltip-text">
                                    Company administrator login
                                </span>
                            </span>
                        </span>
					</div>
					<div class="box highlight">
						<strong>Customised URL</strong>
						<span class="tooltip tooltip-effect-1">
                            <span class="tooltip-item">?</span>
                            <span class="tooltip-content clearfix">
                                <span class="tooltip-text">
                                   Make a short, easy to remember, share URL 
                                </span>
                            </span>
                        </span>
					</div>
					<div class="box">
						<strong>Levels </strong>
						<span class="tooltip tooltip-effect-1">
                            <span class="tooltip-item">?</span>
                            <span class="tooltip-content clearfix">
                                <span class="tooltip-text">
                                  Company  departements
                                </span>
                            </span>
                        </span>
					</div>
					<div class="box highlight">
						<strong>Sublevels</strong>
						<span class="tooltip tooltip-effect-1">
                            <span class="tooltip-item">?</span>
                            <span class="tooltip-content clearfix">
                                <span class="tooltip-text">
                                 Company subdepartements 
                                </span>
                            </span>
                        </span>
					</div>
					<div class="box">
						<strong>Employee Logins </strong>
						<span class="tooltip tooltip-effect-1">
                            <span class="tooltip-item">?</span>
                            <span class="tooltip-content clearfix">
                                <span class="tooltip-text">
                                    Company employee logins
                                </span>
                            </span>
                        </span>
					</div>
					<div class="box highlight">
						<strong>Space</strong>
						<span class="tooltip tooltip-effect-1">
                            <span class="tooltip-item">?</span>
                            <span class="tooltip-content clearfix">
                                <span class="tooltip-text">
                                    Video space utilisation limit
                                </span>
                            </span>
                        </span>
					</div>
					<div class="box ">
						<strong>Analytics</strong>
						<span class="tooltip tooltip-effect-1">
	                <span class="tooltip-item">?</span>
	                <span class="tooltip-content clearfix">
	                    <span class="tooltip-text">
	                       Stats with graphs
						</span>
	                </span>
	            </span>
					</div>
					<div class="box highlight">
						<strong>Analytical report </strong>
						<span class="tooltip tooltip-effect-1">
	                <span class="tooltip-item">?</span>
	                <span class="tooltip-content clearfix">
	                    <span class="tooltip-text">
	                     Stats with reports & graphs    
						</span>
	                </span>
	            </span>
					</div>
					
					
				
					
					
					
					
					
				</div>

				<div class="booleans cell feature-column" id="left-column">
					<div class="box">
						<?php echo $hostingdetails[0]['admin_logins'];?>
					</div>
					<div class="box highlight">
							<?php if(($hostingdetails[0]['url_customization'])=='N'){ echo '<span class="icon-remove"></span>';}else{ echo '<span class="icon-ok"></span>';} ?>
					</div>
					<div class="box">
						<?php echo $hostingdetails[0]['category_limit'];?>
					</div>
					<div class="box highlight">
						<?php echo $hostingdetails[0]['subcategory_limit'];?>
					</div>
					<div class="box editor">
						<?php echo $hostingdetails[0]['employee_logins'];?>
					</div>
					<div class="box highlight">
						<?php echo $hostingdetails[0]['hosting_space'];?>
					</div>
					<div class="box">
						<?php if(($hostingdetails[0]['analytics_report'])=='N'){ echo '<span class="icon-remove"></span>';}else{ echo '<span class="icon-ok"></span>';} ?>
					</div>
					<div class="box highlight">
						<?php if(($hostingdetails[0]['advance_anlayticsreport'])=='N'){ echo '<span class="icon-remove"></span>';}else{ echo '<span class="icon-ok"></span>';} ?>
					</div>
					
				</div>

				<div class="booleans cell feature-column" id="middle-column">
					<div class="box">
						<?php echo $hostingdetails[1]['admin_logins'];?>
					</div>
					<div class="box highlight">
						<?php if(($hostingdetails[1]['url_customization'])=='N'){ echo '<span class="icon-remove"></span>';}else{ echo '<span class="icon-ok"></span>';} ?>
					</div>
					<div class="box">
						<?php echo $hostingdetails[1]['category_limit'];?>
					</div>
					<div class="box highlight">
						<?php echo $hostingdetails[1]['subcategory_limit'];?>
					</div>
					<div class="box">
						<?php echo $hostingdetails[1]['employee_logins'];?>
					</div>
					<div class="box highlight">
						<?php echo $hostingdetails[1]['hosting_space'];?>
					</div>
					<div class="box">
						<?php if(($hostingdetails[1]['analytics_report'])=='N'){ echo '<span class="icon-remove"></span>';}else{ echo '<span class="icon-ok"></span>';} ?>
					</div>
					<div class="box highlight">
						<?php if(($hostingdetails[1]['advance_anlayticsreport'])=='N'){ echo '<span class="icon-remove"></span>';}else{ echo '<span class="icon-ok"></span>';} ?>
					</div>
					
				</div>
				<div class="booleans cell feature-column" id="middle-column">
					<div class="box">
						<?php echo $hostingdetails[2]['admin_logins'];?>
					</div>
					<div class="box highlight">
						<?php if(($hostingdetails[2]['url_customization'])=='N'){ echo '<span class="icon-remove"></span>';}else{ echo '<span class="icon-ok"></span>';} ?>
					</div>
					<div class="box">
						<?php echo $hostingdetails[2]['category_limit'];?>
					</div>
					<div class="box highlight">
						<?php echo $hostingdetails[2]['subcategory_limit'];?>
					</div>
					<div class="box">
						<?php echo $hostingdetails[2]['employee_logins'];?>
					</div>
					<div class="box highlight">
						<?php echo $hostingdetails[2]['hosting_space'];?>
					</div>
					<div class="box">
						<?php if(($hostingdetails[2]['analytics_report'])=='N'){ echo '<span class="icon-remove"></span>';}else{ echo '<span class="icon-ok"></span>';} ?>
					</div>
					<div class="box highlight">
						<?php if(($hostingdetails[2]['advance_anlayticsreport'])=='N'){ echo '<span class="icon-remove"></span>';}else{ echo '<span class="icon-ok"></span>';} ?>
					</div>
					
				</div>

				<div class="booleans cell feature-column" id="right-column">
					<div class="box">
						<?php echo $hostingdetails[3]['admin_logins'];?>
					</div>
					<div class="box highlight">
						<?php if(($hostingdetails[3]['url_customization'])=='N'){ echo '<span class="icon-remove"></span>';}else{ echo '<span class="icon-ok"></span>';} ?>
					</div>
					<div class="box">
						<?php echo $hostingdetails[3]['category_limit'];?>
					</div>
					<div class="box highlight">
						<?php echo $hostingdetails[3]['subcategory_limit'];?>
					</div>
					<div class="box">
						<?php if($hostingdetails[3]['employee_logins']==0){ echo 'Unlimited'; };?>
					</div>
					<div class="box highlight">
						<?php echo $hostingdetails[3]['hosting_space'];?>
					</div>
					<div class="box">
						<?php if(($hostingdetails[3]['analytics_report'])=='N'){ echo '<span class="icon-remove"></span>';}else{ echo '<span class="icon-ok"></span>';} ?>
					</div>
					<div class="box highlight">
						<?php if(($hostingdetails[3]['advance_anlayticsreport'])=='N'){ echo '<span class="icon-remove"></span>';}else{ echo '<span class="icon-ok"></span>';} ?>
					</div>
					
				</div>
			</div>

			<div class="buttons row">
				<div class="features">
				</div>
				<div class="booleans blue">
					<a href="<?php echo base_url(); ?>admin_company/register/<?php echo $hostingdetails[0]['id'];?>" class="blue buy-button" id="standard-btn">Get Started</a>
				</div>
				<div class="booleans red">
					<a href="<?php echo base_url(); ?>admin_company/register/<?php echo $hostingdetails[1]['id'];?>" class="red buy-button" id="pro-btn">Get Started</a>
					<img src="<?php echo base_url(); ?>assets/assets/plans_assets/images/payment-options.jpg" alt="Secure payment options" />				</div>
				<div class="booleans blue">
					<a href="<?php echo base_url(); ?>admin_company/register/<?php echo $hostingdetails[2]['id'];?>"  class="blue buy-button" id="enterprise-btn">Get Started</a>
				</div>
				<div class="booleans red">
					<a href="<?php echo base_url(); ?>admin_company/register/<?php echo $hostingdetails[3]['id'];?>"  class="red buy-button" id="pro-btn">Get Started</a>
					
				

		</div>


		
	</div>
</div>
	</body>
</html>
