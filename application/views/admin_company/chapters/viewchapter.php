
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
						<h3>Chapter Details</h3>
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
								<li class="active"><a href="#tab_overview" data-toggle="tab">Chapter Details</a></li>
	<li class=""><a href="#tab_edit_account" data-toggle="tab">Analytics Chapter</a></li>
							</ul>
							<div class="tab-content row">
								<!--=== Overview ===-->
								<div class="tab-pane active" id="tab_overview">
									<div class="col-md-1"></div>
									<div class="col-md-10">
										<div class="row profile-info">
							<div class="widget-content">
							
	<div class="form-horizontal">
									<div class="alert fade in alert-danger" style="display: none;">
					<i class="icon-remove close" data-dismiss="alert"></i>
					Enter Chapters name.
				</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Chapter name</label>
										<div class="col-md-10"><input type="text" class="form-control" id="" name="cname" readonly value="<?php echo $chaptersdata[0]['name']; ?>" placeholder="Enter chapter name"  data-rule-required="true"  data-msg-required="Please enter course name." /></div>
									</div>
						
						
									<div class="form-group">
										<label class="col-md-2 control-label">Chapter Description <br></label>
										<div class="col-md-10"><textarea class="form-control"  readonly value="<?php echo $chaptersdata[0]['description']; ?>" name="description" placeholder="(max 200 words)" cols="5" rows="3"></textarea></div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Courses <br></label>
										<div class="col-md-6"><?php
			
				$selected=$chaptersdata[0]['courseid'];				
		echo form_dropdown('courseid', $coursedropdown, set_value('courseid', $selected));
				
				?></div>
									</div>
									
							
	<div class="form-group">
										<label class="col-md-2 control-label">Chapter Video Thumbnail:</label>
									<?php //var_dump($chaptersdata); ?>
									<div class="col-md-10"> <img width="340px"  src="http://placehold.it/640x360" class="video-thumb" data-vimeo-id="<?php echo $chaptersdata[0]['chapter_videoid']; ?>" /></div>
	
	</div>
						<!-- /.widget-content -->						
					</div> <!-- /.col-md-12 -->
				</div> <!-- /.row -->
			</div>
										
									</div> <!-- /.col-md-9 -->
								</div>
								<!-- /Overview -->

								<!--=== Edit Account ===-->
								<div class="tab-pane" id="tab_edit_account">
<div class="form-horizontal">			<div class="col-md-1"></div>				
										<div class="col-md-11">
											<div class="widget">
												<div class="widget-header">
													<h4>General Information</h4>
												</div>
												<div class="widget-content">
													<div class="row">
														<div class="span12 columns">
          <div class="well">
		<div class="form-horizontal">
    <?php 
	//var_dump($dispdata);
		if(count($dispdata)>0)
		{	
	?>
        <div class="span12 columns">  
			<?php
				echo $this->gcharts->AreaChart('Inventory')->outputInto('inventory_div');
			    //echo $this->gcharts->ColumnChart('Inventory')->outputInto('inventory_div');
			    echo $this->gcharts->div(300,200);

			    if($this->gcharts->hasErrors())
			    {
			        echo $this->gcharts->getErrors();
			    }
				//var_dump($courses);	
				
			?>
			</div>
        </div>
			
	</div>
	
<div class="row">
        <div class="span12 columns">
          <div class="well">
	<table class="table table-striped table-bordered table-hover table-checkable datatable">
            <thead>
              <tr >
                <th class="header">Sr.No</th>                
				<th class="yellow header headerSortDown">Acess Date</th>
				<th class="yellow header headerSortDown">Count Of Hits</th>
              </tr>
            </thead>
            <tbody>
              <?php
				$i=0;
				foreach($listdtils as $row)
              {
                echo '<tr>';
					echo '<td>'.$i.'</td>';	                
					echo '<td>'.$row['clickcourse_date'].'</td>';
					echo '<td>'.$row['cnt'].'</td>';
                echo '</tr>';
				$i++;
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
<?php
	}
	else
	{
		echo '<div class="alert alert-danger">No Data for that Date Or Course Please Try With Other <a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>';
		
	}

	
?>	
            <script>
                $('#dateOnlyExample .date').datepicker({
                    'format': 'yyyy-m-d',
                    'autoclose': true
                });

                var dateOnlyExampleEl = document.getElementById('dateOnlyExample');
                var dateOnlyDatepair = new Datepair(dateOnlyExampleEl);
            </script>        

            <script>
                // initialize input widgets
                // ptTimeSelect doesn't trigger change event by default
                $('#alternateUiWidgetsExample .time').ptTimeSelect({
                    'onClose': function($self) {
                        $self.trigger('change');
                    }
                });

                
            </script>
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
</div>
	
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/thumbnail/jquery-smartvimeoembed.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/thumbnail/local.js"></script>