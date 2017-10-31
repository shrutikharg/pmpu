<script src="<?php echo base_url(); ?>assets/assets/js/demo/jquery_1.9.1.js"></script> 
<script>var is_search = false, page = 1, search_string_array = "";

    $(document).ready(function () {
        fetch_list(page);



        $("#search").click(function () {
            is_search = true;
            search_string_array = {'search_string': $("#search_string").val(), 'order': $("#order").val()};
            search_string_array = JSON.stringify(search_string_array);

            fetch_list(page);
        });

    });
    function assign_course(course_id) {

        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: '../admin_company/coursesassign/add', // the url where we want to POST
            data: {'course_id':course_id}, // our data object
            dataType: 'json', // what type of data do we expect back from the server
            encode: true
        })
                // using the done promise callback
                .done(function (data) {
               
                });

        
    }
    function view_assignee(course_id) {


        var form = $(document.createElement('form'));
        $(form).attr("action", "../admin_company/coursesassign/assignee");
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
            'rows': $("#rows").val()
        };

        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: '../admin_company/coursesassign/list', // the url where we want to POST
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
                        var course_id = '"' + row['id'] + '"';
                        $(".res_table").append("<div class='res_row'>\n\
              <div class='column'  data-label='Sr no'>" + i + "</div>\n\
<div class='column' data-label='Category name'>" + row['name'] + "</div>\n\
\n\<div class='column' data-label='Category name'>" + row['start_date'] + " To " + row['end_date'] + "</div>\n\
<div class='column' data-label='action'><input type='button'  name='edit' value='<?php echo $this->lang->line('lbl_assign_course'); ?>'class='btn btn-info' onclick='assign_course(" + course_id + ")'></button>\n\
<input type='button'  name='edit' value='<?php echo $this->lang->line('lbl_view_assignee'); ?>'class='btn btn-info' onclick='view_assignee(" + course_id + ")'></button>\n\
</div>\n\
</div>");

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
                       <?php echo $this->lang->line('brd_courses'); ?>
                    </a> 
                   
                </li>
                <li>
                    <a href="<?php echo site_url("admin_company") . '/' . $this->uri->segment(2); ?>">
                       <?php echo $this->lang->line('nav_chapter'); ?>
                    </a> 

                </li>

            </ul>				      
        </div>
        </br>
        <div class="row">
            <div class="col-md-12">
                <div class="widget box">
                    <div class="widget-header">
                        <h2><?php echo $this->lang->line('lbl_search')?></h2>
                    </div>
                    <div class="widget-content">
                        <?php
                        $attributes = array('class' => 'form-horizontal row-border', 'id' => 'myform');

                        $options_category = array('course_name' => 'Course Name');

                        echo form_open('admin_company/coursesassign', $attributes);

                        echo '<div class="form-group">';
  echo '<label class="col-md-3 col-sm-3  control-label">'.$this->lang->line('lbl_course').'</label>';

                        echo '<div class="col-md-3">';
                        $data_search = array(
                            'name' => 'search_string',
                            'id' => 'search_string',
                            'class' => 'form-control',
                            'placeholder' => $this->lang->line('lbl_course'),
                        );
                        echo form_input($data_search, $search_string_selected);
                        echo '</div>';


                        echo '<div class="col-md-12">';
                        $data_submit = array('type' => "button",'name' => 'mysubmit', 'class' => 'btn btn-primary','id'=>'search', 'value' => $this->lang->line('btn_search'));
                        echo '</div>';

                        echo form_submit($data_submit);
                        echo '</div>';
                        echo form_close();
                        ?>	

                        <!--				
                        <a onclick="javascript:checkAll('form3', true);" href="javascript:void();">check all</a>
                        <a onclick="javascript:checkAll('form3', false);" href="javascript:void();">uncheck all</a>-->


                    </div> <!-- /.widget-content -->
                </div> <!-- /.widget .box -->
            </div> <!-- /.col-md-12 -->
        </div> <!-- /.row -->		

        <!-- /Statboxes -->
        <!--=== Normal ===-->

        <p>&nbsp;</p>
        <div class="widget box">
            <div class="widget-header">
                <h4><?php echo $this->lang->line('lbl_course_assignment_lst'); ?></h4>								
            </div>

            <form style="margin: 0px !important;" name="form3" action="<?php echo site_url("admin_company") . '/' . 'coursesassign'; ?>/assignall" method="POST">
                <?php
                /* echo '<td class="crud-actions">
                  <a href="'.site_url("admin_company").'/coursesassign/assignall/" class="btn btn-info">Assign All Course</a></td>';
                  echo '</tr>'; */

                //echo form_submit($data_submit);
                ?>
                <div class="res_table">
                    <div class="res_table-head">
                        <div class="column" data-label="Sr no"><?php echo $this->lang->line('lbl_sr_no'); ?></div>
                        <div class="column" data-label="Course name"><?php echo $this->lang->line('lbl_course'); ?></div>
                        <div class="column" data-label="Course Validity"><?php echo $this->lang->line('lbl_course_validity');?></div>
                        <div class="column" data-label="action"><?php echo $this->lang->line('lbl_action');?></div>
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
                                <select id="rows"style="margin-left: 10px">
                                    <option value="10">10</option>
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

        <script type="text/javascript" language="javascript">// <![CDATA[
              function checkAll(formname, checktoggle)
              {
                  var checkboxes = new Array();
                  checkboxes = document[formname].getElementsByTagName('input');

                  for (var i = 0; i < checkboxes.length; i++) {
                      if (checkboxes[i].type == 'checkbox') {
                          checkboxes[i].checked = checktoggle;
                      }
                  }
              }
        // ]]></script>
        </form>
    </div>
</div>

</div>
</div>
<!-- /Normal -->
</div>
</div>
