<?php

	/**
 	* The category model
 	*
 	* This model allows us to add, update, retrieve and delete category from category table.
	*
 	* It uses the following tables:
 	*
 	* * _Category_
	* * _Field_ (read only)
 	* * _User_ (read only)
 	* * _Question_ (read only)
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
	 * Retrieves all categories.
	 * 
	 * This function will return all categories thats belong to a specific field from Category tables,
	 * if no parameter passed to this function in this case it will return the whole category table.
	 *
	 * @param int $fieldID the id of the field, if left empty retrieve all categories
	 * @param int $return what to return. default is ARRAY_OF_OBJECTS, 
	 * FLAT_ARRAY will return a one-dimensional array (catID => catName) that can be used by form-helper directly
	 * MULTI_ARRAY will return a two-dimensional array ()   
	 * @return array contains category objects with fieldID, catID and catName. Can return different arrays if specified by $return. 
	 */
	 
	// constants for parameters:
	const ARRAY_OF_OBJECTS = 0;
	const FLAT_ARRAY = 1;
	const MULTI_ARRAY = 2; 
	 	
	function get_categories($fieldID=0,$return=self::ARRAY_OF_OBJECTS) {
		if ($fieldID) $this -> db -> where('Category.fieldID', $fieldID);
		$this -> db -> join('Field','Category.fieldID=Field.fieldID');
		$this -> db -> select('catID, catName, Category.fieldID, fieldName');
		$query = $this -> db -> get('Category');
		
		if ($return==self::FLAT_ARRAY) {
			foreach($query -> result() as $category)
				$flat[$category->catID]=$category->catName;
			return $flat;
		}
		elseif ($return==self::MULTI_ARRAY) {
			foreach($query -> result() as $category)
				$multi[$category->fieldName][$category->catID]=$category->catName;
			return $multi;			
		}
		// ARRAY_OF_OBJECTS
		else return $query -> result();
	}
	
	/**
	 * Retrieve the 5 most popular Categories
	 * 
	 *
	 * @return array contains category object containing fieldID, catID and catName
	 * 
	 */
	function get_favorite_category() {
		//TODO: update query to use activerecords!
		$this->db->select("count(*) as nq, catName, Category.catID");
		$this->db->from('Question');
		$this->db->join('Category', 'Category.catID = Question.catID','right');
		$this->db->group_by('Category.catID');
		$this->db->order_by("nq", "desc");
		$this->db->limit(5);
		$query = $this->db->get();
		return $query -> result();
		
	}

	 /**
	 * Delete a category.
	 * 
	 * This function is used to delete a specific category from a Category tables.
	 *
	 * @param int $catID Means category-ID.
	 * @return int Category-ID of deleted row.
	 */
	 
	function delete_cat($catID) {
		$this -> db -> where('catID', $catID);
		$this -> db -> delete('Category');
		return $this -> db -> affected_rows();
	}
}
