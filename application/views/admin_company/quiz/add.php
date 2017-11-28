<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/assets/css/icomoon.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/prettify.css" /> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap-wysihtml5.css" />
<script src="<?php echo base_url(); ?>assets/css/bootstrap.min.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.js"></script>-->
<!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->  
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script> 
<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>assets/css/bootstrap-datepicker.css" /> 

<style type="text/css">
    /**
     * Override feedback icon position
     * See http://formvalidation.io/examples/adjusting-feedback-icon-position/
     */
    #general_form .dateContainer .form-control-feedback 
    {
        top: 0;
        right: -15px;
    }
</style>
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
</head>
<div id="content"  style="min-height: 781px;">
    <section class="content-header container">
        <!-- Breadcrumbs line -->
        <div class="crumbs">
            <ul class="breadcrumb">
                <li>
                    <a href="#">
                        Quiz
                    </a> 
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>admin_company/quiz">
                       Quiz List
                    </a> 
                </li>
                <li class="active">
                    Add Quiz
                </li>
            </ul>				      
        </div>
        <br/>
        <!--Body Content-->
        <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header">
                    <h4>Create Quiz</h4>
                </div>
                <div class="widget-content">
            <!-- general form elements -->
            <div class="box box-primary">
                <form action="" method="post" accept-charset="utf-8" class="form-horizontal" id="general_form" enctype="multipart/form-data">	
                    <div class="box-body">
                        <div class="row" style="padding:20px" >
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
                                <div class="form-group col-xs-12">
                                    <label>Name</label>
                                    <input id="name" class="form-control required" name="name" type="text">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group col-xs-12">
                                    <label>Start date</label>
                                    <div class="dateContainer">
                                        <div class="input-group date" id="startDatePicker">
                                            <input id="start_date" type="date" class="form-control" name="start_Date"  />
                                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-xs-12">
                                    <label >End date</label>
                                    <div class=" dateContainer">
                                        <div class="input-group date" id="endDatePicker">
                                            <input id="end_date"  type="date" class="form-control" name="end_Date" />
                                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group col-xs-12">
                                    <label>Duration  (mins)</label>
                                    <input id="quiz_duration"  class="form-control required number" name="duration" type="text">
                                </div>
                                <div class="form-group col-xs-12">
                                    <label>Number of Attempt</label>
                                    <input id="no_attempt" class="form-control required digits" name="questions" type="text">
                                </div>
                                <div class="form-group col-xs-12">
                                    <label>Pass Mark (%) </label>
                                    <input id="pass_marks"  class="form-control required digits" maxlength="3" name="pass_mark" type="text">
                                </div>  
                            </div>			     
                        </div>
                        <div class="row" >
                            <div class="col-xs-12 col-md-12">
                                <label>Description</label>			                   
                                <textarea id="Description" class="textarea form-control editor" name="Description" placeholder="Enter text ..." style="height: 200px"></textarea>
                            </div>
                        </div>
                        <div class="box-footer clearfix form-actions">
                            <div class="form-group col-xs-12" style="margin-bottom: 0;">
                                <input type="button" value="submit" id="save_general" class="btn btn-primary  pull-right"/>
                            </div>
                        </div>
                </form>	
            </div>
        </div>
    </div>
</div>
            </div>
    </section><!-- /.content -->
</aside><!-- /.right-side -->
</div>
<div id="modal_content" class="modal fade"></div>     
<script src="<?php echo base_url(); ?>assets/css/wysihtml5-0.3.0.js"></script>                
<script src="<?php echo base_url(); ?>assets/css/prettify.js"></script>
<script src="<?php echo base_url(); ?>assets/css/bootstrap-wysihtml5.js"></script>

<script>
    $('.textarea').wysihtml5({
        "font-styles": true, //Font styling, e.g. h1, h2, etc. Default true 
        "emphasis": true, //Italics, bold, etc. Default true 
        "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true 
        "html": false, //Button which allows you to edit the generated HTML. Default false 
        "link": false, //Button to insert a link. Default true 
        "image": false, //Button to insert an image. Default true, 
        "color": true, //Button to change color of font   
        "blockquote": true, //Blockquote   
        "size": 'sm' //default: none, other options are xs, sm, lg 
    });

</script>
<script type="text/javascript" charset="utf-8">
    $(prettyPrint);
</script>
<script type="text/javascript">
    $(document).ready(function () {
        var a = '<?php echo "../../assets/assets/js/category_dependent.js"; ?>';
        jQuery.getScript(a);
        $('#save_general').click(function () {

            var quiz_data = {'name': $('#name').val(), 'description': $('#Description').val(), 'start_date': $('#start_date').val(), 'end_date': $('#end_date').val(), 'chapter': $('#chapter').val(), 'allowd_time': $('#quiz_duration').val(), 'no_of_attempt': $('#no_attempt').val(), 'passing_percentage': $('#pass_marks').val()};


            $.ajax({
                type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url: '../quiz/add', // the url where we want to POST
                data: quiz_data, // our data object
                dataType: 'json', // what type of data do we expect back from the server                          
                success: function (data) {
                }
            });
        });
    });
</script>


<script>
    $(document).ready(function () {
        $('#startDatePicker')
                .datepicker({
                    format: 'mm/dd/yyyy'
                })
                .on('changeDate', function (e) {
                    $('#general_form').formValidation('revalidateField', 'startDate');
                });

        $('#endDatePicker')
                .datepicker({
                    format: 'mm/dd/yyyy'
                })
                .on('changeDate', function (e) {
                    $('#general_form').formValidation('revalidateField', 'endDate');
                });

        $('#general_form')
            .formValidation({
                framework: 'bootstrap',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    name: {
                        validators: {
                            notEmpty: {
                                message: 'The name is required'
                            }
                        }
                    },
                    startDate: {
                        validators: {
                            notEmpty: {
                                message: 'The start date is required'
                            },
                            date: {
                                format: 'MM/DD/YYYY',
                                max: 'endDate',
                                message: 'The start date is not a valid'
                            }
                        }
                    },
                    endDate: {
                        validators: {
                            notEmpty: {
                                message: 'The end date is required'
                            },
                            date: {
                                format: 'MM/DD/YYYY',
                                min: 'startDate',
                                message: 'The end date is not a valid'
                            }
                        }
                    }
                }
            })
            .on('success.field.fv', function (e, data) {
                if (data.field === 'startDate' && !data.fv.isValidField('endDate')) {
                    // We need to revalidate the end date
                    data.fv.revalidateField('endDate');
                }
                if (data.field === 'endDate' && !data.fv.isValidField('startDate')) {
                    // We need to revalidate the start date
                    data.fv.revalidateField('startDate');
                }
            });
    });
</script>
<!--<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js" type="text/javascript"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" />-->