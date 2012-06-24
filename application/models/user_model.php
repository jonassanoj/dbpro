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
	 * The _$name_ is compared to the _userName_ in User table.
	 *
	 * The _$password_ is compared if it is equal to that userName's password.
	 *
	 * @author Huma Yari
	 * @param string $name The username
	 * @param string $password The password as md5 hash
	 * @return int the userID if exits or 0
	 */

	public function login($name, $password) {
		$this -> db -> where('userName', $name);
		$this -> db -> where('password', $password);
		$this -> db -> select('userID');
		$query = $this -> db -> get('User');
		if ($query -> num_rows() > 0) {
			return $query->first_row()->userID;
		} else
			return 0;
	}

	/**
	 * Deletes a user
	 *
	 * The given userID is compared to the _userID_ of the User table.
	 *
	 * The user will be deleted if that userID is found.
	 *
	 * @author Huma Yari
	 * @param int $uid The userID
	 * @return int 0 if userID not found, 1 if delete successful
	 *
	 */

	public function delete_user($uid) {
		$this -> db -> delete('User', array('userID' => $uid));
		return $this -> db -> affected_rows();
	}

	/**
	 * adding new user in the User table with initial data (username,password and email address)
	 * 
	 * @author Ashuqullah Alizai
	 * @param string $name is the username for the user
	 * @param string $password is password specified by user
	 * @param string $email is email specify by user
	 * @return int the id of the newly inserted user, 0 if failed
	 */
	public function add_user($name, $password, $email) {
		// check for existing user
		if ($this -> get_userID($name)) {
			return false;
		} else {
			$date = date('Y/m/d H:i:s');
			$this -> db -> set('userName', $name);
			$this -> db -> set('password', $password);
			$this -> db -> set('email', $email);
			$this -> db -> set('userTypeID', 0);
			$this -> db -> set('accountCreationDate', $date);
			$this -> db -> insert('User');
			return $this -> db -> insert_id();
		}

	}

	/**
	 * Get the userID for a certain userName.
	 *
	 * @author Ashuqullah Alizai
	 * @param  string $username is this name already in the database
	 * @return int the userID if username exists, 0 otherwise
	 */

	public function get_userID($username) {
		$this -> db -> select('userID');
		$this -> db -> where('userName', $username);
		$query = $this -> db -> get('User');
		if ($query -> num_rows() > 0) {
			return $query->first_row()->userID;
		} else
			return false;
	}

	/**
	 * Update userdata
	 *
	 * Send the user ID and the data to function. The function will find the respective ID and change user data with the data which we sent.
	 * User data is an array. It updates the user information in table user where UserID=$uid and then returns the number of affected rows.
	 *
	 * The list of columns that can be updated:
	 *
	 * * usertypeID
	 * * fieldID
	 * * userName
	 * * fullName
	 * * email
	 * * password
	 * * imagePath
	 * * accountCreationDate
	 * * rank
	 * * lastLogin
	 * * organization
	 * * location
	 * * dateOfBirth
	 * * degree
	 * * detail
	 *
	 * To update columns we pass a map or associative array that associates values to keys. You can use from above list.
	 *
	 * **Example:**
	 * > $data = array('usertypeID' => 2, 'imagePath' => '$imagepath, 'location' => '$location'Kabul');
	 * > update_user(6, $data);
	 *
	 * @param int $uid the id of the user to update.
	 * @param array $user_data an associative array containing the columns to update
	 * @return int 1 if successful, 0 otherwise
	 *

	 */
	public function update_user($uid, $user_data) {
		$this -> db -> query(update_string('User', $user_data, "userID = $uid"));
		return $this -> db -> affected_rows();
	}

	/**
	 * retrieve all information about a user
	 *
	 * Returns a user object containing information about the user, including his field and userType as a string. 
	 *
	 * @param int $uid
	 * @return object|boolean a user object containing all the fields of the user, additionally fieldName and userType 
	 * are included as a string. If user is not found, returns false	 
	 */
	 
	public function get_userdata($uid) {
		$this->db->join('UserType', 'User.userTypeID = UserType.userTypeID');
		$this->db->join('Field', 'User.fieldID = Field.fieldID','left');
		$this->db->where('userID',$uid);
		$query = $this->db->get('User');
		if ($query -> num_rows() > 0) {
			return $query->first_row();
		} else
			return false;
	}

	/**
	 * Change the userType 
	 * 
	 * changes the user with a given userID to a new userTypeID 
	 *
	 * @author GhezalAhmad Zia
	 * @param int $uid the userID
	 * @param int $utid the userTypeID to set  
	 * @return int 0 if user is not found, 1 otherwise.
	 * 
	 */

	 public function change_usertype($uid, $utid) {
		$this -> db -> set('$userTypeID', $utid);
		$this -> db -> where('$userID', $uid);
		$this -> db -> update('User');
		return $this -> db -> affected_rows();

	}

	/**
	 * return user types
	 *
	 * This function is used to return all types of users.the function takes no parameter.
	 *
	 * @author saminullah sameem
	 * @return array userType objects with the attributes userTypeID and userType
	 */
	public function get_usertypes() {
		$query = $this -> db -> get('UserType');
		return $query -> result();
	}

	/**
	 *  returns specific user type.
	 *
	 * This Function takes user_id from the user table and returns a specific type of user e.g Administrator.We have four types of users
	 * named Administrator, Normal user,Editor and unconfirmed.
	 *
	 * @author saminullah sameem
	 * @param int $uid the user's ID'
	 * @return array user data
	 */
	public function get_usertype($uid) {
		//$query = $this -> db -> query('SELECT UserType.userType FROM User, UserType WHERE User.userTypeID = userType.userTypeID AND userID =' . $uid);
		//return $query -> result();
	}

	/**
	 *  returns user field.
	 *
	 * This function is used  to return user's field. this function takes user_id as argument and return a specific field of user. for example a user belong to
	 * software engineering, Data base management system etc.
	 *
	 * @author saminullah sameem
	 * @return object  user field
	 *
	 */

	public function get_field($uid) {
		$query = $this -> db -> query('SELECT Field.fieldName FROM User, Field WHERE User.fieldID = Field.fieldID AND userID =' . $uid);

		return $query -> result();
	}

}
