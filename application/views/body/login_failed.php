<div id="body">

<div class="notification">
<h3> The login with username "<b><?php echo $username ?></b>" was not successful </h3>
<?php echo $this -> session -> userdata('failed_logins'); ?> failed logins...
</div>
	<?php 
		echo form_open("user/login/",array('id'=>'form'));
	    echo '<div class="field_container">';
	    echo form_label('Username','username');
		$attribute = array("id" => "username",
						   "name" => "username",
						   "value" => $username);

		echo form_input($attribute);
		$attribute = array("id" => "password",
						   "name" => "password",
						   "value" => '');
		echo '</div>'; // .field_container
		echo '<div class="field_container">';
		echo form_label('Password','password');
		echo form_password($attribute);
		echo '</div>'; // .field_container
		echo '<div class="field_container">';
		$attribute = array("id" => "login",
						   "name" => "login",
						   "value" => "Login");
		echo anchor("user/register/","Register");
		echo form_submit($attribute);
		echo '</div>'; // .field_container
        echo form_close(); ?>
</div> <!-- body -->
