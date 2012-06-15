<?php

/**
 * the comment model
 *
 * Allows to retrieve and post comments for questions and answers.
 *
 * It uses the following database tables:
 *
 * * _Comment_
 * * _User_ (read only)
 *
 * @package models
 */

class Comment_model extends CI_Model {

	/**
	 * retrieve comments for a question
	 *
	 * Returns all comments for a question, providing the _userName_ of the commenter and the _body_ of the comment.
	 *
	 *
	 * @param int $qid the questionID
	 * @return array holds comment objects with userName and body properties
	 */

	public function get_qcomments($qid) {
		$this -> db -> select('User.userName,Comment.body');
		$this -> db -> join('User', 'User.UserID=Comment.UserID');
		$query = $this -> db -> get_where('Comment', array('questionID' => $qid));
		return $query -> result();
	}

	// TODO: implement function
	public function get_acomments($aid) {

	}

	// TODO: implement function
	public function create_qcomment($qid, $uid, $body) {

	}

	// TODO: implement function
	public function create_acomment($aid, $uid, $body) {

	}

	// TODO: implement function
	public function update_comment($cid, $uid, $body) {

	}

	// TODO: implement function
	public function delete_comment($cid, $uid) {

	}

	// TODO: implement function
	public function get_all_comments($uid) {
		// return all comments from all answers and questions from a user
	}

}
