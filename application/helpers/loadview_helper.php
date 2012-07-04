<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Create dynamic navigation and other view variables
 * 
 * @param string $content the main content to display
 * @param array $data the array that will be passed to the view
 * @return array the updated data array
 * 
 */
 
function init_view_data($content,$data) {
	$CI =& get_instance();
	if ($CI -> session -> flashdata('message')) $data['message'] = $CI -> session -> flashdata('message'); 
	// If the user is logged in, do the following:
	if ($CI -> session -> userdata('login')) {
		$user = $CI -> session -> userdata('user');
		// if a user is logged in define dynamic navigation items
		$data['navigation'][0] = anchor('main/filter/userID/'.$CI->session->userdata('uid'),lang('title_your_questions'));

		// if a user is logged in show categories from his field:
		$data['categories']=$CI->category_model->get_categories($user->fieldID);
		$data['userinfo'] = $user;
	}
	// If the user is not logged in, do the following:
	else {
		$data['username']=$CI -> input -> cookie('username');
		$data['categories']=$CI->category_model->get_favorite_category();
		
	}
	$data['content'] = "content/$content";
	
	return $data;	
}

/**
 * show a message in the next view
 * 
 * show a message the next time a view is shown 
 * only works for views loaded via init_view_data()
 * 
 * @param string $msg the message to show the next time a page i loaded
 * 
 */
 
function flash_message($msg) {
	$CI =& get_instance();
	$CI -> session -> set_flashdata('message',$msg); 	
}
