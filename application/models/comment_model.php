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

	/**
	 * retrieve comments for an answer
	 *
	 * Returns all comments for an answer, providing the _userName_ of the commenter and the _body_ of the comment.
	 *
	 *
	 * @param int $aid the answerID
	 * @return array holds comment objects with userName and body properties
	 */

	public function get_acomments($aid) {
		$this -> db -> select('User.userName,Comment.body');
		$this -> db -> join('User', 'User.UserID=Comment.UserID');
		$query = $this -> db -> get_where('Comment', array('answerID' => $aid));
		return $query -> result();
	}

	// TODO: Implement create_qcomment and create_acomment so that it adds a question or answer comment to the database and returns the new comment's commentID. Then create its documentation, using phpdoc comments. See get_acomments for an example.
	public function create_qcomment($qid, $uid, $body) {

	}

	public function create_acomment($aid, $uid, $body) {

	}

    // TODO: Implement update_comment so that it updates the body of the comment specified by $cid. Then implement delete_comment so that it deletes the comment specified by $cid. Create documentation for both functions, using phpdoc comments. See get_acomments for an example.

	
	/**
	 * Update Comments by id 
	 *
	 *this function will update the comment body.
	 *
	 * @param int $cid the commentID
	 * @param string $body the body 
	 */
	public function update_comment($cid, $body) {
	
	// Update comment set body = '$body' where commentId = $cid
		//$query = $this -> db -> update_string("Comment", array('body' => $body), array('commentID'=>$cid));	
		$data = array('body' => $body);
		$this -> db -> where('commentID', $cid);
		$this -> db -> update('Comment', $data);
	}
    

	/**
	 * Delete Comments by id 
	 *
	 *this function will delete the comment.
	 *
	 * @param int $cid the commentID
	 
	 */

	public function delete_comment($cid) {
		
		return $this -> db -> delete('Comment', array('commentID'=>$cid));
	}

}
