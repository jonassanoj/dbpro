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
 *@package models
 */

class User_model extends CI_Model {

	const TYPE_NORMAL = 1;
	const TYPE_EDITOR = 2;
	const TYPE_ADMIN = 3;
	const TYPE_UNCONFIRMED = 8;
	const TYPE_DEACTIVATED = 9;

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
		$array = array('userName' => $name, 'password' => $password, 
						  	'userTypeID !=' => self::TYPE_DEACTIVATED);
		$this->db->where($array);
		//$this -> db -> where('userName', $name);
		//$this -> db -> where('password', $password);
		//$this -> db -> where('userTypeID!=', self::TYPE_DEACTIVATED);
		$this -> db -> select('userID');
		$query = $this -> db -> get('User');
		if ($query -> num_rows() > 0) {
			return $query -> first_row() -> userID;
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
			return $query -> first_row() -> userID;
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
		$this -> db -> query($this -> db -> update_string('User', $user_data, "userID = $uid"));
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
		$this -> db -> join('UserType', 'User.userTypeID = UserType.userTypeID');
		$this -> db -> join('Field', 'User.fieldID = Field.fieldID', 'left');
		$this -> db -> where('userID', $uid);
		$query = $this -> db -> get('User');
		if ($query -> num_rows() > 0) {
			return $query -> first_row();
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
		$this -> db -> set('userTypeID', $utid);
		$this -> db -> where('userID', $uid);
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
	 * @param int $uid the user's ID'
	 * @return int user type ID
	 */
	public function get_usertype($uid) {
		$this -> db -> select('userTypeID');
		$this -> db -> get_where('User', array('userID' => $uid));
		if ($query -> num_rows() > 0) {
			return $query -> first_row() -> userTypeID;
		} else
			return false;
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

	/**
	 * Delete a user in 3 case
	 *
	 * first of all we consider that we can have 3 possiblity to delete user and always by if condition we will check in which scenario we decided to delete
	 * for this we declear 3 static constant variable ( DEACTIVATE=0, ANONYMIZE=1, CASCADE=2 )
	 *
	 * first case: if ($deletion_type==self::ANONYMIZE) ==>> if $deletion_type is equal ANONYMIZE it means we passed 1 to function,
	 * we will assign userID = 999 and change other filds for this uid(userID) in User table....
	 *
	 * second case: elseif ($deletion_type==self::CASCADE) ==>> if $deletion_type is equal CASCADE it means we passed 2 to function,
	 * then we will delete all relevent question, answer, comment, vote from different tables for this uid(userID)
	 *
	 * third case: ($deletion_type=self::DEACTIVATE) by defult $deletion_type is equal DEACTIVATE it means we passed 0 to function,
	 * then in this case we will call change_usertype($uid, self::TYPE_DEACTIVATED) function and change userTypeID to TYPE_DEACTIVATED
	 * it means code number 9 in User table.
	 *
	 * self::
	 * in php we use $this to refer to the current object. and we use self to refer to the current class.
	 * In other words, use $this->member for non-static members, use self::$member for static members.
	 *
	 * @param int $uid the userID
	 * @param const $deletion_type the DEACTIVATE, ANONYMIZE, CASCADE
	 * @return int the number of affected rows otherwise 0
	 */

	const DEACTIVATE = 0;
	const ANONYMIZE = 1;
	const CASCADE = 2;
	const ANONYMOUS_ID = 9999;

	public function delete($uid, $deletion_type = self::DEACTIVATE) {

		//delete and make anonymous
		if ($deletion_type == self::ANONYMIZE) {
			//$tables = array('Comment', 'Answer', 'Question');
			
			$data = array('userID' => self::ANONYMOUS_ID);
			$where = array('userID' => $uid);
			
			$this -> db -> update('Comment',$data,$where);
			$this -> db -> update('Answer',$data,$where);
			$this -> db -> update('Question',$data,$where);
			$this -> db -> delete('User',$where);
			
			return $this -> db -> affected_rows();
		}
		//delete and cascade!
		elseif ($deletion_type == self::CASCADE) {
			$tables = array('AnswerVote', 'QuestionVote', 'Comment', 'Answer', 'Question', 'User');
			$this -> db -> where('userID', $uid);
			$this -> db -> delete($tables);
			return $this -> db -> affected_rows();
		}
		//deactivate, DELETION TYPE = 0
		else {
			
			return $this -> change_usertype($uid, self::TYPE_DEACTIVATED);
			
		}
	}

}
