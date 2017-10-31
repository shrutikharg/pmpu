<!----- 

Name of File:register_form.php
Date Of Creation:1st Dec 2015
Created By :Shridhar K. Sawant.
Purpose of file:registeration form with selected hosting plan

Update file History :

Copyright(C)  2015-2016 Coolacharya.com All rights Reserved.
----->
<!DOCTYPE html> 
<html lang="en-US">
    <head>
        <title>Sign Up Page of E-Learning</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/css/style.css">
        <link href="<?php echo base_url(); ?>assets/assets/css/form.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/assets/css/responsive.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>
            var status;
            var error = false;
            $(document).ready(function () {
                $("#status").hide();
                $("#register_form").submit(function (evnt) {
                    var datastring = $("#register_form").serialize();
                    evnt.preventDefault();

                    var first_name = $('#first_name').val();
                    var last_name = $('#last_name').val();
                    var comp_name = $('#comp_name').val();

                    //alert ($('#scn_no').val());
                    var email_address = $('#email_address').val();
                    var password = $('#password').val();

                    //alert($('#datepicker').val());
                    //alert(company);
                    // var message = $('#message').val();
                    // alert(message);
                    // Form field validation
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
                        error = true;
                        //alert("error");
                        $("#comp_name").addClass("error2");
                    }


                    if (email_address.length == 0 || email_address.indexOf('@') == '-1') {
                        error = true;
                        $("#email_address").addClass("error2");
                    }






                    if (error === false) {

                        $.ajax({
                            type: "POST",
                            url: "../../admin_company/create_member",
                            data: datastring,
                            dataType: "text",
                            success: function (data) {
                                $('#register_form')[0].reset();
                                $("#status").show();
                            },
                            error: function () {
                                alert('error handing here');
                            }
                        });
                    }
                });

            });




        </script>

    </head>
    <body class="bg">
        <div class="container">
            <div class="row">

                <div class="well col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                    <div id="status" class="alert alert-success">
                        <a  class="close" data-dismiss="alert"> X </a>
                        <strong>Well done!</strong> Your Account created Sucessfully
                    </div>
                    <?php
                    echo validation_errors();
                    $attributes = array('class' => 'form', 'id' => "register_form");

                    echo form_open('admin_company/create_member', $attributes);
                    echo '<h2 class="form-signin-heading"> Sign Up </h2>';
                    echo "<hr class='colorgraph2'><div class='form-group'>";

                    $first_name = array(
                        'name' => 'first_name',
                        'id' => 'first_name',
                        'class' => 'form-control input-lg',
                        'Placeholder' => 'First Name',
                    );
                    echo "<div class='form-group'>";
                    echo form_input($first_name);
                    echo "</div>";


                    $last_name = array(
                        'name' => 'last_name',
                        'id' => 'last_name',
                        'class' => 'form-control input-lg',
                        'Placeholder' => 'Last Name',
                    );
                    echo "<div class='form-group'>";
                    echo form_input($last_name);
                    echo "</div>";

                    $web_address = array(
                        'name' => 'web_address',
                        'id' => 'web_address',
                        'class' => 'form-control input-lg',
                        'Placeholder' => 'Web Address',
                    );
                    echo "<div class='form-group'>";
                    echo form_input($web_address);
                    echo "</div>";

                    $comp_name = array(
                        'name' => 'comp_name',
                        'id' => 'comp_name',
                        'class' => 'form-control input-lg',
                        'Placeholder' => 'Company Name',
                    );
                    echo "<div class='form-group'>";
                    echo form_input($comp_name);
                    echo "</div>";

                    $email_address = array(
                        'name' => 'email_address',
                        'id' => 'email_address',
                        'class' => 'form-control input-lg',
                        'Placeholder' => 'Email Address',
                    );
                    echo "<div class='form-group'>";
                    echo form_input($email_address);
                    echo "</div>";

                    $password = array(
                        'name' => 'password',
                        'id' => 'password',
                        'class' => 'form-control input-lg',
                        'Placeholder' => 'Password',
                        'required' => 'required'
                    );
                    echo "<div class='row'><div class='col-xs-6 col-sm-6 col-md-6'><div class='form-group'>";
                    echo form_password($password);
                    echo "</div></div>";


                    $password2 = array(
                        'name' => 'password2',
                        'id' => 'password2',
                        'class' => 'form-control input-lg',
                        'Placeholder' => 'Confirm Password',
                    );
                    echo "<div class='col-xs-6 col-sm-6 col-md-6'><div class='form-group'>";
                    echo form_password($password2);
                    echo "</div></div></div>";

                    echo "</p>";


//echo form_input('', set_value('username'), 'placeholder="Username"');
//echo form_password('password', '', 'placeholder="Password"');
//echo form_password('password2', '', 'placeholder="Password confirm"');

                    echo "<hr class='colorgraph2'><div class='row'>";
                    echo "<div class='col-xs-6 col-md-6'>";
                    echo form_submit('submit', 'submit', 'id="submit"', 'class="btn btn-large btn-primary"');
                    echo"</div>";
                    echo "<div class='col-xs-6 col-md-6'><a href='#' class='btn btn-success btn-block btn-lg'>Reset</a></div>";
                    echo "</div>";
                    ?>
                    <?php
//var_dump($hostingplanselect);
                    ?>
                    <input type="hidden" name="planid" value="<?php
                    if (count($hostingplanselect) > 0) {
                        echo $hostingplanselect;
                    } else {
                        echo $this->uri->segment(3);
                    }
                    ?>">

                    <?php
//echo form_submit('submit', 'submit', 'class="btn btn-large btn-primary"');
                    echo form_close();
                    ?>

                </div>
            </div>

        </div>

    </body>