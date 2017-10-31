<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<style>
<style type="text/css">
@import url(http://fonts.googleapis.com/css?family=Roboto:500,100,300,700,400);


.certificate_button_show
{
	display: block;
	
}	
.certificate_button
{
	display: none;
	
}	


div.stars {
  width: 270px;
  display: inline-block;
}

input.star { display: none; }

label.star {
  float: right;
  padding: 10px;
  font-size: 36px;
  color: #444;
  transition: all .2s;
}

input.star:checked ~ label.star:before {
  content: '\f005';
  color: #FD4;
  transition: all .25s;
}

input.star-5:checked ~ label.star:before {
  color: #FE7;
  text-shadow: 0 0 20px #952;
}

input.star-1:checked ~ label.star:before { color: #F62; }

label.star:hover { transform: rotate(-15deg) scale(1.3); }

label.star:before {
  content: '\f006';
  font-family: FontAwesome;
}	
	
</style>
<div id="content">
			<div class="container">
				<!-- Breadcrumbs line -->
				<div class="crumbs">
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
				          <a href="#">Edit</a>
				        </li>
				      </ul>				      
				</div>
				
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
					<h2>
				          Update Comment
				        </h2>	
					</div>					
				</div>
				<div class="row row-bg"> <!-- .row-bg -->
					<div class="col-sm-6 col-md-2">
						<div class="statbox widget box box-shadow">
							<div class="widget-content">
								<div class="visual cyan">
									<i class="icon-user"></i>
								</div>
								<div class="title">View All Comments</div>
								<a class="more" href="<?php echo base_url(); ?>admin_company/commenting">Click Here<i class="pull-right icon-angle-right"></i></a>
							</div>
						</div> <!-- /.smallstat -->
					</div> <!-- /.col-md-2 -->

									
				</div> <!-- /.row -->
				<!-- /Statboxes -->
				<!--=== Normal ===-->
				<div class="row">
				<?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> User Comments updated with success.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
      ?>
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
							<h3><i class="icon-reorder"></i> Edit Comment</h3>	
							</div>
							<div class="widget-content">
								<?php
      //form data
      $attributes = array('class' => 'form-horizontal', 'id' => '');
		//var_dump($category);
      //form validation
      echo validation_errors();

    echo form_open('admin_company/commenting/update/'.$this->uri->segment(4).'', $attributes);
      ?>
									<div class="form-group">
										<label class="col-md-2 control-label">Employee  name:</label>
										<div class="col-md-10"><input type="text"  name="name" class="form-control" readonly value="<?php echo $category[0]['first_name'].' '.$category[0]['last_name']; ?>" ></div>
									</div>
									
									<div class="form-group">
										<label class="col-md-2 control-label">Employee  useremailid:</label>
										<div class="col-md-10"><input type="text"  name="name" class="form-control" readonly value="<?php echo $category[0]['email']; ?>" ></div>
									</div>
									
									<div class="form-group">
										<label class="col-md-2 control-label">Course  Name:</label>
										<div class="col-md-10"><input type="text"  name="name" class="form-control" readonly value="<?php echo $category[0]['course_name']; ?>" ></div>
									</div>
									
									<div class="form-group">
										<label class="col-md-2 control-label">Comments:</label>
										<div class="col-md-10"><textarea id="" name="comments" class="form-control" ><?php echo $category[0]['comments']; ?></textarea></div>
									</div>
								<?php //echo $category[0]['rating_star']; ?>
								
								<div class="form-group">
									<label class="col-md-2 control-label">Rating:</label>
										<div class="col-md-10">
	<input value="5" class="star star-5" id="star-5" type="radio" <?php if($category[0]['rating_star']== 5){echo 'checked'; } ?> name="star"/>
					      <label class="star star-5" for="star-5"></label>
					      <input value="4" <?php if($category[0]['rating_star']==4){echo 'checked'; }?> class="star star-4" id="star-4" type="radio" name="star"/>
					      <label class="star star-4" for="star-4"></label>
					      <input value="3" <?php if($category[0]['rating_star']==3){echo 'checked'; }?> class="star star-3" id="star-3" type="radio" name="star"/>
					      <label class="star star-3" for="star-3"></label>
					      <input value="2" <?php if($category[0]['rating_star']==2){echo 'checked'; }?> class="star star-2" id="star-2" type="radio" name="star"/>
					      <label class="star star-2" for="star-2"></label>
					      <input value="1" <?php if($category[0]['rating_star']==1){echo 'checked'; }?> class="star star-1" id="star-1" type="radio" name="star"/>
					      <label class="star star-1" for="star-1"></label>					   
            </div>
									</div>
									
									
									
                                    
        <!--<div class="control-group">
            <label for="inputError" class="control-label">Status</label>
            <div class="controls">
			<?php
			$dd_list = array(
                  'Y'   => 'Active',
                  'N'   => 'In Active'
                );

			 $select = $category[0]['IsActive']; 

			//echo form_dropdown('status', $dd_list, $select);
			?>
            </div>
		</div>-->

				<div class="form-actions">
								<button type="submit" class="btn btn-primary">Save</button>
                                <button type="reset" class="btn">Cancel</button>
                                        </div>
								 <?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
				<!-- /Normal -->
			
				<!-- /Page Content -->
			</div>
			<!-- /.container -->

		</div>
	</div>