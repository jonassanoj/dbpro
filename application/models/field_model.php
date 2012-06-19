<?php


/**
 * the Field_model 
 *
 * Provides CRD functionality for Field.
 *
 * It uses the table _Field.
 *
 * @package models
 */
class Field_model extends CI_Model {

	/**
	 * retrives all records from table Field as a record objects.
	 * @param none
	 * @return array holds fields objects with fieldIDs and fieldNames. 
	 */ 
	function get_fields() {
		$query = $this -> db -> get('Field');
		return $query -> result();
	}


	/**
	 * insert a given fieldName into table Field. 
	 * fieldname: can a string that indicates area of study or profession of a user. 
	 * @param unknown_type $fieldName
	 */
	function add_field($fieldName) {
		$this -> db -> insert('Field', $fieldName);
		return $this -> db -> insert_id();
	}

	/**
	 * Deletes a specific record from table Field that matches the given fieldID. 
	 * fieldID: can be an integer that has beent from coller function.
	 * @param unknown_type $fieldID
	 */
	function delete_field($fieldID) {
		$this -> db -> where('fieldID', $fieldID);
		$this -> db -> delete('Field');
	}

}
