<script type="text/javascript">
$(document).ready(function() {
   $("#ajaxresult").css("visibility", "visible");  
   $("#submitit").click(function() {

        $("#ajaxresult").load("<?php echo site_url('ajax/qcomments/'.$question->questionID); ?>");
    });
   
 }); 
</script>
<?php 
	//if(isset($_POST['up'])){
		//$_POST['questionID'] = $question->questionID;
		//add_question_rank($_POST['up'], $_POST['questionID']);
	//}
	//elseif (isset($_POST['down'])) {
		
	//	$_POST['questionID'] = $question->questionID;
	//	add_question_rank($_POST['vote'], $_POST['questionID']);
	//	}
?>

<div id="body">
<div class="question">
		<h3><?php echo $question->title; ?></h3>
		<?php echo $question->body; ?>
<div style="visibility:hidden" id="ajaxresult">
<form action="" method="POST">
  <input type="image" title="load comments" src=<?php echo base_url('img/icons/plus.png'); ?> width=30 name="submitit" id="submitit" onclick="return false" />
  		
</form> 
<form action="http:/index.php/util/vote" name="voting" method="POST">
<div>
	 <input type="submit" name="up" value="up" /> 
	<input type="submit" name="down" value="down"/> 
	<input type="hidden" value="<?php echo $question->questionID; ?>" name="qid" />

	 <!--   <a href="?vote=up&amp;id=" >Up</a>
	<a href="?vote=down&amp;id=" >Down</a> -->
		

</div>
</form>
<?php
if (isset($result))
    echo $result;
?>
</div> <!-- ajaxresult -->
</div>

<?php foreach ($answers as $answer): ?>
	<div class="answer">
		<?php echo $answer->body; ?>
		
	</div>
<?php endforeach ?>

<?php echo $backlink?>
</div> <!-- body -->

