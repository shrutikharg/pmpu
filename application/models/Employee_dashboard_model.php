<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Employee_dashboard_model
 *
 * @author a
 */
class Employee_dashboard_model extends CI_Model {

    public $complete_course_count = 0;
    public $incomplete_course_count = 0;
    public $notattempted_course_count = 0;
    public $total_course_count = 0;
    public $completed_course_list = array();
    public $incomplete_course_list = array();
    public $notattempted_course_list = array();

    public function __construct() {
        $this->load->database();
    }

    public function get_user_courses_status() {
        $this->db->select('id,name');
        $this->db->from('courses');
        $this->db->where('company_id', $this->session->userdata('company_id'));
        $this->db->where('is_active', 'Y');
        $course_result = $this->db->get();
        $this->total_course_count = $course_result->num_rows();
        foreach ($course_result->result_array() as $course) {
            $this->db->select('*,course_chapter.id as chapter');
            $this->db->from('course_chapter');
            //$this->db->join('e_course_user_details', 'e_course_user_details.chapter_id=course_chapter.id', 'left');
            $ecourse_query = "(select * from e_course_user_details where is_active='Y' and company_id='" . $this->session->userdata('company_id') . "')";
            $this->db->join("$ecourse_query ecd", 'ecd.chapter_id=course_chapter.id', 'left');
            $this->db->where('course_chapter.company_id', $this->session->userdata('company_id'));
            $this->db->where('course_id', $course['id']);
            $chapter_result = $this->db->get();
            if(!(empty($chapter_result->result_array()))){
            $this->get_chapterwise_status($chapter_result);}
            else{
                
            array_push($this->notattempted_course_list,$course['id']);
            $this->notattempted_course_count = $this->notattempted_course_count + 1;   
            }
        }
        return (object) array('complete' => $this->complete_course_count, 'incomplete' => $this->incomplete_course_count, 'not_attempted' => $this->notattempted_course_count, 'course_count' => $this->total_course_count, 'completed_course_list' => $this->completed_course_list,'incomplete_course_list' => $this->incomplete_course_list,'notattempted_course_list'=>  $this->notattempted_course_list);
    }

    public function get_chapterwise_status($chapter_result) {
        $ids = array_column($chapter_result->result_array(), 'chapter_id');

        $user_chapter_id_array = array_filter($ids, function ($chapter_id) {
            if ($chapter_id != null || !(empty($chapter_id))) {

                return true;
            }
            return FALSE;
        });
        if (empty($user_chapter_id_array)) {
            $not_attempted_course_list=$chapter_result->result_array();
            array_push($this->notattempted_course_list, $not_attempted_course_list[0]['course_id']);
            $this->notattempted_course_count = $this->notattempted_course_count + 1;
        } else {
            $chapter_count = $chapter_result->num_rows();
            $i = 1;

            foreach ($chapter_result->result_array() as $row) {


                if ($row['completion_details'] != NULL && $i == $chapter_count) {
                    array_push($this->completed_course_list, $row['course_id']);
                    $this->complete_course_count = $this->complete_course_count + 1;
                } else if ($row['completion_details'] == NULL) {
                    array_push($this->incomplete_course_list, $row['course_id']);
                    $this->incomplete_course_count = $this->incomplete_course_count + 1;
                    break;
                }
                $i++;
            }
        }
    }

    public function get_course_list_statuswise($course_list) {
        $this->db->select('*');
        $this->db->from('courses');
        $this->db->where_in('id', $course_list);
       $query= $this->db->get();
       return $query->result_array();
    }

}
