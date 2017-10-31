<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/prettify.css"></link>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap-wysihtml5.css"></link>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>  
<style type="text/css">  
    .switch {
        position: relative;
        margin: 20px auto;
        height: 32px;
        width: 120px;
        background: rgba(0, 0, 0, 0.25);
        border-radius: 3px;
        -webkit-box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);
    }                
    .switch-label {
        position: relative;
        z-index: 2;
        float: left;
        width: 58px;
        line-height: 25px;
        font-size: 11px;
        color: rgba(255, 255, 255, 0.35);
        text-align: center;
        text-shadow: 0 1px 1px rgba(0, 0, 0, 0.45);
        cursor: pointer;
    }
    .switch-label:active {
        font-weight: bold;
    }
    .switch-label-off {
        padding-left: 2px;
    }
    .switch-label-on {
        padding-right: 2px;
    }
    .switch-input {
        display: none;
    }
    .switch-input:checked + .switch-label {
        font-weight: bold;
        color: rgba(0, 0, 0, 0.65);
        text-shadow: 0 1px rgba(255, 255, 255, 0.25);
        -webkit-transition: 0.15s ease-out;
        -moz-transition: 0.15s ease-out;
        -o-transition: 0.15s ease-out;
        transition: 0.15s ease-out;
    }
    .switch-input:checked + .switch-label-on ~ .switch-selection {		 
        left: 60px;
        background: #4bae4f;
    }
    .switch-input:checked + .switch-label-off ~ .switch-selection {	 
        background: #f34235;
    }                               
    .switch-selection {
        display: block;
        position: absolute;
        z-index: 1;		 
        width: 58px;
        height: 30px;		
        border-radius: 3px;
        background-image: -webkit-linear-gradient(top, #9dd993, #65bd63);
        background-image: -moz-linear-gradient(top, #9dd993, #65bd63);
        background-image: -o-linear-gradient(top, #9dd993, #65bd63);
        background-image: linear-gradient(to bottom, #9dd993, #65bd63);
        -webkit-box-shadow: inset 0 1px rgba(255, 255, 255, 0.5), 0 0 2px rgba(0, 0, 0, 0.2);
        box-shadow: inset 0 1px rgba(255, 255, 255, 0.5), 0 0 2px rgba(0, 0, 0, 0.2);
        -webkit-transition: left 0.15s ease-out;
        -moz-transition: left 0.15s ease-out;
        -o-transition: left 0.15s ease-out;
        transition: left 0.15s ease-out;
    }
</style>
<br/>
<div id="content">
    <section class="content-header">
        <div class="col-md-12">
            <h4>Manage Questions</h4>
            <br/>
        </div>
    </section>
    <!-- Main content -->  
    <!-- left column -->
    <div class="col-md-12">
        <h4>Exam :: PHP</h4>
        <div class="box box-info">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Custom Tabs -->
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#questions" data-toggle="tab">Questions</a>
                                </li>
                                <li>
                                    <a href="#add" data-toggle="tab">Add Question</a>
                                </li>
                                <li>
                                    <a href="#addFromLibrary" data-toggle="tab">Add From Library</a>                
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="questions">
                                    <div class="dataTables_wrapper form-inline" role="grid">
                                        <div class="row">
                                            <div class="col-xs-6"></div>
                                            <div class="col-xs-6">
                                                <div class="dataTables_filter" id="DataTables_Table_0_filter">
                                                    <label>Search: <input aria-controls="DataTables_Table_0" type="text"></label>
                                                </div></div></div>
                                        <table class="table table-bordered table-striped table-hover dataTable" >
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting_asc" role="columnheader"  rowspan="1" colspan="1" ></th>
                                                    <th  class="sorting" role="columnheader"  rowspan="1" colspan="1" >Question</th>
                                                
                                                    <th  class="sorting" role="columnheader" rowspan="1" colspan="1" >Action</th>
                                                </tr>
                                            </thead>
                                            <tbody role="alert" aria-live="polite" aria-relevant="all">
                                                <tr class="odd">
                                                    <td>1.</td>
                                                    <td>DATA<br></td>
                                                    <td>2</td>
                                                    <td>
                                                        <a href="" class="btn btn-primary btn-sm toggle-modal"><i class="fa fa-eye"></i> View</a>
                                                        <a href="" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i> Edit</a>		                   
                                                        <a class="btn btn-danger btn-sm btn_delete"  data-placement="left"><i class="fa fa-trash-o"></i> Delete</a>              
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        
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
                                    <select  id="rows"style="margin-left: 10px">
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
                                </div><!-- /.tab-pane -->
                                <div class="tab-pane" id="add">
                                    <form action="" id="frm_Question" method="post" accept-charset="utf-8" enctype="multipart/form-data" novalidate="novalidate">
                                        <input name="quiz_id" value="372" type="hidden">
                                        <div class="row">
                                            <div class="form-group col-xs-6">
                                                <label>Question</label>
                                                <textarea class="textarea form-control editor" rows="10" name="question" style="height: 200px">                                            
                                                </textarea> 
                                            </div>
                                            <div class="form-group col-xs-6">
                                                <label>Marks</label>
                                                <input class="form-control required digits" name="marks" type="text">
                                            </div>
                                            <div class="form-group col-xs-6">
                                                <label>Image</label>
                                                <input class="form-control" name="que_img" type="file">
                                            </div>
                                        </div>
                                        <h4>Answers</h4><hr>
                                        <div class="row" name="option_div">
                                            <div class="form-group col-xs-6">
                                                <label>Answer</label>			                
                                                <textarea id="option_1" class="textarea form-control editor" rows="5" name="option" id="option_1" style="height: 200px" >                                            
                                                </textarea>                                       
                                            </div>
                                            <div class="form-group col-xs-3" style="padding-top: 80px;"> 
                                                <label>Correct</label>
                                                <div class="switch">
                                                    <input type="radio" option_for="option_1" class="switch-input" name="ans1" value="false" id="ans11" checked>
                                                    <label for="ans11" class="switch-label switch-label-off">Wrong</label>
                                                    <input type="radio" option_for="option_1" class="switch-input" name="ans1" value="true" id="ans12">
                                                    <label for="ans12" class="switch-label switch-label-on">Correct</label>
                                                    <span class="switch-selection"></span>
                                                </div>			             
                                            </div>
                                        </div>
                                        <div class="row" name="option_div">
                                            <div class="form-group col-xs-6">
                                                <label>Answer</label>
                                                <textarea  id="option_2" class="textarea form-control editor" rows="5" name="option" id="option_2" style="height: 200px" >                                            
                                                </textarea>	
                                            </div>
                                            <div class="form-group col-xs-3" style="padding-top: 80px;"> 
                                                <label>Correct</label>
                                                <div class="switch">
                                                    <input option_for="option_2" type="radio" class="switch-input" name="ans2" value="false" id="ans21" checked>
                                                    <label for="ans21" class="switch-label switch-label-off">Wrong</label>
                                                    <input option_for="option_2" type="radio" class="switch-input" name="ans2" value="true" id="ans22" >
                                                    <label for="ans22" class="switch-label switch-label-on">Correct</label>
                                                    <span class="switch-selection"></span>
                                                </div>			               
                                            </div>
                                        </div>
                                        <div class="row" name="option_div">
                                            <div class="form-group col-xs-6">
                                                <label>Answer</label>
                                                <textarea id="option_4" class="textarea form-control editor" rows="5" name="option" style="height: 200px" >                                            
                                                </textarea>     
                                            </div>
                                            <div class="form-group col-xs-3" style="padding-top: 80px;"> 
                                                <label>Correct</label>
                                                <div class="switch">
                                                    <input type="radio"  class="switch-input" name="ans3" value="flase" id="ans31" checked>
                                                    <label for="ans31" option_for="option_4" class="switch-label switch-label-off">Wrong</label>
                                                    <input type="radio" class="switch-input" name="ans3" value="true" id="ans32" >
                                                    <label for="ans32" class="switch-label switch-label-on">Correct</label>
                                                    <span class="switch-selection"></span>
                                                </div>			               
                                            </div>
                                        </div>
                                        <div class="row" name="option_div">
                                            <div class="form-group col-xs-6">
                                                <label>Answer</label>
                                                <textarea id="option_4" class="textarea form-control editor" rows="5" name="option" style="height: 200px" >                                            
                                                </textarea>     
                                            </div>
                                            <div class="form-group col-xs-3" style="padding-top: 80px;"> 
                                                <label>Correct</label>
                                                <div class="switch">
                                                    <input type="radio"  class="switch-input" name="ans4" value="flase" id="ans41" checked >
                                                    <label for="ans41" option_for="option_4" class="switch-label switch-label-off">Wrong</label>
                                                    <input type="radio" class="switch-input" name="ans4" value="true" id="ans42" >
                                                    <label for="ans42" class="switch-label switch-label-on">Correct</label>
                                                    <span class="switch-selection"></span>
                                                </div>			               
                                            </div>
                                        </div>
                                        <div class="box-footer clearfix">
                                            <div class="form-group col-xs-12">
                                                <button type="button" id="save_Question" class="btn btn-primary  pull-right">Submit</button>
                                            </div>
                                        </div>
                                        <div class="alert alert-success"  style="display:none">
                                            <strong> Question added successfully to quiz</strong>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                                <!-- .tab--->
                                <div class="tab-pane" id="addFromLibrary">                  
                                    <h2> Added Questions From Library </h2>                  
                                    <form action="" method="post" accept-charset="utf-8" class="form-horizontal" id="general_form" enctype="multipart/form-data">				
                                        <div class="col-xs-6">
                                            <div class="form-group col-xs-12">
                                                <label>Category</label>
                                                <select class="form-control required" id="department">			                	
                                                </select>                                       
                                            </div>
                                            <div class="form-group col-xs-12">
                                                <label>Sub Category</label>
                                                <select class="form-control required" id="sub_department">			                	
                                                </select>                                       
                                            </div>
                                            <div class="form-group col-xs-12">
                                                <label>Course</label>
                                                <select class="form-control required" id="course">			                	
                                                </select>                                       
                                            </div>
                                            <div class="form-group col-xs-12">
                                                <label>Chapter</label>
                                                <select class="form-control required" id="chapter">			                	
                                                </select>                                       
                                            </div>
                                            <div class="box-footer clearfix">
                                                <div class="form-group col-xs-12">
                                                    <input type="button" value="submit" id="Add" class="btn btn-primary  pull-right"/>
                                                </div>
                                            </div>
                                        </div>                       
                                    </form>	
                                </div><!-- /.tab-pane -->
                            </div><!-- /.tab-content -->
                        </div><!-- nav-tabs-custom -->
                    </div><!-- /.col -->
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>        
</div>    
<script src="<?php echo base_url(); ?>assets/css/wysihtml5-0.3.0.js"></script>                
<script src="<?php echo base_url(); ?>assets/css/prettify.js"></script>
<script src="<?php echo base_url(); ?>assets/css/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/css/bootstrap-wysihtml5.js"></script>

<script type="text/javascript">
    $('.textarea').wysihtml5();
</script>

<script type="text/javascript" charset="utf-8">
    $(prettyPrint);
</script>



<script type="text/javascript">
    var question_list_array, is_search = false, page = 1, search_string_array = "";
    
    $(document).ready(function () {
        fetch_list(page);
        var a = '<?php echo "../../assets/assets/js/category_dependent.js"; ?>';
        jQuery.getScript(a);

        $('#save_Question').click(function () {

            var option_array = [], question_object = {};

            $("[name='option_div'].row").each(function (i, obj) {
                var option_object = {};
                var option = $(obj).find($("[name='option']"));

                option_object.name = $(option).val();
                option_object.is_correct = $(obj).find($("input[type='radio']:checked")).val();
                option_array.push(option_object)


            });
            question_object.name = $(".row").find($("[name='question']")).val();
            question_object.marks = $("[name='marks']").val();
            question_object.options = option_array;
            question_object.quiz_id = "<?php echo $quiz_id; ?>";



            $.ajax({
                type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url: '../quiz/add_question', // the url where we want to POST
                data: question_object, // our data object
                dataType: 'text', // what type of data do we expect back from the server                          
                success: function (data) {
                    if (data.trim() == 'Success') {
                        $('#frm_Question')[0].reset();
                        // $("div.alert.alert-success").show().delay(10000).hide();
                        setTimeout(function () {
                            $('div.alert.alert-success').fadeOut('fast');
                        }, 5000);
                        fetch_list(1);
                    }
                }
            });
        });
    });
        function fetch_list(page) {
        var formData = {
            'search': is_search,
            'page': page,
            'search_string_array': search_string_array,
            'rows': $("#rows").val(),
            'quiz_id':"<?php echo $quiz_id; ?>"
        };
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: '../quiz/question_list', // the url where we want to POST
            data: formData, // our data object
            dataType: 'json', // what type of data do we expect back from the server
            encode: true
        })
                // using the done promise callback
                .done(function (data) {
                    $('tbody').empty();
                    var i = 0;

                    $.each(data.rows, function (i, row) {
                        i++;
                        var question_id = '"' + row['id'] + '"';
                        $("tbody").append("<tr class='ui-sortable-handle res_row'><td class='column' data-label='Sr no'>" + i +
                                "</td><td class='column'  data-label='chapter name'>" + row['name'] +                               
                                "</td><td class='column' data-label='action'>\n\
                                <input type='button'  value='Edit' class='btn btn-info' onclick='edit_question(" + question_id + ")'></button></td> \n\
                      </tr>");

                    })
                    pagination(data);
                });
    }
</script>   
<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/pagination.js"></script>