<?php

class Companychapters_model extends CI_Model {

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
    public function get_category_by_id($id) {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_chapters_by_id($id) {
        $this->db->select('*');
        $this->db->from('course_chapter');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_category_list($userid) {
        $this->db->from('category');
        $this->db->where('IsActive', 'Y');
        $this->db->where('usercat_id', $userid);
        $this->db->order_by('course_chapter.id');
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

    public function get_category_droplist($userid) {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('IsActive', 'Y');
        $this->db->where('usercat_id', $userid);
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Fetch category data from the database
     * possibility to mix search, filter and order
     * @param string $search_string 
     * @param strong $order
     * @param string $order_type 
     * @param int $limit_start
     * @param int $limit_end
     * @return array
     */
    public function get_chapters($userid, $search_string = null, $order = null, $order_type = 'Asc', $limit_start = null, $limit_end = null) {

        $this->db->select('course_chapter.course_id as courseid');
        $this->db->select('course_chapter.id as chapterid');
        $this->db->select('course_chapter.name as chaptername');
        $this->db->select('course_chapter.description as chapterdescription');
        $this->db->select('course_chapter.chapter_image_path as chapterimage');
        $this->db->select('courses.course_name as coursename');
        $this->db->select('course_chapter.start_date as startdate');
        $this->db->select('course_chapter.end_date as enddate');
        $this->db->from('course_chapter');
        $this->db->join('courses', 'courses.id = course_chapter.course_id');
        $this->db->where('user_id', $userid);
        if ($search_string) {
            $this->db->like('chaptername', $search_string);
        }
        $this->db->group_by('chapterid');

        if ($order) {
            $this->db->order_by($order, 'desc');
        } else {
            $this->db->order_by('chapterid','desc');
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

    /**
     * Count the number of rows
     * @param int $search_string
     * @param int $order
     * @return int
     */
    function count_chapters($userid, $search_string = null, $order = null) {
        $this->db->select('course_chapter.course_id as courseid');
        $this->db->select('course_chapter.id as chapterid');
        $this->db->select('course_chapter.name as chaptername');
        $this->db->select('course_chapter.description as chapterdescription');
        $this->db->select('course_chapter.chapter_image_path as chapterimage');
        $this->db->select('courses.course_name as coursename');
        $this->db->select('course_chapter.start_date as startdate');
        $this->db->select('course_chapter.end_date as enddate');
        $this->db->from('course_chapter');
        $this->db->join('courses', 'courses.id = course_chapter.course_id');
        $this->db->where('user_id', $userid);
        if ($search_string) {
            $this->db->like('chaptername', $search_string);
        }
        if ($order) {
            $this->db->order_by($order, 'Asc');
        } else {
            $this->db->order_by('chapterid', 'Asc');
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_catlimitcategory($userid) {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('usercat_id', $userid);
        $query = $this->db->get();
        return $query->num_rows();
    }

    /**
     * Store the new item into the database
     * @param array $data - associative array with data to store
     * @return boolean 
     */
    function store_chapters($data) {
        $insert = $this->db->insert('course_chapter', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    /**
     * Update category
     * @param array $data - associative array with data to store
     * @return boolean
     */
    function update_category($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('category', $data);
        $report = array();
        $report['error'] = $this->db->_error_number();
        $report['message'] = $this->db->_error_message();
        if ($report !== 0) {
            return true;
        } else {
            return false;
        }
    }

    function update_chapters($id, $data) {
              //  print_r($data);
        $this->db->where('id', $id);
        $this->db->update('course_chapter', $data);
        $report = array();
        $report['error'] = $this->db->_error_number();
        $report['message'] = $this->db->_error_message();
        if ($report !== 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Delete categoryr
     * @param int $id - category id
     * @return boolean
     */
    function delete_chapters($id) {
        $this->db->where('id', $id);
        $this->db->delete('course_chapter');
    }
    public function insert_chapter_slide_details($inserted_chapter_id, $slide_details_array) {$sql="UPDATE course_chapter SET chapter_slide_details = var_dump($slide_details_array)  WHERE id = $inserted_chapter_id";
echo "'.$slide_details_array.'";     $query = $this->db->query($sql);
            



    }

}
?>	
