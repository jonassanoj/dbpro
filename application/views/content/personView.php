<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Dash Board Aplication</title>

<link href="<?php echo base_url(); ?>/css/adminstyle.css" rel="stylesheet" type="text/css" />

</head>
<body>
	<div class="content">
		<div class="data">
		<table>			
			<tr>
				<td valign="top">ID</td>
				<td><?php echo $person->userID; ?></td>
			</tr>
			<tr>
				<td valign="top">Full Name:</td>
				<td><?php echo $person->fullName ; ?></td>
			</tr>
			<tr>
				<td valign="top">User Name: </td>
				<td><?php echo $person->userName; ?></td>
			</tr>
			<tr>
				<td valign="top">Location:</td>
				<td><?php echo $person->location; ?></td>
			</tr>
			<tr>
				<td valign="top">Degree:</td>
				<td><?php echo $person->degree; ?></td>
			</tr>
			<tr>
				<td valign="top">Organization:</td>
				<td><?php echo $person->organization; ?></td>
			</tr>
			<tr>
				<td valign="top">User Privileges:  </td>
				<td><?php echo $person->userTypeID; ?></td>
			</tr>
			<tr>
				<td valign="top">Study Field:</td>
				<td><?php echo $person->fieldID; ?></td>
			</tr>			
			<tr>
				<td valign="top">Email Address:</td>
				<td><?php echo $person->email; ?></td>
			</tr>
			<tr>
				<td valign="top">Date of Birth:</td>
				<td><?php echo $person->dateOfBirth; ?></td>
			</tr>
			<tr>
				<td valign="top">Date of Acount Creation:</td>
				<td><?php echo $person->acountCreationDate; ?></td>
			</tr>
			<tr>
				<td valign="top">Rank Rate </td>
				<td><?php echo $person->rank; ?></td>
			</tr>
			<tr>
				<td valign="top">Aditional information </td>
				<td><?php echo $person->detail; ?></td>
			</tr>
		</table>
		</div>
		<br />
		<?php echo $link_back; ?>
	</div>
</body>
</html>
