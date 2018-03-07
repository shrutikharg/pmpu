<!DOCTYPE html> 
<html lang="en-US">
    <head>
        <title>Sign Up Page of E-Learning</title>
        <meta charset="utf-8">
        <link href="favicon.ico" rel="shortcut icon" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/css/style.css">
        <link href="<?php echo base_url(); ?>assets/assets/css/form.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/assets/css/responsive.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>
            var status;
            var error =false;
            $(document).ready(function () {
                if($("#plan_id").val()==''){
                    window.location.href="<?php echo base_url().'admin_company/signup'?>";
                }
                $("#submit").submit(function (evnt) {
                   
                    
                    var first_name = $('#first_name').val();
                    var last_name = $('#last_name').val();
                    var comp_name = $('#comp_name').val();
                  
                    var email_address = $('#email_address').val();
                    var password = $('#password').val();
            
                    if (first_name.length == 0) {
                        error = true;
                        //alert("error");
                        $("#first_name").addClass("error2");
                    }
                    if (last_name.length == 0) {
                        error = true;
                        //alert("error");
                        $("#last_name").addClass("error2");
                    }
                    if (comp_name.length == 0) {
                        error = true;   //alert("error");
                        $("#comp_name").addClass("error2");
                    }
                    if (email_address.length == 0 || email_address.indexOf('@') == '-1') {
                        error = true;
                        $("#email_address").addClass("error2");
                    }
              
                    if (error === false) {  $("#register_form")[0].submit();
                        /*$.ajax({
                            type: "POST",
                            url: "../admin_company/create_member",
                            data: datastring,
                            dataType: 'json',
                            success: function (data) {
                                if (data.status === 'Success') {
                                    $('#preloader').hide();
                                    $('#register_form')[0].reset();
                                    $("#status").css("display", "block");
                                    $("#status").html("<strong>Congratulation!</strong> Your Account created Sucessfully");
                                    var form = $(document.createElement('form'));
                                    $(form).attr("action", "../admin_company");
                                    $(form).attr("method", "POST");
                                    $(form).attr("id", "form1");                                   
                                    $(form).delay(5000);
                               
                                }
                                    if (data.status === 'Validation_Error') {
                                    
                                    $('#preloader').hide();
                                    $("#status").css("display", "block");
                                    $("#status").html("<strong>Error!</strong>"+data.message);
                                    var form = $(document.createElement('form'));
                                    $(form).attr("action", "../admin_company");
                                    $(form).attr("method", "POST");
                                    $(form).attr("id", "form1");
                                
                                }
                                
                            },
                            error: function () {
                                $('#preloader').hide();
                                alert('error handing here');
                            }
                        });*/
                    }
                });
                
                (function($) {
                    var tabs =  $(".tabs li a");
                    tabs.click(function() {
                          var panels = this.hash.replace('/','');
                          tabs.removeClass("active");
                          $(this).addClass("active");
                          $("#panels > div").hide();
                          $(panels).fadeIn(200);
                    });
                })(jQuery);
            });
        </script>
        <style type="text/css">
            .layer_bg{
                background:rgba(0,0,0,0.5);
                   min-height: calc(100vh - 0px);
                    bottom:0;
            }
            
            ul.tabs {
                /*width: 600px;*/
                height: 80px;
                margin: 0 auto;
                list-style: none;
                overflow: hidden;
                padding: 0;
              }

              ul.tabs li {
                float: left;
                width: 50%;
              }

              ul.tabs li a {
                position: relative;
                display: block;
                height: 38px;
                margin-top: 40px;
                padding: 10px 0 0 0;
                font-family: 'Open Sans', sans-serif;
                font-size: 18px;
                text-align: center;
                text-decoration: none;
                color: #ffffff;
                background: #1abc9c;
                -webkit-box-shadow: 8px 12px 25px 2px rgba(0,0,0,0.4);
                -moz-box-shadow: 8px 12px 25px 2px rgba(0,0,0,0.4);
                box-shadow: 8px 12px 25px 2px rgba(0,0,0,0.4);
                border: 0px solid #000000;
                -webkit-transition: padding 0.2s ease, margin 0.2s ease;
                -moz-transition: padding 0.2s ease, margin 0.2s ease;
                -o-transition: padding 0.2s ease, margin 0.2s ease;
                -ms-transition: padding 0.2s ease, margin 0.2s ease;
                transition: padding 0.2s ease, margin 0.2s ease;
              }

              .tabs li:first-child a {
                z-index: 3;
                -webkit-border-top-left-radius: 8px;
                -moz-border-radius-topleft: 8px;
                border-top-left-radius: 8px;
              }

              .tabs li:nth-child(2) a { z-index: 2; }

              .tabs li:last-child a {
                z-index: 1;
                -webkit-box-shadow: 2px 8px 25px -2px rgba(0,0,0,0.3);
                -moz-box-shadow: 2px 8px 25px -2px rgba(0,0,0,0.3);
                box-shadow: 2px 8px 25px -2px rgba(0,0,0,0.3);
                -webkit-border-top-right-radius: 8px;
                -moz-border-radius-topright: 8px;
                border-top-right-radius: 8px;
              }

              ul.tabs li a:hover {
                margin: 35px 0 0 0;
                padding: 10px 0 5px 0;
              }

              ul.tabs li a.active {
                margin: 30px 0 0 0;
                padding: 10px 0 10px 0;
                background: #0bf7d6;
                color: #D3FEF5;
                z-index: 4;
                outline: none;
              }

              .group:before,
              .group:after {
                content: " "; /* 1 */
                display: table; /* 2 */
              }

              .group:after { clear: both; }

              #panels {
                /*width: 600px;*/
                //height: 300px;
                margin: 0 auto;
                background: #f2f2f2;
/*                -webkit-box-shadow: 2px 8px 25px -2px rgba(0,0,0,0.3);
                -moz-box-shadow: 2px 8px 25px -2px rgba(0,0,0,0.3);
                box-shadow: 2px 8px 25px -2px rgba(0,0,0,0.3);*/
                -webkit-border-bottom-right-radius: 8px;
                -webkit-border-bottom-left-radius: 8px;
                -moz-border-radius-bottomright: 8px;
                -moz-border-radius-bottomleft: 8px;
                border-bottom-right-radius: 8px;
                border-bottom-left-radius: 8px;
              }

              #panels p {
                font-family: 'Open Sans', sans-serif;
                padding: 30px 40px;
                color: #ffffff;
                line-height: 26px;
                font-size: 18px;
                margin: 0;
              }

              #interest { display: none; }
              a.disable {
                background-color: #999999;
              }
        </style>
    </head>
    <body class="register_bg">
        <div class="layer_bg">
        <div class="container"> 
            <div id="preloader" style="position: fixed; left: 0; top: 0; z-index: 999; width: 100%; height: 100%; overflow: visible; background: #333 url('http://files.mimoymima.com/images/loading.gif') no-repeat center center;opacity: 0.7;display: none;"></div>
            <div class="row">
                <div class="well col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3" style="margin-top:75px;">
                    <div id="status" style="display:none" class="alert alert-success">
                    </div>
                    <?php
                    echo validation_errors();
                    $attributes = array('class' => 'form', 'id' => "register_form");
                    echo form_open('admin_company/create_member', $attributes);
                    echo '<h2 class="form-signin-heading"> Sign Up </h2>';
                    echo "<hr class='colorgraph2'><div class='form-group'>";
                    echo "<div class='wrap'>
                        <ul class='tabs group'>
                                <li>
                                    <a class='active' href='#/general'>Personal Infomation</a>
                                </li>
                                <li>
                                    <a href='#/interest'>Interest</a>
                                </li>
                        </ul>";
                    echo "<div id='panels'><div id='general'>";
                    $first_name = array(
                        'name' => 'first_name',
                        'id' => 'first_name',
                        'class' => 'form-control input-lg',
                        'Placeholder' => 'First Name',
                        'required' => 'required',
                        'value'=>set_value('first_name')
                       
                    );
                    echo "<div class='form-group'>";
                    echo form_input($first_name);
                    echo "</div>";
                    $last_name = array(
                        'name' => 'last_name',
                        'id' => 'last_name',
                        'class' => 'form-control input-lg',
                        'Placeholder' => 'Last Name',
                        'required' => 'required',
                        'value'=>set_value('last_name')
                    );
                    echo "<div class='form-group'>";
                    echo form_input($last_name);
                    echo "</div>";
                    $web_address = array(
                        'name' => 'web_address',
                        'id' => 'web_address',
                        'class' => 'form-control input-lg',
                        'Placeholder' => 'Web Address',
                        'required' => 'required',
                        'value'=>set_value('web_address')
                    );
                    echo "<div class='form-group'>";
                    echo form_input($web_address);
                    echo "</div>";
                    $comp_name = array(
                        'name' => 'comp_name',
                        'id' => 'comp_name',
                        'class' => 'form-control input-lg',
                        'Placeholder' => 'Company Name',
                        'required' => 'required',
                         'value'=>set_value('comp_name')
                    );
                    echo "<div class='form-group'>";
                    echo form_input($comp_name);
                    echo "</div>";
                    $domain_name = array(
                        'name' => 'domain_name',
                        'id' => 'domain_name',
                        'class' => 'form-control input-lg',
                        'Placeholder' => 'Sub Domain Name',
                        'required' => 'required',
                         'value'=>set_value('domain_name')
                    );
                    echo "<div class='form-group'>";
                    echo form_input($domain_name);
                    echo "</div>";
                    $email_address = array(
                        'name' => 'email_address',
                        'id' => 'email_address',
                        'class' => 'form-control input-lg',
                        'Placeholder' => 'Email Address',
                        'type' => 'email',
                        'autocomplete' => 'off',
                        'required' => 'required',
                          'value'=>set_value('email_address')
                    );
                    echo "<div class='form-group'>";
                    echo form_input($email_address);
                    echo "</div>";
                    $password = array(
                        'name' => 'password',
                        'id' => 'password',
                        'class' => 'form-control input-lg',
                        'Placeholder' => 'Password',
                        'type' => 'email',
                        'required' => 'required',
                         'value'=>set_value('password')
                    );
                    echo "<div class='row'><div class='col-xs-6 col-sm-6 col-md-6'><div class='form-group'>";
                    echo form_password($password);
                    echo "</div></div>";
                    $password2 = array(
                        'name' => 'passconf',
                        'id' => 'passconf',
                        'class' => 'form-control input-lg',
                        'Placeholder' => 'Confirm Password',
                        'required' => 'required',
                         'value'=>set_value('passconf')
                    );
                    echo "<div class='col-xs-6 col-sm-6 col-md-6'><div class='form-group'>";
                    echo form_password($password2);
                    echo "</div>";
                   
                    echo "<div class='col-xs-6 col-sm-6 col-md-6'><div class='form-group'>";
                    echo form_hidden('plan_id',$selected_plan_id,'id="plan_id",required = "required"');
                    echo "</div>";
                    echo "</div></div>";
                    echo "</p>";
                    echo "<hr class='colorgraph2'>";
                    echo "<div class='row'>";
                    echo "<div class='col-xs-6 col-md-6'><a id='validate' class='btn btn-success btn-block btn-lg'>Validate Details</a></div>";?>
                    <div class="col-xs-6 col-md-6"><a onclick="javascript: $('.tabs li a').trigger('click');" id="next" href="#/interest" class="btn btn-success btn-block btn-lg">Save & Next</a></div>                            <?php
                    echo "</div>";
                    echo "</div></div><div id='interest'>";
                    
                    echo "<div class='form-group'>";
                    echo "<h3>Type Of Event</h3>";
                    echo "</div>";
                    
                    $options = array(
                        '' => 'select Event',
                        'conference' => 'Conference',
                        'seminar' => 'Seminar',                        
                        'Team Building Events' => 'Team Building Events',
                        'Trade Shows' => 'Trade Shows',
                        'Networking Events' => 'Networking Events',
                        'Opening Ceremonies' => 'Opening Ceremonies',
                        'Product Launches' => 'Product Launches',
                        'Theme Parties' => 'Theme Parties',
                        'Award Ceremonies' => 'Award Ceremonies',
                        'Weddings' => 'Weddings',
                        'Birthdays' => 'Birthdays',
                        'Wedding Anniversaries' => 'Wedding Anniversaries',
                        'Family Events' => 'Family Events'
                    );
                    $selectVal = '';
                    echo "<div class='form-group'>";
                    echo form_dropdown('typeofevents', $options, set_value('typeofevents'), 'id="typeofevents" class="form-control input-lg"');
                    echo "</div>";
                    
                    echo "<div class='row'>";
                    echo "<div class='col-xs-6 col-md-6'><a id='reset' class='btn btn-success btn-block btn-lg'>Reset</a></div>";
                    echo "<div class='col-xs-6 col-md-6'>";
                    echo form_submit('submit', 'Submit', 'id="submit" class="btn btn-lg btn-block btn-primary"');
                    echo"</div>";
                    echo "</div></div></div>";
                    ?>
                    <?php
                    //var_dump($hostingplanselect);
                    ?>
                    <?php
                    echo form_close();
                    ?>
                </div>
            </div>
        </div>
        </div>
        <script type="text/javascript">
            $('#register_form').each(function () {
                this.reset();
            });
            // Match Confirm Password with password field javascript code
            var password = document.getElementById("password"), passconf = document.getElementById("passconf");

            function validatePassword() {
                if (password.value !== passconf.value) {
                    passconf.setCustomValidity("Passwords Don't Match");
                } else {
                    passconf.setCustomValidity('');
                }
            }
            password.onchange = validatePassword;
            passconf.onkeyup = validatePassword;
                 //avoid (Cut,copy and paste) in password and confirm passwor textbox ---
            $(document).ready(function () {
                $('#password,#passconf').bind("cut copy paste", function (e) {
                    e.preventDefault();
                });
                $('#reset').click(function(){
                    $('#register_form')[0].reset();
                    $('.tabs li a:eq(0)').trigger('click');
                })
            });           
            
         // Input field custom validation message
            document.addEventListener("DOMContentLoaded", function() {
                    var mailvalidate = document.getElementById("email_address");

                   mailvalidate.oninvalid = function(e) {
                       e.target.setCustomValidity("");
                       if (!e.target.validity.valid) {
                           e.target.setCustomValidity("Please Enter Valid Email Address");
                          }
                   };
                  mailvalidate.oninput = function(e) {
                       e.target.setCustomValidity("");
                   };   
              });
              
              $('.tabs li:last-child a, #next').css('pointer-events', 'none');
              $('#next').addClass('disable');
              $('#validate').unbind('click').bind('click', function(){
                  validateTab();
              });
              function validateTab() {
                var first_name = $('#first_name').val();
                var last_name = $('#last_name').val();
                var web_address = $('#web_address').val();
                var cmp_name = $('#comp_name').val();
                var domain_name = $('#domain_name').val();
                var email_address = $('#email_address').val();
                var password = $('#password').val();
                var passconf = $('#passconf').val();

                if(first_name == '' || last_name == '' || web_address == '' || cmp_name == '' || domain_name == '' || email_address == '' || password == '' || passconf == '')
                        alert('please Enter All Fields');
                else if (password !== passconf) {
                    alert("Passwords Don't Match");
                } else {
                    alert('Verified Successfully');
                    $('.tabs li:last-child a, #next').css('pointer-events', 'all');
                    $('#next').removeClass('disable');
                }
            }
        </script>          
    </body>
</html>