<?php foreach ($comments as $comment): ?>
	<div class="comment">
		<b><?php echo $comment->userName; ?></b> says "<?php echo $comment->body; ?>"
	</div>
<?php endforeach ?>
