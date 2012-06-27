<?php 
if (!isset($userinfo)) {
	echo form_open("user/login/",array('class'=>'login_small'));
	echo lang('form_username','username');
	    $options = array("id" => "username", "name"  => "username");
	    if (isset($username)) $options['value'] = $username;
		echo form_input($options);
		echo "<br>\n"; // new line
		echo lang('form_password','password');
		echo form_password(array("id" => "password", "name" => "password"));
	    echo "<br>\n"; // new line
		echo '<span class="floatright">'."\n"; // positioning
				echo '<input type="submit" id="'.'login'.'" name="'.'login'.'" value="'.lang('form_login').'" />';
				echo '<input type="submit" id="'.'register'.'" name="'.'register'.'" value="'.lang('form_register').'" />';
				echo '<span class="floatright">'."\n"; // positioning
				echo lang('form_remember','remember');
				echo form_checkbox('remember', 'yes', TRUE);
				echo "<a href='http://localhost/index.php/main/view_account'> My Account </a>"; 
			echo '</span>'."\n"; 
		echo '</span>'."\n"; 
	echo form_close();
}
else { 
	echo form_open("user/logout/",array('class'=>'login_small'));
	echo sprintf(lang('msgvar_loggedin_as'), $userinfo->userName);
	echo '<input type="submit" id="'.'logout'.'" name="'.'logout'.'" value="'.lang('form_logout').'" />';
	echo form_close();
}
	
