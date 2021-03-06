<?php
class Companycmspage_model extends CI_Model {
 
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
    public function get_cmspage_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('cmspage');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row(); 
    }
	
	 public function list_cmspage()
	{
		$this->db->select('*');
		$this->db->from('cmspage');
		$this->db->where('company_id', $this->session->userdata('company_id'));
		
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	
	
	public function get_cmspage_list()
	{
	    $this->db->from('cmspage');
		$this->db->where('userid', $userid);
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
	
	public function get_cmspage_droplist($userid)
    {
		$this->db->select('*');
		$this->db->from('cmspage');
		$this->db->where('IsActive', 'Y');
		$this->db->where('usercat_id', $userid);
	    $this->db->order_by('id');
		$query = $this->db->get();
		return $query->result_array(); 
    }

    /**
    * Fetch cmspage data from the database
    * possibility to mix search, filter and order
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_cmspage()
    {
        $this->db->select('*');
        $this->db->from('cmspage');
        $this->db->where('company_id',  $this->session->userdata('company_id'));
        $query = $this->db->get();		
        return $query->row(); 	
    }
    /**
    * Count the number of rows
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_cmspage($userid,$search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('cmspage');
		$this->db->where('userid', $userid);
		if($search_string){
			$this->db->like('emailid', $search_string);
		}
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('id', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }
	
	
	function count_notification($userid,$search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('notifications');
		$this->db->where('User_Id', $userid);		
	    $this->db->order_by('Notification_Id', 'DESC');		
		$query = $this->db->get();
		return $query->num_rows();        
    }
	
	
public function get_noticationdetails($userid,$search_string=null, $order=null, $order_type='DESC', $limit_start=null, $limit_end=null)
    {
	    
		$this->db->select('*');
		$this->db->from('notifications');
		$this->db->where('User_Id', $userid);		
		$this->db->group_by('Notification_Id');
		$this->db->order_by('Notification_Id', $order_type);
		
        if($limit_start && $limit_end){
          $this->db->limit($limit_start, $limit_end);	
        }

        if($limit_start != null){
          $this->db->limit($limit_start, $limit_end);    
        }
        
		$query = $this->db->get();
		
		return $query->result_array(); 	
    }
	
	
	
	function count_limitcmspage($userid)
    {
		$this->db->select('*');
		$this->db->from('cmspage');
		$this->db->where('userid', $userid);		
		$query = $this->db->get();
		return $query->num_rows();        
    }
	


    function update_notifcation($userid, $data)
    {
		$this->db->where('User_Id', $userid);
		$this->db->where('IsActive','Y');
		$this->db->update('notifications', $data);
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
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_cmspage($data)
    {
		$insert = $this->db->insert('cmspage', $data);
	    return $insert;
	}

    /**
    * Update cmspage
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_cmspage( $data)
    {
		$this->db->where('company_id', $this->session->userdata('company_id'));
		$this->db->update('cmspage', $data);
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
    * Delete cmspager
    * @param int $id - cmspage id
    * @return boolean
    */
	function delete_cmspage($id){
		$this->db->where('id', $id);
		$this->db->delete('cmspage'); 
	}
  
 
}
?>	
