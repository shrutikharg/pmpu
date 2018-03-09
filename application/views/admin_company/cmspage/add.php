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
                        <?php echo $this->lang->line('nav_cms'); ?>
                    </a> 

                </li>
                <li class="active">
                    <a href="#"><?php echo $this->lang->line('brd_add'); ?></a>
                </li>
            </ul>
        </div>
        <br>
        <div class="row">

            <?php
            //flash messages
            if (isset($message)) {
                echo '<div class="alert alert-danger">';
                echo '<strong>' . $message;
                echo '</div>';
            }
            if (!empty($this->session->flashdata('flash_message'))) {
                echo '<div class="alert alert-danger">';
                echo '<strong>' . $this->session->flashdata('flash_message');
                echo '</div>';
            }
            ?>

            <!--=== Inline Tabs ===-->

            <div class="col-md-12">
                <div class="widget box">
                    <div class="widget-header">
                        <h2><i class="icon-reorder"></i>&nbsp;&nbsp;Create the Cms page</h2>
                    </div>
                    <div class="widget-content">
                        <?php
                        //form data
                        $attributes = array('class' => 'form-horizontal', 'id' => '');
                        //form validation


                        echo form_open_multipart('admin_company/cmspage/add', $attributes);
                        ?>
                     
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo  $this->lang->line('lbl_footer_email')?></label>
                            <div class="col-md-10"><input type="text" class="form-control" id="" name="emailid" placeholder="<?php echo  $this->lang->line('lbl_footer_email')?>"  value="<?php echo set_value('emailid'); ?>"/></div>
                        </div>
                      
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo  $this->lang->line('lbl_footer_contact')?></label>
                            <div class="col-md-10"><input type="text" class="form-control" id="" name="contactno" placeholder="<?php echo  $this->lang->line('lbl_footer_contact')?>"   value="<?php echo set_value('contactno'); ?>" /></div>
                        </div>
                       
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo  $this->lang->line('lbl_footer_link1_nm')?></label>
                            <div class="col-md-10"><input type="text" class="form-control" name="cmspagelink1_name" placeholder="<?php echo  $this->lang->line('lbl_footer_link1_nm')?>" value="<?php echo set_value('cmspagelink1_name'); ?>" /></div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo  $this->lang->line('lbl_footer_link1_url')?></label>
                            <div class="col-md-10"><input type="url" class="form-control" name="cmspagelink1" placeholder="<?php echo  $this->lang->line('lbl_footer_link1_url')?>"  value="<?php echo set_value('cmspagelink1'); ?>" /></div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo  $this->lang->line('lbl_footer_link2_nm')?></label>
                            <div class="col-md-10"><input type="text" class="form-control"  name="cmspagelink2_name"   placeholder="<?php echo  $this->lang->line('lbl_footer_link2_nm')?>"  value="<?php echo set_value('cmspagelink2_name'); ?>" /></div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo  $this->lang->line('lbl_footer_link2_url')?></label>
                            <div class="col-md-10"><input type="url" class="form-control"  name="cmspagelink2"   placeholder="<?php echo  $this->lang->line('lbl_footer_link2_url')?>" value="<?php echo set_value('cmspagelink2'); ?>" /></div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo  $this->lang->line('lbl_footer_link3_nm')?></label>
                            <div class="col-md-10"><input type="text" class="form-control"  name="cmspagelink3_name"   placeholder="<?php echo  $this->lang->line('lbl_footer_link3_nm')?>" value="<?php echo set_value('cmspagelink3_name'); ?>"  /></div>
                        </div>				

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo  $this->lang->line('lbl_footer_link3_url')?></label>
                            <div class="col-md-10"><input type="url" class="form-control" name="cmspagelink3" placeholder="<?php echo  $this->lang->line('lbl_footer_link3_url')?>"  value="<?php echo set_value('cmspagelink3'); ?>" /></div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Facebook Link </label>
                            <div class="col-md-10"><input type="url" class="form-control" name="fblink"  placeholder="<?php echo  $this->lang->line('lbl_facebook_link')?>" value="<?php echo set_value('fblink'); ?>"  /></div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Google Plus Link </label>
                            <div class="col-md-10"><input type="url" class="form-control" name="googlepluslink"  placeholder="<?php echo  $this->lang->line('lbl_google_link')?>"  value="<?php echo set_value('googlepluslink'); ?>"  /></div>
                        </div>	

                        <div class="form-group">
                            <label class="col-md-2 control-label">Twitter Link </label>
                            <div class="col-md-10"><input type="url" class="form-control" name="twitterlink"  placeholder="<?php echo  $this->lang->line('lbl_twitter_link')?>" value="<?php echo set_value('twitterlink'); ?>"   /></div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Linkedin Link </label>
                            <div class="col-md-10"><input type="url" class="form-control" name="linkedinlink"  placeholder="<?php echo  $this->lang->line('lbl_linkedin_link')?>"  value="<?php echo set_value('linkedinlink'); ?>"  /></div>
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

    </div>	 
</div>
