<?php
/**
 * the question model
 *
 * Provides CRUD functionality for questions.
 *
 * It uses the following database tables:
 *
 * * _Question_
 * * _Anwer_ (read only)
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
	 * * user: show only questions posted by a certain user
	 * * category: show only questions in a specific category id
	 * * search: a search term as a string. Words separated by a whitespace are ANDed.
	 * 
	 * **Usage Example**:
	 * get the first 10 questions matching the terms _php_ and _apache_ :
	 * > getlist(0, 10, array('search'=>'php apache'))
	 * get the questions 6-10 with _catId_ 4 
	 * > getlist(5, 10, array('category'=>4))
	 * 
	 * @param int $offset the pagination offset
	 * @param int $limit the amount of questions to retrieve
	 * @param array $filter the optional filter to be applied to the results 
	 * @return array holds question objects with a questionID and its title
	 * 
	 */

	public function getlist($offset, $limit, $filter = array()) {
		$this -> db -> select('questionID,title');
		$this -> db -> where($this->filter($filter));
		$query = $this -> db -> get('Question', $limit, $offset);
		return $query -> result();
	}

	/**
	 * count the questions matching a certain filter.
	 * 
	 * the total amount of questions matching the filter criteria. see getlist documentation for details.
	 *
	 * @param array $filter the optional filter, see the getlist documentation 
	 * @return int the amount of questions matching $filter
	 */


	public function getcount($filter = array()) {
		$this -> db -> from('Question');
		return $this -> db -> count_all_results();
	}

	public function getdetails($qid) {
		$query = $this -> db -> get_where('Question', array('questionID' => $qid));
		return $query -> first_row();
	}
	
	/**
	 * create a filter for the where-clause
	 *
	 * A private function used by _getcount_ and _getlist_. It takes the $filter$ array (as described in the _getlist_ documentation) 
	 * and returns an array that can be passed to the db->where() active record function. 
	 * 
	 * @param array $filter the filter, see the getlist documentation 
	 * @return array a list of key->value conditions applied to the query
	 */

	private function filter($filter) {
		// TODO: implement the filter function so that it works as documented.	
		return array();
	}

}