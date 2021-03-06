<?php
/**
 * the answer model
 *
 * Provides CRUD functionality for answers.
 *
 * It uses the following database tables:
 *
 * * _Answer_
 *
 * @package models
 */

class Answer_model extends CI_Model {

	/**
	 * return the answers for a question
	 * 
	 * the total amount of questions matching the filter criteria. see get_list documentation for details.
	 *
	 * @param int $qid the id of the question we want answers for   
	 * @return array holds answer objects with fileds for all database columns
	 */

	public function get_answers($qid) {
		$query = $this -> db -> get_where('Answer', array('questionID' => $qid));
		return $query -> result();
	}
	
	/**
	 * The function to get answe
	 * 
	 * geting answer by answer id
	 * 
	 * @param int $aid the id of the answer
	 * @return array|boolean return row with fields or false if now row
	 * 
	 * @author Wazir khan, Samin 
	 */
	public function get_answer($aid) {
		$this -> db -> where('answerID', $aid);
		$result_set = $this -> db -> get('Answer');
		if($result_set ->num_rows() > 0)
			return $result_set -> first_row();
		return false;
	}
	/**
	* Adding new answer to a question
	*
	* This function is for adding a new answer to a question by a registered user.
	*
	* @param int $qid the question id
	* @param int $uid the user id who want to answer
	* @param string $body the answer text
	* @return boolean true if inserted otherwise false
	*/
	public function add_answer($qid, $uid, $body) {
		
		$data = array('questionID' => $qid,
						  'userID' => $uid,
						  'body' => $body, 
						  'date' => date('Y-m-d h:i:s'));
						  
		$this -> db -> insert('Answer', $data);
		$flag = $this -> db -> insert_id();
		if(!$flag)
			return false;
		return true;
			
	}
	
	/**
	* updating answer 
	*
	* This function is for updating an existing answer by its owner (writer).
	*
	* @param int $aid the answer id (only we need answer id because its already primary key)
	* @param string $body the answer text
	* 
	* @return boolean true if inserted otherwise false
	* 
	* @author Wazir khan Ahmadzai,
	* @author Sameen ullah sameen
	*/
	public function update_answer($aid, $body) {
		
		$data = array('body' => $body, 'date' => date('Y-m-d h:i:s'));
		$this -> db -> where('answerID', $aid);
		return $this -> db -> update('Answer', $data);	
	}
	
	/**
	 * cascading Delete answer
	 *
	 * Delete an answer and all its associative comments to that aid in different tables.
	 * by passing an array of table names into delete() you will delete data from more than 1 table.
	 * at end return the number of affected rows.
	 *
	 * @param int $aid the answerID.
	 * 
	 * @return int number of affected rows if successful, 0 otherwise
	 * 
	 */
	public function delete_answer($aid){
		$tables = array('Comment', 'Answer');
		$this->db->where('answerID', $aid);
		$this->db->delete($tables);
		return $this -> db -> affected_rows();
	}
	
	/**
	* Helper function for checking user's answer
	*
	* This is a function to check weather a answer related to a user or not.
	*
	* @param int $aid the answer id (to check is the answer related to this user or not)
	* @param int $uid the user id, for an answer
	* @return array|bool if record found return first row otherwise false (0)
	* 
	* @author Wazir khan Ahmadzai,
	* @author Sameen ullah sameen
	* 
	*/
	
	public function is_user_answer($aid, $uid) {
		
		$this -> db -> where('answerID', $aid);
		$this -> db -> where('userID', $uid);
		$result_set = $this -> db -> get('Answer');
		if($result_set ->num_rows() > 0)
			return $result_set -> first_row();
		return false;
		
	}
	/**
	
	* @param int $aid the answerID
	* @return object a single answer object, containing column values as attributes.
	*/
	
	public function get_details($aid) {
		$query = $this -> db -> get_where('Answer', array('answerID' => $aid));
		return $query -> first_row();
	}
	
	/**
	 * check for login user if he/she voted for answer.
	 *
	 * the total amount of questions matching the filter criteria. see get_list documentation for details.
	 *
	 * @param int $aid the answerID
	 * @param int $userid the userID
	 * @return object a single question object, containing column values as attributes.
	 */
	
	public function check_vote($aid, $userid) {
		$this->db->where('answerID', $aid);
		$this->db->where('userID', $userid);
		$this->db->from('AnswerVote');
		$query = $this->db->get();
		return $query -> first_row();
	
	}
}
