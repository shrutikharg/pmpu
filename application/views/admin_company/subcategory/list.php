<style>
    .ajax-loader {
        margin-left: auto; 
        margin-right: auto; 
        text-align: center;
        display: table;
    }
</style>
<script>
        var is_search = false, page = 1, search_string_array = "";

        $(document).ready(function () {
            setTimeout(function () {
                fetch_list(page);
            }, 1800);

            $("#search").click(function () {
                search_string_array = {'department': $("#department").val(), 'subdepartment': $("#subdepartment").val()};
                search_string_array = JSON.stringify(search_string_array);

                setTimeout(function () {
                    fetch_list(page);
                }, 1800);
            });
        });
        function edit_subcategory(subcategory_id) {
            var form = $(document.createElement('form'));
            $(form).attr("action", "../admin_company/subcategory/update");
            $(form).attr("method", "POST");
            $(form).attr("id", "form1");
            var input = $("<input>").attr("type", "hidden").attr("name", "id").val(subcategory_id);
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
                url: '../admin_company/subcategory/list', // the url where we want to POST
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
                            var subcategory_id = '"' + row['id'] + '"';
                            $(".res_table").append("<div class='res_row'><div class='column' data-label='Sr no'>" + (++i) +
                                    "</div> <div class='column' data-label='Category name'>" + row['name'] +
                                    "</div><div class='column' data-label='Category name'>" + row['category'] +
                                    "</div><div class='column' data-label='Description'>" + row['description'] +
                                    "</div><div class='column' data-label='action'>\n\
<input type='button'  value=<?php echo $this->lang->line('btn_edit'); ?> class='btn btn-info' onclick='edit_subcategory(" + subcategory_id + ")'></button></div>\n\
</div>");
                        })
                        pagination(data);
                    });
        }
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/pagination.js"></script>
<style type="text/css">
    .form-horizontal select{
        background-color: #fff;
        border: 1px solid #ccc;

        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
        color: #555;
        display: block;
        font-size: 14px;
        height: 34px;
        line-height: 1.42857;
        padding: 6px 12px;
        transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
        vertical-align: middle;
        width: 100%;
    }
</style>
<div id="content">
    <div class="container">
        <!-- Breadcrumbs line -->
        <div class="crumbs">
            <ul class="breadcrumb">
                <li>
                    <a href="#">
<?php echo $this->lang->line('brd_organization'); ?>
                    </a> 
                  
                </li>
                <li>
                    <a href="<?php echo site_url("admin_company") . '/' . $this->uri->segment(2); ?>">
<?php echo $this->lang->line('brd_subdepartment'); ?>
                    </a>                    
                </li>

            </ul>				      
        </div>
         <br/>
        <!-- /Breadcrumbs line -->
      
        <div class="row">
              <?php 
                        if ($this->session->flashdata('message')) {

                            echo '<div class="alert alert-success">';                            
                            echo '<strong>'.$this->session->flashdata('message');
                            echo '</div>';
                        } ?>
            <div class="col-md-12">
                <div class="widget box">
                    <div class="widget-header">
                        <h2>Search </h2>
                    </div>
                    <div class="widget-content">
                        <?php
                      

                        $attributes = array('class' => 'form-horizontal row-border', 'id' => 'myform');

                    //    $options_category = array('select' => 'Select', 'subcategory_name' => 'Sub Category Name', 'category_id' => 'Category Name');
                        echo form_open('admin_company/subcategory', $attributes);

                        echo '<div class="form-group">';
                        echo '<label class="col-md-2 hidden-sm  control-label">SubDeparment</label>';

                        echo '<div class="col-md-3 col-sm-4">';
                        $data_search = array(
                            'name' => 'subdepartment',
                            'id' => 'subdepartment',
                            'class' => 'form-control',
                            'placeholder' => 'Enter SubDepartment',
                        );
                        echo form_input($data_search, $search_string_selected);
                        echo '</div>';

                        echo '<label class="col-md-2 col-sm-2  control-label">Department</label>';
                        //echo form_input('search_string', $search_string_selected);
                        //echo '<div class="col-md-2" id="col-md-dp">';
                        //echo form_dropdown('order', $options_category, $order, 'class="form-control"');
                        //echo '</div>';

                        $data_submit = array('type' => "button",'name' => 'search', 'id' => 'search', 'class' => 'btn btn-primary', 'value' => 'Search');

                        echo '<div class="col-md-3 col-sm-4"  >';
                        echo form_dropdown('department', $category, 'class="form-control"' ,'id="department"');
                        echo '</div>';
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
                //var_dump($subcategory);
                /* $subcatlimit=$this->session->userdata('user_subcatlimit');		
                  $planid_currentuser=$this->session->userdata['userplan_id'];

                  if($planid_currentuser !=='1')
                  {
                  if($subcatlimit &&  ($subcatlimit > $count_subcatlimit))
                  { */
                ?>
                <a  href="<?php echo site_url("admin_company") . '/' . $this->uri->segment(2); ?>/add" class="btn btn-primary"><?php echo $this->lang->line('btn_add');?></a>
                </h2>
                <?php /*
                  }
                  } */
                ?>
                <p>&nbsp;</p>
                <div class="widget box">
                    <div class="widget-header">
                        <h4><?php echo $this->lang->line('lbl_subdepartment_lst');?></h4>								
                    </div>
                    <div class="res_table">
                        <div class="res_table-head">
                            <div class="column" data-label="Sr no"> <?php echo $this->lang->line('lbl_sr_no');?></div>
                            <div class="column" data-label="Subcategory name"><?php echo $this->lang->line('lbl_subdepartment');?></div>
                            <div class="column" data-label="Category name"><?php echo $this->lang->line('lbl_department');?></div>
                            <div class="column" data-label="Description"><?php echo $this->lang->line('lbl_subdepartment_desc');?></div>                            
                            <div class="column" data-label="action"><?php echo $this->lang->line('lbl_action');?></div>
                        </div> 
                        
                    </div>
                    <div class="ajax-loader">
                        <img src="../assets/images/ajax-loader.gif" class="img-responsive" style="max-height: 27px;" />
                    </div>
                    <div class="pagination"> 
                        <div class="pagination-widget">
                            <div class="col-md-3 col-sm-1 col-xs-2">
                                <span id="reload"   class="glyphicon glyphicon-refresh" > </span>
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