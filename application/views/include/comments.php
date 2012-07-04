<?php foreach ($comments as $comment): ?>
	<div class="comment">
		<b><?php echo $comment->userName; ?></b> says "<?php echo $comment->body; ?>"
		&nbsp
		<?php if($this -> session-> userdata('login') && ($this->session->userdata('uid') == $comment->userID)) {?>
		<a href="<?php echo base_url()."edit/comment/".($comment->questionID != '' ? $comment->questionID : 0) .
		"/".($comment->answerID != '' ? $comment->answerID : 0) ."/0" ?>" title='Add new comment'>
		<img name='imgAdd' src='<?php echo base_url('img/icons/add.png'); ?>'style="margin-bottom: 0.6%" width='20' height='20'/> </a>
		<a href="<?php echo base_url()."edit/comment/".($comment->questionID != '' ? $comment->questionID : 0) .
		"/".($comment->answerID != '' ? $comment->answerID : 0) ."/".($comment->commentID != '' ? $comment->commentID : 0) ?>" title='Edit the comment'>
		<img name='imgEdit' src='<?php echo base_url('img/unused/edit.png'); ?>' width='23' height='23'/> </a>
		<a href="<?php echo base_url()."edit/delete_comment/".$comment->commentID ?>" title='Remove the comment'>
		<img name='imgTrash' src='<?php echo base_url('img/unused/trash.png'); ?>' width='25' height='25'/> </a>
		
		<?php }?>
		</div>
<?php endforeach ?>