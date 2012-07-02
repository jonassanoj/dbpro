<?php
/**
 * Utility controller
 *
 * a controller containing utility functions. It uses no views but sends the user back to the last URI saved in the session.
 * e.g. used for changing the language globally.
 *
 * @package controllers
 */

class Util extends CI_Controller {
	
	
	/**
	 * constructor
	 *
	 * loads vote_model.
	 *
	 */
	
	public function __construct() {
		parent::__construct();
		$this -> load -> model('vote_model');
	
	}
	
	/** 
	 * Load a language
	 * 
	 * Changing the language my setting the session variable language. 
	 * 
	 * @param string $language the language to load, named like the folder containing the language files
	 */
	public function lang($language) {
		$this -> session -> set_userdata('language',$language);
		redirect($this -> session -> userdata('last_visited'));
	}

	
	/**
	 * Add vote for a question
	 *
	 * Check user to find out  did he/she voted for a specific question, if not add his/her vote.
	 * 
	 * @param int $qid the questionID that user want to vote.
	 */
	
	public function q_vote($qid){
		
		$userid = 2;//$this->session->userdata('uid');
		if($this->input->post('up')){
			$term = $this->input->post('up');
		}
		else
			$term = $this->input->post('down');
		
		$vote = ($term === 'up') ? '+' : '-';
		$result = $this-> vote_model -> check_q_vote($userid, $qid);
		
		if(empty($result)){
			$this -> vote_model -> add_q_vote($userid, $qid, $vote);
		}
		else 
			redirect($this -> session -> userdata('last_visited'));
	}
	
	/**
	 * Add vote for an answer
	 *
	 * Check user to find out did he/she voted for an specific answer, if not add his/her vote.
	 * 
	 * @param int $aid the answerID that user want to vote.
	 */
	
	public function a_vote($aid){
		
		$userid = 2;//$this->session->userdata('uid');
		if($this->input->post('aup')){
			$term = $this->input->post('aup');
		}
		else{
			$term = $this->input->post('adown');
		}
		
		$vote = ($term === 'up') ? '+' : '-';
		$result = $this-> vote_model -> check_a_vote($userid, $aid);
	
		if(empty($result)){
			$this -> vote_model -> add_a_vote($userid, $aid, $vote);
		}
		else
			redirect($this -> session -> userdata('last_visited'));
	}

}
