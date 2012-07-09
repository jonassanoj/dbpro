
<html>



<body>
	<link href="<?php echo base_url(); ?>css/adminstyle.css" rel="stylesheet" type="text/css" />
		<div class="content">
		<?php echo $message; ?>
		<form method="post" action="<?php echo $action; ?>">
		<div class="data">
		<table>
			<tr>
				<td width="30%">ID</td>
				<td><input type="text" name="id" disabled="disable" class="text" value="<?php echo set_value('id'); ?>"/></td>
				<input type="hidden" name="id" value="<?php echo set_value('id',$this->form_data->id); ?>"/>
			</tr>
			<tr>
				<td valign="top">User Name<span style="color:red;">*</span></td>
				<td><input type="text" name="userName" class="text" value="<?php echo set_value('userName',$this->form_data->userName); ?>"/>
<?php echo form_error('name'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Deletion Type <span style="color:red;">*</span></td>
					
              <td>
 <?=form_dropdown('deletionID',$deletion_types,set_value('deletionID',$this->form_data->deletionID), 'style="width: 240px; height:30px; font-size: 13px"');?> &nbsp; &nbsp; &nbsp; &nbsp;
 &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
						 
<?=form_error('deletionID')?>
</td>
			</tr>

			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" value="Delete user",<?php array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this person?')");?></td>
			</tr>
		</table>
		</div>
		</form>
		<br />
		</div>
</body>
</html>