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
    function edit_quiz(quiz_id) {
        var form = $(document.createElement('form'));
        $(form).attr("action", "../admin_company/quiz/update");
        $(form).attr("method", "POST");
        $(form).attr("id", "form1");
        var input = $("<input>").attr("type", "hidden").attr("name", "quiz_id").val(quiz_id);
        $(form).append($(input));
        $(form).appendTo("body").submit();
    }
    function add_question(quiz_id) {

     var form = $(document.createElement('form'));
        $(form).attr("action", "../admin_company/quiz/add_question");
        $(form).attr("method", "POST");
        $(form).attr("id", "form1");
        var input = $("<input>").attr("type", "hidden").attr("name", "quiz_id").val(quiz_id);
        $(form).append($(input));
        $(form).appendTo("body").submit();

    }
    function fetch_list(page) {
        var formData = {
            'search': is_search,
            'page': page,
            'search_string_array': search_string_array,
            'rows': 10
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
                        var quiz_id = '"' + row['id'] + '"';
                        $(".res_table").append("<div class='res_row'>\n\
                <div class='column' style='display:none;' data-label='Sr no'>" + row['id'] + "</div>\n\
            <div class='column' data-label='Quiz name'>" + row['name'] + "</div>\n\
            \n\<div class='column' data-label='Quiz name'>" + row['description'] + "</div>\n\
            \n\<div class='column' data-label='Quiz Start Date'>" + row['start_date'] + "</div>\n\
            \n\<div class='column' data-label='Quiz End Date'>" + row['end_date'] + "</div>\n\
            \n\<div class='column' data-label='Quiz Questions'><input type='button'  name='edit' value='Manage'class='btn btn-info' onclick='add_question(" + quiz_id + ")'></button></div>\n\
            <div class='column' data-label='action'><input type='button'  name='edit' value='Edit'class='btn btn-info' onclick='edit_quiz(" + quiz_id + ")'></button></div>\n\
            </div>");
                        i++;
                    });
                    pagination(data);
                });
    }
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/pagination.js"></script>
<div id="content">
    <section class="content-header">
        <div class="col-md-12">
            <h4> Quiz </h4>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">        
        <!-- left column -->
        <div class="col-md-12">                
            <div class="res_table">
                <div class="res_table-head">
                    <div class="column" style="display:none;" data-label="Sr no"> Sr No</div>
                    <div class="column" data-label="Quiz name">Name</div>
                    <div class="column" data-label="Quiz Description">Description</div>
                    <div class="column" data-label="Quiz start Date">Start date</div>
                    <div class="column" data-label="Quiz End Date name">End Date</div>
                    <div class="column" data-label="Quiz Questions ">Questions</div>
                    <div class="column" data-label="Action">Action</div>
                </div>
            </div>
        </div><!-- /.box-body -->
    </section><!-- /.content -->
</div>
