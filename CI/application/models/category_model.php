<?php
class Category_model extends CI_Model {
	   
   
	 
	 function __construct() {
              parent::__construct();
   	 }
	// this function will add record to the category table  
	function add_cat($catName,$fieldID){ 
	  
	    $this->db->set('catName', $catName);
	    $this->db->set('fieldID', $fieldID);
	    $this->db->insert('Category');
	    return $this->db->insert_id();
	}

	// this fuction will alter the new name for category in Category Table 
	function update_cat($catID,$catName){
	    $this->db->where('catID', $catID);
	    $this->db->set('catName', $catName);
	    $this->db->update('Category');
	    return $this->db->affected_rows();
	}

	// this function will return all Categories in the category table 
	function get_cat_data(){    
	    $query = $this->db->get('Catagory');		 
	    return $query->result();
	    
	}

	// this function will delete an unwanted category from gategory table 
	function delete_cat($catID){    
	    $this->db->where('catID', $catID);
	    $this->db->delete('Catagory');
	}
}//end of file
