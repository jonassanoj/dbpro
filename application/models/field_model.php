<?php


/**
 * the Field_model 
 *
 * Provides the following functions:
 * _get_fields(): returns the field recoreds from table _Field.
 * _add_field($fieldName): insert a new field recored to table _Field.
 * _delete_field($fieldID): deletes a record from table _Field.
 * It uses the table _Field.
 *
 * @package models
 */
class Field_model extends CI_Model {

<<<<<<< HEAD

	/**
	 * retrives all records from table Field as record objects.
	 * @param none
	 * @return array holds fields objects with fieldIDs and fieldNames. 
	 */ 

=======
	
	
	/**
	 * this function is for geting field
	 * 
	 * get_fields(): this function select all rows from Field table
	 * 
	 * @author Sayed Ahmad Mahbobi
	 * @return: Array: it return an array of all rows in the Field table
	 */
	
>>>>>>> 790cc173d628cdc5425520b2c1b81ad511ae3e9e
	function get_fields() {
		$query = $this -> db -> get('Field');
		return $query -> result();
	}

	/**
	 * insert a given fieldName into table _Field. 
	 * fieldname: can be a string that indicates area of study or profession of a user. 
	 * @param string $fieldName
	 */

	function add_field($fieldName) {
		$this -> db -> insert('Field', $fieldName);
		return $this -> db -> insert_id();
	}

<<<<<<< HEAD
	/**
	 * Deletes a specific record from table _Field that matches the given fieldID. 
	 * fieldID: can be an integer that has beent from coller function.
	 * @param int $fieldID
=======
	
	/**
	 *deletes the feilds
	 * 
	 * delete_field(): This fuction delete a field from field table
	 * Function takes an arguments which will be fieldID
	 * 
	 * @author Sayed Ahmad Mahboobi
	 * @param int $fieldID (int: ID of the field to be delete)
	 * @return: void
>>>>>>> 790cc173d628cdc5425520b2c1b81ad511ae3e9e
	 */

	function delete_field($fieldID) {
		$this -> db -> where('fieldID', $fieldID);
		$this -> db -> delete('Field');
	}

}
