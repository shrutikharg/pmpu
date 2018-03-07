<?php
class Hostplanes_model extends CI_Model {
 
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
    public function get_hostingplanes_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('hostingplan_tbl');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row_array(); 
    }    

    /**
    * Fetch hostingplan_tbl data from the database
    * possibility to mix search, filter and order
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_hostingplanes($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
    {
	    
		$this->db->select('*');
		$this->db->from('hostingplan_tbl');
		$this->db->join('hosting_space_tbl', 'hosting_space_tbl.id = hostingplan_tbl.hosting_id','right');

		if($search_string){
			$this->db->like('name', $search_string);
		}
		$this->db->group_by('hostingplan_tbl.id');

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('hostingplan_tbl.id', $order_type);
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
    function count_hostingplanes($search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('hostingplan_tbl');
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
    function store_hostingplanes($data)
    {
		$insert = $this->db->insert('hostingplan_tbl', $data);
	    return $insert;
	}

    /**
    * Update hostingplan_tbl
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_hostingplanes($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('hostingplan_tbl', $data);
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
    * Delete hostingplan_tblr
    * @param int $id - hostingplan_tbl id
    * @return boolean
    */
	function delete_hostingplanes($id){
		$this->db->where('id', $id);
		$this->db->delete('hostingplan_tbl'); 
	}
	
	
	public function get_hostingplan_tbl_list()
	{
	    $this->db->from('hostingplan_tbl');		
	    $this->db->order_by('id');
	    $result = $this->db->get();
	    $return = array();
	    if($result->num_rows() > 0){
	            $return[''] = 'Please select';
	        foreach($result->result_array() as $row){
	            $return[$row['id']] = $row['plan_price'];
	        }
	    }
    return $return;
	}
	
	public function get_hostingplan_withpricelist()
	{

		$this->db->select('hostingplan_tbl.id as Id');
		$this->db->select('hostingplan_tbl.plan_type  as plan_type');
		$this->db->select('hostingplan_tbl.plan_price  as plan_price');
		$this->db->select('hosting_space_tbl.hosting_space', 'hosting_space');		
		$this->db->from('hostingplan_tbl');
		$this->db->join('hosting_space_tbl', 'hosting_space_tbl.id = hostingplan_tbl.hosting_id');
	    $result = $this->db->get();
	    $return = array();
	
	    if($result->num_rows() > 0){
	            $return[''] = 'Please select';
				//var_dump($result->result_array());
				//exit;
	        foreach($result->result_array() as $row){
				$type=$row['plan_type'];
				if($type=='M')
				{
					$plantype='Monthly';
				}
				elseif($type=='Y')
				{
					$plantype='Yearly';
				}
				
				$name=$row['hosting_space'].' - '.$plantype.' - '.$row['plan_price'].' Rs/-';
				
	            $return[$row['Id']] = $name;
	        }
	    }
    return $return;
	}
	
	
	public function get_hostingplan_tbl_dropdownlist()
    {
		$this->db->select('*');
		$this->db->from('hostingplan_tbl');		
	    $this->db->order_by('id');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	public function get_hostingplan_dropdownlist()
    {
		$this->db->select('hostingplan_tbl.id as Id');
		$this->db->select('hostingplan_tbl.plan_type  as plan_type');
		$this->db->select('hostingplan_tbl.plan_price  as plan_price');
		$this->db->select('hosting_space_tbl.hosting_space', 'hosting_space');		
		$this->db->from('hostingplan_tbl');
		$this->db->join('hosting_space_tbl', 'hosting_space_tbl.id = hostingplan_tbl.hosting_id');
	    $query = $this->db->get();
		return $query->result_array(); 
    }
 
}
?>	
