<div id="header">
<div id="loginbox">
	<?php 
		echo form_open("user/login/");
	    echo '<div class="field_container">';
	    echo form_label('Username','username');
		$attribute = array("id" => "username",
						   "name" => "username",
						   "value" => set_value('username'));

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
				echo form_label('remember me','remember');
		echo form_checkbox('remember', 'remember', TRUE);
		echo '</div>'; // .field_container
		echo '<div class="field_container">';
		$attribute = array("id" => "login",
						   "name" => "login",
						   "value" => "Login");
		echo anchor("user/register/","Register");
		echo form_submit($attribute);
		echo '</div>'; // .field_container
        echo form_close(); ?>

</div> <!-- loginbox -->

<h1>
<?php
     if (isset($title))
       echo($title);
     else echo("Goftogo"); 
?>
</h1>

</div> <!-- header -->
