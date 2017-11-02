<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
<style>
    #drop_zone {
        border: 2px dashed #bbb;
        -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px;  padding: 25px;
        text-align: center;
        font: 20pt bold 'Helvetica';
        color: #bbb;
    }
</style>


<div id="content">
    <div class="container">
     
            <div class="crumbs">
               
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
                        <li class="active"><?php if ($this->uri->segment(3) == 'add') { ?>
                                <a href="#"> <?php echo $this->lang->line('btn_add'); ?></a>
                            <?php } else { ?>
                                <a href="#"> <?php echo $this->lang->line('btn_edit'); ?></a>
                            <?php } ?>
                        </li>
                    </ul>
            </div>
        <br>

                    <?php
                    //flash messages
                    if (isset($message)) {
                      
                            echo '<div class="alert alert-danger">';
                            echo '<a class="close" data-dismiss="alert">×</a>';
                            echo '<strong>'.$message;
                            echo '</div>';
                        
                    }
                    ?>
                    <!--====== Inline Tabs ======-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="widget box">
                                <div class="widget-header">
                                    <h2>

                                        <?php
                                        if ($this->uri->segment(3) == 'add') {
                                            echo $this->lang->line('lbl_create_chapter');
                                        } else {
                                            echo $this->lang->line('lbl_edit_chapter');
                                        }
                                        ?></h2>
                                </div>
                                <div class="widget-content">
                                    <?php
                                    $attributes = array('class' => 'form-horizontal', 'id' => 'chapter_add_form');
                                    
                                    if ($this->uri->segment(3) == 'add') {
                                        echo form_open_multipart('admin_company/chapters/add/', $attributes);
                                    } else {
                                        echo form_open_multipart('admin_company/chapters/update/', $attributes);
                                        echo form_hidden('chapter_id',$chapter_id);
                                    }
                                    ?>
                                    

                                    <div class="form-group">
                                        <label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_chapter'); ?></label>
                                        <div class="col-md-10"><input type="text" class="form-control" pattern="[a-zA-Z]+.{3,}"   required title="Enter Chapter Name 4 characters minimum" required id="cname" name="name" placeholder="<?php echo $this->lang->line('lbl_chapter'); ?>"  data-rule-required="true"  data-msg-required="Please enter course name." value="<?php echo  set_value('name',$chapter_data[0]['name']);?>" /></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_chapter_desc'); ?> <br></label>
                                        <div class="col-md-10"><textarea class="form-control" pattern="[a-zA-Z]+.{20,}"   required title="Enter Chapter Description 21 characters minimum" required  name="description" placeholder="<?php echo $this->lang->line('lbl_chapter_desc'); ?>" cols="5" rows="3"><?php echo  set_value('description',$chapter_data[0]['description']);?></textarea></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_course'); ?> <br></label>
                                        <div class="col-md-6"><?php
                                            echo form_dropdown('course_id', $coursedropdown, $chapter_data[0]['course_id']);
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_upload_image'); ?> </label>
                                        <div class="col-md-2">
                                            <input type="file"  name="chapterimage" id="chapterimage">
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_chapter_content'); ?> <br></label>
                                        <div class="col-md-10">
                                            <!-- Tabs-->
                                            <div class="tabbable tabbable-custom tabbable-full-width">
                                                <ul class="nav nav-tabs">
                                                    <li class="active"><a class='file_type' id="e_course" href="#tab_elearning" data-toggle="tab"><?php echo $this->lang->line('lbl_e_course_type'); ?></a></li>
                                                    <li class=""><a class='file_type' id="ppt/pdf"  href="#tab_ppt_pdf" data-toggle="tab"><?php echo $this->lang->line('lbl_pdf_type'); ?></a></li>
                                                    <li class=""><a class='file_type' id="video" href="#tab_overview" data-toggle="tab"><?php echo $this->lang->line('lbl_video_type'); ?></a></li>
                                                </ul>
                                                <div class="tab-content row" style="overflow:hidden">
                                                    <div class="tab-pane active" id="tab_elearning">
                                                        <div class="row" >
                                                            <input name="userImage" id="userImage" type="file" style="width:40%; float:left;margin-left: 20px" class="demoInputBox" />
                                                            <input type="button" id="btnSubmit" style="width:30%; float:left; float:left;margin-left: 10px"  value="Upload" class="btnSubmit" /> 
                                                        </div>

                                                        <div class="form-group" style="margin-top:20px;">
                                                            <div class="progress" style="width:73%">
                                                                <div class="progress-bar progress-bar-success myprogress" role="progressbar" style="width:0%">0%</div>
                                                            </div>

                                                            <div class="msg"></div>
                                                        </div>

                                                        <div id="targetLayer"></div>
                                                        <div id="loader-icon" style="display:none;"><img src="LoaderIcon.gif" /></div>
                                                    </div> <!-- /.col-md-12 -->
                                                    <!--=== Overview ===-->
                                                    <div class="tab-pane " id="tab_overview">

                                                        <div class="col-md-10"><input type="hidden" id="accessToken" readonly class="form-control" placeholder="Vimeo access token" required value="3a657f2c610bea893d1552070a8a8915"></input>
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
                                                            <input type="hidden" id="file_size" name="file_size">
                                                        </div>
                                                    </div>
                                                    <!-- /Overview -->
                                                    <!--=== Edit Account ===-->
                                                    <div class="tab-pane" id="tab_ppt_pdf">

                                                        <div class="col-md-2">
                                                            <input type="file" name="pdf_file_to_upload" id="pdf_file_to_upload">
                                                        </div>

                                                    </div> <!-- /.col-md-12 -->
                                                    <!-- /Edit Account -->
                                                </div> <!-- /.tab-content -->
                                            </div>
                                            <div class="form-group">                                       
                                                <div class="col-md-10"><input type="text" class="form-control" id="file_type" name="file_type"    /></div>
                                                <div class="col-md-10"><input type="hidden" class="form-control" id="file_path" name="file_path"   /></div>
                                                <div class="col-md-10"><input type="hidden" class="form-control" id="video_id" name="video_id"  /></div>
                                            </div>
                                            <!--END TABS-->
                                        </div>
                                        <!-- /Inline Tabs -->
                                        <!-- /Page Content -->
                                    </div>
                                    <div class="form-actions">
                                        <button class="btn btn-primary" type="submit"><?php echo $this->lang->line('btn_save'); ?></button>
                                        <?php if ($this->uri->segment(3) == 'add') { ?>  <button class="btn  btn-primary" type="reset"><?php echo $this->lang->line('btn_reset'); ?></button>

                                        <?php } else {
                                            ?><a href="../chapters"><button class="btn  btn-primary" ><?php echo $this->lang->line('btn_cancel'); ?></a><?php } ?></div>
                                </div>
                                </fieldset>
                                <?php echo form_close(); ?>
                            </div> 
                        </div>
                    </div> 
                    <script src="<?php echo base_url(); ?>assets/js/upload.js"></script>
                    <script type="text/javascript">
                        $(document).ready(function () {
                            var a = '<?php echo "../../assets/assets/js/file_dependent_js/e_course_storyline.js"; ?>';
                            jQuery.getScript(a)
                                    .done(function () {
                                    })
                                    .fail(function () {
                                    });
                            
                            $("#pdf_file_to_upload").on('change', function() {
	// Validate whether PDF
    if(['application/pdf'].indexOf($(this).get(0).files[0].type) == -1) { $("#file_type").val(''); 
        alert('Error : Not a PDF');
        return;
    }
    else{
        $("#file_type").val('pdf');
    }
  
    

	
});
                        });
                    </script>
                   
                    </div>
                </div>	 
           