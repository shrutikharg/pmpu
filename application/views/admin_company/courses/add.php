<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>  
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script> 
<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>assets/css/bootstrap-datepicker.css" /> 
<div id="content">
    <div class="container">
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
        $planid_currentuser = $this->session->userdata['userplan_id'];
        // if ($sessionuserdata[0]['available_disk_space'] !== 0) {
        ?>	
        <div class="crumbs">
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
                    <a href="#">  <?php echo$this->lang->line('btn_edit'); ?></a>
                </li>
            </ul>
            
        </div>
        
        <br>
   
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
                <div class="widget box">
                    <div class="widget-header">
                        <h2><?php echo$this->lang->line('lbl_create_course'); ?></h2>
                    </div>
                    <div class="widget-content">
                        <?php
                        $attributes = array('class' => 'form-horizontal', 'id' => '');
                       
                        echo form_open_multipart('admin_company/courses/add', $attributes);
                        ?>

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_course'); ?></label>
                            <div class="col-md-10"><input type="text" class="form-control"    required title="<?php echo $this->lang->line('lbl_course'); ?>"  name="name" id="name" placeholder="<?php echo $this->lang->line('lbl_course'); ?>"  data-rule-required="true"  data-msg-required="Please enter course name."  required value="<?php echo set_value('name'); ?>" />

                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_course_desc'); ?></label>
                            <div class="col-md-10"><textarea class="form-control"  required  name="description" placeholder="<?php echo $this->lang->line('lbl_course_desc'); ?>" cols="5" rows="3"><?php echo set_value('description')?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_subdepartment'); ?></label>
                            <div class="col-md-6"><?php echo form_dropdown('subcategory', $subcategory,$post_data['subcategory']); ?></div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_course_by'); ?></label>
                            <div class="col-md-10"><input type="text" class="form-control"  name="course_by"   placeholder="<?php echo $this->lang->line('lbl_course_by'); ?>"  pattern="[a-zA-Z]+.{4,}"   required title="Enter Author Name 5 characters minimum" required data-rule-required="true"  data-msg-required="Please enter Author name" pattern="[a-zA-Z]+" required value="<?php echo set_value('course_by'); ?>"/>

                            </div>
                        </div>
                     <!--   <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_start_date'); ?></label>
                            <div class="col-md-3 " > <p id="dateOnlyExample"><input type="text" class="form-control date start" name="start_date"   placeholder="<?php echo $this->lang->line('lbl_start_date'); ?>"  data-rule-required="true"  data-msg-required="Course start date" title="Start date Require"   value="<?php echo set_value('start_date'); ?>"/>
                                </p> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_end_date'); ?></label>
                            <div class="col-md-3"><p id="dateOnlyExample"><input type="text"  class="form-control date end"   name="end_date"  placeholder="<?php echo $this->lang->line('lbl_end_date'); ?>"  data-rule-required="true"  data-msg-required="Course end date" title="End Date rquired"  value="<?php echo set_value('end_date'); ?>" />
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

                        <div class="form-actions">	
                            <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('btn_save'); ?></button>
                            <button type="reset" class="btn btn-primary"><?php echo $this->lang->line('btn_reset'); ?></button>

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
 
</div>

<script src="<?php echo base_url(); ?>assets/js/upload.js"></script>

<script type="text/javascript">
    /*  function handleFileSelect(evt) {
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
     }*/

    /*function handleDragOver(evt) {
     evt.stopPropagation();
     evt.preventDefault();
     evt.dataTransfer.dropEffect = 'copy';
     }
     document.addEventListener('DOMContentLoaded', function () {
     var dropZone = document.getElementById('drop_zone');
     dropZone.addEventListener('dragover', handleDragOver, false);
     dropZone.addEventListener('drop', handleFileSelect, false);
     });
     ;*/
    /**
     * Update progress bar.
     */
    /*function updateProgress(progress) {
     progress = Math.floor(progress * 100);
     var element = document.getElementById('progress');
     element.setAttribute('style', 'width:' + progress + '%');
     element.innerHTML = progress + '%';
     }*/
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
<script type="text/javascript">
    $('#alternateUiWidgetsExample .time').ptTimeSelect({
        'onClose': function ($self) {
            $self.trigger('change');
        }
    });
    progress
</script>
</div>