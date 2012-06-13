<?php
class Answer_model extends CI_Model {
	    
	 
	function __construct(){
          parent::__construct();
	  $this->load->database();
    	}
 	
	// This method will insert an answer to specified quesitonID 
	function give_answer($questionID,$bodyText){
	    	$this->db->set('questionID', $questionID);
	    	$this->db->set('body', $bodyText);
	    	$this->db->insert('Answer');
	    	return $this->db->insert_id();
	}

	// This method will returns answers to the specified quesitonID
	//@param $questionID
	public function get_answers($questionID){
		$this->db->select('body');
		$this->db->where('questionID', $questionID); 
		$query = $this->db->get('Answer');
		return $query->result();
	}
	
	//This method will return the rank of specified answerID
	//@param $answerID
	public function get_rank($answerID){
		$this->db->select('rank');
		$this->db->where('answerID',$answerID);
		$query=$this->db->get('Answer');
		return $query->resutl();
	}
	
	// This method will add one to the current rank of the specified answerID
	//@param$answerID
	public function add_rank($answerID){
		$currentRank=get_rank($answerID);
	        $this->db->where('answerID', $answerID);
	        $this->db->set('rank', $currentRank+1);
	        $this->db->update('Answer');					
	}


	// update_answer method alters a record in the users table.
	// @param array $body is new body for answer with $answerID
		
	function update_answer($body,$answerID){
		 $this->db->where('answerID', $answerID);
		 $this->db->set('body', $body);
		 $this->db->update('Answer');
	}

	// delete_answer method removes a record from the answer table
	//@param $answerID
	function delete_answer($answerID){	    
		 $this->db->where('answerID', $answerID);
		 $this->db->delete('Answer');

	}

		

}// end of class 
