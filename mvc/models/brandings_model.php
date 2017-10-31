<?php
class Brandings_model extends CI_Model {
 
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
	public function get_product_by_id($id)
	{
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	
	
    public function get_themeset_default()
	{
		$this->db->select('*');
		$this->db->from('theme_default');
		$query = $this->db->get();
		return $query->result_array(); 
	}
    
	
	
	public function get_themeset_user($userid)
	{
		$this->db->select('*');
		$this->db->from('themes_users');
		$this->db->where('userid', $userid);
		$this->db->order_by('id', 'DESC');
		$this->db->limit('1');		
		$query = $this->db->get();
		
		return $query->result_array(); 
	}

    
	public function get_subprddetails($id)
	{
		$this->db->select('*');
		$this->db->from('products');
		$this->db->join('subdetailsproduct', 'subdetailsproduct.productid = products.id', 'left');
		$this->db->where('products.id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	public function get_subproductnew($id)
	{
		$this->db->select('*');
		$this->db->from('products');
		$this->db->join('subdetailsproduct', 'subdetailsproduct.productid = products.id', 'left');
		$this->db->where('subdetailsproduct.category_id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	/*get products detail using category*/
	public function get_productbycategory_id($id)
	{
		$this->db->select('product_name,category.id,category.name as catgname,avilable_strength,product_image,description,products.id as prdid');
		$this->db->from('products');
		$this->db->join('category', 'products.category_id = category.id', 'left');
		//$this->db->join('subdetailsproduct', 'subdetailsproduct.productid = products.id', 'left');
		$this->db->where('category.id', $id);
		//$this->db->group_by('products.id');
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	
	
	public function get_subproduct_grp($id)
	{
		$this->db->select('*');
		$this->db->from('products');
		$this->db->join('subdetailsproduct', 'subdetailsproduct.productid = products.id', 'left');
		$this->db->where('subdetailsproduct.category_id', $id);
		$this->db->group_by('products.id');
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	
	public function newquery()	{	
  
	$query =$this->db->query('SELECT *  FROM  category, products  WHERE  products.id = ?? AND FIND_IN_SET(category.id, products.catid) > 0 GROUP BY products.id');
	return $query->result_array(); 
	}
	
	
	

    /**
    * Fetch products data from the database
    * possibility to mix search, filter and order
    * @param int $manufacuture_id 
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_products($category_id=null, $search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {
	    
		$this->db->select('products.id');
		$this->db->select('products.product_name');
		$this->db->select('products.generic_name');
		$this->db->select('products.product_image');
		$this->db->select('products.description');
		$this->db->select('products.avilable_strength');		
		$this->db->select('products.min_order_qty');
		$this->db->select('products.category_id');
		$this->db->select('category.name as category_name');
		$this->db->from('products');
		if($category_id != null && $category_id != 0){
			$this->db->where('category_id', $category_id);
		}
		if($search_string){
			$this->db->like('description', $search_string);
		}

		$this->db->join('category', 'products.category_id = category.id', 'left');

		$this->db->group_by('products.id');

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('id', $order_type);
		}


		$this->db->limit($limit_start, $limit_end);
		//$this->db->limit('4', '4');


		$query = $this->db->get();
		
		return $query->result_array(); 	
    }

    /**
    * Count the number of rows
    * @param int $category_id
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_products($category_id=null, $search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('products');
		if($category_id != null && $category_id != 0){
			$this->db->where('category_id', $category_id);
		}
		if($search_string){
			$this->db->like('description', $search_string);
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
    function store_product($data)
    {
		$insert = $this->db->insert('products', $data);
	    return $insert;
	}
	
	
	function store_theme_detailsofuser($data)
    {
		
		$data['username']=$this->session->userdata('user_name');
		$data['userid']=$this->session->userdata('id');
		$data['theme_created']=date('Y-m-d');
		$insert = $this->db->insert('themes_users', $data);
	    return $insert;
	}
	
	
	function store_subproduct($data)
	{
		$insert = $this->db->insert('subdetailsproduct', $data);
	    return $insert;
	}

    /**
    * Update product
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_product($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('products', $data);
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
    * Delete product
    * @param int $id - product id
    * @return boolean
    */
	function delete_product($id){
		$this->db->where('id', $id);
		$this->db->delete('products'); 
	}
	
	function delete_subproductdetails($id){
		$this->db->where('subid', $id);
		$this->db->delete('subdetailsproduct'); 
	}
	
 
}
?>	
