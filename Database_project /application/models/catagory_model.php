<?php
class Catagory_model extends CI_Model {
	   
   
	 
	    function __construct()
   	 {
        parent::__construct();
   	 }
 function table_exists($table_name = null)
   	 {
    	return $this->db->table_exists($table_name);
   	 }
	   /**
* add_cat method creates a record in the catagory table.
*
* Option: Values
* --------------
*catID
*carName 
* @param array $options
*/
function add_cat($data)
	{
    

    
    // Execute the query
    $this->db->insert('Catagory',$data);

    // Return the ID of the inserted row, or false if the row could not be inserted
    return $this->db->insert_id();
	}

/**
* update_cat method alters a record in the catagory table.
*
* Option: Values
* --------------
*catID
*catName
*
* @param array $options
* @return int affected_rows()
*/
function update_cat($catID,$catName)
	{
    

    $this->db->where('catID', $catID);

   
    // Execute the query
    $this->db->update('Catagory',$catName);

    // Return the number of rows updated, or false if the row could not be inserted
    return $this->db->affected_rows();
	}

/**
* get_cat_data method returns an array of catagory record objects
*
* Option: Values
* --------------
*catID
*catName

* @return array result()
*/
function get_cat_data()
	{
    
    $query = $this->db->get('Catagory');
    if($query->num_rows() == 0) return false;

    
        //returns any number of records as an array of objects
        return $query->result();
    
	}

/**
* delete_cat method removes a record from the field table
*
* @param array $options
*/
function delete_cat($catID)
	{
    
    $this->db->where('catID', $catID);
    $this->db->delete('Catagory');
	}
}//end of file