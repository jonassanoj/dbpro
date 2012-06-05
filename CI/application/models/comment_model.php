<?php
class Comment_model extends CI_Model {
	   
   
	 
	    function __construct()
   	 {
        parent::__construct();
   	 }
 function table_exists($table_name = null)
    	{
    	return $this->db->table_exists($table_name);
    	}
	   /**
* give_comment method creates a record in the Comment table.
*
* Option: Values
* --------------
*commentID
*date
*commentBody
*KEY answerID 
*KEY userID
* 
* @param array $options
*/
function give_comment($data)
	{
    
    

   
    // Execute the query
    $this->db->insert('Comment',$data);

    // Return the ID of the inserted row, or false if the row could not be inserted
    return $this->db->insert_id();
	}


/**
* get_comment_data method returns an array of qualified user record objects
*
* Option: Values
* --------------
*commentID
*date
*commentBody
*KEY answerID 
*KEY userID
* limit                limits the number of returned records
* offset                how many records to bypass before returning a record (limit required)
* sortBy                determines which column the sort takes place
* sortDirection        (asc, desc) sort ascending or descending (sortBy required)
*
* Returns (array of objects)
* --------------------------
*commentID
*date
*commentBody
*KEY answerID 
*KEY userID
*
* @param array $options
* @return array result()
*/
function get_comment_data($offset,$limit,$aid)
	{
     
    $query = $this->db->get_where('Comment', array('answerID'=>$aid), $limit, $offset);
    if($query->num_rows() == 0) return false;

   
        //  it will return  array of objects from answer type 
        return $query->result_array();
    
	}

/**
* delete_answer method removes a record from the answer table
*
* @param array $options
*/
function delete_answer($commentID)
	{
	        

    $this->db->where('commentID', $commentID);
    $this->db->delete('Comment');
	}
} //end of file
