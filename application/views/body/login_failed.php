<div id="body">‎

<div class="notification">
<h3> <?php echo lang('msg_login_failed') ?></h3>
<?php echo sprintf(lang('msgvar_login_trial'), $failed_logins); ?> 
	<?php 
		echo form_open("user/login/",array('id'=>'form'));
	    echo lang('form_username','username');
		$attribute = array("id" => "username",
						   "name" => "username",
						   "value" => $username);
		echo form_input($attribute);
		echo '<br>'; // clear left
		$attribute = array("id" => "password",
						   "name" => "password",
						   "value" => '');
		echo lang('form_password','password');
		echo form_password($attribute);
		echo '<br>'; // clear left
		echo anchor("user/register/",lang('form_register'));
		echo form_label('','login');
		$attribute = array("id" => "login",
						   "name" => "login",
						   "value" => "Login");
		echo form_submit($attribute);
		echo form_close(); ?>
</div> <!-- notification -->
</div> <!-- body -->
