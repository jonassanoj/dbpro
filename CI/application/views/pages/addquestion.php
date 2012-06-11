<h2>Ask a new Question</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('index.php/view/createQuestion') ?>

	<label for="category">catID</label> 
	<input type="input" name="catid" /><br />
	
	<label for="title">Title</label> 
	<input type="input" name="title" /><br />
	
	<label for="body">Body</label>
	<textarea name="body" column=40 rows=15></textarea><br />
	
	<br />
	<input style="background-color:lightblue" type="submit" name="submit" value="Ask Question" /> 

</form>