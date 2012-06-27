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
	 * cascading Delete answer
	 *
	 * Delete an answer and all its associative comments to that aid in different tables.
	 * by passing an array of table names into delete() you will delete data from more than 1 table.
	 * at end return the number of affected rows.
	 *
	 * @param int $aid the answerID.
	 * @return int number of affected rows if successful, 0 otherwise
	 */
	public function delete_answer($aid){
		$tables = array('Comment', 'Answer');
		$this->db->where('answerID', $aid);
		$this->db->delete($tables);
		return $this -> db -> affected_rows();
	}

}
