 <script src="https://code.jquery.com/jquery-1.10.2.js"></script>  
 <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>   

<script>
    $.noConflict();
jQuery( document ).ready(function( $ ) {
  $( ".datepicker" ).datepicker({
    dateFormat: "dd/mm/yyyy",
    showOtherMonths: true,
    selectOtherMonths: true,
    autoclose: true,
    changeMonth: true,
    changeYear: true,
  });
});
</script> 
<style type="text/css">
    .ui-datepicker .ui-datepicker-header, .ui-datepicker td .ui-state-hover, .ui-datepicker td .ui-state-active {
        background-color: #99D9EA !important;
    }
</style>
<div id="content">
    <div class="container">
        <!-- Breadcrumbs line -->
        <div class="crumbs">
            <ul class="breadcrumb">
                <li>
                    <a href="#">
                        <?php echo $this->lang->line('brd_courses'); ?>
                                
                    </a> 
                  
                </li>
                <li>
                    <a href="<?php echo site_url("admin_company") . '/' . $this->uri->segment(2); ?>">
                       <?php echo $this->lang->line('nav_coupon_code'); ?>
                    </a> 
                    
                </li>
                <li class="active">
                    <a href="#">  <?php echo $this->lang->line('brd_add'); ?></a>
                </li>
            </ul>				      
        </div>
        <br>

        <!-- /Breadcrumbs line -->

        <!--=== Page Header ===-->
  
        <!-- /Page Header -->

        <!--=== Page Content ===-->
        <!--=== Statboxes ===-->
       <!-- /.row -->
        <!-- /Statboxes -->
        <!--=== Normal ===-->
        <div class="row">
           <?php
      //flash messages
    
                               if(isset($message)){
      //flash messages

          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>'.$message;
              echo '</div>'; 
        }
      
      ?>
            <div class="col-md-12">
                <div class="widget box">
                    <div class="widget-header">
                        <h4><?php echo $this->lang->line('lbl_create_department'); ?></h4>								
                    </div>
                    <div class="widget-content">
                        <?php
                        $is_active_array=array(''=>'Select','Y'=>'Yes','N'=>'No');
                        $attributes = array('class' => 'form-horizontal', 'id' => '');

                        //form validation
                      

                        echo form_open('admin_company/coupon_code/add', $attributes);
                        ?>
                        <div class="form-group required">
                            <label class="col-md-2 col-xs-10 control-label"><?php echo $this->lang->line('lbl_coupon_code'); ?></label>
                            <div class="col-md-6 col-xs-10"><input type="text"  name="name" pattern="[a-zA-Z]+.{2,}"   required title="Enter Department Name 3 characters minimum,Special characters not allowed" required    class="form-control" value="<?php echo set_value('name');?>"></div>
                        </div>  
                       <div class="form-group required">
                            <label class="col-md-2 col-xs-10 control-label"><?php echo $this->lang->line('lbl_coupon_percentage_off'); ?></label>
                            <div class="col-md-6 col-xs-10"><input type="text"  required  name="percentage_off" id="percentage_off" class="form-control" value="<?php echo set_value('name');?>"></div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 col-xs-10 control-label"><?php echo $this->lang->line('lbl_start_date'); ?></label>
                            <div class="col-md-6 col-xs-10"><input type="text" name="start_date" class="form-control datepicker""></div>
                        </div>
                         <div class="form-group">
                            <label class="col-md-2 col-xs-10 control-label"><?php echo $this->lang->line('lbl_end_date'); ?></label>
                            <div class="col-md-6 col-xs-10"><input type="text" name="end_date" class="form-control datepicker""></div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_is_active'); ?></label>
                            <div class="col-md-4"> <?php echo form_dropdown('is_active', $is_active_array,  $emp_details->is_active); ?></div>
                        </div>

                        <div class="form-actions">                                    	
                            <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('btn_save'); ?></button>                          
                            <button type="reset" class="btn btn-primary"><?php echo $this->lang->line('btn_reset'); ?></button>
                           
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Normal -->

        <!-- /Page Content -->
    </div>
    <!-- /.container -->

</div>
