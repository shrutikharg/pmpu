<link rel="shortcut icon" href="/favicon.ico">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">
<link href="<?php echo base_url(); ?>assets/assets/css/plan_design.css" rel="stylesheet" type="text/css" />
<div id="content">
	<div class="container">
				<div class="row">
				<br/>
				<div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h2>Price Plan table</h2>
							</div>
							</div> <!-- /.widget .box -->
					</div> <!-- /.col-md-12 -->
				</div> <!-- /.row -->		
				</div> <!-- /.row -->		
				<!-- /Statboxes -->
				
<?php
//var_dump($hostingdetails);
?>				
				<!--=== Page Content ===-->
				<div class="row">
					<div class="col-md-12">												
		<div style="background:#fff;  margin:0 auto; padding:20px; width: 100%;">
                                    <div class="table">
                                            <table class="pricing">
                                                <tr>
                         <th valign="top" ><h2 class="version">Options<br /></h2></th>
<th valign="top" class="current"><h2><?php echo $hostingdetails[0]['hostingplan_name'];?></h2>
<h3><span class="rupee_style">R</span>0.00</h3></th>
<th valign="top"><h2 class="version"> <?php echo $hostingdetails[1]['hostingplan_name'];?></h2>

				<h3><span class="rupee_style">R</span>3683</h3>
				<span>Per Month</span>

				<p><span class="rupee_style">R</span> 34000 per year <br/></p>
				<p>&nbsp;</p></h2></th>
<th valign="top"><h2 class="version"> <?php echo $hostingdetails[2]['hostingplan_name'];?></h2>

				<h3><span class="rupee_style">R</span>4875</h3>
				<span>Per Month</span>

				<p><span class="rupee_style">R</span> 45000  per year <br/></p></h2></th>
<th valign="top"><h2 class="version"><?php echo $hostingdetails[3]['hostingplan_name'];?></h2>

				<h3><span class="rupee_style">R</span>14516</h3>
				<span>Per Month</span>

				<p><span class="rupee_style">R</span>134000 per year <br/></p></h2>
</th>
</tr>

<tr>
	<td>Admin login &nbsp; <i class="icon-info icon-xsmall u-tooltip-theme-arrows u-tooltip-target" data-tooltip="Company administrator login" data-tooltip-position="right middle"></i></td>
	<td class="current" ><?php echo $hostingdetails[0]['admin_logins'];?></td>
	<td><?php echo $hostingdetails[1]['admin_logins'];?></td>
	<td><?php echo $hostingdetails[2]['admin_logins'];?></td>
	<td><?php echo $hostingdetails[3]['admin_logins'];?></td>
</tr>

<tr>
                                                    <td>Customised URL<i class="icon-info icon-xsmall u-tooltip-theme-arrows u-tooltip-target" data-tooltip=" Make a short, easy to remember, share URL" data-tooltip-position="right middle"></i></td>
                                                    <td class="current">
													<?php if(($hostingdetails[0]['url_customization'])=='N'){ echo '<span class="no">no</span>';}else{ echo '<span class="yes">yes</span>';} ?></td>
                                                    <td><?php if(($hostingdetails[1]['url_customization'])=='N'){ echo '<span class="no">no</span>';}else{ echo '<span class="yes">yes</span>';} ?></td>
                                                    <td><?php if(($hostingdetails[2]['url_customization'])=='N'){ echo '<span class="no">no</span>';}else{ echo '<span class="yes">yes</span>';} ?></td>
                                                    <td><?php if(($hostingdetails[3]['url_customization'])=='N'){ echo '<span class="no">no</span>';}else{ echo '<span class="yes">yes</span>';} ?></td>
                                                </tr>
                                                 
                                                <tr>
                                                    <td>Levels &nbsp; <i class="icon-info icon-xsmall u-tooltip-theme-arrows u-tooltip-target" data-tooltip="Company  departements" data-tooltip-position="right middle"></i></td>
                        <td class="current"><?php echo $hostingdetails[0]['category_limit'];?></td>
                        <td><?php echo $hostingdetails[1]['category_limit'];?></td>
                        <td><?php echo $hostingdetails[2]['category_limit'];?></td>
                        <td><?php echo $hostingdetails[3]['category_limit'];?></td>
                                                </tr>
                                                <tr>
                                                    <td>Sublevels &nbsp; <i class="icon-info icon-xsmall u-tooltip-theme-arrows u-tooltip-target" data-tooltip="Company subdepartements " data-tooltip-position="right middle"></i></td>
                        <td class="current"><?php echo $hostingdetails[0]['subcategory_limit'];?></td>
                        <td><?php echo $hostingdetails[1]['subcategory_limit'];?></td>
                        <td><?php echo $hostingdetails[2]['subcategory_limit'];?></td>
                        <td><?php echo $hostingdetails[3]['subcategory_limit'];?></td>
                                                </tr>
                                                
                                                
                                                <tr>
                                                    <td>Employee Logins<i class="icon-info icon-xsmall u-tooltip-theme-arrows u-tooltip-target" data-tooltip="Company employee logins" data-tooltip-position="right middle"></i></td>
                        <td class="current"><?php echo $hostingdetails[0]['employee_logins'];?></td>
                        <td><?php echo $hostingdetails[1]['employee_logins'];?></td>
                        <td><?php echo $hostingdetails[2]['employee_logins'];?></td>
                        <td><?php if($hostingdetails[3]['employee_logins']==0){ echo 'Unlimited'; };?></td>
                                                </tr>
                                                    <td>Space &nbsp; <i class="icon-info icon-xsmall u-tooltip-theme-arrows u-tooltip-target" data-tooltip="Video space utilisation limit" data-tooltip-position="right middle"></i></td>
                        <td class="current"><?php echo $hostingdetails[0]['hosting_space'];?></td>
                        <td><?php echo $hostingdetails[1]['hosting_space'];?></td>
                        <td><?php echo $hostingdetails[2]['hosting_space'];?></td>
                        <td><?php echo $hostingdetails[3]['hosting_space'];?></td>
                                                </tr>
                                    
                                                <tr>
                                                    <td>Analytics &nbsp; <i class="icon-info icon-xsmall u-tooltip-theme-arrows u-tooltip-target" data-tooltip="Stats with graphs" data-tooltip-position="right middle"></i></td>
                                                 <td class="current">
													<?php if(($hostingdetails[0]['analytics_report'])=='N'){ echo '<span class="no">no</span>';}else{ echo '<span class="yes">yes</span>';} ?></td>
                                                      <td><?php if(($hostingdetails[1]['analytics_report'])=='N'){ echo '<span class="no">no</span>';}else{ echo '<span class="yes">yes</span>';} ?></td>
                                                    <td><?php if(($hostingdetails[2]['analytics_report'])=='N'){ echo '<span class="no">no</span>';}else{ echo '<span class="yes">yes</span>';} ?></td>
                                                    <td><?php if(($hostingdetails[3]['analytics_report'])=='N'){ echo '<span class="no">no</span>';}else{ echo '<span class="yes">yes</span>';} ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Analytical report&nbsp; <i class="icon-info icon-xsmall u-tooltip-theme-arrows u-tooltip-target" data-tooltip="Stats with reports & graphs" data-tooltip-position="right middle"></i></td>
          <td class="current"><?php if(($hostingdetails[0]['advance_anlayticsreport'])=='N'){ echo '<span class="no">no</span>';}else{ echo '<span class="yes">yes</span>';} ?></td>
        <td><?php if(($hostingdetails[1]['advance_anlayticsreport'])=='N'){ echo '<span class="no">no</span>';}else{ echo '<span class="yes">yes</span>';} ?></td>
        <td><?php if(($hostingdetails[2]['advance_anlayticsreport'])=='N'){ echo '<span class="no">no</span>';}else{ echo '<span class="yes">yes</span>';} ?></td>
        <td><?php if(($hostingdetails[3]['advance_anlayticsreport'])=='N'){ echo '<span class="no">no</span>';}else{ echo '<span class="yes">yes</span>';} ?></td>
                                                </tr>
                                                 
                                                
                                                
                                                <tr class="action">
                                                    <td><a href="/contact/">Send Enquiry</a></td>
     <td class="current"><a href="<?php echo base_url(); ?>admin_company/register/<?php echo $hostingdetails[0]['id'];?>" class="a_current"  class="a_demo_four" disabled="disabled">Free</a> 
	 </td>
<td><a href="<?php echo base_url(); ?>admin_company/register/<?php echo $hostingdetails[1]['id'];?>" class="a_demo_four" id="pro-btn">Purchase</a></td>
                                                    <td><a href="<?php echo base_url(); ?>admin_company/register/<?php echo $hostingdetails[2]['id'];?>" disabled="disabled"  href="#" class="a_demo_four"> Purchase</a></td>
                                                    <td><a href="<?php echo base_url(); ?>admin_company/register/<?php echo $hostingdetails[3]['id'];?>"  disabled="disabled"  href="#" class="a_demo_four"> Purchase</a></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>	
				</div>
				<!-- /Normal -->
	</div>
				</div>		
				
			</div>		
				

