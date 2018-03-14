<style type="text/css">
    .ajax-loader {
        margin-left: auto; 
        margin-right: auto; 
        text-align: center;
        display: table;
    }
    @media(max-width: 560px) {
        .res_row > .column:nth-of-type(1):before { 
            content: "Sr No."; 
        }
        .res_row > .column:nth-of-type(2):before { 
            content: "Course"; 
        }
        .res_row > .column:nth-of-type(3):before { 
            content: "Description"; 
        }
        .res_row > .column:nth-of-type(4):before { 
            content: "Course By"; 
        }
        .res_row > .column:nth-of-type(5):before { 
            content: "Start DT"; 
        }
        .res_row > .column:nth-of-type(6):before { 
            content: "End DT"; 
        }
    }
</style>
<script type="text/javascript">
    var is_search = false, page = 1, search_string_array = "";

    $(document).ready(function () {
        setTimeout(function () {
            fetch_list(page);
        }, 1800);


        $("#search").click(function () {
            is_search = true;
            search_string_array = {'course': $("#course").val(), 'sub_department': $("#sub_department").val()};
            search_string_array = JSON.stringify(search_string_array);
            fetch_list(page);
        });

    });
    function edit_speaker(speaker_id) {


        var form = $(document.createElement('form'));
        $(form).attr("action", "../admin_company/speaker/update");
        $(form).attr("method", "POST");
        $(form).attr("id", "form1");
        var input = $("<input>").attr("type", "hidden").attr("name", "speaker_id").val(speaker_id);
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
            beforeSend: function () {
                $('.ajax-loader').css("visibility", "visible");
            },
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: '../admin_company/speaker/list', // the url where we want to POST
            data: formData, // our data object
            dataType: 'json', // what type of data do we expect back from the server
            encode: true
        })
                // using the done promise callback
                .done(function (data) {
                    if(data.status=='Session Expired'){
                        
                  window.location.href = "<?php echo base_url(); ?>admin_company/login";      
                }
                    $('.ajax-loader').css("visibility", "hidden");
                    $('.res_row').empty();
                    var i = data.start;
                    $.each(data.rows, function (index, row) {

                        var speaker_id = '"' + row['id'] + '"';
                        $(".res_table").append("<div class='res_row'><div class='column' data-label='Sr no'>" + (i) +
                                "</div><div class='column' data-label='Course name'>" + row['name'] +
                                 "</div><div class='column' data-label='Description'>" + row['designation'].substring(0, 10) +
                                "</div><div class='column' data-label='Description'>" + row['description'].substring(0, 15) +
                                "</div><div class='column' data-label='action'><input type='button' name='edit'value=' <?php echo $this->lang->line('btn_edit'); ?>' class='btn btn-info'  onclick='edit_speaker(" + speaker_id + ")'></button></div>\n\
</div>");
                        i++;
                    })
                    pagination(data);
                }).fail(function (data) {
          
        });
    }
</script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/pagination.js"></script>
<div id="content">
    <div class="container">
        <div class="crumbs">
            <ul class="breadcrumb">
                <li>
                    <a href="#">
                        <?php echo $this->lang->line('brd_courses'); ?>
                    </a> 
                    <span class="divider">/</span>
                </li>
                <li>
                    <a href="<?php echo site_url("admin_company") . '/' . $this->uri->segment(2); ?>">
                        <?php echo $this->lang->line('lbl_course'); ?>
                    </a> 

                </li>

            </ul>				      
        </div>

        <!-- /Breadcrumbs line -->
        <br/>
        <?php
        //flash messages

        if (!empty($this->session->flashdata('message'))) {
            //flash messages

            echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>' . $this->session->flashdata('message');
            echo '</div>';
        }
        ?>

        <div class="row">
            <div class="col-md-12">
                <div class="widget box">
                    <div class="widget-header">
                        <h2><?php echo $this->lang->line('lbl_course_lst'); ?></h2>
                    </div>
                    <div class="widget-content">
                        <?php
                        $attributes = array('class' => 'form-horizontal row-border', 'id' => 'myform');

                        $options_category = array('course_name' => 'Course Name');

                        echo form_open('admin_company/courses', $attributes);

                        echo '<div class="form-group">';
                        echo '<label class="col-md-1 col-sm-2   control-label">Course:</label>';

                        echo '<div class="col-md-3 col-sm-4">';
                        $data_search = array(
                            'name' => 'course',
                            'id' => 'course',
                            'class' => 'form-control',
                            'placeholder' => 'Enter Course name',
                        );
                        echo form_input($data_search, $search_string_selected);
                        echo '</div>';

                        $data_submit = array('type' => "button", 'name' => 'search', 'id' => 'search', 'class' => 'btn btn-primary', 'value' => 'Search');
                        echo '<div class="col-md-2 col-sm-2 searchbtn" >';
                        echo form_submit($data_submit);
                        echo '</div>';
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

                <a  href="<?php echo site_url("admin_company") . '/' . $this->uri->segment(2); ?>/add" class="btn btn-primary"><?php echo $this->lang->line('btn_add'); ?></a> 

                <?php
                //flash messages
                if ($this->session->flashdata('.essage')) {

                    echo '<div class="alert alert-success">';
                    echo '<a class="close" data-dismiss="alert">�</a>';
                    echo '<strong>Well done!!</strong> Courses Activate with success now its not to assign anyone.';
                    echo '</div>';
                }
                ?>  
                <br/>

                <!-- /Page Stats -->

                <br/><br/><br/>



                <div class="widget box">
                    <div class="widget-header">
                        <h4><?php echo $this->lang->line('lbl_speaker_lst'); ?></h4>								
                    </div>
                    <br/>


                    <div class="res_table">
                        <div class="res_table-head">
                            <div class="column" data-label="Sr no"> <?php echo $this->lang->line('lbl_sr_no'); ?></div>
                            <div class="column" data-label="Category name"><?php echo $this->lang->line('lbl_speaker'); ?></div>
                            <div class="column"><?php echo $this->lang->line('lbl_speaker_designation'); ?></div>
                            <div class="column"><?php echo $this->lang->line('lbl_speaker_desc'); ?></div>
                            <div class="column" width="220px"><?php echo $this->lang->line('lbl_action'); ?></div>
                        </div> 

                    </div> 
                    <div class="ajax-loader">
                        <img src="../assets/images/ajax-loader.gif" class="img-responsive" style="max-height: 27px;" />
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

            </div>
        </div>
        <!-- /Normal -->
    </div>
</div>		