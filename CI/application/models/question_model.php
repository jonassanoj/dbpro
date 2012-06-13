<?php
class Question_model extends CI_Model {  

	function __construct() {
       	    parent::__construct();
   	 }
 	  
	// ask_question method creates a record in the Question table.
	function ask_question($data){      
	    	$this->db->insert('Questions',$data);
	    	return $this->db->insert_id();
	}


	//update_question method alters a record in the Question table.
	//@param array $body new body $questionID


	function update_question($body,$questionID){    
	        $this->db->where('questionID', $questionID);
		$this->db->set('body', $body);
		$this->db->update('Question');
	}
	//get_recent_question will return recent questions
	function get_recent_question($limit,$offset){	
		$this->db->select(' body');	
		$query = $this->db->get('Question',$limit, $offset);     
		return $query->result_array();  
         }
	//method search_question will return question near to search term 
	// @return array result() 
	//@parameter searchTerm
	
	function search_question($searchTerm){	
		$this->db->select(' body');
		$this->db->like('body', $searchTerm);
		$query = $this->db->get('Question');
		return $query->result_array();
	}

       // delete_question method removes a record from the Question table

	function delete_question($questionID){
		$this->db->where('questionID', $questionID);
		$this->db->delete('Question');
	}
	// thsi method is for user to remove it is own question 
	function delete_own_question($questionID,$userID){
		$this->db->select('questoinID,userID');
		$this->db->where('questionID',$questionID );
		$this->db->where('userID',$userID);
		$query->db->get('Question');
			if($query==null){
				return false;
			}
			else{
				delete_question($questionID);
			}


	//This method will return the rank of specified questionID
	//@param $questionID
	public function get_rank($questionID){
		$this->db->select('rank');
		$this->db->where('questionID',$questionID);
		$query=$this->db->get('Question');
		return $query->resutl();
	}
	
	// This method will add one to the current rank of the specified questionID
	//@param$questionID
	public function add_rank($questionID){
		$currentRank=get_rank($questionID);
	        $this->db->where('questionID', $questionID);
	        $this->db->set('rank', $currentRank+1);
	        $this->db->update('Question');
					
	}
	// this function will return the question relevent to user
	//@param $userID 
	function get_relevant_question($userID){
		$this->db->select(' body');
		$this->db->where('userID', $userID); 
		$query = $this->db->get('Question');
		return $query->result_array();
	}


}// end of file
