<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Open a Formee-form
 * 
 * @param string $action Submit action URI (e.g. main/home)
 * @param array $options options to pass on. class will be overwritten. 
 * @return string contains html to open the form
 */

function formee_open($action, $options=array()) {
	$options['class']='formee';
	return form_open($action,$options);	
}

define('DIV_CLEAR',TRUE);
/**
 * open a layout div, using Formee-layout (of12). 
 * 
 * @param int $of12 how many of 12 layout columns should the contained elements use. If 0 close a div tag.
 * @param bool clear start new row
 * @return string contains the generated html
 */
function formee_div($of12=0, $clear=FALSE) 	{
	return (($of12) ? '<div class="grid-' // if $of12 is given open a div
			          .$of12.'-12'.       
			          (($clear)? ' clear' : '') // if clear is true add the class clear to the div
			          .'">'
			        : '</div>'); // if $of12 is 0 just close the tag
}

/**
 * create a formee submit button
 *
 * @param string $name the name and id of the button
 * @param string $value the value
 * @return string contains the generated html
 */
function formee_button($name,$value){
	return '<input class="formee-button" type="submit" id="'.$name.'" name="'.$name.'" value="'.$value.'" />';
}
	
		
	



