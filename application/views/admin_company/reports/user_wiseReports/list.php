<script src="<?php echo base_url(); ?>assets/assets/js/demo/jquery_1.9.1.js"></script> 
<script src="<?php echo base_url(); ?>assets/assets/js/demo/jquery_ui_1.9.1.js"></script> 
<script>
    var is_search = false, page = 1, search_string_array = "";
    $(document).ready(function () {

        fetch_list(page);



        $("#search").click(function () {
            is_search = true;
            search_string_array = {'email_id': $("#email").val(), 'name': $("#name").val(), 'course_assign': $("#course_assign").val()};
            search_string_array = JSON.stringify(search_string_array);

            fetch_list(page);
        });

    });
    function view_user_details(user_id) {
        var form = $(document.createElement('form'));
        $(form).attr("action", "../../admin_company/reports/selected_users");
        $(form).attr("method", "POST");

        var input = $("<input>").attr("type", "hidden").attr("name", "user_id").val(user_id);
        $(form).append($(input));
        $(form).append($("<input>").attr("type", "hidden").attr("name", "is_csv").val("no"));
        $(form).appendTo("body").submit();
        ;
    }

    function fetch_list(page) {
        var formData = {
            'search': is_search,
            'page': page,
            'search_string_array': search_string_array,
            'rows': $("#rows").val()
        };

        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: '../../admin_company/reports/userwise_list', // the url where we want to POST
            data: formData, // our data object
            dataType: 'json', // what type of data do we expect back from the server
            encode: true
        })
                // using the done promise callback
                .done(function (data) {
                    $('.res_row').empty();
                    var i = data.start;
                    $.each(data.rows, function (index, row) {

                        var user_id = '"' + row['id'] + '"';
                        $(".res_table").append("<div class='res_row'>\n\
                <div class='column'  data-label='Sr no'>" + i + "</div>\n\
<div class='column' data-label='Email'>" + row['email'] + "</div>\n\
<div class='column' data-label='Full Name'>" + row['name'] + "</div>\n\
\n\<div class='column' data-label='Course Assigned'>" + row['courses'] + "</div>\n\
<div class='column' data-label='action'><input type='button'  name='edit' value='View Details' class='btn btn-info' onclick='view_user_details(" + user_id + ")'></button></div>\n\
</div>");
                        i++;
                    })
                    pagination(data);
                });
    }</script>
<style>
    table.primary th
    {
        border-bottom-width: 2px;
        border: 1px solid #ddd;
        padding: 5px;
        vertical-align: bottom;
        border-bottom: 2px solid #ddd;
        text-align: left;
        font-weight: bold;
        display: table-cell;
        border-spacing: 2px;
        border-color: grey;
        background-color: #ffffff;
    }

    table.primary td
    {
        border: 1px solid #ddd;   
        border-top: 1px solid #ddd;
    }

    table.primary tr:nth-child(odd) {
        background-color: #fafafa;


    }
    table.primary tr:nth-child(even) {
        background-color: #ffffff;

    }
    table.primary tr.deactivate{
        background-color: #ffc;
    }

</style>

<div id="content">
    <div class="container">
        <div class="crumbs">
            <ul class="breadcrumb">
                <li>
                    <a href="#">
                        <?php echo $this->lang->line('nav_report'); ?>

                    </a> 

                </li>
                <li>
                    <a href="<?php echo site_url("admin_company") . '/reports/' . $this->uri->segment(3); ?>">
                        <?php echo $this->lang->line('nav_user_report'); ?>
                    </a> 

                </li>>

            </ul>				      
        </div>
        <br>
        <div class="row">

            <div class="col-md-12">
                <div class="widget box">

                    <div class="widget-content">
                        <?php
                        $attributes = array('class' => 'form-horizontal row-border', 'id' => 'myform');

                        $options_category = array('name' => 'Chapter Name');

                        echo form_open('admin_company/chapters', $attributes);

                        echo '<div class="form-group">';
                        echo '<label class="col-md-1   control-label">' . $this->lang->line('lbl_email') . '</label>';

                        echo '<div class="col-md-2">';
                        $email_control = array(
                            'name' => 'email',
                            'id' => 'email',
                            'class' => 'form-control',
                            'placeholder' => $this->lang->line('lbl_email')
                        );
                        echo form_input($email_control);
                        echo '</div>';
                        echo '<label class="col-md-1   control-label">' . $this->lang->line('lbl_emp_full_name') . '</label>';
                        echo '<div class="col-md-2">';
                        $name_control = array(
                            'name' => 'name',
                            'id' => 'name',
                            'class' => 'form-control',
                            'placeholder' => $this->lang->line('lbl_emp_full_name'),
                        );
                        echo form_input($name_control);
                        echo '</div>';
                        echo '<label class="col-md-1   control-label">' . $this->lang->line('lbl_assigned_course') . '</label>';
                        echo '<div class="col-md-2">';
                        $course_assign_control = array(
                            'name' => 'course_assign',
                            'id' => 'course_assign',
                            'class' => 'form-control',
                            'placeholder' => $this->lang->line('lbl_assigned_course')
                        );
                        echo form_input($course_assign_control);
                        echo '</div>';

                        $data_submit = array('type' => 'button', 'name' => 'mysubmit', 'class' => 'btn btn-primary', 'id' => 'search', 'value' => $this->lang->line('btn_search'));

                        echo form_submit($data_submit);
                        echo '</div>';
                        echo form_close();
                        ?>	

                    </div> <!-- /.widget-content -->
                </div> <!-- /.widget .box -->
            </div> <!-- /.col-md-12 -->

        </div> <!-- /.row -->		
        <!-- /Statboxes -->
        <!--=== Normal ===-->
        <div class="row">
            <div class="col-md-12">	


                <div class="widget box">
                    <div class="widget-header">
                        <h4><?php echo $this->lang->line('lbl_user_report_list'); ?></h4>								
                    </div>

                    <div class="res_table">
                        <div class="res_table-head">
                            <div class="column" data-label="Sr no"> <?php echo $this->lang->line('lbl_sr_no'); ?></div>
                            <div class="column"><?php echo $this->lang->line('lbl_email'); ?></div>
                            <div class="column"><?php echo $this->lang->line('lbl_emp_full_name'); ?></div>
                            <div class="column"><?php echo $this->lang->line('lbl_assigned_course'); ?></div>
                            <div class="column"><?php echo $this->lang->line('lbl_action'); ?></div>
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
                                    <select id='rows' style="margin-left: 10px">
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
                    </div></div>  </div>   
        </div >    
 





    </div>

</div>

</div>
</div>
<!-- /Normal -->
</div>
</div>		