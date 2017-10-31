	<div id="content">
	<div class="container">
      
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin_company"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li>
          <a href="<?php echo site_url("admin_company").'/'.$this->uri->segment(2); ?>">
            <?php echo ucfirst($this->uri->segment(2));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li class="active">
          <a href="#">Update</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Updating <?php echo ucfirst($this->uri->segment(2));?>
        </h2>
      </div>

 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> Sub-Category updated with success.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
      ?>
      
      <?php
	  
      //form data
      $attributes = array('class' => 'form-horizontal', 'id' => '');

      //form validation
      echo validation_errors();

      echo form_open('admin_company/subcategory/update/'.$this->uri->segment(4).'', $attributes);
      ?>
        <fieldset>
        <!--=== Page Header ===-->			
				<!--=== Page Content ===-->	
				<div class="row">
					<div class="col-md-12">
						<!-- Tabs-->
						<div class="tabbable tabbable-custom tabbable-full-width">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tab_overview" data-toggle="tab">Summary</a></li>
								<!--<li><a href="#tab_views" data-toggle="tab">Views</a></li>--->
								
								<li><a href="#actions" data-toggle="tab">Actions</a></li>
								<li><a href="#viewers" data-toggle="tab">Viewers</a></li>
								<li><a href="#social" data-toggle="tab">Social</a></li>
							</ul>
							<div class="tab-content row">
								<!--=== Overview ===-->
								<div class="tab-pane active" id="tab_overview">
									<div class="col-md-3">
										<div class="list-group">
											<li class="list-group-item no-padding">
												<img src="assets/img/demo/avatar-large.jpg" alt="">
											</li>
											<a href="javascript:void(0);" class="list-group-item">Courses</a>
											<a href="javascript:void(0);" class="list-group-item">Settings</a>
										</div>
									</div>

									<div class="col-md-9">
										<div class="row profile-info">
											<div class="col-md-7">
												<h1><?php echo $userdetails[0]['first_name'].' '.$userdetails[0]['last_name'];// var_dump($userdetails);?></h1>

												<dl class="dl-horizontal">
													<dt>Description lists</dt>
													<dd>This account of admin user of company  <strong><?php echo $userdetails[0]['company_name'] ?>.</strong></dd>
													<dt>Package plan</dt>
													<dd>Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>
													<dd>Donec id elit non mi porta gravida at eget metus.</dd>
													<dt>Malesuada porta</dt>
													<dd>Etiam porta sem malesuada magna mollis euismod.</dd>
													<dt>Felis euismod semper eget lacinia</dt>
													<dd>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</dd>
												</dl>

												<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt laoreet dolore magna aliquam tincidunt erat volutpat laoreet dolore magna aliquam tincidunt erat volutpat.</p>
											</div>
											<div class="col-md-5">
												<div class="widget">
													<div class="widget-header">
														<h4><i class="icon-reorder"></i> Courses Status</h4>
													</div>
													<div class="widget-content">
														<div id="chart_filled_blue" class="chart"></div>
													</div>
												</div>
											</div>
										</div> <!-- /.row -->

										<div class="row">
											
											<p>&nbsp;</p>
								<p>&nbsp;</p>	
											
                                        <table class="middle" >

									<thead>

										<tr>

											<td width="250">

												<h3>Total Clicks Courses</h3>

											</td>

											<td width="250"><h3>Assigned Courses</h3></td>

											<td width="250"><h3>Completed Course</h3></td>

										</tr>

									</thead>

									<tbody>

										<tr>

											<td>

												<h3 class="middle"><b><?php echo $totcount; ?></b></h3>

											</td>

											<td><h3 class="middle"><b><?php echo $assigncount; ?></b></h3></td>

											<td><h3 class="middle"><b><?php echo $certcount ?><b></h3></td>


										</tr>

										

										

										

																				

									</tbody>

								</table>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
																		
											<div class="col-md-12">

						<div class="widget box">

							<div class="widget-header">

								<h4><i class="icon-reorder"></i>Recent viewers</h4>								

							</div>

							<div class="widget-content">								
<table class="table table-striped table-bordered table-hover table-checkable datatable">
							            <thead>
							              <tr>
							            <th class="header">#</th>
							            <th class="yellow header headerSortDown">Date</th>
									<th class="yellow header headerSortDown">Location</th>
									<th class="yellow header headerSortDown">User Name</th>
								<th class="yellow header headerSortDown">Course Name</th>
							              </tr>
							            </thead>
							            <tbody>
							              <?php
							              foreach($recentviewers as $row)
							              {
							                echo '<tr>';
							                echo '<td>'.$row['id'].'</td>';
							                echo '<td>'.$row['clickcourse_date'].'</td>';
				echo '<td>'.$row['city'].','.$row['region'].','.$row['country'].'</td>';
											echo '<td>'.$row['created_by'].'</td>';
											echo '<td>'.$row['course_name'].'</td>';
							                echo '</tr>';
							              }
							              ?>      
							            </tbody>
							          </table>

							    <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>
							</div>
							
							<div>

</div>
						</div>

					</div>
					
					
					
											<!-- /Striped Table -->
										</div> <!-- /.row -->
									</div> <!-- /.col-md-9 -->
								</div>
								<!-- /Overview -->

								<!--=== Edit Account ===-->
								<div class="tab_views" id="tab_views">
									
									
								</div>
								<div class="tab-pane" id="actions">
									
									
									<table class="middle" >

									<thead>

										<tr>

											<td width="250">

												<h3>Clicks</h3>

											</td>

											<td width="250"><h3>Likes</h3></td>

											<td width="250"><h3>Download</h3></td>

											<td width="250"><h3>Email</h3></td>

										</tr>

									</thead>

									<tbody>

										<tr>

											<td>

												<h3><b>1</b></h3>

											</td>

											<td><h3><b>121</b></h3></td>

											<td><h3><b>61</b></h3></td>

											<td><h3><b>4</b></h3></td>

										</tr>

										

										

										

																				

									</tbody>

								</table>
									
									
									<p>&nbsp;</p>
									<p>&nbsp;</p>
									<p>&nbsp;</p>
									<div class="row">
						<!--=== Inline Tabs ===-->
				
					<div class="col-md-6">
						<div class="widget box">
							<div class="widget-header">
								<h4>Clicks</h4>
							</div>
							<div class="widget-content">
								<div   class="form-horizontal row-border" >
									
									<div class="form-group">
										<label class="col-md-6 left">URL</label>
										<label class="col-md-3  left">Slide no</label>
										<label class="col-md-3  left">Clicks</label>
									</div>
									<div class="form-group">
										<label class="col-md-6 left">Link</label>
										<label class="col-md-3  left">13</label>
										<label class="col-md-3  left">1</label>
									</div>
									
									
									
									
									
									
																                                  
									
								</div>
								
							</div> <!-- /.widget-content -->
						</div> <!-- /.widget .box -->
					</div> <!-- /.col-md-12 -->
					
					<div class="col-md-6">
						<div class="widget box">
							<div class="widget-header">
								<h4>Recent downloads by</h4>
							</div>
							<div class="widget-content">
								<div   class="form-horizontal row-border" >
									
									<div class="form-group">
										<label class="col-md-6 left">URL</label>
										<label class="col-md-3  left">Email-id</label>
										
									</div>
									<div class="form-group">
										<label class="col-md-6 left">Link</label>
										<label class="col-md-3  left">shreedhar.s@modelcamtechnologies.com</label>
										
									</div>
									
									
									
									
									
									
																                                  
									
								</div>
								
							</div> <!-- /.widget-content -->
						</div> <!-- /.widget .box -->
					</div> <!-- /.col-md-12 -->
					<div class="col-md-6">
						<div class="widget box">
							<div class="widget-header">
								<h4>Recent likes by</h4>
							</div>
							<div class="widget-content">
								<div   class="form-horizontal row-border" >
									
									<div class="form-group">
										<label class="col-md-6 left">URL</label>
										<label class="col-md-3  left">Email-id</label>
										
									</div>
									<div class="form-group">
										<label class="col-md-6 left">Link</label>
										<label class="col-md-3  left">shreedhar.s@modelcamtechnologies.com</label>
										
									</div>
									
									
									
									
									
									
																                                  
									
								</div>
								
							</div> <!-- /.widget-content -->
						</div> <!-- /.widget .box -->
					</div> <!-- /.col-md-12 -->
					
				
				<!-- /Inline Tabs -->
				</div> <!-- /.row -->	

										
									
								</div>
								
								
								
								<div class="tab-pane" id="actions">
									
									<div class="row">

					<div class="col-md-12">

						<div class="widget box">

							<div class="widget-header">

								<h4><i class="icon-reorder"></i>All Topics</h4>								

							</div>

							<div class="widget-content">

								<table class="table table-striped table-bordered table-hover table-checkable datatable">

									<thead>

										<tr>

											<th width="40" class="checkbox-column">

												No

											</th>

											<th width="94">Date</th>

											<th width="481">Location</th>

											<th width="341">Name</th>

										</tr>

									</thead>

									<tbody>

										<tr>

											<td class="checkbox-column">

												1

											</td>

											<td>25/9/2015</td>

											<td>Pune</td>

											<td>Mangesh Deshpande</td>

										</tr>

										<tr>

											<td class="checkbox-column">

												2

											</td>

											<td>24/9/2015</td>

											<td>Pune</td>

											<td>Shreedhar Sawant </td>

										</tr>

										<tr>

											<td class="checkbox-column">

												<input type="checkbox" class="uniform">

											</td>

											<td>Darin</td>

											<td>Alec</td>

											<td><span class="label label-success">Edit</span>&nbsp;<span class="label label-success">Delete</span></td>

										</tr>

										<tr>

											<td class="checkbox-column">

												<input type="checkbox" class="uniform">

											</td>

											<td>Andrea</td>

											<td>Brenden</td>

											<td><span class="label label-success">Edit</span>&nbsp;<span class="label label-success">Delete</span></td>

										</tr>

										<tr>

											<td class="checkbox-column">

												<input type="checkbox" class="uniform">

											</td>

											<td>Joey</td>

											<td>Greyson</td>

											<td><span class="label label-success">Edit</span>&nbsp;<span class="label label-success">Delete</span></td>

										</tr>										

									</tbody>

								</table>

							</div>

						</div>

					</div>

				</div>

										
									
								</div>
								
								<div class="tab-pane" id="viewers">
									
									<div class="row">

					<div class="col-md-12">

						<div class="widget box">

							<div class="widget-header">

								<h4><i class="icon-reorder"></i>Recent viewers</h4>								

							</div>

							<div class="widget-content">

<table class="table table-striped table-bordered table-hover table-checkable datatable">
							            <thead>
							              <tr>
							            <th class="header">#</th>
							            <th class="yellow header headerSortDown">Date</th>
									<th class="yellow header headerSortDown">Location</th>
									<th class="yellow header headerSortDown">User Name</th>
								<th class="yellow header headerSortDown">Course Name</th>
							              </tr>
							            </thead>
							            <tbody>
							              <?php
							              foreach($totalrecentviewers as $rowview)
							              {
							                echo '<tr>';
							                echo '<td>'.$rowview['id'].'</td>';
							                echo '<td>'.$rowview['clickcourse_date'].'</td>';
				echo '<td>'.$rowview['city'].','.$rowview['region'].','.$rowview['country'].'</td>';
											echo '<td>'.$rowview['created_by'].'</td>';
											echo '<td>'.$rowview['course_name'].'</td>';
							                echo '</tr>';
							              }
							              ?>      
							            </tbody>
							          </table>

	<?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>
								
							</div>

						</div>

					</div>

				</div>

										
									
								</div>
								
								
								<div class="tab-pane" id="social">
									<div class="col-md-12">
												

								<table class="middle" >

									<thead>

										<tr>

											<td width="250">

												<img src="<?php echo base_url();  ?>assets/img/fb_share.jpg" width="100" />

											</td>

											<td width="250"><img src="<?php echo base_url();  ?>assets/img/twitter_share.jpg" width="100" /></td>

											<td width="250"><img src="<?php echo base_url();  ?>assets/img/linkedin_share.jpg" width="100" /></td>

											<td width="250"><h3>Total Clicks Courses</h3></td>

										</tr>

									</thead>

									<tbody>

										<tr>

											<td>

												<h3>3</h3>

											</td>

											<td><h3>26</h3></td>

											<td><h3>59</h3></td>

											<td><h3><?php echo $totcount; ?></h3></td>

										</tr>

										

										

										

																				

									</tbody>

								</table>

							</div>
											</div>
							</div> <!-- /.tab-content -->
						</div>
						<!--END TABS-->
					</div>
				</div> <!-- /.row -->
				<!-- /Inline Tabs -->
				<!-- /Page Content -->
			</div>
			<!-- /.container -->

		</div>
	</div>
        </fieldset>

      <?php echo form_close(); ?>

		</div>
	</div>

    