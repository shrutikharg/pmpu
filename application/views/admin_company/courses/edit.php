<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/thumbnail/css/jquery-smartvimeoembed.css" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>  
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script> 
<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>assets/css/bootstrap-datepicker.css" /> 
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
        <div class="crumbs">
            <!--- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">  -->
            <ul class="breadcrumb">
                <li>
                    <a href="#">
                        <?php echo$this->lang->line('brd_courses'); ?>
                    </a> 

                </li>
                <li>
                    <a href="<?php echo site_url("admin_company") . '/' . $this->uri->segment(2); ?>">
                        <?php echo$this->lang->line('lbl_course'); ?>
                    </a> 

                </li>
                <li class="active">
                    <a href="#"><?php echo$this->lang->line('btn_edit'); ?></a>
                </li>
            </ul>
        </div>

        <!--<div class="page-header">
          <h2>
            Adding <?php //echo ucfirst($this->uri->segment(2));   ?>
          </h2>
        </div>-->

        <?php
        //flash messages

        if (isset($message)) {
            //flash messages

            echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>' . $message;
            echo '</div>';
        }
        ?>
        <!--=== Inline Tabs ===-->
        <div class="row">
            <div class="col-md-12">
                <br/>
                <div class="widget box">
                    <div class="widget-header">
                        <h2><?php echo$this->lang->line('lbl_edit_course'); ?></h2>
                    </div>
                    <div class="widget-content">
                        <?php
                        //form data
                        $attributes = array('class' => 'form-horizontal', 'id' => '');
                       
                        echo form_open_multipart('admin_company/courses/update', $attributes);
                        ?>

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_course'); ?></label>
                            <div class="col-md-10"><input type="text" class="form-control" id="name" name="name" placeholder="<?php echo $this->lang->line('lbl_course'); ?>"  data-rule-required="true"  data-msg-required="Please enter course name." value="<?php echo $courses[0]['name']; ?>" /></div>
                        </div>
                        <div class="alert fade in alert-danger" style="display: none;">

                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_course_desc'); ?></label>
                            <div class="col-md-10"><textarea class="form-control"  name="description" placeholder="<?php echo $this->lang->line('lbl_course_desc'); ?>" cols="5" rows="3"><?php echo $courses[0]['description']; ?></textarea></div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_subdepartment'); ?></label>
                            <div class="col-md-6"><?php echo form_dropdown('subcategory_id', $subcategory, $courses[0]['subcategory_id']); ?></div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_course_by'); ?></label>
                            <div class="col-md-10"><input type="text" class="form-control"  name="courseby"  value="<?php echo $courses[0]['course_by']; ?>"  placeholder="<?php echo $this->lang->line('lbl_course_by'); ?>"  data-rule-required="true"  data-msg-required="Please enter Author name" /></div>
                        </div>


                     <!--   <div class="form-group">
                            <label class="col-md-2 control-label">Course start date</label>
                            <div class="col-md-3 " > <p id="dateOnlyExample"><input type="text" id="start_date" class="form-control date start" name="start_date"   placeholder="Course start date"  data-rule-required="true"  data-msg-required="Course start date" title="Start date Require" value="<?php echo $courses[0]['start_date']; ?>"  required />
                                </p> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Course end date</label>
                            <div class="col-md-3"><p id="dateOnlyExample"><input type="text" id="end_date"  class="form-control date end"   name="end_date"  placeholder="Course end date"  data-rule-required="true"  data-msg-required="Course end date" title="End Date rquired" value="<?php echo $courses[0]['end_date']; ?>" required />
                                </p> 
                            </div>
                        </div>-->


                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_upload_image'); ?></label>
                            <div class="col-md-2">
                                <input type="file" name="courseimage" id="courseimage">												
                            </div>
                            <div class="col-md-6">

                            </div>
                        </div>
                        <div class="form-group" style="display:none;">
                            <div class="col-md-10"><input type="text"  name="course_id" class="form-control" value="<?php echo $course_id; ?>" ></div>


                        </div>



                        <div class="form-actions">	
                            <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('btn_save'); ?></button>
                            <a href="../courses">   <button  class="btn btn-primary"><?php echo $this->lang->line('btn_cancel'); ?></a>

                        </div>
                        <?php echo form_close(); ?>

                        <!-- /.widget-content -->
                    </div> <!-- /.widget .box -->
                </div> <!-- /.col-md-12 -->
            </div> <!-- /.row -->


        </div>
        <!-- /Inline Tabs -->
    </div> <!-- /.row -->
    <!-- /Page Content -->
</div>
<!-- /.container -->


<script src="<?php echo base_url(); ?>assets/js/thumbnail/jquery-smartvimeoembed.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/thumbnail/local.js"></script>

<script type="text/javascript">

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
    /** * Dragover handler to set the drop effect.                          */
    function handleDragOver(evt) {
        evt.stopPropagation();
        evt.preventDefault();
        evt.dataTransfer.dropEffect = 'copy';
    }
    document.addEventListener('DOMContentLoaded', function () {
        var dropZone = document.getElementById('drop_zone');
        dropZone.addEventListener('dragover', handleDragOver, false);
        dropZone.addEventListener('drop', handleFileSelect, false);
    });
    ;
    /**     * Update progress bar.     */
    function updateProgress(progress) {
        progress = Math.floor(progress * 100);
        var element = document.getElementById('progress');
        element.setAttribute('style', 'width:' + progress + '%');
        element.innerHTML = progress + '%';
    }
    /// Date Picker------------

    var dateToday = new Date();
    $('#dateOnlyExample .date').datepicker({
        'format': 'yyyy-m-d',
        'autoclose': true,
        'startDate': dateToday
    });
    var dateOnlyExampleEl = document.getElementById('dateOnlyExample');
    var dateOnlyDatepair = new Datepair(dateOnlyExampleEl);


</script>