<style type="text/css">
    .ajax-loader {
        margin-left: auto; 
        margin-right: auto; 
        display: block; 
        text-align: -webkit-center;
        text-align: -moz-center;
        text-align: center;
    }
    .res_row > .column {
        padding: 10px 0px;
        word-break: break-all;
    }
    .res_row > .column:nth-of-type(1) {
        width: 10%;
    }
    .res_row > .column:nth-of-type(2) {
        width: 20%;
    }
    .res_row > .column:nth-of-type(3) {
        width: 30%;
    }
    .res_row > .column:nth-of-type(4) {
        width: 25%;
    }
    .res_row > .column:nth-of-type(5) {
        width: 15%;
    }
    @media(max-width: 560px) {
        .res_row > .column {
            padding-left: 40%;
        }
        .res_row > .column {
            width: auto !important;
        }
        .res_row > .column:nth-of-type(1):before { 
            content: "Course"; 
        }
        .res_row > .column:nth-of-type(2):before { 
            content: "Chapter"; 
        }
        .res_row > .column:nth-of-type(3):before { 
            content: "Status"; 
        }
        .res_row > .column:nth-of-type(4):before { 
            content: "Attempted %"; 
        }
        .res_row > .column:nth-of-type(5):before { 
            content: "Deatils"; 
        }
    }
</style>
<script src="<?php echo base_url(); ?>assets/assets/js/demo/jquery_1.9.1.js"></script> 
<script type="text/javascript">
    var is_search = false, page = 1, search_string_array = "";
        $(document).ready(function () {
            setTimeout(function(){fetch_list(page);}, 1800);
//            fetch_list(page);
            $("#search").click(function () {
                is_search = true;
                search_string_array = {'course': $("#course").val(), 'chapter': $("#chapter").val(), 'email': $("#email").val(), 'lesson_status': $("#lesson_status").val()};
                search_string_array = JSON.stringify(search_string_array);
                fetch_list(page);
            });
            $("#csv").click(function () {
                var form = $(document.createElement('form'));
                $(form).attr("action", "../../admin_company/reports/selected_users_list");
                $(form).attr("method", "POST");
                $(form).attr("id", "form1");
                var input = $("<input>").attr("type", "hidden").attr("name", "user_id").val("<?php echo $user_specific_id; ?>");
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
                'user_id': "<?php echo $user_specific_id; ?>",
                'rows': $("#rows").val()
            };
            $.ajax({
                beforeSend: function () {
                    $('.ajax-loader').css("visibility", "visible");
                },
                type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url: '../../admin_company/reports/selected_users_list', // the url where we want to POST
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
                    var slide_details = "";
                    if (row['slide_details'] != "") {
                        var slide_details_object = $.parseJSON(row['slide_details']);
                        alert(typeof (slide_details_object));
                        var j = 0;

                        $(slide_details_object).each(function (j, slide_obj) {
                            slide_details = slide_details + slide_obj.name + '-' + slide_obj.last_accessed_time + "- " + slide_obj.total_accessed_time + "<br>";
                            j++;

                        });
                    }
                    $(".res_table").append("<div class='res_row'>\n\
<div class='column' data-label='Category name'>" + i + "</div>\n\
\n\<div class='column' data-label='Category name'>" + row['course'] + "</div>\n\
\n\<div class='column' data-label='Category name'>" + row['chapter'].substr(0,15) + "</div>\n\
\n\<div class='column' data-label='Category name'>" + row['lesson_status'] + "</div>\n\
\n\<div class='column' data-label='Category name'>" + row['course_attempt'] + "</div>\n\
\n\<div class='column' data-label='Category name'>" + slide_details + "</div>\n\
</div>");
i++;
                    })
                    pagination(data);
                });
    }</script>


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
                        <?php echo $this->lang->line('nav_user_specific_report'); ?>
                    </a> 
                </li>>
            </ul>				      
        </div>
        <br>
        <div class="col-md-12">
            <div class="widget box">

                <div class="widget-content">
                    <?php
                    $attributes = array('class' => 'form-horizontal row-border', 'id' => 'myform');

                    $options_category = array('name' => 'Chapter Name');

                    echo form_open('admin_company/chapters', $attributes);

                    echo '<div class="form-group">';
                    echo '<label class="col-md-1   control-label">Course</label>';

                    echo '<div class="col-md-2">';
                    $course_data = array(
                        'name' => 'course',
                        'id' => 'course',
                        'class' => 'form-control',
                        'placeholder' => 'Enter Course',
                    );
                    echo form_input($course_data);
                    echo '</div>';

                    echo '<label class="col-md-1   control-label">Chapter</label>';

                    echo '<div class="col-md-2">';
                    $chapter_data = array(
                        'name' => 'chapter',
                        'id' => 'chapter',
                        'class' => 'form-control',
                        'placeholder' => 'Enter Chapter',
                    );
                    echo form_input($chapter_data);
                    echo '</div>';
                    echo '<label class="col-md-1   control-label">Lesson Status</label>';

                    echo '<div class="col-md-2">';
                    $lesson_status_data = array(
                        'name' => 'lesson_status',
                        'id' => 'lesson_status',
                        'class' => 'form-control',
                        'placeholder' => 'Enter Lesson Status',
                    );
                    echo form_input($lesson_status_data);
                     echo '</div>';
                      echo '<div class="col-md-3">';
                    $data_submit = array('type' => 'button', 'name' => 'mysubmit', 'class' => 'btn btn-primary', 'id' => 'search', 'value' => 'Search');
                    echo form_submit($data_submit);
                    echo '</div>';
                    echo form_close();
                    ?>	

                </div> <!-- /.widget-content -->
            </div> <!-- /.widget .box -->
        </div> <!-- /.col-md-12 -->
       	
        <!-- /Statboxes -->
        <!--=== Normal ===-->
        <div class="row">
            <div class="col-md-12">
                <div class="widget box">
                    <div class="widget-header">
                        <h4><?php echo $this->lang->line('lbl_user_specific_report_list').$user_specific_data->email;?></h4>								
                    </div>

                    <div class="res_table">
                        <div class="res_table-head">
                            <div class="column" data-label="Sr no"><?php echo $this->lang->line('lbl_sr_no');?></div>                         
                            <div class="column"><?php echo $this->lang->line('lbl_course');?></div>
                            <div class="column"><?php echo $this->lang->line('lbl_chapter');?></div>
                            <div class="column"><?php echo $this->lang->line('lbl_user_chapter_status');?></div>
                            <div class="column"><?php echo $this->lang->line('lbl_user_chpt_percentage');?></div>
                            <div class="column"><?php echo $this->lang->line('lbl_user_chpt_details');?></div>
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
                  </div></div>     <input type="button" id="csv" class="btn btn-primary" value="<?php echo $this->lang->line('lbl_dwn_report');?>"/>
            </div >    
        </div>
    </div>
</div>