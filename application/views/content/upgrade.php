<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<link href="<?php echo base_url(); ?>css/adminstyle.css" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url(); ?>css/calendar.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url(); ?>js/calendar.js"></script>

</head>
<body>
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
				<td><input type="text" name="userTypeID" class="text" value="<?php echo set_value('userTypeID',$this->form_data->userType); ?>"/>
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