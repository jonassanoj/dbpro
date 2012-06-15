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

//TODO: adapt docu of every function according coding conventions

class User_model extends CI_Model {

	// TODO: implement the login function. If the username exists, and the user's password is equal to $password it should return the userID, otherwise 0. Also implement delete_user(). Then create phpdoc comments for both functions.  
	public function login($name, $password) {
	 
	}

	public function delete_user($uid) {
	
	}
		
	// TODO: implement the add_user function. A new unconfirmed user (userTypeID=0) is created with the given parameters. Set the accountCreationDate to the current date. Document the function using phpdoc.   
	public function add_user($name, $password, $email) {
	// check for existing user
	// return true if successful
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
	
}
