<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_companycoursewisereports
 *
 * @author a
 */
class admin_companyuserwisereports extends CI_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));



        if ((!$this->session->userdata('is_logged_in')) && (!$this->input->is_ajax_request())) {
            redirect('admin_company/login');
        } else {
            $this->load->model('companycourses_model');
            $this->load->model('Company_userwisereports_model');
        }
    }

    public function index() {

        $data['footerdata'] = $this->companycmspage_model->list_cmspage();
        $data['main_content'] = 'admin_company/reports/user_wiseReports/list';
        $this->load->view('includes/template', $data);
    }

    public function userwise_report_list() {
        $usernm = $this->session->userdata('user_name');
        $userid = $this->session->userdata('id');
        $limit = $this->input->post(rows); //no. of rows
        $sidx = 'id';
        $sord = "desc";

        if ($this->input->post('search') == 'true') {
            $search_string_array = json_decode($this->input->post('search_string_array'));
        }
        $page = trim($this->input->post('page'));
        if ($page == "") {
            $page = 1;
        }
        if (array_key_exists("is_csv", $_POST)) {
            $is_csv = TRUE;
        } else {
            $is_csv = false;
        }
        $count = $this->Company_userwisereports_model->get_userwise_report($sidx, $sord, 0, $limit, $search_string_array, $is_count = true, $is_csv);

        if (!$sidx) {
            $sidx = 1;
        }
        if ($count > 0 && $limit > 0) {
            $totalpages = ceil($count / $limit);
        } else {
            $totalpages = 0;
        }
        if ($page > $totalpages) {
            $page = $totalpages;
        }
        $start = ($limit * $page) - $limit;

        if ($start < 0) {
            $start = 0;
        }

        $query = $this->Company_userwisereports_model->get_userwise_report($sidx, $sord, $start, $limit, $search_string_array, $is_count = false, $is_csv);

        if ($is_csv == FALSE) {
            $response = new stdClass();
            $response->page = $page;

            $response->total = $totalpages;
            $response->records = $count;
            $response->start = $start + 1;
            $response->end = $start + $limit;
            $i = 0;

            foreach ($query->result() as $row) {
                if ($row->courses_assigned == NULL) {
                    $courses_assigned = "Course is not assigned yet";
                } else {
                    $courses_assigned = $row->courses_assigned;
                }

                $response->rows[$i] = array('id' => $this->encryption->encrypt($row->id), 'email' => $row->email, 'name' => $row->full_name, 'courses' => $courses_assigned);
                $i++;
            }
            echo json_encode($response);
        } else {
            $this->load->library('excel');
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");

            $objPHPExcel->setActiveSheetIndex(0);

            // Field names in the first row
            $fields = $query->list_fields();
            $col = 0;
            foreach ($fields as $field) {
                if ($col > 0) {
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
                    $style['red_text'] = array(
                        'name' => 'Arial',
                        'color' => array(
                            'rgb' => '000'
                        )
                    );
                    $objPHPExcel->getActiveSheet()
                            ->getStyleByColumnAndRow($col, 1)
                            ->getFont()
                            ->applyFromArray($style['red_text']);
                }
                $col++;
            }

            // Fetching the table data
            $row = 2;

            foreach ($query->result() as $data) {

                $col = 0;
                foreach ($fields as $field) {
                    if ($col > 0) {
                        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                    }
                    $col++;
                }

                $row++;
            }

            $objPHPExcel->setActiveSheetIndex(0);

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            ob_end_clean();
            // Sending headers to force the user to download the file
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="userwise_reports_' . date('d-M-y H_i_s') . '.xls"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
        }
    }

    public function user_specific_report() {

        $data['footerdata'] = $this->companycmspage_model->list_cmspage();
        $data['main_content'] = 'admin_company/reports/user_wiseReports/user_specificReports/list';
        $data['user_specific_id'] = $this->input->post('user_id');
        $data['user_specific_data'] = $this->companyuser_model->get_userdetails_by_id($this->encryption->decrypt($data['user_specific_id']));

        $this->load->view('includes/template', $data);
    }

    public function user_specific_report_list() {
        $user_specific_id = $this->encryption->decrypt($this->input->post('user_id'));
        $user_specific_name = $this->Company_userwisereports_model->get_username($user_specific_id);
        $userid = $this->session->userdata('id');
        $userid = $this->session->userdata('id');
        $limit = $this->input->post(rows); //no. of rows
        $sidx = 'id';
        $sord = "desc";

        if ($this->input->post('search') == 'true') {

            $search_string_array = json_decode($this->input->post('search_string_array'));
        }
        $page = trim($this->input->post('page'));
        if ($page == "") {
            $page = 1;
        }
        if (array_key_exists("is_csv", $_POST)) {
            $is_csv = TRUE;
        } else {
            $is_csv = false;
        }

        $count = $this->Company_userwisereports_model->get_user_specific_report($user_specific_id, $sidx, $sord, 0, $limit, $search_string_array, $is_count = true, $is_csv);

        if (!$sidx) {
            $sidx = 1;
        }
        if ($count > 0 && $limit > 0) {
            $totalpages = ceil($count / $limit);
        } else {
            $totalpages = 0;
        }
        if ($page > $totalpages) {
            $page = $totalpages;
        }
        $start = ($limit * $page) - $limit;

        if ($start < 0) {
            $start = 0;
        }
        $query = $this->Company_userwisereports_model->get_user_specific_report($user_specific_id, $sidx, $sord, $start, $limit, $search_string_array, $is_count = false, $is_csv);

        if (!array_key_exists("is_csv", $_POST)) {
            $response = new stdClass();
            $response->page = $page;

            $response->total = $totalpages;
            $response->records = $count;
            $response->start = $start + 1;
            $i = 0;

            foreach ($query->result() as $row) {


                $response->rows[$i] = array('user' => $row->User, 'course' => $row->Course, 'chapter' => $row->Chapter, 'course_attempt' => $row->Course_Attempt, 'slide_details' => $row->Slide_Details, 'lesson_status' => $row->Lesson_status);
                $i++;
            }
            echo json_encode($response);
        } else {

            $this->load->library('excel');
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");

            $objPHPExcel->setActiveSheetIndex(0);

            // Field names in the first row
            $fields = $query->list_fields();
            $col = 0;
            foreach ($fields as $field) {
                if ($col > 0) {
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
                    $style['red_text'] = array(
                        'name' => 'Arial',
                        'color' => array(
                            'rgb' => '000'
                        )
                    );
                    $objPHPExcel->getActiveSheet()
                            ->getStyleByColumnAndRow($col, 1)
                            ->getFont()
                            ->applyFromArray($style['red_text']);
                }
                $col++;
            }

            // Fetching the table data
            $row = 2;

            foreach ($query->result() as $data) {

                $col = 0;
                foreach ($fields as $field) {
                    if ($col > 0) {
                        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                    }
                    $col++;
                }

                $row++;
            }

            $objPHPExcel->setActiveSheetIndex(0);

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            ob_end_clean();
            // Sending headers to force the user to download the file
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="' . $this->lang->line('lbl_user_specific_report_list') . $user_specific_name . date('d-M-y H_i_s') . '.xls"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
        }
    }

}
