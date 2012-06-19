<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />

	<title></title>
<?php
	// Main stylesheet. Always load first.
	echo link_tag('css/main.css');
	
	// load Formee CSS form templates
	//echo link_tag('css/formee-structure.css');
	//echo link_tag('css/formee-style.css');
	
	// favicon
	echo link_tag('favicon.png', 'shortcut icon', 'img/ico');
?>


</head>



<body>

<div id="wrapper">



	<div id="header">
		
		<?php $this->load->view('header/loginbox');?>

	</div><!-- #header-->


	<div id="middle">
		<div id="container">
			<div id="content">
				<?php $this->load->view("body/$bodyview");?>
			</div><!-- #content-->
		</div><!-- #container-->
		<div class="sidebar" id="sideLeft">
				<?php $this->load->view('leftnav/default');?>
		</div><!-- .sidebar#sideLeft -->
	</div><!-- #middle-->
</div><!-- #wrapper -->
<div id="footer">

<?php $this->load->view('include/footer');?>

</div><!-- #footer -->



</body>

</html>