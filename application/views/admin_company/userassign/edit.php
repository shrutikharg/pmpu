<div id="content">
    <div class="container">
        <!-- Breadcrumbs line -->
        <div class="crumbs">
           <ul class="breadcrumb">
                <li>
                    <a href="#">
                        <?php echo $this->lang->line('brd_employee'); ?>
                    </a> 

                </li>
                <li class="active">
                    <a href="<?php echo site_url("admin_company") . '/employeelist'; ?>">
                        <?php echo $this->lang->line('nav_employee_list'); ?>
                    </a>
                </li>
                  <li class="active">
                    <a href="#">
                        <?php echo $this->lang->line('btn_details'); ?>
                    </a>
                </li>
            </ul>				      
        </div>
           <div class="row">
            <div class="col-md-12">
                <div class="widget box">
                   
                </div> <!-- /.widget .box -->
            </div> <!-- /.col-md-12 -->
        </div>

        <div class="row">
            <?php
            if (isset($message)) {
                //flash messages

                echo '<div class="alert alert-danger">';
                echo '<a class="close" data-dismiss="alert">×</a>';
                echo '<strong>' . $message;
                echo '</div>';
            }
            ?>
            <div class="col-md-12">
                <div class="widget box">
                    <div class="widget-header">
                        <h4><?php echo $this->lang->line('lbl_edit_department'); ?></h4>								
                    </div>
                    <div class="widget-content">
                        <?php
//form data
                        $is_active_array=array('Y'=>'Yes','N'=>'No');
                        $attributes = array('class' => 'form-horizontal', 'id' => '');
                        echo form_open('admin_company/employee_update/', $attributes);
                        ?>
                         <div class="form-group ">
                           
                            <div class="col-md-4"><input type="hidden"  name="id"  class="form-control" value="<?php echo $employee_id; ?>"  readonly=""/></div>
                        </div>
                        <div class="form-group ">
                            <label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_emp_first_name'); ?></label>
                            <div class="col-md-4"><input type="text"  name="first_name"  class="form-control" value="<?php echo $emp_details->first_name; ?>"  readonly=""/></div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_emp_last_name'); ?></label>
                            <div class="col-md-4"><input type="text"  name="last_name"  class="form-control" value="<?php echo $emp_details->last_name; ?>" readonly=""></div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_email'); ?></label>
                            <div class="col-md-4"><input type="text"  name="email"  class="form-control" value="<?php echo $emp_details->email; ?>" readonly="" ></div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_emp_phone_no'); ?></label>
                            <div class="col-md-4"><input type="text"  name="phone"  class="form-control" value="<?php echo $emp_details->phone_no; ?>" readonly="" ></div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_emp_subscribed_at'); ?></label>
                            <div class="col-md-4"><input type="text"  name="subsription_date"  class="form-control" value="<?php echo date("d-m-Y H:i:s", strtotime($emp_details->created_at)); ?>" readonly="" ></div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_payment_mode'); ?></label>
                            <div class="col-md-4"><input type="text"  name="payment_mode"  class="form-control" value="<?php echo  $emp_details->payment_through; ?>" readonly ></div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_emp_txn_id'); ?></label>
                            <div class="col-md-4"><input type="text"  name="txn_id"  class="form-control" value="<?php echo $emp_details->txn_id; ?>"  readonly=""></div>
                        </div>
                         <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_is_active'); ?></label>
                            <div class="col-md-4"> <?php echo form_dropdown('is_active', $is_active_array,  $emp_details->is_active); ?></div>
                        </div>
                       




                        <div class="form-actions">                                    	
                            <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('btn_save'); ?></button>
                            <a href="employeelist">   <button  class="btn btn-primary"><?php echo $this->lang->line('btn_cancel'); ?></a>

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
</div>