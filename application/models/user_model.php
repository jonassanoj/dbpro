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

//TODO: integrate functions for usage of category and field here
//TODO: adapt docu of every function according coding conventions

class User_model extends CI_Model {


	// TODO: implement function  
	public function login($name, $password) {
	// return uid if sucessfull else 0
	}
	
	// TODO: implement function
	public function add_user($name, $password, $email) {
	// check for existing user
	// return true if successfull
	}
	
	// TODO: implement function  
	public function delete_user($uid) {
	//  return true if successfull
	}
	
	// TODO: implement function
	public function update_user($uid, $user_data) {
	//  return true if successfull
	}
	
	// TODO: adapt function docu to guidelines 
	// this method returns all user data in the user table which is related to the $userid
	public function get_userdata($uid) {
		$this -> db -> where("userID", $uid);
		$query = $this -> db -> get("User");
		return $query -> result_array();
	}

	// TODO: implement function  
	public function get_user($uids=array(), $limit, $offset) {
	// return all users if $uids is empty, else respective user(s)
	// concern limit for data and offset for pagination   
	}
	
	
	// this function will return all userTypes
	public function get_user_types() {
	 	$query = $this->db->get('UserType');    
	    return $query->result();
	}
	
	// TODO: implement function
	public function change_user_type($uid, $uidType) {
	// function for admins only
	// return true if successfull
	}
	
	
}
