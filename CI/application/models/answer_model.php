<?php
class Answer_model extends CI_Model {
	    
	 
	function __construct(){
          parent::__construct();
    	}
 	
	// This method will insert an answer to specified quesitonID 
	function give_answer($questionID,$bodyText){
	    $this->db->query('insert into Answer(questionID,body) values ('.$questionID.','.$bodyText.')');
	    return $this->db->insert_id();
	}

	// This method will returns answers to the specified quesitonID
	public function get_answers($questionID){
		$this->db->select('body');
		$this->db->where('questionID', $questionID); 
		$query = $this->db->get('Answer');
		return $query->result();
	}
	
	//This method will return the rank of specified answerID
	public function get_rank($answerID){
		$this->db->select('rank');
		$this->db->where('answerID',$answerID);
		$query=$this->db->get('Answer');
		return $query->resutl();
	}
	
	// This method will add one to the current rank of the specified answerID
	public function add_rank($answerID){
		$currentRank=get_rank($answerID);
		$this->db->query('update Answer set rank='.($currentRank+1).' where answerID='.$answerID);
		
	}


	/**
	* update_answer method alters a record in the users table.
	* @param array $options
	* @return int affected_rows()
	*/
	function update_answer($body,$answerID){
	    $query = $this->db->update_string("Answer", $body, $answerID);
	    $this->db->query($query);
	 }

    
	
	/**
	* delete_answer method removes a record from the answer table
	*/
	function delete_answer($answerID){
	    
	    $this->db->where('answerID', $answerID);
	    $this->db->delete('Answer');
		}

		public function addAnswer()

		{
		$this->load->helper('url');

		//$slug = url_title($this->input->post('title'), 'dash', TRUE);

		$data = array(
		'questionID' => $this->input->post('questionID'),
		'body' => $this->input->post('body'),
		);


		return $this->db->insert('Answer', $data);

		}

}// end of class 
