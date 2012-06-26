
<script type="text/javascript"> 

	 /**
	 * this is Javascript and will call Ajax  
	 * 
	 * the first function will be loaded when the document is ready. 
	 * when the button signed with plus icon is clicked whose name is submitit it will change 
	 * the button to minus and will send the Question ID to Ajax class so Ajax calss will 
	 * send back the Comments related to this Question.
	 * the toggle function used will display or hide the effection of Ajax 
	 * and the toggle function is called when ever we click on the submitit button	
	 * 
	 * @author  Waheedullah Sulimankhail
	 * @package views
	 */
	$(document).ready(function() {
   		 $("#submitit").click(function() {
			document.getElementById("submitit").src="<?php echo base_url('img/icons/iconminus.png'); ?>";
			$("#ajaxresult").load("<?php echo site_url('ajax/qcomments/'.$question->questionID); ?>");    });
		
			$("#submitit").toggle(function() { $("#ajaxresult").toggle();
				document.getElementById("submitit").src="<?php echo base_url('img/icons/plus.png'); ?>";},
			function() { $("#ajaxresult").toggle();
				document.getElementById("submitit").src="<?php echo base_url('img/icons/iconminus.png'); ?>";});
 
 }); 		
   	
 
</script> <!-- javascript is closed -->






<script type="text/javascript"> 
	 /**
	 * Ajax Effected Area  
	 * 
	 * first the Question title and Question body will be loaded.
	 * the button will be created with initially plus sign and will be named submiit. 
	 * the result   (the comment) will be loaded in the DIV ajaxresult 
	 * 
	 * @author  Waheedullah Sulimankhail
	 * @package views
	 */
</script> <!-- javascript is closed -->
<div class="question">
		<h3><?php echo $question->title; ?></h3>
		<p><?php echo Markdown($question->body); ?></p>
		
		<form action="" method="POST">
  		<input type="image" title="load comments" src=<?php echo base_url('img/icons/plus.png'); ?> width=30 name="submitit" id="submitit" onclick="return false" />
	</form> 
<div id="ajaxresult">

<?php
if (isset($result))
    echo $result;
?>
</div> <!-- ajaxresult div closed-->
</div> <!-- Question div closed -->

<?php foreach ($answers as $answer): ?>
	<div class="answer">
		<?php echo $answer->body; ?>
	</div> <!-- answer dic closed -->
<?php endforeach ?>

<?php echo $backlink?>




