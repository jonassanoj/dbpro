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
		$this -> db -> select('User.userName,Comment.body, Comment.commentID, Comment.answerID, Comment.questionID, Comment.userID');
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
	 * adds a question comment to the Comment table of database
	 *
	 * You will pass questionID, userID and body to Comment table in database.
	 * after inserting successfully all parameter to the database, commentID will be return from database
	 *
	 *
	 * @param int $qid the questionID
	 * @param int $uid the userID
	 * @param string $body the body
	 * @return int the id of the newly inserted comment
	 */

	public function create_qcomment($qid, $uid, $body) {
		$data = array('questionID' => $qid, 'userID' => $uid, 'body' => $body);
		$this->db->insert('Comment',$data);
		return $this -> db -> insert_id();
	}

	/**
	 * get a comment by commentID
	 *
	 * Returns a comment object identified by the commentID. It has the attributes 
	 * questionID, answerID, userID and body.
	 *
	 * @param int $cid the commentID
	 * @return object|boolean false if the comment is not found, the comment object otherwise.
	 */
	public function get_comment($cid) {
		$this->db->where('commentID',$cid);
		$query = $this->db->get('Comment');
		if ($query -> num_rows() > 0) {
			return $query->first_row();
		} else
			return false;
	}
	
	
	/**
	 * adds a answer comment to the Comment table of database
	 *
	 * You will pass answerID, userID and body to Comment table in database.
	 * after inserting successfully all parameter to the database, commentID will be return from database
	 *
	 * 
	 * @param int $aid the answerID
	 * @param int $uid the userID
	 * @param string $body the body
	 * @return int the id of the newly inserted comment
	 */

	public function create_acomment($aid, $uid, $body) {
		$data = array('answerID' => $aid, 'userID' => $uid, 'body' => $body);
		$this->db->insert('Comment',$data);
		return $this -> db -> insert_id();
	}		

	/**
	 * Update Comments by id 
	 *
	 * this function will update the comment body.
	 *
	 * @param int $cid the commentID of the comment to change
	 * @param string $body the new body text of the comment
	 * @return int 0 if the comment was not found, 1 otherwise 
	 * 	 
	 */
	public function update_comment($cid, $body) {
		$data = array('body' => $body);
		$this -> db -> where('commentID', $cid);
		$this -> db -> update('Comment', $data);
		return $this -> db -> affected_rows(); 
	}

	/**
	 * Delete Comments by id 
	 *
	 * this function will delete the comment with the specified id.
	 *
	 * @param int $cid the commentID
	 * @return int 0 if the comment was not found, 1 otherwise
	 */

	public function delete_comment($cid) {
		$this -> db -> delete('Comment', array('commentID'=>$cid));
		return $this -> db -> affected_rows();
	}

}
