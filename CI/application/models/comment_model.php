<?php
class Comment_model extends CI_Model {
	   
   
	 
	function __construct() {
             parent::__construct();
   	 }
 
	   /**
	* give_comment_question method creates a record in the Comment table for a question with $questionID.

	* @param  $questionID ,$body of the comment 
	*/
	function give_comment_question($questionID,$body){
		$this->db->query('insert into Comment(questionID,body) values ('.$questionID.','.$body.')');
		return $this->db->insert_id();
		   
	}

	/** give_comment_answer method creates a record in the Comment table for an answer with $answerID.

	* @param  $questionID ,$body of the comment 
	*/
	function give_comment_answer($answerID,$body){
	   
		$this->db->query('insert into Comment(answerID,body) values ('.$answerID.','.$body.')');
		return $this->db->insert_id();
	   
	}
	// this method will return all comment related to an question 
	// @ param $offset is for pagination and $limit is for number of records in the page to be disply
	function get_comment_question($offset,$limit,$questionID){
	     
		$query = $this->db->get_where('Comment', array('questionID'=>$questionID), $limit, $offset);
		if($query->num_rows() == 0) return false;
		return $query->result_array();
		    
	}
	// this method will return all comment related to an answer 
	// @ param $offset is for pagination and $limit is for number of records in the page to be disply
	function get_comment_answer($offset,$limit,$answerid){
	     
		$query = $this->db->get_where('Comment', array('answerID'=>$answerID), $limit, $offset);
		if($query->num_rows() == 0) return false;
		return $query->result_array();
	    
	}

	/**
	* delete_comment method removes a record from the answer table
	* @param  $commentID
	*/
	function delete_comment($commentID)
		{
			

	    $this->db->where('commentID', $commentID);
	    $this->db->delete('Comment');
		}
} //end of file
