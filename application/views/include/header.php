<?php 
	echo doctype(); 
	echo meta('Content-type', 'text/html; charset=utf-8', 'equiv');
?>
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
	
	// load Droid Sans/Droid Serif fonts 
	echo link_tag('css/font/droid.css');
	
	// favicon
	echo link_tag('favicon.png', 'shortcut icon', 'img/ico');
?>
</head>
<body>
<div id="container">
