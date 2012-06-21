<?php

	/**
	 * this model is for fields
	 * 
	 * Field_model: this class provide interfaces for getting
	 * adding, deleting fields, from database, (Field) table
	 * @author  Sayed Ahmad Mahboobi
	 * @package models
	 */

class Field_model extends CI_Model {

	
	
	/**
	 * this function is for getting field
	 * 
	 * get_fields(): this function select all rows from Field table
	 * 
	 * @author Sayed Ahmad Mahbobi
	 * @return: Array: it return an array of all rows in the Field table
	 */
	
	function get_fields() {
		$query = $this -> db -> get('Field');
		return $query -> result();
	}



	/**
	 * it adds records in the field table
	 * 
	 * add_field(): This fuction add a new field into Field table
	 * 
	 * @author Sayed Ahmad Mahboobi
	 * @param string $fieldName (String: needs a parameter which represent a field name)
	 * @return int new_inserted_id (int: it return the new iserted field id)
	 */
	
	function add_field($fieldName) {
		$this -> db -> insert('Field', $fieldName);
		return $this -> db -> insert_id();
	}

	
	/**
	 *deletes the feilds
	 * 
	 * delete_field(): This fuction delete a field from field table
	 * Function takes an arguments which will be fieldID
	 * 
	 * @author Sayed Ahmad Mahboobi
	 * @param int $fieldID (int: ID of the field to be delete)
	 * @return: void
	 */
	
	function delete_field($fieldID) {
		$this -> db -> where('fieldID', $fieldID);
		$this -> db -> delete('Field');
	}

}
