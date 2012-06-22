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
	if ($CI -> session -> userdata('login')) {
		$data['userinfo'] = $CI -> session -> userdata('user');
		// if a user is logged in define dynamic navigation items
		$data['navigation'][0] = anchor('main/filter/userID/'.$CI->session->userdata('uid'),lang('title_your_questions'));
		$data['navigation'][1] = anchor('http://www.google.de','google');
	}
	$data['content'] = "content/$content";
	return $data;	
}