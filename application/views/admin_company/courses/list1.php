
<script>var is_search = false, page = 1, search_string_array = "";

    $(document).ready(function () {
        fetch_list(page);

        $("#search").click(function () {
            is_search = true;
            search_string_array = {'course': $("#course").val(), 'sub_department': $("#sub_department").val()};
            search_string_array = JSON.stringify(search_string_array);
            fetch_list(page);
        });

    });
    function edit_courses(course_id) {


        var form = $(document.createElement('form'));
        $(form).attr("action", "../admin_company/courses/update");
        $(form).attr("method", "POST");
        $(form).attr("id", "form1");
        var input = $("<input>").attr("type", "hidden").attr("name", "course_id").val(course_id);
        $(form).append($(input));
        $(form).appendTo("body").submit();
    }

    function fetch_list(page) {
        var formData = {
            'search': is_search,
            'page': page,
            'search_string_array': search_string_array,
             'rows':$("#rows").val()
        };
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: '../admin_company/courses/list', // the url where we want to POST
            data: formData, // our data object
            dataType: 'json', // what type of data do we expect back from the server
            encode: true
        })
                // using the done promise callback
                .done(function (data) {
                    $('.res_row').empty();
                    var i = 0;
                    $.each(data.rows, function (i, row) {i++
                        var course_id = '"' + row['id'] + '"';
                        $(".res_table").append("<div class='res_row'><div class='column' data-label='Sr no'>" + (i) +
                                "</div><div class='column' data-label='Course name'>" + row['name'] +
                                "</div><div class='column' data-label='Sub Category name'>" + row['subcategory'] +
                                "</div><div class='column' data-label='Author name'>" + row['assigner'] +
                                "</div><div class='column' data-label='Description'>" + row['description'] +
                                "</div><div class='column' data-label='Description'>" + row['startdate'] +
                                "</div><div class='column' data-label='Description'>" + row['enddate'] +
                                "</div><div class='column' data-label='action'><input type='button' name='edit'value='Edit' class='btn btn-info'  onclick='edit_courses(" + course_id + ")'></button></div>\n\
</div>");
                        ;
                    })
                    pagination(data);
                });
    }


</script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/pagination.js"></script>
<div id="content">
    <div class="container">
        <div class="crumbs">
            <ul class="breadcrumb">
                <li>
                    <a href="<?php echo site_url("#"); ?>">
                        <?php echo ucfirst($this->uri->segment(1)); ?>
                    </a> 
                    <span class="divider">/</span>
                </li>
                <li>
                    <a href="<?php echo site_url("admin_company") . '/' . $this->uri->segment(2); ?>">
                        <?php echo ucfirst($this->uri->segment(2)); ?>
                    </a> 

                </li>

            </ul>				      
        </div>

        <!-- /Breadcrumbs line -->
        <br/>

        <div class="row">
            <div class="col-md-12">
                <div class="widget box">
                    <div class="widget-header">
                        <h2>Course List</h2>
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
                        echo '<label class="col-md-2 col-sm-2  control-label">Sub Department</label>';
                        echo '<div class="col-md-3 col-sm-4"  >';
                        echo form_dropdown('Sub Department', $subcategory, 'class="form-control"', 'id="sub_department"');
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
                <?php
                //echo ($sessionuserdata[0]['space_filled']);
                $planid_currentuser = $this->session->userdata['userplan_id'];

                //if($planid_currentuser!=='1')
                {

                    if ($sessionuserdata[0]['available_disk_space'] !== 0) {
                        ?>	  
                        <a  href="<?php echo site_url("admin_company") . '/' . $this->uri->segment(2); ?>/add" class="btn btn-primary">Add New</a> <?php
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
                <br/>
           
                <!-- /Page Stats -->

                <br/><br/><br/>



                <div class="widget box">
                    <div class="widget-header">
                        <h4><i class="icon-reorder"></i>View All Courses</h4>								
                    </div>
                    <br/>


                    <div class="res_table">
                        <div class="res_table-head">
                            <div class="column" data-label="Sr no"> Course Id</div>
                            <div class="column" data-label="Category name">Course</div>


                            <div class="column">SubCategory</div>
                            <div class="column">Course by</div>
                            <div class="column">Description</div>
                            <div class="column">Start Date</div>
                            <div class="column">End Date</div>
                            <div class="column" width="220px">Action</div>
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

            </div>
        </div>
        <!-- /Normal -->
    </div>
</div>		