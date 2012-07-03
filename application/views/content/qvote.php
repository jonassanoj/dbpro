<form action="<?php echo site_url('util/q_vote/'.$question->questionID)?>" name="voting" method="POST">
	
	 	<input type="image" title="upvote" src=<?php echo base_url('img/icons/upvote.png'); ?> width=30 name="up" value="up" />
		&nbsp;&nbsp;
		<input type="image" title="downvote" src=<?php echo base_url('img/icons/downvote.png'); ?> width=30 name="down" value="down" />
	
</form>
