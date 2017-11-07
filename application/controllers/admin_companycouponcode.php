<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_couponcode
 *
 * @author a
 */
class admin_companycouponcode extends CI_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('companycoupon_model');
        $this->load->model('companycourses_model');

        if (!$this->session->userdata('is_logged_in')) {
            redirect('admin_company/login');
        }
    }

    public function index() {
        $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);
        $data['main_content'] = 'admin_company/coupon_code/list';
        $this->load->view('includes/template', $data);
    }

    public function couponcode_list() {
        $usernm = $this->session->userdata('user_name');
        $userid = $this->session->userdata('id');
        $limit = $this->input->post(rows); //no. of rows
        $sidx = 'id';
        $sord = "desc";
        $search_string_array = "";
        if ($this->input->post('search') == 'true') {
            $search_string_array = json_decode($this->input->post('search_string_array'));
        }
        $page = trim($this->input->post('page'));
        if ($page == "") {
            $page = 1;
        }
        $count = $this->companycoupon_model->get_couponcode($sidx, $sord, 0, $limit, $search_string_array, $is_count = true);

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

        $query = $this->companycoupon_model->get_couponcode($sidx, $sord, $start, $limit, $search_string_array, $is_count = false);
        $response = new stdClass();
        $response->page = $page;

        $response->total = $totalpages;
        $response->records = $count;
        $response->start = $start + 1;
        $response->end = $start + $limit;


        $i = 0;

        foreach ($query->result() as $row) {


            $response->rows[$i] = array('id' => $this->encryption->encrypt($row->id), 'name' => $row->name, 'percentage_off' => $row->percentage_off, 'start_date' => $row->start_date, 'end_date' => $row->end_date, 'is_active' => $row->is_active);
            $i++;
        }
        echo json_encode($response);
    }

    public function add() {
        $userid = $this->session->userdata('id');
        $usernm = $this->session->userdata('user_name');
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
            if ($this->form_validation->run()) {
                $data_to_store = array(
                    'name' => $this->input->post('name'),
                    'percentage_off' => $this->input->post('percentage_off'),
                    'start_date' => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('start_date')))),
                    'end_date' => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('end_date')))),
                    'is_active' => 'Y',
                );

                $trim_insert_array = trim_array($data_to_store);
                $manadate_insert_details = $this->mandate_update->get_insert_details();


                //if the insert has returned true then we show the flash message
                if ($this->companycoupon_model->add(array_merge($trim_insert_array, $manadate_insert_details))) {
                    $this->session->set_flashdata('message', $this->lang->line('msg_dept_insert_success'));
                    redirect('admin_company/coupon_code');
                } else {
                    $data['message'] = $this->lang->line('error_add');
                }
            } else {
                // $data['category_data']=array($this->input->post());
                $data['message'] = validation_errors();
            }
        }
        //load the view
        $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);
        $data['main_content'] = 'admin_company/coupon_code/add';
        $this->load->view('includes/template', $data);
    }

    public function update() {
        //product id 
        $id = $this->encryption->decrypt($this->input->post(couponcode_id));
        $data['couponcode_data'] = $this->companycoupon_model->get_code_by_id($id);

        if (array_key_exists("name", $_POST)) {
            //form validation

            if ($this->form_validation->run()) {

                $data_to_store = array(
                    'name' => $this->input->post('name'),
                    'percentage_off' => $this->input->post('percentage_off'),
                    'start_date' => $this->input->post('start_date'),
                    'end_date' => $this->input->post('end_date'),
                    'is_active' => $this->input->post('is_active'),
                );
                $trim_insert_array = trim_array($data_to_store);
                $manadate_insert_details = $this->mandate_update->get_update_details();


                $query = $this->companycoupon_model->update_couponcode($id, array_merge($trim_insert_array, $manadate_insert_details));

                if ($query != NULL) {
                    $this->session->set_flashdata('message', $this->lang->line('msg_dept_insert_success'));
                    redirect('admin_company/coupon_code');
                } else {
                    $data['message'] = $this->lang->line('error_edit');
                }
            }//validation run
            else {
                $data['message'] = validation_errors();
                $data['couponcode_data'] = $this->input->post();
            }
        }


        $data['footerdata'] = $this->companycmspage_model->list_cmspage();
        $data['couponcode_id'] = $this->input->post(couponcode_id);
        $data['main_content'] = 'admin_company/coupon_code/edit';
        $this->load->view('includes/template', $data);
    }
  

}
