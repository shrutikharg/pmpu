<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
$route['default_controller'] = 'employeeuser/home';
$route['404_override'] = '';


/* Company  user admin Function Routers*/
$route['admin_company'] = 'companyuser/index';
$route['admin_company/signup'] = 'companyuser/signup';
$route['admin_company/login'] = 'companyuser/index';
$route['admin_company/logout'] = 'companyuser/logout';
$route['admin_company/request_password_reset'] = 'companyuser/request_password_reset';
$route['admin_company/verify_reset_password_code'] = 'companyuser/verify_reset_password_code';
$route['admin_company/change_password'] = 'companyuser/change_password';
$route['admin_company/get_hash'] = 'companyuser/get_hash';
$route['admin_company/verify'] = 'companyuser/verify_user';

$route['admin_company/login/validate_credentials'] = 'companyuser/validate_credentials';

$route['admin_company/register'] = 'companyuser/register';
$route['admin_company/create_member'] = 'companyuser/create_member';
$route['admin_company/apply_payment'] = 'companyuser/apply_payment_index';
$route['admin_company/payment_subscribe'] = 'companyuser/payment_subscribe';
$route['admin_company/payment_success'] = 'companyuser/payment_success';
$route['admin_company/payment_failure'] = 'companyuser/payment_failure';


$route['admin_company/userprofile'] = 'admin_profile/userprofile';
$route['admin_company/pwdchange'] = 'admin_profile/pwdchange';



$route['admin_company/brandings'] = 'admin_companybrandings/index';
$route['admin_company/brandings/addtheme'] = 'admin_companybrandings/addtheme';

$route['admin_company/category'] = 'admin_companycategory/index';
$route['admin_company/category/list'] = 'admin_companycategory/category_list';
$route['admin_company/category/add'] = 'admin_companycategory/add';
$route['admin_company/category/update'] = 'admin_companycategory/update';

$route['admin_company/category/dropdown_list'] = 'admin_companycategory/category_dropdown_list';

$route['admin_company/category/delete/(:any)'] = 'admin_companycategory/delete/$1';
$route['admin_company/category/search_by_name'] = 'admin_companycategory/search_by_name'; //$1 = page number


$route['admin_company/cmspage'] = 'admin_companycmspage/index';
$route['admin_company/cmspage/add'] = 'admin_companycmspage/add';
$route['admin_company/cmspage/update'] = 'admin_companycmspage/update';

$route['admin_company/speaker'] = 'admin_companyspeaker/index';
$route['admin_company/speaker/list'] = 'admin_companyspeaker/speaker_list';
$route['admin_company/speaker/add'] = 'admin_companyspeaker/add';
$route['admin_company/speaker/update'] = 'admin_companyspeaker/update';

$route['admin_company/day'] = 'admin_companyday/index';
$route['admin_company/day/list'] = 'admin_companyday/day_list';
$route['admin_company/day/add'] = 'admin_companyday/add';
$route['admin_company/day/update'] = 'admin_companyday/update';



$route['admin_company/cmspage/verifyUser'] = 'admin_companycmspage/verifyUser';


$route['admin_company/plantable'] = 'admin_companyplantable/index';
$route['admin_company/plantable/add'] = 'admin_companyplantable/add';
$route['admin_company/plantable/update'] = 'admin_companyplantable/update';
$route['admin_company/plantable/update/(:any)'] = 'admin_companyplantable/update/$1';
$route['admin_company/plantable/delete/(:any)'] = 'admin_companyplantable/delete/$1';
$route['admin_company/plantable/(:any)'] = 'admin_companyplantable/index/$1'; //$1 = page number

$route['admin_company/commenting'] = 'admin_companycommenting/index';
$route['admin_company/commenting/add'] = 'admin_companycommenting/add';
$route['admin_company/commenting/update'] = 'admin_companycommenting/update';
$route['admin_company/commenting/update/(:any)'] = 'admin_companycommenting/update/$1';
$route['admin_company/commenting/delete/(:any)'] = 'admin_companycommenting/delete/$1';
$route['admin_company/commenting/(:any)'] = 'admin_companycommenting/index/$1'; 
$route['admin_company/commenting/publishcomment/(:any)'] = 'admin_companycommenting/publishcomment/$1';


$route['admin_company/subcategory'] = 'admin_companysubcategory/index';
$route['admin_company/subcategory/list'] = 'admin_companysubcategory/subcategory_list';
$route['admin_company/subcategory/add'] = 'admin_companysubcategory/add';
$route['admin_company/subcategory/update'] = 'admin_companysubcategory/update';
$route['admin_company/subcategory/update/(:any)'] = 'admin_companysubcategory/update/$1';
$route['admin_company/subcategory/delete/(:any)'] = 'admin_companysubcategory/delete/$1';
$route['admin_company/subcategory/(:any)'] = 'admin_companysubcategory/index/$1'; //$1 = page number
$route['admin_company/subcategory/dropdown_list'] = 'admin_companysubcategory/subcategory_dropdown_list';
$route['admin_company/subcategory/search_by_name'] = 'admin_companysubcategory/search_by_name';

$route['admin_company/courses'] = 'admin_companycourses/index';
$route['admin_company/courses/list'] = 'admin_companycourses/course_list';
$route['admin_company/courses/add'] = 'admin_companycourses/add';
$route['admin_company/courses/update'] = 'admin_companycourses/update';
$route['admin_company/courses/update/(:any)'] = 'admin_companycourses/update/$1';
$route['admin_company/courses/activate/(:any)'] = 'admin_companycourses/activate/$1';
$route['admin_company/courses/delete/(:any)'] = 'admin_companycourses/delete/$1';
$route['admin_company/courses/(:any)'] = 'admin_companycourses/index/$1'; //$1 = page number
$route['admin_company/courses/dropdown_list'] = 'admin_companycourses/course_dropdown_list';
$route['admin_company/courses/search_by_name'] = 'admin_companycourses/search_by_name';
$route['admin_company/courses/set_user_comments']= 'admin_companycourses/set_user_chapter_comments';
$route['admin_company/courses/get_user_comments']= 'admin_companycourses/get_user_comments';
$route['admin_company/question_bank'] = 'admin_Companyquestionbank/index';
$route['admin_company/question_bank/list'] = 'admin_Companyquestionbank/questionbank_list';
$route['admin_company/question_bank/chapterquestion_list'] = 'admin_Companyquestionbank/chapterquestion_list';
$route['admin_company/question_bank/question_list'] = 'admin_Companyquestionbank/question_list';
$route['admin_company/question_bank/update_question_list'] = 'admin_Companyquestionbank/update_question_list';
$route['admin_company/question_bank/add'] = 'admin_Companyquestionbank/add';

$route['admin_company/quiz'] = 'admin_CompanyQuiz/index';
$route['admin_company/quiz/list'] = 'admin_CompanyQuiz/quiz_list';
$route['admin_company/quiz/get_question_from_questionbank'] = 'admin_CompanyQuiz/get_question_from_questionbank';
$route['admin_company/quiz/add'] = 'admin_CompanyQuiz/add';
$route['admin_company/quiz/update'] = 'admin_CompanyQuiz/update';
$route['admin_company/quiz/add_question'] = 'admin_CompanyQuiz/add_question';
$route['admin_company/quiz/question_list'] = 'admin_CompanyQuiz/question_list';




$route['admin_company/userassign/update'] = 'admin_companyuserassign/update';
$route['admin_company/employeelist'] = 'admin_companyuserassign/index';
$route['admin_company/employeelist/list'] = 'admin_companyuserassign/employee_list';
$route['admin_company/employee_details'] = 'admin_companyuserassign/employee_details';
$route['admin_company/employee_update'] = 'admin_companyuserassign/update';


$route['admin_company/brandings/startpageapp'] = 'admin_companybrandings/startpage_app';





$route['admin_company/coursesassign'] = 'admin_companycoursesassign/index';
$route['admin_company/coursesassign/list'] = 'admin_companycoursesassign/course_assign_list';
$route['admin_company/coursesassign/add'] = 'admin_companycoursesassign/add';
$route['admin_company/coursesassign/update'] = 'admin_companycoursesassign/update';
$route['admin_company/coursesassign/update/(:any)'] = 'admin_companycoursesassign/update/$1';
$route['admin_company/coursesassign/delete/(:any)'] = 'admin_companycoursesassign/delete/$1';
$route['admin_company/coursesassign/(:any)'] = 'admin_companycoursesassign/index/$1'; //$1 = page number
$route['admin_company/coursesassign/assignall'] = 'admin_companycoursesassign/assignall';
$route['admin_company/coursesassign/assignee'] = 'admin_companycoursesassign/assginee_index';
$route['admin_company/coursesassign/assignee_list'] = 'admin_companycoursesassign/assginee_list';
$route['admin_company/coursesassign/update_assignee_active_status'] = 'admin_companycoursesassign/update_assignee_active_status';

$route['admin_company/mycourses'] = 'admin_companymycourses/index';
$route['admin_company/mycourses/add'] = 'admin_companymycourses/add';
$route['admin_company/mycourses/update'] = 'admin_companymycourses/update';
$route['admin_company/mycourses/update/(:any)'] = 'admin_companymycourses/update/$1';
$route['admin_company/mycourses/delete/(:any)'] = 'admin_companymycourses/delete/$1';
$route['admin_company/mycourses/(:any)'] = 'admin_companymycourses/index/$1'; //$1 = page number

$route['admin_company/analytics'] = 'admin_companyanalytics/index';
$route['admin_company/analytics/add'] = 'admin_companyanalytics/add';
$route['admin_company/analytics/update'] = 'admin_companyanalytics/update';
$route['admin_company/analytics/update/(:any)'] = 'admin_companyanalytics/update/$1';
$route['admin_company/analytics/delete/(:any)'] = 'admin_companyanalytics/delete/$1';
$route['admin_company/analytics/(:any)'] = 'admin_companyanalytics/index/$1'; //$1 = page number


$route['admin_company/analyticreports'] = 'admin_companygraphreports/analyticreports';
$route['admin_company/analyreports'] = 'admin_companygraphreports/analyreports';
$route['admin_company/reports'] = 'admin_companyreports/index';
$route['admin_company/reports/userwise'] = 'admin_companyuserwisereports/index';
$route['admin_company/reports/userwise_list'] = 'admin_companyuserwisereports/userwise_report_list';
$route['admin_company/reports/selected_users'] = 'admin_companyuserwisereports/user_specific_report';
$route['admin_company/reports/selected_users_list'] = 'admin_companyuserwisereports/user_specific_report_list';
$route['admin_company/reports/coursewise'] = 'admin_companycoursewisereports/index';
$route['admin_company/reports/coursewise_list'] = 'admin_companycoursewisereports/coursewise_report_list';
$route['admin_company/reports/selected_courses'] = 'admin_companycoursewisereports/course_specific_index';
$route['admin_company/reports/selected_courses_list'] = 'admin_companycoursewisereports/course_specific_list';
$route['admin_company/reports/chapterwise'] = 'admin_companychapterwisereports/index';
$route['admin_company/reports/chapterwise_list'] = 'admin_companychapterwisereports/chapterwise_report_list';
$route['admin_company/reports/selected_chapter'] = 'admin_companychapterwisereports/chapter_specific_index';
$route['admin_company/reports/selected_chapter_list'] = 'admin_companychapterwisereports/chapter_specific_list';

$route['admin_company/graphreports'] = 'admin_companygraphreports/index';
$route['admin_company/graphreports/add'] = 'admin_companygraphreports/add';
$route['admin_company/graphreports/update'] = 'admin_companygraphreports/update';
$route['admin_company/graphreports/update/(:any)'] = 'admin_companygraphreports/update/$1';
$route['admin_company/graphreports/delete/(:any)'] = 'admin_companygraphreports/delete/$1';
$route['admin_company/graphreports/(:any)'] = 'admin_companygraphreports/index/$1'; //$1 = page number


$route['admin_company/chapters'] = 'admin_companychapters/index';
$route['admin_company/chapters/list'] = 'admin_companychapters/chapter_list';
$route['admin_company/chapters/add'] = 'admin_companychapters/add';
$route['admin_company/chapters/update'] = 'admin_companychapters/update';
$route['admin_company/chapters/update/(:any)'] = 'admin_companychapters/update/$1';
$route['admin_company/chapters/delete/(:any)'] = 'admin_companychapters/delete/$1';
$route['admin_company/category/(:any)'] = 'admin_companycategory/index/$1'; //$1 = page number
$route['admin_company/chapters/schedulecourses'] = 'admin_companychapters/schedulecourses';
$route['admin_company/chapters/viewchapter/(:any)'] = 'admin_companychapters/viewchapter/$1';
$route['admin_company/chapters/upload'] = 'admin_companychapters/upload_chapters';
$route['admin_company/chapters/dropdown_list'] = 'admin_companychapters/chapter_dropdown_list';
$route['admin_company/set_user_chapter_comments'] = 'admin_companychapters/set_user_chapter_comments';
$route['employee_company/get_user_chapter_comments'] = 'admin_companychapters/get_user_chapter_comments';
$route['admin_company/chapter/check_for_space_availability'] = 'admin_companychapters/check_for_space_availability';
$route['admin_company/chapters/comments'] = 'admin_companychapters/comment_index';
$route['admin_company/chapters/comments_list'] = 'admin_companychapters/get_comment_list';


$route['admin_company/question'] = 'admin_companychapters/index';
$route['admin_company/question/list'] = 'admin_companychapters/chapter_list';
$route['admin_company/question/add'] = 'admin_companyquestion/add';

$route['employee'] = 'employeeuser/index';
$route['employee/signup'] = 'employeeuser/signup';
$route['employee/create_member'] = 'employeeuser/create_member';
$route['employee/login'] = 'employeeuser/index';
$route['employee/logout'] = 'employeeuser/logout';
$route['employee/login/validate_credentials'] = 'employeeuser/validate_credentials';
$route['employee/register'] = 'employeeuser/empregister';
$route['employee/userprofile'] = 'employeeuser/userprofile';
$route['employee/pwdchange'] = 'employeeuser/pwdchange';
$route['employee/payment_subscribe'] = 'employeeuser/payment_subscribe';
$route['employee/payment_success'] = 'employeeuser/payment_success';
$route['employee/payment_failure'] = 'employeeuser/payment_failure';
$route['employee/request_password_reset']='employeeuser/request_password_reset';
$route['employee/verify_reset_password_code'] = 'employeeuser/verify_reset_password_code';
$route['employee/change_password'] = 'employeeuser/change_password';
$route['employee/get_coursedetails']='employeeuser/get_coursedetails';
$route['employee_company/pdf_courses/(:any)'] = 'employee_courses/index';
$route['employee_company/courses'] = 'employee_courses/index'; //$1 = page number

$route['employee_company/courses/assigncourses'] = 'employee_courses/assigncourses';
$route['employee_company/courses/view_chapters'] = 'employee_courses/view_chapters';
$route['employee_company/courses/certificate/(:any)'] = 'employee_courses/certificate/$1';
$route['employee_company/courses/update/(:any)'] = 'employee_courses/update/$1';
$route['employee_company/courses/delete/(:any)'] = 'employee_courses/delete/$1';

$route['employee_company/supportmailemp'] = 'employee_courses/supportmailemp';
$route['employee_company/courses/set_comments'] = 'employee_courses/set_empcomments';

$route['employee_company/courses/schedulecourse'] = 'employee_courses/schedulecourselist';
$route['employee_company/courses/schedulecoursetime'] = 'employee_courses/schedulecoursetime';

$route['employee_company/courses/notificationslist'] = 'employee_courses/notificationslist';
$route['employee_company/courses/clearnotification'] = 'employee_courses/clearnotification';

$route['employee_company/courses/takechapter/(:any)'] = 'employee_courses/takechapter/$1';


$route['employee_company/chapter_list'] = 'employee_courses/topiclist';
$route['employee_company/completed_course'] = 'employee_dashboard/get_completed_course';
$route['employee_company/incomplete_course'] = 'employee_dashboard/get_incomplete_course';
$route['employee_company/notattempted_course'] = 'employee_dashboard/get_notattempted_course';
$route['course_details/get_cmi_values/(:any)'] = 'course_details/get_cmi_values/$1';
$route['course_details/set_cmi_values/(:any)'] = 'course_details/set_cmi_values/$1';
$route['course_details/store_user_slide_details_array/(:any)'] = 'course_details/store_user_slide_details_array/$1';
$route['course_details/set_user_slide_activity_details/(:any)'] = 'course_details/set_user_slide_activity_details/$1';
$route['course_details/get_user_chapter_details'] = 'course_details/get_user_chapter_details';

$route['employee_company/dashboard'] = 'employee_dashboard';
$route['employee_company/get_user_courses_status'] = 'Employee_dashboard/get_user_courses_status';


$route['admin_company/line_chart_basic'] = 'gchart_examples/line_chart_basic';
$route['admin_company/area_chart_basic'] = 'gchart_examples/area_chart_basic';
$route['admin_company/area_chart_advanced'] = 'gchart_examples/area_chart_advanced';
$route['admin_company/pie_chart_advanced'] = 'gchart_examples/pie_chart_advanced';
$route['admin_company/column_chart_basic'] = 'gchart_examples/column_chart_basic';
$route['admin_company/column_chart_advanced'] = 'gchart_examples/column_chart_advanced';


$route['admin_company/coupon_code']='admin_companycouponcode/index';
$route['admin_company/coupon_code/list']='admin_companycouponcode/couponcode_list';
$route['admin_company/coupon_code/add']='admin_companycouponcode/add';
$route['admin_company/coupon_code/update']='admin_companycouponcode/update';
$route['employee/coupon_code/check']='employeeuser/apply_couponcode';

$route['admin_company/communication']='communication/index';
$route['admin_company/communication/list']='communication/communication_list';
$route['communication/get_users']='communication/get_users';
$route['communication/send_message']='communication/send_message';
$route['communication/subject_specific_message']='communication/get_subject_specific_message';
$route['communication/message_receipient']='communication/get_message_receipient';
$route['communication/send_reply']='communication/send_reply';
$route['admin_company/supportmail'] = 'communication/supportmail';


$route['admin_company/add_user']='admin_companyuserassign/add_user';
$route['admin_company/add_user/download_sample_file'] = 'admin_companyuserassign/download_sample_file';


/* End of file routes.php */
/* Location: ./application/config/routes.php */