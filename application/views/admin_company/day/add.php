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
                        //form data
                        $attributes = array('class' => 'form-horizontal', 'id' => '');

                        //form validation
                      

                        echo form_open('admin_company/day/add', $attributes);
                        ?>
                        <div class="form-group required">
                            <label class="col-md-2 col-xs-10 control-label"><?php echo $this->lang->line('lbl_day'); ?></label>
                            <div class="col-md-6 col-xs-10"><input type="text"    required placeholder="<?php echo $this->lang->line('lbl_day'); ?>"  name="name" id="name" class="form-control" value="<?php echo set_value('name');?>"></div>
                        </div>                                 

                        <div class="form-group">
                            <label class="col-md-2 col-xs-10 control-label"><?php echo $this->lang->line('lbl_day_desc'); ?></label>
                            <div class="col-md-6 col-xs-10"><textarea id="" name="description" placeholder="<?php echo $this->lang->line('lbl_day_desc'); ?>" class="form-control" pattern="[a-zA-Z0-9]+" required ><?php echo set_value('description');?></textarea></div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-2 col-xs-10 control-label"><?php echo $this->lang->line('lbl_day_no'); ?></label>
                            <div class="col-md-6 col-xs-10"><?php echo form_dropdown('day_no', $days_array); ?></div>
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
