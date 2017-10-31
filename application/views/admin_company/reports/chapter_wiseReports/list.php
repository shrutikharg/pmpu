<script src="<?php echo base_url(); ?>assets/assets/js/demo/jquery_1.9.1.js"></script> 
<script src="<?php echo base_url(); ?>assets/assets/js/demo/jquery_ui_1.9.1.js"></script> 
<script>
    var is_search = false, page = 1, search_string_array = "";
    $(document).ready(function () {
        fetch_list(page);
        $("#chapter_report").click(function () {
            var chapter_id = $(this).attr('id');
            var form = $(document.createElement('form'));
            $(form).attr("action", "../../admin_company/reports/chapterwise_list");
            $(form).attr("method", "POST");
            $(form).append($("<input>").attr("type", "hidden").attr("name", "is_csv").val("true"));
            $(form).submit();
        });


    });
    function view_chapter_details(chapter_id) {

        var form = $(document.createElement('form'));
        $(form).attr("action", "../../admin_company/reports/selected_chapter");
        $(form).attr("method", "POST");

        var input = $("<input>").attr("type", "hidden").attr("name", "chapter_id").val(chapter_id);
        $(form).append($(input));
        $(form).appendTo("body").submit();

    }
    function fetch_list(page) {
        var formData = {
            'search': is_search,
            'page': page,
            'search_string_array': search_string_array
        };
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: '../../admin_company/reports/chapterwise_list', // the url where we want to POST
            data: formData, // our data object
            dataType: 'json', // what type of data do we expect back from the server
            encode: true
        })
                // using the done promise callback
                .done(function (data) {
                    $('.res_row').empty();
                    var i = 0;
                    $.each(data.rows, function (i, row) {
                        i++;
                        var chapter_id = '"' + row['chapter_id'] + '"';
                        $(".res_table").append("<div class='res_row'>\n\
                <div class='column'  data-label='Sr no'>" + i + "</div>\n\
<div class='column' data-label='Chapter'>" + row['chapter'] + "</div>\n\
<div class='column' data-label='Course'>" + row['course'] + "</div>\n\
\n\<div class='column' data-label='Course'>" + row['lesson_status'] + "</div>\n\
<div class='column' data-label='action'><input type='button'  name='details' value='View Details' class='btn btn-info' onclick='view_chapter_details(" + chapter_id + ")'></button></div>\n\
</div>");

                    })
                    //pagination(data);
                });
    }</script>


<div id="content">
    <div class="container">
        <div class="row">
            <br/>
            <div class="row">
                <div class="col-md-12">
                    <div class="widget box">

                        <div class="widget-content">
                            <?php
                            $attributes = array('class' => 'form-horizontal row-border', 'id' => 'myform');

                            echo form_open('admin_company/chapters', $attributes);

                            echo '<div class="form-group">';
                            echo '<label class="col-md-1   control-label">' . $this->lang->line('lbl_chapter') . '</label>';
                            echo '<div class="col-md-3">';
                            $chapter_input = array(
                                'name' => 'chapter',
                                'id' => 'chapter',
                                'class' => 'form-control',
                                'placeholder' => $this->lang->line('lbl_chapter'),
                            );
                            echo form_input($chapter_input);
                            echo '</div>';

                            echo '<label class="col-md-1   control-label">' . $this->lang->line('lbl_course') . '</label>';
                            echo '<div class="col-md-3">';
                            $course_input = array(
                                'name' => 'course',
                                'id' => 'course',
                                'class' => 'form-control',
                                'placeholder' => $this->lang->line('lbl_course'),
                            );
                            echo form_input($course_input);
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
        </div> <!-- /.row -->		
        <!-- /Statboxes -->
        <!--=== Normal ===-->
        <div class="row">

            <div class="widget box">
                <div class="widget-header">
                    <h4>View All Chapters</h4>								
                </div>

                <div class="res_table">
                    <div class="res_table-head">
                        <div class="column" data-label="Sr no"> Sr no</div>
                        <div class="column">Chapter</div>
                        <div class="column">Course</div>                       
                        <div class="column">Status Count</div>
                        <div class="column">Action</div>
                    </div>     

                    <?php
//var_dump($chapters);
                    /* foreach ($chapterwise->result_array() as $row) {
                      $i++;
                      echo '<div class="res_row">'; {

                      echo '<div class="column" data-label="Sr no">' . $i . '</div>';
                      echo '<div class="column" data-label="Course name">' . $row['Chapter_Id'] . '</div>';
                      echo '<div class="column" data-label="Course price">' . $row['Chapter_Name'] . '</div>';
                      echo '<div class="column" data-label="Course price">' . $row['Course_id'] . '</div>';
                      echo '<div class="column" data-label="Course price">' . $row['Course'] . '</div>';
                      echo '<div class="column" data-label="Course price">' . $row['Description'] . '</div>';
                      echo '<div class="column" data-label="Course price">' . $row['Start_date'] . '</div>';
                      echo '<div class="column" data-label="Course price">' . $row['End_Date'] . '</div>';
                      echo '<div class="column" data-label="Course price">' . $row['Contains_slides'] . '</div>';
                      echo '<div class="column" data-label="Course price">' . $row['Status_count'] . '</div>';
                      echo '<div class="column' . $clstr . '" data-label="action">
                      <input type=button  name="details" value="View Details" id="' . $row['id'] . '">
                      </div>';
                      echo '</div>';
                      }
                      } */
                    ?>   
                </div> </div>     
        </div >    <input type="button" id="chapter_report" value="Get Chapter Report"/>

       	<script type="text/javascript">
            $('tbody').sortable();
        </script>



        <?php echo '<div class="pagination">' . $this->pagination->create_links() . '</div>'; ?>

    </div>

</div>

</div>
</div>
<!-- /Normal -->
</div>
</div>		