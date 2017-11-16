<?php

/*
 * by-Shrutikharge
 * function-generated mail format to seng to collachaya support team
 * input:-subject,mail_content
 * output:returns format for mail to send support team
 */

function create_admin_support_mail($user_details, $post_data) {
    $message = "<b>Hello Coolacharya Support team</b>";
    $message .="<br>";
    $message .="This mail is sent by <b> $user_details->comp_name </b>";
    $message .="<br>";
    $message .="They have following query";
    $message .="<br>";
    $message .="<span style='color:blue'>".$post_data['description']."</span>";
    //  $message.="Dear User,\nPlease click on below URL or paste into your browser to verify your Email Address\n\n http://coolacharya.com/companyadminapp1/verify?user=".$username."&active_link=".sha1($activation_code)."<br>"."\n\nThanks\nAdmin Team";
    return (object) array('message' => $message, 'from' => $user_details->email, 'from_alias' => $user_details->comp_name);
}

function create_user_format($email, $username, $subscribe_link, $company_details) {
    $subject = 'Registered Successfully';
    $from_alias = $company_details->name . " Team";
    $message = "Hello <b>$username </b>,";
    $message .="<br>";
    ;
    $message .="Glad to have you on $company_details->name.";
    $message .="<br>";
    $message .=' Thank you for registering with us. Your account has been successfully created. You can now subscribe to any course of your choice on the CoolAcharya portal via our payment gateway.';
    $message .="<br>";
    $message.="Click here to go <ins><a href=$subscribe_link>$subscribe_link </a></ins>";
    $message .="<br>";
    ;
    $message.="<b>Regards,</b>";
    $message .="<br>";
    $message.="<b>$from</b>";
    return (object) array('message' => $message, 'from_alias' => $from_alias, 'subject' => $subject);
}

function user_subscription_success_mail_format($email, $username, $password, $subscription_link, $from, $transaction_id,$company_name) {
    $subject = 'Subscribed Successfully';
    $from_alias = $from . " Team";
    $message = "<b> Hello $username</b> ,";
    $message .="<br>";
    $message .="Glad to have you on $company_name.";
    $message .="<br>";
    $message .="Follow this link <ins> <a href=$subscription_link>$subscription_link </a></ins>  to start your course ";
    $message .="<br>";
    $message .="Email:<b>  $email </b>";
    $message .="<br>";
    $message .="Password:<b> $password </b>";
    $message .="<br>";
    $message .="Transaction_id:<b>$transaction_id </b>";
    $message .="<br>";
    $message .='Use the above credentials to login and access the dashboard and course.';
    $message .="<br>";
    $message.="<b>Regards,</b>";
    $message .="<br>";
    $message.="<b>$from</b>";
    //  $message.="Dear User,\nPlease click on below URL or paste into your browser to verify your Email Address\n\n http://coolacharya.com/companyadminapp1/verify?user=".$username."&active_link=".sha1($activation_code)."<br>"."\n\nThanks\nAdmin Team";
    return (object) array('message' => $message, 'from_alias' => $from_alias, 'subject' => $subject);
}

function create_code() {
    $code = '';
    $keys = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
    for ($i = 0; $i < 8; $i++) {
        $code .= $keys[array_rand($keys)];
    }
    return $code;
}

function activation_code() {

    return uniqid(mt_rand(), true);
}

function create_admin_format($username, $password, $login_link) {
    $CI = & get_instance();

    $activation_code = activation_code();


    $activation_code = activation_code();
    $from = 'info@coolacharya.com';
    $from_alias = "Coolacharya  Team";
    $subject = "coolacharya.com - Admin Registered Successfully";
    $message = "Hello $username";
    $message .="<br>";
    $message .='Glad to have you on CoolAcharya.';
    $message .="<br>";
    $message .="Follow this link  $login_link   to upload your course";
    $message .="<br>";
    $message .="Email: " . $username;
    $message .="<br>";
    $message .="Password: " . $password;
    $message .="<br>";
    $message .='Use the above credentials to login and access the dashboard and course.';
    $message .="<br>";
    //$message.="Dear User,\nPlease click on below URL or paste into your browser to verify your Email Address\n\n http://coolacharya.com/companyadminapp1/verify?user=".$username."&active_link=".sha1($activation_code)."<br>"."\n\nThanks\nAdmin Team";
    return (object) array('message' => $message, 'from' => $from, 'from_alias' => $from_alias, 'subject' => $subject);
}

function create_company_format($username, $password, $login_link) {


    $activation_code = activation_code();
    $from = 'info@coolacharya.com';
    $from_alias = "Coolacharya  Team";
    $subject = "coolacharya.com - Admin Registered Successfully";
    $message = "Hello $username";
    $message .="<br>";
    $message .='Glad to have you on CoolAcharya.';
    $message .="<br>";
    $message .="Follow this link  $login_link   to upload your course";
    $message .="<br>";
    $message .="Email: " . $username;
    $message .="<br>";
    $message .="Password: " . $password;
    $message .="<br>";
    $message .='Use the above credentials to login and access the dashboard and course.';
    $message .="<br>";
    //$message.="Dear User,\nPlease click on below URL or paste into your browser to verify your Email Address\n\n http://coolacharya.com/companyadminapp1/verify?user=".$username."&active_link=".sha1($activation_code)."<br>"."\n\nThanks\nAdmin Team";
    return (object) array('message' => $message, 'from' => $from, 'from_alias' => $from_alias, 'subject' => $subject);
}

function create_forgot_password_format($email) {
    $reset_password_code = create_code();
    $from = 'info@coolacharya.com';
    $from_alias = "Coolacharya  Team";
    $subject = "coolacharya.com -Reset Password Code";
    $message = "Hello $email";
    $message .="<br>";
    $message .='Please enter follwoing code to change password';
    $message .="<br>";
    $message .="Reset Password Code:" . $reset_password_code;
    $message .="<br>";
    $message .="Thank You";

    //$message.="Dear User,\nPlease click on below URL or paste into your browser to verify your Email Address\n\n http://coolacharya.com/companyadminapp1/verify?user=".$username."&active_link=".sha1($activation_code)."<br>"."\n\nThanks\nAdmin Team";
    return (object) array('message' => $message, 'from' => $from, 'from_alias' => $from_alias, 'subject' => $subject, 'reset_password_code' => $reset_password_code);
}

function course_assgnment_format($username, $course_name) {


    $message = "Hello $username";
    $message .="<br>";
    $message .='Glad to have you on CoolAcharya.';
    $message .="<br>";
    $message .="$course_name has Assigned to you";
    $message .="<br>";
    $message .='Follow this link http://coolacharya.com/companyadminapp/employee  to start your course assignment.';
    return $message;
}

function employee_support_mail_format($user_email, $subject, $description,$company_details) {
    $from = $user_email;
    $from_alias = "$company_details->name Subscriber";
    $subject = $subject;
    $message = "<b>Hello Admin,</b>";
    $message .="<br>";
    $message .="This is mail from  <b>$user_email </b>";
    $message .="<br>";
    $message .='Sender has send message through coolacharya portal as following:';
    $message .="<br>";
    $message .="<span style='color:blue'><b>$description</b></span>";
    $message .="<br>";
    $message .="                  Thank You.";
    $message .="<br>";
    $message .="<br>";
    $message .="<br>";
    $message.="<b>Regards,</b>";
    $message .="<br>";
    $message.="<b>Coolacharya Team</b>";
    return (object) array('message' => $message, 'from' => $from, 'from_alias' => $from_alias, 'subject' => $subject, 'reset_password_code' => $reset_password_code);
}
