<?php
class Employeecourses_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
		$this->load->library('user_agent');
    }

    /**
    * Get product by his is
    * @param int $product_id 
    * @return array
    */
    public function get_courses_by_id($id)
    {
		$this->db->select('*');		
		$this->db->from('courses');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }  

	
	public function get_chapterby_id($id)
    {
		$this->db->select('*');		
		$this->db->from('course_chapter');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	public function get_chaptercoursedetails($courseid,$id,$empcompid)
	{	
	
		$this->db->select('course_chapter.course_id as courseid');
		$this->db->select('course_chapter.id as chapterid');
		$this->db->select('course_chapter.name as chaptername');
		$this->db->select('course_chapter.description as chapterdescription');
		$this->db->select('course_chapter.image_path as chapterimage');
		$this->db->select('course_chapter.file_path as file_name');
                $this->db->select('course_chapter.file_type ');
		$this->db->select('courses.name as coursename');			
		$this->db->select('course_chapter.chapter_slide_details as slide_details');
		$this->db->select('course_chapter.comments');
		$this->db->select('courses.Is_Active as coursestatus');
		$this->db->select('course_chapter.Is_Active as chapterstatus');		
		$this->db->from('course_chapter');
		$this->db->join('courses','courses.id = course_chapter.course_id');	
		//$this->db->where('course_chapter.Is_Active', 'Y');
		//$this->db->where('course_chapter.user_id',$empcompid);	
		$this->db->where('course_chapter.course_id',$courseid);
		$this->db->where('course_chapter.id',$id);
		
		$query = $this->db->get();
		
		return $query->result_array(); 	
	}
	
	
		
	public function get_schedulelist_data($userid,$empcompid)
    {
		$this->db->select('course_chapter.courseid as courseid');
		$this->db->select('topic_scheduled.Video_Id as videoid');
		$this->db->select('topic_scheduled.Schedule_Id as scheduleid');
		$this->db->select('topic_scheduled.Schedule_Time as scheduledate');		
		$this->db->select('course_chapter.id as chapterid');
		$this->db->select('course_chapter.name as chaptername');
		$this->db->select('course_chapter.description as chapterdescription');
		$this->db->select('course_chapter.chapter_image as chapterimage');
		$this->db->select('course_chapter.chapter_videoid as chaptervideo');
		$this->db->select('courses.course_name as coursename');
		$this->db->select('courses.course_validity as coursevalidity');
		$this->db->select('courses.course_price as courseprice');
		$this->db->select('courses.IsActive as coursestatus');
		$this->db->select('course_chapter.IsActive as chapterstatus');
		$this->db->select('topic_scheduled.Schedule_Time as schedule_date');
		$this->db->select('topic_scheduled.Schedule_Time as schedule_date');
			
		$this->db->from('topic_scheduled');
		$this->db->join('course_chapter','course_chapter.id = topic_scheduled.Video_Id');
		$this->db->join('courses','courses.id = course_chapter.courseid');
		$this->db->where('course_chapter.IsActive', 'Y');
		$this->db->where('course_chapter.userid',$empcompid);	
		$this->db->where('topic_scheduled.User_Id',$userid);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	
	public function select_scheduleempdetails($chapid,$empcompid,$courseid)
    {
		$this->db->select('course_chapter.courseid as courseid');
		$this->db->select('course_chapter.id as chapterid');
		$this->db->select('course_chapter.name as chaptername');
		$this->db->select('course_chapter.description as chapterdescription');
		$this->db->select('course_chapter.chapter_image as chapterimage');
		$this->db->select('course_chapter.chapter_videoid as chaptervideo');
		$this->db->select('courses.course_name as coursename');
		$this->db->select('courses.course_validity as coursevalidity');
		$this->db->select('courses.course_price as courseprice');
		$this->db->select('courses.IsActive as coursestatus');
		$this->db->select('course_chapter.IsActive as chapterstatus');		
		$this->db->from('course_chapter');
		$this->db->join('courses','courses.id = course_chapter.courseid');	
		$this->db->where('course_chapter.IsActive', 'Y');
		$this->db->where('course_chapter.userid',$empcompid);	
		$this->db->where('course_chapter.courseid',$courseid);
		$this->db->where('course_chapter.id',$chapid);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	public function get_chapterlistdetails($id,$empcompid)
    {
		$this->db->select('*');		
		$this->db->from('course_chapter');		
		//$this->db->where('course_chapter.userid',$empcompid);	
		$this->db->where('course_chapter.courseid',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
    /**
    * Fetch courses data from the database
    * possibility to mix search, filter and order
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_courses($userid,$search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
    {
	    
		$this->db->select('*');
		$this->db->from('courses');
		$this->db->where('company_id',$this->session->userdata('company_id'));
		 $this->db->order_by('id','desc');
		if($search_string)
		{
			$this->db->like('name', $search_string);
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
    function count_courses($userid,$search_string=null, $order=null)
    {

		$this->db->select('assigned_course.id as id,course_name,course_subtitle,course_validity,courseid,assignedby_user,assignedby_user,course_videoid,courses.IsActive,course_by,users.first_name as fname, users.last_name as lname');
		$this->db->from('assigned_course');
		$this->db->where('courses.IsActive','Y');
		$this->db->where('assigned_course.assignuserid',$userid);
		$this->db->join('courses','assigned_course.courseid = courses.id');
		$this->db->join('users','assigned_course.assignedby_user = users.id');
		
		
		$query = $this->db->get();
		return $query->num_rows();        
    }
	
	  /**
    * Fetch courses data from the database
    * possibility to mix search, filter and order
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_assigncourses($userid)
    {
	    
		$this->db->select('assigned_course.id as id,name,description,courses.start_date,courses.end_date,course_id,courses.image_path,courses.is_Active,course_by,users.first_name as fname, users.last_name as lname');
		$this->db->from('assigned_course');
		$this->db->where('courses.is_Active','Y');
		$this->db->where('assigned_course.assigned_to',$userid);
		$this->db->join('courses','assigned_course.course_id = courses.id');
		$this->db->join('users','assigned_course.assigned_to = users.id');
	
        
		$query = $this->db->get();
		
		return $query->result_array(); 	
    }

    /**
    * Count the number of rows
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_assigncourses($userid,$search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('assigned_course');
		$this->db->where('assigned_course.assignuserid',$userid);		
		$this->db->join('courses','assigned_course.courseid = courses.id');
		if($search_string){
			$this->db->like('assigned_course.id', $search_string);
		}
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('assigned_course.id', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }
   
	
    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
	
    */
    function store_courses($data)
    {
		$insert = $this->db->insert('course_video', $data);
	    return $insert;
	}
	
	function store_commentstbl($data)
    {
		$insert = $this->db->insert('user_comments', $data);
	    return $insert;
	}
	
	
	function store_certificatemail($data)
    {
		$insert = $this->db->insert('certicate_report', $data);
	    return $insert;
	}
	
	function store_takingcourse($data)
    {
		$insert = $this->db->insert('takingcourse_report', $data);
	    return $insert;
	}
	
	function store_scheduletasktbl($data)
    {
		$insert = $this->db->insert('topic_scheduled', $data);
	    return $insert;
	}
	
	function store_notifcationtask($data)
    {
		$insert = $this->db->insert('notifications', $data);
	    return $insert;
	}

	public function get_commentslistdetails($courseid,$userid)
    {
		$this->db->select('*');		
		$this->db->from('user_comments');
		$this->db->where('courseid_comment', $courseid);
		$this->db->where('empuserid', $userid);
		$query = $this->db->get();
		return $query->result_array(); 
    }
    /**
    * Update courses
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_courses($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('courses', $data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
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
	
	
	
	function update_assigncourses($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('assigned_course', $data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}
	
	
	function update_alertnotifcation($userid, $data)
    {
		$this->db->where('assignedby_user_id', $userid);
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
    * Delete coursesr
    * @param int $id - courses id
    * @return boolean
    */
	function delete_courses($id){
		$this->db->where('id', $id);
		$this->db->delete('courses'); 
	}
	
	
	
	public function get_coursesassignby_id($id)
    {
		$this->db->select('*');
		$this->db->from('assigned_course');
		$this->db->join('courses','assigned_course.courseid = courses.id');
		$this->db->where('assigned_course.id', $id);		
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
	
	
	public function get_coursesby_id($courseid)
    {
		
		$this->db->select('*');
		$this->db->from('courses');
		$this->db->where('courses.IsActive','Y');
		$this->db->where('id', $courseid);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	/*public function get_subcategory_list()
	{
	    $this->db->from('courses');
		$this->db->where('IsActive','Y');
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
	
	
	public function get_subcategory_dropdownlist()
    {
		$this->db->select('*');
		$this->db->from('courses');
		$this->db->where('IsActive', 'Y');
	    $this->db->order_by('id');
		$query = $this->db->get();
		return $query->result_array(); 
    }*/
 
	function count_assigncoursestopics($empcompid,$courseid)
    {
		$this->db->select('*');
		$this->db->from('course_chapter');
		$this->db->where('Is_Active', 'Y');
		//$this->db->where('admin_id',$empcompid);	
		$this->db->where('course_id',$courseid);		
		$query = $this->db->get();
		return $query->num_rows();        
    }
	
	 public function get_assigncoursestopics($empcompid,$courseid,$search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
    {
		$this->db->select('course_chapter.course_id as courseid');
		$this->db->select('course_chapter.id as chapterid');
		$this->db->select('course_chapter.name as chaptername');
		$this->db->select('course_chapter.description as chapterdescription');
		$this->db->select('course_chapter.image_path as chapterimage');
		
		$this->db->select('courses.name as coursename');
		$this->db->select('courses.start_date as coursevalidity');
		
		$this->db->select('courses.is_Active as coursestatus');
		$this->db->select('course_chapter.is_active as chapterstatus');		
		$this->db->from('course_chapter');
		$this->db->join('courses','courses.id = course_chapter.course_id');	
		
		$this->db->where('course_chapter.course_id',$courseid);	
		
		
		if($search_string){
			$this->db->like('course_chapter.name', $search_string);
		}
		
		    $this->db->order_by('course_chapter.id', $order_type);
		

        if($limit_start && $limit_end){
          $this->db->limit($limit_start, $limit_end);	
        }

        if($limit_start != null){
          $this->db->limit($limit_start, $limit_end);    
        }
        
		$query = $this->db->get();
		
		return $query->result_array(); 	
    }
	
	
	
	
	
	
	function count_usernotification($userid,$search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('notifications');
		$this->db->where('assignedby_user_id', $userid);		
	    $this->db->order_by('Notification_Id', 'DESC');		
		$query = $this->db->get();
		return $query->num_rows();        
    }
	
	
public function get_usernoticationdetails($userid,$search_string=null, $order=null, $order_type='DESC', $limit_start=null, $limit_end=null)
    {
	    
		$this->db->select('*');
		$this->db->from('notifications');
		$this->db->where('assignedby_user_id', $userid);		
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
	
	
	
}
?>	