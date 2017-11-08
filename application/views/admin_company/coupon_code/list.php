<script src="https://code.jquery.com/jquery-1.10.2.js"></script>  
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>   
<style>
    .ajax-loader {
        visibility: hidden;
        background-color: rgba(0,0,0,0.7);
        position: fixed;
        top:0%;
        left:0%;
        bottom:0%;
        right:0%;
        z-index: 1000 !important;
        width: 100%;
        height:100%;
    }

    .ajax-loader img {

        top:50%;
        left:45%;


    }
    .ui-datepicker .ui-datepicker-header, .ui-datepicker td .ui-state-hover {
        background-color: #99D9EA;
    }
</style>
<script>var is_search = false, page = 1, search_string_array = "";
    $.noConflict();
    jQuery(document).ready(function ($) {
        fetch_list(page);
        $(".datepicker").datepicker({
            dateFormat: "dd-mm-yy",
            showOtherMonths: true,
            selectOtherMonths: true,
            autoclose: true,
            changeMonth: true,
            changeYear: true,
        });


        $("#search").click(function () {
            is_search = true;
            search_string_array = {'name': $("#name").val(), 'start_date': $("#start_date").val(), 'end_date': $("#end_date").val(), 'is_active': $("#is_active").val()};
            search_string_array = JSON.stringify(search_string_array);

            fetch_list(page);
        });


    });
    function edit_couponcode(couponcode_id) {


        var form = $(document.createElement('form'));
        $(form).attr("action", "<?php echo base_url(); ?>admin_company/coupon_code/update");
        $(form).attr("method", "POST");
        $(form).attr("id", "form1");
        var input = $("<input>").attr("type", "hidden").attr("name", "couponcode_id").val(couponcode_id);
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
            url: '../admin_company/coupon_code/list', // the url where we want to POST
            data: formData, // our data object
            dataType: 'json', // what type of data do we expect back from the server
            encode: true
        })
                // using the done promise callback
                .done(function (data) {
                    $('.ajax-loader').css("visibility", "hidden");
                    $('.res_row').empty();
                    var i = 0;
                    $.each(data.rows, function (i, row) {
                        var couponcode_id = '"' + row['id'] + '"';
                        $(".res_table").append("<div class='res_row'>\n\
            <div class='column' data-label='Sr no'>" + (i + 1) + "</div>\n\
<div class='column' data-label='Coupon Code'>" + row['name'] + "</div>\n\
<div class='column' data-label='Percentage Off'>" + row['percentage_off'] + "</div>\n\
\n\<div class='column' data-label='Start Date'>" + row['start_date'] + "</div>\n\
\n\<div class='column' data-label='End Date'>" + row['end_date'] + "</div>\n\
\n\<div class='column' data-label='Is Active'>" + row['is_active'] + "</div>\n\
<div class='column' data-label='action'><input type='button'  name='edit' value='<?php echo $this->lang->line('btn_edit'); ?>'class='btn btn-info' onclick='edit_couponcode(" + couponcode_id + ")'></button></div>\n\
</div>");
                        i++;
                    });
                    pagination(data);
                });
    }


</script>

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
                        <?php echo $this->lang->line('nav_coupon_code'); ?>
                    </a> 

                </li>>

            </ul>				      
        </div>

        <!-- /Breadcrumbs line -->
        <br/>
        <div class="row">
            <div class="col-md-12">
                <div class="widget box">
                    <div class="widget-header">
                        <h2><?php echo $this->lang->line('lbl_search') ?></h2>
                    </div>
                    <div class="widget-content">
                        <?php
                        $attributes = array('class' => 'form-horizontal row-border', 'id' => 'searchform');


                        echo form_open('#', $attributes);

                        echo '<div class="form-group">';
                        echo "<label class='col-md-1 col-sm-3  control-label'>" . $this->lang->line('lbl_coupon_code') . "</label>";

                        echo '<div class="col-md-2 col-sm-5">';
                        $data_search = array(
                            'name' => 'name',
                            'id' => 'name',
                            'class' => 'form-control',
                            'placeholder' => $this->lang->line('lbl_coupon_code')
                        );
                        echo form_input($data_search);
                        echo '</div>';
                        echo "<label class='col-md-1 col-sm-3  control-label'>" . $this->lang->line('lbl_start_date') . "</label>";

                        echo '<div class="col-md-2 col-sm-5">';
                        $data_start_date = array(
                            'name' => 'start_date',
                            'id' => 'start_date',
                            'class' => 'form-control datepicker',
                            'placeholder' => $this->lang->line('lbl_start_date')
                        );
                        echo form_input($data_start_date);
                        echo '</div>';
                        echo "<label class='col-md-1 col-sm-3  control-label'>" . $this->lang->line('lbl_end_date') . "</label>";

                        echo '<div class="col-md-2 col-sm-5">';
                        $data_end_date = array(
                            'name' => 'end_date',
                            'id' => 'end_date',
                            'class' => 'form-control datepicker',
                            'placeholder' => $this->lang->line('lbl_end_date')
                        );
                        echo form_input($data_end_date);
                        echo '</div>';
                        echo "<label class='col-md-1 col-sm-3  control-label'>" . $this->lang->line('lbl_is_active') . "</label>";

                        echo '<div class="col-md-1 col-sm-5">';
                        $is_active_array = array('' => 'Select', 'Y' => 'Yes', 'N' => 'No');
                        echo form_dropdown('is_active', $is_active_array, '', 'class="form-control" id="is_active"');
                        echo '</div>';
                        $data_submit = array('type' => "button", 'name' => 'mysubmit', 'id' => 'search', 'class' => 'btn btn-primary', 'value' => $this->lang->line('btn_search'));

                        echo '<div class="col-md-2 col-sm-2 searchbtn" >';
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
                <?php ?>
                <a  href="<?php echo site_url("admin_company") . '/' . $this->uri->segment(2); ?>/add" class="btn btn-primary">Add New</a>
                </h2>
                <?php /*
                  }
                  } */
                ?>
                <p>&nbsp;</p>
                <div class="widget box">
                    <div class="widget-header">
                        <h4> <?php echo $this->lang->line('lbl_coupon_code_lst'); ?></h4>								
                    </div>

                    <div class="res_table">
                        <div class="res_table-head">
                            <div class="column"  data-label="Sr no">  <?php echo $this->lang->line('lbl_sr_no'); ?></div>
                            <div class="column" data-label="Coupon Code"> <?php echo $this->lang->line('lbl_coupon_code'); ?></div>
                            <div class="column" data-label="Coupon Code"> <?php echo $this->lang->line('lbl_coupon_percentage_off'); ?></div>
                            <div class="column" data-label="Start_Date"> <?php echo $this->lang->line('lbl_start_date'); ?></div>
                            <div class="column" data-label="End Date"> <?php echo $this->lang->line('lbl_end_date'); ?></div>
                            <div class="column" data-label="Is Active"> <?php echo $this->lang->line('lbl_is_active'); ?></div>
                            <div class="column" data-label="Action"> <?php echo $this->lang->line('lbl_action'); ?></div>

                        </div> 

                    </div> 
                    <div class="ajax-loader">
                        <img src="../assets/images/ajax-loader.gif" class="img-responsive" />
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
    <!-- /Normal -->
</div>
</div>