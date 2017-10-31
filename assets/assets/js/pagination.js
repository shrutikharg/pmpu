     $(document).ready(function () {
         $("#page_no").keyup(function (e) {
           e.preventDefault();
            if (e.which === 13) {
               
                if (parseInt($("#page_no").val()) !== NaN) {
                    if (parseInt($("#page_no").val()) > parseInt($("pageOf").text())) {
                        page = $("#pageOf").text();
                    } else {
                        page = $("#page_no").val();
                    }
                } else {
                    page = 1;
                }
                
                fetch_list(page);
            }

        });
         $("#rows").change(function(){
           page=1;
           fetch_list(page);
        });
         $("#reload").click(function () {
            is_search = false;
            search_string_array = "";
            page=1;
            fetch_list(page);
        });
        $("#first_pager").click(function () {
            page = 1;
            fetch_list(page);
        });
        $("#previous_pager").click(function () {
            page = parseInt($("#page_no").val()) - 1;
            fetch_list(page);
        });
        $("#next_pager").click(function () {
            page = parseInt($("#page_no").val()) + 1;
            fetch_list(page);

        });
        $("#last_pager").click(function () {
            page = $("#pageOf").text();
            fetch_list(page);

        });
    });
    function pagination(data){ 
           $("#page_no").val(data.page);
                    $("#pageOf").text(data.total);
                    $("#rowFrm").text(data.start);
                 if(data.records<data.end){
                    $("#rowTo").text(data.records);  
                 }
                 else{
                      $("#rowTo").text(data.end);  
                 }
                    $("#totalCount").text(data.records);
                    
                    if ($("#page_no").val() === '1') {
                        $("#first_pager").hide();
                        $("#previous_pager").hide();
                    } else {
                        $("#first_pager").show();
                        $("#previous_pager").show();
                    }
                    if ($("#page_no").val() === $("#pageOf").text()) { $("#next_pager").hide();
                        $("#last_pager").hide();
                    } else {
                        $("#next_pager").show();
                        $("#last_pager").show();
                    }
    }


