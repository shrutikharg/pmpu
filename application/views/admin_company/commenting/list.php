<style type="text/css">
    #content {
        min-height: auto;
    }
    .msgcontainer {
        width: 560px;
        height: 320px;
        position: absolute;
        bottom: 183px;
        right: 0;
        border: 2px solid;
    }
    .msgto input, .msgsubject input {
        width: 100%;
        /*border: 0;*/
    }
    textarea {
        width: 100%;
        height: 170px;
    }
    input.sendmsg.pull-right {
        margin: 15px;
        padding: 6px;
    }
    .msgstrip {
        background: #000;
        height: 31px;
    }
    p.msglabel {
        color: #fff;
        margin: 0;
        padding: 6px 10px;
    }
    p.evticons {
        margin: 0;
        padding: 5px 10px;
        color: #fff;
        width: 15%;
    }
    .evticons > i {
        width: 27%;
        color: #fff;
        margin-left: 1%;
        cursor: pointer;
    }
    .msgsend {
        margin: -9px 0;
    }
    .msgdetailsbody img {
        border-color: #777;
        border: 1px solid #f5f5f5;
        border-radius: 150px;
        height: 70px;
        padding: 3px;
        width: 70px;
        display: inline-block;
        vertical-align: top;
    }
    .msgdetailsbody .col-md-4:after {
        top: 28%;
        left: 105px;
        border: solid transparent;
        content: "";
        position: absolute;
        border-top-color: #fff;
        border-width: 15px;
        margin-left: -15px;
        transform: rotate(270deg);
        border-top-color: #337AB7;
    }
    .msgdetails > div {
        padding: 15px;
        border-radius: 10px;
    }
    .msgdetails > div:nth-child(odd) {
        background: aliceblue;
    }
    .msgdetails > div:nth-child(even) {
        background: #f2fff0;
        margin-top: 2px;
    }
</style>
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
                        <div class="column" data-label="Name"><a>Dave Sariava</a></div>
                    </div>
                    <div class="res_row">
                        <div class="column" data-label="Name"><a>Nic Rowen</a></div>
                    </div>
                    <div class="res_row">
                        <div class="column" data-label="Name"><a>Scott Kelly</a></div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 msgdetails pull-right">
                <div>
                    <!--<div class="msgdetailsheader"><h3>Dave Saraiva</h3></div>-->
                    <div class="msgdetailsbody">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="https://placeholdit.imgix.net/~text?txtsize=9&amp;txt=100%C3%97100&amp;w=100&amp;h=100" alt="User Name">
                                <p>Dave Saraiva</p>
                            </div>
                            <div class="col-md-8">This is Testing Message written to test the message conversation of two users</div>
                        </div>
                    </div>
                </div>
                <div>
                    <!--<div class="msgdetailsheader"><h3>Dave Saraiva</h3></div>-->
                    <div class="msgdetailsbody">
                        <div class="row">
                            <div class="col-md-4"><img src="https://placeholdit.imgix.net/~text?txtsize=9&amp;txt=100%C3%97100&amp;w=100&amp;h=100" alt="User Name">
                                <p>Nic Rowen</p>
                            </div>
                            <div class="col-md-8">This is Testing Message written to test the message conversation of two users</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="msgcontainer" style="display: none;">
        <div class="msgstrip">
            <p class="pull-left msglabel">New Message</p>
            <p class="pull-right evticons">
                <i class="fa fa-minus" aria-hidden="true"></i>
                <i class="fa fa-expand" aria-hidden="true"></i>
                <i class="fa fa-close" aria-hidden="true"></i>
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
</div>
</div>