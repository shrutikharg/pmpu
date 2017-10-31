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
<script type="text/javascript">
    $(document).ready(function () {
        var a = '<?php echo "../../assets/assets/js/file_dependent_js/e_course_storyline.js"; ?>';
        jQuery.getScript(a)
                .done(function () {
                    /* yay, all good, do something */
                })
                .fail(function () {
                    /* boo, fall back to something else */
                });

    });</script>
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
                            <a href="#">
                                <?php echo $this->lang->line('brd_courses'); ?>
                            </a> 

                        </li>
                        <li>
                            <a href="<?php echo site_url("admin_company") . '/' . $this->uri->segment(2); ?>">
                                <?php echo $this->lang->line('brd_chapter'); ?>
                            </a> 

                        </li>
                        <li class="active">
                            <a href="#"> <?php echo $this->lang->line('btn_edit'); ?></a>
                        </li>
                    </ul>

                    <!--<div class="page-header">
                      <h2>
                        Adding <?php //echo ucfirst($this->uri->segment(2)); ?>
                      </h2>
                    </div>-->

                    <?php
                    //flash messages
                    if ($this->session->flashdata('flash_message')) {
                        if ($this->session->flashdata('flash_message') == 'updated') {
                            echo '<div class="alert alert-success">';
                            echo '<a class="close" data-dismiss="alert">×</a>';
                            echo '<strong>Well done!</strong> Chapters updated with success.';
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
                                    <h2><?php echo $this->lang->line('lbl_edit_chapter'); ?></h2>
                                </div>
                                <div class="widget-content">
                                    <?php
                                    //form data
                                    $attributes = array('class' => 'form-horizontal', 'id' => '');

                                    //form validation
                                    echo validation_errors();
                                    //var_dump($chaptersdata);
                                    echo form_open_multipart('admin_company/chapters/update/', $attributes);
                                    ?>
                                    <div class="form-group" style="display:none;">
                                        <div class="col-md-10"><input type="text"  name="chapter_id" class="form-control" value="<?php echo $chapter_id; ?>" ></div>


                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_chapter'); ?></label>
                                        <div class="col-md-10"><input type="text" class="form-control" id="" name="cname" value="<?php echo $chaptersdata[0]['name']; ?>" placeholder="<?php echo $this->lang->line('lbl_chapter'); ?>"  data-rule-required="true"  data-msg-required="Please enter course name." /></div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_chapter_desc'); ?></label>
                                        <div class="col-md-10"><textarea class="form-control" value="" name="description" placeholder="<?php echo $this->lang->line('lbl_chapter_desc'); ?>)" cols="5" rows="3"><?php echo $chaptersdata[0]['description']; ?></textarea></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_course'); ?> <br></label>
                                        <div class="col-md-6"><?php
                                $selected = $chaptersdata[0]['courseid'];
                                echo form_dropdown('courseid', $coursedropdown, set_value('courseid', $selected));
                                    ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_chapter_upload_image'); ?> </label>
                                        <div class="col-md-2">
                                            <input type="file"  name="chapterimage" id="chapterimage">
                                        </div>

                                    </div>



                                    <div class="form-group">
                                        <label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_chapter_content'); ?></label>
                                        <div class="col-md-10">



                                            <!-- Tabs-->
                                            <div class="tabbable tabbable-custom tabbable-full-width">
                                                <ul class="nav nav-tabs">
                                                    <li class="active"><a class='file_type' id="e_course" href="#tab_elearning" data-toggle="tab"><?php echo $this->lang->line('lbl_e_course_type'); ?></a></li>
                                                    <li class=""><a class='file_type' id="ppt/pdf"  href="#tab_ppt_pdf" data-toggle="tab"><?php echo $this->lang->line('lbl_pdf_type'); ?></a></li>
                                                    <li class=""><a class='file_type' id="video" href="#tab_overview" data-toggle="tab"><?php echo $this->lang->line('lbl_video_type'); ?></a></li>
                                                </ul>
                                                <div class="tab-content row">
                                                    <div class="tab-pane active" id="tab_elearning">





                                                        <div>

                                                            <input name="userImage"  title="<?php echo $chaptersdata[0]['folder_name'] ?>"id="userImage" type="file" class="demoInputBox" />
                                                            <div id="progressbar">

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

                                                <div class="col-md-10"><input type="text" class="form-control" id="file_type" name="file_type" placeholder="Enter chapter name"  data-rule-required="true" value="" data-msg-required="Please enter course name." /></div>
                                                <div class="col-md-10"><input type="text" class="form-control" id="file_path" name="file_path"  data-rule-required="true"  data-msg-required="Please enter course name." /></div>
                                            </div>
                                            <!--END TABS-->
                                        </div>

                                        <!-- /Inline Tabs -->
                                        <!-- /Page Content -->
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
                            while (node.hasChildNodes())
                                node.removeChild(node.firstChild);

                            // Rest the progress bar
                            updateProgress(0);

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

                                    var url = "https://vimeo.com/" + videoId;

                                    var a = document.createElement('a');
                                    a.appendChild(document.createTextNode(url));
                                    a.setAttribute('href', url);
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
                            element.setAttribute('style', 'width:' + progress + '%');
                            element.innerHTML = progress + '%';
                        }


                        progress
                </script>

                <script>
                            (function (i, s, o, g, r, a, m) {
                                i['GoogleAnalyticsObject'] = r;
                                i[r] = i[r] || function () {
                                    (i[r].q = i[r].q || []).push(arguments)
                                }, i[r].l = 1 * new Date();
                                a = s.createElement(o),
                                        m = s.getElementsByTagName(o)[0];
                                a.async = 1;
                                a.src = g;
                                m.parentNode.insertBefore(a, m)
                            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

                    ga('create', 'UA-57984417-1', 'auto');
                    ga('send', 'pageview');

                </script>	

    <?php
}
//else		
?>
        </div>
    </div>
</div>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/thumbnail/jquery-smartvimeoembed.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/thumbnail/local.js"></script>