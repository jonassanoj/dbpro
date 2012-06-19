<?php echo doctype(); ?>
<html lang='en' xml:lang='en' xmlns="http://www.w3.org/1999/xhtml">
<?php echo meta('Content-type', 'text/html; charset=utf-8', 'equiv'); ?>

<head>
<script type="text/javascript" src="<?php echo base_url('js/jquery-1.7.2.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/formee.js');?>"></script>

<title> <?php echo($title); ?> </title>

<?php
	// Main stylesheet. Always load first.
	echo link_tag('css/main.css');
	
	// load Formee CSS form templates
	echo link_tag('css/formee-structure.css');
	echo link_tag('css/formee-style.css');
	
	// favicon
	echo link_tag('favicon.png', 'shortcut icon', 'img/ico');
?>

</head>
<body>
<div id="container">
