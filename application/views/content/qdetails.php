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
<div class="question">
		<h3><?php echo $question->title; ?></h3>
		<div class="markdown">
		<p><?php echo Markdown($question->body); ?></p>
		
		<?php
	 
		
		$rank=$question->rank;
		$col="black";
		if($rank<=0)
			$col="red";
		elseif ($rank>0 && $rank<=10)
		$col="gray";
		elseif ($rank>10 && $rank<50)
		$col="black";
		elseif ($rank>50 && $rank<100)
		$col="#4169E1";
		else
			$col="#FFD700";
		
		echo 'Rank = <label style="color:'.$col.';">'.$rank.'</label>';?>
		
		
		
		<br>
		<?php if($this -> session-> userdata('login')){ ?>
		<p> Click <a href="<?php echo base_url()."edit/comment/".$question -> questionID.
		"/0"."/0" ?>" title='Add new comment'> here  </a> to write a comment ! </p>
		<?php }?>
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
	
		<?php
	// Abdulaziz Akbary Hamidullah khanzai
	
	// This code will show a edit image for the user in condition 
	// if the the current question belongs to the user or the use which is loged in is 
	// an editor or admin it also check if the question if posted by the unregistered user 
	// the unregistered user does not have the rights to edit question because all the unregistered user the in the quesiton table
	// the id of the user would be 0 The user will get a confirmation message
	?>
	 <?php if($this->session->userdata('login')):?>
			<?php if(($this -> session -> userdata('uid') == $question->userID) 
					|| ($this->session->userdata('user')->userTypeID == 2)
					|| ($this->session->userdata('user')->userTypeID == 3)):?>
				<a href="<?=base_url()?>index.php/edit/question/<?= $question->questionID;?>">
	   			 <img src="<?=base_url()?>/img/unused/edit.png" alt="cant display"
	    		 height="30px" title="Edit Question" width="30px"/>
		</a>
			<?php endif;?>
		<?php endif;?>	
		
		
		
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
		<br>
		<?php
		
		
		 $rank=$answer->rank;
			$col="black";
			if($rank<=0)
				$col="red";
			elseif ($rank>0 && $rank<=10)
				$col="gray";
			elseif ($rank>10 && $rank<50)
				$col="black";
			elseif ($rank>50 && $rank<100)
				$col="#4169E1";
			else 
				$col="#FFD700";
				echo 'Rank = <label style="color:'.$col.';">'.$rank.'</label>';?>
		
		
		
	<div class="vote">	
	<?php if($this->session->userdata('login')):?>
	<?php if($answer->vote){
					echo "you already voted"; echo "<br>";}
	else {
		include "avote.php";}?>
	<?php endif;?>	
	</div>	
	<!-- Edit answer, add answer, delete answer-->
        <?php if($this->session->userdata('login')):?>
			
			<a href="<?php echo base_url()."index.php/edit/answer/".$question->questionID ?>">
				<img src="<?php echo base_url('img/unused/write.png'); ?>"
				align="middle" width="25" height="25" title="Add new answer"/> 
			</a> &nbsp;
			
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



