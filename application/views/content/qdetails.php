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
   	
 
var doConfirm = function()
    {
        if(confirm("Do you really want to delete your answer?"))
            return true;
        else
            return false;
    }
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
<div>
<?php 
// this can be used for all kind adding, editing and deleting
// for answer i have done, for question is the same, and for comment is the same
// but they have to use the same index for flash data
// style class is in main.css, for its only design for 
// success messages (color green) border green
if($this->session->flashdata('delete_message')) {
	echo ("<p class='message'>"
		.$this->session->flashdata('delete_message')."</p>");
 }
else if($this->session->flashdata('update_message')) {
	echo ("<p class='message'>"
		.$this->session->flashdata('update_message')."</p>");
 }
 else if($this->session->flashdata('add_message')) {
 	echo ("<p class='message'>"
 			.$this->session->flashdata('add_message')."</p>");
 }
?>
</div>
<div class="question">
		<h3><?php echo $question->title; ?></h3>
		<div class="markdown">
		<p><?php echo Markdown($question->body); ?></p>
		</div>
	
		<form action="" method="POST">
  		<input type="image" title="load comments" src=<?php echo base_url('img/icons/plus.png'); ?> width=30 name="submitit" id="submitit" onclick="return false" />

	</form> 
	<div class="vote">
<?php if($question->vote){
					echo "you already voted";}
	else {
		include "qvote.php";}?>

	</div>
	</form>
		<?//if($this->session->userdata('uid')==$question->userID || ($this->session->userdata('user','userTypeID'))==2 || ($this->session->userdata('user','userTypeID'))==3):?>
		<a href="<?=base_url()?>index.php/edit/question/<?= $question->questionID;?>" >  <img src="<?=base_url()?>/img/icons/edit.png" alt="cant display" height="40px" width="50px"/>
	<!-- button for adding answer-->
	<?php if($this->session->userdata('login')):?>
			<a href="<?php echo base_url()."index.php/edit/answer/".$question->questionID ?>">
			<img src="<?php echo base_url('img/unused/write.png'); ?>"
			align="top" width="25" title="Add new answer"/> 
			</a>
	<?php endif; ?>
		<?//endif;?>

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
	<div class="vote">	
	<?php if($answer->vote){
					echo "you already voted"; echo "<br>";}
	else {
		include "avote.php";}?>
	</div>	
	<!-- Edit answer, add answer, delete answer-->
        <?php if($this->session->userdata('login')):?>
			<?php if($i == count($answers)-1):?>
			<a href="<?php echo base_url()."index.php/edit/answer/".$question->questionID ?>">
				<img src="<?php echo base_url('img/unused/write.png'); ?>"
				align="middle" width="25" height="25" title="Add new answer"/> 
			</a> &nbsp;
			<?php endif; $i++;?>
			<?php if(($this -> session -> userdata('uid') == $answer->userID) 
					|| ($this->session->userdata('user')->userTypeID == 2) // checking for editor or admin
					|| ($this->session->userdata('user')->userTypeID == 3)):?>
				<a href="<?php echo base_url()."index.php/edit/answer/".$question->questionID."/".$answer->answerID  ?>">
					<img src="<?php echo base_url('img/unused/edit.png'); ?>"
					align="middle" width="25" height="25" title="Edit your answer"/> 
				</a> &nbsp;
				<a href="<?php echo base_url()."index.php/edit/delete_answer/".$answer->answerID ?>" 
				onclick="return doConfirm();">
					<img src="<?php echo base_url('img/unused/trash.png'); ?>"
					align="middle" width="25" height="25" title="Delete your answer"/> 
				</a>
			<?php endif;?>
		<?php endif;?>	

</div> <!-- answer div closed -->
	
<?php endforeach ?>

<?php echo $backlink?>



