<?php
//TODO: form localization 
/*
The form is not localize still
it need to take every message and name from language file


NOTE: in line number 24 we also added index.php with url if it not worked for you
please remove it and configure it for you
*/
if($this -> session -> userdata('form') == 'new' 
	|| $this -> session -> userdata('form') == 'update') {
	echo "<h3>".(isset($questiontitle)? $questiontitle: '')."</h3>";
	echo "<p>".(isset($question)? $question: '')."</p>";
	echo form_open('edit/answer/'.$qid.'/'.$aid, array('name' => 'answer_form', 'class' => ''));
	echo "<p class='hint'>";
	echo "Write answer below";
	echo "</p>";
	echo "<textarea name='answer_body' rows='10' id='answer_body' class='textarea' >";
	if(isset($body)) echo $body;
	echo "</textarea>";
	echo "<br>";
	echo "<input type='submit' name='btn_save' id='btn_save' value='Save' class='save'>";
	echo "&nbsp; &nbsp;";
	echo "<a href='".base_url()."index.php/edit/delete_answer/".(isset($aid)? $aid: '')."' class='delete'>Delete</a>";
	echo "<div class='ans_error'>".validation_errors()."</div>";	
	echo "<br>";
	echo "<p>";
	if(isset($insert)) echo $insert; 
	echo "</p>";
	echo form_close();
}
else {
	echo $message; 
}
?>