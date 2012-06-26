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
	 * @param int $userID the userID
	 * @param int $questionID the questionID
	 * 
	 */

	public function add_q_vote($userID,$questionID) {
		
		if($this->input->post('up')){
			$term = $this->input->post('up');
		}
		else 
			$term = $this->input->post('down');
		
		
		$questionID = $this->input->post('qid');
		
		$questionID = (int)$questionID;
		
		$vote = ($term === 'up') ? '+' : '-';
		
		$query = "UPDATE `Question` SET `rank` = `rank` {$vote} 1 WHERE `QuestionID` = {$questionID} ";
		$query1 = "INSERT INTO `QuestionVote` (userID,questionID) VALUES ($userID,$questionID)";
		mysql_query($query);
		mysql_query($query1);
		
		redirect('main/qshow/' .$questionID);
	}
	
	/**
	 * upvote or downvote an answer
	 *
	 * Record the user who vote along with the answerID for which he/she voted.
	 *
	 * @param int $userID the userID
	 * @param int $answerID the answerID
	 *
	 */
	
	public function add_a_vote($userID,$answerID) {
	
		if($this->input->post('aup')){
			$term = $this->input->post('aup');
			
		}
		else{
			$term = $this->input->post('adown');
			
		}
	
		$questionID = $this->input->post('aqid');
		$answerID = (int)$answerID;
		
		$vote = ($term === 'up') ? '+' : '-';
	
		$sql = "UPDATE `Answer` SET `rank` = `rank` {$vote} 1 WHERE `answerID` = {$answerID} ";
		$sql1 = "INSERT INTO `AnswerVote` (userID,answerID) VALUES ($userID, $answerID)";
		mysql_query($sql);
		mysql_query($sql1);
	
		redirect('main/qshow/' .$questionID);
	}
	
	
	/**
	 * Check a user voted or did not.
	 *
	 * Search a user voted or did not for a specific question.
	 *
	 * @param int $userID the userID who want to vote.
	 * @param int $quesionID the questionID 
	 * @return object a single question object, containing column values as attributes.
	 */
	
	public function check_q_vote($userID,$questionID) {
	
		$array = array('userID' => $userID, 'questionID' => $questionID);
		
		$query = $this->db->from('QuestionVote')-> where($array)->get();
		
		return $query->first_row();
	
	}
	
	/**
	 * Check a user voted or did not.
	 *
	 * Search a user voted or did not for an specific answer.
	 *
	 * @param int $userID the userID who want to vote.
	 * @param int $answerID the answerID
	 * @return object a single question object, containing column values as attributes.
	 */
	
	public function check_a_vote($userID, $answerID) {
	
		$array = array('userID' => $userID, 'answerID' => $answerID);
	
		$query = $this->db->from('AnswerVote')-> where($array)->get();
	
		return $query->first_row();
	
	}

}