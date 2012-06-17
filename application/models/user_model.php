<?php
/**
 * the user model
 *
 * User management. CRUD for users, their types and their fields. 
 *
 * It uses the following database tables:
 *
 * * _User_
 * * _UserType_ (read only)
 *
 * @package models
 */


class User_model extends CI_Model {

	// TODO: implement the login function. If the username exists, and the user's password is equal to $password it should return the userID, otherwise 0. Also implement delete_user(). Then create phpdoc comments for both functions.  
	public function login($name, $password) {
	 return 1;
	}

	public function delete_user($uid) {
	
	}
		
	// TODO: implement the add_user function. A new unconfirmed user (userTypeID=0) is created with the given parameters. Set the accountCreationDate to the current date. Document the function using phpdoc.   
	/**
	 ** function add user is for adding new user in the table User with initial data *(username,password and email address)	
	 * @author ASHUQULLAH ALIZAI
	 * @param string_type $name is the username for the user 
	 * @param password_type $password password specify by user
	 * @param email_type $email email specify by user 
	 */
	public function add_user($name, $password, $email) {
	// check for existing user
	$check_user =$this->_check_userName($name);
	if (!$check_user){
		return false;
	}else {
		$date = date('Y/m/d H:i:s');
		$this -> db -> set('userName', $name);
		$this -> db -> set('paswword', $password);
		$this -> db -> set('email', $email);
		$this -> db -> set('accountCreationDate', $date);
		$this -> db -> insert('User');
		// return true if successful
		return true;
	}
	
	}
	/**
	 * @author ASHUQULLAH ALIZAI
	 * @param string_type $username is the user name for user who wants to register for first time 
	 * *private function _check_userName checks if usename exists or not ,
	 * @ returns false if username exist in the database, retruns true if the username not exist 
	 */

	public function _check_userName($username) {
		$res = $this->db->get_where("User", $username)->result();
		if(isset($res) && count($res) > 0 )
			return false; // if user exists
		else
			return true;  // if not exists
	}
	

	// TODO: Find out how the update_user() function can be used. Then document it using phpdoc. Use question_model::get_list() as an example.
	public function update_user($uid, $user_data) {
		$this -> db -> query(update_string('User',$user_data, "userID = $uid"));
		return $this -> db -> affected_rows(); 
	}
	
	// TODO: This function should return the user object for the user with id $uid. Additionally to the data from the User table, it should contain the users category (userType) and field (fieldName). Create phpdoc for this function. Note: you will also need to update the class' phpdoc.'  
	public function get_userdata($uid) {
	}
	
	// TODO: implement change_usertype() so it changes the user specified by $uid to category number $utid. Document this function and get_usertypes using phpdoc.
	public function change_usertype($uid, $utid) {
	  // return true if successful
	}

	public function get_usertypes() {
	 	$query = $this->db->get('UserType');    
	    return $query->result();
	}
	
	//TODO: implement and document get_usertype() and get_field(). Both return a single integer indicating the usertypeID or fieldID of the user.
	public function get_usertype($uid) {
	  return 0;
	}
	
	public function get_field($uid){
	  return 0;
	}
	
}
