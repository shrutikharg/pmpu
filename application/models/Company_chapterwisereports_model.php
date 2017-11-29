<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Company_chapterwisereports_model
 *
 * @author a
 */
class Company_chapterwisereports_model extends CI_Model {

    //put your code here
    public function __construct() {
        $this->load->database();
    }

    public function get_chapterwise_report($sidx, $sord, $start, $limit, $search_string_array, $count, $is_csv) {
        $this->db->_protect_identifiers = false;
        $this->db->select("ch.id as Chapter_Id,ch.name Chapter_Name,ch.Description,c.name as Course,ch.start_Date as Start_date,ch.end_date End_Date,
                 cast( concat('Not viewed',sum(if(isnull(chapter_id) ,1,0)),'</br>',
                  'Incomplete',sum(if(isnull(completion_details) ,1,0)),'</br>',
                  'Completed-', sum(if(completion_details is not null,1,0)))as char)   AS Status_count ");
        $this->db->from('course_chapter ch');
        $this->db->join('courses c', 'c.id=ch.course_id');
        $status_count_query = "(select * from e_course_user_details where company_id='" . $this->session->userdata('company_id') . "' and is_active='Y') ";
        $this->db->join("$status_count_query chd", 'chd.chapter_id=ch.id', 'left');
        $this->db->join("users u", 'u.id=chd.user_id', 'left');
        $this->db->where('ch.company_id', $this->session->userdata('company_id'));
        if ($is_csv == false) {
            if ($search_string_array != "") {
                $this->db->like('c.name', $search_string_array->course);
                 $this->db->like('ch.name', $search_string_array->chapter);
            }
            if ($count == false) {
                $this->db->limit($limit, $start);
            }
        }
        $this->db->order_by('c.id desc,ch.id desc');
        $this->db->group_by('ch.id');
        $query = $this->db->get();
        if ($count == false) {
            return $query;
        } else {
            return $query->num_rows();
        }
        $this->db->_protect_identifiers = false;
    }

    public function get_chapter_specific_report($userid, $chapter_specific_id, $sidx, $sord, $start, $limit, $search_string_array, $count) {
        $this->db->_protect_identifiers = false;

        /* $this->db->select("u.email as User,
          CASE WHEN  ISNULL(ecd.course_attempt_details) THEN '0'
          ELSE course_attempt_details
          END  as Course_Attempt,
          CASE
          when isnull(ecd.cmi_core_lesson_status) then 'Not Viewed Yet'
          else ecd.cmi_core_lesson_status  END as Lesson_status,
          CASE WHEN  ISNULL(ecd.completion_details) THEN ''
          ELSE JSON_EXTRACT(ecd.completion_details, '$.completed_on')
          END  as Complted_On"); */
        $this->db->select("u.email as User,ecd.completion_details,
         CASE WHEN  ISNULL(ecd.course_attempt_details) THEN '0'
        ELSE course_attempt_details
    END  as Course_Attempt,    
   CASE
   when isnull(ecd.cmi_core_lesson_status) then 'Not Viewed Yet' 
    else ecd.cmi_core_lesson_status  END as Lesson_status");

        $ecd_query = "(SELECT * FROM e_course_user_details where chapter_id=$chapter_specific_id )";
        $this->db->from("$ecd_query ecd");
        $chapter_query = "((SELECT * FROM course_chapter where id=$chapter_specific_id ) )";
        $this->db->join("$chapter_query ch", 'ecd.chapter_id=ch.id', 'right');
        $this->db->join('users u', 'u.id=ecd.user_id', 'right');
        $this->db->where('u.company_id', $this->session->userdata('company_id'));

        if ($search_string_array != "") {
            $this->db->like('user_name', $search_string_array->email);
            $this->db->like('c.name', $search_string_array->course);
            $this->db->like('ch.name', $search_string_array->chapter);
            $this->db->like('chd.cmi_core_lesson_status', $search_string_array->lesson_status);
        }
        if ($count == false) {
            $this->db->limit($limit, $start);
        }
        //$this->db->order_by('assigned_by DESC,C.ID,ch.ID DESC');
        $query = $this->db->get();

        if ($count == false) {
            return $query;
        } else {
            return $query->num_rows();
        }


        $this->db->_protect_identifiers = true;
    }

}
