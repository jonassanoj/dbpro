<div id="body">‎

<h3> <?php echo lang('msg_login_failed') ?></h3>
<?php echo sprintf(lang('msgvar_login_trial'), $failed_logins); ?> 
<?php 
	echo form_open("user/login/",array('class'=>'formee'));
	echo formee_div(12); // line one: name box
	    echo lang('form_username','username');
		echo form_input(array("id" => "username",
						      "name"  => "username",
						      "value" => $username));
	echo '</div>'.formee_div(12,DIV_CLEAR); // line two: password box
		echo lang('form_password','password');
		echo form_password(array("id" => "password",
						         "name" => "password",
						         "value" => ''));
	echo '</div>'.formee_div(6,DIV_CLEAR); // line three: remember box, and two buttons
		echo lang('form_remember','remember');;
		echo form_checkbox('remember', 'yes', TRUE);
		echo '</div>'.formee_div(3); 
		echo formee_button('register',lang('form_register'));
		echo '</div>'.formee_div(3);
		echo formee_button('login',lang('form_login'));
		echo '</div>';
		echo form_close();

        ?>

</div> <!-- body -->
