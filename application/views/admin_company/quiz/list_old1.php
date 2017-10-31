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
            'rows':10
        };
       
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: '../admin_company/quiz/list', // the url where we want to POST
            data: formData, // our data object
            dataType: 'json', // what type of data do we expect back from the server
            encode: true
        })
                // using the done promise callback
                .done(function (data) {
                    $('.res_row').empty();
                    var i = 0;
                    $.each(data.rows, function (i, row) {
                         var category_id='"'+row['id']+'"';
                        $("tbody").append("<div class='res_row'>\n\
                <div class='column' style='display:none;' data-label='Sr no'>" + row['id'] + "</div>\n\
<div class='column' data-label='Category name'>" + row['name'] + "</div>\n\
<div class='column' data-label='action'><input type='button'  name='edit' value='Edit'class='btn btn-info' onclick='edit_category("+category_id+")'></button></div>\n\
</div>");
                        i++;
                    });//$( "div.res_table" ).scrollTop( 300 );
                    pagination(data);
                });
    }


</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/pagination.js"></script>
<div id="content">
            <section class="content-header">
                <h4>Quiz</h4>
            </section>
            <!-- Main content -->
            <section class="content">
             
             <div class="row">
<!-- left column -->
<div class="col-md-12">
        <div class="box box-info">
    <div class="box-body">
        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline" role="grid"><div class="row"><div class="col-xs-6"></div><div class="col-xs-6"><div class="dataTables_filter" id="DataTables_Table_0_filter"><label>Search: <input aria-controls="DataTables_Table_0" type="text"></label></div></div></div><table class="table table-bordered table-striped table-hover dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
            <thead>
            <tr role="row"><th style="width: 25px;" class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label=": activate to sort column descending"></th><th style="width: 284px;" class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending">Name</th><th style="width: 301px;" class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Description: activate to sort column ascending">Description</th><th style="width: 100px;" class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Available From: activate to sort column ascending">Available From</th><th style="width: 100px;" class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Available To: activate to sort column ascending">Available To</th><th style="width: 65px;" class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Questions: activate to sort column ascending">Questions</th><th style="width: 159px;" class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending">Action</th></tr>
            </thead>
                        	<tbody role="alert" aria-live="polite" aria-relevant="all"><tr class="odd">
                <td class="  sorting_1">1.</td>
                <td class=" ">php</td>
                <td class=" ">hghg[p[</td>
                <td class=" ">05/07/2066</td>
                <td class=" ">07/06/2076</td>
                <td class=" ">30 <a href="" class="btn btn-xs bg-maroon"> Manage</a></td>
                <td class=" ">
                    <a href="" class="btn btn-primary btn-sm toggle-modal"><i class="fa fa-eye"></i> View</a>                   
					<a href="" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i> Edit</a>                  
					<a  href="" class="btn btn-danger btn-sm btn_delete" class='btn btn-danger btn-delete' ><i class="fa fa-trash-o"></i> Delete</a>              
	                </td>
            	</tr></tbody></table>
    </div><!-- /.box-body -->
</div><!-- /.box -->
</div>
</div>
 </section><!-- /.content -->
 </div>
