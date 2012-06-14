<div id="body">

<?php foreach ($questions as $question): ?>
	<div id="question">
		<?php echo anchor('main/show/'.$question->questionID,$question->title); ?>
	</div>
<?php endforeach ?>
<?php echo($pagelinks);?>
</div>
