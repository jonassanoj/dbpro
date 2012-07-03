<form action="<?php echo site_url('util/a_vote/'.$answer->answerID)?>" name="answer_voting" method="POST">
	
		 <input type="image" title="upvote" src=<?php echo base_url('img/icons/upvote.png'); ?> width=30 name="aup" value="up" />
		&nbsp;&nbsp;
		<input type="image" title="downvote" src=<?php echo base_url('img/icons/downvote.png'); ?> width=30 name="adown" value="down" />
	
</form>
