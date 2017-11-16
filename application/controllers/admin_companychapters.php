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






        if ($this->session->userdata('is_logged_in') !== TRUE) {
            redirect('admin_company/login');
        } else {
            $this->load->model('companychapters_model');
            $this->load->model('companycourses_model');
            $this->load->model('Companyuser_model');
            $this->load->model('category_model');
        }
    }

    /**
     * Load the main view with all the current model model's data.
     * @return void
     */
    public function index() {
        $usernm = $this->session->userdata('user_name');
        $userid = $this->session->userdata('id');
        $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);
        $data['courses'] = $this->companycourses_model->get_dropdown_list($userid);
        $data['main_content'] = 'admin_company/chapters/list';
        $this->load->view('includes/template', $data);
    }

    public function chapter_list() {
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
        $count = $this->companychapters_model->get_chapters($userid, $sidx, $sord, 0, $limit, $search_string_array, $is_count = true);

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


        $query = $this->companychapters_model->get_chapters($userid, $sidx, $sord, $start, $limit, $search_string_array, $is_count = false);
        $response = new stdClass();
        $response->page = $page;

        $response->total = $totalpages;
        $response->records = $count;
        $response->start = $start + 1;
        $response->end = $start + $limit;
        $i = 0;

        foreach ($query->result() as $row) {
            $response->rows[$i] = array('id' => $this->encryption->encrypt($row->chapterid), 'name' => $row->chaptername, 'course' => $row->coursename, 'description' => $row->chapterdescription, 'startdate' => $row->start_date, 'enddate' => $row->end_date);
            $i++;
        }
        echo json_encode($response);
    }

    public function add() {

        $this->load->helper('directory');
        $this->load->helper('file');

        $userid = $this->session->userdata('id');
        $usernm = $this->session->userdata('user_name');
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            if ($this->form_validation->run()) {
                $data_to_store = array(
                    'name' => $this->input->post('name'),
                    'description' => $this->input->post('description'),
                    'course_id' => $this->input->post('course_id'),
                    'created_at' => date('Y-m-d'),
                    'created_by' => $userid,
                );
                $media_file_type = $this->input->post('file_type');
                if ($media_file_type == 'video') {
                    $data_to_store['file_type'] = $this->input->post('file_type');
                    $data_to_store['file_path'] = $this->input->post('file_path');
                    $data_to_store['file_size'] = $this->input->post('file_size');
                    $data_to_store['content_path'] = $this->input->post('video_id');
                }
                $trim_insert_array = trim_array($data_to_store);
                $manadate_insert_details = $this->mandate_update->get_insert_details();
                //if the insert has returned true then we show the flash message
                $inserted_chapter_id = $this->companychapters_model->store_chapters(array_merge($trim_insert_array, $manadate_insert_details)); //here data gets stored
                if ($inserted_chapter_id > 0) {//if chapter added successfully
                    $user_parent_directory_path = './uploads/chapter_documents/comp_' . $this->session->userdata('company_id'); //set user_company directory path
                    $user_directory_path = $user_parent_directory_path . '/user_' . $userid; //set user directory path
                    $user_course_directory_path = $user_directory_path . '/course_' . $this->input->post('course_id'); //set user directory path

                    $user_course_chapter_path = $user_course_directory_path . '/chapter_' . $inserted_chapter_id; //chapter path=course_path+chapter_id
                    $user_course_chapter_directory = create_directory($user_course_chapter_path); //directory is created for per chapter
                    if ($_FILES['chapterimage']['size'] != 0) {

                        $config['upload_path'] = $user_course_chapter_directory;
                        $config['allowed_types'] = 'gif|jpg|png|jpeg';
                        $config['max_size'] = '1000';
                        $config['max_width'] = '1024';
                        $config['max_height'] = '768';
                        $config['overwrite'] = FALSE;
                        $upload_data = $this->upload->do_my_upload('chapterimage', $config);

                        if ($upload_data['status'] == TRUE) {
                            $user_course_chapter_image_path = $user_course_chapter_directory . '/' . $upload_data['details']['raw_name'].$upload_data['details']['file_ext'];
                            $course_chapter_image_path_data = array('image_path' => substr($user_course_chapter_image_path, 2),
                                'image_size' => $upload_data['details']['file_size'] * 1024);
                            $this->companychapters_model->update_chapters($inserted_chapter_id, $course_chapter_image_path_data);
                            $this->upload->update_space_availability($this->session->userdata('company_id'), $_FILES['chapterimage']['size']);
                        } else {
                            $data['error_message'] = $upload_data['details'];
                        }
                    }
                    if ($media_file_type == 'Video') {
                        $this->upload->update_space_availability($this->session->userdata('company_id'), $this->input->post('file_size'));
                    } else if ($this->input->post('file_path') != "" && $media_file_type == 'e_course') {//if file_path is not empty & media file_type ise_course 
                        $user_course_chapter_zipped_file_path = $this->encryption->decrypt($this->input->post('file_path')); //decrypt the uploaded zip_folder psth

                        $user_course_chapter_directory_name = basename($user_course_chapter_zipped_file_path, ".zip"); //get name of .zip file
                        $user_course_chapter_unzipped_directory = create_directory($user_course_chapter_directory . '/' . $user_course_chapter_directory_name); //create directory depend on name of zip file under chapter_chapter_id directory
                        $unzipped_status = $this->Unzip($user_course_chapter_zipped_file_path, $user_course_chapter_unzipped_directory); //unzip file to specified file path ,file path is second arguments
                        $folder_name = array(
                            'folder_name' => $user_course_chapter_directory_name . '.zip');
                        $this->companychapters_model->update_chapters($inserted_chapter_id, $folder_name); //update chapters  with folder_name as folder_name.zip

                        if ($unzipped_status == TRUE) {//if unzipped successfully
                            $unziped_chapter_content_size = get_directory_size($user_course_chapter_unzipped_directory);
                            if ($this->upload->check_for_space_availability($userid, get_directory_size($user_course_chapter_unzipped_directory))) {
                                $imsmanifest_xml_file_parent_folder = $user_course_chapter_directory; //imsmanifest parent folder is chapter spaecific folder
                                $imsmanifest_xml_file_path = $this->get_imsmanifest_xml_file_path($imsmanifest_xml_file_parent_folder, 'imsmanifest.xml'); //get imsmanifest file path
                                $xml = simplexml_load_file($imsmanifest_xml_file_path) or die("Error: in getting imsmanifest file..Please contact adminiustrator"); //load load imsmanifest file specific to imsmanifest file paths
                                $file_to_run_e_course = $xml->resources->resource['href']; //read imsmanifest file&get which file to be run from href value
                                $file_to_run_e_course = strval($file_to_run_e_course);
                                $file_path_to_run_e_course = str_replace("./", "", $this->get_imsmanifest_xml_file_path($imsmanifest_xml_file_parent_folder, $file_to_run_e_course)); //get file path of file which is to be run
                                $file_path_to_run_e_course = str_replace('\\', '/', $file_path_to_run_e_course);
                                $course_chapter_path_data = array('file_path' => $file_path_to_run_e_course,
                                    'file_size' => $unziped_chapter_content_size);
                                $this->companychapters_model->update_chapters($inserted_chapter_id, $course_chapter_path_data); //get file path& store it in database
                                $this->upload->update_space_availability($this->session->userdata('company_id'), $unziped_chapter_content_size);


                                $frame_details_file_path = $this->get_imsmanifest_xml_file_path($imsmanifest_xml_file_parent_folder, 'frame.xml'); //get frame.xml file path which describes slide details as slide id&slidename

                                $xml = simplexml_load_file($frame_details_file_path) or die("Error: in getting run file");


                                $slide_count = count($xml->nav_data->outline->links->slidelink->links->slidelink); //get no of slides from frame.xml
                                // $chapter_id_from_xml = $xml->nav_data->outline->links->slidelink[0]['slideid']; //get slide id which will require to detect slide id
                                //  echo $chapter_id_from_xml.'xml';
                                $slide_detail_object = new stdClass();
                                $slides_details_array = array();
                                $i = 1;
                                //  print_r($xml->nav_data->outline->links->slidelink->links->slidelink);
                                foreach ($xml->nav_data->outline->links->slidelink->links->slidelink as $row) {//get slide detaikls
                                    $slide_detail_object->id = str_replace("_player.", "", $row['slideid']);
                                    $slide_detail_object->name = (string) $row['displaytext'][0];
                                    $slide_detail_object->slide_no = $i;

                                    array_push($slides_details_array, $slide_detail_object);
                                    unset($slide_detail_object);

                                    $i++;
                                }


                                $course_chapter_slide_details_data = array('chapter_slide_details' => json_encode($slides_details_array),
                                    'file_type' => 'e_course',
                                    'folder_name' => $user_course_chapter_directory_name . '.zip',
                                    'content_path' => $user_course_chapter_unzipped_directory,
                                    'file_size' => get_directory_size($user_course_chapter_directory));
                                $this->companychapters_model->update_chapters($inserted_chapter_id, $course_chapter_slide_details_data); //update chapters slide details
                                $this->companycourses_model->update_courses($this->input->post('course_id'), array('size' => get_directory_size($user_course_directory_path)));
                                $rename = rename($this->encryption->decrypt($this->input->post('file_path')), $user_course_chapter_directory . '/' . $user_course_chapter_directory_name . '.zip');
                            } else {//if space is not available
                                unlink($user_course_chapter_unzipped_directory);
                                $this->session->set_flashdata('upload_message', "Your available memory quota is insufficient to upload this content");
                            }
                        }
                    } else if ($media_file_type == 'pdf') {
                        if ($this->upload->check_for_space_availability($userid, $_FILES['pdf_file_to_upload']['size'])) {
                            $userid = $this->session->userdata('id');
                            $user_parent_directory_path = './uploads/chapter_documents/comp_' . $this->session->userdata('company_id');
                            $user_parent_directory = create_directory($user_parent_directory_path);
                            $user_directory_path = $user_parent_directory . '/user_' . $userid;
                            $user_directory = create_directory($user_directory_path);
                            $course_directory = create_directory($user_directory . '/course_' . $this->input->post('course_id'));
                            $chapter_directory = create_directory($course_directory . '/chapter_' . $inserted_chapter_id);
                            //where u want to upload zip file

                            $config['upload_path'] = $chapter_directory;
                            $config['allowed_types'] = 'pdf';
                            $config['overwrite'] = FALSE;
                            $upload_data = $this->upload->do_my_upload('pdf_file_to_upload', $config);
                            if ($upload_data['status'] === TRUE) {
                                $pdf_file_array = array('id' => $inserted_chapter_id,
                                    'file_type' => 'pdf',
                                    'file_path' => substr($chapter_directory . '/' . $upload_data['details']['raw_name'] . '.pdf', 2));
                                $this->companychapters_model->update_chapters($inserted_chapter_id, $pdf_file_array); //update chapters slide details
                                $this->upload->update_space_availability($this->session->userdata('company_id'), $_FILES['pdf_file_to_upload']['size']);
                            } else {
                                
                            }
                        } else {
                            $this->session->set_flashdata('upload_message', "Your available memory quota is insufficient to upload PDF file");
                        }
                    }
                    redirect('admin_company/chapters');
                }
            } else {//validaion error
                $data['chapter_data'] = array($this->input->post());
                $data['message'] = validation_errors();
            }
        }
        $data['coursedropdown'] = $this->companycourses_model->get_dropdown_list($userid);
        $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);

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
        $id = $this->encryption->decrypt($this->input->post(chapter_id));
        $data['chapter_data'] = $this->companychapters_model->get_chapters_by_id($id);
        $userid = $this->session->userdata('id');
        $usernm = $this->session->userdata('user_name');
        //if save button was clicked, get the data sent via post
        if (array_key_exists("name", $_POST)) {
            if ($this->form_validation->run()) {

               
                $data_to_update = array(
                    'name' => $this->input->post('name'),
                    'description' => $this->input->post('description'),
                    'course_id' => $this->input->post('course_id'),
                );
                $media_file_type = $this->input->post('file_type');
                if ($media_file_type == 'video') {
                    $data_to_update['file_path'] = $this->input->post('file_path');
                    $data_to_update['file_size'] = $this->input->post('file_size');
                    $data_to_update['content_path'] = $this->input->post('video_id');
                }
                $trim_update_array = trim_array($data_to_update);
                $manadate_update_details = $this->mandate_update->get_update_details();
                //if the insert has returned true then we show the flash message
                $updated_chapter_id = $this->companychapters_model->update_chapters($this->encryption->decrypt(($this->input->post('chapter_id'))), array_merge($trim_update_array, $manadate_update_details)); //here data gets stored


                if ($updated_chapter_id > 0) {//if chapter added successfully
                    $user_parent_directory_path = './uploads/chapter_documents/comp_' . $this->session->userdata('company_id'); //set user_company directory path
                    $user_directory_path = $user_parent_directory_path . '/user_' . $userid; //set user directory path
                    $user_course_directory_path = $user_directory_path . '/course_' . $this->input->post('course_id'); //set user directory path

                    $user_course_chapter_path = $user_course_directory_path . '/chapter_' . $updated_chapter_id; //chapter path=course_path+chapter_id
                    $user_course_chapter_directory = create_directory($user_course_chapter_path); //directory is created for per chapter
                    if ($_FILES['chapterimage']['size'] != 0) {
                        $config['upload_path'] = $user_course_chapter_directory;
                        $config['allowed_types'] = 'gif|jpg|png|jpeg';
                        $config['max_size'] = '1000';
                        $config['max_width'] = '1024';
                        $config['max_height'] = '768';
                        $config['overwrite'] = 'false';
                        $upload_data = $this->upload->do_my_upload('chapterimage', $config);

                        if ($upload_data['status'] == TRUE) {
                            $user_course_chapter_image_path = $user_course_chapter_directory . '/' . $upload_data['details']['raw_name'].$upload_data['details']['file_ext'];
                            $previous_image_path = './' . $data['chapter_data'][0]['image_path'];
                            unlink($previous_image_path);
                            $course_chapter_image_path_data = array('image_path' => substr($user_course_chapter_image_path, 2),
                                'image_size' => $upload_data['details']['file_size'] * 1024);
                            $this->companychapters_model->update_chapters($updated_chapter_id, $course_chapter_image_path_data);
                            $this->upload->update_space_availability($this->session->userdata('company_id'), $_FILES['chapterimage']['size'], $data['chapter_data'][0]['image_size']);
                        } else {
                            $data['error_message'] = $upload_data['details'];
                        }
                    }
                    if ($media_file_type == 'Video') {
                        $this->upload->update_space_availability($this->session->userdata('company_id'), $this->input->post('file_size'));
                    } else if ($this->input->post('file_path') != "" && $media_file_type === 'e_course') {
//if file_path is not empty then decrypt file path
                        $user_course_chapter_zipped_file_path = $this->encryption->decrypt($this->input->post('file_path'));

                        $user_course_chapter_directory_name = basename($user_course_chapter_zipped_file_path, ".zip"); //get name of .zip file
                        $user_course_chapter_unzipped_directory = create_directory($user_course_chapter_directory . '/' . $user_course_chapter_directory_name); //create directory depend on name of zip file under chapter_id directory
                        $previous_content_path = $data['chapter_data'][0]['content_path'];
                        delete_files($previous_content_path, true);
                        $unzipped_status = $this->Unzip($user_course_chapter_zipped_file_path, $user_course_chapter_unzipped_directory); //unzip file to specified file path ,file path is second arguments

                        if ($unzipped_status == TRUE) {
                            $unziped_chapter_content_size = get_directory_size($user_course_chapter_unzipped_directory);
                            if ($this->upload->check_for_space_availability($userid, $unziped_chapter_content_size, $data['chapter_data'][0]['file_size'])) {
                                $imsmanifest_xml_file_parent_folder = $user_course_chapter_directory; //imsmanifest parent folder is chapter spaecific folder
                                $imsmanifest_xml_file_path = $this->get_imsmanifest_xml_file_path($imsmanifest_xml_file_parent_folder, 'imsmanifest.xml'); //get imsmanifest file path
                                $xml = simplexml_load_file($imsmanifest_xml_file_path) or die("Error: in getting imsmanifest file..Please contact adminiustrator"); //load load imsmanifest file specific to imsmanifest file paths
                                $file_to_run_e_course = $xml->resources->resource['href']; //read imsmanifest file&get which file to be run from href value
                                $file_to_run_e_course = strval($file_to_run_e_course);
                                $file_path_to_run_e_course = str_replace("./", "", $this->get_imsmanifest_xml_file_path($imsmanifest_xml_file_parent_folder, $file_to_run_e_course)); //get file path of file which is to be run
                                $file_path_to_run_e_course = str_replace('\\', '/', $file_path_to_run_e_course);
                                $previous_file_path = substr($data['chapter_data'][0]['file_path'], 4);
                                //  unlink($previous_file_path);
                                $course_chapter_path_data = array('file_path' => $file_path_to_run_e_course,
                                    'file_type' => 'e_course',
                                    'file_size' => $unziped_chapter_content_size);

                                $this->companychapters_model->update_chapters($updated_chapter_id, $course_chapter_path_data); //get file path& store it in database
                                ;


                                $frame_details_file_path = $this->get_imsmanifest_xml_file_path($imsmanifest_xml_file_parent_folder, 'frame.xml'); //get frame.xml file path which describes slide details as slide id&slidename

                                $xml = simplexml_load_file($frame_details_file_path) or die("Error: in getting run file");

                                $slide_count = count($xml->nav_data->outline->links->slidelink->links->slidelink); //get no of slides from frame.xml
                                $chapter_id_from_xml = $xml->nav_data->outline->links->slidelink[0]['slideid']; //get slide id which will require to detect slide id
                                //  echo $chapter_id_from_xml.'xml';
                                $slide_detail_object = new stdClass();
                                $slides_details_array = array();
                                $i = 1;
                                foreach ($xml->nav_data->outline->links->slidelink->links->slidelink as $row) {//get slide detaikls
                                    $slide_detail_object->id = str_replace("_player.", "", $row['slideid']);
                                    $slide_detail_object->name = (string) $row['displaytext'][0];
                                    $slide_detail_object->slide_no = $i;

                                    array_push($slides_details_array, $slide_detail_object);
                                    unset($slide_detail_object);

                                    $i++;
                                }
                                $course_chapter_slide_details_data = array('chapter_slide_details' => json_encode($slides_details_array),
                                    'folder_name' => $user_course_chapter_directory_name . '.zip',
                                    'content_path' => $user_course_chapter_unzipped_directory,
                                    'file_size' => get_directory_size($user_course_chapter_directory));
                                $this->companychapters_model->update_chapters($updated_chapter_id, $course_chapter_slide_details_data); //update chapters slide details
                                $this->companycourses_model->update_courses($this->input->post('course_id'), array('size' => get_directory_size($user_course_directory_path)));
                                rename($this->encryption->decrypt($this->input->post('file_path')), $user_course_chapter_directory . '/' . $user_course_chapter_directory_name . '.zip');
                            } else {
                                unlink($user_course_chapter_unzipped_directory);
                                $this->session->set_flashdata('upload_message', "Your available memory quota is insufficient to upload this content");
                            }
                        }
                    } else if ($media_file_type == 'pdf') {
                        if ($this->upload->check_for_space_availability($userid, $_FILES['pdf_file_to_upload']['size'])) {
                            $userid = $this->session->userdata('id');
                            $user_parent_directory_path = './uploads/chapter_documents/comp_' . $this->session->userdata('company_id');
                            $user_parent_directory = create_directory($user_parent_directory_path);
                            $user_directory_path = $user_parent_directory . '/user_' . $userid;
                            $user_directory = create_directory($user_directory_path);
                            $course_directory = create_directory($user_directory . '/course_' . $this->input->post('course_id'));
                            $chapter_directory = create_directory($course_directory . '/chapter_' . $id);
                            //where u want to upload zip file

                            $config['upload_path'] = $chapter_directory;
                            $config['allowed_types'] = 'pdf';
                            $config['overwrite'] = FALSE;
                            $upload_data = $this->upload->do_my_upload('pdf_file_to_upload', $config);
                            if ($upload_data['status'] === TRUE) {
                                print_r($upload_data);
                                echo $id;

                                $pdf_file_array = array('id' => $id,
                                    'file_type' => 'pdf',
                                    'file_path' => substr($chapter_directory, 2) . '/' . $upload_data['details']['raw_name'] . '.pdf');

                                $this->companychapters_model->update_chapters($id, $pdf_file_array); //update chapters slide details
                            } else {
                                print_r($upload_data['details']);
                            }
                        } else {
                            $this->session->set_flashdata('upload_message', "Your available memory quota is insufficient to upload PDF file");
                        }
                    }
                    redirect('admin_company/chapters');
                } else {
                    $data['flash_message'] = FALSE;
                }
            } else {
                $data['chapter_data'] = array($this->input->post());
                $data['message'] = validation_errors();
            }
        }
        $data['coursedropdown'] = $this->companycourses_model->get_dropdown_list($userid);


        $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);
        $data['chapter_id'] = $this->input->post('chapter_id');

        $data['main_content'] = 'admin_company/chapters/add';
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
        $data['chapter_data'] = $this->companychapters_model->get_chapters_by_id($id);
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


    

    public function upload_chapters() {
        $userid = $this->session->userdata('id');
        $user_parent_directory_path = './uploads/chapter_documents/comp_' . $this->session->userdata('company_id');
        $user_parent_directory = create_directory($user_parent_directory_path);
        $user_directory_path = $user_parent_directory . '/user_' . $userid;
        $user_directory = create_directory($user_directory_path);
        //where u want to upload zip file

        $config['upload_path'] = $user_directory;
        $config['allowed_types'] = 'zip';
        $config['overwrite'] = FALSE;
        $upload_data = $this->upload->do_my_upload('SelectedFile', $config);
        $response = new stdClass();
        if ($upload_data['status'] === TRUE) {
            $response->status = 'Success';
            $response->data = $this->encryption->encrypt($user_directory_path . '/' . $upload_data['details']['raw_name'] . '.zip');
        } else {
            $response->status = 'Fail';
            $response->data = $upload_data['details'];
        }
        echo json_encode($response);
    }

    public function Unzip($file, $path) {

        $zip = new ZipArchive;
        $res = $zip->open($file);

        $perms = fileperms($file);

        if ($res === TRUE) {

            $zip->extractTo($path);
        }

        return $res;
    }

    public function get_imsmanifest_xml_file_path($imsmanifest_xml_file_parent_folder, $file_to_chose) {
//echo $imsmanifest_xml_file_parent_folder;
        foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($imsmanifest_xml_file_parent_folder)) as $filePath) {

            if (strpos($filePath, $file_to_chose) !== false) {

                break;
            }
        }
        // echo filepath;

        return $filePath;
    }

    public function chapter_dropdown_list() {

        $userid = $this->session->userdata('id');
        $course_id = $this->encryption->decrypt($this->input->post(course));
        $query = $this->companychapters_model->get_chapter_dropdownlist($userid, $course_id);

        $response = new stdClass();

        $i = 0;

        foreach ($query as $row) {


            $response->rows[$i] = array('id' => $this->encryption->encrypt($row['id']), 'name' => $row['name']);
            $i++;
        }
        echo json_encode($response);
    }

    public function set_user_chapter_comments() {
        $chapter_id = $this->input->post('chapter_id');
        $chapter_comment = $this->input->post('comment');
        $commment_obj = new stdClass();
        $commment_obj->comment_text = $chapter_comment;
        $commment_obj->comment_by = $this->session->userdata('empuser_name');
        $commment_obj->commented_at = date('Y-m-d');
        $chapter_specific_comment_array = $this->companychapters_model->get_user_chapter_comments($chapter_id);

        if (empty($chapter_specific_comment_array) || is_null($chapter_specific_comment_array)) {
            $chapter_comment_array = json_encode(array($commment_obj));
        } else {

            $chapter_comment_array = json_decode($chapter_specific_comment_array);
            array_push($chapter_comment_array, $commment_obj);
            $chapter_comment_array = json_encode($chapter_comment_array);
        }

        $comment_details_array = array('comments' => $chapter_comment_array, 'id' => $chapter_id);
        $this->companychapters_model->update_chapters($chapter_id, $comment_details_array);
        $query = $this->companychapters_model->get_user_chapter_comments($chapter_id);
        $comments_array = json_decode($query);
        // print_r($comments_array);

        $response = new stdClass();
        if ($query != null) {
            $response->status = 'Success';
            $response->comments = json_encode(array_reverse(array_slice($comments_array, -5)));
            $response->commented_at = date('Y-m-d H:I:S');
        } else {
            $response->status = "Fail";
        }
        echo json_encode($response);
    }

    public function get_user_chapter_comments() {
        $page = $this->input->post('page');
        $chapter_id = $this->input->post('chapter_id');

        $comments= json_decode($this->companychapters_model->get_user_chapter_comments($chapter_id));
        $response = new stdClass();

        if ($comments != null) {
            $response->status = 'Success';
            $limit =5; //no. of rows
           
            $page = trim($this->input->post('page'));
            if ($page == "") {
                $page = 1;
            }
            $count = sizeof($comments);
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
            $response = new stdClass();
            $response->page = $page;
            $response->rows = array_slice(array_reverse($comments), $start, $limit);
            $response->total = $totalpages;
            $response->records = $count;
            $response->start = $start + 1;
            $response->end = $start + $limit;
        } else {
            $response->status = "Fail";
        }

        echo json_encode($response);
    }

    public function check_for_space_availability() {
        $response = new stdClass();
        $userid = $this->session->userdata('id');
        $availability_status = $this->upload->check_for_space_availability($userid, $this->input->post('file_size'));
        if ($availability_status == TRUE) {
            $response->status = 'Success';
        } else {
            $response->status = 'Fail';
        }
        echo json_encode($response);
    }

    public function deactivate_chapter_user_details($chapter_id) {
        $this->companychapters_model->deactivate_chapter_user_details($chapter_id);
    }

    public function comment_index() {
        $data['chapter_id'] = $this->input->post('chapter_id');
        $chapter_id = $this->encryption->decrypt($this->input->post('chapter_id'));
        $data['chapter_details'] = $this->companychapters_model->get_chapters_by_id($chapter_id);
        $data['footerdata'] = $this->companycmspage_model->list_cmspage($userid, $usernm);
        $data['main_content'] = 'admin_company/chapters/comment_list';
        $this->load->view('includes/template', $data);
    }

    public function get_comment_list() {
        $chapter_id = $this->encryption->decrypt($this->input->post('chapter_id'));
        $comments = $this->companychapters_model->get_comment_list($chapter_id);
        $limit = $this->input->post(rows); //no. of rows
        if ($this->input->post('search') == 'true') {
            $search_string_array = json_decode($this->input->post('search_string_array'));
        }
        $page = trim($this->input->post('page'));
        if ($page == "") {
            $page = 1;
        }
        $count = sizeof($comments);
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
        $response = new stdClass();
        $response->page = $page;
        $response->rows = array_slice(array_reverse($comments), $start, $limit);
        $response->total = $totalpages;
        $response->records = $count;
        $response->start = $start + 1;
        $response->end = $start + $limit;

        echo json_encode($response);
    }

}
