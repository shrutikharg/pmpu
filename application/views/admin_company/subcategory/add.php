<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/verify_name_availability/check_subcategory_availability.js"></script>
<div id="content">
    <div class="container">
      
        <!-- Breadcrumbs line -->
        <div class="crumbs">
            <ul class="breadcrumb">
                <li>
                    <a href="#">
                        <?php echo $this->lang->line('brd_organization') ?>
                    </a> 

                </li>
                <li>
                    <a href="<?php echo site_url("admin_company") . '/' . $this->uri->segment(2); ?>">
                        <?php echo $this->lang->line('brd_subdepartment') ?>
                    </a> 

                </li>
                <li class="active">
                    <a href="#"> <?php echo $this->lang->line('btn_add') ?></a>
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
            $options_category = array();
            foreach ($category as $array) {
                foreach ($array as $key => $value) {
                    $options_category[$key] = $key;
                }
                break;
            }

            if (isset($message)) {
                
                    echo '<div class="alert alert-danger">';
                    echo '<a class="close" data-dismiss="alert">×</a>';
                    echo '<strong>'.$message;
                    echo '</div>';
               
            }
            ?>
            <div class="col-md-12">
                <div class="widget box">
                    <div class="widget-header">
                        <h4><?php echo $this->lang->line('lbl_create_subdepartment');?></h4>								
                    </div>
                    <div class="widget-content">
                        <?php
//form data
                        $attributes = array('class' => 'form-horizontal', 'id' => '');
//form validation
                      
                        echo form_open('admin_company/subcategory/add', $attributes);
                        ?>
                        <div class="form-group required">
                            <label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_subdepartment');?></label>
                            <div class="col-md-10"><input type="text" id="name" pattern="[a-zA-Z]+.{2,}"   required title="Enter Sub Department Name 3 characters minimum" required   name="name" class="form-control" value="<?php echo set_value('name'); ?>"></div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_subdepartment_desc');?></label>
                            <div class="col-md-10"><textarea class="form-control"  pattern="[a-zA-Z0-9]+" required name="description"><?php echo set_value('description'); ?></textarea></div>
                        </div>

                        <div class="form-group required">
                            <label class="col-md-2 control-label"><?php echo $this->lang->line('lbl_department');?></label>
                            <div class="col-md-4">
                                <select name="category_id"  id="category_id" class="form-control required">
													<option value=""><?php  echo $this->lang->line('opt_select');?> </option>
													<?php foreach($category_list as $category){ ?>									
													<option <?php if(isset($post_data)) { if($post_data['category_id']==$category['id']) echo "selected"; }  ?> value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
												<?php } ?>
												</select></div>
                            
                        </div>   

                        <div class="form-actions">                                    	
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="reset" class="btn">Reset</button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
        <!-- /Normal -->

        <!-- /Page Content -->
    </div>
    <?php
    /* }
      else
      { */
    ?>
    <div id="content">
        <div class="container">
            <?php /*
              echo "<br/></br></br></br>";
              echo "<h3> Sorry you can not add Subcategory you reach your max limit  !!!</h3>";
              } */
            ?>
        </div>
    </div>

</div>
</div>