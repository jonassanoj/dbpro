<div id="header">


<div id="loginbox">
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
		echo lang('form_remember','remember');;
		echo form_checkbox('remember', 'yes', TRUE);
		echo '<br>'; // clear left
		$attribute = array("id" => "login",
						   "name" => "login",
						   "value" => "Login");
		echo form_label('','login');
		echo anchor("user/register/",lang('form_register'));
		echo form_submit($attribute);
        echo form_close(); ?>
</div> <!-- loginbox -->

<h1>
<?php echo($title); ?>
</h1>

</div> <!-- header -->
