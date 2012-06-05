<?php
class Answer_model extends CI_Model {
	    function __construct(){
            parent::__construct();
    	}
        function table_exists($table_name = null){
    	   return $this->db->table_exists($table_name);
    	}
	   /**
* give_answer method creates a record in the Answer table.
*
* Option: Values
* --------------
*answerID
*answeredDate
*rank
*body
*KEY questionID 
*KEY userID
* 
* @param data can be as array from cantroller

*/
    function give_answer($data){
        // Execute the query
        $this->db->insert('Answer', $data);
        // Return the ID of the inserted row, or false if the row could not be inserted
        return $this->db->insert_id();
	}

/**
* update_answer method alters a record in the users table.
*
* Option: Values
* --------------
*answerID
*answeredDate
*rank
*body
*KEY questionID 
*KEY userID
*
* @param array $options
* @return int affected_rows()
*/
    function update_answer($options = array())
	{
        // required values
        if(!$this->_required(array('body'), $options)) return false;
        // qualification (we're not allowing to update data that it shouldn't)
        $qualificationArray = array('answerDate','rank','body','questionID','userID');
        foreach($qualificationArray as $qualifier){
            if(isset($options[$qualifier])) $this->db->set($qualifier, $options[$qualifier]);
    	}
        $this->db->where('answerID', $options['answerID']);
    // Execute the query
    $this->db->update('Answer');
    // Return the number of rows updated, or false if the row could not be inserted
    return $this->db->affected_rows();
	}
/**
* get_user_data method returns an array of qualified Answer record objects
* @return array result()
*/
function get_answer($offset,$limit,$qid){
   	    $query = $this->db->get_where('Answer',array('questionID'=>$qid),$limit,$offset);
        return $query->result_array();
	}

/**
* delete_answer method removes a record from the answer table
*
* 
*/
function delete_answer($answerID)
	{
    
    $this->db->where('answerID', $answerID);
    $this->db->delete('answers');
	}
}// end of class 
