<div id="content">
    <div class="container">
        <!-- Breadcrumbs line -->
        <div class="crumbs">
            <ul class="breadcrumb">
                <li>
                    <a href="#">
                        <?php echo $this->lang->line('brd_organization'); ?>

                    </a> 

                </li>
                <li>
                    <a href="<?php echo site_url("admin_company") . '/' . $this->uri->segment(2); ?>">
                        <?php echo $this->lang->line('brd_department'); ?>
                    </a> 

                </li>
                <li class="active">
                    <a href="#">  <?php echo $this->lang->line('brd_edit'); ?></a>
                </li>
            </ul>				      
        </div>

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
                        $attributes = array('class' => 'form-horizontal', 'id' => '');



                        echo form_open('admin_company/day/update', $attributes);
                        ?>
                        <div class="form-group required">
                            <label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_day'); ?></label>
                            <div class="col-md-10"><input type="text"  name="name" id="name" class="form-control" value="<?php echo $day[0]['name'] ?>" ></div>
                        </div>                 

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_day_desc'); ?></label>
                            <div class="col-md-10"><textarea id="" name="description" class="form-control" ><?php echo $day[0]['description'] ?></textarea></div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-10 control-label"><?php echo $this->lang->line('lbl_day_no'); ?></label>
                            <div class="col-md-6 col-xs-10"><?php echo form_dropdown('day_no', $days_array,$day[0]['day_no']); ?></div>
                        </div>
                        <div class="form-group" style="display:none;">
                            <div class="col-md-10"><input type="text"  name="id" class="form-control" value="<?php echo $day_id; ?>" ></div>


                        </div>



                        <div class="form-actions">                                    	
                            <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('btn_save'); ?></button>
                            <a href="../category">   <button  class="btn btn-primary"><?php echo $this->lang->line('btn_cancel'); ?></a>

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
