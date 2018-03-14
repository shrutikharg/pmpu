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
                        <?php echo$this->lang->line('brd_speakers'); ?>
                    </a> 

                </li>
                <li>
                    <a href="<?php echo site_url("admin_company") . '/' . $this->uri->segment(2); ?>">
                        <?php echo$this->lang->line('lbl_speaker'); ?>
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
                        <h2><?php echo$this->lang->line('lbl_create_speaker'); ?></h2>
                    </div>
                    <div class="widget-content">
                        <?php
                        $attributes = array('class' => 'form-horizontal', 'id' => '');
                       
                        echo form_open_multipart('admin_company/speaker/add', $attributes);
                        ?>

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_speaker'); ?></label>
                            <div class="col-md-10"><input type="text" class="form-control"    required title="<?php echo $this->lang->line('lbl_speaker'); ?>"  name="name" id="name" placeholder="<?php echo $this->lang->line('lbl_speaker'); ?>"  data-rule-required="true"  data-msg-required="Please enter speaker name."  required value="<?php echo set_value('name'); ?>" />

                            </div>
                        </div>
                          <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_speaker_designation'); ?></label>
                            <div class="col-md-10"><input type="text" class="form-control"  name="designation"   placeholder="<?php echo $this->lang->line('lbl_speaker_designation'); ?>"  pattern="[a-zA-Z]+.{4,}"   required title="Enter Author Name 5 characters minimum" required data-rule-required="true"  data-msg-required="Please enter Author name" pattern="[a-zA-Z]+" required value="<?php echo set_value('speaker_by'); ?>"/>

                            </div>
                        </div> 
                         <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_speaker_desc'); ?></label>
                            <div class="col-md-10"><textarea class="form-control"  required  name="description" placeholder="<?php echo $this->lang->line('lbl_speaker_desc'); ?>" cols="5" rows="3"><?php echo set_value('description')?></textarea>
                            </div>
                        </div>
                        
                                  
                       

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_upload_image'); ?></label>
                            <div class="col-md-2">
                                <input type="file" name="speaker_image" id="speaker_image">												
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
    $('#alternateUiWidgetsExample .time').ptTimeSelect({
        'onClose': function ($self) {
            $self.trigger('change');
        }
    });
    progress
</script>
</div>