<div id="content">
    <div class="container">

        <div class="crumbs">
            <ul class="breadcrumb">
                <li>
                    <a href="#>">
                        <?php echo $this->lang->line('nav_master'); ?>
                    </a> 

                </li>
                <li>
                    <a href="<?php echo site_url("admin_company") . '/' . $this->uri->segment(2); ?>">
                        <?php echo $this->lang->line('nav_footer_contact'); ?>
                    </a> 

                </li>
                <li class="active">
                    <a href="#"><?php echo $this->lang->line('brd_edit'); ?></a>
                </li>
            </ul>
        </div>
        <br>
     
            <?php
            //flash messages
            if ($this->session->flashdata('flash_message')) {
                if ($this->session->flashdata('flash_message') != 'false') {
                    echo '<div class="alert alert-success">';
                    echo '<a class="close" data-dismiss="alert">×</a>';
                    echo$this->session->flashdata('flash_message');
                    echo '</div>';
                } else {
                    echo '<div class="alert alert-danger">';
                    echo '<a class="close" data-dismiss="alert">×</a>';
                    echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
                    echo '</div>';
                }
            }
            ?>
             <div class="row">
                 <div class="col-md-12">
                <div class="widget box">
                    <div class="widget-header">
                        <h2><?php echo $this->lang->line('lbl_edit_footer_contact'); ?></h2>
                    </div>
                    <div class="widget-content">
                        <?php
                        //form data
                        $attributes = array('class' => 'form-horizontal', 'id' => '');                    

                        echo form_open('admin_company/cmspage/update/' . $this->uri->segment(4) . '', $attributes);
                        ?>
                        
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo  $this->lang->line('lbl_footer_email')?></label>
                            <div class="col-md-10"><input type="text" class="form-control" id="" name="emailid" placeholder="<?php echo $this->lang->line('lbl_footer_email')?>"  data-rule-required="true"  value="<?php echo $cmspage->emailid; ?>" data-msg-required="Please enter Contact Emailid." /></div>
                        </div>

                      
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo  $this->lang->line('lbl_footer_contact')?></label>
                            <div class="col-md-10"><input type="text" class="form-control" id="" name="contactno" value="<?php echo $cmspage->contactno; ?>"  placeholder="<?php echo  $this->lang->line('lbl_footer_contact')?>"  data-rule-required="true"  data-msg-required="Please enter Contact no" /></div>
                        </div>

                        
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo  $this->lang->line('lbl_footer_link1_nm')?></label>
                            <div class="col-md-10"><input type="text" class="form-control" name="cmspagelink1_name" placeholder="<?php echo  $this->lang->line('lbl_footer_link1_nm')?>" value="<?php echo $cmspage->cmspagelink1_name; ?>"  data-rule-required="true"  data-msg-required="Please enter CMS Page link1 name" /></div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo  $this->lang->line('lbl_footer_link1_url')?></label>
                            <div class="col-md-10"><input type="url" class="form-control" name="cmspagelink1" value="<?php echo $cmspage->cmspagelink1; ?>"  placeholder="<?php echo  $this->lang->line('lbl_footer_link1_url')?>"  data-rule-required="true"  data-msg-required="Please enter CMS Page link1" /></div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo  $this->lang->line('lbl_footer_link2_nm')?></label>
                            <div class="col-md-10"><input type="text" class="form-control"  name="cmspagelink2_name"   value="<?php echo $cmspage->cmspagelink2_name; ?>"  placeholder="<?php echo  $this->lang->line('lbl_footer_link2_nm')?>"  data-rule-required="true"  data-msg-required="Please enter CMS Page link2 name" /></div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo  $this->lang->line('lbl_footer_link2_url')?></label>
                            <div class="col-md-10"><input type="url" class="form-control"  name="cmspagelink2"  value="<?php echo $cmspage->cmspagelink2; ?>"  placeholder="<?php echo  $this->lang->line('lbl_footer_link2_url')?>"  data-rule-required="true"  data-msg-required="Please enter CMS Page link2" /></div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo  $this->lang->line('lbl_footer_link3_nm')?></label>
                            <div class="col-md-10"><input type="text" class="form-control"  name="cmspagelink3_name"   value="<?php echo $cmspage->cmspagelink3_name; ?>"  placeholder="<?php echo  $this->lang->line('lbl_footer_link3_nm')?>"  data-rule-required="true"  data-msg-required="Please enter CMS Page link3 name" /></div>
                        </div>					

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo  $this->lang->line('lbl_footer_link3_url')?></label>
                            <div class="col-md-10"><input type="url" class="form-control" name="cmspagelink3" value="<?php echo $cmspage->cmspagelink3; ?>" placeholder="<?php echo  $this->lang->line('lbl_footer_link3_url')?>"  data-rule-required="true"  data-msg-required="Please enter CMS Page link2" /></div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-2 control-label">Facebook  Link </label>
                            <div class="col-md-10"><input type="url" class="form-control" name="fblink"  value="<?php echo $cmspage->facebook_link; ?>"  placeholder="<?php echo  $this->lang->line('lbl_facebook_link')?>"  data-rule-required="true"  data-msg-required="Please enter facebook link" /></div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Google  Link </label>
                            <div class="col-md-10"><input type="url" class="form-control" name="googlepluslink"  value="<?php echo $cmspage->google_link; ?>"  placeholder="<?php echo  $this->lang->line('lbl_google_link')?>"  data-rule-required="true"  data-msg-required="Please enter Google Plus link" /></div>
                        </div>	

                        <div class="form-group">
                            <label class="col-md-2 control-label">Twitter Link </label>
                            <div class="col-md-10"><input type="url" class="form-control" name="twitterlink" value="<?php echo $cmspage->twitter_link; ?>"  placeholder="<?php echo  $this->lang->line('lbl_twitter_link')?>"  data-rule-required="true"  data-msg-required="Please enter Twitter link" /></div>
                        </div>	

                        <div class="form-group">
                            <label class="col-md-2 control-label">Linkedin Link </label>
                            <div class="col-md-10"><input type="url" class="form-control" name="linkedinlink"  value="<?php echo $cmspage->linkedin_link; ?>" placeholder="<?php echo  $this->lang->line('lbl_linkedin_link')?>"  data-rule-required="true"  data-msg-required="Please enter Linkedin link" /></div>
                        </div>	


                        <div class="form-actions">										
                            <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('btn_save'); ?></button>
                            <a href="<?php echo base_url(); ?>admin_company/cmspage">   <button  class="btn btn-primary"><?php echo $this->lang->line('btn_cancel'); ?></a>
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
</div>