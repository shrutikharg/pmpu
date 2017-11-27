<link href="<?php echo base_url(); ?>assets/assets/css/messages.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/messages.js"></script>


<script>var is_search = false, page = 1, search_string_array = "";
    var master_id = "<?php echo $message_list[0]->master_id; ?>";
    var msg_recepient_list;
    var sub_page_no = 1;
    var message_page_no = 1;


    $(document).ready(function () {
        $('#reply_discard').click(function(){
            $(this).parents().find('div.replyDiv').show();
            $(this).parent().parent().hide();
        });
        $('#user_select').select2({
            minimumInputLength: 2,
            width: '100%',
            //allowClear: true,
            multiple: true,
            placeholder: "Enter Email/Name/Phone no",
            id: function (e) {
                return e.id + ":" + e.title;
            },
            initSelection: function (element, callback) {
                alert()

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

                $("#user_select").select2('data').forEach(function (user)
                {
                    user_list_array.push(user.id);
                });
                user_list_array.push("<?php echo $this->session->userdata('id'); ?>");

                $.ajax({
                    type: 'POST', // define the type of HTTP verb we want to use (POST for our form)

                    url: '<?php echo base_url(); ?>communication/send_message', // the url where we want to POST
                    data: {'subject': $("#msgSubject").val(), 'message': $("#msgContent").val(), 'users': user_list_array}, // our data object
                    dataType: 'json', // what type of data do we expect back from the server
                    encode: true
                })
                        // using the done promise callback
                        .done(function (data) {
                            $('#msgcontainer').find('input:text').val('');
                            $('.res_row').empty();
                            var i = 0;
                       window.location.href = "<?php echo base_url();?>admin_company/communication";

                        });

            }
        });
        $(".res_row").find('.column').click(function () {
            $(".res_row").removeClass(" active");
            $(this).parent().addClass("active");
            master_id = $(this).attr('master_id');
            $.ajax({
                type: 'POST', // define the type of HTTP verb we want to use (POST for our form)

                url: '<?php echo base_url(); ?>communication/subject_specific_message', // the url where we want to POST
                data: {'master_id': master_id}, // our data object
                dataType: 'json', // what type of data do we expect back from the server
                encode: true
            })
                    // using the done promise callback
                    .done(function (data) {
                        $('.ajax-loader').css("visibility", "hidden");
                        $('.parent').empty();
                        var i = 0;
                        $.each(data, function (i, row) {

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


        $("#reply_btn").click(function () {

            $('#replyTo').select2({
                minimumInputLength: 2,
                width: '100%',
                //allowClear: true,
                multiple: true,
                placeholder: "Enter Email/Name/Phone no",
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
                initSelection: function (element, callback) {


                    return $.ajax({
                        url: "<?php echo base_url(); ?>communication/message_receipient",
                        type: "POST",
                        dataType: "json",
                        data: {
                            master_id: master_id
                        }
                    }).done(function (data) {
                        callback(data);
                    });

                },
                formatResult: formatResult,
                formatSelection: formatSelection,
            }).select2('val', []);
        })
        $("#reply_send").click(function () {

            var user_list_array = [];

            $("#replyTo").select2('data').forEach(function (user)
            {
                user_list_array.push(user.id);
            });
            user_list_array.push("<?php echo $this->session->userdata('id'); ?>");
            $.ajax({
                type: 'POST', // define the type of HTTP verb we want to use (POST for our form)

                url: '<?php echo base_url(); ?>communication/send_reply', // the url where we want to POST
                data: {'message': $("#reply_msg").val(), 'master_id': master_id, 'users': user_list_array}, // our data object
                dataType: 'json', // what type of data do we expect back from the server
                encode: true
            })
                    .done(function (data) {

                        $('.replyDiv').show();
                        $("#reply").toggle();

                        $('.parent').empty();
                        var i = 0;
                        $.each(data, function (i, row) {

                            $(".parent").append("<div><div class='msgdetailsbody'>\n\
                             <div class='row' >\n\
                              <div class='col-md-3'><img src=https://placeholdit.imgix.net/~text?txtsize=9&amp;txt=100%C3%97100&amp;w=100&amp;h=100' alt='View Profile'>\n\
                               <p>" + row.full_name + "</p>\n\
                             </div> <div class='col-md-9'>" + row.message + "</div>\n\
                            </div></div></div>");
                            i++;
                        });

                    });
            ;



        });

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
                            <div class="column" data-label="Name" master_id="<?php echo $row->master_id; ?>" user_id="<?php echo $row->user_id ?>"><?php echo $row->subject; ?> </div>
                        </div>
                    <?php } ?>

                </div>
                <div class="col-md-12 pagination clearfix">
                    <span id="previous_pager" class="glyphicon glyphicon-step-backward"></span>
                    <span id="next_pager" class="glyphicon glyphicon-step-forward"> </span>
                    <span>Page</span>
                    <span><input type="text" class="form-control pagination-input" id="page_no" name="PageNo" value="1" style="display: inline-block;"></span>
                    <span>of </span>
                    <span><label class="pagination-label" id="pageOf">2</label></span>
                </div>
            </div>
            <div class="col-md-9 msgdetails pull-right">
                <div class="col-md-12 pagination clearfix text-right">
                    <span id="previous_pager" class="glyphicon glyphicon-step-backward"></span>
                    <span id="next_pager" class="glyphicon glyphicon-step-forward"> </span>
                    <span>Page</span>
                    <span><input type="text" class="form-control pagination-input" id="page_no" name="PageNo" value="1" style="display: inline-block;"></span>
                    <span>of </span>
                    <span><label class="pagination-label" id="pageOf">2</label></span>
                </div>
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
                <div class="replyDiv">
                    <p style="font-size: 1.5em;">
                        Click here to <a onclick="javascript: void(0);" class="replyDiv">Reply</a>
                    </p>
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
            <input type="text" name="msgsubject" id="msgSubject" placeholder="Subject">
        </div>
        <div class="msgcontent">
            <textarea id="msgContent"></textarea>
        </div>
        <div class="msgsend">
            <input type="button" value="Send Message"  id="send_msg_btn" class="sendmsg pull-right"/>
        </div>
    </div>
<!--    <div class="replyDiv" >
        <p style="font-size: 1.5em;">
            <input type="button"  id="reply_btn" class="replyDiv" value="Reply">
        </p>
    </div>-->
    <div id="reply" class="reply row" style="display: none;">
        <div class="msgto">
            <input type="hidden" name="replyto" id="replyTo">
        </div>

        <div class="msgcontent">
            <textarea id="reply_msg"></textarea>
        </div>
        <div class="pull-left" style="display: block; padding-top: 15px;">
            <input type="button"  id="reply_send" value="Send" />
            <input type="button" value="Discard" id="reply_discard"/>
        </div>
    </div>
</div>
</div>
