	
<!DOCTYPE html>
<html>
    <head>
        <title>Coolacharya | Password recovery</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link  rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
        <link  rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">	
        <script type="text/javascript"  src="https://code.jquery.com/jquery-2.2.4.min.js"></script>			
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript">            
            var emailval;
            $(document).ready(function () {
                $("#btn_verify_email").click(function () {

                    var datastring = {'email_id': $("#email_id").val(), 'status': status};

                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url()?>employee/request_password_reset",
                        data: datastring,
                        dataType: 'json',                       
                        success: function (data) {
                            if (data.status === 'Success') {
                                     var $active = $('.wizard .nav-tabs li.active'); 
                                    $active.next().removeClass('disabled');
                                    nextTab($active);
                                     $("#confirmmail").css("display", "block");
                                      $("#confirmmailfail").css("display", "none");
                                        $("#listep1").removeClass('active');
                                        $("#listep1").addClass('disabled');
                                //   location.href = "admin/startpageapp";
                            } else if (data.status === "User Fail") {
                                
                                $("#confirmmailfail").css("display", "block");
                                 $("#confirmmail").css("display", "none");
                              
                            } else if (data.status=== "System Error") {
                                alert("System Error,Please contacrt adminstrator");
                            } else {
                                alert(data);
                            }
                        },
                        error: function () {
                                   alert('error handing here');
                          }
                    });

                });
                $("#btn_verify_code").click(function () {
                    var datastring = {'email_id': $("#email_id").val(), 'code': $("#txt_resetpassword_code").val()};

                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url()?>employee/verify_reset_password_code",
                        data: datastring,
                        dataType: 'json',
                        success: function (data) {
                            if (data.status === 'Success') {
                               var $active = $('.wizard .nav-tabs li.active'); 
                                    $active.next().removeClass('disabled');
                                    nextTab($active);
                                     $("#confirmcode").css("display", "block");
                                      $("#confirmcodefail").css("display", "none");
                                       $("#listep2").removeClass('active');
                                        $("#listep2").addClass('disabled');
                                         $("#confirmmail").css("display", "none");      
                            } else if (data.status === "Fail") {
                                $("#confirmcodefail").css("display", "block");
                                      $("#confirmcode").css("display", "none");
                                        $("#confirmmail").css("display", "none");                                
                                 
                            } else if (data.status === "System Error") {
                                alert("System Error,Please contacrt adminstrator");
                            } else {
                                alert(data);
                            }
                        },
                        error: function () {
                            alert('error handing here');
                        }
                    });
                });
                $("#btn_save_password").click(function () {
                    var datastring = {'password': $("#password").val(), 'retype_password': $("#re_password").val(), 'email_id': $("#email_id").val()};
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url()?>employee/change_password",
                        data: datastring,
                        dataType: 'json',
                        success: function (data) {
                            if (data.status === 'Success') {
                             window.location.href = "<?php echo base_url().'employee'?>";
                            } else if (data.status === "User Fail") {
                                alert("user id not available with given email");
                            } else if (data.status === "System Error") {
                                alert("System Error,Please contacrt adminstrator");
                            } else {
                                alert(data);
                            }
                        },
                        error: function () {
                            alert('error handing here');
                        }
                    });
                });
                $('.nav-tabs > li a[title]').tooltip();
                //Wizard
                $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
                    var $target = $(e.target);
                    if ($target.parent().hasClass('disabled')) {
                        return false;
                    }
                });
               
               // ajax loader======
                $(document).ajaxStart(function(){
        $("#wait").css("display", "block");
    });
         $(document).ajaxComplete(function(){
                   $("#wait").css("display", "none");
                });                              
            });

            function nextTab(elem) {
                $(elem).next().find('a[data-toggle="tab"]').click();
            }
            function prevTab(elem) {
                $(elem).prev().find('a[data-toggle="tab"]').click();
            }
        </script>
        <style type="text/css">
            body{
                background:#eeeeee;
                background:url('../assets/assets/img/register_bg.jpg');
            }
            form{ 
                border-top:none;
                padding:10px;
             }
            .wizard {
                margin: 20px auto;
                background: #fff;
                max-width:700px;
                margin-top: 80px;
                border: 1px solid #5bc0de;	
                box-shadow: 1px 2px 5px;
            }
            .wizard .nav-tabs {
                position: relative;      
                margin-bottom: 0;
                border-bottom: none;
            }
            .wizard > div.wizard-inner {
                position: relative;		
            }
            .tab-content {
                max-width: 550px;
                margin: auto;
            }
            .wizard .nav-tabs > li.active > a, .wizard .nav-tabs > li.active > a:hover, .wizard .nav-tabs > li.active > a:focus {
                color: #555555;
                cursor: default;
                border: 0;
                border-bottom-color: transparent;
            }
            span.round-tab {
                width: 100%;
                height: 45px;
                line-height: 40px;
                display: inline-block;   
                background:  #22a1c4;   
                z-index: 2;
                position: absolute;
                left: 0;
                text-align: center;
                font-size: 20px;
                color:#fff;
            }
            span.round-tab i{
                color:#555555;
            }
            .wizard li.active span.round-tab {
                background: #fff;   
                border-bottom-left-radius:0px;
                border-bottom-right-radius:0px;
                border-top: 2px solid #22a1c4;
                color:#555555;
            }
            .wizard li.active span.round-tab i{
                color: #5bc0de;
            }
            span.round-tab:hover {
                color: #333;   
            }
            .wizard .nav-tabs > li {
                width: 33.33%;
            }
            .wizard .nav-tabs > li a {
                width: 100%;
                height: 40px;
                margin: 0px auto;   
                padding: 0;
            }
            .wizard .nav-tabs > li a:hover {
                background: transparent;
            }
            .wizard .tab-pane {
                position: relative;
                padding-top: 25px;
            }
            .wizard h3 {
                margin-top: 0;
            }
            .form-control{
                border-radius:0px;
                font-weight: 600;
            }
            .btn-next{
                background:#22a1c4;
                width: 200px;
                color:#fff;
                font-size:18px;
                font-weight:600;
                border-radius:0px;
            }
             .layer_bg{
                background:rgba(0,0,0,0.5);
                   height: calc(100vh - 0px);
                    bottom:0;
             }
        </style>		
    </head>
    <body class="register_bg">
        <div class="layer_bg">
        <div class="container">
            <div class="row">
                <section>
                 <div id="confirmmailfail" class="alert alert-danger" style="display:none; margin-top:15px;margin-bottom:20px;max-width:700px;margin-left: auto; margin-right: auto;">
                   <strong>Warning!</strong> user is not available with given email.
                   </div>
                    <div id="confirmmail" class="alert alert-success" style="display:none; margin-top:15px;margin-bottom:20px;max-width:700px;margin-left: auto; margin-right: auto;">
                     <strong>Success!</strong> please check mail for Reset Password Code.
                     </div>
                    <div id="confirmcode" class="alert alert-success" style="display:none; margin-top:15px;margin-bottom:20px;max-width:700px;margin-left: auto; margin-right: auto;">
                     <strong>Success!</strong> You have successfully confirmed your mail id, now enter new password for your coolacharya account.
                     </div>
                     <div id="confirmcodefail" class="alert alert-danger" style="display:none; margin-top:15px;margin-bottom:20px;max-width:700px;margin-left: auto; margin-right: auto;">
                   <strong>Warning!</strong>You have entered wrong confirmation code, please check and re-enter again.
                   </div>
                    <div class="wizard">
                        <div id="wait" style="display:none;width:69px;height:89px;border:1px solid black;position:absolute;top:50%;left:50%;padding:2px;"> <img src="<?php echo base_url(); ?>assets/assets/img/default.gif" width="64" height="64" /><br>Loading..</div>
                        <div class="wizard-inner">
                            <div class="connecting-line"></div>                            
                            <ul class="nav nav-tabs" role="tablist">
                                <li id="listep1" role="presentation" class="active">
                                    <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Enter Your Mail Id">
                                        <span class="round-tab">
                                            Enter your email ID <i class="fa fa-angle-double-right"></i>
                                        </span>
                                    </a>
                                </li>
                                <li id="listep2" role="presentation" class="disabled">
                                    <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Confirm it's you">
                                        <span class="round-tab">
                                            Confirm it's you  <i class="fa fa-angle-double-right"></i>
                                        </span>
                                    </a>
                                </li>                   
                                <li id="listep3" role="presentation" class="disabled">
                                    <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Get you New Password">
                                        <span class="round-tab">
                                            Get your new password 
                                        </span>
                                    </a>
                                </li>                    
                            </ul>
                        </div>
                        <form role="form">
                            <div class="tab-content">
                                <div class="tab-pane active" role="tabpanel" id="step1">
                                    <h3>Enter mail id and continue</h3>
                                    <div class="form-group">
                                        <input type="text" name="email_id" id="email_id"  required class="form-control"  placeholder="Enter your mail Id">
                                    </div>
                                    <ul class="list-inline pull-right">
                                        <li><button type="button" id="btn_verify_email" class="btn btn-next next-step"> Next >> </button></li>
                                    </ul>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step2">
                                    <h3>Enter Confirmation Code</h3>
                                    <div class="form-group">
                                        <input type="text" id="txt_resetpassword_code" class="form-control"  placeholder="Enter confirmation code">
                                    </div>
                                    <ul class="list-inline pull-right">                        
                                        <li><button type="button" id="btn_verify_code" class="btn btn-next next-step"> Next >> </button></li>
                                    </ul>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step3">
                                    <h3>Enter Confirmation Code</h3>
                                    <div class="form-group">
                                        <input type="password" id="password" class="form-control"  placeholder="Enter new password">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" id="re_password" class="form-control"  placeholder="Confirm new password">
                                    </div>
                                    <ul class="list-inline pull-right">   
                                        <li>
                                            <button type="button" id="btn_save_password"  class="btn btn-next btn-info-full next-step"> Change Password</button>
                                        </li>       
                                    </ul>
                                </div>                   
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
        </div>      
    </body>
</html>
