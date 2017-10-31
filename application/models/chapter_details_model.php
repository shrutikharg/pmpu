<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of chapter_details_model
 *
 * @author a
 */
class chapter_details_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_cmi_values($cmi_param, $user_id, $chapter_id) {
        $this->db->select("$cmi_param");
        $this->db->from('e_course_user_details');
        $this->db->where('user_id', $user_id);
        $this->db->where('chapter_id', $chapter_id);
        $query = $this->db->get();
        return $query->row()->$cmi_param;
    }

    public function set_cmi_values($insert_array, $user_id, $chapter_id) {
         $this->db->_protect_identifiers = false;
        $this->db->where('user_id', $user_id);
        $this->db->where('chapter_id', $chapter_id);
        $this->db->update('e_course_user_details', $insert_array);
         $this->db->_protect_identifiers = true;
    }
    public function store_user_slide_details_array($insert_array,$user_id, $chapter_id) {
    $this->db->where('user_id', $user_id);
        $this->db->where('chapter_id', $chapter_id);
        $this->db->update('e_course_user_details', $insert_array);
    }
    public function get_user_slide_details($chapter_id, $userid) {
      $this->db->select("user_slide_details");
        $this->db->from('e_course_user_details');
        $this->db->where('user_id', $chapter_id);
         $this->db->where('chapter_id', $userid);
        $query = $this->db->get();
        return $query->row()->user_slide_details;
    }
    public function check_user_chapter_details_availability( $user_id, $chapter_id){
        $this->db->select("*");
        $this->db->from('e_course_user_details');
        $this->db->where('user_id', $user_id);
        $this->db->where('chapter_id', $chapter_id);
        $query = $this->db->get();
        $num_rows=$query->num_rows();
        if($num_rows==0){
            $data=array(
            'user_id'=>$user_id,
                'chapter_id'=>$chapter_id
            );
            $insert = $this->db->insert('e_course_user_details', $data);
	    return $insert;
        }
    }
    public function get_user_chapter_details($user_id,$chapter_id){
           $this->db->_protect_identifiers = false;
        $this->db->select('ch.file_path,ch.chapter_slide_details,ch.file_type,CASE
        WHEN  (select count(*) from e_course_user_details where chapter_id="'.$chapter_id.'" and user_id="'.$user_id.'")=0 THEN null
        ELSE ( select USER_SLIDE_DETAILS from e_course_user_details where chapter_id="'.$chapter_id.'" and user_id="'.$user_id.'")
    END AS user_slide_details');
        $this->db->from('course_chapter ch');
        $this->db->join('e_course_user_details ecd','ecd.chapter_id=ch.id','left');
        $this->db->where('ch.id',$chapter_id);
      
        $query=$this->db->get();
           $this->db->_protect_identifiers = true;
        return $query->result();
    }

}
