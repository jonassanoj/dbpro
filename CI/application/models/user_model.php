<?php
class User_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	/*
	
	`detail``userTypeID``fieldID``degree``dateOfBirth`
	`location``organization``lastLogin``rank``acountCreationDate`
	`imagePath``password``email``fullName``userName``userID`
	*/
	
	public function get_user($name = '', $pass = '') {
		if($name == '') {
		
			$query = $this->db->get("User");
			
			return $query->result_array();
			
		}
		else {
			
			$this->db->where("userName", $name);
			$this->db->where("password", $pass);
			$query = $this->db->get("User");
			return $query->result_array();
			
		}
		
	}
	// this method is for adding user 
	// @parameter The Method takes userName and password 
	public function add_user($userName,$password) {
		
		$str = $this->db->query('insert into User(userName,password) values ('.$userName,$password.')');
		
		return $this->db->insert_id();
		
	}
	// this fuction is for udating user 
	// @parameter $user_data is array of user data and $where is the condition variable it can be user name, full name or any  		other record 
	public function update_user($user_data, $where) {
		$query = $this->db->update_string("User", $user_data, $where);
		$this->db->query($query);
		
	}
	// this function is for checking user name if exist 
	public function check_userName($username) {
		$res = $this->db->get_where("User", $username)->result();
		if(isset($res) && count($res) > 0 ) 
		return false; // if user exists
		else
		return true;  // if not exists
	}
	// this method returns all user data in the user table which is related to the $userid
	public function get_userdata($userid) {
		
		$this->db->where("userID", $userid);
		$query = $this->db->get("User");
		return $query->result_array();
		
	}


	// This method returns limited user data starts from the offset for pagination
	public function get_Users($limit,$offset){
		$query=$this->db->get('User',$limit,$offset);
		return $query->result();
	}
	
	//This method will check if the userName and password match will return true 
	   
	public function check_login($userName,$password){
		$this->db->where('userName',$userName);
		$this->db->where('password',$password);
		$query=$this->db->get('User');
		if($query==null){
			return false;
		}
		   
		
		else{return true;}
		
		
	}
	
	

}

