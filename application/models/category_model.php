<?php

	/**
 	* The category model
 	*
 	* This model allows us to add, update, retrieve and delete category from category table.
	*
	* It uses the following database:
	*
	* * _goftogo_
	* * _User_ (read only)
	*
 	* It uses the following tables of goftogo database:
 	*
 	* * _Category_
 	* * _User_ (read only)
 	*
 	* @package models
 	*/

class Category_model extends CI_Model {

	 /**
	 * Add new category.
	 * 
	 * This function will add new category to the Category tables and a specified field table Category tables.
	 *
	 * @author Abdulaziz Akbary
	 * @param string $catName the catName, means category-Name.
	 * @param int $fieldID the fieldID, means field-ID.  
	 * @return int containing a category ID.
	 */

	function add_cat($catName, $fieldID) {

		$this -> db -> set('catName', $catName);
		$this -> db -> set('fieldID', $fieldID);
		$this -> db -> insert('Category');
		return $this -> db -> insert_id();
	}


	 /**
	 * Update category.
	 * 
	 * This function is used to update previouse existed category in a Category tables.
	 *
	 * @author Abdulaziz Akbary
	 * @param int $catID the catID, means category-ID.
	 * @param string $catName the catName, means category-Name.
	 * @return int containing a category ID.
	 */
	function update_cat($catID, $catName) {
		$this -> db -> where('catID', $catID);
		$this -> db -> set('catName', $catName);
		$this -> db -> update('Category');
		return $this -> db -> affected_rows();
	}

 	 /**
	 * Retrieving all category.
	 * 
	 * This function will return all categories belongs to a specific field from Category tables.
	 *
	 * @author Abdulaziz Akbary
	 * @param int $fieldID the fieldID, means field-ID.
	 * @return object containing all columns and rows of Category table.
	 */

	
	function get_categories($fieldID=0) {
		if (!$fieldID=0) $this -> db -> where('fieldID', $fieldID);
		$query = $this -> db -> get('Category');
		return $query -> result();
	}

	 
	 /**
	 * Delete a category.
	 * 
	 * This function is used to delete a specific category from a Category tables.
	 *
	 * @author Abdulaziz Akbary
	 * @param int $catID the catID, means category-ID.
	 * @return Void 
	 */
	 
	function delete_cat($catID) {
		$this -> db -> where('catID', $catID);
		$this -> db -> delete('Category');
	}
}
