<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
<style>

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
                //if($sessionuserdata[0]['space_filled'] =='N')
                {
                    ?>	  
                    <!--- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">  -->
                    <ul class="breadcrumb">
                        <li>
                            <a href="<?php echo site_url("admin_company"); ?>">
                                <?php echo ucfirst($this->uri->segment(1)); ?>
                            </a> 
                            <span class="divider">/</span>
                        </li>
                        <li>
                            <a href="<?php echo site_url("admin_company") . '/' . $this->uri->segment(2); ?>">
                                <?php echo ucfirst($this->uri->segment(2)); ?>
                            </a> 
                            <span class="divider">/</span>
                        </li>
                        <li class="active">
                            <a href="#">New</a>
                        </li>
                    </ul>

                    <!--<div class="page-header">
                      <h2>
                        Adding <?php //echo ucfirst($this->uri->segment(2));  ?>
                      </h2>
                    </div>-->

                    <?php
                    //flash messages
                    if (isset($flash_message)) {
                        if ($flash_message == TRUE) {
                            echo '<div class="alert alert-success">';
                            echo '<a class="close" data-dismiss="alert">×</a>';
                            echo 'Course successfully added. Click here to view the <a style="font-size:16px;font-weight:bold;" href="' . base_url() . 'admin_company/chapters/add/' . $this->uri->segment(3) . '">chapter</a>.';
                            echo '<br/>';

                            //echo 'Course successfully added. Click here to view the chapter. Click here to view the chapter list.<a style="font-size:16px;font-weight:bold;" href="'.base_url().'admin_company/analytics/">Click Here</a>';

                            echo '<br/>';
                            echo '</div>';
                        } else {
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
                                    <h2><i class="icon-reorder"></i>&nbsp;&nbsp;Create the chapter</h2>
                                </div>
                                <div class="widget-content">
                                    <?php
                                    //form data
                                    $attributes = array('class' => 'form-horizontal', 'id' => 'chapter_add_form');

                                    //form validation
                                    echo validation_errors();

                                    echo form_open_multipart('admin_company/chapters/add/', $attributes);
                                    ?>
                                    <div class="alert fade in alert-danger" style="display: none;">
                                        <i class="icon-remove close" data-dismiss="alert"></i>
                                        Enter Chapters name.
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Chapter name</label>
                                        <div class="col-md-10"><input type="text" class="form-control" id="cname" name="cname" placeholder="Enter chapter name"  data-rule-required="true"  data-msg-required="Please enter course name." /></div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Chapter Description <br></label>
                                        <div class="col-md-10"><textarea class="form-control"   name="description" placeholder="(max 200 words)" cols="5" rows="3"></textarea></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Chapter Image </label>
                                        <div class="col-md-2">
                                            <input type="file" name="chapterimage" id="chapterimage">
                                        </div>
                                        <div class="col-md-6">
                                            <span><b>( * Please upload image of size (340px X 210px) FileSize Upto 2mb )</b></span>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Courses <br></label>
                                        <div class="col-md-6"><?php
                                            $selected = $this->uri->segment(4);
                                            echo form_dropdown('courseid', $coursedropdown, set_value('courseid', $selected));
                                            ?></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Upload content <br></label>
                                        <div class="col-md-10">



                                            <!-- Tabs-->
                                            <div class="tabbable tabbable-custom tabbable-full-width">
                                                <ul class="nav nav-tabs">
                                                    <li class="active"><a  class='file_type' id="e_course" href="#tab_elearning" data-toggle="tab">E-learning course</a></li>
                                                    <li class=""><a class='file_type' id="video" href="#tab_overview" data-toggle="tab">video</a></li>
                                                    <li class=""><a class='file_type' id="ppt/pdf"  href="#tab_ppt_pdf" data-toggle="tab">ppt/pdf</a></li>

                                                </ul>
                                                <div class="tab-content row">
                                                    <div class="tab-pane active" id="tab_elearning">





                                                        <div>

                                                            <input name="userImage" id="userImage" type="file" class="demoInputBox" />
                                                            <div id="progressbar">
                                                                <div class="progress-label">Uploading...</div>
                                                            </div>
                                                        </div>
                                                        <div><input type="button"
                                                                    id="btnSubmit" value="Upload" class="btnSubmit" /></div>
                                                        <div id="progress-div"><div id="progress-bar"></div></div>
                                                        <div id="targetLayer"></div>

                                                        <div id="loader-icon" style="display:none;"><img src="LoaderIcon.gif" /></div>


                                                    </div> <!-- /.col-md-12 -->
                                                    <!--=== Overview ===-->
                                                    <div class="tab-pane " id="tab_overview">


                                                        <label class="col-md-2 control-label">Video</label>
                                                        <div class="col-md-10"><input type="hidden" id="accessToken" readonly class="form-control" placeholder="Vimeo access token" required value="e6085f199f3445356e4f950691bfb904"></input>
                                                            <div class="checkbox">

                                                            </div>
                                                            <br>
                                                            <div class="progress">
                                                                <div id="progress" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="46" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                                                    0%
                                                                </div>
                                                            </div>
                                                            <div id="drop_zone">Drop files here</div>
                                                            <br>
                                                            <div id="results_progress"></div>

                                                            <div id="results"></div>
                                                            <input type="hidden" id="videoidassign" name="videoidassign">	
                                                            <input type="hidden" id="videoidsize" name="videoidsize">

                                                        </div>

                                                    </div>
                                                    <!-- /Overview -->

                                                    <!--=== Edit Account ===-->
                                                    <div class="tab-pane" id="tab_ppt_pdf">



                                                        <label class="col-md-2 control-label">Documents Chapter </label>
                                                        <div class="col-md-2">
                                                            <input type="file" name="chapterattach" id="chapterattach">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <span><b>( * Please upload documents (ppt,pdf,docx,doc) FileSize Upto 2mb )</b></span>
                                                        </div>

                                                    </div> <!-- /.col-md-12 -->





                                                    <!-- /Edit Account -->
                                                </div> <!-- /.tab-content -->
                                            </div>
                                             <div class="form-group">
                                       
                                                 <div class="col-md-10"><input type="text" class="form-control" id="file_type" name="file_type" placeholder="Enter chapter name"  data-rule-required="true" value="e_course" data-msg-required="Please enter course name." /></div>
                                   <div class="col-md-10"><input type="text" class="form-control" id="file_path" name="file_path"  data-rule-required="true"  data-msg-required="Please enter course name." /></div>
                                             </div>
                                            <!--END TABS-->
                                        </div>

                                        <!-- /Inline Tabs -->
                                        <!-- /Page Content -->
                                    </div>




                                    <div class="form-actions">
                                        <button class="btn btn-primary" type="submit">Save changes</button>
                                        <button class="btn" type="reset">Cancel</button>
                                    </div>									


                                </div>







                                </fieldset>

                                <?php echo form_close(); ?>
                            </div> 
                        </div>
                    </div> 

                    <script src="<?php echo base_url(); ?>assets/js/upload.js"></script>
                    <script type="text/javascript">
                        $(document).ready(function () {var a='<?php echo "../../assets/assets/js/file_dependent_js/e_course_storyline.js" ;?>';
                        jQuery.getScript(a)
	.done(function() {
		/* yay, all good, do something */
	})
	.fail(function() {
		/* boo, fall back to something else */
});
                        });
                        function handleFileSelect(evt) {
                            evt.stopPropagation();
                            evt.preventDefault();
                            var files = evt.dataTransfer.files; // FileList object.		
                            var accessToken = document.getElementById("accessToken").value;
                            var upgrade_to_1080 = document.getElementById("upgrade_to_1080").value;

                            // Clear the results div
                            var node = document.getElementById('results');
                            while (node.hasChildNodes())
                                node.removeChild(node.firstChild);

                            // Rest the progress bar
                            updateProgress(0);
                            var success_url = document.createTextNode("Please wait, your video is being uploaded....");

                            var element = document.createElement("div");
                            element.setAttribute('class', "alert alert-warning");
                            element.appendChild(success_url);

                            document.getElementById('results_progress').appendChild(element);

                            var uploader = new MediaUploader({
                                file: files[0],
                                token: accessToken,
                                upgrade_to_1080: upgrade_to_1080,
                                onError: function (data) {

                                    var errorResponse = JSON.parse(data);
                                    message = errorResponse.error;

                                    var element = document.createElement("div");
                                    element.setAttribute('class', "alert alert-danger");
                                    element.appendChild(document.createTextNode(message));
                                    document.getElementById('results').appendChild(element);

                                },
                                onProgress: function (data) {
                                    updateProgress(data.loaded / data.total);
                                    document.getElementById("videoidsize").value = data.total;

                                },
                                onComplete: function (videoId) {
                                    document.getElementById("results_progress").style.display = 'none';
                                    var url = "https://vimeo.com/" + videoId;
                                    var success_url = document.createTextNode("Your video has been uploaded sucessfully");
                                    //alert(success_url);
                                    var a = document.createElement('a');
                                    a.appendChild(document.createTextNode(url));
                                    a.setAttribute('href', url);
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
                            element.setAttribute('style', 'width:' + progress + '%');
                            element.innerHTML = progress + '%';
                        }



                    </script>


                    <?php
                }
//else
                {
                    ?>
                    <div id="content">
                        <div class="container">
                            <?php
                            // echo "<br/></br></br></br>";
                            // echo "<h3> Sorry you can not add New Course you reach your max limit of Video size Contact to Support system.!!!</h3>";
                        }
                        ?>
                    </div>
                </div>	 
            </div>
        </div>	</div>	</div>