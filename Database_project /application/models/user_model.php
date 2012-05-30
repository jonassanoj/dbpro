<?php
class User_model extends CI_Model {
	   
   
	 
	    function __construct()
   	 {
        parent::__construct();
   	 }
 function table_exists($table_name = null)
    	{
    	return $this->db->table_exists($table_name);
   	 }
		   /**
* add_user method creates a record in the User table.
*
* Option: Values
* --------------
*userID     
*userName   (required)
*firstName  (required)
*lastName   (required)
*email      (required)
*password   (required)
*imagePath
*acountCreationDate
*rank
*lastLogin
*organization
*dateOfBirth
*degree
*detail
  
*KEY fieldID`
*KEY userTypeID
* 
* @param array $options
*data can be initialized in the contrler as array of required prameter and pass in to the model 

* for example $data = array(
		'firstName' => this->input->post('firstName'),
		'lastName' => this->input -> post('lastName')		
			);

*/

function add_user($data)
{
    
	
    // Execute the query
    $this->db->insert('User',$data);

    // Return the ID of the inserted row, or false if the row could not be inserted
    return $this->db->insert_id();
}

/**
* UpdateUser method alters a record in the users table.
*
* Option: Values
* --------------
*userID     
*userName   
*firstName  
*lastName   
*email      
*password   
*imagePath
*acountCreationDate
*rank
*lastLogin
*organization
*dateOfBirth
*degree
*detail
  
*KEY fieldID`
*KEY userTypeID
*
* @param array $options
* @return int affected_rows()
*/
function update_user($options = array())
	{
    // required values
    if(!$this->_required(array('firstName','lastName','email','password'), $options)) echo "please fill the required fields";

    // qualification (we're not allowing to update data that it shouldn't)
    $qualificationArray = array('firstName','lastName','email','password','imagePath','rank','organization','dateOfBirth','degree','detail', 'fieldID','userTypeID');
    foreach($qualificationArray as $qualifier)
    	{
        if(isset($options[$qualifier])) $this->db->set($qualifier, $options[$qualifier]);
    	}

    $this->db->where('userID', $options['userID']);

    
    // Execute the query
    $this->db->update('User');

    // Return the number of rows updated, or false if the row could not be inserted
    return $this->db->affected_rows();
	}

/**
* get_user_data method returns an array of qualified user record objects in acending order 
*

*/
function get_user_data()
	{
   
  
   	 $this->db->select('firstName,lastName,email,rank');
    	$this->db->order_by('firstName', 'asc');
	$query = $this->db->get('User');
	

   
        //  it will return  array of objects from question type 
        return $query->result();
    

    
	}
/**
* get_user_details method returns details of auser with given userID 
*

*/
 
function get_user_details($userID)
	{
   
  
   	 $this->db->select('*');
	 $this->db->where('userID',$userID)
    	 $query = $this->db->get('User');
	

   
        //  it will return  array of objects from question type 
        return $query->result();
    

    
	}

/**
*method get_relevant_recent_question will returns questions relevent to the user with given userID 
* --------------------------
*
* @return array result() 
* @parameter userID
*/
function get_relevant_recent_question($userID)
	{
	$this->db->select(' body');
	$this->db->where('userID', $userID); 
	$query = $this->db->get('Question');
	return $query->result();
	}
/**
* DeleteUser method removes a record from the users table
*
* @param array $options
*/
function delete_user($userID)
	{
    // required values
    $this->db->where('userID', $userID);
   if( $this->db->delete('User')) return true ;

	}
}// end of class 
