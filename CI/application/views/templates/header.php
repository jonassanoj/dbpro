<html>
<head>

<link rel="stylesheet" href="<?php echo base_url('css/style.css');?>" type="text/css" media="screen"/>

	<title><?php echo $title ?> goftogo forum</title>

</head>
<body>
<div id="container">

<div id="header"><img src="<?php echo base_url('pictures/newbanner.jpg'); ?>">
<form form method="post" accept-charset="utf-8" action="http:/index.php/view/search">
<input type="text" class="searchbox" name="s"/>
<input type="image" src="<?php echo base_url('pictures/search.jpg'); ?>" class="searchbox_submit" value="" />
</form>
<div class="HorizLinks">
<ul>
<li><a href="<?php echo base_url('index.php/pages/view/home'); ?>">Home</a></li>
<li><a href="<?php echo base_url('index.php/pages/view/news'); ?>">News</a></li>
<li><a href="<?php echo base_url('index.php/pages/view/about'); ?>">About Us</a></li>
<li><a href="<?php echo base_url('index.php/pages/view/contact'); ?>">Contact Us</a></li>
<li><a href="<?php echo base_url('index.php/view/createQuestion'); ?>">Add-Question</a></li>
<li><a href="<?php echo base_url('index.php/pages/view/addanswer'); ?>">Add-Answer</a></li>
</ul>
</div>
</div>



