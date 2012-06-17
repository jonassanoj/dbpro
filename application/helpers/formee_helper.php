<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * @param string $action Submit action URI (e.g. main/home)
 * @param unknown_type $options 
 */

function formee_open($action, $options=array()) {
	$options['class']='formee';
	return form_open($action,$options);	
}
