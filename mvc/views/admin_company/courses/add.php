   <div id="content">
	<div class="container">
	<div class="row">
	<div class="col-md-12">
    <style>
	#drop_zone 
	{
      border: 2px dashed #bbb;
      -moz-border-radius: 5px;
      -webkit-border-radius: 5px;
      border-radius: 5px;
      padding: 25px;
      text-align:center;
      font: 20pt bold 'Helvetica';
      color: #bbb;
    }    
    </style>				
<?php
	$planid_currentuser=$this->session->userdata['userplan_id'];
	if($sessionuserdata[0]['available_disk_space'] !==0)
	{
?>	  
   <!--- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">  -->
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
          <a href="#">New</a>
        </li>
      </ul>
      
      <!--<div class="page-header">
        <h2>
          Adding <?php //echo ucfirst($this->uri->segment(2));?>
        </h2>
      </div>-->

    <?php
      //flash messages
      if(isset($flash_message)){
        if($flash_message == TRUE)
        {
			
			// echo $id_course;
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">�</a>';
 echo 'New Course Added Successfully.See your Uploaded course <a style="font-size:16px;font-weight:bold;" href="'.base_url().'admin_company/chapters/add/'.$id_course.'">Click Here</a>';         
          echo '</div>';       
        }else{
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">�</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
	  
      ?>
						<!--=== Inline Tabs ===-->
				<div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h2><i class="icon-reorder"></i>&nbsp;&nbsp;Create the course</h2>
							</div>
							<div class="widget-content">
								<?php
      //form data
      $attributes = array('class' => 'form-horizontal', 'id' => '');

      //form validation
      echo validation_errors();
	  
	echo form_open_multipart('admin_company/courses/add', $attributes);
      ?>
									<div class="alert fade in alert-danger" style="display: none;">
					<i class="icon-remove close" data-dismiss="alert"></i>
					Enter course name.
				</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Course name</label>
										<div class="col-md-10"><input type="text" class="form-control" id="" name="name" placeholder="Enter course name"  data-rule-required="true"  data-msg-required="Please enter course name." />
							<span class="help-inline">( * Enter Course Name)</span>		
										</div>
									</div>
									
									<!--<div class="alert fade in alert-danger" style="display: none;">
					<i class="icon-remove close" data-dismiss="alert"></i>
					Enter course Sub Title.
				</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Course Sub Title</label>
										<div class="col-md-10"><input type="text" class="form-control" name="subtitle" placeholder="Enter Course Sub Title"  data-rule-required="true"  data-msg-required="Please enter Course Sub Title" /></div>
									</div>---->
									
									<div class="form-group">
										<label class="col-md-2 control-label">Author</label>
										<div class="col-md-10"><input type="text" class="form-control"  name="courseby"   placeholder="Enter Author name"  data-rule-required="true"  data-msg-required="Please enter Author name" />
										<span class="help-inline">( * Enter Author Name with minimum 5 characters)</span>	
										</div>
									</div>
									
									
									<div class="form-group">
										<label class="col-md-2 control-label">Course start date</label>
										<div class="col-md-3"><input type="text" class="form-control" name="start_date"  placeholder="Course start date"  data-rule-required="true"  data-msg-required="Course start date" />
										<span class="help-inline">( * Enter course start date)</span>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Course end date</label>
										<div class="col-md-3"><input type="text" class="form-control" name="end_date"  placeholder="Course end date"  data-rule-required="true"  data-msg-required="Course end date" />
										<span class="help-inline">( * Enter course end date)</span>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Course Description <br></label>
										<div class="col-md-10"><textarea class="form-control" name="textarea"  name="description" placeholder="(max 200 words)" cols="5" rows="3"></textarea>
</div>
									</div>
									<?php
	  
	  if($planid_currentuser!=='1')
	  {
		?>
									<div class="form-group">
										<label class="col-md-2 control-label">Sub-Category <br></label>
										<div class="col-md-6"><?php echo form_dropdown('subcategory', $subcategory);  ?></div>
							</div>
			<?php
			}
			else
			{
			?>
				<input type="hidden" name="subcategory" value="17" />
			<?php
			}
			?>
									
									
									<div class="form-group">
										<label class="col-md-2 control-label">Upload Image:</label>
									<div class="col-md-2">
											<input type="file" name="courseimage" id="courseimage">												
										</div>
										<div class="col-md-6">
											<span><b>( * Please upload image of size (540px X 335px) FileSize Upto 2mb )</b></span>
										</div>
										</div>
										
										
									
    	
    	 <div class="form-actions">										
					<button type="reset" class="btn">Reset</button>
					<button type="submit" class="btn btn-primary">Submit</button>
									</div>
								<?php echo form_close(); ?>
								
							 <!-- /.widget-content -->
						</div> <!-- /.widget .box -->
					</div> <!-- /.col-md-12 -->
				</div> <!-- /.row -->
				<!-- /Inline Tabs -->
				</div> <!-- /.row -->
				<!-- /Page Content -->
			</div>
			<!-- /.container -->
<?php
		}
		else
		{
		?>
		<div id="content">
			<div class="container">
		<?php
			echo "<br/></br></br></br>";
			echo "<h3> Sorry you can not add New Course you reach your max limit of Video size Contact to Support system.!!!</h3>";
		
		}
	?>
			</div>
		</div>	 
</div>

<script src="<?php echo base_url(); ?>assets/js/upload.js"></script>
<script type="text/javascript">

       /**
        * Called when files are dropped on to the drop target. For each file,
        * uploads the content to Drive & displays the results when complete.
        */
       function handleFileSelect(evt) {
         evt.stopPropagation();
         evt.preventDefault();
         var files = evt.dataTransfer.files; // FileList object.		
         var accessToken = document.getElementById("accessToken").value;		 
         var upgrade_to_1080 = document.getElementById("upgrade_to_1080").value;
         
         // Clear the results div
         var node = document.getElementById('results');
         while (node.hasChildNodes()) node.removeChild(node.firstChild);

         // Rest the progress bar
         updateProgress(0);
         var success_url=document.createTextNode("Please wait, your video is being uploaded...."); 
				
                var element = document.createElement("div");
                element.setAttribute('class', "alert alert-warning");
                element.appendChild(success_url);
                
                document.getElementById('results_progress').appendChild(element);
                
         var uploader = new MediaUploader({
             file: files[0],
             token: accessToken,
             upgrade_to_1080: upgrade_to_1080,			 	
             onError: function(data) {
               
                var errorResponse = JSON.parse(data);
                message = errorResponse.error;

                var element = document.createElement("div");
                element.setAttribute('class', "alert alert-danger");
                element.appendChild(document.createTextNode(message));
                document.getElementById('results').appendChild(element);
             
             },
             onProgress: function(data) {
                updateProgress(data.loaded / data.total);				
				document.getElementById("videoidsize").value = data.total;
				
             },
             onComplete: function(videoId) {
               document.getElementById("results_progress").style.display = 'none';
                var url = "https://vimeo.com/"+videoId;
                var success_url=document.createTextNode("Your video has been uploaded sucessfully"); 
                //alert(success_url);
                var a = document.createElement('a');
                a.appendChild(document.createTextNode(url));
                a.setAttribute('href',url);				
				document.getElementById("videoidassign").value = videoId;
				
                var element = document.createElement("div");
                element.setAttribute('class', "alert alert-success");
                element.appendChild(success_url);
                
                document.getElementById('results').appendChild(element);
             }
         });
         uploader.upload();
       }

       /**
        * Dragover handler to set the drop effect.
        */
       function handleDragOver(evt) {
         evt.stopPropagation();
         evt.preventDefault();
         evt.dataTransfer.dropEffect = 'copy'; 
       }

       /**
        * Wire up drag & drop listeners once page loads
        */
       document.addEventListener('DOMContentLoaded', function () {
           var dropZone = document.getElementById('drop_zone');
           dropZone.addEventListener('dragover', handleDragOver, false);
           dropZone.addEventListener('drop', handleFileSelect, false);
       });
;
       /**
        * Updat progress bar.
        */
       function updateProgress(progress) {
          progress = Math.floor(progress * 100);
          var element = document.getElementById('progress');
          element.setAttribute('style', 'width:'+progress+'%');
          element.innerHTML = progress+'%';
       }


      progress
     </script>
	</div>