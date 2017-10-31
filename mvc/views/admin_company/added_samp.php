<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
    <style>
   
    /* Sticky footer styles
    -------------------------------------------------- */
    html {
      position: relative;
      min-height: 100%;
    }
    body {
      /* Margin bottom by footer height */
      margin-bottom: 60px;
    }
    .footer {
      position: absolute;
      bottom: 0;
      width: 100%;
      /* Set the fixed height of the footer here */
      height: 60px;
      background-color: #f5f5f5;
    }
    
    /* Custom page CSS
    -------------------------------------------------- */
    /* Not required for template or sticky footer method. */
    
    .container {
      width: auto;
      max-width: 680px;
      padding: 0 15px;
    }
    .container .text-muted {
      margin: 20px 0;
    }

  #drop_zone {
      border: 2px dashed #bbb;
      -moz-border-radius: 5px;
      -webkit-border-radius: 5px;
      border-radius: 5px;
      padding: 25px;
      text-align: center;
      font: 20pt bold 'Helvetica';
      color: #bbb;
    }
    
    </style>
   <div id="content">
	<div class="container">
	<div class="row">
	<div class="col-md-12">
				
<?php
	if($sessionuserdata[0]['space_filled'] =='N')
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
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> new courses created with success.See your Uploaded course <a href="http://coolacharya.com/companyadminapp/admin_company/analytics">Click </a>';         
          echo '</div>';       
        }else{
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
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
										<div class="col-md-10"><input type="text" class="form-control" id="" name="name" placeholder="Enter course name"  data-rule-required="true"  data-msg-required="Please enter course name." /></div>
									</div>
									<div class="alert fade in alert-danger" style="display: none;">
					<i class="icon-remove close" data-dismiss="alert"></i>
					Enter course Sub Title.
				</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Course Sub Title</label>
										<div class="col-md-10"><input type="text" class="form-control" name="subtitle" placeholder="Enter Course Sub Title"  data-rule-required="true"  data-msg-required="Please enter Course Sub Title" /></div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Author</label>
										<div class="col-md-10"><input type="text" class="form-control"  name="courseby"   placeholder="Enter Author name"  data-rule-required="true"  data-msg-required="Please enter Author name" /></div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Course requirements</label>
										<div class="col-md-10"><input type="text" class="form-control" name="requirements" placeholder="Enter Course requirements"  data-rule-required="true"  data-msg-required="Please enter Course requirements" /></div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Course price</label>
										<div class="col-md-10"><input type="text" class="form-control" name="price"  placeholder="Enter Course price"  data-rule-required="true"  data-msg-required="Please enter Course price" /></div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Course Validity</label>
										<div class="col-md-10"><input type="text" class="form-control" name="validity"  placeholder="Enter Course validity"  data-rule-required="true"  data-msg-required="Please enter Course validity" /></div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Course Description <br></label>
										<div class="col-md-10"><textarea class="form-control" name="textarea"  name="description" placeholder="(max 200 words)" cols="5" rows="3"></textarea></div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Sub-Category <br></label>
										<div class="col-md-6"><?php echo form_dropdown('subcategory', $subcategory);  ?></div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Course Goals <br></label>
										<div class="col-md-10"><textarea class="form-control" name="goals" placeholder="(max 200 words)" cols="5" rows="3"></textarea></div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Upload Image:</label>
									<div class="col-md-10">
											<input type="file" name="courseimage" id="courseimage">
										</div>
										</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Upload Video<br><small>(max size - 100MB)</small>:</label>
									<div class="col-md-10">
								 <input type="hidden" id="accessToken" readonly class="form-control" placeholder="Vimeo access token" 
   required value="e6085f199f3445356e4f950691bfb904"></input>
      <div class="checkbox">
        <label>
          <input type="checkbox" id="upgrade_to_1080" name="upgrade_to_1080" value="yes"> Upgrade to 1080 </input>
        </label>
    </div>
      </div>
      <br>
    <div class="progress">
        <div id="progress" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="46" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
         0%
        </div>
    </div>
    <div class="col-md-10">  <div id="drop_zone">Drop files here</div>
      <br>
    <div id="results"></div> </div>

	
		<input type="hidden" id="videoidassign" name="videoidassign">	
		<input type="hidden" id="videoidsize" name="videoidsize">
		
	
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
               
                var url = "https://vimeo.com/"+videoId;
               
                var a = document.createElement('a');
                a.appendChild(document.createTextNode(url));
                a.setAttribute('href',url);				
				document.getElementById("videoidassign").value = videoId;
				
                var element = document.createElement("div");
                element.setAttribute('class', "alert alert-success");
                element.appendChild(a);
                
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

     <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      
        ga('create', 'UA-57984417-1', 'auto');
        ga('send', 'pageview');
      
     </script>	

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
	</div>