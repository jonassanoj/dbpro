<?php 
if (!($this -> session -> userdata('login'))) {
	echo form_open("user/login/");//,array('class'=>'formee formee-small'));
	echo formee_div(12); // line one: name box
	    echo lang('form_username','username');
	    $options = array("id" => "username", "name"  => "username");
	    if (isset($username)) $options['value'] = $username;
		echo form_input($options);
	echo '</div>'.formee_div(12,DIV_CLEAR); // line two: password box
		echo lang('form_password','password');
		echo form_password(array("id" => "password", "name" => "password"));
	echo '</div>'.formee_div(6,DIV_CLEAR); // line three: remember box, and two buttons
		echo lang('form_remember','remember');
		echo form_checkbox('remember', 'yes', TRUE);
	//echo '</div>'.formee_div(3);
	    echo '<input type="submit" id="'.'register'.'" name="'.'login'.'" value="'.lang('form_register').'" />';
		//echo formee_button('register',lang('form_register'));
	//echo '</div>'.formee_div(3);
		echo '<input type="submit" id="'.'login'.'" name="'.'login'.'" value="'.lang('form_login').'" />';
		//echo formee_button('login',lang('form_login'));
		echo '</div>';
    echo form_close();
}
else { 
	echo form_open("user/logout/",array('class'=>'formee'));
	echo formee_div(12); // line one: message
		echo lang(sprintf('msgvar_loggedin_as', $this->session->get_userdate('username')),'logout');
	echo '</div>'.formee_div(12,DIV_CLEAR); // line two: logout button
	echo formee_button('login',lang('form_logout'));
	echo '</div>';
echo form_close();
}
	