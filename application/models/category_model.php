<?php

	/**
 	* The category model
 	*
 	* This model allows us to add, update, retrieve and delete category from category table.
	*
 	* It uses the following tables:
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
	 * This function will add new category to a specified field in Category tables and return category ID.
	 *
	 * @param string $catName Means category-Name.
	 * @param int $fieldID Means field-ID.  
	 * @return int Category-ID of new inserted category.
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
	 * @param int $catID Means category-ID.
	 * @param string $catName Means category-Name.
	 * @return int Category-ID of updated category.
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
	 * This function will return all categories thats belongs to a specific field from Category tables,
	 * if no parameter passed to this function in this case it will return the whole category table.
	 *
	 * @param int $fieldID Means field-ID.
	 * @return array Containing columns and rows of Category table.
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
	 * @param int $catID Means category-ID.
	 * @return int Category-ID of deleted row.
	 */
	 
	function delete_cat($catID) {
		$this -> db -> where('catID', $catID);
		$this -> db -> delete('Category');
		return $this -> db -> affected_rows();
	}
}
