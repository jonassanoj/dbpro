 <?php
	if (isset($categories)){
		echo '<div id="catbar">';
		echo "\n <ul> \n";
		foreach ($categories as $category)
			echo '<li>' . anchor('/main/filter/catID/' . $category -> catID, $category -> catName) . "</li> \n";
		echo '<li>'.form_open('/main/cat')."\n";
		echo form_dropdown('cat_sel',$general_cat);
		echo form_submit('submit','Ok');
		echo form_close();
		echo "</li>\n </ul> </div>";		
	}
 
 ?>