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
            alert();

            var form = $(document.createElement('form'));
            $(form).attr("action", "../../admin_company/reports/selected_chapter_list");
            $(form).attr("method", "POST");
            $(form).attr("id", "form1");
            var input = $("<input>").attr("type", "hidden").attr("name", "chapter_id").val("<?php echo $chapter_specific_id; ?>");
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
            'chapter_id': "<?php echo $chapter_specific_id; ?>"
        };

        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: '../../admin_company/reports/selected_chapter_list', // the url where we want to POST
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
                    var i = 0;
                    $.each(data.rows, function (i, row) {
                        i++;

                        $(".res_table").append("<div class='res_row'>\n\
                <div class='column' s data-label='Sr no'>" + i + "</div>\n\
<div class='column' data-label='Category name'>" + row['user'] + "</div>\n\
\n\<div class='column' data-label='Category name'>" + row['percentage'] + "</div>\n\
\n\<div class='column' data-label='Category name'>" + row['attempt_status'] + "</div>\n\
\n\<div class='column' data-label='Category name'>" + row['completed_date'] + "</div>\n\
</div>");

                    })
                    // pagination(data);
                });
    }
</script>
<style type="text/css">
    @media(max-width: 560px) {
        .res_row > .column:nth-of-type(1):before { 
            content: "Sr No."; 
        }
        .res_row > .column:nth-of-type(2):before { 
            content: "User"; 
        }
        .res_row > .column:nth-of-type(3):before { 
            content: "Percentage"; 
        }
        .res_row > .column:nth-of-type(4):before { 
            content: "Status"; 
        }
        .res_row > .column:nth-of-type(5):before { 
            content: "Completed dt"; 
        }
    }
</style>
<div id="content">
    <div class="container">
        <div class="row">
            <br/>
                <div class="col-md-12">
                    <div class="widget box">
                        <div class="widget-header">
                            <h2>Chapters List</h2>
                        </div>
                        <div class="widget-content">
                            <?php
                            $attributes = array('class' => 'form-horizontal row-border', 'id' => 'myform');

                            $options_category = array('name' => 'Chapter Name');

                            echo form_open('admin_company/chapters', $attributes);

                            echo '<div class="form-group">';
                            echo '<label class="col-md-1   control-label">Course</label>';

                            echo '<div class="col-md-3">';
                            $course_data = array(
                                'name' => 'course',
                                'id' => 'course',
                                'class' => 'form-control',
                                'placeholder' => 'Enter Course',
                            );
                            echo form_input($course_data);
                            echo '</div>';
                            echo '<label class="col-md-1   control-label">User</label>';

                            echo '<div class="col-md-3">';
                            $user_name_data = array(
                                'name' => 'email',
                                'id' => 'email',
                                'class' => 'form-control',
                                'placeholder' => 'Enter User Name',
                            );
                            echo form_input($user_name_data);
                            echo '</div>';
                            echo '<label class="col-md-1   control-label">Chapter</label>';

                            echo '<div class="col-md-3">';
                            $chapter_data = array(
                                'name' => 'chapter',
                                'id' => 'chapter',
                                'class' => 'form-control',
                                'placeholder' => 'Enter Chapter',
                            );
                            echo form_input($chapter_data);
                            echo '</div>';
                            echo '<label class="col-md-1   control-label">Lesson Status</label>';

                            echo '<div class="col-md-3">';
                            $lesson_status_data = array(
                                'name' => 'lesson_status',
                                'id' => 'lesson_status',
                                'class' => 'form-control',
                                'placeholder' => 'Enter Lesson Status',
                            );
                            echo form_input($lesson_status_data);
                            $data_submit = array('type' => 'button', 'name' => 'mysubmit', 'class' => 'btn btn-primary', 'id' => 'search', 'value' => 'Search');
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
        <div class="col-md-12">
            <div class="col-md-12">												
                <?php
                //echo ($sessionuserdata[0]['space_filled']);
                if ($sessionuserdata[0]['available_disk_space'] !== 0) {
                    ?>	  
                    <a  href="<?php echo site_url("admin_company") . '/' . $this->uri->segment(2); ?>/add" class="btn btn-primary">Add a new</a> <?php
                }
                ?> 


                <!-- /Page Stats -->
            </div>
            <br/><br/><br/>

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
                    <h4><i class="icon-reorder"></i>View All Chapters</h4>					
                </div>
                <div class="widget-content">
                    <div class="res_table">
                        <div class="res_table-head">
                            <div class="column" data-label="Sr no"> Sr no</div>
                            <div class="column" data-label="User"> User</div>
                            <div class="column" data-label="Percentage">Percentage</div>
                            <div class="column" data-label="Status">Status</div>
                            <div class="column" data-label="Completed Date">Completed Date</div>
                        </div>     
                    </div>
                </div> 
            </div>     
            <input type="button" id="csv" class="btn btn-primary fa fa-openid" value="get report"/>
        </div >    
        <?php echo '<div class="pagination">' . $this->pagination->create_links() . '</div>'; ?>
    </div>
</div>
</div>
</div>
<!-- /Normal -->
</div>
</div>		