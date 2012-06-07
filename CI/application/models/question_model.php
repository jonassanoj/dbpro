<?php
class Question_model extends CI_Model {
	   
   
	 
	function __construct()   	 {
        	parent::__construct();
   	 }
 	

	 // This method will return the limited quetion start from the offset order by questionID
	 function get_question_list($limit,$offset){
		 $this->db->order_by('questionID','asc');
		 $query=$this->db->get($this->'Question', $limit, $offset);
		return $query->result();
  	}


	// This method return limited number of quesiton belonging to specific user started from offset order by Question rank
	 function get_question_list_userID($limit,$offset,$userID){
		$this->db->order_by('postedDate','desc');
		$this->db->where('userID',$userID);
		 $query=$this->db->get($this->'Question',$limit,$offset);
		return $query->result();

	 }
	 /**
	* ask_question method creates a record in the Question table.

	* @param array $options
	*/
	function ask_question($data){	     
	    $this->db->insert('Questions',$data);
	    return $this->db->insert_id();
	}

	/**
	* update_answer method alters a record in the Question table.

	* @param array $options
	* @return int affected_rows()
	*/
	public function update_question($user_data, $questionID) {
			$query = $this->db->update_string("Question", $user_data, $questionID);
			$this->db->query($query);
		
	}

	/**
	*get_ten_recent_question will return 10 recent questions
	*SELECT * FROM table ORDER BY date DESC LIMIT 10;
	* @return array result() 
	*/
	function get_ten_recent_question($limit){	
		$this->db->select(' body,postedDate');
	    	$this->db->order_by('postedDate', 'desc');
		$this->db->limit($limit);
		$query = $this->db->get('Question');
		return $query->result();
	    
	}
	/**
	*method search_question will return question near to searchTerm 
	*/
	function search_question($searchTerm){
		$this->db->select(' body');
		$this->db->like('body', $searchTerm);
		$query = $this->db->get('Question');
		return $query->result();

	}


	/**
	* delete_question method removes a record from the Question table
	*
	*/
	public function delete_question($questionID){
       
	    $this->db->where('questionID', $questionID);
	    $this->db->delete('Question');
	}
	// this method is if aperson wants to delete it is own question 
	public function delete_own_question($questionID,$userID){
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

	}
	
	//This method will return the rank of specified questionID
	public function get_rank($questionID){
		$this->db->select('rank');
		$this->db->where('questionID',$questionID);
		$query=$this->db->get('Question');
		return $query->resutl();
	}
	
	// This method will add one to the current rank of the specified questionID
	public function add_rank($questionID){
		$currentRank=get_rank($questionID);
		$this->db->query('update Answer set rank='.($currentRank+1).' where answerID='.$questionID);
		
	}
	
	
	
}// end of file
