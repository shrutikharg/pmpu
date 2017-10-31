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
        $this->db->where('user_id', $user_id);
        $this->db->where('chapter_id', $chapter_id);
        $this->db->update('e_course_user_details', $insert_array);
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

}
