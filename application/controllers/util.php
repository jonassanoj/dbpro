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
	
	

	public function vote(){
		$userID = 1;//$this->session->userdata('userID');
		$qID = $this->input->post('qid');
		
		$result = $this-> vote_model -> check_user_vote($userID, $qID);
		
		if(empty($result)){
			$this -> vote_model -> insert_vote();
		}
		else 
			redirect('main/qshow/' .$qID);
		
	}

}
