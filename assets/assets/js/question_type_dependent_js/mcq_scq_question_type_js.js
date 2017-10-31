var counter = 0;
;
$("#add_option").click(function () {
    counter++;
    $("#question_option_div").append('<label for=chkbx' + counter + '></label>' +
            '<input type="checkbox" name="chkbx' + counter +
            '" id="chkbx' + counter + '" value=' + counter + ' >' +
            '<input type="text" name="txtbx' + counter +
            '" id="txtbx' + counter + '" value_for=chkbx' + counter + '></br>');
})
$('#question_option_div').bind('dblclick', function (event) {
    var delete_option = confirm("Are u really want to delete this option");
    if (delete_option === true) {
        var textbox_id = $(event.target).attr('id');
        var checkbox_id = $("#" + textbox_id).attr('value_for');

        $("#" + textbox_id).remove();
        $("#" + checkbox_id).remove();
        $('label[for=' + checkbox_id + ']').remove();
    }

});
$("#question_save_img").click(function (e) {
    if ($("#question_type").val() === 'scq' && $("#question_option_div input:checked").size() > 1) {
        alert('atleast select 0ne of the option as righ');
        return false;
    }
    if (($("#question_type").val() === 'mcq' || $("#question_type").val() === 'scq') && $("#question_option_div input:checked").size() !== 0)
    {
        var option_detail_array = [];
        var i = 1;
        $("#question_option_div input:checkbox").filter(function () {
            var chckbx_counter = $(this).val();
            if ($('#' + 'txtbx' + chckbx_counter).val() !== "") {
                option_detail_array.push({'name': $('#' + 'txtbx' + chckbx_counter).val(), 'is_checked': $('#' + 'chkbx' + chckbx_counter).prop("checked")});
                i++;
            }

        });


        var question_data = {
            'question': $("#question").val(),
            'question_type': $("#question_type").val(),
            'option': option_detail_array,
            'chapter_id': $("#chapter_id").val(),
            'questionbank_id': $("#questionbank_id").val()

        };
        add_question(question_data);
    } else {
        alert("please select atleast one option which right one");
    }

});

function add_question(question_data) {

    $.ajax({
        type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url: '../admin_company/question/add', // the url where we want to POST
        data: question_data, // our data object
        dataType: "json",
    })
            // using the done promise callback
            .done(function (data) {
                if (data.status === "Success") {
                    $('#question_option_div').empty();
                    $("#add_question_form")[0].reset();
                    if (question_id_storage == true) {
                        var quiz_data_object = JSON.parse(localStorage.getItem('quiz_data'));
                        if (!(quiz_data_object.hasOwnProperty("selected_question_list"))) {
                            selected_question_list = [];
                        }
                        selected_question_list.push(data.question_id);
                         quiz_data_object.selected_question_list = selected_question_list;
                        /*if (localStorage.getItem("selected_question_list") == null) {
                            localStorage.setItem('selected_question_list', JSON.stringify([]));
                            var selected_question_list = JSON.parse(localStorage.getItem('selected_question_list'));
                            
                            localStorage.setItem('selected_question_list', JSON.stringify(selected_question_list));
                        }*/
                    }

                }
            });
}