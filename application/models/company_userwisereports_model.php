<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Company_userwisereports_model
 *
 * @author a
 */
class Company_userwisereports_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_userwise_report( $sidx, $sord, $start, $limit, $search_string_array, $count,$is_csv) {
        $this->db->select('u.id,email');
        $this->db->select('concat_ws(" ",first_name,last_name ) as full_name');
        $this->db->select('group_concat(distinct(name)ORDER BY c.id DESC SEPARATOR "," ) as courses_assigned', FALSE);
        $this->db->from('users u');
        $this->db->join('courses c', 'u.company_id=c.company_id');
        $this->db->where('u.company_id', $this->session->userdata('company_id'));
     
             if ($is_csv == false) {
            if ($search_string_array != "") {
                  $this->db->like('concat_ws(" ",first_name,last_name )', $search_string_array->name);
            $this->db->like('email', $search_string_array->email_id);
            }
            if ($count == false ) {
                $this->db->limit($limit, $start);
            }
        }

        $this->db->group_by('u.id');
        $this->db->order_by("u.id",'Desc');
        $query = $this->db->get();

        if ($count == false) {
            return $query;
        } else {
            return $query->num_rows();
        }
    }

    public function get_user_specific_report( $user_specific_id, $sidx, $sord, $start, $limit, $search_string_array, $count,$is_csv) {
        $this->db->_protect_identifiers = false;
        $this->db->select('u.email as User,c.name as Course,
            CASE
        WHEN  ISNULL(ch.name ) THEN "No chapter Added yet"
        ELSE ch.name
    END AS Chapter,
    CASE
        WHEN isnull(ch.file_path) then ""
        WHEN  ISNULL(chd.course_attempt_details) THEN "0"
         WHEN  completion_details is not null THEN "100"
        ELSE course_attempt_details
    END  as Course_Attempt,
    CASE
    WHEN  ISNULL(chd.user_slide_details ) THEN ""
        ELSE chd.user_slide_details
    END as Slide_Details,
   CASE
   when isnull(ch.file_path) then "No Content"
   when isnull(chd.cmi_core_lesson_status) then "Not Viewed"
    WHEN  completion_details is not null THEN "Completed"
    else "Incomplete"  END as Lesson_status');
        $this->db->from('courses c');      
        $this->db->join('course_chapter ch', 'ch.course_id=c.id', 'left');
        $chd_query = "( SELECT  * FROM    e_course_user_details WHERE   user_id =$user_specific_id and is_active is not null)";
        $this->db->join("$chd_query chd", 'ch.id=chd.chapter_id', 'left');
        $this->db->join("users u", 'u.company_id=c.company_id');
        $this->db->where('u.company_id', $this->session->userdata('company_id'));
        $this->db->where('u.id', $user_specific_id);
         $this->db->where('u.id', $user_specific_id);
   
           if ($is_csv == false) {
            if ($search_string_array != "") {
                 $this->db->like('c.name', $search_string_array->course);
              $this->db->like('ch.name', $search_string_array->chapter);
            }
            if ($count == false ) {
                $this->db->limit($limit, $start);
            }
        }
        $this->db->order_by('C.ID,ch.ID DESC');
        $query = $this->db->get();

        if ($count == false) {
            return $query;
        } else {
            return $query->num_rows();
        }


        $this->db->_protect_identifiers = true;
    }

    public function get_user_specific_report1($userid, $user_specific_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('u.user_name,u.id,c.course_name,c.id as course,ch.id as chapter_id,ch.name as chapter_name,chd.course_attempt_details,chd.user_slide_details,chd.cmi_core_lesson_status');
        $this->db->from('courses c');
        $asu_query = "(SELECT *
       FROM    assigned_course
       WHERE   assignuserid = $user_specific_id )";
        $this->db->join("$asu_query asu", 'asu.courseid=c.id', 'left');
        $this->db->join('course_chapter ch', 'ch.course_id=c.id', 'left');
        $chd_query = "( SELECT  *
       FROM    E_COURSE_USER_DETAILS
       WHERE   USER_ID =$user_specific_id)";
        $this->db->join("$chd_query chd", 'ch.ID=chd.CHAPTER_ID', 'left');
        $this->db->join("users u", 'u.ID=asu.ASSIGNUSERID');
        $this->db->where('ASSIGNEDBY_USER', $userid);
        $this->db->where('ASSIGNUSERID', $user_specific_id);
       
        $this->db->order_by('ASSIGNEDBY_USER DESC,C.ID,ch.ID DESC');
        $query = $this->db->get();
        $this->db->_protect_identifiers = true;
        //   var_dump($query->result_array());
        return $query;
    }

    public function get_username($user_specific_id) {
        $this->db->select('email');
        $this->db->from('users');
        $this->db->where('id', $user_specific_id);
        $query = $this->db->get();
        return $query->row()->email;
    }

}
