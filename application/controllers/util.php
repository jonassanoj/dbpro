<?php
/**
 * Utility controller
 *
 * a controller containing utility functions. It uses no views but sends the user back to the last URI saved in the session.
 * e.g. used for changing the language globally.
 *
 * @package controllers
 */

class Util extends CI_Controller {
	
	/** 
	 * Load a language
	 * 
	 * Changing the language my setting the session variable language. 
	 * 
	 * @param string $language the language to load, named like the folder containing the language files
	 */
	public function lang($language) {
		$this -> session -> set_userdata('language',$language);
		redirect($this -> session -> userdata('last_visited'));
	}

}