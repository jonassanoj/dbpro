<div id="catbar">
<ul>
 <?php
	if (isset($categories))
		foreach ($categories as $category)
			echo '<li>' . anchor('/main/filter/catID/' . $category -> catID, $category -> catName) . '</li>';
		echo '<li>'.form_open('/main/cat');
		echo form_dropdown('cat_sel',$general_cat);
		echo form_submit('submit','Ok');
		echo form_close();
		echo '</li>';
 
 ?>
</ul>

</div>