<?php
class User_type_model extends CI_Model {
	   
   
	 
	function __construct(){
        parent::__construct();
    	}
 

	function add_user_type($userType){	    
	     $this->db->set('userType', $userType);
	     $this->db->insert('UserType'); 
	     return $this->db->insert_id();
	}

	//this function will update the userType to the new name 
	function update_user_type($userTypeID,$userTypeName){   
	    $this->db->where('userTypeID', $userTypeID);
	    $this->db->set('userType', $userTypeName);	   
	    $this->db->update('UserType');

	}

	// this function will return all userType 
	function get_user_type_data(){    
	    $query = $this->db->get('UserType');    
	    return $query->result();
	   
	}

	// this function is for delation of user type with given userTypeID
	function delete_user_type($userTypeID){   
	    $this->db->where('userTypeID', $userTypeID);
	    $this->db->delete('UserType');
	}
}//end of file 
