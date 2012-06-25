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
		
		redirect('main/qshow/' .$questionID, 'refresh');
		
		
	
	}

}
