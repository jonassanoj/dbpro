<?php
/**
 * the question model
 *
 * Provides CRUD functionality for questions.
 *
 * It uses the following database tables:
 *
 * * _Question_
 * * _Answer_ (read only)
 *
 *
 * @package models
 */

class Question_model extends CI_Model {

	/**
	 * retrieve a sorted and paginated question list
	 *
	 * Returns all comments for a question, providing the _userName_ of the commenter and the _body_ of the comment.
	 *
	 *
	 * The array _$filter_ can be used to filter the result according to certain criteria. The array may contain the following keys:
	 *
	 * * userID: show only questions posted by a certain user id
	 * * catID: show only questions in a specific category id
	 * * search: a search term as a string. Words separated by a whitespace are ANDed.
	 *
	 * **Usage Example**:
	 * get the first 10 questions matching the terms _php_ and _apache_ :
	 * > get_list(0, 10, array('search'=>'php apache'))
	 * get the questions 6-10 with _catId_ 4
	 * > get_list(5, 10, array('category'=>4))
	 *
	 * @param int $offset the pagination offset
	 * @param int $limit the amount of questions to retrieve
	 * @param array $filter the optional filter to be applied to the results
	 * @return array holds question objects with a questionID and its title
	 *
	 */

	public function get_list($offset, $limit, $filter = array()) {
		$this -> db -> select('questionID,title');
		$this -> filter($filter);
		$query = $this -> db -> get('Question', $limit, $offset);
		return $query -> result();
	}

	/**
	 * count the questions matching a certain filter.
	 *
	 * the total amount of questions matching the filter criteria. see get_list documentation for details.
	 *
	 * @param array $filter the optional filter, see the get_list documentation
	 * @return int the amount of questions matching $filter
	 */

	public function get_count($filter = array()) {
		$this -> db -> from('Question');
		$this -> filter($filter);
		return $this -> db -> count_all_results();
	}

	/**
	 * all the information about one question.
	 *
	 * the total amount of questions matching the filter criteria. see get_list documentation for details.
	 *
	 * @param int $qid the questionID
	 * @return object a single question object, containing column values as attributes.
	 */

	public function get_details($qid) {
		$query = $this -> db -> get_where('Question', array('questionID' => $qid));
		return $query -> first_row();
	}
	
	/**
	 * check for login user if he/she voted for question.
	 *
	 * the total amount of questions matching the filter criteria. see get_list documentation for details.
	 *
	 * @param int $qid the questionID
	 * @param int $userid the userID
	 * @return object a single question object, containing column values as attributes.
	 */
	
	public function check_vote($qid, $userid) {
		$this->db->where('questionID', $qid);
		$this->db->where('userID', $userid);
		$this->db->from('QuestionVote');
		$query = $this->db->get();
		return $query -> first_row();
		
	}

	/**
	 * create a new question, return its id
	 *
	 * @param string $title the question title
	 * @param int $uid the user who created the question
	 * @param int $cid the categoryID of the question
	 * @param string $body the question body
	 * @return int the id of the newly inserted question, 0 if failed
	 */

	public function create_question($title, $uid, $cid, $body) {
		$date = date('Y/m/d H:i:s');
		$this -> db -> set('title', $title);
		$this -> db -> set('userID', $uid);
		$this -> db -> set('catID', $cid);
		$this -> db -> set('body', $body);
		$this -> db -> set('date', $date);
		$this -> db -> insert('Question');
		return $this -> db -> insert_id();
	}

	/**
	 * Update a question
	 *
	 * Updates a question via an associative array. 
	 *
	 * @param int $qid the id of the question to update.
	 * @param array $question_data an associative array containing the columns to update. For valid keys see the question table schema.
	 * @return int 1 if successful, 0 otherwise
	 *
	 */
	public function update_question($qid, $question_data) {
		$this -> db -> query($this->db->update_string('Question', $question_data, "questionID = $qid"));
		return $this -> db -> affected_rows();
	}
	
	/**
	 * cascading Delete question
	 *
	 * Delete a question and all associative answers and comments to that qid in different tables.
	 * by passing an array of table names into delete() you will delete data from more than 1 table
	 * at end return the number of affected rows
	 * 
	 * @param int $qid the questionID.
	 * @return int number of affected rows if successful, 0 otherwise
	 */
	public function delete_question($qid){
	$tables = array('Comment', 'Answer', 'Question');
	$this->db->where('questionID', $qid);
	$this->db->delete($tables);
	return $this -> db -> affected_rows();
	}

	/**
	 * create a filter for the where-clause
	 *
	 * A private function used by *get_count* and *get_list*. It takes the $filter$ array (as described in the _getlist_ documentation)
	 * It executes active record functions to qualify the query.
	 *
	 * @param array $filter the filter, see the get_list documentation
	 * @return void no return value
	 */

	private function filter($filter) {
		foreach ($filter as $key => $value) {

			if (array_key_exists('userID', $filter)) {
				$this -> db -> where('userID', $filter['userID']);
			}
			if (array_key_exists('catID', $filter)) {
				$this -> db -> where('catID', $filter['catID']);
			}

			if (array_key_exists('search', $filter)) {
				$array = explode(' ', $value);
				foreach ($array as $key => $value)
					$this -> db -> like('title', $value);

			}
		}
	}

}
