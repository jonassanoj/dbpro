
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
				<td valign="top">User Privileges <span style="color:red;">*</span></td>
				<td><input type="text" name="userTypeID" class="text" value="<?php echo set_value('userTypeID',$this->form_data->userTypeID); ?>"/>
<?php echo form_error('name'); ?>
				</td>
			</tr>

			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" value="Save"/></td>
			</tr>
		</table>
		</div>
		</form>
		<br />
		</div>
</body>
</html>