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
	 * The _$password_ is compared if it is eqaul to that userName's password.
	 *
	 * @author Huma Yari
	 * @param string $name The username
	 * @param string $password The password
	 * @return int the userID if exits or 0
	 */

	public function login($name, $password) {
		$this -> db -> where('userName', $name);
		$this -> db -> where('password', $password);
		$this -> db -> select('userID');
		$query = $this -> db -> get('User');
		if ($query -> num_rows() > 0) {
			return $query[0]['userID'];
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
	 *@author Huma Yari
	 *@param int The userID
	 *@return void
	 */

	public function delete_user($uid) {
		return $this -> db -> delete('User', array('userID' => $uid));
	}

	// TODO: implement the add_user function. A new unconfirmed user (userTypeID=0) is created with the given parameters. Set the accountCreationDate to the current date. Document the function using phpdoc.
	/**
	 ** adding new user in the User table with initial data *(username,password and email address)
	 * @author ASHUQULLAH ALIZAI
	 * @param string $name is the username for the user
	 * @param string $password is password specify by user
	 * @param string $email is email specify by user
	 * @return boolean true if success
	 */
	public function add_user($name, $password, $email) {
		// check for existing user
		$check_user = $this -> check_userName($name);
		if (!$check_user) {
			return false;
		} else {
			$date = date('Y/m/d H:i:s');
			$this -> db -> set('userName', $name);
			$this -> db -> set('password', $password);
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
	 * @return boolean false if username exist in the database, retruns true if the username not exist
	 */

	public function check_userName($username) {
		$query = $this -> db -> get_where('User', array('userName =' => $username)) -> result();
		if ($query -> num_rows() > 0)
			return false;
		// if user exists
		else
			return true;
		// if not exists
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

	// TODO: This function should return the user object for the user with id $uid. Additionally to the data from the User table, it should contain the users category (userType) and field (fieldName). Create phpdoc for this function. Note: you will also need to update the class' phpdoc.'
	/**
	* retrieve all information about specific user and according to userID 
	 *
	 * Returns all user included usertype and userfield data such as User.userName, User.fullName, User.email, User.password, User.imagePath, Field.fieldName, UserType.userType, User.acountCreationDate, User.rank, User.lastLogin, User.Organization, User.location, User.dateOfBirth, User.degree, User.detail
	 * @author Hamidullah khanzai
	 * @param int $uid
	 * @return row  consist of follwoing order
	 * --------------------------------
	 * userName
	 * fullName 
	 * email 
	 * password
	 * imagePath 
	 * fieldName
	 * userType
	 * acountCreattionDate 
	 * rank
	 * lastLogin
	 * Organization
	 * location
	 * dateOfBirth
	 * degree
	 * detail
	 * can be accessed row['userName'] and so one 
	 */
	public function get_userdata($uid) {

		$query=$this->db->query('SELECT User.userName, User.fullName, User.email, User.password, User.imagePath,Field.fieldName, UserType.userType, User.acountCreationDate, User.rank, User.lastLogin, User.Organization, User.location, User.dateOfBirth, User.degree, User.detail,FROM User, Field, UserType WHERE User.userTypeID = UserType.userTypeID AND User.fieldID = Field.fieldID and User.userID ='.$uid);
		return $query->row(0);
	

	}

	/**
	 * @author GhezalAhmad Zia
	 * @param  The function change_usertype has two parameter which is $uid and $utid, this function
	 * change the user 's type. like we have normal user we can change it to Admin.
	 * @return true.
	 */

	// TODO: implement change_usertype() so it changes the user specified by $uid to category number $utid. Document this function and get_usertypes using phpdoc.
	public function change_usertype($uid, $utid) {
		// return true if successful
		$this -> db -> set('$userTypeID', $utid);
		$this -> db -> where('$userID', $uid);
		$this -> db -> update('User');
		return true;

	}

	/**
	 * return user types
	 *
	 * This function is used to return all types of users.the function takes no parameter.
	 *
	 * @author saminullah sameem
	 * @return object user types
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
	 * @return array user data
	 */
	public function get_usertype($uid) {
		$query = $this -> db -> query('SELECT UserType.userType FROM User, UserType WHERE User.userTypeID = userType.userTypeID AND userID =' . $uid);

		return $query -> result();
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
