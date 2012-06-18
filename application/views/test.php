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
	font: normal 100% sans-serif;
	line-height: 1.5;
	margin: 3em;
	color: black;
}

ul {
	margin: 0 auto;
	border-width: 1px;
	border-style: solid;
	border-color: black;
	width: 85%;
	padding: 4px;
	list-style:none;
	text-align: justify;
}

li {
 padding: 3px;
 margin: 3px;
}

ul ul {
	width: 95%;
	margin-top: 2em;
	background-color: CornflowerBlue;
}
ul ul ul {
	margin-top: 0;
	background-color: gray;
}


ul li {
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-color: black;
	padding: 2em;
	font: bold x-large sans-serif;
}

ul ul li { 
	background-color: beige;
	font: normal medium sans-serif; 
	padding: 3px;
}

/*
ul ul { }

*/

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


