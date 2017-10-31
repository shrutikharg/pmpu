<?php

/*
 * by-Shrutikharge
 * function-generated mail format to seng to collachaya support team
 * input:-subject,mail_content
 * output:returns format for mail to send support team
 */

function create_admin_support_mail($user_details, $post_data) {
    $message = "Hello Coolacharya Support team";
    $message .="\n";
    $message .="This mail is sent by " . $user_details->comp_name;
    $message .="\n";
    $message .="They have following query";
    $message .="\n";
    $message .=$post_data['description'];
    //  $message.="Dear User,\nPlease click on below URL or paste into your browser to verify your Email Address\n\n http://coolacharya.com/companyadminapp1/verify?user=".$username."&active_link=".sha1($activation_code)."\n"."\n\nThanks\nAdmin Team";
    return (object) array('message' => $message, 'from' => $user_details->email, 'from_alias' => $user_details->comp_name);
}

function create_user_format($email, $username, $subscribe_link, $from) {
    $subject = 'Registered Successfully';
    $from_alias=$from . " Team";
    $message = "Hello $username";
    $message .="\n";
    $message .='Glad to have you on PMIPUNE.';
    $message .="\n";
    $message .=' Thank you for registering with us. Your account has been successfully created. You can now subscribe to any course of your choice on the CoolAcharya portal via our payment gateway.';
    $message .="\n";
    $message.='Click here to go<ins> ' . $subscribe_link.'</ins>';
    $message .="\n";
    $message.='Regards';
    $message .="\n";
    $message.=$from;
    return (object) array('message' => $message, 'from_alias' => $from_alias, 'subject' => $subject);
}

function user_subscription_success_mail_format($email, $username,$password,$subscription_link, $from) {
    $subject = 'Subscribed Successfully';
    $from_alias=$from . " Team";
    $message = "Hello $username";
    $message .="\n";
    $message .='Glad to have you on PMIPUNE.';
    $message .="\n";
    $message .="Follow this link  $subscription_link   to start your course ";
    $message .="\n";
    $message .="Email:<ins>" . $email.'</ins>';
    $message .="\n";
    $message .="Password:<ins>" . $password.'</ins>';
    $message .="\n";
    $message .='Use the above credentials to login and access the dashboard and course.';
    $message .="\n";
    $message.='Regards';
    $message .="\n";
    $message.=$from;
    //  $message.="Dear User,\nPlease click on below URL or paste into your browser to verify your Email Address\n\n http://coolacharya.com/companyadminapp1/verify?user=".$username."&active_link=".sha1($activation_code)."\n"."\n\nThanks\nAdmin Team";
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
    $message .="\n";
    $message .='Glad to have you on CoolAcharya.';
    $message .="\n";
    $message .="Follow this link  $login_link   to upload your course";
    $message .="\n";
    $message .="Email: " . $username;
    $message .="\n";
    $message .="Password: " . $password;
    $message .="\n";
    $message .='Use the above credentials to login and access the dashboard and course.';
    $message .="\n";
    //$message.="Dear User,\nPlease click on below URL or paste into your browser to verify your Email Address\n\n http://coolacharya.com/companyadminapp1/verify?user=".$username."&active_link=".sha1($activation_code)."\n"."\n\nThanks\nAdmin Team";
    return (object) array('message' => $message, 'from' => $from, 'from_alias' => $from_alias, 'subject' => $subject);
}

function create_company_format($username, $password, $login_link) {


    $activation_code = activation_code();
    $from = 'info@coolacharya.com';
    $from_alias = "Coolacharya  Team";
    $subject = "coolacharya.com - Admin Registered Successfully";
    $message = "Hello $username";
    $message .="\n";
    $message .='Glad to have you on CoolAcharya.';
    $message .="\n";
    $message .="Follow this link  $login_link   to upload your course";
    $message .="\n";
    $message .="Email: " . $username;
    $message .="\n";
    $message .="Password: " . $password;
    $message .="\n";
    $message .='Use the above credentials to login and access the dashboard and course.';
    $message .="\n";
    //$message.="Dear User,\nPlease click on below URL or paste into your browser to verify your Email Address\n\n http://coolacharya.com/companyadminapp1/verify?user=".$username."&active_link=".sha1($activation_code)."\n"."\n\nThanks\nAdmin Team";
    return (object) array('message' => $message, 'from' => $from, 'from_alias' => $from_alias, 'subject' => $subject);
}

function create_forgot_password_format($email) {
    $reset_password_code = create_code();
    $from = 'info@coolacharya.com';
    $from_alias = "Coolacharya  Team";
    $subject = "coolacharya.com -Reset Password Code";
    $message = "Hello $email";
    $message .="\n";
    $message .='Please enter follwoing code to change password';
    $message .="\n";
    $message .="Reset Password Code:" . $reset_password_code;
    $message .="\n";
    $message .="Thank You";

    //$message.="Dear User,\nPlease click on below URL or paste into your browser to verify your Email Address\n\n http://coolacharya.com/companyadminapp1/verify?user=".$username."&active_link=".sha1($activation_code)."\n"."\n\nThanks\nAdmin Team";
    return (object) array('message' => $message, 'from' => $from, 'from_alias' => $from_alias, 'subject' => $subject, 'reset_password_code' => $reset_password_code);
}

function course_assgnment_format($username, $course_name) {


    $message = "Hello $username";
    $message .="\n";
    $message .='Glad to have you on CoolAcharya.';
    $message .="\n";
    $message .="$course_name has Assigned to you";
    $message .="\n";
    $message .='Follow this link http://coolacharya.com/companyadminapp/employee  to start your course assignment.';
    return $message;
}

function employee_support_mail_format($user_email, $subject, $description) {
    $from = '$user_email';
    $from_alias = "Coolacharya  Team";
    $subject = $subject;
    $message = "Hello Admin";
    $message .="\n";
    $message .='Sender has send message through coolacharya portal as following';
    $message .="\n";
    $message .=$description;
    $message .="\n";
    $message .="Thank You";
    return (object) array('message' => $message, 'from' => $from, 'from_alias' => $from_alias, 'subject' => $subject, 'reset_password_code' => $reset_password_code);
}
