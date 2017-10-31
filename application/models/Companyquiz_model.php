<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Companyquiz_model
 *
 * @author a
 */
class Companyquiz_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_quiz($userid, $sidx, $sord, $start, $limit, $search_string_array, $count) {
        $this->db->select('*');
        $this->db->from('quiz');
        $this->db->where('created_by', $userid);
        if ($search_string_array != "") {
            $this->db->like('name', $search_string_array->search_string);
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

    public function get_question_from_questionbank($quiz_based_on, $quiz_based_value_array) {


        $query = "SET @CHAPTER_DETAILS = '[null]', @chapters_id = '4'";
        $this->db->query($query);
        $success = $this->db->query("call build_related_question(@CHAPTER_DETAILS,@chapters_id)");

        $query = $this->db->query('select @CHAPTER_DETAILS as out_param');
        return $query->result();
    }

    public function update_question_list($quiz_question_array) {
        
    }

    public function add($store_array) {
        $this->db->insert('quiz', $store_array);
    }

    public function get_quiz_by_id($quiz_id) {
        $this->db->select('*');
        $this->db->from('quiz');
        $this->db->where('id', $quiz_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function add_question($quiz_id, $question_id) {

        $add_question_query = "UPDATE quiz AS q,(SELECT id,question_list FROM quiz WHERE id = '$quiz_id') AS p                                
                            SET q.question_list =if(isnull(p.question_list),json_array('$question_id'),                               
                                                           IF((JSON_CONTAINS(p.question_list,'$question_id')=0),json_merge(p.question_list,'$question_id'),p.question_list)                                                               
		                                              )
                                                   WHERE q.id = p.id";
        $query = $this->db->query($add_question_query);
        return $query;
    }

    public function get_question_list($userid, $quiz_id, $sidx, $sord, $start, $limit, $search_string_array, $is_count) {
        $this->db->_protect_identifiers = FALSE;
        $this->db->select('id,name,options,question_type');
        $this->db->from('questions');

        $quiz_question_query = "(select question_list from quiz where id=$quiz_id)";
        $this->db->join("$quiz_question_query qz", "JSON_CONTAINS(qz.question_list, CAST(questions.id AS CHAR))");
        if ($search_string_array != "") {
            $this->db->like('name', $search_string_array->search_string);
        }
        $this->db->order_by("$sidx $sord");
        if ($is_count == false) {
            $this->db->limit($limit, $start);
        }

        $query = $this->db->get();

        if ($is_count == false) {
            return $query;
        } else {
            return $query->num_rows();
        }
        $this->db->_protect_identifiers = TRUE;
    }

}
