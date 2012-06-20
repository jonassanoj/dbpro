<script type="text/javascript">
$(document).ready(function() {
   $("#ajaxresult").css("visibility", "visible");  
   $("#submitit").click(function() {

        $("#ajaxresult").load("<?php echo site_url('ajax/qcomments/'.$question->questionID); ?>");
    });
   
 }); 
</script>



<div id="body">
<div class="question">
		<h3><?php echo $question->title; ?></h3>
		<p><?php echo $question->body; ?></p>

<div style="visibility:hidden" id="ajaxresult">
<form action="" method="POST">
  <input type="image" title="load comments" src=<?php echo base_url('img/icons/plus.png'); ?> width=30 name="submitit" id="submitit" onclick="return false" />
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

