<style type="text/css">
    .ajax-loader {
        margin-left: auto; 
        margin-right: auto; 
        text-align: center;
        display: table;
    }
    @media(max-width: 560px) {
        .res_row > .column:nth-of-type(1):before { 
            content: "Sr No."; 
        }
        .res_row > .column:nth-of-type(2):before { 
            content: "Email"; 
        }
        .res_row > .column:nth-of-type(3):before { 
            content: "First Name"; 
        }
        .res_row > .column:nth-of-type(4):before { 
            content: "Last Name"; 
        }
        .res_row > .column:nth-of-type(5):before { 
            content: "Phone No."; 
        }
    }
</style>
<script type="text/javascript">
    var is_search = false, page = 1, search_string_array = "";

    $(document).ready(function () {
        setTimeout(function () {
            fetch_list(page);
        }, 1800);

        $("#search").click(function () {
            is_search = true;
            search_string_array = {'email': $("#email").val(), 'phone': $("#phone").val(),'full_name': $("#full_name").val()};
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
                    if (data.status === 'Session Expired') {
                        window.location.href = "<?php echo base_url(); ?>admin_company/login";
                    }
                    $('.ajax-loader').css("visibility", "hidden");
                    $('.res_row').empty();
                    var i = data.start;
                    $.each(data.rows, function (index, row) {
                            var employee_id = '"' + row['id'] + '"';
                            $(".res_table").append("<div class='res_row'>\n\
          <div class='column'  data-label='Sr no'>" + i  + "</div>\n\
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
                        echo '<label class="col-md-1 col-sm-2   control-label">'.$this->lang->line('lbl_email').'</label>';

                        echo '<div class="col-md-2 col-sm-4">';
                        $email_search = array(
                            'name' => 'email',
                            'id' => 'email',
                            'class' => 'form-control',
                            'placeholder' => $this->lang->line('lbl_email'),
                        );
                        echo form_input($email_search);
                        echo '</div>';
                        echo '<label class="col-md-1 col-sm-2   control-label">'.$this->lang->line('lbl_emp_full_name').'</label>';
                        echo '<div class="col-md-2 col-sm-4">';
                        $name_search = array(
                            'name' => 'full_name',
                            'id' => 'full_name',
                            'class' => 'form-control',
                            'placeholder' => $this->lang->line('lbl_emp_full_name'),
                        );
                        echo form_input($name_search);
                        echo '</div>';
                        echo '<label class="col-md-1 col-sm-2   control-label">'.$this->lang->line('lbl_emp_phone_no').'</label>';
                        echo '<div class="col-md-2 col-sm-4">';
                        $phone_search = array(
                            'name' => 'phone',
                            'id' => 'phone',
                            'class' => 'form-control',
                            'placeholder' => $this->lang->line('lbl_emp_phone_no'),
                        );
                        echo form_input($phone_search);
                        echo '</div>';
                        $data_submit = array('type' => "button", 'name' => 'mysubmit', 'id' => 'search', 'class' => 'btn btn-primary', 'value' => $this->lang->line('btn_search'));
                        echo '<div class="col-md-2 col-sm-2 searchbtn">';
                        echo form_submit($data_submit);
                        echo '</div>';
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