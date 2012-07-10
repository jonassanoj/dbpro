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
		if($user->userTypeID == 3){
			$data['navigation'][1] = anchor('admin',lang('admin_user'));
		}

		// if a user is logged in show categories from his field:
		$data['categories']=$CI->category_model->get_categories($user->fieldID);
		$data['userinfo'] = $user;
		
		
	}
	// If the user is not logged in, do the following:
	else {
		$data['username']=$CI -> input -> cookie('username');
		$data['categories']=$CI->category_model->get_favorite_category();
		
	}
	$data['general_cat'] = $CI -> category_model -> get_categories(0,Category_model::MULTI_ARRAY);
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
 * @param string $class the css class the message div should have in addition to message
 */
 
function flash_message($msg,$class='') {
	$CI =& get_instance();
	$message['class']='message '.$class;
	$message['content']=$msg;
	$CI -> session -> set_flashdata('message',$message); 	
}
