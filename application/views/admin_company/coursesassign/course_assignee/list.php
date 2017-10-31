<script>var is_search = false, page = 1, search_string_array = "";

    $(document).ready(function () {
        fetch_list(page);



        $("#search").click(function () {
            is_search = true;
            search_string_array = {'email_id': $("#email_id").val(), 'name': $("#full_name").val(),'is_active':$("#is_active").val()};
            search_string_array = JSON.stringify(search_string_array);

            fetch_list(page);
        });

    });
    function edit_course_assignee(user_id,course_id){
      var formData = {
          
            'course_id': course_id,
            'user_id': user_id
        };  
          $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: '../../admin_company/coursesassign/update_assignee_active_status', // the url where we want to POST
            data: formData, // our data object
            dataType: 'json', // what type of data do we expect back from the server
            encode: true,
            
        })
                // using the done promise callback
                .done(function (data) {
                  fetch_list(page)  ;
        });
    }


    function fetch_list(page) {
        var formData = {
            'search': is_search,
            'page': page,
            'search_string_array': search_string_array,
            'course_id': "<?php echo $course_id; ?>"
        };

        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: '../coursesassign/assignee_list', // the url where we want to POST
            data: formData, // our data object
            dataType: 'json', // what type of data do we expect back from the server
            encode: true,
             success: function (data) {
                                 var course_id = '"' + data.course + '"';
                    $('.res_row').empty();
                    var i = 0;
                    $.each(data.rows, function (i, row) {
                        var user_id = '"' + row['id'] + '"';
                        i++;

                        var row_data = "<div class='res_row'>\n\
                                <div class='column' data-label='Category name'>" + i + "</div>\n\
                <div class='column'  data-label='Sr no'>" + row['email_id'] + "</div>\n\
<div class='column' data-label='Category name'>" + row['full_name'] + "</div>\n\
      <div class='column' data-label='Category name'>" + row['is_active'] + "</div>";
                        if (row['is_active'] === 'Y') {

                            row_data = row_data + "<div class='column' data-label='action'><input type='button'  name='edit' value='Deactive'class='btn btn-info' onclick='edit_course_assignee(" + user_id +','+course_id+ ")'></button></div>";
                        } else {

                            row_data = row_data + "<div class='column' data-label='action'><input type='button'  name='edit' value='Activate'class='btn btn-info' onclick='edit_course_assignee(" + user_id +','+course_id+ ")'></button></div>";
                        }
                        row_data = row_data + "</div>";
                        $(".res_table").append(row_data);

                    })
                    pagination(data);
                            },
                            error: function () {
                                alert('error handing here');
                            }
        })   
    }


</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/pagination.js"></script>
<div id="content">
    <div class="container">
        <!-- Breadcrumbs line -->
        <div class="crumbs">
            <ul class="breadcrumb">
                <li>
                    <a href="<?php echo site_url("#"); ?>">
                       <?php echo $this->lang->line('brd_courses'); ?>
                    </a> 
                    
                </li>
                <li>
                    <a href="<?php echo site_url("admin_company") . '/' . $this->uri->segment(2); ?>">
                       <?php echo $this->lang->line('nav_chapter'); ?>
                    </a>

                </li>
                  <li>
                    <a href="#">
                       <?php echo $this->lang->line('lbl_view_assignee'); ?>
                    </a>

                </li>

            </ul>				      
        </div>

        <!-- /Breadcrumbs line -->
        <br/>
        <div class="row">
            <div class="col-md-12">
                <div class="widget box">
                   
                    <div class="widget-content">
                        <?php
                        $attributes = array('class' => 'form-horizontal row-border', 'id' => 'searchform');

                        $options_category = array('name' => 'Department Name');
                        echo form_open('#', $attributes);

                        echo '<div class="form-group">';
                        echo '<label class="col-md-1 col-sm-3  control-label">'. $this->lang->line('lbl_email').'</label>';

                        echo '<div class="col-md-2 col-sm-5">';
                        $data_search = array(
                            'name' => 'email_id',
                            'id' => 'email_id',
                            'class' => 'form-control',
                            'placeholder' => $this->lang->line('lbl_email'),
                        );
                        echo form_input($data_search);
                        echo '</div>';
                         echo '<label class="col-md-2 col-sm-3  control-label">'. $this->lang->line('lbl_emp_full_name').'</label>';

                        echo '<div class="col-md-2 col-sm-5">';
                        $data_search = array(
                            'name' => 'full_name',
                            'id' => 'full_name',
                            'class' => 'form-control',
                            'placeholder' => 'Enter name',
                        );
                        echo form_input($data_search);
                        echo '</div>';

                        echo '<label class="col-md-2 col-sm-2  control-label">'.$this->lang->line('lbl_is_user_active_for_course').'</label>';
                        echo '<div class="col-md-2 col-sm-5"  >';
             $options_order_type = array('' => 'Select', 'Yes' => 'Yes', 'No' => 'No');
             echo form_dropdown('is_active', $options_order_type, 'class="form-control"','id="is_active"');
            echo '</div>';


                        $data_submit = array('type' => "button", 'name' => 'mysubmit', 'id' => 'search', 'class' => 'btn btn-primary', 'value' => 'Search');

                        //echo '<div class="col-md-2 col-sm-4"  >';
                        // $options_order_type = array('Select' => 'Select', 'Asc' => 'Asc', 'Desc' => 'Desc');
                        // echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="form-control" id="order"');
                        //echo '</div>';
                        echo '<div class="col-md3 col-sm-2 searchbtn" >';
                        echo form_input($data_submit);
                        echo '</div>';
                        echo '</div>';
                        echo form_close();
                        ?>

                    </div> <!-- /.widget-content -->
                </div> <!-- /.widget .box -->
            </div> <!-- /.col-md-12 -->
        </div> <!-- /.row -->		


        <div class="row">
            <div class="col-md-12">												
                <?php
                ?>
               <!-- <a  href="<?php echo site_url("admin_company") . '/' . $this->uri->segment(2); ?>/add" class="btn btn-primary">Add New</a>-->
                </h2>
                <?php /*
                  }
                  } */
                ?>
                <p>&nbsp;</p>
                <div class="widget box">
                    <div class="widget-header">
                        <h4><?php echo $course_name.$this->lang->line('lbl_course_assigned_to'); ?> </h4>								
                    </div>

                    <div class="res_table">
                        <div class="res_table-head">
                            <div class="column"  data-label="Sr no"> <?php echo $this->lang->line('lbl_sr_no');?></div>
                            <div class="column" data-label="Email Id"><?php echo $this->lang->line('lbl_email');?></div>
                            <div class="column" data-label="Name"><?php echo $this->lang->line('lbl_emp_full_name');?></div>
                            <div class="column" data-label="Is Active"><?php echo $this->lang->line('lbl_is_user_active_for_course');?></div>
                            <div class="column" data-label="Action"><?php echo $this->lang->line('lbl_action');?></div>

                        </div> 

                    </div>  
                    <div class="pagination"> 
                        <div class="pagination-widget">
                            <div class="col-md-3 col-sm-1 col-xs-2">
                                <span id="reload"  class="glyphicon glyphicon-refresh" > </span>
                            </div>
                            <div class="col-md-5 col-sm-6 col-xs-10">
                                <span id="first_pager" class="glyphicon glyphicon-fast-backward" > </span>
                                <span id="previous_pager" class="glyphicon glyphicon-step-backward">  </span>
                                <span>Page </span>
                                <span><input type="text" class="form-control pagination-input" id="page_no" name="PageNo"   /></span>
                                <span>  of </span>
                                <span><lable class="pagination-lable" id="pageOf" >2 </lable></span>
                                </span>
                                <span id="next_pager"class="glyphicon glyphicon-step-forward" > </span>

                                <span id="last_pager"class="glyphicon glyphicon-fast-forward" >      </span>
                                <span> 
                                    <select style="margin-left: 10px">
                                        <option value="10">10 </option>
                                        <option value="20"> 20</option>
                                        <option value="25"> 25</option>
                                    </select>
                                </span>
                            </div>
                            <div class="col-md-4 col-sm-5 col-xs-12 pagination-right">   
                                <div class="pagination-right">
                                    <span>view</span>
                                    <span ><lable class="pagination-lable" id="rowFrm" >11 </lable></span>
                                    <span>-</span>
                                    <span><lable class="pagination-lable" id="rowTo" >20</lable></span>
                                    <span>view</span>
                                    <span id="totalCount">50 </span>
                                </div>
                            </div>
                        </div>                        
                    </div>

                </div>

            </div>

        </div>
    </div>
    <!-- /Normal -->
</div>
</div>