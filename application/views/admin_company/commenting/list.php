<link href="<?php echo base_url();?>assets/assets/css/messages.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo base_url();?>assets/assets/js/messages.js"></script>
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
                        <div class="column" data-label="Name"> Name </div>
                    </div>
                    <div class="res_row">
                        <div class="column" data-label="dave"><a>Dave Sariava</a></div>
                    </div>
                    <div class="res_row">
                        <div class="column" data-label="nic"><a>Nic Rowen</a></div>
                    </div>
                    <div class="res_row">
                        <div class="column" data-label="scott"><a>Scott Kelly</a></div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 msgdetails pull-right">
                <div class="parent dave">
                    <div>
                        <div class="msgdetailsbody">
                            <div class="row">
                                <div class="col-md-10">
                                    This is Testing Message written to test the message conversation of two users
                                    <span>10 Nov 2017 10:05AM</span>
                                </div>
                                <div class="col-md-2 text-center">
                                    <img src="https://placeholdit.imgix.net/~text?txtsize=9&amp;txt=100%C3%97100&amp;w=100&amp;h=100" alt="User Name">
                                    <p>Dave Saraiva</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="msgdetailsbody">
                            <div class="row">
                                <div class="col-md-10">
                                    This is Testing Message written to test the message conversation of two users
                                    <span>10 Nov 2017 10:15AM</span>
                                </div>
                                <div class="col-md-2 text-center"><img src="https://placeholdit.imgix.net/~text?txtsize=9&amp;txt=100%C3%97100&amp;w=100&amp;h=100" alt="User Name">
                                    <p>you</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="parent nic">
                    <div>
                        <div class="msgdetailsbody">
                            <div class="row">
                                <div class="col-md-10">
                                    This is Testing Message written to test the message conversation of two users
                                    <span>10 Nov 2017 10:15AM</span>
                                </div>
                                <div class="col-md-2 text-center"><img src="https://placeholdit.imgix.net/~text?txtsize=9&amp;txt=100%C3%97100&amp;w=100&amp;h=100" alt="User Name">
                                    <p>Nic</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="msgdetailsbody">
                            <div class="row">
                                <div class="col-md-10">
                                    This is Testing Message written to test the message conversation of two users
                                    <span>10 Nov 2017 10:15AM</span>
                                </div>
                                <div class="col-md-2 text-center"><img src="https://placeholdit.imgix.net/~text?txtsize=9&amp;txt=100%C3%97100&amp;w=100&amp;h=100" alt="User Name">
                                    <p>you</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="msgdetailsbody">
                            <div class="row">
                                <div class="col-md-10">
                                    This is Testing Message written to test the message conversation of two users
                                    <span>10 Nov 2017 10:15AM</span>
                                </div>
                                <div class="col-md-2 text-center"><img src="https://placeholdit.imgix.net/~text?txtsize=9&amp;txt=100%C3%97100&amp;w=100&amp;h=100" alt="User Name">
                                    <p>Nic</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
            <input type="text" name="msgto" placeholder="To">
        </div>
        <div class="msgsubject">
            <input type="text" name="msgsubject" placeholder="Subject">
        </div>
        <div class="msgcontent">
            <textarea></textarea>
        </div>
        <div class="msgsend">
            <input type="button" value="Send Message" class="sendmsg pull-right"/>
        </div>
    </div>
    <div class="replyDiv" style="display: none;">
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