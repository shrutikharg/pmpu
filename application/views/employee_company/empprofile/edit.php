
<div id="content">
<div class="container">
				<!-- Breadcrumbs line -->
				<div class="crumbs">
					<ul id="breadcrumbs" class="breadcrumb">
						<li>
							<i class="icon-home"></i>
							<a href="dashboard_s">Admin</a>
						</li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>My Profile</h3>
					</div>
					
					 
				</div>
				<!-- /Page Header -->
				<?php

//var_dump($users);

?>															<!--=== Page Content ===-->	
				<div class="row">
				
				
					<div class="col-md-12">
						<!-- Tabs-->
						<div class="tabbable tabbable-custom tabbable-full-width">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tab_overview" data-toggle="tab">Overview</a></li>
								<li class=""><a href="#tab_edit_account" data-toggle="tab">Edit Profile</a></li>
							</ul>
							<div class="tab-content row">
								<!--=== Overview ===-->
								<div class="tab-pane active" id="tab_overview">
								
									<div class="col-md-9">
										<div class="row profile-info">
											<div class="col-md-7">
												<dl class="dl-horizontal">
													<dt>Name</dt>
													<dd><?php echo $users[0]['first_name'].' '.$users[0]['last_name']; ?></dd> <br>
													<dt>Email-Id</dt>
													<dd><?php echo $users[0]['email']; ?></dd> <br>
													<!--<dt>Alternate Email-Id</dt>
													<dd>harshad25@gmail.com</dd><br>-->
													<dt>Mobile No.</dt>
													<dd>+91 <?php echo $users[0]['phone_no']; ?></dd>
												</dl>
											</div>
										</div> <!-- /.row -->

										
									</div> <!-- /.col-md-9 -->
								</div>
								<!-- /Overview -->

								<!--=== Edit Account ===-->
								<div class="tab-pane" id="tab_edit_account">
								<script>function validate_profile()
{alert('hi');document.getElementById('ginfo').submit();}</script>
<?php
      //form data
    $attributes = array('class' => 'form-horizontal', 'id' => 'ginfo');	
	echo validation_errors();
	echo form_open_multipart('admin_company/userprofile/'.$this->uri->segment(3).'', $attributes);
	//var_dump($users);	
	?>								
										<div class="col-md-12">
											<div class="widget">
												<div class="widget-header">
													<h4>General Information</h4>
												</div>
												<div class="widget-content">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="col-md-4 control-label">First name:</label>
																<div class="col-md-8"><input type="text" name="user_fname" id="user_fname" class="form-control" value="<?php echo $users[0]['first_name'];?>" readonly="true"></div>
															</div>

															<div class="form-group">
																<label class="col-md-4 control-label">Last name:</label>
																<div class="col-md-8"><input type="text" name="user_lname" id="user_lname" class="form-control" value="<?php echo $users[0]['last_name'];?>" readonly="true"></div>
															</div>
														</div>


														<div class="col-md-6">
															<div class="form-group">
																<label class="col-md-4 control-label">Email-Id:</label>
																<div class="col-md-8"><input type="email" name="user_email" id="user_email" class="form-control" value="<?php echo $users[0]['email'];?>" readonly="true"></div>
															</div>
															
															<!--<div class="form-group">
																<label class="col-md-4 control-label">Alternate Email-Id:</label>
																<div class="col-md-8"><input type="text" name="ualternameemail" id="ualternameemail" class="form-control" value="harshad25@gmail.com"></div>
															</div>-->

															<div class="form-group">
																<label class="col-md-4 control-label">Mobile No.:</label>
																<div class="col-md-8"><input type="text" name="umobile" id="umobile" class="form-control" value="<?php echo $users[0]['phone_no']; ?>"></div>
															</div>
															<span id="msg" style="display:block;color:red;float: left;padding: 0px;font-size:14px;"></span>
														</div>

														
													</div> <!-- /.row -->
													<div class="form-actions">
														<!--<span id="msg" style="display:block;color:#ff8d78;margin-top: -10px;float: left;padding: 0px;"></span>-->
														
            <button class="btn btn-primary pull-right" type="submit">Update Profile</button>
														<!--- <input type="button" value="Update Profile" id="update_profile" class="btn btn-primary pull-right" onclick="submit_ginfo();">-->
													</div>
												</div> <!-- /.widget-content -->
											</div> <!-- /.widget -->
										</div> <!-- /.col-md-12 -->
										</form>	

										<div class="col-md-12">
											<div class="widget">
												<div class="widget-header">
													<h4>My plan</h4>
												</div>
												<div class="widget-content">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="col-md-4 control-label">User type:</label>
																<div class="col-md-8"><input type="text" name="user_type" id="user_type" class="form-control" value="<?php echo $users[0]['name']; ?>" readonly="true"></div>
															</div>

															
														</div>


														<div class="col-md-6">
															<div class="form-group">
																<label class="col-md-4 control-label">Plan:</label>
																<div class="col-md-8"><input type="text" name="plan" id="plan" class="form-control" value="<?php echo $users[0]['hostingplan_name']; ?>" readonly="true"></div>
															</div>
													</div> <!-- /.row -->										
												</div> <!-- /.widget-content -->
											</div> <!-- /.widget -->
										</div> <!-- /.col-md-12 -->										
										<?php
      //form data
    $attributes = array('class' => 'form-vertical login-form', 'id' => 'pwdchange');	
	echo validation_errors();
	echo form_open_multipart('admin_company/pwdchange/'.$this->uri->segment(3).'', $attributes);
	//var_dump($users);	
	?>

										<div class="col-md-12 form-vertical no-margin">
											<div class="widget">
												<div class="widget-header">
													<h4>Settings</h4>
												</div>
												<div class="widget-content">
													
													<div class="row">
														<div class="col-md-4 col-lg-2">
															<strong class="subtitle">Change password</strong>
															<p class="text-muted"></p>
														</div>

														<div class="col-md-8 col-lg-10">
															<div class="form-group">
																<label class="control-label">Old password:</label>
																<input type="password" name="old_password" id="old_password" class="form-control" placeholder="Enter Your Old Password">
															</div>

															<div class="form-group">
																<label class="control-label">New password:</label>
																<input type="password" name="new_password" id="new_password" class="form-control" placeholder="Enter New Password">
															</div>

															<div class="form-group">
																<label class="control-label">Confirm password:</label>
																<input type="password" name="new_password_repeat" id="new_password_repeat" class="form-control" placeholder="Re-enter New Password">
															</div>
															
															<span id="msgpwd" style="display:block;color:red;float: left;padding: 0px;font-size:14px;"></span>
														</div>
													</div> <!-- /.row -->
												</div> <!-- /.widget-content -->
											</div> <!-- /.widget -->

											<div class="form-actions">
            <button class="btn btn-primary" type="submit">Update Password</button>
          </div>
											<!--<div class="form-actions">
												<input type="button" value="Update Password" id="update_pwd" class="btn btn-primary pull-right" onclick="submit_pwdchange();">
											</div>-->
										</div> <!-- /.col-md-12 -->
									</form>	
								</div>
								<!-- /Edit Account -->
							</div> <!-- /.tab-content -->
						</div>
						<!--END TABS-->
					</div>
				</div> <!-- /.row -->
				<!-- /Inline Tabs -->
				<!-- /Page Content -->
			</div>
</div>
	</div>
