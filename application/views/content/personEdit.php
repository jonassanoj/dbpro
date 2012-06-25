<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Add and edit the user</title>

<link href="<?php echo base_url(); ?>res/css/adminstyle.css" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url(); ?>res/css/calendar.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url(); ?>res/js/calendar.js"></script>

</head>
<body>
	<div class="content">
		<h1><?php echo $title; ?></h1>
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
				<td valign="top">Name<span style="color:red;">*</span></td>
				<td><input type="text" name="name" class="text" value="<?php echo set_value('name',$this->form_data->name); ?>"/>
<?php echo form_error('name'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Gender<span style="color:red;">*</span></td>
				<td><input type="radio" name="gender" value="M" <?php echo set_radio('gender', 'M', $this->form_data->gender == 'M'); ?>/> M
					<input type="radio" name="gender" value="F" <?php echo set_radio('gender', 'F', $this->form_data->gender == 'F'); ?>/> F
<?php echo form_error('gender'); ?>
					</td>
			</tr>
			<tr>
				<td valign="top">Date of birth <span style="color:red;">*</span></td>
				<td><input type="text" name="dob" onclick="displayDatePicker('dob');" class="text" value="<?php echo set_value('dob',$this->form_data->dob); ?>"/>
				<a href="javascript:void(0);" onclick="displayDatePicker('dob');"><img src="<?php echo base_url(); ?>res/css/images/calendar.png" alt="calendar" border="0"></a>
<?php echo form_error('dob'); ?></td>
				
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" value="Save"/></td>
			</tr>
		</table>
		</div>
		</form>
		<br />
		<?php echo $link_back; ?>
	</div>
</body>
</html>
