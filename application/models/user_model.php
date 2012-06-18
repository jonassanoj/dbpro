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

/**
 * Checks if the username exists
 *
 * The _$name_ is compared to the _userName_ field of the User table.
 * Then the _$password_ is compared if it is eqaul to that userName's password. 
 * If the user exits and password is valid then it will return the userID of that user.
 * Else it will return 0 .
 *
 * @param string $name The username
 *
 */

	public function login($name, $password) {
		$this->db->where('userName',$name);
		$this->db->where('password',$password);
		$this->db->select('userID');
		$query = $this->db->get('User');
		if($query->num_rows() > 0){
		return $query[0]['userID'];
		}
		else return 0;
	}

/**
 * Deletes a user
 *
 * The given userID which is sent as the parameter is compared to the _userID_ of the User table.
 * The user will be deleted if that userID is found. 
 */

	public function delete_user($uid) {
	return $this -> db -> delete('User', array('userID'=>$uid));
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
	
	//TODO: implement and document get_usertype() and get_field(). Both return a single integer indicating the usertypeID or fieldID of the user.
	public function get_usertype($uid) {
	  return 0;
	}
	
	public function get_field($uid){
	  return 0;
	}
	
}
