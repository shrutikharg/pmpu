<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/demo/jquery_1.9.1.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/category_dependent.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/themes/popupwindow.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/themes/demo.js"></script>
<link href="<?php echo base_url(); ?>assets/assets/css/quiztabs.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/themes/popupwindow.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/themes/preview_demo.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    $(document).ready(function ($) {
        var a = '<?php echo "../assets/assets/js/category_dependent.js"; ?>';
        jQuery.getScript(a);
        $("[name='quiz_based_on']").change(function () {
            if (this.value === 'course_based') {
                $("#chapter").hide();
            } else if (this.value === 'chapter_based') {
                $("#chapter").show();
            }
        });
        $('#tab_ppt_pdf').on('click', ':checkbox', function () {
            if ($(this).is(':checked')) {
                var selected_checkbox_id = $(this).attr('id');
                formData = {'questionbank_id': selected_checkbox_id};
                $.ajax({
                    type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                    url: '../admin_company/question_bank/question_list', // the url where we want to POST
                    data: formData, // our data object
                    dataType: 'json', // what type of data do we expect back from the server
                    encode: true
                })
// using the done promise callback
                        .done(function (data) {
                            $('#questionbank_specific_question').empty();
                            var i = 0;
                            $.each(data.rows, function (i, row) {
                                var question_id = '"' + row['id'] + '"';
                                $("#questionbank_specific_question").append("<div class='form-group question_container'>\n\
                <br/>\n\
                <div class='col-md-12'> \n\
                        <input type='checkbox' name='' value=" + this['id'] + " class='col-md-1' >\n\
                                <label class='col-md-8 control-label control_lbl'>" + this['name'] + "</label></div></div>");

                                i++;
                            })

                        });
                $("#questionbank_specific_question").dialog({
                    close: function () {
                        quiz_question_list($('[name="question_bank"]:checked').last().prop('id'));
                        $('[name="question_bank"]:checked').last().prop('checked', false);
                    }
                });
            } else {
                $("questionbank_specific_question").dialog('close');
            }
        });
    });
    function get_question_from_question_bank() {
        var quiz_based_value = [];
        var quiz_based_on = $('input[name=quiz_based_on]:radio:checked').val();
        if (quiz_based_on === 'course_based') {
            quiz_based_value.push($('#course').val());
        } else if (quiz_based_on === 'chapter_based') {
            $("#chapter option:selected").each(function () {
                quiz_based_value.push($(this).val());
            });
        }

        var formData = {'quiz_based_on': quiz_based_on, 'quiz_based_value': quiz_based_value};
        $.ajax({
            type: 'POST',
            url: '../admin_company/quiz/get_question_from_questionbank',
            data: formData,
            dataType: 'json',
            encode: true
        })

                .done(function (data) {
                    $('.res_row').empty();
                    var i = 0;
                    $.each(data.rows, function (i, row) {
                        var questionbank_id = '"' + row['id'] + '"';
                        $("#tab_ppt_pdf").append("<div class='form-group question_container'>\n\
                        <br/>\n\
                        <div class='col-md-12'> \n\
                                <input  type='checkbox' value=" + this.name + " name='question_bank'   id=" + this.id + ">\n\
                                        <label class=' control-label control_lbl'>\n\
         " + this.name + "</label>\n\
                                </div>\n\
                    < /div>");
                        i++;
                    })
                    $("#tab_ppt_pdf").append("<div  id='questionbank_specific_question' style='display: none;height:100px;width:500px;border: 3px solid #73AD21;top:80px'>Age is something</div>");
                });
    }
    function quiz_question_list(questionbank_id)
    {
        var quiz_question_list_array = [];
        $("#questionbank_specific_question>div").each(function () {
            if ($(this).find("input:checked").val() !== undefined) {
                quiz_question_list_array.push($(this).find("input:checked").val());
            }
        });
        $.ajax({
            type: 'POST',
            url: 'quiz/update_question_list',
            data: {'question_bank_id': questionbank_id, 'question_list': quiz_question_list_array},
            dataType: 'text',
        })
                .done(function (data) {
                    alert(data);
                });
    }
</script>

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
                        echo '<label class="col-md-1 control-label">Search:</label>';
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
                    </div>
                    <!-- /.widget-content -->
                </div>
                <!-- /.widget .box -->
            </div>
            <!-- /.col-md-12 -->
        </div>
        <!-- /.row -->	          
        <!-- /.row -->		
        <!-- /Statboxes-->
        <!--=== Normal ===-->
        <div class="row">
            <div class="col-md-12">												
                <?php
//echo ($sessionuserdata[0]['space_filled']);
                $planid_currentuser = $this->session->userdata['userplan_id'];
//if($planid_currentuser!=='1')
                {
                    if ($sessionuserdata[0]['space_filled'] == 'N') {
                        ?>	  
                        <a  href="<?php echo site_url("admin_company") . '/' . $this->uri->segment(2); ?>/add" ><img src="../assets/assets/img/Add Quesion Bank_1.png" width="180px" id="open-pop-up-3">
                        </a>
                        <?php
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
                <ul class="page-stats">
                    <li>
                        <div class="summary">
                            <span>Total Disk SPace</span>
                            <h3 class="numbers">
                                <?php echo $totaldiskspace; ?>
                            </h3>
                        </div>
                        <!-- Use instead of sparkline e.g. this:
                        <div class="graph circular-chart" data-percent="73">73%</div>
                        -->
                    </li>
                    <li>
                        <div class="summary">
                            <span>Available Disk Space</span>
                            <h3 class="numbers">
                                <?php echo $remainspace; ?>
                            </h3>
                        </div>
                    </li>
                </ul>
                <!-- /Page Stats -->
            </div>
            <br/>        
            <p>&nbsp;</p>                 
            <div class="col-md-12">
                <div class="widget box2">                    
                    <div class="text-center quiz_tab">
                        <div class="tabbable tabbable-custom tabbable-full-width">
                            <ul class="nav nav-tabs">
                                <li role="presentation" class="active">
                                    <a href="#tab_elearning" data-toggle="tab">General</a>
                                </li>                             
                                <li role="presentation" class="disabled">
                                    <a href="#quiz_type" data-toggle="tab">Type</a>
                                </li>
                                <li role="presentation" class="disabled">
                                    <a href="#tab_ppt_pdf" data-toggle="tab">Question</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" role="tabpanel" id="step1">
                                    <form action="" method="post" accept-charset="utf-8" class="form-horizontal" id="" enctype="multipart/form-data">	
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Name of the quiz</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" id="" name="name"   data-rule-required="true"  data-msg-required="Please enter course name." />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label"> Description </label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" id="" name="name"   data-rule-required="true"  data-msg-required="Please enter course name." />
                                            </div>
                                        </div>		
                                        <div class="form-group">
                                            <label class="col-md-2 control-label"> Time allowed </label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" id="" name="name"   data-rule-required="true"  data-msg-required="Please enter course name." />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label"> Alarm </label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" id="" name="name"   data-rule-required="true"  data-msg-required="Please enter course name." />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label"> Start Date </label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" id="" name="name"   data-rule-required="true"  data-msg-required="Please enter course name." />
                                            </div>
                                        </div>	
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">End Date</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" id="" name="name"  data-rule-required="true"  data-msg-required="Please enter course name." />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Number of attempts</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" id="" name="name"   data-rule-required="true"  data-msg-required="Please enter course name." />
                                            </div>
                                        </div>  
                                        <ul class="list-inline pull-right">  
                                            <li><button type="button" class="btn btn-primary btn-info-full next-step">Save and continue</button></li>
                                        </ul>
                                    </form>
                                </div>
                                <!-- /.col-md-12 -->
                                <!--=== Overview ===-->                               
                                <div class="tab-pane" role="tabpanel" id="step2">
                                    <form action="" method="post" accept-charset="utf-8" class="form-horizontal" id="" enctype="multipart/form-data">	
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Quiz is based on</label>
                                            <div class="col-md-10">
                                                <input type="radio" name="quiz_based_on"  value="course_based"> Course
                                                <input type="radio" name="quiz_based_on"   value="chapter_based"> Chapter<br>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Department</label>
                                            <div class="col-md-10">
                                                <select class="form-control" id="department" name="department" >
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
                                            <div class="col-md-10">

                                                <select class="form-control" id="course" name="course" >
                                                    <option value="">Select</option>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Chapter</label>
                                            <div class="col-md-10">                                               
                                                <select class="form-control" id="chapter" name="chapter" multiple>
                                                    <option value="">Select</option>
                                                </select>                                            
                                            </div>
                                        </div>
                                        <ul class="list-inline pull-right">
                                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>                                   
                                            <li><button type="button" class="btn btn-primary btn-info-full next-step">Save and continue</button></li>
                                        </ul>
                                    </form>
                                </div> 
                                <div class="tab-pane" role="tabpanel" id="step3" onclick="get_question_from_question_bank();">

                                    <div class="col-md-2">
                                        <section class="gradient">
                                            <button id="add_from_question_bank" >Add<br/> Question Bank</button>
                                        </section>		
                                    </div>
                                    <div class="col-md-2">
                                        <section class="gradient">
                                            <button id="quiz_add_question">Add <br/>Question</button>
                                        </section>
                                    </div>
                                    <!-- Data--->
                                    <div class="row" id="questionbanklist_popup" ><!--tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  aria-hidden="true"-->
                                        <div class="modal-dialog">
                                            <div class="modal-content"> 
                                                <div class="panel panel-primary pull-right" style="min-width:320px">
                                                    <div class="panel-heading">
                                                        Question Bank List                    
                                                    </div>
                                                    <div class="panel-body">
                                                        <ul class="panel-group" id="accordion">
                                                            <li class="list-group-item panel panel-default">
                                                                <div class="panel-heading" style="padding:0px;cursor:pointer;"  data-toggle="collapse" data-target="#collapseOne" data-parent="#accordion">
                                                                    <h4 class="panel-title">
                                                                        <a href="#collapseOne" style="width:100%">
                                                                            <input type="checkbox" id="checkbox4" />
                                                                            <label for="checkbox4" style="width:90%; line-height: 35px;cursor:pointer">
                                                                                Question Bank 1
                                                                            </label>
                                                                        </a>
                                                                    </h4>
                                                                </div>
                                                                <div id="collapseOne" class="panel-collapse collapse in">
                                                                    <div class="panel-body">
                                                                        <div class="panel panel-primary" style="min-width:310px">                                                                   
                                                                            <div class="panel-body">
                                                                                <ul class="list-group">
                                                                                    <li class="list-group-item ">
                                                                                        <div class="checkbox">
                                                                                            <input type="checkbox" id="checkbox1" />
                                                                                            <label for="checkbox1" >
                                                                                                List group item heading
                                                                                            </label>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li class="list-group-item ">
                                                                                        <div class="checkbox">
                                                                                            <input type="checkbox" id="checkbox02" />
                                                                                            <label for="checkbox02" >
                                                                                                List group item heading 1
                                                                                            </label>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li class="list-group-item">
                                                                                        <div class="checkbox">
                                                                                            <input type="checkbox" id="checkbox03" />
                                                                                            <label for="checkbox03">
                                                                                                List group item heading 2
                                                                                            </label>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li style="list-style: none"> <span class="btn btn-sm btn-success" style="margin:5px 0px">Add</span></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                        <!-- Data-->
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="list-group-item panel panel-default">
                                                                <div class=" panel-heading" style="padding: 0px;cursor:pointer;" data-toggle="collapse" data-target="#collapseTwo" data-parent="#accordion" >
                                                                    <h4 class="panel-title">
                                                                        <a href="#collapseTwo" style="width:100%">
                                                                            <input type="checkbox" id="checkbox5" />
                                                                            <label for="checkbox5" style="width:90%;line-height: 35px;cursor:pointer">
                                                                                Question Bank 2
                                                                            </label>
                                                                        </a>
                                                                    </h4>
                                                                </div>
                                                                <div id="collapseTwo" class="panel-collapse collapse">
                                                                    <div class="panel-body">
                                                                        <div class="panel panel-primary" style="min-width:310px">                                                                   
                                                                            <div class="panel-body">
                                                                                <ul class="list-group">
                                                                                    <li class="list-group-item">
                                                                                        <div class="checkbox">
                                                                                            <input type="checkbox" id="checkbox" />
                                                                                            <label for="checkbox">
                                                                                                List group item heading
                                                                                            </label>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li class="list-group-item">
                                                                                        <div class="checkbox">
                                                                                            <input type="checkbox" id="checkbox2" />
                                                                                            <label for="checkbox2">
                                                                                                List group item heading 1
                                                                                            </label>
                                                                                        </div>
                                                                                    </li>                                                                            
                                                                                    <li class="list-group-item">
                                                                                        <div class="checkbox">
                                                                                            <input type="checkbox" id="checkbox3" />
                                                                                            <label for="checkbox3">
                                                                                                List group item heading 2
                                                                                            </label>
                                                                                        </div>
                                                                                    </li>                                                                            
                                                                                    <li style="list-style: none"> <span class="btn btn-sm btn-success" style="margin:5px 0px">Add</span></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                        <!-- Data-->
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="list-inline pull-right">
                                                <li><button type="button" class="btn btn-default prev-step">Previous</button></li>                                      
                                                <li><button type="button" class="btn btn-primary btn-info-full next-step">Save</button></li>
                                            </ul>
                                            <!-- Data-->                                        
                                        </div>
                                        <!-- /.col-md-12 -->
                                    </div>	
                                        <!-- /Edit Account -->
                                    </div>
                                    <!-- /.tab-content -->
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Normal -->
            </div>
        </div>
    </div>
</div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        //Initialize tooltips
        $('.nav-tabs > li a[title]').tooltip();
        //Wizard
        $('a[data-toggle="tab"]').on('tab', function (e) {
            var $target = $(e.target);
            if ($target.parent().hasClass('disabled')) {
                return false;
            }
        });
        $(".next-step").click(function (e) {
            var $active = $('.nav-tabs li.active');
            var $active1 = $('.tab-content .tab-pane.active');
            $active1.next().addClass('active');
            $active1.removeClass('active');
            $active.next().removeClass('disabled');
            nextTab($active);
        });
        $(".prev-step").click(function (e) {
            var $active = $('.nav-tabs li.active');
            prevTab($active);
        });
    });

    function nextTab(elem) {
        $(elem).next().find('a[data-toggle="tab"]').click();
    }
    function prevTab(elem)
    {
        $(elem).prev().find('a[data-toggle="tab"]').click();
    }
</script>