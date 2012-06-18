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

dl { 
	margin: 0 auto;
	border-width: 1px;
	border-style: solid;
	border-color: black;
	width: 85%;
	padding: 1em;
	list-style:none;
	text-align: justify;
}

dd, dt { /* all keys or values */
 
 /*padding: 3px; margin: 3px;*/
 margin-left:0.3em;
 display: inline; 
}


dt { /* all keys  */
 font-style:italic;
 margin-left:2em;
}

dl dl { /* level two list */
	width: 95%;
	margin-top: 2em;
	padding: 5px;
	background-color: #F0F8FF;
}
dl dl dl { /* level three+ list */
	margin-top: 0;
	background-color: #ADD8E6;
}

dl dd { /* values level 1+ */
	font-size: x-large;
}

dl dt { /* keys level 1+ */
	font-size: large;
	}

dl dl dd { /* values level 2+ */
	font-size: large; 

}
 dl dl dt { /* keys level 2+ */
	font-size: medium; 
 }

/*
<dl>
  Test of user_model -> get_usertypes()
    <dl>
      0
        <dl>
          <dt>userTypeID: </dt><dd>0</dd>          <dt>userType: </dt><dd>unconfirmed</dd>        </dl>
            1
        <dl>
          <dt>userTypeID: </dt><dd>1</dd>          <dt>userType: </dt><dd>Normal User</dd>        </dl>
            2
        <dl>
          <dt>userTypeID: </dt><dd>2</dd>          <dt>userType: </dt><dd>Editor</dd>        </dl>
            3
        <dl>
          <dt>userTypeID: </dt><dd>3</dd>          <dt>userType: </dt><dd>Admin</dd>        </dl>
          </dl>
  </dl>
*/

--!>
</style> 
</head>
<body>
<?php
	function mylist($type = 'ul', $list, $depth = 0)
	{
		// If an array wasn't submitted there's nothing to do...
		if ( ! is_array($list))
		{
			return $list;
		}

		// Set the indentation based on the depth
		$out = str_repeat(" ", $depth);

		// Write the opening list tag
		$out .= "<".$type.">\n";

		// Cycle through the list elements.  If an array is
		// encountered we will recursively call _list()

		static $_last_list_item = '';
		foreach ($list as $key => $val)
		{
			$_last_list_item = $key;

			$out .= str_repeat(" ", $depth + 2);
			
			if ( ! is_array($val))
			{
				$out .= '<dt>'.$key.': </dt>'.'<dd>'.$val.'</dd>';
			}
			else
			{
				$out .= '<dd>'.$_last_list_item."</dd>\n";
				$out .= mylist($type, $val, $depth + 4);
				$out .= str_repeat(" ", $depth + 2);
			}

			//$out .= "</li>\n";
		}

		// Set the indentation for the closing tag
		$out .= str_repeat(" ", $depth);

		// Write the closing list tag
		$out .= "</".$type.">\n";

		return $out;
	}

$this->load->helper('html');

echo heading($title,1);

if (!isset($result)) {
	echo heading('$result is not defined, this should not happen...',2);
}


$array = json_decode(json_encode($result, JSON_FORCE_OBJECT),true);


echo mylist('dl',$array);

?>
</body>
</html>


