<?php
class Category_model extends CI_Model {
 
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
    public function get_category_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('category');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	
	public function get_companyuser_list()
    {
		
		$this->db->select('*');
		$this->db->from('users');
		$this->db->group_by('company_name');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	public function get_category_list()
	{
	    $this->db->from('category');
		$this->db->where('IsActive', 'Y');
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
	
	public function get_category_droplist()
    {
		$this->db->select('*');
		$this->db->from('category');
		$this->db->where('IsActive', 'Y');
	    $this->db->order_by('id');
		$query = $this->db->get();
		return $query->result_array(); 
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
    public function get_category($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
    {
	    
		$this->db->select('*');
		$this->db->from('category');

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
    function count_category($search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('category');
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
    function store_category($data)
    {
		$insert = $this->db->insert('category', $data);
	    return $insert;
	}

    /**
    * Update category
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_category($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('category', $data);
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
    * Delete categoryr
    * @param int $id - category id
    * @return boolean
    */
	function delete_category($id){
		$this->db->where('id', $id);
		$this->db->delete('category'); 
	}
 
}
?>	
