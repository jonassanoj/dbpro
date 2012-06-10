<h2>Create a news item</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('view/createQuestion') ?>

	<label for="title">name</label> 
	<input type="input" name="title" /><br />

	<label for="text">body</label>
	<textarea name="text" column=40 rows=15></textarea><br />
	
	<input type="submit" name="submit" value="Add a new question" /> 

</form>
