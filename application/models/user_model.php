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
			$this -> db -> set('userTypeID', self::TYPE_UNCONFIRMED);
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
		$this -> db -> query($this->db->update_string('User', $user_data, "userID = $uid"));
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
	 * @param int $uid the user's ID'
	 * @return int user type ID
	 */
	public function get_usertype($uid) {
		$this-> db -> select('userTypeID');
		$this-> db -> get_where('User',array('userID'=>$uid));
		if ($query -> num_rows() > 0) {
			return $query->first_row()->userTypeID;
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
	
	const DEACTIVATE = 0;
	const ANONYMIZE = 1;
	const CASCADE = 2; 
	
	public function delete($uid, $deletion_type=self::DEACTIVATE){
		
		if ($deletion_type==self::ANONYMIZE) {
			//delete and make anonymous
		}
		elseif ($deletion_type==self::CASCADE) {
			//delete and cascade! 
		}
		// DELETION TYPE = 0 
		else {
			//deactivate
		}
	}
	

	/**
	 * get all users from user table 
	 * 
	 * this function will return all users from user table 
	 * 
	 * @author Ashuqullah Alziai
	 * @param int $limit
	 * @param int $offse
	 * @return array of users 
	 */
	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('userID','asc');
		return $this->db->get('User', $limit, $offset);
	}
	/**
	 * Count users
	 * 
	 * This function is used to count all existing users in the database.
	 * 
	 * @author Ashuqullah Alizai
	 * @return array of users
	 * 
	 */
	function count_all(){
		return $this->db->count_all('User');
	}
	/**
	 * List users
	 * 
	 * This function is used to list all users ordered by userID.
	 * 
	 * @author Ashuqullah Alizai & Ghezal Ahmad
	 * @return array of users.
	 */
	function list_all(){
		$this->db->order_by('userID','asc');
		return $this->db->get('User');
	}
	/**
	 * get users
	 * 
	 * This function is used to get users by userID
	 * 
	 * @author alizai
	 * @param  int $id get user by id.
	 * @return array of users
	 */
		
	function get_by_id($id){
		$this->db->where('userID', $id);
		return $this->db->get('User');
	}
	/**
	 * Add person
	 * 
	 * This function use to add persons to User table.
	 * 
	 * @author Ghezal Ahmad
	 * @param  String $person the name to save in the database.
	 * @return int $id the inserted id.
	 */
	function save($person){
		$this->db->insert('User', $person);
		return $this->db->insert_id();
	}
	
	/**
	 * Get field name
	 * 
	 * This function used to show the field name.
	 * 
	 * @author alizai
	 * @param  int $fid the field id.
	 * @return String $fieldName field name
	 */
	
	function get_feild($fid){
		$this->db->select('fieldName');
		$this->db->where('fieldID', $fid);
		$query = $this->db->get('Field');
		return $query -> result();
	}
	
	/**
	 * Get user type
	 * 
	 * show the user type from user type table [Admin | Normal | Editor |Unconfirmed Users] for givin userTypeID .
	 * 
	 * @author Ashuquallah alizai & Ghezal Ahmad
	 * @param int $tid user type id.
	 * @return String $UserType user type
	 */
	function get_type($tid){
		$this->db->select('userType');
		$this -> db -> where('userTypeID' , $tid);
		$query = $this->db->get('UserType');
		return $query -> result();
	}
	
	/**
	 * funcrtion is to upgrade user type 
	 * 
	 * this function is to upgrade use type, the function will use by admin for upgrading user privileges 
	 * 
	 * @author ashuqullah Alizai
	 * @param int_type $uid is user ID frome user table 
	 * @param int_type $tid id userTpeID from UserTupe table 
	 */
	function upgrade_user($uid,$tid){
		
		$this -> db -> set('userTypeID', $tid);
		$this -> db -> where('userID' , $uid);
		$this -> db -> update('User');
	}

}
