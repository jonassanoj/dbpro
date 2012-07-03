<?php 

echo form_open('edit/process_comment', array('name' => 'comment_form', 'class' => ''));
echo "<p>";
if(isset($source_of_comment)) echo $source_of_comment; 
echo "</p>";
echo "<br>";
echo  lang('comment_textarea_label');
echo "<br>";
echo "<textarea name='comment_body' id='textarea' class=''>";
if(isset($comment)) echo $comment;
echo "</textarea>";
echo "<br>";
echo "<input type='hidden' name='cid' value = '".(isset($cid)? $cid: '')."'>";
echo "<input type='hidden' name='aid' value = '".(isset($aid)? $aid: '')."'>";
echo "<input type='hidden' name='qid' value = '".(isset($qid)? $qid: '')."'>";
echo "<input type='submit' name='btn_add' id='butstyle' value='".lang('add_comment')."'>";
echo "&nbsp" . "&nbsp";
echo "<input type='submit' name='btn_update' id='butstyle' value='".lang('update_comment')."'>";
echo "&nbsp" . "&nbsp";
echo "<input type='submit' name='btn_cancel' id='butstyle' value='".lang('cancel_comment')."'>";
echo "<br>";
echo "<br>";
echo "<p>";
if(isset($msg)) echo $msg; 
$this->session->flashdata('item');
echo "</p>";
echo form_close();
?>
