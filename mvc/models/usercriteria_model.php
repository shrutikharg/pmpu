<?php
class Usercriteria_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    /**
    * Get product by his is
    * @param int $product_id 
    * @return array
    */
    public function get_usercriteria_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('usercriteria');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }    

    /**
    * Fetch usercriteria data from the database
    * possibility to mix search, filter and order
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_usercriteria($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
    {
	    
		$this->db->select('usercriteria.id as id');		
		$this->db->select('criteria.name  as criterianame');
		$this->db->select('hostingplan_tbl.plan_type  as plan_type');		
		$this->db->select('hostingplan_tbl.plan_price  as plan_price');
		$this->db->select('hosting_space_tbl.hosting_space as hosting_space');		
		$this->db->from('usercriteria');
		
		$this->db->join('criteria', 'criteria.id = usercriteria.criteria_id');
		$this->db->join('hostingplan_tbl', 'hostingplan_tbl.id = usercriteria.hostingplan_id');
		$this->db->join('hosting_space_tbl', 'hosting_space_tbl.id = hostingplan_tbl.hosting_id');
		
		if($search_string){
			$this->db->like('hosting_space', $search_string);
		}
		$this->db->group_by('id');

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('id', $order_type);
		}

        if($limit_start && $limit_end){
          $this->db->limit($limit_start, $limit_end);	
        }

        if($limit_start != null){
          $this->db->limit($limit_start, $limit_end);    
        }
        
		$query = $this->db->get();
		
		return $query->result_array(); 	
    }

    /**
    * Count the number of rows
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_usercriteria($search_string=null, $order=null)
    {
		$this->db->select('usercriteria.id as id');		
		$this->db->select('criteria.name  as criterianame');
		$this->db->select('hostingplan_tbl.plan_type  as plan_type');		
		$this->db->select('hostingplan_tbl.plan_price  as plan_price');
		$this->db->select('hosting_space_tbl.hosting_space as hosting_space');		
		$this->db->from('usercriteria');
		
		$this->db->join('criteria', 'criteria.id = usercriteria.criteria_id');
		$this->db->join('hostingplan_tbl', 'hostingplan_tbl.id = usercriteria.hostingplan_id');
		$this->db->join('hosting_space_tbl', 'hosting_space_tbl.id = hostingplan_tbl.hosting_id');
		
		if($search_string){
			$this->db->like('hosting_space', $search_string);
		}
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('id', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_usercriteria($data)
    {
		$insert = $this->db->insert('usercriteria', $data);
	    return $insert;
	}

    /**
    * Update usercriteria
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_usercriteria($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('usercriteria', $data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

    /**
    * Delete usercriteriar
    * @param int $id - usercriteria id
    * @return boolean
    */
	function delete_usercriteria($id){
		$this->db->where('id', $id);
		$this->db->delete('usercriteria'); 
	}
	
	
	public function get_usercriteria_list()
	{
	    $this->db->from('usercriteria');
		$this->db->where('IsActive','Y');
	    $this->db->order_by('id');
	    $result = $this->db->get();
	    $return = array();
	    if($result->num_rows() > 0){
	            $return[''] = 'Please select';
	        foreach($result->result_array() as $row){
	            $return[$row['id']] = $row['usercriteria_name'];
	        }
	    }
    return $return;
	}
	
	
	public function get_usercriteria_dropdownlist()
    {
		$this->db->select('*');
		$this->db->from('usercriteria');
		$this->db->where('IsActive', 'Y');
	    $this->db->order_by('id');
		$query = $this->db->get();
		return $query->result_array(); 
    }
 
}
?>	
