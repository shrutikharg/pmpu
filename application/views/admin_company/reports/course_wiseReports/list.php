<script src="<?php echo base_url(); ?>assets/assets/js/demo/jquery_1.9.1.js"></script> 

<script> var is_search = false, page = 1, search_string_array = "";
    $(document).ready(function () {
        fetch_list(page);
        $("#course_report").click(function () {
            var course_id = $(this).attr('id');
            var form = $(document.createElement('form'));
            $(form).attr("action", "../../admin_company/reports/coursewise_list");
            $(form).attr("method", "POST");

            var input = $("<input>").attr("type", "hidden").attr("name", "course_id").val(course_id);
            $(form).append($("<input>").attr("type", "hidden").attr("name", "is_csv").val(true));
            $(form).submit();
        });
        $("#search").click(function () {
            is_search = true;
            search_string_array = {'course': $("#course").val(), 'sub_department': $("#sub_department").val(), 'department': $("#department").val(), 'course_by': $("#course_by").val(), 'start_date': $("#start_date").val(), 'end_date': $("#end_date").val()};
            search_string_array = JSON.stringify(search_string_array);

            fetch_list(page);
        });


    });
    function view_course_details(course_id) {
        var form = $(document.createElement('form'));
        $(form).attr("action", "../../admin_company/reports/selected_courses");
        $(form).attr("method", "POST");

        var input = $("<input>").attr("type", "hidden").attr("name", "course_id").val(course_id);
        $(form).append($(input));
        $(form).appendTo("body").submit();
        ;
    }
    function fetch_list(page) {
        var formData = {
            'search': is_search,
            'page': page,
            'search_string_array': search_string_array,
            'is_csv': false
        };

        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: '../../admin_company/reports/coursewise_list', // the url where we want to POST
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

                        var course_id = '"' + row['course_id'] + '"';
                        $(".res_table").append("<div class='res_row'>\n\
                <div class='column'  data-label='Sr no'>" + i + "</div>\n\
<div class='column' data-label='Course'>" + row['course'].substr(0, 15) + "</div>\n\
        \n\<div class='column' data-label='Contains chapter'>" + row['chapter_count'] + "</div>\n\
 <div class='column' data-label='action'><input type='button'  name='edit' value='<?php echo $this->lang->line('btn_details') ?>' class='btn btn-info' onclick='view_course_details(" + course_id + ")'></button></div>\n\
</div>");
                        i++;
                    })
                    pagination(data);
                }).fail(function (data) {

        });
    }
</script>
<style type="text/css">
    @media(max-width: 560px) {
        .res_row > .column:last-child {
            padding-left: 20px;
            text-align: center;
        }
        .res_row > .column:nth-of-type(1):before { 
            content: "Sr No."; 
        }
        .res_row > .column:nth-of-type(2):before { 
            content: "Course"; 
        }
        .res_row > .column:nth-of-type(3):before { 
            content: "Chapter Count"; 
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
                    <a href="<?php echo site_url("admin_company") . '/reports/' . $this->uri->segment(3); ?>">
                        <?php echo $this->lang->line('nav_course_report'); ?>
                    </a> 

                </li>>

            </ul>				      
        </div>
        <br>
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
                        echo '<label class="col-md-1   control-label">' . $this->lang->line('lbl_course') . '</label>';

                        echo '<div class="col-md-3">';
                        $course_data = array(
                            'name' => 'course',
                            'id' => 'course',
                            'class' => 'form-control',
                            'placeholder' => $this->lang->line('lbl_course')
                        );
                        echo form_input($course_data);
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


            <?php
            if (isset($flash_message)) {
                if ($flash_message == TRUE) {
                    echo '<div class="alert alert-success">';
                    echo '<a class="close" data-dismiss="alert">�</a>';
                    echo '<strong>Well done!</strong>Your chapter Deleted with success.';
                    echo '</div>';
                } else {
                    echo '<div class="alert alert-danger">';
                    echo '<a class="close" data-dismiss="alert">�</a>';
                    echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
                    echo '</div>';
                }
            }
            ?>  
            <p>&nbsp;</p>
            <div class="widget box">
                <div class="widget-header">
                    <h4><?php echo $this->lang->line('lbl_course_report_list'); ?></h4>								

                </div>

                <div class="res_table">
                    <div class="res_table-head">
                        <div class="column" data-label="Sr no"> <?php echo $this->lang->line('lbl_sr_no'); ?></div>
                        <div class="column"><?php echo $this->lang->line('lbl_course'); ?></div>                   
                        <div class="column"><?php echo $this->lang->line('lbl_chpater_count'); ?></div>
                      
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
            <input type="button"  class="btn btn-primary"id="course_report" value="<?php echo $this->lang->line('btn_dwn_course_report'); ?>"/>
        </div >  
       

       	<script type="text/javascript">
            $('tbody').sortable();
        </script>





    </div>

</div>

</div>
		