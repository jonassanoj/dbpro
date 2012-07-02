
<html >

<body>
<link href="<?php echo base_url(); ?>/css/adminstyle.css" rel="stylesheet" type="text/css" />
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
				<td><?php echo $person->userType; ?></td>
			</tr>
			<tr>
				<td valign="top">Study Field:</td>
				<td><?php echo $person->fieldName; ?></td>
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
				<td valign="top">Last log in </td>
				<td><?php echo $person->lastLogin; ?></td>
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
		
</body>
</html>
