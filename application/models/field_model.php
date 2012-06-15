<?php

// TODO: complete field_model documentation according to the guidelines

class Field_model extends CI_Model {

	// get_field_data method returns an array of field record objects.
	function get_fields() {
		$query = $this -> db -> get('Field');
		return $query -> result();
	}


	// add_field method creates a record in the Field table.
	function add_field($fieldName) {
		$this -> db -> insert('Field', $fieldName);
		return $this -> db -> insert_id();
	}

	// delete_field method removes a record from the field table.
	function delete_field($fieldID) {
		$this -> db -> where('fieldID', $fieldID);
		$this -> db -> delete('Field');
	}

}
