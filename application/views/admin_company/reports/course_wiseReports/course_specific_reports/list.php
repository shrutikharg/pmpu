<script src="<?php echo base_url(); ?>assets/assets/js/demo/jquery_1.9.1.js"></script> 
<script src="<?php echo base_url(); ?>assets/assets/js/demo/jquery_ui_1.9.1.js"></script> 

<script type="text/javascript">
    var is_search = false, page = 1, search_string_array = "";
    $(document).ready(function () {
        fetch_list(page);

        $("#search").click(function () {
            is_search = true;
            search_string_array = {'course': $("#course").val(), 'chapter': $("#chapter").val(), 'email': $("#email").val(), 'lesson_status': $("#lesson_status").val()};
            search_string_array = JSON.stringify(search_string_array);

            fetch_list(page);
        });

        $("#csv").click(function () {

            var form = $(document.createElement('form'));
            $(form).attr("action", "../../admin_company/reports/selected_courses_list");
            $(form).attr("method", "POST");
            $(form).attr("id", "form1");
            var input = $("<input>").attr("type", "hidden").attr("name", "course_id").val("<?php echo $course_specific_id; ?>");
            $(form).append(input);
            $(form).append($("<input>").attr("type", "hidden").attr("name", "is_csv").val("yes"));

            $(form).append($("<input>").attr("type", "hidden").attr("name", "is_csv").val("yes"));
            $(form).append($("<input>").attr("type", "hidden").attr("name", "search").val(false));
            $(form).append($("<input>").attr("type", "hidden").attr("name", "page").val(1));
            $(form).append($("<input>").attr("type", "hidden").attr("name", "search_string_array").val(""));
            $(form).appendTo("body").submit();

        });

    });
    function fetch_list(page) {
        var formData = {
            'search': is_search,
            'page': page,
            'search_string_array': search_string_array,
            'rows': $("#rows").val(),
            'course_id': "<?php echo $course_specific_id; ?>"
        };

        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: '../../admin_company/reports/selected_courses_list', // the url where we want to POST
            data: formData, // our data object
            dataType: 'json', // what type of data do we expect back from the server
            encode: true
        })
                // using the done promise callback
                .done(function (data) {
                    if (data.status === 'Session Expired') {

                        window.location.href = "<?php echo base_url(); ?>admin_company/login";
                    }
                    $('.res_row').empty();
                    var i = data.start;
                    $.each(data.rows, function (index, row) {
                       $(".res_table").append("<div class='res_row'>\n\
                <div class='column' s data-label='Sr no'>" + i + "</div>\n\
<div class='column' data-label='User'>" + row['user'] + "</div>\n\
\n\<div class='column' data-label='Completion Status'>" + row['completion_status'] + "</div>\n\
<div class='column' data-label='Completion Date'>" + row['completed_on'] + "</div>\n\
</div>");
                        i++;

                    });
                    pagination(data);
                });


    }
</script>
<style type="text/css">
    @media(max-width: 560px) {
        .res_row > .column:nth-of-type(1):before { 
            content: "Sr No."; 
        }
        .res_row > .column:nth-of-type(2):before { 
            content: "Email"; 
        }
        .res_row > .column:nth-of-type(3):before { 
            content: "Status"; 
        }
        .res_row > .column:nth-of-type(4):before { 
            content: "Completed On"; 
        }
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
                    <a href="#">
                        <?php echo $this->lang->line('nav_course_specific_report'); ?>
                    </a> 

                </li>>

            </ul>				      
        </div>

        <br/>
        <div class="row">
            <div class="col-md-12">
                <div class="widget box">
                    <div class="widget-header">
                        <h2><?php echo $this->lang->line('lbl_search'); ?></h2>
                    </div>
                    <div class="widget-content">
                        <?php
                        $attributes = array('class' => 'form-horizontal row-border', 'id' => 'myform');



                        echo form_open('admin_company/chapters', $attributes);

                        echo '<div class="form-group">';
                        echo '<label class="col-md-1   control-label">' . $this->lang->line('lbl_email') . '</label>';

                        echo '<div class="col-md-3">';
                        $email_data = array(
                            'name' => 'email',
                            'id' => 'email',
                            'class' => 'form-control',
                            'placeholder' => $this->lang->line('lbl_email'),
                        );
                        echo form_input($email_data);

                        echo '</div>';

                        echo '<label class="col-md-1   control-label">' . $this->lang->line('lbl_user_course_status') . '</label>';

                        echo '<div class="col-md-3">';
                        $lesson_status_data = array(
                            'name' => 'lesson_status',
                            'id' => 'lesson_status',
                            'class' => 'form-control',
                            'placeholder' => $this->lang->line('lbl_user_course_status')
                        );
                        echo form_input($lesson_status_data);
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
                        <h4><?php echo $this->lang->line("lbl_course_specific_report_list") . $course_data[0]['name']; ?></h4>								
                    </div>

                    <div class="res_table">
                        <div class="res_table-head">
                            <div class="column" data-label="Sr no"> <?php echo $this->lang->line('lbl_sr_no'); ?></div>
                            <div class="column"><?php echo $this->lang->line('lbl_email'); ?></div>
                            <div class="column"><?php echo $this->lang->line('lbl_user_course_status'); ?></div>
                            <div class="column"><?php echo $this->lang->line('lbl_course_cmplt_date'); ?></div>

                        </div>     

                    </div> 
                    <div class="pagination"> 
                        <div class="pagination-widget">
                            <div class="col-md-3 col-sm-1 col-xs-2">
                                <span  id="reload" class="glyphicon glyphicon-refresh" > </span>
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
                                    <select id="rows" style="margin-left: 10px">
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
                <input type="button" id="csv" value="Download Report"/>
            </div >    



        </div>

    </div>

</div>

