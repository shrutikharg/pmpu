<script src="<?php echo base_url(); ?>assets/assets/js/demo/jquery_1.9.1.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/themes/popupwindow.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/themes/demo.js"></script>	
<link href="<?php echo base_url(); ?>assets/themes/popupwindow.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/themes/preview_demo.css" rel="stylesheet" type="text/css" />
<script>
    var is_search = false, page = 1, search_string_array = "";

        $(document).ready(function () {
        $('#change_sequence_button').click(function () {
            var arr = [];
            $("#sequence_table tr").each(function () {
                arr.push($(this).find(".td:first").attr("id"));
                });
                for (i = 1; i < arr.length; i++)
                {
                    alert(arr[i]);
                }
            });
            setTimeout(function(){ fetch_list(page); }, 1800);
//            fetch_list(page);

            $("#search").click(function () {
                is_search = true;
                search_string_array = {'chapter': $("#chapter").val(), 'course': $("#course").val()};
                search_string_array = JSON.stringify(search_string_array);
//                setTimeout(function(){ fetch_list(page); }, 200);
                fetch_list(page);
            });

        });
        function edit_chapter(chapter_id) {
            var form = $(document.createElement('form'));
            $(form).attr("action", "../admin_company/chapters/update");
            $(form).attr("method", "POST");
            $(form).attr("id", "form1");
            var input = $("<input>").attr("type", "hidden").attr("name", "chapter_id").val(chapter_id);
            $(form).append($(input));
            $(form).appendTo("body").submit();
        }
        function view_comment(chapter_id) {
            var form = $(document.createElement('form'));
            $(form).attr("action", "../admin_company/chapters/comments");
            $(form).attr("method", "POST");
            $(form).attr("id", "form1");
            var input = $("<input>").attr("type", "hidden").attr("name", "chapter_id").val(chapter_id);
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
                beforeSend: function(){
                    $('.ajax-loader').css("visibility", "visible");
                },
                type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url: '../admin_company/chapters/list', // the url where we want to POST
                data: formData, // our data object
                dataType: 'json', // what type of data do we expect back from the server
                encode: true
            })
            // using the done promise callback
            .done(function (data) {
                $('.ajax-loader').css("visibility", "hidden");
                $('.res_row').empty();
                var i = 0;

                $.each(data.rows, function (i, row) {
                    i++;
                    var chapter_id = '"' + row['id'] + '"';
                    $("tbody").append("<tr class='ui-sortable-handle res_row'><td class='column' data-label='Sr no'>" + i +
                            "</td><td class='column'  data-label='chapter name'>" + row['name'] +
                            "</td><td class='column' data-label='Course name'>" + row['course'] +
                            "</td><td class='column' data-label='Description'>" + row['description'] +
                            "</td><td class='column' data-label='action'>\n\
                             <input type='button'  value=' <?php echo $this->lang->line('btn_edit'); ?>' class='btn btn-info' onclick='edit_chapter(" + chapter_id + ")'></button> \n\
                            \n\  <input type='button'  value=' <?php echo $this->lang->line('lbl_chapt_comment'); ?>' class='btn btn-info' onclick='view_comment(" + chapter_id + ")'></button></td> \n\
              </tr>");

                })
                pagination(data);
            });
        }
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/pagination.js"></script>
<style>
    .ajax-loader {
        margin-left: auto; 
        margin-right: auto; 
        text-align: center;
        display: table;
    }
    table.primary th
    {
     border-bottom-width: 2px;
     border: 1px solid #ddd;
     padding: 5px;
     vertical-align: bottom;
     border-bottom: 2px solid #ddd;
     text-align: left;
     font-weight: bold;
     display: table-cell;
     border-spacing: 2px;
     border-color: grey;
     background-color: #ffffff;
    }

    table.primary td
    {
        border: 1px solid #ddd;   
        border-top: 1px solid #ddd;
    }

    table.primary tr:nth-child(odd) {
        background-color: #fafafa;	

    }
    table.primary tr:nth-child(even) {
        background-color: #ffffff;

    }
    table.primary tr.deactivate{
        background-color: #ffc;
    }

</style>
<div id="content">
    <div class="container">
        <div class="crumbs">
            <ul class="breadcrumb">
                <li>
                    <a href="#">
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
        <br/>
        <div class="row">
            <div class="col-md-12">
                <div class="widget box">
                    <div class="widget-header">
                        <h2><?php echo $this->lang->line('lbl_search')?></h2>
                    </div>
                    <div class="widget-content">
                        <?php
                        $attributes = array('class' => 'form-horizontal row-border', 'id' => 'myform');
                        $options_category = array('name' => 'Chapter Name');
                        echo form_open('admin_company/chapters', $attributes);
                        echo '<div class="form-group">';
                        echo '<label class="col-md-1 col-sm-2   control-label">Chapter</label>';
                        echo '<div class="col-md-3 col-sm-4">';
                        $data_search = array(
                            'name' => 'chapter',
                            'id' => 'chapter',
                            'class' => 'form-control',
                            'placeholder' => 'Enter Chapter',
                        );
                        echo form_input($data_search, $search_string_selected);
                        echo '</div>';
                        echo '<label class="col-md-1 col-sm-2   control-label">Course</label>';
                        echo '<div class="col-md-3 col-sm-4">';
                        $data_search = array(
                            'name' => 'course',
                            'id' => 'course',
                            'class' => 'form-control',
                            'placeholder' => 'Enter Course',
                        );
                        echo form_input($data_search);
                        echo '</div>';
                        $data_submit = array('type' => "button", 'name' => 'mysubmit', 'id' => 'search', 'class' => 'btn btn-primary', 'value' => $this->lang->line('btn_search'));
                        echo '<div class="col-md-2 col-sm-2 searchbtn">';
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
              	  
                    <a  href="<?php echo site_url("admin_company") . '/' . $this->uri->segment(2); ?>/add" class="btn btn-primary"><?php echo $this->lang->line('btn_add');?></a> 
               

                <!-- /Page Stats -->

                <br/><br/>

                <?php
                if (isset($flash_message)) {
                    if ($flash_message == TRUE) {
                        echo '<div class="alert alert-success">';
                        echo '<a class="close" data-dismiss="alert">�</a>';
                        echo '<strong>Well done!</strong>Your chapter Deleted with success.';
                        echo '</div>';
                    } 
                    
                }
                  if ($this->session->flashdata('upload_message')) {
                    
                        echo '<div class="alert alert-danger">';
                        echo '<a class="close" data-dismiss="alert">�</a>';
                        echo '<strong>'.$this->session->flashdata('upload_message') ;
                        echo '</div>';
                 
                    
                }
                ?>  
                <div class="widget box">
                    <div class="widget-header">
                        <h4><?php echo $this->lang->line('lbl_chapter_lst');?></h4>								
                    </div>

                    <table id="sequence_table" class="res_table table table-bordered pagin-table">
                        <thead>
                            <tr  class="row_header ">
                                <th  class="column" data-label="Sr no"> <?php echo $this->lang->line('lbl_sr_no'); ?></th>
                                <th  class="column" data-label="chapter name"><?php echo $this->lang->line('lbl_chapter'); ?></th>
                                <th class="column" data-label="Course name"><?php echo $this->lang->line('lbl_course'); ?></th>
                                <th class="column" data-label="Description"><?php echo $this->lang->line('lbl_chapter_desc'); ?></th>
                                <th class="column" data-label="action" width="220px"><?php echo $this->lang->line('lbl_action'); ?></th>
                            </tr>
                        </thead>
                        <br>
                        <tbody>


                        </tbody>
                    </table>
                    <div class="ajax-loader">
                        <img src="../assets/images/loader.gif" class="img-responsive" style="max-height: 27px;" />
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

                   
                </div >            </div>	
            
        </div>

    </div>
</div>
<!-- /Normal -->
</div>
</div>		