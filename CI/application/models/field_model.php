<?php
class Field_model extends CI_Model {
	   
   
	 
	    function __construct()
    {
        parent::__construct();
    }
 function table_exists($table_name = null)
    {
    	return $this->db->table_exists($table_name);
    }
	   /**
* add_field method creates a record in the Field table.
*
* Option: Values
* --------------
*fieldID
*fieldName 
* @param array $options
*/
function add_field($fieldName)
	{
    
      
    // Execute the query
    $this->db->insert('Field',$fieldName);

    // Return the ID of the inserted row, or false if the row could not be inserted
    return $this->db->insert_id();
	}

/**
* update_field method alters a record in the Fields table.
*
* Option: Values
* --------------
*fieldID
*fieldName
*
* @param array $options
* @return int affected_rows()
*/
function update_field($fieldID,$fieldName)
	{
        $this->db->where('fieldID', $fieldID);
  
    // Execute the query
    $this->db->update('Field',$fieldName);

    // Return the number of rows updated, or false if the row could not be inserted
    return $this->db->affected_rows();
	}

/**
* get_field_data method returns an array of field record objects
*
* Option: Values
* --------------
*fieldID
*fieldName
* limit                limits the number of returned records
* offset                how many records to bypass before returning a record (limit required)
* sortBy                determines which column the sort takes place
* sortDirection        (asc, desc) sort ascending or descending (sortBy required)
*
* Returns (array of objects)
* --------------------------
*fieldID
*fieldName
* @param array $options
* @return array result()
*/
function get_field_data()
	{
    

    
    	$query = $this->db->get('Field');
    
        return $query->result();
    
	}

/**
* delete_field method removes a record from the field table
*
* @param array $options
*/
function delete_field($fieldID)
	{
   

    $this->db->where('fieldID',$fieldID);
    $this->db->delete('Field');
	}
}// end of file