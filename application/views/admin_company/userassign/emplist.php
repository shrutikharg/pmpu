<style>
    .ajax-loader {
        margin-left: auto; 
        margin-right: auto; 
        text-align: center;
        display: table;
    }
</style>
<script>
    var is_search = false, page = 1, search_string_array = "";

    $(document).ready(function () {
        setTimeout(function () {
            fetch_list(page);
        }, 1800);

        $("#search").click(function () {
            is_search = true;
            search_string_array = {'search_string': $("#search_string").val(), 'order': $("#order").val()};
            search_string_array = JSON.stringify(search_string_array);

            fetch_list(page);
            });
        });
        function edit_category(category_id) {
            var form = $(document.createElement('form'));
            $(form).attr("action", "../admin_company/category/update");
            $(form).attr("method", "POST");
            $(form).attr("id", "form1");
            var input = $("<input>").attr("type", "hidden").attr("name", "category_id").val(category_id);
            $(form).append($(input));
            $(form).appendTo("body").submit();
        }
        function view_details(employee_id) {
            var form = $(document.createElement('form'));
            $(form).attr("action", "<?php echo base_url(); ?>admin_company/employee_details");
            $(form).attr("method", "POST");
            $(form).attr("id", "form1");
            var input = $("<input>").attr("type", "hidden").attr("name", "employee_id").val(employee_id);
            $(form).append($(input));
            $(form).appendTo("body").submit();
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
                beforeSend: function () {
                    $('.ajax-loader').css("visibility", "visible");
                },
                url: '../admin_company/employeelist/list', // the url where we want to POST
                data: formData, // our data object
                dataType: 'json', // what type of data do we expect back from the server
                encode: true
            })
                    // using the done promise callback
                    .done(function (data) {
                        $('.ajax-loader').css("visibility", "hidden");
                        $('.res_row').empty();
                    var i = data.start;
                    $.each(data.rows, function (index, row) {
                            var employee_id = '"' + row['id'] + '"';
                            $(".res_table").append("<div class='res_row'>\n\
          <div class='column'  data-label='Sr no'>" + (i + 1) + "</div>\n\
<div class='column' data-label='Category name'>" + row['email'] + "</div>\n\
\n\<div class='column' data-label='Category name'>" + row['first_name'] + "</div>\n\
\n\<div class='column' data-label='Category name'>" + row['last_name'] + "</div>\n\
\n\<div class='column' data-label='Category name'>" + row['phone_no'] + "</div>\n\
\n\<td class='column' data-label='action'>\n\
<input type='button'  value=' <?php echo $this->lang->line('btn_details'); ?>' class='btn btn-info' onclick='view_details(" + employee_id + ")'></button> \n\
\n\ </td></div>");
                        i++;
                    });
                    pagination(data);
                }).fail(function (data) {
            window.location.href = "<?php echo base_url(); ?>admin_company/login";
        });
    }


</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/pagination.js"></script>
<div id="content">
    <div class="container">
        <div class="crumbs">
            <ul class="breadcrumb">
                <li>
                    <a href="#">
                        <?php echo $this->lang->line('brd_employee'); ?>
                    </a> 

                </li>
                <li class="active">
                    <a href="<?php echo site_url("admin_company") . '/' . $this->uri->segment(2); ?>">
                        <?php echo $this->lang->line('nav_employee_list'); ?>
                    </a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="widget box">
                    <div class="widget-header">
                        <h2><?php echo $this->lang->line('lbl_search') ?></h2>
                    </div>
                    <div class="widget-content">
                        <?php
                        $attributes = array('class' => 'form-horizontal row-border', 'id' => 'myform');
                        $options_category = array('name' => 'Chapter Name');
                        echo form_open('admin_company/userassign', $attributes);

                        echo '<div class="form-group">';
                        echo '<label class="col-md-1   control-label">Search:</label>';

                        echo '<div class="col-md-3">';
                        $data_search = array(
                            'name' => 'search_string',
                            'id' => 'search_string',
                            'class' => 'form-control',
                            'placeholder' => 'Enter Employee name',
                        );
                        echo form_input($data_search, $search_string_selected);
                        echo '</div>';

                        echo '<label class="col-md-2   control-label">Order by:</label>';
                        //echo form_input('search_string', $search_string_selected);
                        echo '<div class="col-md-2" style="padding-left:0px !important; padding-right:0px !important;">';
                        echo form_dropdown('order', $options_category, $order, 'class="form-control"');
                        echo '</div>';



                        echo '<div class="col-md-1" style="padding-left:0px !important; padding-right:0px !important;">';
                        $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
                        echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="form-control"');
                        echo '</div>';
                        $data_submit = array('type' => "button", 'name' => 'mysubmit', 'id' => 'search', 'class' => 'btn btn-primary', 'value' => $this->lang->line('btn_search'));
                        echo form_input($data_submit);
                        echo '</div>';
                        echo form_close();
                        ?>

                    </div> <!-- /.widget-content -->
                </div> <!-- /.widget .box -->
            </div> <!-- /.col-md-12 -->
        </div>

        <div class="row">
            <div class="col-md-12">
                <?php
                if (!empty($this->session->flashdata('flash_message'))) {
                    //flash messages

                    echo '<div class="alert alert-success">';
                    echo '<a class="close" data-dismiss="alert">×</a>';
                    echo '<strong>' . $this->session->flashdata('flash_message');
                    echo '</div>';
                }
                ?>
                <div class="res_table">
                    <div class="res_table-head">
                        <div class="column" data-label="SR.no"><?php echo $this->lang->line('lbl_sr_no'); ?></div>
                        <div class="column" data-label="Email"><?php echo $this->lang->line('lbl_email'); ?></div>
                        <div class="column" data-label="First Name"><?php echo $this->lang->line('lbl_emp_first_name'); ?></div>
                        <div class="column" data-label="Last Name"><?php echo $this->lang->line('lbl_emp_last_name'); ?></div>
                        <div class="column" data-label="action"><?php echo $this->lang->line('lbl_emp_phone_no'); ?></div>
                        <div class="column" data-label="action"><?php echo $this->lang->line('btn_details'); ?></div>
                    </div>
                </div>
                <div class="ajax-loader">
                    <img src="../assets/images/ajax-loader.gif" class="img-responsive" style="max-height: 27px;"/>
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
                                <span ><lable class="pagination-lable" id="rowFrm" > </lable></span>
                                <span>-</span>
                                <span><lable class="pagination-lable" id="rowTo" ></lable></span>
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
</div>