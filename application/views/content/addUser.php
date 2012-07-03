
<html 
<body>
	<link href="<?php echo base_url(); ?>css/adminstyle.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>css/calendar.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="<?php echo base_url(); ?>js/calendar.js"></script>
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
				<td valign="top">Full Name<span style="color:red;">*</span></td>
				<td><input type="text" name="fullName" class="text" value="<?php echo set_value('fullName',$this->form_data->fullName); ?>"/>
<?php echo form_error('name'); ?>
       
	 		</td>
			</tr>
			<tr>
				<td valign="top">User Name<span style="color:red;">*</span></td>
				<td><input type="text" name="userName" class="text" value="<?php echo set_value('userName',$this->form_data->userName); ?>"/>
<?php echo form_error('name'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Email Add<span style="color:red;">*</span></td>
				<td><input type="text" name="email" class="text" value="<?php echo set_value('email',$this->form_data->email); ?>"/>
<?php echo form_error('name'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Organization<span style="color:red;">*</span></td>
				<td><input type="text" name="orgonization" class="text" value="<?php echo set_value('orgonization',$this->form_data->orgonization); ?>"/>
<?php echo form_error('name'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Location<span style="color:red;">*</span></td>
				<td><input type="text" name="location" class="text" value="<?php echo set_value('location',$this->form_data->location); ?>"/>
<?php echo form_error('name'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Degree<span style="color:red;">*</span></td>
				<td><input type="text" name="degree" class="text" value="<?php echo set_value('degree',$this->form_data->degree); ?>"/>
<?php echo form_error('name'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">User Privileges <span style="color:red;">*</span></td>
				
              <td>
<?=form_dropdown('userTypeID',$userTypeList,set_value('userTypeID',$this->form_data->userTypeID), 'style="width: 240px; height:30px; font-size: 13px"');?> &nbsp; &nbsp; &nbsp; &nbsp;
 &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
						 
<?=form_error('userTypeID')?>
</td>
			<tr>
				<td valign="top">Study Field<span style="color:red;">*</span></td>
				<td>
<?=form_dropdown('fieldID',$fieldList,set_value('fieldID',$this->form_data->fieldID), 'style="width: 240px; height:30px; font-size: 13px"');?> &nbsp; &nbsp; &nbsp; &nbsp;
 &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
						 
<?=form_error('userTypeID')?>
</td>
				
			</tr>
			<tr>
				<td valign="top">Date of birth <span style="color:red;">*</span></td>
				<td><input type="text" name="dob" onclick="displayDatePicker('dob');" class="text" value="<?php echo set_value('dob',$this->form_data->dob); ?>"/>
				<a href="javascript:void(0);" onclick="displayDatePicker('dob');"><img src="<?php echo base_url(); ?>res/css/images/calendar.png" alt="calendar" border="0"></a>
<?php echo form_error('dob'); ?></td>
				
			</tr>
			<tr>
				<td valign="top">Aditional information<span style="color:red;">*</span></td>
				<td><input type="text" name="details" class="text" value="<?php echo set_value('details',$this->form_data->details); ?>"/>
<?php echo form_error('name'); ?>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" value="Save"/></td>
			</tr>
		</table>
		
</body>
</html>
