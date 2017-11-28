<link rel="shortcut icon" href="/favicon.ico">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">
<link href="<?php echo base_url(); ?>assets/assets/css/prices.css" rel="stylesheet" type="text/css" />
<div id="content">
	<div class="container">
				<div class="row">
				<br/>
				<div class="row">
					<div class="col-md-12">
						<div class="widget box">
			  				<div class="widget-header">
								<h2>Welcome to an awesome learning experience</h2>
							</div>
							<img src="<?php echo base_url(); ?>assets/images/Course_start.jpg" alt="Start Page" />
							</div> <!-- /.widget .box -->
					</div> <!-- /.col-md-12 -->
				</div> <!-- /.row -->		
				</div> <!-- /.row -->		
				<!-- /Statboxes -->

				
<?php
$planidusers=$this->session->userdata('userplan_id');
?>				
				<!--=== Page Content ===-->
				<div class="row">
					<div class="col-md-12">												
			<div id="pricing_header"></div>
		<div id="main-table">
	<div class="head table">

		<div class="logo cell middle">
			<h3 class="header_style">Pricing</h3>
					</div>

		<div class="pricing cell bottom">

<div class="standard" id="enterprise">
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
					<div <?php if($planidusers =='1'){ echo 'class="selected_column"'; }else{ echo 'class="box"'; }?>>
						<?php echo $hostingdetails[0]['admin_logins'];?>
					</div>
					<div <?php if($planidusers =='1'){ echo 'class="selected_column"'; }else{ echo 'class="box highlight"'; }?>>
							<?php if(($hostingdetails[0]['url_customization'])=='N'){ echo '<span class="icon-remove"></span>';}else{ echo '<span class="icon-ok"></span>';} ?>
					</div>
					<div <?php if($planidusers =='1'){ echo 'class="selected_column"'; }else{ echo 'class="box"'; }?> >
						<?php echo $hostingdetails[0]['category_limit'];?>
					</div>
					<div <?php if($planidusers =='1'){ echo 'class="selected_column"'; }else{ echo 'class="box highlight"'; }?>>
						<?php echo $hostingdetails[0]['subcategory_limit'];?>
					</div>
					<div <?php if($planidusers =='1'){ echo 'class="selected_column"'; }else{ echo 'class="box"'; }?>>
						<?php echo $hostingdetails[0]['employee_logins'];?>
					</div>
					<div <?php if($planidusers =='1'){ echo 'class="selected_column"'; }else{ echo 'class="box highlight"'; }?>>
						<?php echo $hostingdetails[0]['hosting_space'];?>
					</div>
					<div <?php if($planidusers =='1'){ echo 'class="selected_column"'; }else{ echo 'class="box"'; }?>>
						<?php if(($hostingdetails[0]['analytics_report'])=='N'){ echo '<span class="icon-remove"></span>';}else{ echo '<span class="icon-ok"></span>';} ?>
					</div>
					<div <?php if($planidusers =='1'){ echo 'class="selected_column"'; }else{ echo 'class="box highlight"'; }?>>
						<?php if(($hostingdetails[0]['advance_anlayticsreport'])=='N'){ echo '<span class="icon-remove"></span>';}else{ echo '<span class="icon-ok"></span>';} ?>
					</div>
					
				</div>

				<div class="booleans cell feature-column" id="middle-column">
					<div <?php if($planidusers =='2'){ echo 'class="selected_column"'; }else{ echo 'class="box"'; }?>>
						<?php echo $hostingdetails[1]['admin_logins'];?>
					</div>
					<div <?php if($planidusers =='2'){ echo 'class="selected_column"'; }else{ echo 'class="box highlight"'; }?>>
							<?php if(($hostingdetails[1]['url_customization'])=='N'){ echo '<span class="icon-remove"></span>';}else{ echo '<span class="icon-ok"></span>';} ?>
					</div>
					<div <?php if($planidusers =='2'){ echo 'class="selected_column"'; }else{ echo 'class="box"'; }?> >
						<?php echo $hostingdetails[2]['category_limit'];?>
					</div>
					<div <?php if($planidusers =='2'){ echo 'class="selected_column"'; }else{ echo 'class="box highlight"'; }?>>
						<?php echo $hostingdetails[1]['subcategory_limit'];?>
					</div>
					<div <?php if($planidusers =='2'){ echo 'class="selected_column"'; }else{ echo 'class="box"'; }?>>
						<?php echo $hostingdetails[1]['employee_logins'];?>
					</div>
					<div <?php if($planidusers =='2'){ echo 'class="selected_column"'; }else{ echo 'class="box highlight"'; }?>>
						<?php echo $hostingdetails[1]['hosting_space'];?>
					</div>
					<div <?php if($planidusers =='2'){ echo 'class="selected_column"'; }else{ echo 'class="box"'; }?>>
						<?php if(($hostingdetails[1]['analytics_report'])=='N'){ echo '<span class="icon-remove"></span>';}else{ echo '<span class="icon-ok"></span>';} ?>
					</div>
					<div <?php if($planidusers =='2'){ echo 'class="selected_column"'; }else{ echo 'class="box highlight"'; }?>>
						<?php if(($hostingdetails[1]['advance_anlayticsreport'])=='N'){ echo '<span class="icon-remove"></span>';}else{ echo '<span class="icon-ok"></span>';} ?>
					</div>
					
				</div>
				<div class="booleans cell feature-column" id="middle-column">
					<div <?php if($planidusers =='3'){ echo 'class="selected_column"'; }else{ echo 'class="box"'; }?>>
						<?php echo $hostingdetails[2]['admin_logins'];?>
					</div>
					<div <?php if($planidusers =='3'){ echo 'class="selected_column"'; }else{ echo 'class="box highlight"'; }?>>
							<?php if(($hostingdetails[2]['url_customization'])=='N'){ echo '<span class="icon-remove"></span>';}else{ echo '<span class="icon-ok"></span>';} ?>
					</div>
					<div <?php if($planidusers =='3'){ echo 'class="selected_column"'; }else{ echo 'class="box"'; }?> >
						<?php echo $hostingdetails[2]['category_limit'];?>
					</div>
					<div <?php if($planidusers =='3'){ echo 'class="selected_column"'; }else{ echo 'class="box highlight"'; }?>>
						<?php echo $hostingdetails[2]['subcategory_limit'];?>
					</div>
					<div <?php if($planidusers =='3'){ echo 'class="selected_column"'; }else{ echo 'class="box"'; }?>>
						<?php echo $hostingdetails[2]['employee_logins'];?>
					</div>
					<div <?php if($planidusers =='3'){ echo 'class="selected_column"'; }else{ echo 'class="box highlight"'; }?>>
						<?php echo $hostingdetails[2]['hosting_space'];?>
					</div>
					<div <?php if($planidusers =='3'){ echo 'class="selected_column"'; }else{ echo 'class="box"'; }?>>
						<?php if(($hostingdetails[2]['analytics_report'])=='N'){ echo '<span class="icon-remove"></span>';}else{ echo '<span class="icon-ok"></span>';} ?>
					</div>
					<div <?php if($planidusers =='3'){ echo 'class="selected_column"'; }else{ echo 'class="box highlight"'; }?>>
						<?php if(($hostingdetails[2]['advance_anlayticsreport'])=='N'){ echo '<span class="icon-remove"></span>';}else{ echo '<span class="icon-ok"></span>';} ?>
					</div>
				</div>

				<div class="booleans cell feature-column" id="right-column">
					<div <?php if($planidusers =='4'){ echo 'class="selected_column"'; }else{ echo 'class="box"'; }?>>
						<?php echo $hostingdetails[3]['admin_logins'];?>
					</div>
					<div <?php if($planidusers =='4'){ echo 'class="selected_column"'; }else{ echo 'class="box highlight"'; }?>>
							<?php if(($hostingdetails[3]['url_customization'])=='N'){ echo '<span class="icon-remove"></span>';}else{ echo '<span class="icon-ok"></span>';} ?>
					</div>
					<div <?php if($planidusers =='4'){ echo 'class="selected_column"'; }else{ echo 'class="box"'; }?> >
						<?php echo $hostingdetails[3]['category_limit'];?>
					</div>
					<div <?php if($planidusers =='4'){ echo 'class="selected_column"'; }else{ echo 'class="box highlight"'; }?>>
						<?php echo $hostingdetails[3]['subcategory_limit'];?>
					</div>
					<div <?php if($planidusers =='4'){ echo 'class="selected_column"'; }else{ echo 'class="box"'; }?>>
						<?php echo $hostingdetails[3]['employee_logins'];?>
					</div>
					<div <?php if($planidusers =='4'){ echo 'class="selected_column"'; }else{ echo 'class="box highlight"'; }?>>
						<?php echo $hostingdetails[3]['hosting_space'];?>
					</div>
					<div <?php if($planidusers =='4'){ echo 'class="selected_column"'; }else{ echo 'class="box"'; }?>>
						<?php if(($hostingdetails[3]['analytics_report'])=='N'){ echo '<span class="icon-remove"></span>';}else{ echo '<span class="icon-ok"></span>';} ?>
					</div>
					<div <?php if($planidusers =='4'){ echo 'class="selected_column"'; }else{ echo 'class="box highlight"'; }?>>
						<?php if(($hostingdetails[3]['advance_anlayticsreport'])=='N'){ echo '<span class="icon-remove"></span>';}else{ echo '<span class="icon-ok"></span>';} ?>
					</div>
				</div>
			</div>

			<div class="buttons">
				<div class="features">
				</div>
				<div <?php if($planidusers =='1'){ echo 'class="booleans green"'; }else{ echo 'class="booleans blue"';}?>>
					<a href="<?php echo base_url(); ?>admin_company/register/<?php echo $hostingdetails[0]['id'];?>" <?php if($planidusers =='1'){ echo 'class="green buy-button"'; }else{ echo 'class="blue buy-button"';}?> id="standard-btn">Upgrade</a>
				</div>
				<div <?php if($planidusers =='2'){ echo 'class="booleans green"'; }else{ echo 'class="booleans red"';}?>>
					<a href="<?php echo base_url(); ?>admin_company/register/<?php echo $hostingdetails[1]['id'];?>" <?php if($planidusers =='2'){ echo 'class="green buy-button"'; }else{ echo 'class="red buy-button"';}?> id="pro-btn">Upgrade</a>
				</div>
				<div <?php if($planidusers =='3'){ echo 'class="booleans green"'; }else{ echo 'class="booleans blue"';}?>>
					<a href="<?php echo base_url(); ?>admin_company/register/<?php echo $hostingdetails[2]['id'];?>"  <?php if($planidusers =='3'){ echo 'class="green buy-button"'; }else{ echo 'class="blue buy-button"';}?> id="enterprise-btn">Upgrade</a>
				</div>
				<div <?php if($planidusers =='4'){ echo 'class="booleans green"'; }else{ echo 'class="booleans red"';}?>>
					<a href="<?php echo base_url(); ?>admin_company/register/<?php echo $hostingdetails[3]['id'];?>"  <?php if($planidusers =='4'){ echo 'class="green buy-button"'; }else{ echo 'class="red buy-button"';}?> id="pro-btn">Upgrade</a>
					
				

		</div>


		
	</div>
</div>
			</div>		</div>		</div>		
	
