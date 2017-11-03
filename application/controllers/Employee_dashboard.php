<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Employee)dashboard
 *
 * @author a
 */
class Employee_dashboard extends CI_Controller {

//put your code here
    public $company_details;

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));


        if (!($this->session->userdata('is_logged_in'))) {
            redirect('employee/logout');
        } else {
            $this->load->model('Employee_dashboard_model');
            $this->load->model('employeeuser_model');
            $this->company_details = $this->domain->get_company_byDomain();
        }
    }

    function index() {
        $data['course_status_data'] = $this->Employee_dashboard_model->get_user_courses_status();
        $data['company_details'] = $this->company_details;
          $data['footerdata'] = $this->employeeuser_model->list_footercmspage();
        $data['main_content'] = 'employee_company/courses/user_dashboard';
        $this->load->view('includes/template', $data);
    }

    function get_user_courses_status() {
        $user_id = $this->session->userdata('id');
    }

    function get_completed_course() {
        $course_status_data = $this->Employee_dashboard_model->get_user_courses_status();
        if (!(empty($course_status_data->completed_course_list))) {
            $data['courses'] = $this->Employee_dashboard_model->get_course_list_statuswise($course_status_data->completed_course_list);
        } else {
            $data['courses'] = array();
        }
        $data['footerdata'] = $this->employeeuser_model->list_footercmspage();
        $data['menu_name'] = 'Complete Course List';
        //load the view
        $data['main_content'] = 'employee_company/courses/assignlist';
        $this->load->view('includes/template', $data);
    }

    function get_incomplete_course() {
        $course_status_data = $this->Employee_dashboard_model->get_user_courses_status();
        if (!(empty($course_status_data->incomplete_course_list))) {
            $data['courses'] = $this->Employee_dashboard_model->get_course_list_statuswise($course_status_data->incomplete_course_list);
        } else {
            $data['courses'] = array();
        }
        $data['footerdata'] = $this->employeeuser_model->list_footercmspage();
        $data['menu_name'] = 'Incomplete Course List';
        //load the view
        $data['main_content'] = 'employee_company/courses/assignlist';
        $this->load->view('includes/template', $data);
    }

    function get_notattempted_course() {
        $course_status_data = $this->Employee_dashboard_model->get_user_courses_status();

        if (!(empty($course_status_data->notattempted_course_list))) {
            $data['courses'] = $this->Employee_dashboard_model->get_course_list_statuswise($course_status_data->notattempted_course_list);
        } else {
            $data['courses'] = array();
        }
        $data['footerdata'] = $this->employeeuser_model->list_footercmspage();
        $data['menu_name'] = 'Not Attempted Course List';
        //load the view
        $data['main_content'] = 'employee_company/courses/assignlist';
        $this->load->view('includes/template', $data);
    }

}
