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

//$route['default_controller'] = 'companyuser/installurl';
$route['default_controller'] ='frontend_home/trainerspage';
$route['404_override'] = '';



$route['home'] = 'frontend_home/trainerspage';
$route['mailsupport'] = 'frontend_home/frontmailsupport';
$route['coursedetails'] = 'frontend_home/coursedetails';
$route['paymentsubscribe'] = 'frontend_home/paymentsubscribe';
$route['paypalpayments'] = 'frontend_home/paypalpayments';
$route['previewvideo'] = 'frontend_home/previewvideo';


/*Website routes*/
/*
$route['home'] = 'frontend_home/index';
$route['about-us'] = 'frontend_home/aboutus';
$route['contact'] = 'frontend_home/contact';
$route['cardiac-care'] = 'frontend_home/cardiaccare';
$route['diabetic-care'] = 'frontend_home/diabeticcare';
$route['cancer-care'] = 'frontend_home/cancercare';
$route['gastric-care'] = 'frontend_home/gastriccare';
$route['critical-care'] = 'frontend_home/criticalcare';
$route['hiv-care'] = 'frontend_home/hivcare';
$route['anti-biotic'] = 'frontend_home/antibiotic';
$route['life-style'] = 'frontend_home/lifestyle';
$route['respiratory-asthma'] = 'frontend_home/respiratory';
$route['eye-care'] = 'frontend_home/eyecare';
$route['clients'] = 'frontend_home/clients';
*/

/*admin*/
$route['admin'] = 'user/index';
$route['admin/signup'] = 'user/signup';
$route['admin/create_member'] = 'user/create_member';
$route['admin/login'] = 'user/index';
$route['admin/logout'] = 'user/logout';
$route['admin/login/validate_credentials'] = 'user/validate_credentials';
/*
$route['admin/products'] = 'admin_products/index';
$route['admin/products/add'] = 'admin_products/add';
$route['admin/products/update'] = 'admin_products/update';
$route['admin/products/update/(:any)'] = 'admin_products/update/$1';
$route['admin/products/delete/(:any)'] = 'admin_products/delete/$1';
$route['admin/products/(:any)'] = 'admin_products/index/$1'; //$1 = page number
$route['admin/products/deletesub/(:any)'] = 'admin_products/delete_subproductdetails/$1';


*/

$route['admin/brandings'] = 'admin_brandings/index';
$route['admin/brandings/add'] = 'admin_brandings/add';
$route['admin/brandings/addtheme'] = 'admin_brandings/addtheme';

$route['admin/brandings/update'] = 'admin_brandings/update';
$route['admin/brandings/update/(:any)'] = 'admin_brandings/update/$1';
$route['admin/brandings/delete/(:any)'] = 'admin_brandings/delete/$1';
$route['admin/brandings/(:any)'] = 'admin_brandings/index/$1'; //$1 = page number


$route['admin/category'] = 'admin_category/index';
$route['admin/category/add'] = 'admin_category/add';
$route['admin/category/update'] = 'admin_category/update';
$route['admin/category/update/(:any)'] = 'admin_category/update/$1';
$route['admin/category/delete/(:any)'] = 'admin_category/delete/$1';
$route['admin/category/(:any)'] = 'admin_category/index/$1'; //$1 = page number

$route['admin/subcategory'] = 'admin_subcategory/index';
$route['admin/subcategory/add'] = 'admin_subcategory/add';
$route['admin/subcategory/update'] = 'admin_subcategory/update';
$route['admin/subcategory/update/(:any)'] = 'admin_subcategory/update/$1';
$route['admin/subcategory/delete/(:any)'] = 'admin_subcategory/delete/$1';
$route['admin/subcategory/(:any)'] = 'admin_subcategory/index/$1'; //$1 = page number

$route['admin/courses'] = 'admin_courses/index';
$route['admin/courses/add'] = 'admin_courses/add';
$route['admin/courses/update'] = 'admin_courses/update';
$route['admin/courses/update/(:any)'] = 'admin_courses/update/$1';
$route['admin/courses/delete/(:any)'] = 'admin_courses/delete/$1';
$route['admin/courses/(:any)'] = 'admin_courses/index/$1'; //$1 = page number

$route['admin/spaces'] = 'admin_spaces/index';
$route['admin/spaces/add'] = 'admin_spaces/add';
$route['admin/spaces/update'] = 'admin_spaces/update';
$route['admin/spaces/update/(:any)'] = 'admin_spaces/update/$1';
$route['admin/spaces/delete/(:any)'] = 'admin_spaces/delete/$1';
$route['admin/spaces/(:any)'] = 'admin_spaces/index/$1'; //$1 = page number

$route['admin/hostplanes'] = 'admin_hostplanes/index';
$route['admin/hostplanes/add'] = 'admin_hostplanes/add';
$route['admin/hostplanes/update'] = 'admin_hostplanes/update';
$route['admin/hostplanes/update/(:any)'] = 'admin_hostplanes/update/$1';
$route['admin/hostplanes/delete/(:any)'] = 'admin_hostplanes/delete/$1';
$route['admin/hostplanes/(:any)'] = 'admin_hostplanes/index/$1'; //$1 = page number

$route['admin/criteria'] = 'admin_criteria/index';
$route['admin/criteria/add'] = 'admin_criteria/add';
$route['admin/criteria/update'] = 'admin_criteria/update';
$route['admin/criteria/update/(:any)'] = 'admin_criteria/update/$1';
$route['admin/criteria/delete/(:any)'] = 'admin_criteria/delete/$1';
$route['admin/criteria/(:any)'] = 'admin_criteria/index/$1'; //$1 = page number

$route['admin/usercriteria'] = 'admin_usercriteria/index';
$route['admin/usercriteria/add'] = 'admin_usercriteria/add';
$route['admin/usercriteria/update'] = 'admin_usercriteria/update';
$route['admin/usercriteria/update/(:any)'] = 'admin_usercriteria/update/$1';
$route['admin/usercriteria/delete/(:any)'] = 'admin_usercriteria/delete/$1';
$route['admin/usercriteria/(:any)'] = 'admin_usercriteria/index/$1'; //$1 = page number

$route['admin/coursevideos'] = 'admin_coursevideos/index';
$route['admin/coursevideos/add'] = 'admin_coursevideos/add';
$route['admin/coursevideos/update'] = 'admin_coursevideos/update';
$route['admin/coursevideos/update/(:any)'] = 'admin_coursevideos/update/$1';
$route['admin/coursevideos/delete/(:any)'] = 'admin_coursevideos/delete/$1';
$route['admin/coursevideos/(:any)'] = 'admin_coursevideos/index/$1'; //$1 = page number



/* Company  user admin Function Routers*/
$route['admin_company'] = 'companyuser/index';
$route['admin_company/signup'] = 'companyuser/signup';
$route['admin_company/login'] = 'companyuser/index';
$route['admin_company/logout'] = 'companyuser/logout';
$route['admin_company/login/validate_credentials'] = 'companyuser/validate_credentials';
$route['admin_company/userprofile/(:any)'] = 'companyuser/userprofile/$1';
$route['admin_company/pwdchange/(:any)'] = 'companyuser/pwdchange/$1';
$route['admin_company/supportmail'] = 'companyuser/supportmail';
$route['admin_company/register/(:any)'] = 'companyuser/register/$1';
$route['admin_company/create_member'] = 'companyuser/create_member';
$route['admin_company/payment_subscribe'] = 'companyuser/payment_subscribe';
$route['admin_company/installsoft'] = 'companyuser/installsoft';
$route['admin_company/paypalpayments'] = 'companyuser/paypalpayments';
$route['admin_company/sucesspay'] = 'companyuser/sucesspaymentpage';



$route['admin_company/brandings'] = 'admin_companybrandings/index';
$route['admin_company/brandings/addtheme'] = 'admin_companybrandings/addtheme';

$route['admin_company/category'] = 'admin_companycategory/index';
$route['admin_company/category/add'] = 'admin_companycategory/add';
$route['admin_company/category/update'] = 'admin_companycategory/update';
$route['admin_company/category/update/(:any)'] = 'admin_companycategory/update/$1';
$route['admin_company/category/delete/(:any)'] = 'admin_companycategory/delete/$1';
$route['admin_company/category/(:any)'] = 'admin_companycategory/index/$1'; //$1 = page number


$route['admin_company/cmspage'] = 'admin_companycmspage/index';
$route['admin_company/cmspage/add'] = 'admin_companycmspage/add';
$route['admin_company/cmspage/update'] = 'admin_companycmspage/update';
$route['admin_company/cmspage/update/(:any)'] = 'admin_companycmspage/update/$1';
$route['admin_company/cmspage/delete/(:any)'] = 'admin_companycmspage/delete/$1';
$route['admin_company/cmspage/(:any)'] = 'admin_companycmspage/index/$1'; //$1 = page number
$route['admin_company/cmspage/notification_process'] = 'admin_companycmspage/notificationprocess';
$route['admin_company/cmspage/notification_process/(:any)'] = 'admin_companycmspage/notificationprocess/$1';
$route['admin_company/cmspage/notificationslist'] = 'admin_companycmspage/notificationslist';
$route['admin_company/cmspage/clearnotification'] = 'admin_companycmspage/clearnotification';


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
$route['admin_company/subcategory/add'] = 'admin_companysubcategory/add';
$route['admin_company/subcategory/update'] = 'admin_companysubcategory/update';
$route['admin_company/subcategory/update/(:any)'] = 'admin_companysubcategory/update/$1';
$route['admin_company/subcategory/delete/(:any)'] = 'admin_companysubcategory/delete/$1';
$route['admin_company/subcategory/(:any)'] = 'admin_companysubcategory/index/$1'; //$1 = page number

$route['admin_company/courses'] = 'admin_companycourses/index';
$route['admin_company/courses/add'] = 'admin_companycourses/add';
$route['admin_company/courses/update'] = 'admin_companycourses/update';
$route['admin_company/courses/update/(:any)'] = 'admin_companycourses/update/$1';
$route['admin_company/courses/activate/(:any)'] = 'admin_companycourses/activate/$1';
$route['admin_company/courses/delete/(:any)'] = 'admin_companycourses/delete/$1';
$route['admin_company/courses/(:any)'] = 'admin_companycourses/index/$1'; //$1 = page number


$route['admin_company/userassign'] = 'admin_companyuserassign/index';
$route['admin_company/userassign/add'] = 'admin_companyuserassign/add';
$route['admin_company/userassign/update'] = 'admin_companyuserassign/update';
$route['admin_company/userassign/update/(:any)'] = 'admin_companyuserassign/update/$1';
$route['admin_company/userassign/delete/(:any)'] = 'admin_companyuserassign/delete/$1';
$route['admin_company/userassign/(:any)'] = 'admin_companyuserassign/index/$1'; //$1 = page number

$route['admin_company/brandings/addtheme'] = 'admin_companybrandings/addtheme';
$route['admin_company/brandings/startpageapp'] = 'admin_companybrandings/startpage_app';


$route['admin_company/employeelist'] = 'admin_companyuserassign/employeelist';
$route['admin_company/employeeprofile/(:any)'] = 'admin_companyuserassign/employeeprofiledtil/$1';

$route['admin_company/emppwdchange/(:any)'] = 'admin_companyuserassign/emppwdchange/$1';

$route['admin_company/employeeprofile/(:any)'] = 'admin_companyuserassign/employeeprofiledtil/$1';

$route['admin_company/coursesassign'] = 'admin_companycoursesassign/index';
$route['admin_company/coursesassign/add'] = 'admin_companycoursesassign/add';
$route['admin_company/coursesassign/update'] = 'admin_companycoursesassign/update';
$route['admin_company/coursesassign/update/(:any)'] = 'admin_companycoursesassign/update/$1';
$route['admin_company/coursesassign/delete/(:any)'] = 'admin_companycoursesassign/delete/$1';
$route['admin_company/coursesassign/(:any)'] = 'admin_companycoursesassign/index/$1'; //$1 = page number
$route['admin_company/coursesassign/assignall'] = 'admin_companycoursesassign/assignall';


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

$route['admin_company/graphreports'] = 'admin_companygraphreports/index';
$route['admin_company/graphreports/add'] = 'admin_companygraphreports/add';
$route['admin_company/graphreports/update'] = 'admin_companygraphreports/update';
$route['admin_company/graphreports/update/(:any)'] = 'admin_companygraphreports/update/$1';
$route['admin_company/graphreports/delete/(:any)'] = 'admin_companygraphreports/delete/$1';
$route['admin_company/graphreports/(:any)'] = 'admin_companygraphreports/index/$1'; //$1 = page number


$route['admin_company/chapters'] = 'admin_companychapters/index';
$route['admin_company/chapters/add/(:any)'] = 'admin_companychapters/add/$1';
$route['admin_company/chapters/add'] = 'admin_companychapters/add';
$route['admin_company/chapters/update'] = 'admin_companychapters/update';
$route['admin_company/chapters/update/(:any)'] = 'admin_companychapters/update/$1';
$route['admin_company/chapters/delete/(:any)'] = 'admin_companychapters/delete/$1';
$route['admin_company/category/(:any)'] = 'admin_companycategory/index/$1'; //$1 = page number
$route['admin_company/chapters/schedulecourses'] = 'admin_companychapters/schedulecourses';
$route['admin_company/chapters/viewchapter/(:any)'] = 'admin_companychapters/viewchapter/$1';


$route['employee'] = 'employeeuser/index';
$route['employee/signup'] = 'employeeuser/signup';
$route['employee/create_member'] = 'employeeuser/create_member';
$route['employee/login'] = 'employeeuser/index';
$route['employee/logout'] = 'employeeuser/logout';
$route['employee/login/validate_credentials'] = 'employeeuser/validate_credentials';
$route['employee/register'] = 'employeeuser/empregister';
$route['employee/userprofile/(:any)'] = 'employeeuser/userprofile/$1';
$route['employee/pwdchange/(:any)'] = 'employeeuser/pwdchange/$1';


$route['employee_company/courses'] = 'employee_courses/assigncourses';
$route['employee_company/courses/assigncourses'] = 'employee_courses/assigncourses';
$route['employee_company/courses/takecourses/(:any)'] = 'employee_courses/takecourses/$1';
$route['employee_company/courses/certificate/(:any)'] = 'employee_courses/certificate/$1';
$route['employee_company/courses/update/(:any)'] = 'employee_courses/update/$1';
$route['employee_company/courses/delete/(:any)'] = 'employee_courses/delete/$1';
$route['employee_company/courses/(:any)'] = 'employee_courses/index/$1'; //$1 = page number
$route['employee_company/supportmailemp'] = 'employee_courses/supportmailemp';
$route['employee_company/courses/empcomments'] = 'employee_courses/empcomments';

$route['employee_company/courses/schedulecourse'] = 'employee_courses/schedulecourselist';
$route['employee_company/courses/schedulecoursetime'] = 'employee_courses/schedulecoursetime';

$route['employee_company/courses/notificationslist'] = 'employee_courses/notificationslist';
$route['employee_company/courses/clearnotification'] = 'employee_courses/clearnotification';

$route['employee_company/courses/takechapter/(:any)'] = 'employee_courses/takechapter/$1';


$route['employee_company/topiclist/(:any)'] = 'employee_courses/topiclist/$1';


/*
$route['employee_company/courses/topiclistcourse/(:any)'] = 'employee_courses/coursetopicslist/$1';
*/


$route['admin_company/line_chart_basic'] = 'gchart_examples/line_chart_basic';
$route['admin_company/area_chart_basic'] = 'gchart_examples/area_chart_basic';
$route['admin_company/area_chart_advanced'] = 'gchart_examples/area_chart_advanced';
$route['admin_company/pie_chart_advanced'] = 'gchart_examples/pie_chart_advanced';
$route['admin_company/column_chart_basic'] = 'gchart_examples/column_chart_basic';
$route['admin_company/column_chart_advanced'] = 'gchart_examples/column_chart_advanced';

/*
$route['admin/chapters'] = 'admin_chapters/index';
$route['admin/chapters/add'] = 'admin_chapters/add';
$route['admin/chapters/update'] = 'admin_chapters/update';
$route['admin/chapters/update/(:any)'] = 'admin_chapters/update/$1';
$route['admin/chapters/delete/(:any)'] = 'admin_chapters/delete/$1';
$route['admin/chapters/(:any)'] = 'admin_chapters/index/$1'; //$1 = page number
*/




/* End of file routes.php */
/* Location: ./application/config/routes.php */