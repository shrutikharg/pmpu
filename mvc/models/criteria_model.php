<?php
class Criteria_model extends CI_Model {
 
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
    public function get_criteria_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('criteria');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	public function get_criteria_list()
	{
	    $this->db->from('criteria');		
	    $this->db->order_by('id');
	    $result = $this->db->get();
	    $return = array();
	    if($result->num_rows() > 0){
	            $return[''] = 'Please select';
	        foreach($result->result_array() as $row){
	            $return[$row['id']] = $row['name'];
	        }
	    }
    return $return;
	}
	
	public function get_criteria_droplist()
    {
		$this->db->select('*');
		$this->db->from('criteria');		
	    $this->db->order_by('id');
		$query = $this->db->get();
		return $query->result_array(); 
    }

    /**
    * Fetch criteria data from the database
    * possibility to mix search, filter and order
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_criteria($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
    {
	    
		$this->db->select('*');
		$this->db->from('criteria');

		if($search_string){
			$this->db->like('name', $search_string);
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
    function count_criteria($search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('criteria');
		if($search_string){
			$this->db->like('name', $search_string);
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
    function store_criteria($data)
    {
		$insert = $this->db->insert('criteria', $data);
	    return $insert;
	}

    /**
    * Update criteria
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_criteria($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('criteria', $data);
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
    * Delete criteriar
    * @param int $id - criteria id
    * @return boolean
    */
	function delete_criteria($id){
		$this->db->where('id', $id);
		$this->db->delete('criteria'); 
	}
 
}
?>	
