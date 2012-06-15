<?php

// TODO: adapt complete docu to guidelines

class Field_model extends CI_Model {

	// add_field method creates a record in the Field table.
	function add_field($fieldName) {
		$this -> db -> insert('Field', $fieldName);
		return $this -> db -> insert_id();
	}

	// update_field method alters a record in the Fields table.
	function update_field($fieldID, $fieldName) {
		$this -> db -> where('fieldID', $fieldID);
		$this -> db -> update('Field', $fieldName);
		return $this -> db -> affected_rows();
	}

	// get_field_data method returns an array of field record objects.
	function get_field_data() {
		$query = $this -> db -> get('Field');
		return $query -> result();
	}

	// delete_field method removes a record from the field table.
	function delete_field($fieldID) {
		$this -> db -> where('fieldID', $fieldID);
		$this -> db -> delete('Field');
	}

}
