<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/libs/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/themes/popupwindow.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/themes/demo.js"></script>
<style type="text/css">
    textarea.form-control {
        width: 420px;
        height: 127px;
    }
</style>
<link href="<?php echo base_url(); ?>assets/themes/popupwindow.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/themes/preview_demo.css" rel="stylesheet" type="text/css" />
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
                    <a href="<?php echo site_url("admin_company") . '/' . $this->uri->segment(2) . '/' . $this->uri->segment(3); ?>">
                        <?php echo $this->lang->line('nav_comapny'); ?>
                    </a> 

                </li>
                <li class="active">
                    <a href="#"><?php echo $this->lang->line('brd_edit'); ?></a>
                </li>
            </ul>
        </div>
         <br>
        <div class="row">

            <?php
           

            //flash messages
            if (isset($message)) {
                if ($message === TRUE) {

                    echo '<div class="alert alert-success col-md-12">';
                    echo '<a class="close" data-dismiss="alert">×</a>';
                    echo 'Details Uploaded Successfully';
                    echo '</div>';
                } else {
                    echo '<div class="alert alert-danger">';
                    echo '<a class="close" data-dismiss="alert">×</a>';
                    echo $message;
                    echo '</div>';
                }
            }
            ?>      
            <?php
            //form data
            $attributes = array('class' => 'form-horizontal', 'id' => '');
            $options_category = array('' => "Select");
            foreach ($category as $row) {
                $options_category[$row['id']] = $row['name'];
            }
            //form validation

            echo form_open_multipart('admin_company/brandings/addtheme', $attributes);
            ?>
                    <input type="hidden" id="" readonly name="usertheme" value="<?php echo $this->session->userdata('customcss'); ?>">
            <!--=== Inline Tabs ===-->
                <div class="col-md-12">
                    <div class="widget box">
                        <div class="widget-header">
                            <h4><i class="icon-reorder"></i><?php echo $this->lang->line('lbl_edit_company');?></h4>
                        </div>
                        <div class="widget-content">
                            <form   class="form-horizontal row-border" action="#" method="post">
                                            <div class="form-group required">
                                                <label class="col-md-3   control-label"><?php echo $this->lang->line('lbl_comp_logo');?></label>
                                                <div class="col-md-2">
                                                                <!--<input type="file" name="theme_logo" id="theme_logo" />--->
                                                    <a class='btn ' href='javascript:;'>
                                                        Choose File...
                                                        <input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="logo_image" size="40" id="theme_logo"  onchange='$("#upload-file-info").html($(this).val());'>
                                                    </a>	
                                                </div>
                                                <div class="col-md-2">				

                                                        <img src="<?php echo base_url().$company_details->logo_path; ?>" height="75" width="75" />
                                                        <input type="hidden"  readonly  name="logo_path" value="<?php echo $company_details->logo_path; ?>" >
                                                    
                                                </div>
                                                <div class="col-md-4">
                                                    <span><b>(Please upload logo of size (70X50))</b></span>
                                                </div>			
                                            </div>
                                <div class="form-group required">
                                    <label class="col-md-3 control-label"><?php echo $this->lang->line('lbl_company_name'); ?></label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="name"  placeholder="<?php echo $this->lang->line('lbl_company_name'); ?>"  data-rule-required="true"  value="<?php echo $company_details->name; ?>" data-msg-required="Please Enter Company Name" />			
                                    </div>			
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo $this->lang->line('lbl_comp_product'); ?></label>
                                    <div class="col-md-3"><input type="text" class="form-control"    required title="<?php echo $this->lang->line('lbl_comp_product'); ?>"  name="product_name" id="price" placeholder="<?php echo $this->lang->line('lbl_comp_subscription_price'); ?>"  data-rule-required="true"  data-msg-required="Please enter course name."  required value="<?php echo $company_details->product_name; ?>" />

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo $this->lang->line('lbl_comp_subscription_price'); ?></label>
                                    <div class="col-md-3"><input type="text" class="form-control"    required title="<?php echo $this->lang->line('lbl_comp_subscription_price'); ?>"  name="price" id="price" placeholder="<?php echo $this->lang->line('lbl_comp_subscription_price'); ?>"  data-rule-required="true"  data-msg-required="Please enter course name."  required value="<?php echo $company_details->price; ?>" />

                                    </div>
                                </div>
                                  <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo $this->lang->line('lbl_comp_event_days'); ?></label>
                                    <div class="col-md-3"><input type="text" class="form-control"    required title="<?php echo $this->lang->line('lbl_comp_event_days'); ?>"  name="no_of_days" id="price" placeholder="<?php echo $this->lang->line('lbl_comp_event_days'); ?>"  data-rule-required="true"  data-msg-required="Please enter course name."  required value="<?php echo $company_details->no_of_days; ?>" />

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo $this->lang->line('lbl_email'); ?></label>
                                    <div class="col-md-3"><input type="text" class="form-control"    required title="<?php echo $this->lang->line('lbl_course'); ?>"  name="email" id="email" placeholder="<?php echo $this->lang->line('lbl_email'); ?>"  data-rule-required="true"  data-msg-required="Please enter course name."  required value="<?php echo $company_details->email; ?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo $this->lang->line('lbl_comp_phone_no'); ?></label>
                                    <div class="col-md-3"><input type="text" class="form-control"    required title="<?php echo $this->lang->line('lbl_comp_phone_no'); ?>"  name="phone" id="phone" placeholder="<?php echo $this->lang->line('lbl_course'); ?>"  data-rule-required="true"  data-msg-required="Please enter course name."  required value="<?php echo $company_details->phone; ?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo $this->lang->line('lbl_subdomain_name'); ?></label>
                                    <div class="col-md-3"><input type="text"  readonly="true" class="form-control"    required title="<?php echo $this->lang->line('lbl_subdomain_name'); ?>"  name="domain_name" id="domain_name" placeholder="<?php echo $this->lang->line('lbl_course'); ?>"  data-rule-required="true"  data-msg-required="Please enter course name."  required value="<?php echo $company_details->domain_name;
            ; ?>" />

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-10 control-label"><?php echo $this->lang->line('lbl_comp_overview'); ?></label>
                                    <div class="col-md-6 col-xs-10"><textarea id="" name="description" class="form-control" pattern="[a-zA-Z0-9]+" required ><?php echo $company_details->description;
            ; ?></textarea></div>
                                </div>
                                    

                        </div>


                    </div>											
                </div>

            						

            <div class="form-actions">

                <button class="btn btn-primary" type="submit">Save</button>
                <a href="<?php echo base_url();?>admin_company/brandings/addtheme">   <button  class="btn btn-primary"><?php echo $this->lang->line('btn_cancel');?></a>


            </div>





<?php echo form_close(); ?>

        </div>
    </div>
</div>
