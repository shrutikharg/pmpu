<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of companyquestionbank_model
 *
 * @author a
 */
class companyquestionbank_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_chapters_question_list($chapter_id, $question_bank_id) {
        $this->db->_protect_identifiers = false;
        $this->db->select('question_list');
        $this->db->from('question_bank');

        $this->db->where('chapter_id', $chapter_id);
        $this->db->where('id', $question_bank_id);
        $query = $this->db->get();

        $this->db->select("id,name");
        if ($query->row()->question_list != NULL) {
            $this->db->select("CASE
        WHEN  id in (" . $query->row()->question_list . ") THEN 'checked'
        ELSE ''
        END AS status", false);
            $this->db->from('questions');
        } else {

            $this->db->select('@status:="" as status');
            $this->db->from('questions');
            $this->db->where('chapter_id', $chapter_id);
        }


        // $this->db->where_in('id', $question_bank_chapters_question_data);
        $query = $this->db->get();
        $this->db->_protect_identifiers = TRUE;
        return $query;
    }

    public function update_questionbank_question_list($question_bank_id, $questionbank_question_list) {
        $this->db->where('id', $question_bank_id);
        $query = $this->db->update('question_bank', $questionbank_question_list);
        return $query;
    }

    public function add($insert_data) {
        $insert = $this->db->insert('question_bank', $insert_data);
        return $insert;
    }

    public function get_questionbank($userid, $sidx, $sord, $start, $limit, $search_string_array, $count) {
        $this->db->select('qb.id,qb.name,ch.name as Chapter,ch.id as chapter_id');
        $this->db->from('question_bank qb');
        $this->db->join('course_chapter ch', 'ch.id=qb.chapter_id');
        $this->db->where('qb.created_by', $userid);


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

    public function question_list($questionbank_id) {
        $this->db->select('question_list');
        $this->db->from('question_bank');
        $this->db->where('id', $questionbank_id);
        $query = $this->db->get();
        $this->db->select("id,name");
        $this->db->from('questions');
        $this->db->where_in('id', explode(',', $query->row()->question_list));
        $query = $this->db->get();
        return $query;
    }
       public function question_bank_question_list($questionbank_id) {
        $this->db->select('question_list');
        $this->db->from('question_bank');
        $this->db->where('id', $questionbank_id);
        $query = $this->db->get();
        return $query->row()->question_list;
       
    }

}
