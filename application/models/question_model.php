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
	 * * category: show only questions in a specific category
	 * * search: a search term as a string. Words separated by a whitespace are ANDed.
	 * 
	 * **Usage Example**:
	 * * get the first 10 questions matching the terms _php_ and _apache_
	 * > getlist(0, 10, array('search'=>'php apache'))
	 * 
	 * @param int $offset the pagination offset
	 * @param int $limit the amount of questions to retrieve
	 * @param array $filter the optional filter to be applied to the results 
	 * @return array holds question objects with a questionID and its title
	 */

	public function getlist($offset, $limit, $filter = array()) {
        // TODO: implement Filter		
		$this -> db -> select('questionID,title');
		$query = $this -> db -> get('Question', $limit, $offset);
		return $query -> result();
	}

	/**
	 * count the questions matching a certain filter.
	 *
	 * Returns all comments for a question, providing the _userName_ of the commenter and the _body_ of the comment.
	 *
	 * 
	 * The array _$filter_ can be used to filter the result according to certain criteria. The array may contain the following keys:
	 *
	 * * user: show only questions posted by a certain user
	 * * category: show only questions in a specific category
	 * * search: a search term as a string. Words separated by a whitespace are ANDed.
	 * 
	 * **Usage Example**:
	 * * get the first 10 questions matching the terms _php_ and _apache_
	 * > getlist(0, 10, array('search'=>'php apache'))
	 * 
	 * @param array $filter the optional filter, see the {@link getlist()} documentation 
	 * @return int the amount of questions matching $filter
	 */


	public function getcount($filter = array()) {
		// TODO: implement Filter
		$this -> db -> from('Question');
		return $this -> db -> count_all_results();
	}

	public function getdetails($qid) {
		$query = $this -> db -> get_where('Question', array('questionID' => $qid));
		return $query -> first_row();
	}

}
