<?php

class admin_companychapterwisereports extends CI_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('companychapters_model');
        $this->load->model('companycmspage_model');
        $this->load->model('Company_chapterwisereports_model');


        if (!$this->session->userdata('is_logged_in')) {
            redirect('admin_company/login');
        }
    }

    public function index() {
      
        $data['main_content'] = 'admin_company/reports/chapter_wiseReports/list';
        $this->load->view('includes/template', $data);
    }

    public function chapterwise_report_list() {
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
        $count = $this->Company_chapterwisereports_model->get_chapterwise_report($userid, $sidx, $sord, 0, $limit, $search_string_array, $is_count = true);

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

        $query = $this->Company_chapterwisereports_model->get_chapterwise_report($userid, $sidx, $sord, $start, $limit, $search_string_array, $is_count = false);
        if (!array_key_exists("is_csv", $_POST)) {
            $response = new stdClass();
            $response->page = $page;

            $response->total = $totalpages;
            $response->records = $count;
            $response->start = $start + 1;
            $i = 0;

            foreach ($query->result() as $row) {


                $response->rows[$i] = array('chapter_id' => $row->Chapter_Id, 'chapter' => $row->Chapter_Name, 'course' => $row->Course, 'description' => substr($row->Description, 0, 30), 'start_date' => $row->Start_date, 'end_date' => $row->End_Date, 'lesson_status' => $row->Status_count);
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

    public function chapter_specific_index() {
        $data['chapter_specific_id'] = $this->input->post('chapter_id');
        $data['main_content'] = 'admin_company/reports/chapter_wiseReports/chapter_specific_report/list';
        $this->load->view('includes/template', $data);
    }

    public function chapter_specific_list() {
        $usernm = $this->session->userdata('user_name');
        $userid = $this->session->userdata('id');
        $chapter_specific_id = $this->input->post('chapter_id');
        $chapter_data=  $this->companychapters_model->get_chapters_by_id($chapter_specific_id);
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
        $count = $this->Company_chapterwisereports_model->get_chapter_specific_report($userid,$chapter_specific_id, $sidx, $sord, 0, $limit, $search_string_array, $is_count = true);

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

        $query = $this->Company_chapterwisereports_model->get_chapter_specific_report($userid,$chapter_specific_id, $sidx, $sord, $start, $limit, $search_string_array, $is_count = false);
        if (!array_key_exists("is_csv", $_POST)) {
            $response = new stdClass();
            $response->page = $page;

            $response->total = $totalpages;
            $response->records = $count;
            $response->start = $start + 1;
            $i = 0;
$completed_on="";
            foreach ($query->result() as $row) {
                if($row->completion_details==NULL){
                  $completed_on='';  
                }
                else{
                 $completed_on=json_decode($row->completion_details)->completed_on;   
                }


                $response->rows[$i] = array('user' => $row->User, 'percentage' => $row->Course_Attempt, 'attempt_status' => $row->Lesson_status, 'completed_date' =>$completed_on);
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
            foreach ($query->result() as $data) {
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
            header('Content-Disposition: attachment;filename="Chapter_specific_Report for '.$chapter_data[0]['name'] .' '. date('d-M-y H_i_s') . '.xls"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
        }
    }

}
