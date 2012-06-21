<?php
/**
 * the Field_model 
 *
 * 
 *
 * @package models
 */
class Field_model extends CI_Model {

	/**
	 * retrieves all field names.
	 * 
	 * @param none
	 * @return array holds fields objects with fieldIDs and fieldNames. 
	 */ 

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


	/**
	 * Deletes a specific record from table _Field that matches the given fieldID. 
	 * fieldID: can be an integer that has beent from coller function.
	 * 
	 * @param int $fieldID

	*/

	function delete_field($fieldID) {
		$this -> db -> where('fieldID', $fieldID);
		$this -> db -> delete('Field');
	}

}
