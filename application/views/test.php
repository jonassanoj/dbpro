<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<html>
<head>
<title><?php echo($title); ?>
</title>
<style> 
<!--
body {
	background: white;
	font: normal 120% sans-serif;
	line-height: 1.5;
	margin: 4em;
	color: black;
}

ul {
	margin: 0 auto;
	border-width: 1px;
	border-style: solid;
	width: 60%;
	border-color: black;
	padding: 4px;
	list-style:none;
	text-align: justify;
}

li {
 padding: 2px;
 margin: 2px;
}

ul li {
	border-bottom-width: 1px;
	border-bottom-style: solid;
	
	border-color: black;
}


ul ul {background-color: #007C7C; }

ul ul li { background-color: #DDDFDF; }

--!>
</style> 
</head>
<body>
<?php
$this->load->helper('html');

echo heading($title,1);

if (!isset($result)) {
	echo heading('$result is not defined, this should not happen...',2);
}


$array = json_decode(json_encode($result), true);
echo ul($array);
?>
</body>
</html>


