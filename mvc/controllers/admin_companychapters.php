<?php

class Admin_companychapters extends CI_Controller {

    /**
     * name of the folder responsible for the views 
     * which are manipulated by this controller
     * @constant string
     */
    const VIEW_FOLDER = 'admin_company/chapters';

    /**
     * Responsable for auto load the model
     * @return void
     */
    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('companychapters_model');
        $this->load->model('companycourses_model');
        $this->load->model('companycmspage_model');
        $this->load->model('Companyuser_model');
        $this->load->model('category_model');
        $this->load->helper('url');
        $this->load->library('gcharts');
        $this->load->model('companycmspage_model');
        $this->load->library('Encryption');


        if (!$this->session->userdata('is_logged_in')) {
            redirect('admin_company/login');
        }
    }

    /**
     * Load the main view with all the current model model's data.
     * @return void
     */
    public function index() {

        //all the posts sent by the view
        //$this->output->enable_profiler(TRUE);	
        $search_string = $this->input->post('search_string');
        $order = $this->input->post('order');
        $order_type = $this->input->post('order_type');
        $userid = $this->session->userdata('id');
        $usernm = $this->session->userdata('user_name');

        //pagination settings
        $config['per_page'] = 15;
        $config['base_url'] = base_url() . 'admin_company/chapters';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 20;
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';

        //limit end
        $page = $this->uri->segment(3);

        //math to get the initial record to be select in the database
        $limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0) {
            $limit_end = 0;
        }

        //if order type was changed
        if ($order_type) {
            $filter_session_data['order_type'] = $order_type;
        } else {
            //we have something stored in the session? 
            if ($this->session->userdata('order_type')) {
                $order_type = $this->session->userdata('order_type');
            } else {
                //if we have nothing inside session, so it's the default "Asc"
                $order_type = 'Asc';
            }
        }
        //make the data type var avaible to our view
        $data['order_type_selected'] = $order_type;

        //filtered && || paginated
        if ($search_string !== false && $order !== false || $this->uri->segment(3) == true) {

            if ($search_string) {
                $filter_session_data['search_string_selected'] = $search_string;
            } else {
                $search_string = $this->session->userdata('search_string_selected');
            }
            $data['search_string_selected'] = $search_string;

            if ($order) {
                $filter_session_data['order'] = $order;
            } else {
                $order = $this->session->userdata('order');
            }
            $data['order'] = $order;

            //save session data into the session
            if (isset($filter_session_data)) {
                $this->session->set_userdata($filter_session_data);
            }

            //fetch sql data into arrays
            $data['count_products'] = $this->companychapters_model->count_chapters($userid, $search_string, $order, $userid);
            $config['total_rows'] = $data['count_products'];

            //fetch sql data into arrays
            if ($search_string) {
                if ($order) {
                    $data['chapters'] = $this->companychapters_model->get_chapters($userid, $search_string, $order, $order_type, $config['per_page'], $limit_end);
                } else {
                    $data['chapters'] = $this->companychapters_model->get_chapters($userid, $search_string, '', $order_type, $config['per_page'], $limit_end);
                }
            } else {
                if ($order) {
                    $data['chapters'] = $this->companychapters_model->get_chapters($userid, '', $order, $order_type, $config['per_page'], $limit_end);
                } else {
                    $data['chapters'] = $this->companychapters_model->get_chapters($userid, '', '', $order_type, $config['per_page'], $limit_end);
                }
            }
        } else {

            //clean filter data inside section
            $filter_session_data['chapters_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['count_products'] = $this->companychapters_model->count_chapters($userid);
            $data['chapters'] = $this->companychapters_model->get_chapters($userid, '', '', $order_type, $config['per_page'], $limit_end);
            $config['total_rows'] = $data['count_products'];
        }//!isset($search_string) && !isset($order)
        //initializate the panination helper 
        $this->pagination->initialize($config);


        $data['sessionuserdata'] = $this->Companyuser_model->get_userdetails_by_id($userid);
        $alloted_bytes = $data['sessionuserdata'][0]['host_space_kb'];
        $occupied_bytes = $data['sessionuserdata'][0]['occupied_disk_space'];
        $remainsize = $data['sessionuserdata'][0]['available_disk_space'];
        $data['totaldiskspace'] = $this->bytesToSize($alloted_bytes);
        $data['remainspace'] = $this->bytesToSize($remainsize);
        $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);
        //load the view
        $data['main_content'] = 'admin_company/chapters/list';
        $this->load->view('includes/template', $data);
    }

//index

    public function bytesToSize($bytes) {

        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

    public function add() {
        $this->load->helper('directory');

        $courseid = $this->uri->segment(4);
        $userid = $this->session->userdata('id');
        $usernm = $this->session->userdata('user_name');
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
            $this->form_validation->set_rules('cname', 'Name', 'required');
            $this->form_validation->set_rules('courseid', 'Course Id', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');


            //if the form has passed through the validation
            if ($this->form_validation->run()) {
                $file_element_name = 'chapterattach';
                $data['chapterattach'] = $this->uploadImagedocuments($file_element_name);
                $file_element_bg = 'chapterimage';
                //   $data['chapterimage'] = $this->uploadImagelogo($file_element_bg);


                if (!empty($data['chapterattach']['file_name'])) {

                    $chapterattach = $data['chapterattach']['file_name'];
                } else {
                    $chapterattach = '';
                }
                if (!empty($data['chapterimage']['file_name'])) {
                    $imagebgimage = $data['chapterimage']['file_name'];
                } else {
                    $imagebgimage = '';
                }

                $data_to_store = array(
                    'name' => $this->input->post('cname'),
                    'description' => $this->input->post('description'),
                    'course_id' => $this->input->post('courseid'),
                    'user_id' => $this->session->userdata('id'),
                    'chapter_image_path' => $imagebgimage,
                    'chapter_video_id' => $this->input->post('videoidassign'),
                    'chapter_file_type' => $this->input->post('file_type'),
                   
                    'file_size' => $this->input->post('file_size'),
                    'created_date' => date('Y-m-d'),
                    'created_by' => $this->session->userdata('user_name'),
                    'IsActive' => 'Y',
                );
                //if the insert has returned true then we show the flash message
                $inserted_chapter_id = $this->companychapters_model->store_chapters($data_to_store);
                if ($inserted_chapter_id > 0) {
                    $user_course_directory_path = './assets/chapter_documents/' . $userid . '/' . $this->input->post('courseid');
                    // $user_directory = create_directory($user_directory_path);
                    $user_course_chapter_path = $user_course_directory_path . '/' . $inserted_chapter_id;
                    $user_course_chapter_directory = create_directory($user_course_chapter_path);
                    if (!empty($data['chapterattach']['file_name'])) {
                        if ($this->uploadImage('chapterimage', $user_course_chapter_directory)) {
                            $user_course_chapter_image_path = $user_course_chapter_directory . '/' . $_FILES['chapterimage']['name'];
                            $course_chapter_image_path_data = array('chapter_image_path' => $user_course_chapter_image_path);
                            $this->companychapters_model->update_chapters($inserted_chapter_id, $course_chapter_image_path_data);
                        }
                    }
                    if ($this->input->post('file_path') != "") {

                        $user_course_chapter_zipped_file_path = $this->encryption->decrypt($this->input->post('file_path'));
                        $user_course_chapter_directory_name = basename($user_course_chapter_zipped_file_path, ".zip");
                        $user_course_chapter_unzipped_directory = create_directory($user_course_chapter_directory . '/' . $user_course_chapter_directory_name);
                        $unzipped_content_directory_name = $this->Unzip($user_course_chapter_zipped_file_path, $user_course_chapter_unzipped_directory);
               $imsmanifest_xml_file_parent_folder = $user_course_chapter_directory;
                        $imsmanifest_xml_file_path = $this->get_imsmanifest_xml_file_path($imsmanifest_xml_file_parent_folder, 'imsmanifest.xml');
                        $xml = simplexml_load_file($imsmanifest_xml_file_path) or die("Error: in getting imsmanifest file");

                        $file_to_run_e_course = $xml->resources->resource['href'];
                        $file_to_run_e_course = strval($file_to_run_e_course);
                        $file_path_to_run_e_course =str_replace("./","", $this->get_imsmanifest_xml_file_path($imsmanifest_xml_file_parent_folder, $file_to_run_e_course));
                    $file_path_to_run_e_course =str_replace('\\','/',$file_path_to_run_e_course);
                        $course_chapter_path_data = array('file_path' => "$file_path_to_run_e_course");
                            $this->companychapters_model->update_chapters($inserted_chapter_id, $course_chapter_path_data);
                  ;
                  echo 

                        $frame_details_file_path = $this->get_imsmanifest_xml_file_path($imsmanifest_xml_file_parent_folder, 'frame.xml');
                        $xml = simplexml_load_file($frame_details_file_path) or die("Error: in getting run file");
                        $slide_details_array = "";
                        $slide_count = count($xml->nav_data->outline->links->slidelink->links->slidelink);
                        $chapter_id_from_xml = $xml->nav_data->outline->links->slidelink[0]['slideid'];
                        echo $chapter_id_from_xml.'xml';
                        $i = 1;
                        foreach ($xml->nav_data->outline->links->slidelink->links->slidelink as $row) {
                            $slide_id = str_replace("$chapter_id_from_xml.", "", $row['slideid']);
                            $slide_name = $row['displaytext'];
                            $slide_details_array.="{id:'$slide_id',slide_no:'$i',name:'$slide_name'}";
                            if ($i < $slide_count) {
                                $slide_details_array.=",";
                            }$i++;
                        }
                       
                        //  echo $slide_details_array;

                        $course_chapter_slide_details_data = array('chapter_slide_details' => $slide_details_array);
$this->companychapters_model->update_chapters($inserted_chapter_id, $course_chapter_slide_details_data);
                  }
                } else {
                    $data['flash_message'] = FALSE;
                }
            }

            $data['courselist'] = $this->companycourses_model->get_courses_droplist($userid);
        }
        $data['coursedropdown'] = $this->companycourses_model->get_dropdown_list($userid);
        $data['sessionuserdata'] = $this->Companyuser_model->get_userdetails_by_id($userid);

        $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);
        //load the view
        $data['main_content'] = 'admin_company/chapters/add';
    $this->load->view('includes/template', $data);
    }

    /**
     * Update item by his id
     * @return void
     */
    public function update() {
        //product id 
        //$this->output->enable_profiler(TRUE);	
        $id = $this->uri->segment(4);
        $userid = $this->session->userdata('id');
        $usernm = $this->session->userdata('user_name');
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
            $this->form_validation->set_rules('cname', 'Name', 'required');
            $this->form_validation->set_rules('courseid', 'Course Id', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()) {
                $data_to_store = array(
                    'name' => $this->input->post('cname'),
                    'description' => $this->input->post('description'),
                    'courseid' => $this->input->post('courseid'),
                    'userid' => $this->session->userdata('id'),
                    //'chapter_image' => $imagelogo,
                    'chapter_videoid' => $this->input->post('videoidassign'),
                    'modify_date' => date('Y-m-d'),
                    'modify_by' => $this->session->userdata('user_name')
                );
                //if the insert has returned true then we show the flash message
                if ($this->companychapters_model->update_chapters($id, $data_to_store) == TRUE) {
                    $this->load->model('Companyuser_model');

                    $data['usersdata'] = $this->Companyuser_model->get_userdetails_by_id($userid);
                    $userdataadd = $data['usersdata'];
                    $useddisk = $userdataadd[0]['current_diskspace'];
                    $totaldisk = $userdataadd[0]['disk_sizespace'];
                    $currentdisk = $this->input->post('videoidsize');

                    $tempcurrentdisk = $useddisk + $currentdisk;
                    //echo $new_current_sizedisk=$totaldisk-$tempcurrentdisk;					

                    if ($tempcurrentdisk >= $totaldisk) {
                        $space_filled = 'Y';
                    } else {
                        $space_filled = 'N';
                    }
                    $spacesize = array(
                        'current_diskspace' => $tempcurrentdisk,
                        'modify_date' => date('Y-m-d'),
                        'modify_by' => $this->session->userdata('user_name'),
                        'space_filled' => $space_filled,
                    );
                    //var_dump($spacesize);
                    if ($this->Companyuser_model->update_filesizeacct($userid, $spacesize) == TRUE) {

                        $this->session->set_flashdata('flash_message', 'updated');
                    }
                } else {
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
            }
        }
        $data['courselist'] = $this->companycourses_model->get_courses_droplist($userid);
        $data['coursedropdown'] = $this->companycourses_model->get_dropdown_list();
        $data['chaptersdata'] = $this->companychapters_model->get_chapters_by_id($id);
        $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);
        //load the view
        $data['main_content'] = 'admin_company/chapters/edit';
        $this->load->view('includes/template', $data);
    }

//update

    /**
     * Delete product by his id
     * @return void
     */
    public function delete() {
        //product id 
        $id = $this->uri->segment(4);
        $this->companychapters_model->delete_chapters($id);

        redirect('admin_company/chapters');
    }

//edit

    public function viewchapter() {
        //product id 
        //$this->output->enable_profiler(TRUE);	
        $id = $this->uri->segment(4);
        $userid = $this->session->userdata('id');
        $usernm = $this->session->userdata('user_name');
        //if save button was clicked, get the data sent via post
        $this->gcharts->load('AreaChart');
        $this->load->model('companycourses_model');
        $userid = $this->session->userdata('id');
        $usernm = $this->session->userdata('user_name');

        $todaydt = date("Y-m-d H:i:s");
        $datefrom = date('Y-m-01');
        $dateto = date('Y-m-t');
        $coursename = $id;
        $data['courses'] = $this->companycourses_model->get_graphcourses($userid, $datefrom, $dateto, $coursename);
        //$data['listdtils'] = $this->companycourses_model->get_reporttable_of_graph($userid,$datefrom,$dateto,$coursename);
        $data['listdtils'] = $this->companycourses_model->get_graphcourses($userid, $datefrom, $dateto, $coursename);
        //echo count($data['courses']);
        //echo var_dump($data['courses']);			
        $this->gcharts->DataTable('Inventory');
        $data['dispdata'] = $data['courses'];
        if (count($data['courses']) > 0) {
            $this->gcharts->DataTable('Inventory')->addColumn('string', 'Classroom', 'class');
            $this->gcharts->DataTable('Inventory')->addColumn('number', 'Dates wise Count', 'Display the dates');
            for ($j = 0; $j < count($data['courses']); $j++) {

                $this->gcharts->DataTable('Inventory')->addRow(array(
                    ($data['courses'][$j]['clickcourse_date']),
                    ($data['courses'][$j]['cnt']),
                ));
            }

            $config = array(
                'title' => 'Course Name'
            );
            //$this->gcharts->ColumnChart('Inventory')->setConfig($config);
            $this->gcharts->AreaChart('Inventory')->setConfig($config);
        } else {
            $this->session->set_flashdata('flash_message', 'nodata');
        }
        $data['listcourse'] = $this->companycourses_model->get_courses_droplist($userid);
        $data['courselist'] = $this->companycourses_model->get_courses_droplist($userid);
        $data['coursedropdown'] = $this->companycourses_model->get_dropdown_list();
        $data['chaptersdata'] = $this->companychapters_model->get_chapters_by_id($id);
        $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);
        //load the view
        $data['main_content'] = 'admin_company/chapters/viewchapter';
        $this->load->view('includes/template', $data);
    }

//update

    public function schedulecourses() {
        //$this->output->enable_profiler(TRUE);
        $userid = $this->session->userdata('id');
        $usernm = $this->session->userdata('user_name');
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
            $this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()) {
                $data_to_store = array(
                    'name' => $this->input->post('name'),
                    'description' => $this->input->post('description'),
                    'usercat_id' => $this->session->userdata('id'),
                    'created_date' => date('Y-m-d'),
                    'created_by' => $this->session->userdata('user_name'),
                    'IsActive' => 'Y',
                );
                //if the insert has returned true then we show the flash message
                if ($this->companycategory_model->store_category($data_to_store)) {
                    $data['flash_message'] = TRUE;
                } else {
                    $data['flash_message'] = FALSE;
                }
            }
        }

        $data['listschedule'] = $this->companycourses_model->get_schedulelist_data($userid);
        $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);

        $data['main_content'] = 'admin_company/chapters/schedulecourse';
        $this->load->view('includes/template', $data);
    }

    public function uploadImage($file_element_name) {

        $config['upload_path'] = './assets/user_documents/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '100';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($file_element_name)) {
            return false;
        } else {
            $data = $this->upload->data();
            return $data;
        }
    }

    public function uploadImagedocuments($file_element_name) {

        $config['upload_path'] = './assets/chapter_documents/';
        $config['allowed_types'] = 'ppt|pdf';
        $config['max_size'] = '1000';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($file_element_name)) {
            return false;
        } else {
            $data = $this->upload->data();
            return $data;
        }
    }

    public function upload_chapters() {

        if ($_FILES['SelectedFile']['error'] > 0) {
            $this->outputJSON('An error ocurred when uploading.');
        }

        if ($_FILES['SelectedFile']['size'] > 5000000000) {
            $this->outputJSON('File uploaded exceeds maximum upload size.');
        }

// Check if the file exists
        if (file_exists('upload/' . $_FILES['SelectedFile']['name'])) {
            $this->outputJSON('File with that name already exists.');
        }

// Upload file

        $filename = $_FILES['SelectedFile']['name']; //zip file name
        $destination_directory_path = './assets/chapter_documents/' . $this->session->userdata('id');

//$diretory_name = $destination_directory_path . '/' . $userid;//where zip file will get store
        $diretory_name = $this->create_directory($destination_directory_path);

        $file_destination_path = $diretory_name . '/' . $filename; //where u want to upload zip file
        if (move_uploaded_file($_FILES['SelectedFile']['tmp_name'], $file_destination_path)) {//move tmp_name file to destination path

            /* $unzipped_content_directory_name = $this->Unzip($file_destination_path, $diretory_name);
              $imsmanifest_xml_file_parent_folder = $diretory_name . '/' . $unzipped_content_directory_name;
              $imsmanifest_xml_file_path = $this->get_imsmanifest_xml_file_path($imsmanifest_xml_file_parent_folder, 'imsmanifest.xml');
              $xml = simplexml_load_file($imsmanifest_xml_file_path) or die("Error: Cannot create object");

              $file_to_run_e_course = $xml->resources->resource['href'];
              $file_to_run_e_course = strval($file_to_run_e_course);
              $file_path_to_run_e_course = $this->get_imsmanifest_xml_file_path($imsmanifest_xml_file_parent_folder, $file_to_run_e_course);
              $file_path_to_run_e_course = md5($file_to_run_e_course);
              unlink($file_destination_path); */
            $zipped_file_path = $this->encryption->encrypt($file_destination_path);
            $this->outputJSON($zipped_file_path, 'success');
        } else {
            $this->outputJSON('Error while unzipping');
        }
    }

    public function outputJSON($msg, $status = 'error') {
        header('Content-Type: application/json');
        die(json_encode(array(
            'data' => $msg,
            'status' => $status
        )));
    }

    public function Unzip($file, $path) {
echo 'asa'.$file;
        $zip = new ZipArchive;
        $res = $zip->open($file);
        
      $perms = fileperms($file);
     
      //  if ($res === TRUE) {

            $zip->extractTo($path);
            $dir = trim($zip->getNameIndex(0), '/');
            $zip->close();
        //}
        echo $file;
        return $dir;
    }

    public function create_directory($destination_directory_path) {
        // $userid = $this->session->userdata('id');

        if (!is_dir($destination_directory_path)) {

            mkdir($destination_directory_path, 0755, true);
        }
        return $destination_directory_path;
    }

    public function get_imsmanifest_xml_file_path($imsmanifest_xml_file_parent_folder, $file_to_chose) {

        foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($imsmanifest_xml_file_parent_folder)) as $filePath) {
            if (strpos($filePath, $file_to_chose) !== false) {

                break;
            }
        }
        return $filePath;
    }

}
