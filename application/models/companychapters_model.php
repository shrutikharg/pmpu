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
        $this->db->where('is_Active', 'Y');
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

    public function get_category_droplist($userid) {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('is_Active', 'Y');
        // $this->db->where('usercat_id', $userid);
        $this->db->where('company_id', $this->session->userdata('company_id'));
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
    public function get_chapters($userid, $sidx, $sord, $start, $limit, $search_string_array, $count) {
        $this->db->_protect_identifiers = false;
        $this->db->select('course_chapter.course_id as courseid');
        $this->db->select('course_chapter.id as chapterid');
        $this->db->select('course_chapter.name as chaptername');
        $this->db->select('course_chapter.description as chapterdescription');
        $this->db->select('course_chapter.image_path as chapterimage');
        $this->db->select('courses.id as courseid');
        $this->db->select('courses.name as coursename');
        $this->db->select('CASE
        WHEN  ISNULL(course_chapter.start_date) THEN ""
        ELSE course_chapter.start_date
    END as start_date');
        $this->db->select('CASE
        WHEN  ISNULL(course_chapter.end_date) THEN ""
        ELSE course_chapter.end_date
    END as end_date');
        $this->db->from('course_chapter');
        $this->db->join('courses', 'courses.id = course_chapter.course_id');
        $this->db->where('course_chapter.company_id', $this->session->userdata('company_id'));
        if ($search_string_array != "") {
            $this->db->like('course_chapter.name', $search_string_array->chapter, 'after');
            $this->db->like('courses.name', $search_string_array->course, 'after');
        }

        if ($count == false) {
            $this->db->order_by("course_chapter.$sidx $sord");
            $this->db->limit($limit, $start);
        }

        $query = $this->db->get();

        if ($count == false) {
            return $query;
        } else {
            return $query->num_rows();
        }
        $this->db->_protect_identifiers = true;
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
        $this->db->where('company_id', $this->session->userdata('company_id'));
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

        $this->db->where('id', $id);
        $query = $this->db->update('course_chapter', $data);
        $report = array();
        $report['error'] = $this->db->_error_number();
        $report['message'] = $this->db->_error_message();
        if ($query !== NULL) {
            return $id;
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

    public function insert_chapter_slide_details($inserted_chapter_id, $slide_details_array) {
        $sql = "UPDATE course_chapter SET chapter_slide_details = var_dump($slide_details_array)  WHERE id = $inserted_chapter_id";

        $query = $this->db->query($sql);
    }

    public function get_chapter_dropdownlist($userid, $course_id) {
        $this->db->select('*');
        $this->db->from('course_chapter');
        $this->db->where('is_Active', 'Y');
        //$this->db->where('user_id', $userid);
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $this->db->where('course_id', $course_id);
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function set_user_chapter_comments($chapter_id, $comment_details_array) {
        $comment_by = "'" . $comment_details_array['comment_by'] . "'";
        $comment_text = "'" . $comment_details_array['comment_text'] . "'";
        $commented_at = "'" . $comment_details_array['commented_at'] . "'";
        $sql = "UPDATE course_chapter ch1, 
            (SELECT (ch.comments)  FROM course_chapter ch  WHERE ch.id=$chapter_id ) AS ch2
            SET ch1.comments =CASE 
            WHEN isnull(ch2.comments) THEN JSON_ARRAY(json_object('comment_by',$comment_by,'comment_text',$comment_text,'commented_at',$commented_at))
            ELSE json_array_append(ch2.comments,'$',json_object('comment_by',$comment_by,'comment_text',$comment_text,'commented_at',$commented_at))
            END 
            WHERE id =$chapter_id";
        $query = $this->db->query($sql);
        return $query;
    }

    public function get_user_chapter_comments($chapter_id) {
        $this->db->select('comments');
        $this->db->from('course_chapter');
        $this->db->where('id', $chapter_id);
        $query = $this->db->get();
        return $query->row()->comments;
    }

    public function deactivate_chapter_user_details($chapter_id) {
        $this->db->where('id', $chapter_id);
        $this->db->update('e_course_user_details', array('is_active' => 'Y'));
    }

    public function get_comment_list($chapter_id) {
        $this->db->select('comments');
        $this->db->from('course_chapter');
        $this->db->where('id', $chapter_id);
        $query = $this->db->get();
        $comment_array=  json_decode($query->row()->comments);
        return $comment_array;
    }

}
?>	
