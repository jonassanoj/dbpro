<?php
/**
 * the main controller
 *
 * Handles the basic site functionality. Browsing questions and answers, etc.
 *
 *
 * @package models
 */

class Answer_model extends CI_Model {

	public function getanswers($qid) {
		$query = $this -> db -> get_where('Answer', array('questionID' => $qid));
		return $query -> result();
	}

}
