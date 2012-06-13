<h2>Answer the Question</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('index.php/view/createAnswer') ?>

	<label for="questionID">QID</label> 
	<input type="input" name="questionID" /><br />
	
	
	
	<label for="body">Body</label>
	<textarea name="body" column=40 rows=15></textarea><br />
	
	<br />
	<input style="background-color:lightblue" type="submit" name="submit" value="Ask Question" /> 

</form>