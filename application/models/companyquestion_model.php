<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of companyquestion_model
 *
 * @author abc
 */
class companyquestion_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function insert($insert_data) {
        $query = $this->db->insert('questions', $insert_data);
        return $this->db->insert_id();
    }

}
