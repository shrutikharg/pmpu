<?php

class Companyuserassign_model extends CI_Model {

    /**
     * Responsable for auto load the database
     * @return void
     */
    public function __construct() {
        $this->load->database();
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
    public function get_userassign($sidx, $sord, $start, $limit, $search_string_array, $count) {

        $this->db->select("email,id");
        $this->db->select("IF(isnull(first_name),' ',first_name) as first_name", false);
        $this->db->select("IF(isnull(last_name),' ',last_name) as last_name", false);
        $this->db->select("IF(isnull(phone_no),' ',phone_no) as phone_no", false);
        $this->db->from('users');
        $this->db->where('company_id', $this->session->userdata('company_id'));
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

    public function employee_subscription_details($employee_id) {
        $this->db->select('s.txn_id,s.payment_through,s.created_at,u.email,u.phone_no,first_name,u.last_name,u.image_path,u.is_active');
        $this->db->from('users u');
        $this->db->join('subscription s', 's.user_id=u.id', 'left');
        $this->db->where('u.id', $employee_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function update($data) {
        $this->db->where('id', $data['id']);
        $query = $this->db->update('users', $data);
        return $query;
    }

    public function get_userdetailspresent($email) {
        $this->db->select('u.id,u.email,ug.group_id');
        $this->db->from('users u');
        $this->db->join('users_groups ug', 'u.id=ug.user_id', 'left');
        $this->db->where('email', $email);
        $query = $this->db->get();
        return $query->result_array();
    }

    function insert_csv($data) {
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    function insert_usergroupcsv($data) {
        $this->db->insert('users_groups', $data);
    }
    function insert_subscription($data){
      $this->db->insert('subscription', $data);   
    }

}
?>	
