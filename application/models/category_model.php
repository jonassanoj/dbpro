<?php

// TODO: complete the category_model documentation, using phpdoc comments like in question_model.php

class Category_model extends CI_Model {

	// this function will add record to the category table
	/**
	 * this is model
	 */
	function add_cat($catName, $fieldID) {

		$this -> db -> set('catName', $catName);
		$this -> db -> set('fieldID', $fieldID);
		$this -> db -> insert('Category');
		return $this -> db -> insert_id();
	}

	// this function will alter the new name for category in Category Table
	function update_cat($catID, $catName) {
		$this -> db -> where('catID', $catID);
		$this -> db -> set('catName', $catName);
		$this -> db -> update('Category');
		return $this -> db -> affected_rows();
	}

	// this function will return all Categories in the category table
	function get_categories($fieldID=0) {
		if (!$fieldID=0) $this -> db -> where('fieldID', $fieldID);
		$query = $this -> db -> get('Category');
		return $query -> result();
	}

	// this function will delete an unwanted category from category table
	function delete_cat($catID) {
		$this -> db -> where('catID', $catID);
		$this -> db -> delete('Category');
	}
}
