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

	/**
	 * adds a question or answer comment to the Comment table of database
	 *
	 * Generates an insert string based on the data you supply, and runs the query. You will pass an array to the function.	
	 * Returns commentID for inserted question or answer comment.
	 *
	 *
	 * @param int $cid the commentID
	 * 
	 */

	// TODO: Implement create_qcomment and create_acomment so that it adds a question or answer comment to the database and returns the 	new comment's commentID. Then create its documentation, using phpdoc comments. See get_acomments for an example.
	public function create_qcomment($qid, $uid, $body) {
		
		$data = array('questionID' => $qid, 'userID' => $uid, 'body' => $body);
		$this->db->insert('Comment',$data);
		return $this -> db -> insert_id();
  
	}

	public function create_acomment($aid, $uid, $body) {
		
		$data = array('answerID' => $aid, 'userID' => $uid, 'body' => $body);
		$this->db->insert('Comment',$data);
		return $this -> db -> insert_id();
	}

    // TODO: Implement update_comment so that it updates the body of the comment specified by $cid. Then implement delete_comment so that it 	deletes the comment specified by $cid. Create documentation for both functions, using phpdoc comments. See get_acomments for an example.
	public function update_comment($cid, $body) {
		
		$this->db->where('commentID', $cid);
		$this->db->update('Comment', array('body' => $body)); 

	}
    
	public function delete_comment($cid) {
		$this->db->delete('Comment', array('commentID' => $cid)); 

	}

}
