

<?=form_open('edit/question')?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<fieldset style="width: 780px; vertical-align:middle; height:520px; border: 1px solid #D0D0D0; background-color: #f9f9f9; color: #002166; ;">
<legend><?=$this->input->post('titles')?></legend>
<table>
<tr>
<td><label>Title</label></d>
<td>
<?=form_input('title',set_value('title',($question!=null?$question->title:"")),'style="width: 400px; height:30px; font-size: 13px"')?>
<?=form_error('questionTitle')?>
</td>

</tr>
<tr>
<td style='vertical-align:top'>
<label>Question Body</label>
</td>
<td >
<?=form_textarea('body',set_value('body',($question!=null?$question->body:"")),'style="width: 600px; height:400px; color:black; font-size: 15px"')?>
<?=form_error('body')?>
</td>
</tr>
<tr><td></td><td></td></tr>
<tr>
<td><label>Category</label></td>
<td>


 &nbsp; &nbsp;  &nbsp; &nbsp;<?=form_dropdown('catID',$catList,set_value('catID',($question!=null?$question->catID:1)), 'style="width: 240px; height:30px; font-size: 13px"');?> &nbsp; &nbsp; &nbsp; &nbsp;
 &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
						 <?=form_submit('',$this->input->post('btn'),'style="width: 200px; height:30px; font-size: 13px"')?>
<?=form_error('catagory')?>
</td>
</tr>
<tr colspan='2'>
<td>

</td>
</tr>
</table>
</fieldset>
<?=form_close()?>

