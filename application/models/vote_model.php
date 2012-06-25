<?php
/**
 * the vote model
 *
 * Provides CRUD functionality for voting.
 *
 * It uses the following database tables:
 *
 * * _voteList_
 *
 * @package models
 */

class Vote_model extends CI_Model {

	/**
	 * upvote or downvote a question
	 * 
	 * 
	 *
	 * 
	 * 
	 */

	public function insert_vote() {
		
		if($this->input->post('up')){
			$term = $this->input->post('up');
		}
		else 
			$term = $this->input->post('down');
		
		
		$questionID = $this->input->post('qid');
		
		$questionID = (int)$questionID;
		
		$vote = ($term === 'up') ? '+' : '-';
		
		$sql = "UPDATE `Question` SET `rank` = `rank` {$vote} 1 WHERE `QuestionID` = {$questionID} ";
		
		mysql_query($sql);
		
		redirect('main/qshow/' .$questionID);
	}
	
	
	public function check_user_vote($userID,$questionID) {
	
		$array = array('userID' => $userID, 'questionID' => $questionID);
		
		$query = $this->db->from('VoteList')-> where($array)->get();
		
		return $query->first_row();
	
	}

}