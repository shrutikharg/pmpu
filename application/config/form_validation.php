<?php

$config = array(
    'admin_companychapters/add' => array(
        array(
            'field' => 'name',
            'label' => 'lang:lbl_chapter',
            'rules' => 'required|trim|min_length[5]|max_length[100]'
        ),
        array(
            'field' => 'description',
            'label' => 'lang:lbl_chapter_desc',
            'rules' => 'required|trim|min_length[10]|max_length[250]'
        ),
        array(
            'field' => 'course_id',
            'label' => 'lang:lbl_course',
            'rules' => 'required|trim'
        )
    ),
    'admin_companychapters/update' => array(
        array(
            'field' => 'name',
            'label' => 'lang:lbl_chapter',
            'rules' => 'required|trim|min_length[5]|max_length[100]'
        ),
        array(
            'field' => 'description',
            'label' => 'lang:lbl_chapter_desc',
            'rules' => 'required|trim|min_length[10]|max_length[250]'
        ),
        array(
            'field' => 'course_id',
            'label' => 'lang:lbl_course',
            'rules' => 'required|trim'
        )
    ),
    'admin_companycategory/add' => array(
        array(
            'field' => 'name',
            'label' => 'lang:lbl_department',
            'rules' => 'required|trim|min_length[2]|max_length[45]'
        ),
        array(
            'field' => 'description',
            'label' => 'lang:lbl_department_desc',
            'rules' => 'trim'
        )
    ),
    'admin_companycategory/update' => array(
        array(
            'field' => 'name',
            'label' => 'lang:lbl_department',
            'rules' => 'required|trim|min_length[2]|max_length[45]'
        ),
        array(
            'field' => 'description',
            'label' => 'lang:lbl_department_desc',
            'rules' => 'trim'
        )
    ),
    'admin_companysubcategory/add' => array(
        array(
            'field' => 'name',
            'label' => 'lang:lbl_department',
            'rules' => 'required|trim|min_length[2]|max_length[45]'
        ),
        array(
            'field' => 'description',
            'label' => 'lang:lbl_department_desc',
            'rules' => 'trim'
        ),
        array('field' => 'category_id',
            'label' => 'lang:lbl_department',
            'rules' => 'required')
    ),
    'admin_companysubcategory/update' => array(
        array(
            'field' => 'name',
            'label' => 'lang:lbl_department',
            'rules' => 'required|trim|min_length[2]|max_length[45]'
        ),
        array(
            'field' => 'description',
            'label' => 'lang:lbl_department_desc',
            'rules' => 'trim'
        ),
        array('field' => 'category_id',
            'label' => 'lang:lbl_department',
            'rules' => 'required')
    ),
    'admin_companycourses/add' => array(
        array(
            'field' => 'name',
            'label' => 'lang:lbl_course',
            'rules' => 'required|trim|min_length[2]|max_length[100]'
        ),
        array(
            'field' => 'description',
            'label' => 'lang:Description',
            'rules' => 'trim'
        ),
        array('field' => 'course_by',
            'label' => 'lang:lbl_course_by',
            'rules' => 'trim')
    ),
    'admin_companycourses/update' => array(
        array(
            'field' => 'name',
            'label' => 'lang:lbl_course',
            'rules' => 'required|trim|min_length[2]|max_length[100]'
        ),
        array(
            'field' => 'description',
            'label' => 'lang:Description',
            'rules' => 'trim'
        ),
        array('field' => 'course_by',
            'label' => 'lang:lbl_course_by',
            'rules' => 'trim')
    ),
    'admin_companyuserassign/add_user' => array(
     
        array('field' => 'userfile',
            'label' => 'lang:lbl_upload_course_assignment_csv',
            'rules' => 'callback_file_check')
    ),
    'companyuser/create_member' => array(
        array(
            'field' => 'first_name',
            'label' => 'lang:lbl_course',
            'rules' => 'required|trim|min_length[2]|max_length[45]'
        ),
        array(
            'field' => 'last_name',
            'label' => 'lang:Description',
            'rules' => 'required|trim|min_length[2]|max_length[45]'
        ),
        array('field' => 'web_address',
            'label' => 'lang:lbl_emp_comp_webaddress',
            'rules' => 'trim'),
        array('field' => 'comp_name',
            'label' => 'lang:lbl_emp_company_name',
            'rules' => 'trim'),
        array('field' => 'domain_name',
            'label' => 'lang:lbl_emp_subdomain_name',
            'rules' => 'required|trim|alpha|min_length[2]|max_length[10]||callback_check_domain_exist'),
        array('field' => 'email_address',
            'label' => 'lang:lbl_email',
            'rules' => 'required|valid_email|callback_email_check_exist'),
        array('field' => 'password',
            'label' => 'lang:lbl_emp_confpassword',
            'rules' => 'trim|required|min_length[5]|max_length[45]|matches[passconf]'),
        array('field' => 'passconf',
            'label' => 'lang:lbl_emp_comp_webaddress',
            'rules' => 'trim|required|min_length[5]|max_length[45]')
    ),
    'employeeuser/create_member' => array(
        array(
            'field' => 'first_name',
            'label' => 'lang:lbl_emp_first_name',
            'rules' => 'required|trim|min_length[2]|max_length[45]'
        ),
        array(
            'field' => 'last_name',
            'label' => 'lang:lbl_emp_last_name',
            'rules' => 'required|trim|min_length[2]|max_length[45]'
        ),
        array('field' => 'email',
            'label' => 'lang:lbl_email',
            'rules' => 'required|valid_email|callback_email_check_exist'),
        array('field' => 'phone',
            'label' => 'lang:lbl_phone',
            'rules' => 'required'),
        array('field' => 'password',
            'label' => 'lang:lbl_emp_password',
            'rules' => 'trim|required|min_length[5]|max_length[45]|matches[passconf]'),
        array('field' => 'passconf',
            'label' => 'lang:lbl_emp_confpassword',
            'rules' => 'trim|required|min_length[5]|max_length[45]')
    ),
    'admin_companybrandings/addtheme' => array(
        array(
            'field' => 'name',
            'label' => 'lang:lbl_company_name',
            'rules' => 'required|trim|min_length[2]|max_length[45]'
        ),
         array(
            'field' => 'product_name',
            'label' => 'lang:lbl_comp_product',
            'rules' => 'required|trim|min_length[2]|max_length[50]'
        ),
        array(
            'field' => 'email',
            'label' => 'lang:lbl_email',
            'rules' => 'required|trim|min_length[2]|max_length[45]'
        ),
        array('field' => 'phone',
            'label' => 'lang:lbl_comp_phone_no',
            'rules' => 'required'),
        array('field' => 'description',
            'label' => 'lang:lbl_comp_overview',
            'rules' => 'trim|required|min_length[50]|max_length[1000]'),
        array('field' => 'logo_image',
            'label' => 'lang:lbl_comp_logo',
            'rules' => "callback_upload_logo"),
    ),
    'admin_companycouponcode/add' => array(
        array(
            'field' => 'name',
            'label' => 'lang:lbl_coupon_code',
            'rules' => 'required|trim|min_length[4]|max_length[45]|callback_check_coupon_code_availabilty'
        ),
        array(
            'field' => 'percentage_off',
            'label' => 'lang:lbl_coupon_percentage_off',
            'rules' => 'required|numeric|max_length[10]|callback_check_min_max_off'
        ),
        array('field' => 'start_date',
            'label' => 'lang:lbl_start_date',
            'rules' => 'required'),
        array('field' => 'end_date',
            'label' => 'lang:lbl_end_date',
            'rules' => 'required|callback_compareDate'),
        array('field' => 'is_active',
            'label' => 'lang:lbl_is_active',
            'rules' => "required"),
    ),
    'admin_companycouponcode/update' => array(
        array(
            'field' => 'name',
            'label' => 'lang:lbl_coupon_code',
            'rules' => 'required|trim|min_length[4]|max_length[45]|callback_check_coupon_code_availabilty'
        ),
        array(
            'field' => 'percentage_off',
            'label' => 'lang:lbl_coupon_percentage_off',
            'rules' => 'required|numeric|max_length[10]|callback_check_min_max_off'
        ),
        array('field' => 'start_date',
            'label' => 'lang:lbl_start_date',
            'rules' => 'required'),
        array('field' => 'end_date',
            'label' => 'lang:lbl_end_date',
            'rules' => 'required|callback_compareDate'),
        array('field' => 'is_active',
            'label' => 'lang:lbl_is_active',
            'rules' => "required"),
    ),
    'admin_companycmspage/add'=>array(
       array(
            'field' => 'emailid',
            'label' => 'lang:lbl_footer_email',
            'rules' => 'required|trim||valid_email'
        ),
        array(
            'field' => 'contactno',
            'label' => 'lang:lbl_footer_contact',
            'rules' => 'required|trim|numeric|max_length[10]|callback_check_min_max_off'
        ),
          array(
            'field' => 'cmspagelink1_name',
            'label' => 'lang:lbl_footer_link1_nm',
            'rules' => 'required|trim|min_length[3]|max_length[45]'
        ),
          array(
            'field' => 'cmspagelink1',
            'label' => 'lang:lbl_footer_link1_url',
            'rules' => 'required|trim|valid_url'
        ),
          array(
            'field' => 'cmspagelink2_name',
            'label' => 'lang:lbl_footer_link2_nm',
            'rules' => 'required|trim|min_length[3]|max_length[45]'
        ),
          array(
            'field' => 'cmspagelink2',
            'label' => 'lang:lbl_footer_link2_url',
            'rules' => 'required|trim|valid_url'
        ),
         array(
            'field' => 'cmspagelink3_name',
            'label' => 'lang:lbl_footer_link3_nm',
            'rules' => 'required|trim|min_length[3]|max_length[45]'
        ),
          array(
            'field' => 'cmspagelink3',
            'label' => 'lang:lbl_footer_link3_url',
            'rules' => 'required|trim|valid_url'
        ),
         array(
            'field' => 'fblink',
            'label' => 'lang:lbl_facebook_link',
            'rules' => 'required|trim|valid_url'
        ),
         array(
            'field' => 'googlepluslink',
            'label' => 'lang:lbl_google_link',
            'rules' => 'required|trim|valid_url'
        ),
        array(
            'field' => 'twitterlink',
            'label' => 'lang:lbl_twitter_link',
            'rules' => 'required|trim|valid_url'
        ),
        array(
            'field' => 'linkedinlink',
            'label' => 'lang:lbl_linkedin_link',
            'rules' => 'required|trim|valid_url'
        ),    
      
        ),
    
    'admin_companyspeaker/add' => array(
        array(
            'field' => 'name',
            'label' => 'lang:lbl_speaker',
            'rules' => 'required|trim|min_length[2]|max_length[100]'
        ),
        array(
            'field' => 'description',
            'label' => 'lang:Description',
            'rules' => 'trim'
        ),
        array('field' => 'designation',
            'label' => 'lang:lbl_course_by',
            'rules' => 'required|trim|min_length[2]|max_length[100]')
    ),
    'admin_companyspeaker/update' => array(
    array(
            'field' => 'name',
            'label' => 'lang:lbl_speaker',
            'rules' => 'required|trim|min_length[2]|max_length[100]'
        ),
        array(
            'field' => 'description',
            'label' => 'lang:Description',
            'rules' => 'trim'
        ),
        array('field' => 'designation',
            'label' => 'lang:lbl_course_by',
            'rules' => 'required|trim|min_length[2]|max_length[100]')
    ),
       'admin_companyday/add' => array(
        array(
            'field' => 'name',
            'label' => 'lang:lbl_day',
            'rules' => 'required|trim|min_length[2]|max_length[100]'
        ),
        array(
            'field' => 'day_no',
            'label' => 'lang:lbl_day_no',
            'rules' => 'required|numeric|callback_check_day_availabilty'
        ),
        array('field' => 'description',
            'label' => 'lang:lbl_day_desc',
            'rules' => 'required|trim|min_length[2]|max_length[250]')
    ),
    'admin_companyday/update' => array(
        array(
            'field' => 'name',
            'label' => 'lang:lbl_day',
            'rules' => 'required|trim|min_length[2]|max_length[100]'
        ),
        array(
            'field' => 'day_no',
            'label' => 'lang:lbl_day_no',
            'rules' => 'required|numeric|callback_check_day_availabilty'
        ),
        array('field' => 'description',
            'label' => 'lang:lbl_day_desc',
            'rules' => 'required|trim|min_length[2]|max_length[250]')
    ),
);
