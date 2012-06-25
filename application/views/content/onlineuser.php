<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Dash Board Example</title>

<link href="<?php echo base_url(); ?>css/adminstyle.css" rel="stylesheet" type="text/css" />

</head>
<body>
	<div class="content">
		<h1>Dash Board Example</h1>
		<div class="paging"><?php echo $pagination; ?></div>
		<div class="data"><?php echo $table; ?></div>
		<br />
		<?php echo anchor("person/add/","Add new user",array('class'=>'add')); ?>
		<?php echo anchor('person/index/','Back to list of persons',array('class'=>'back')); ?>
	</div>
</body>
</html>

