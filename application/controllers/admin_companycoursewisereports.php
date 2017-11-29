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
class admin_companycoursewisereports extends CI_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
 if ((!$this->session->userdata('is_logged_in')) && (!$this->input->is_ajax_request())) {
            redirect('admin_company/login');
        } else {
            $this->load->model('companycourses_model');
            $this->load->model('companycmspage_model');
            $this->load->model('Company_coursewisereports_model');
        }
    }

    public function index() {
        $data['main_content'] = 'admin_company/reports/course_wiseReports/list';
        $this->load->view('includes/template', $data);
    }

    public function coursewise_report_list() {
        $usernm = $this->session->userdata('user_name');
        $userid = $this->session->userdata('id');

        $limit = 10; //no. of rows
        $sidx = 'id';
        $sord = "desc";

        if ($this->input->post('search') == 'true') {
            $search_string_array = json_decode($this->input->post('search_string_array'));
        }
        $page = trim($this->input->post('page'));
        if ($page == "") {
            $page = 1;
        }
        $count = $this->Company_coursewisereports_model->get_coursewise_report( $sidx, $sord, 0, $limit, $search_string_array, $is_count = true);

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

        $query = $this->Company_coursewisereports_model->get_coursewise_report( $sidx, $sord, $start, $limit, $search_string_array, $is_count = false);


        if ($this->input->post('is_csv') == 'false') {
            $response = new stdClass();
            $response->page = $page;

            $response->total = $totalpages;
            $response->records = $count;
            $response->start = $start + 1;
            $response->end = $start + $limit;
            $i = 0;

            foreach ($query->result() as $row) {


                $response->rows[$i] = array('course_id' => $row->course_id, 'course' => $row->Course, 'chapter_count' => $row->Chapters_Count, 'user_count' => $row->User_Count, 'start_date' => $row->Start_date, 'end_date' => $row->End_Date);
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
                if ($col != 0) {
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
                }
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

                $col++;
            }

            // Fetching the table data
            $row = 2;
            foreach ($query->result() as $data) {
                $col = 0;
                foreach ($fields as $field) {
                    if ($col != 0) {
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
            header('Content-Disposition: attachment;filename="Chapter_Report for' . date('d-M-y H_i_s') . '.xls"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
        }
    }

    public function course_specific_index() {
        $data['main_content'] = 'admin_company/reports/course_wiseReports/course_specific_reports/list';
        $data['course_specific_id'] = $this->input->post('course_id');
        $data['course_data'] = $this->companycourses_model->get_courses_by_id($this->input->post('course_id'));
        $this->load->view('includes/template', $data);
    }

    public function course_specific_list() {
        $usernm = $this->session->userdata('user_name');
        $userid = $this->session->userdata('id');
        $course_specific_id = $this->input->post('course_id');
        $course_data = $this->companycourses_model->get_courses_by_id($course_specific_id);
        $limit = $this->input->post('rows'); //no. of rows
        $sidx = 'id';
        $sord = "desc";

        if ($this->input->post('search') == 'true') {
            $search_string_array = json_decode($this->input->post('search_string_array'));
        }
        $page = trim($this->input->post('page'));
        if ($page == "") {
            $page = 1;
        }
        $result = $this->Company_coursewisereports_model->get_course_specific_report( $course_specific_id, $sidx, $sord, 0, $limit, $search_string_array);
        //  $result = json_decode($query[0]['@course_specific_user_status']);
        $count = count($result);
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


        if (!array_key_exists("is_csv", $_POST)) {

            $response = new stdClass();
            $response->page = $page;

            $response->total = $totalpages;
            $response->records = $count;
            $response->start = $start + 1;
           
            $response->end = $start + $limit;
            $i = 0;

             foreach (array_slice($result,$start,$limit) as $row) {
              if (is_null($row->completed_on)) {
              $completion_date = "";
              } else {
              $completion_date = $row->completed_on;
              }

              $response->rows[$i] = array('user' => $row->user_name, 'completion_status' => $row->completion_status,'completed_on'=>$completion_date);
              $i++;
              } 
            echo json_encode($response);
        } else {
            $this->load->library('excel');
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");

            $objPHPExcel->setActiveSheetIndex(0);



            $col = 0;
            $fields = array('User', 'Status', 'Completion Date');
            foreach ($fields as $field) {

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

                $col++;
            }

            // Fetching the table data
            $row = 2;
            $fields = array('user_name', 'completion_status', 'completed_on');
            foreach ($result as $data) {
                $col = 0;
                foreach ($fields as $field) {

                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);

                    $col++;
                }

                $row++;
            }

            $objPHPExcel->setActiveSheetIndex(0);

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            ob_end_clean();
            // Sending headers to force the user to download the file
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename=" '.$this->lang->line('lbl_course_specific_report_list') . $course_data[0]['name'] . ' ' . date('d-M-y H_i_s') . '.xls"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
        }
    }

}
