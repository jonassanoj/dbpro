<div id="body">

<?php foreach ($questions as $question): ?>
	<div class="question">
		<?php echo anchor('index.php/main/qshow/'.$question->questionID,$question->title); ?>
	</div>
<?php endforeach ?>

<div class="pagination">
<?php echo "<center>" .($pagelinks);?>
</div>
</div> <!-- body -->


