<?php
class User_type_model extends CI_Model {
	   
   
	 
	    function __construct()
    	{
        parent::__construct();
    	}
 function table_exists($table_name = null)
    	{
    	return $this->db->table_exists($table_name);
    	}
	   /**

* 
* @param array $options
*/
function add_user_type($data)
	{
    

    // Execute the query
    $this->db->insert('UserType',$data);

    // Return the ID of the inserted row, or false if the row could not be inserted
    return $this->db->insert_id();
	}

/**

*/
function update_user_type($userTypeID,$userTypeName)
	{
   

    $this->db->where('userTypeID', $userTypeID);

   
    $this->db->update('UserType',$userTypeName);

    // Return the number of rows updated, or false if the row could not be inserted
    return $this->db->affected_rows();
	}

/**

*/
function get_user_type_data()
	{
    
   	 $query = $this->db->get('UserType');
    
         return $query->result();
   
	}

/**
* DeleteUser method removes a record from the users table
*
* @param array $options
*/
function delete_user_type($userTypeID)
	{
    

    $this->db->where('userTypeID', $userTypeID);
    $this->db->delete('UserType');
	}
}
