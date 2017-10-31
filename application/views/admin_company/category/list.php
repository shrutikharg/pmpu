<script src="<?php echo base_url(); ?>assets/assets/js/demo/jquery_1.9.1.js"></script> 
<style>
   .ajax-loader {
  visibility: hidden;
  background-color: rgba(0,0,0,0.7);
  position: fixed;
  top:0%;
  left:0%;
  bottom:0%;
  right:0%;
  z-index: 1000 !important;
  width: 100%;
  height:100%;
}

.ajax-loader img {
  
    top:50%;
    left:45%;
 
 
} 
    </style>
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
    function edit_category(category_id){
      
        
            var form = $(document.createElement('form'));
            $(form).attr("action", "../admin_company/category/update");
            $(form).attr("method", "POST");
 $(form).attr("id", "form1");
            var input = $("<input>").attr("type", "hidden").attr("name", "category_id").val(category_id);
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
             beforeSend: function(){
    $('.ajax-loader').css("visibility", "visible");
  },
            url: '../admin_company/category/list', // the url where we want to POST
            data: formData, // our data object
            dataType: 'json', // what type of data do we expect back from the server
            encode: true
        })
                // using the done promise callback
                .done(function (data) {$('.ajax-loader').css("visibility", "hidden");
                    $('.res_row').empty();
                    var i = 0;
                    $.each(data.rows, function (i, row) {
                         var category_id='"'+row['id']+'"';
                        $(".res_table").append("<div class='res_row'>\n\
                <div class='column' data-label='Sr no'>" + (i+1) + "</div>\n\
<div class='column' data-label='Category name'>" + row['name'] + "</div>\n\
<div class='column' data-label='Category name'>" + row['description'] + "</div>\n\
<div class='column' data-label='action'><input type='button'  name='edit' value='<?php echo $this->lang->line('btn_edit'); ?>'class='btn btn-info' onclick='edit_category("+category_id+")'></button></div>\n\
</div>");
                        i++;
                    });
                    pagination(data);
                });
    }


</script>

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
                       <?php echo $this->lang->line('brd_department'); ?>
                    </a> 
                    
                </li>>

            </ul>				      
        </div>

        <!-- /Breadcrumbs line -->
        <br/>
        <div class="row">
            <div class="col-md-12">
                <div class="widget box">
                    <div class="widget-header">
                        <h2><?php echo $this->lang->line('lbl_search')?></h2>
                    </div>
                    <div class="widget-content">
                        <?php
                        $attributes = array('class' => 'form-horizontal row-border', 'id' => 'searchform');

                        $options_category = array('name' => 'Department Name');
                        echo form_open('#', $attributes);

                        echo '<div class="form-group">';
                        echo "<label class='col-md-3 col-sm-3  control-label'>". $this->lang->line('lbl_department')."</label>";

                        echo '<div class="col-md-4 col-sm-5">';
                        $data_search = array(
                            'name' => 'search_string',
                            'id' => 'search_string',
                            'class' => 'form-control',
                            'placeholder' => $this->lang->line('lbl_department')
                        );
                        echo form_input($data_search);
                        echo '</div>';

                        //echo '<label class="col-md-2 col-sm-2  control-label">Order by:</label>';


                        $data_submit = array('type' => "button", 'name' => 'mysubmit', 'id' => 'search', 'class' => 'btn btn-primary', 'value' =>  $this->lang->line('btn_search'));

                        //echo '<div class="col-md-2 col-sm-4"  >';
                       // $options_order_type = array('Select' => 'Select', 'Asc' => 'Asc', 'Desc' => 'Desc');
                       // echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="form-control" id="order"');
                        //echo '</div>';
                        echo '<div class="col-md-2 col-sm-2 searchbtn" >';
                        echo form_input($data_submit);
                        echo '</div>';
                        echo '</div>';
                        echo form_close();
                        ?>

                    </div> <!-- /.widget-content -->
                </div> <!-- /.widget .box -->
            </div> <!-- /.col-md-12 -->
        </div> <!-- /.row -->		


        <div class="row">
            <div class="col-md-12">												
                <?php
                ?>
                <a  href="<?php echo site_url("admin_company") . '/' . $this->uri->segment(2); ?>/add" class="btn btn-primary">Add New</a>
                </h2>
                <?php /*
                  }
                  } */
                ?>
                <p>&nbsp;</p>
                <div class="widget box">
                    <div class="widget-header">
                        <h4> <?php echo $this->lang->line('lbl_department_lst'); ?></h4>								
                    </div>

                    <div class="res_table">
                        <div class="res_table-head">
                            <div class="column"  data-label="Sr no">  <?php echo $this->lang->line('lbl_sr_no'); ?></div>
                            <div class="column" data-label="Category name"> <?php echo $this->lang->line('lbl_department'); ?></div>
                             <div class="column" data-label="Category name"> <?php echo $this->lang->line('lbl_department_desc'); ?></div>
                             <div class="column" data-label="Action"> <?php echo $this->lang->line('lbl_action'); ?></div>

                        </div> 

                    </div> 
                    <div class="ajax-loader">
  <img src="../assets/images/ajax-loader.gif" class="img-responsive" />
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
                                    <select id='rows' style="margin-left: 10px">
                                        <option value="10">10 </option>
                                        <option value="20"> 20</option>
                                        <option value="25"> 25</option>
                                    </select>
                                </span>
                            </div>
                            <div class="col-md-4 col-sm-5 col-xs-12 pagination-right">   
                                <div class="pagination-right">
                                <span>view</span>
                                <span ><lable class="pagination-lable" id="rowFrm" > </lable></span>
                                <span>-</span>
                                <span><lable class="pagination-lable" id="rowTo" ></lable></span>
                                <span>view</span>
                                <span id="totalCount">50 </span>
                            </div>
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