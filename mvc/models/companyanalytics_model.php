<?php
class Companyanalytics_model extends CI_Model {
 
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
    public function get_subcategory_by_id($userid,$id)
    {
		$this->db->select('*');
		$this->db->from('subcategory');
		$this->db->where('id', $id);
		$this->db->where('useracess_id', $userid);
		$query = $this->db->get();
		return $query->result_array(); 
    }    

    /**
    * Fetch subcategory data from the database
    * possibility to mix search, filter and order
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_subcategory($userid,$search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
    {
	    
		$this->db->select('*');
		$this->db->from('subcategory');
		$this->db->where('useracess_id', $userid);
		if($search_string)
		{
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
    function count_subcategory($userid,$search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('subcategory');
		$this->db->where('useracess_id', $userid);
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
	
	function count_subcatlimitcategory($userid)
    {
		$this->db->select('*');
		$this->db->from('subcategory');
		$this->db->where('useracess_id', $userid);		
		$query = $this->db->get();
		return $query->num_rows();        
    }
	
    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_subcategory($data)
    {
		$insert = $this->db->insert('subcategory', $data);
	    return $insert;
	}

    /**
    * Update subcategory
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_subcategory($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('subcategory', $data);
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
    * Delete subcategoryr
    * @param int $id - subcategory id
    * @return boolean
    */
	function delete_subcategory($id){
		$this->db->where('id', $id);
		$this->db->delete('subcategory'); 
	}
	
	
	public function get_subcategory_list($userid)
	{
	    $this->db->from('subcategory');
		$this->db->where('IsActive','Y');
		$this->db->where('useracess_id', $userid);
	    $this->db->order_by('id');
	    $result = $this->db->get();
	    $return = array();
	    if($result->num_rows() > 0){
	            $return[''] = 'Please select';
	        foreach($result->result_array() as $row){
	            $return[$row['id']] = $row['subcategory_name'];
	        }
	    }
    return $return;
	}
	
	
	public function get_subcategory_dropdownlist($userid)
    {
		$this->db->select('*');
		$this->db->from('subcategory');
		$this->db->where('IsActive', 'Y');
		$this->db->where('useracess_id', $userid);
	    $this->db->order_by('id');
		$query = $this->db->get();
		return $query->result_array();
    }
	
	
	function count_assignedcourses($userid)
    {
		$this->db->select('*');
		$this->db->from('assigned_course');
		$this->db->where('assignedby_user',$userid);		
		$query = $this->db->get();
		return $query->num_rows();        
    }
	
	function count_totalcertficcount($userid)
    {
		$this->db->select('*');
		$this->db->from('assigned_course');
		$this->db->where('certificate_flag','Y');		
		$this->db->where('assignedby_user',$userid);		
		$query = $this->db->get();
		return $query->num_rows();        
    }
	
	
	function count_clicksvisitcourses($userid)
    {
		$this->db->select('*');
		$this->db->from('takingcourse_report');
		$this->db->where('userid',$userid);		
		$query = $this->db->get();
		return $query->num_rows();        
    }

	
	function total_viewerslist($userid)
    {
		$this->db->select('*');
		$this->db->from('takingcourse_report');
		$this->db->where('userid',$userid);
		$this->db->order_by('takingcourse_report.id', 'DESC');
		$this->db->limit('5');
		$query = $this->db->get();
		return $query->result_array();        
    }
	
	function count_totalrecentviewersusers($userid)
    {
		$this->db->select('*');
		$this->db->from('takingcourse_report');
		$this->db->where('userid',$userid);
		$this->db->order_by('takingcourse_report.id', 'DESC');
		$query = $this->db->get();
		return $query->result_array();        
    }
 
}
?>	
