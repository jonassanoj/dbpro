<div id="body">

<?php foreach ($questions as $question): ?>
	<div class="question">
		<?php echo anchor('main/qshow/'.$question->questionID,$question->title); ?>
	</div>
<?php endforeach ?>

<div class="pagination">
<?php echo($pagelinks);?>
</div>
</div> <!-- body -->


