<?php
/**
 * the vote model
 *
 * Provides checking and adding votes functionality for questions and answers.
 *
 * It uses the following database tables:
 *
 * * _QuestionVote_
 * * _AnswerVote_
 * * _Answer_
 * * _Answer_
 *
 * @package models
 */


class Vote_model extends CI_Model {

	/**
	 * upvote or downvote a question
	 * 
	 * Record the user who vote along with the questionID for which he/she voted.
	 *
	 * @param int $userid the userID
	 * @param int $qid the questionID
	 * @param int $vote the type of vote
	 */

	public function add_q_vote($userid, $qid, $vote) {
		
		$query = "UPDATE `Question` SET `rank` = `rank` {$vote} 1 WHERE `QuestionID` = {$qid} ";
		mysql_query($query);
		
		$this->db->set('userID', $userid);
		$this->db->set('questionID', $qid);
		$this->db->insert('QuestionVote');
		
		redirect($this -> session -> userdata('last_visited'));
		
	}
	
	
	/**
	 * upvote or downvote an answer
	 *
	 * Record the user who vote along with the answerID for which he/she voted.
	 *
	 * @param int $userid the userID
	 * @param int $aid the answerID
	 * @param int $vote the type of vote
	 */
	
	public function add_a_vote($userid,$aid, $vote) {
	
		$sql = "UPDATE `Answer` SET `rank` = `rank` {$vote} 1 WHERE `answerID` = {$aid} ";
		mysql_query($sql);
		
		$this->db->set('userID', $userid);
		$this->db->set('answerID', $aid);
		$this->db->insert('AnswerVote');
	
		redirect($this -> session -> userdata('last_visited'));
	}
	
	
	/**
	 * Check a user voted or did not.
	 *
	 * Search a user voted or did not for a specific question.
	 *
	 * @param int $userid the userID who want to vote.
	 * @param int $qid the questionID 
	 * @return object a single question object, containing column values as attributes.
	 */
	
	public function check_q_vote($userid, $qid) {
	
		$array = array('userID' => $userid, 'questionID' => $qid);
		
		$query = $this->db->from('QuestionVote')-> where($array)->get();
		
		return $query->first_row();
	
	}
	
	/**
	 * Check a user voted or did not.
	 *
	 * Search a user voted or did not for an specific answer.
	 *
	 * @param int $userid the userID who want to vote.
	 * @param int $aid the answerID
	 * @return object a single question object, containing column values as attributes.
	 */
	
	public function check_a_vote($userid, $aid) {
	
		$array = array('userID' => $userid, 'answerID' => $aid);
	
		$query = $this->db->from('AnswerVote')-> where($array)->get();
	
		return $query->first_row();
	
	}

}