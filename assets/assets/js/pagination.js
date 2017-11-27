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
    $("#rows").change(function () {
        page = 1;
        fetch_list(page);
    });
    $("#reload").click(function () {
        is_search = false;
        search_string_array = "";
        page = 1;
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

    $("#msg_rows").change(function () {
        message_page_no = 1;
        msg_fetch_list(message_page_no);
    });
    $("#msg_reload").click(function () {
        is_search = false;
        search_string_array = "";
        message_page_no = 1;
        msg_fetch_list(message_page_no);
    });
    $("#msg_first_pager").click(function () {
        message_page_no = 1;
        msg_fetch_list(message_page_no);
    });
    $("#msg_previous_pager").click(function () {
        message_page_no = parseInt($("#msg_page_no").val()) - 1;
        msg_fetch_list(message_page_no);
    });
    $("#msg_next_pager").click(function () {
        message_page_no = parseInt($("#msg_page_no").val()) + 1;
        msg_fetch_list(message_page_no);

    });
    $("#msg_last_pager").click(function () {
        message_page_no = $("#msg_pageOf").text();
        msg_fetch_list(message_page_no);

    });
});
function pagination(data) {
    $("#page_no").val(data.page);
    $("#pageOf").text(data.total);
    $("#rowFrm").text(data.start);
    if (data.records < data.end) {
        $("#rowTo").text(data.records);
    } else {
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
    if ($("#page_no").val() === $("#pageOf").text()) {
        $("#next_pager").hide();
        $("#last_pager").hide();
    } else {
        $("#next_pager").show();
        $("#last_pager").show();
    }
}
function msg_pagination(data) {
    $("#msg_page_no").val(data.page);
    $("#msg_pageOf").text(data.total);
    $("#msg_rowFrm").text(data.start);
    if (data.records < data.end) {
        $("#msg_rowTo").text(data.records);
    } else {
        $("#msg_rowTo").text(data.end);
    }
    $("#msg_totalCount").text(data.records);

    if ($("#msg_page_no").val() === '1') {
        $("#msg_first_pager").hide();
        $("#msg_previous_pager").hide();
    } else {
        $("#msg_first_pager").show();
        $("#msg_previous_pager").show();
    }
    if ($("#msg_page_no").val() === $("#msg_pageOf").text()) {
        $("#msg_next_pager").hide();
        $("#msg_last_pager").hide();
    } else {
        $("#msg_next_pager").show();
        $("#msg_last_pager").show();
    }
}


