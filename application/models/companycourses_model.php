<?php

class Companycourses_model extends CI_Model {

    /**
     * Responsable for auto load the database
     * @return void
     */
    public function __construct() {
        $this->load->database();
    }

    /**
     * Get product by his is
     * @param int $product_id 
     * @return array
     */
    public function get_courses_by_id($id) {
        $this->db->select('*');
        $this->db->from('courses');
        $this->db->where('id', $id);
          $this->db->where('company_id', $this->session->userdata('company_id'));
        $query = $this->db->get();
        return $query->result_array();
    }
     public function get_course_details($id) {
        $this->db->select('*');
        $this->db->from('courses');
        $this->db->where('id', $id);
         
        $query = $this->db->get();
        return $query->row();
    }

    /**
     * Fetch courses data from the database
     * possibility to mix search, filter and order
     * @param string $search_string 
     * @param strong $order
     * @param string $order_type 
     * @param int $limit_start
     * @param int $limit_end
     * @return array
     */
    public function get_dropdown_list($userid) {
        $this->db->from('courses');
       // $this->db->where('created_by', $userid);
         $this->db->where('company_id', $this->session->userdata('company_id'));
        $this->db->order_by('id');
        $result = $this->db->get();
        $return = array();
        if ($result->num_rows() > 0) {
            $return[''] = 'Please select';
            foreach ($result->result_array() as $row) {
                $return[$row['id']] = $row['name'];
            }
        }
        return $return;
    }

    public function get_courses($userid, $sidx, $sord, $start, $startd, $endd, $limit, $search_string_array, $count) {

        $this->db->select('course.name as course,course.course_by,course.id,course.start_date,course.end_date,course.description as description,subcat.id as subcat_id,subcat.name as subcategory');
        $this->db->from('courses course');
        $this->db->join("subcategory subcat", "subcat.id=course.subcategory_id");
         $this->db->where('course.company_id', $this->session->userdata('company_id'));
        $this->db->where('course.created_by', $userid);
        if ($search_string_array != "") {
            $this->db->like('course.name', $search_string_array->course);
            $this->db->like('subcat.id', $search_string_array->sub_department,'after');
        }
        $this->db->order_by("$sidx $sord");
        if ($count == false) {
            $this->db->limit($limit, $start);
            
            
            
                      
            
            
           
        }

        $query = $this->db->get();

        if ($count == false) {
            return $query;
        } else {
            return $query->num_rows();
        }
    }

    /**
     * Count the number of rows
     * @param int $search_string
     * @param int $order
     * @return int
     */
    function count_courses($userid, $search_string = null, $order = null) {
        $this->db->select('*');
        $this->db->from('courses');
       // $this->db->where('created_by', $userid);
          $this->db->where('company_id', $this->session->userdata('company_id'));
        if ($search_string) {
            $this->db->like('course_name', $search_string);
        }
        if ($order) {
            $this->db->order_by($order, 'Asc');
        } else {
            $this->db->order_by('id', 'Asc');
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_assignanalytics() {
        $this->db->select('*');
        $this->db->from('takingcourse_report');
        //$this->db->where('course_createuser', $userid);	
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_diskspaceuseddtils($userid) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('users.id', $userid);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_assignedcourselist($search_string = null, $order = null, $order_type = 'Asc', $limit_start = null, $limit_end = null) {

        $this->db->select('*');
        $this->db->from('takingcourse_report');
        //$this->db->where('course_createuser', $userid);		

        $this->db->group_by('id');

        if ($order) {
            $this->db->order_by($order, $order_type);
        } else {
            $this->db->order_by('id', $order_type);
        }

        if ($limit_start && $limit_end) {
            $this->db->limit($limit_start, $limit_end);
        }

        if ($limit_start != null) {
            $this->db->limit($limit_start, $limit_end);
        }

        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_graphcourses($userid, $datefrom, $dateto, $coursename) {

        $this->db->select('count(*) as cnt');
        $this->db->select('clickcourse_date');
        $this->db->select('course_name');
        $this->db->from('takingcourse_report');
        $this->db->where('userid', $userid);
        $this->db->where('courseid', $coursename);
        $this->db->where('clickcourse_date BETWEEN "' . date('Y-m-d', strtotime($datefrom)) . '" and "' . date('Y-m-d', strtotime($dateto)) . '"');
        //$this->db->where('clickcourse_date <',$datefrom);
        //$this->db->where('clickcourse_date >',$dateto);
        $this->db->group_by('clickcourse_date');

        $query = $this->db->get();
        return $query->result_array();
        /*
          $this->db->select('*');
          $this->db->from('takingcourse_report');
          $this->db->where('userid', $userid);
          $query = $this->db->get();
          return $query->result_array();
         */
    }

    public function get_reporttable_of_graph($userid, $datefrom, $dateto, $coursename) {


        $this->db->select('*');
        $this->db->from('takingcourse_report');
        $this->db->where('userid', $userid);
        $this->db->where('courseid', $coursename);
        $this->db->where('clickcourse_date BETWEEN "' . date('Y-m-d', strtotime($datefrom)) . '" and "' . date('Y-m-d', strtotime($dateto)) . '"');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_graphcoursesdate($userid, $datefrom, $dateto, $coursename) {

        //$this->db->select('count(*) as cnt');
        $this->db->select('clickcourse_date');
        //$this->db->select('course_name');		
        $this->db->from('takingcourse_report');
        $this->db->where('userid', $userid);
        $this->db->where('courseid', $coursename);
        $this->db->where('clickcourse_date BETWEEN "' . date('Y-m-d', strtotime($datefrom)) . '" and "' . date('Y-m-d', strtotime($dateto)) . '"');
        //$this->db->where('clickcourse_date <',$datefrom);
        //$this->db->where('clickcourse_date >',$dateto);
        $this->db->group_by('clickcourse_date');

        $query = $this->db->get();
        return $query->result_array();
        /*
          $this->db->select('*');
          $this->db->from('takingcourse_report');
          $this->db->where('userid', $userid);
          $query = $this->db->get();
          return $query->result_array();
         */
    }

    /*
      public function get_courses_droplist($userid)
      {

      $this->db->select('*');
      $this->db->from('courses');
      $this->db->where('course_createuser', $userid);
      //$this->db->where('IsActive','Y');
      $query = $this->db->get();
      return $query->result_array();
      }

     */

    public function get_courses_droplist($userid) {
        $this->db->from('courses');
        $this->db->where('is_active', 'Y');
          $this->db->where('company_id', $this->session->userdata('company_id'));
       // $this->db->where('created_by', $userid);
        $this->db->order_by('id');
        $result = $this->db->get();
        $return = array();
        if ($result->num_rows() > 0) {
            $return[''] = 'Please select';
            foreach ($result->result_array() as $row) {
                $return[$row['id']] = $row['course_name'];
            }
        }
        return $return;
    }

    /**
     * Store the new item into the database
     * @param array $data - associative array with data to store
     * @return boolean 
     */
    function store_courses($data) {
        $insert = $this->db->insert('courses', $data);
        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    /**
     * Update courses
     * @param array $data - associative array with data to store
     * @return boolean
     */
    function update_courses($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('courses', $data);
        $report = array();
        $report['error'] = $this->db->_error_number();
        $report['message'] = $this->db->_error_message();
        if ($report !== 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_schedulelist_data($userid) {
        $this->db->select('course_chapter.course_id as courseid');
        $this->db->select('topic_scheduled.Video_Id as videoid');
        $this->db->select('topic_scheduled.Schedule_Id as scheduleid');
        $this->db->select('topic_scheduled.Schedule_Time as scheduledate');
        $this->db->select('course_chapter.id as chapterid');
        $this->db->select('course_chapter.name as chaptername');
        $this->db->select('course_chapter.description as chapterdescription');
        $this->db->select('course_chapter.image_path as chapterimage');
        $this->db->select('course_chapter.chapter_video_id as chaptervideo');
        $this->db->select('courses.name as coursename');
        //$this->db->select('courses.course_validity as coursevalidity');
        //$this->db->select('courses.course_price as courseprice');
        $this->db->select('courses.is_Active as coursestatus');
        $this->db->select('course_chapter.Is_Active as chapterstatus');
        $this->db->select('topic_scheduled.Schedule_Time as schedule_date');
        $this->db->select('topic_scheduled.Schedule_Time as schedule_date');

        $this->db->from('topic_scheduled');
        $this->db->join('course_chapter', 'course_chapter.id = topic_scheduled.Video_Id');
        $this->db->join('courses', 'courses.id = course_chapter.course_id');
        $this->db->where('course_chapter.is_Active', 'Y');
        $this->db->where('topic_scheduled.Companyadmin_id', $userid);
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Delete coursesr
     * @param int $id - courses id
     * @return boolean
     */
    function delete_courses($id) {
        $this->db->where('id', $id);
        $this->db->delete('courses');
    }

      public function get_course_dropdownlist($userid,$subcategory_id) {
        $this->db->select('*');
        $this->db->from('courses');
        $this->db->where('is_active', 'Y');
        $this->db->where('created_by', $userid);
        $this->db->where('subcategory_id',$subcategory_id);
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->result_array();
    }
      public function get_course_by_name($userid,$search_string_array){
         $this->db->select('*');
        $this->db->from('courses');
        //$this->db->where('created_by', $userid);
          $this->db->where('company_id', $this->session->userdata('company_id'));

        $this->db->like('name', $search_string_array['name'],'after');
        $query = $this->db->get();
      return   $query->num_rows();
    }
}
?>	
