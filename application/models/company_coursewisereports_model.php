<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Company_coursewisereports_model
 *
 * @author a
 */
class Company_coursewisereports_model extends CI_Model {

    private $course_specific_user_status = array();

    //put your code here
    public function __construct() {
        $this->load->database();
    }

    public function get_coursewise_report( $sidx, $sord, $start, $limit, $search_string_array, $count, $is_csv=false) {
        $this->db->_protect_identifiers = false;
        $this->db->select('c.name as Course,coalesce(ch.Count, 0) as Chapters_Count,          
                 CASE
        WHEN  ISNULL(c.start_date ) THEN ""
        ELSE c.start_date 
    END AS Start_date , CASE
        WHEN  ISNULL(c.end_date ) THEN ""
        ELSE c.end_date 
    END AS End_Date');
        if ($is_csv == false) {
            $this->db->select('c.id as course_id');
        }
        $this->db->from('courses c ');
        $chapter_count_query = "(select course_id,count(*) as Count from course_chapter group by course_id)";
        $assigned_users_count_query = "(select course_id,count(distinct(assigned_to)) as Count from assigned_course group by course_id)";
        $this->db->join("$chapter_count_query ch", 'ch.course_id=c.id', 'left');
        //$this->db->join("$assigned_users_count_query acd", 'acd.course_id=c.id', 'left');
        $this->db->where('c.company_id', $this->session->userdata('company_id'));
        if ($is_csv == false) {
            if ($search_string_array != "") {
                $this->db->like('c.name', $search_string_array->course);
            }
            if ($count == false) {
                $this->db->limit($limit, $start);
            }
        }

        $query = $this->db->get();
        $this->db->_protect_identifiers = TRUE;

        if ($count == false) {
            return $query;
        } else {
            return $query->num_rows();
        }
    }

    public function get_course_specific_report( $course_specific_id, $sidx, $sord, $start, $limit, $search_string_array) {
        /* $query = "SET @course_specific_user_status = '[]'";
          $this->db->query($query);
          $success = $this->db->query("call course_specific_report(@course_specific_user_status,'$course_specific_id')");

          $query = $this->db->query('select @course_specific_user_status');

          return $query->result_array(); */
        $this->db->select('c.id,c.name,u.id as user_id,u.email');
        $this->db->from('courses c');       
        $this->db->join('users u', 'u.company_id=c.company_id');
        $this->db->join('users_groups ug', 'ug.user_id=u.id');
        $this->db->where('c.id', $course_specific_id);
        $this->db->where('ug.group_id', '7');
         $this->db->where('u.company_id', $this->session->userdata('company_id'));
        if ($search_string_array != "") {
            $this->db->like('u.email', $search_string_array->email);
        }

        $course_user = $this->db->get();
        foreach ($course_user->result_array() as $course_user_row) {
            $this->db->select('ch.id,ch.name,ecd.completion_details');
            $this->db->from('course_chapter ch');
            $e_course_details_query = '(select * from e_course_user_details where user_id="' . $course_user_row["user_id"] . '")';
            $this->db->join("$e_course_details_query ecd", 'ecd.chapter_id=ch.id', 'left');
            $this->db->where('ch.course_id', $course_specific_id);
            $this->db->where('ch.company_id', $this->session->userdata('company_id'));
            $user_course_details = $this->db->get();
            $this->user_specific_course_report($user_course_details, $course_user_row);
        }
        return $this->course_specific_user_status;
    }

    function user_specific_course_report($user_course_details, $course_user) {
        $course_specific_user_status_obj = new stdClass ();
        $user_course_details_row_count = $user_course_details->num_rows();
        if ($user_course_details_row_count == 0) {
            $course_specific_user_status_obj->user_name = $course_user['email'];
            $course_specific_user_status_obj->completion_status = 'No chapter viewed yet';
            $course_specific_user_status_obj->completed_on = '';

            array_push($this->course_specific_user_status, $course_specific_user_status_obj);
        } else {
            $i = 1;
            foreach ($user_course_details->result_array() as $row) {
                if ($row['completion_details'] == NULL) {
                    $course_specific_user_status_obj->user_name = $course_user['email'];
                    $course_specific_user_status_obj->completion_status = 'Incomplete';
                    $course_specific_user_status_obj->completed_on = '';
                    array_push($this->course_specific_user_status, $course_specific_user_status_obj);
                    break;
                } elseif ($user_course_details_row_count == $i) {
                    if ($row['completion_details'] != NULL) {
                        $course_specific_user_status_obj->user_name = $course_user['email'];
                        $course_specific_user_status_obj->completion_status = 'Complete';
                        $course_specific_user_status_obj->completed_on = json_decode($row['completion_details'])->completed_on;
                        array_push($this->course_specific_user_status, $course_specific_user_status_obj);
                    } else {
                        $course_specific_user_status_obj->user_name = $course_user['email'];
                        $course_specific_user_status_obj->completion_status = 'Incomplete';
                        $course_specific_user_status_obj->completed_on = '';
                        array_push($this->course_specific_user_status, $course_specific_user_status_obj);
                    }
                } else {
                    $i++;
                }
            }
        }
    }

}
