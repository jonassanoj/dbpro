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
	
	// If the user is logged in, do the following:
	if ($CI -> session -> userdata('login')) {
		$user = $CI -> session -> userdata('user');
		// if a user is logged in define dynamic navigation items
		$data['navigation'][0] = anchor('main/filter/userID/'.$CI->session->userdata('uid'),lang('title_your_questions'));
		$data['navigation'][1] = anchor('http://www.google.de','google');
		
		////////////////// temporary changes: added languages to navigation bar for logged in users:
		$data['navigation'][2] = anchor('util/lang/english', lang('w_lang_en'));
		$data['navigation'][3] = anchor('util/lang/farsi', lang('w_lang_fa'));
		$data['navigation'][4] = anchor('util/lang/pashto', lang('w_lang_ps'));
		$data['navigation'][5] = anchor('util/lang/deutsch', lang('w_lang_de'));
		////////////////// end of temporary changes
		
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
