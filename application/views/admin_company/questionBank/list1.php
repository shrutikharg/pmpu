
<script src="<?php echo base_url(); ?>assets/assets/js/demo/jquery_ui_1.9.1.js"></script> 
<script src="<?php echo base_url(); ?>assets/assets/js/category_dependent.js"></script> 
<link href="<?php echo base_url(); ?>assets/themes/popupwindow.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/themes/preview_demo.css" rel="stylesheet" type="text/css" />

<script>
    var is_search = false, page = 1, search_string_array = "";
    var questionbank_id;
    $(document).ready(function () {
        $('#question_list').on('shown.bs.modal', function (e) {
            questionbank_id = $(e.relatedTarget).data('questionbank_id');

            chapter_id = $(e.relatedTarget).data('chapter_id');
            $.ajax({
                type: 'POST',
                url: 'question_bank/chapterquestion_list',
                data: {'chapter_id': chapter_id, 'question_bank_id': questionbank_id},
                dataType: 'json',
                encode: true
            })

                    .done(function (data) {
                        $("#question_list").find('div.question_body>div').detach();
                        $.each(data.rows, function () {

                            $("#question_list").find(".question_body").append("<div class='form-group question_container'>\n\
                   <br/>\n\
<div class='col-md-12'> \n\
<input type='checkbox' name='' value=" + this['id'] + " class='col-md-1' " + this['question_added_status'] + ">\n\
<label class='col-md-8 control-label control_lbl'>\n\
" + this.name + "</label>\n\
 </div> </div>");
                        });

                    });

        });
        $('#primary').on('shown.bs.modal', function (e) {

            questionbank_id = $(e.relatedTarget).data('questionbank_id');
            $('#questionbank_id').val(questionbank_id);

            $("#chapter_id").val($(e.relatedTarget).data('chapter_id'));


        });
        fetch_list(page);

        var a = '<?php echo "../assets/assets/js/question_type_dependent_js/mcq_scq_question_type_js.js"; ?>';
        jQuery.getScript(a);
        a = '<?php echo "../assets/assets/js/category_dependent.js"; ?>';
        jQuery.getScript(a);
        $("#save_question_bank").click(function () {

            var datastring = {'name': $("#question_bank_name").val(), "chapter_id": $("#chapter").val()};
            fetch_list(page);
            $.ajax({
                type: "POST",
                url: "../admin_company/question_bank/add",
                data: datastring,
                dataType: 'text',
                success: function (data) {
                    if (data === 'Success') {
                    
                    } else if (data === "Fail") {

                    }
                },
                error: function () {
                    alert('error handing here');
                    alert('technical error please contact to system admin');
                }
            });

        });

    });
    function fetch_list(page) {
        var formData = {
            'search': is_search,
            'page': page,
            'search_string_array': search_string_array
        };

        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: '../admin_company/question_bank/list', // the url where we want to POST
            data: formData, // our data object
            dataType: 'json', // what type of data do we expect back from the server
            encode: true
        })
                // using the done promise callback
                .done(function (data) {
                    $('#sequence_table > tbody').empty();
                    var i = 0;
                    $.each(data.rows, function (i, row) {
                        i++;
                        var questionbank_id = "'" + row['id'] + "'";
                        var chapter_id = "'" + row['chapter_id'] + "'";
                        $("#sequence_table > tbody").append("<tr><td>" + (i) + "</td>\n\
                         <td>" + row['name'] + "</td>\n\
  <td>" + row['chapter'] + "</td>\n\
                         <td><a href =''><img src='../assets/assets/img/Add question_1.png' href='#primary' data-toggle='modal'  data-questionbank_id=" + questionbank_id + " data-chapter_id=" + chapter_id + "/></a>\n\
                          &nbsp;\n\
                                    <a href=''><img src='../assets/assets/img/Add List_1.png'   href='#question_list' data-toggle='modal'data-questionbank_id=" + questionbank_id + " data-chapter_id=" + chapter_id + "/></a>	\n\
                                    &nbsp;</td></tr>");




                    })
                    pagination(data);
                });
    }

    function questionbank_chapter_list()
    {
        var questionbank_chapter_list_array = [];
        $("#question_list").find("div.question_body>div").each(function () {
            $(this).find("input:checked").val();
            if ($(this).find("input:checked").val() !== undefined) {
                questionbank_chapter_list_array.push($(this).find("input:checked").val());
            }

        });

        $.ajax({
            type: 'POST',
            url: 'question_bank/update_question_list',
            data: {'question_bank_id': questionbank_id, 'chapter_list': questionbank_chapter_list_array},
            dataType: 'text',
        })
                .done(function (data) {

                });
    }
</script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/pagination.js"></script>
<div id="content">
    <div class="container">

        <br/>
        <div class="row">
            <div class="col-md-12">
                <div class="widget box">
                    <div class="widget-header">
                        <h2>Question Bank List</h2>
                    </div>
                    <div class="widget-content">
                        <?php
                        $attributes = array('class' => 'form-horizontal row-border', 'id' => 'myform');

                        $options_category = array('course_name' => 'Course Name');

                        echo form_open('admin_company/courses', $attributes);

                        echo '<div class="form-group">';
                        echo '<label class="col-md-1   control-label">Search:</label>';

                        echo '<div class="col-md-3">';
                        $data_search = array(
                            'name' => 'search_string',
                            'id' => 'search_string',
                            'class' => 'form-control',
                            'placeholder' => 'Enter Course name',
                        );
                        echo form_input($data_search, $search_string_selected);
                        echo '</div>';

                        echo '<label class="col-md-2   control-label">Order by:</label>';
//echo form_input('search_string', $search_string_selected);
                        echo '<div class="col-md-2" id="col-md-dp">';
                        echo form_dropdown('order', $options_category, $order, 'class="form-control"');
                        echo '</div>';

                        $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Go');

                        echo '<div class="col-md-1" id="col-md-dp">';
                        $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
                        echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="form-control"');
                        echo '</div>';
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
            <?php
//echo ($sessionuserdata[0]['space_filled']);
            $planid_currentuser = $this->session->userdata['userplan_id'];

//if($planid_currentuser!=='1')
            {

                if ($sessionuserdata[0]['available_disk_space'] !== 0) {
                    ?>	  
                    <a  href="" ><img src="../assets/assets/img/Add Quesion Bank_1.png" width="180px" href="#add_question_popup" data-toggle="modal"></a> <?php
                }
            }
            ?> 
            <?php
            //flash messages
            if ($this->session->flashdata('flash_message')) {
                if ($this->session->flashdata('flash_message') == 'Activate') {
                    echo '<div class="alert alert-success">';
                    echo '<a class="close" data-dismiss="alert">�</a>';
                    echo '<strong>Well done!!</strong> Courses Activate with success now its not to assign anyone.';
                    echo '</div>';
                } elseif ($this->session->flashdata('flash_message') == 'Retired') {
                    echo '<div class="alert alert-success">';
                    echo '<a class="close" data-dismiss="alert">�</a>';
                    echo '<strong>Well done!!</strong> Courses Retired with success now its not to assign anyone.';
                    echo '</div>';
                } else {
                    echo '<div class="alert alert-danger">';
                    echo '<a class="close" data-dismiss="alert">�</a>';
                    echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
                    echo '</div>';
                }
            }
            ?>  

            <!-- /Page Stats -->
        </div>
        <br/><br/>

        <p>&nbsp;</p>
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i>View All Question Banks</h4>								
            </div>
            <div class="widget-content">


            </div >
            <div class="container text-center">

                <table id="sequence_table" class="table table-bordered pagin-table">
                    <thead>
                        <tr class="row_header">
                            <th class="text-center" width="50px">No</th>
                            <th class="text-center">Question Bank name</th>
                            <th class="text-center">Chapter</th>
                            <th class="text-center" width="400px">Action</th>
                        </tr>
                    </thead>
                    <tbody>


                    </tbody>
                </table>




            </div>
        </div>

        <!-- /Normal -->
    </div>
</div>		


<!-- Modal -->
<div class="modal fade" id="primary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="add_question_form">	
                <div class="question_popup_container">

                    <div class="question_header">	

                        <h3>Question list</h3>	

                    </div>
                    <div class="question_body">
                        <div style="padding: 10px;margin-bottom:20px;">
                            <div class="form-group">

                                <label class="col-md-3 control-label control_lbl">Question</label>
                                <div class="col-md-7"><input type="text" class="form-control txt_input" id="question" name="name"  data-rule-required="true" >

                                </div>
                            </div>	
                            <br/>        <br/>
                            <div class="form-group">		                                     <label class="col-md-3 control-label control_lbl">Qusetion Type</label>
                                <div class="col-md-7"><select id="question_type"  class="form-control">
                                        <option value="mcq">Multiple choice question</option>
                                        <option value="scq">Single choice question</option>
                                        <option value="fill_blanks">fill in blanks</option>
                                        <option value="match_pair">match the pair</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <input type="text" style="display:none;" id="chapter_id"  />
                            <input type="text" style="display:none;" id="questionbank_id"  />
                            <div class="form-group" id="question_option_group">
                                <br>   
                                <label style=" visibility: hidden;" class="col-md-3 control-label"></label>
                                <div class="col-md-7 checkbox" id="question_option_div" ></div>
                            </div>                             
                            <div class="form-group">					

                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-8">
                                    <img id="add_option" src="../assets/assets/img/Add_1.png"  />
                                    <img id="remove_option" src="../assets/assets/img/Remove_1.png"  />
                                </div>
                            </div>



                        </div>	

                        <div class="question_bottom">

                            <label class="col-md-3"><img id="question_save_img"src="../assets/assets/img/Save_1.png"  /></label>
                            <div class="col-md-4" style="float: right !important;">

                                <img src="../assets/assets/img/Remove_1.png"  />
                            </div>

                        </div>		
                    </div>

                </div><!-- /.modal-content --></form>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
<div class="modal fade" id="question_list" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"> 
            <div class="question_popup_container">

                <div class="question_header">	

                    <h3>Add Question to Question Bank from question list</h3>	

<!-- <input type="button" id="change_sequence_button" value="change sequence"> -->
                </div>
                <form id="quesation_list_form">    <div class="question_body">
                        <br/>


                    </div>	
                    <br/>
                    <br/>
                    <div class="question_bottom">


                        <label class="col-md-3"><img src="../assets/assets/img/Save_1.png" onclick="questionbank_chapter_list()" /></label>
                        <div class="col-md-4" style="float: right !important;">

                            <img src="../assets/assets/img/Reset.png"  />
                        </div>


                    </div>	</form>							
                <script type="text/javascript">
                    $('tbody').sortable();
                </script>

            </div>
        </div></div></div>
<div class="modal fade" id="add_question_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content"> 
            <div class="question_popup_container">
                <div class="question_header">
                    <h3>Add Question Bank</h3>
                </div>
                <div class="question_body">
                    <br/>
                    <div class="form-group">
                        <label class="col-md-3 control-label control_lbl">Question Name</label>
                        <div class="col-md-7"><input type="text" class="form-control txt_input" id="question_bank_name" name="question_bank_name"  data-rule-required="true" >
                        </div>
                    </div>	
                    <br/><br/>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Department</label>
                        <div class="col-md-10"><select class="form-control" id="department" name="department" >
                                <option value="">Select</option>
                            </select>
                        </div>
                    </div>	
                    <div class="form-group">
                        <label class="col-md-2 control-label">Sub department</label>
                        <div class="col-md-10">
                            <select class="form-control" id="sub_department" name="sub_department" >
                                <option value="">Select</option>
                            </select>
                        </div>
                    </div>	
                    <div class="form-group">
                        <label class="col-md-2 control-label">Course</label>
                        <div class="col-md-10"> <div class="col-md-10">
                                <select class="form-control" id="course" name="course" >
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Chapter</label>
                        <div class="col-md-10"> <div class="col-md-10">
                                <select class="form-control" id="chapter" name="chapter" >
                                    <option value="">Select</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <br/>	

                </div>	
                <div class="modal-footer">

                    <label class="col-md-3"><img src="../assets/assets/img/Save_1.png" id="save_question_bank"  /></input></label>
                    <div class="col-md-4" style="float: right !important;">
                        <img src="../assets/assets/img/Remove_1.png"  />
                    </div>
                </div>								
            </div>
        </div></div></div>