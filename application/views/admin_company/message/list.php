<link href="<?php echo base_url(); ?>assets/assets/css/messages.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/messages.js"></script>


<script>var is_search = false, page = 1, search_string_array = "";


    $(document).ready(function () {
        $('#user_select').select2({
            minimumInputLength: 5,
            width: '100%',
            //allowClear: true,
            multiple: true,
            placeholder: "Enter Email/Name/Phone no",
            id: function (e) {
                return e.id + ":" + e.title;
            },
            ajax: {
                url: '<?php echo base_url(); ?>communication/get_users',
                type: 'POST',
                dataType: 'json',
                data: function (term, page) {

                    return {
                        name: term,
                    };
                },
                results: function (data, page) {

                    return {
                        results: data.users
                    };
                }
            },
            formatResult: formatResult,
            formatSelection: formatSelection,
        });
        $("#send_msg_btn").click(function () {
            if ($("#user_select").select2('data').length == 0) {
                alert('please select recepient');


            } else {
                var user_list_array = [];
                console.log($("#user_select").select2('data'));
                $("#user_select").select2('data').forEach(function (user)
                {
                    user_list_array.push(user.id);
                });


                $.ajax({
                    type: 'POST', // define the type of HTTP verb we want to use (POST for our form)

                    url: '<?php echo base_url(); ?>communication/send_message', // the url where we want to POST
                    data: {'subject': $("#msgSubject").val(), 'message': $("#msgContent").val(), 'users': user_list_array}, // our data object
                    dataType: 'json', // what type of data do we expect back from the server
                    encode: true
                })
                        // using the done promise callback
                        .done(function (data) {

                            $('.res_row').empty();
                            var i = 0;
                            $.each(data.rows, function (i, row) {
                                var category_id = '"' + row['id'] + '"';
                                $(".res_table").append("<div class='res_row'>\n\
            <div class='column' data-label='Sr no'>" + (i + 1) + "</div>\n\
<div class='column' data-label='Category name'>" + row['name'] + "</div>\n\
<div class='column' data-label='Category name'>" + row['description'] + "</div>\n\
<div class='column' data-label='action'><input type='button'  name='edit' value='<?php echo $this->lang->line('btn_edit'); ?>'class='btn btn-info' onclick='edit_category(" + category_id + ")'></button></div>\n\
</div>");
                                i++;
                            });
                            pagination(data);
                        });

            }
        });
        $(".res_row").find('.column').click(function () {
            $.ajax({
                type: 'POST', // define the type of HTTP verb we want to use (POST for our form)

                url: '<?php echo base_url(); ?>communication/subject_specific_message', // the url where we want to POST
                data: {'master_id': $(this).attr('master_id')}, // our data object
                dataType: 'json', // what type of data do we expect back from the server
                encode: true
            })
                    // using the done promise callback
                    .done(function (data) {
                        $('.ajax-loader').css("visibility", "hidden");
                        $('.parent').empty();
                        var i = 0;
                        $.each(data, function (i, row) {
                            alert(row.full_name);
                            $(".parent").append("<div><div class='msgdetailsbody'>\n\
                             <div class='row' >\n\
                              <div class='col-md-3'><img src=https://placeholdit.imgix.net/~text?txtsize=9&amp;txt=100%C3%97100&amp;w=100&amp;h=100' alt='View Profile'>\n\
                               <p>" + row.full_name + "</p>\n\
                             </div> <div class='col-md-9'>" + row.message + "</div>\n\
                            </div></div></div>");
                            i++;
                        });

                    });

        })

    });
    function formatResult(item) {
        var markup = "";
        if (item.full_name !== undefined) {
            markup += "<option value='" + item.id + "'>" + item.full_name + "</option>";
        }
        return markup;
    }

    function formatSelection(item) {
        return item.full_name;
    }
</script>
<div id="content">
    <div class="container">
        <div class="crumbs">
            <ul class="breadcrumb">
                <li>
                    <a href="#">
                        Employee
                    </a> 
                </li>
            </ul>
        </div>
        <div class="widget box">
            <div class="widget-content">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-default" onclick="javascript: $('.msgcontainer').toggle();">Compose Message</button>
                    </div> 
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="res_table">
                    <div class="res_table-head">
                        <div class="column" data-label="Name"><?php echo $this->lang->line('lbl_subject'); ?> </div>
                    </div>

                    <?php foreach ($message_list as $row) { ?>
                        <div class="res_row">
                            <div class="column" data-label="Name" master_id="<?php echo $row->master_id; ?>" user_id="<?php echo $row->user_id ?>"><?php echo $row->full_name; ?> </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
            <div class="col-md-9 msgdetails pull-right">
                <div class="parent">
                    <?php foreach ($subject_specific_msg_list as $row) { ?>
                        <div>
                            <div class="msgdetailsbody">
                                <div class="row">
                                    <div class="col-md-3">
                                        <img src="https://placeholdit.imgix.net/~text?txtsize=9&amp;txt=100%C3%97100&amp;w=100&amp;h=100" alt="User Name">
                                        <p><?php echo $row->full_name; ?></p>
                                    </div>
                                    <div class="col-md-9"><?php echo $row->message; ?></div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                </div>
                <!--  <div class="parent nic">
                      <div>
                          <div class="msgdetailsbody">
                              <div class="row">
                                  <div class="col-md-3">
                                      <img src="https://placeholdit.imgix.net/~text?txtsize=9&amp;txt=100%C3%97100&amp;w=100&amp;h=100" alt="User Name">
                                      <p>Nic Rowen</p>
                                  </div>
                                  <div class="col-md-9">This is Testing Message written to test the message conversation of two users</div>
                              </div>
                          </div>
                      </div>
                      <div>
                          <div class="msgdetailsbody">
                              <div class="row">
                                  <div class="col-md-3"><img src="https://placeholdit.imgix.net/~text?txtsize=9&amp;txt=100%C3%97100&amp;w=100&amp;h=100" alt="User Name">
                                      <p>you</p>
                                  </div>
                                  <div class="col-md-9">This is Testing Message written to test the message conversation of two users</div>
                              </div>
                          </div>
                      </div>
                      <div>
                          <div class="msgdetailsbody">
                              <div class="row">
                                  <div class="col-md-3"><img src="https://placeholdit.imgix.net/~text?txtsize=9&amp;txt=100%C3%97100&amp;w=100&amp;h=100" alt="User Name">
                                      <p>Nic Rowen</p>
                                  </div>
                                  <div class="col-md-9">This is Testing Message written to test the message conversation of two users</div>
                              </div>
                          </div>
                      </div>
                  </div> -->
            </div>
        </div>
    </div>
    <div class="msgcontainer" style="display: none;" id="msgcontainer">
        <div class="msgstrip">
            <p class="pull-left msglabel">New Message</p>
            <p class="pull-right evticons">
                <a id="hideData" href="javascript: void(0);"><i class="fa fa-minus" aria-hidden="true"></i></a>
                <a id="maximize" href="javascript: void(0);"><i class="fa fa-expand" aria-hidden="true"></i></a>
                <a id="closeWindow" href="javascript: void(0);"><i class="fa fa-close" aria-hidden="true" onclick="javascript: $(this).parents().find('div.msgcontainer').hide();"></i></a>
            </p>
        </div>
        <div class="msgto">
            <input type="text" id="user_select"/>
        </div>
        <div class="msgsubject">
            <input type="text" name="msgsubject" id="msgsubject" placeholder="Subject">
        </div>
        <div class="msgcontent">
            <textarea id="msgContent"></textarea>
        </div>
        <div class="msgsend">
            <input type="button" value="Send Message"  id="send_msg_btn" class="sendmsg pull-right"/>
        </div>
    </div>
    <div class="replyDiv" >
        <p style="font-size: 1.5em;">
            Click here to <a onclick="javascript: void(0);" class="replyDiv">Reply</a>
        </p>
    </div>
    <div id="reply" class="reply row" style="display: none;">
        <div class="msgto">
            <input type="text" name="replyto">
        </div>
        <div class="msgsubject">
            <input type="text" name="replysubject">
        </div>
        <div class="msgcontent">
            <textarea></textarea>
        </div>
        <div class="pull-left" style="display: block; padding-top: 15px;">
            <input type="button" value="Send" />
            <input type="button" value="Discard" id="discard"/>
        </div>
    </div>
</div>
</div>
