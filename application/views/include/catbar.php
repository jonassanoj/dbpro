<div id="catbar">
<ul>
 <?php 
  if (isset($categories)) 
  	foreach ($categories as $category) 
  		echo '<li>'.anchor('/main/filter/catID/'.$category->catID, $category->catName).'</li>';
 ?>
 
</ul>

</div>