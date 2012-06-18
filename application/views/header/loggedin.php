<div id="header">
<div id="loginbox">
	<?php 
		echo form_open("user/logout/",array('id'=>'form'));
		echo '<div class="field_container" align=center>';
		echo 'Logged in as <b>'.$username.'</b> - ';
		echo '</div>'; // .field_container
	    $attribute = array("id" => "logout",
						   "name" => "logout",
						   "value" => "Logout");
	    echo '<div class="field_container" align=center>';
	    echo form_submit($attribute);
	    echo '</div>'; // .field_container
		echo form_close(); ?>
</div> <!-- loginbox -->

<h1>
<?php
       echo($title);
?>
</h1>

</div> <!-- header -->
