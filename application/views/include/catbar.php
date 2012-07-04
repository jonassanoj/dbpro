<script type="text/javascript">
function submit_form(path) {
	var e = document.getElementById("cat_sel");
	var val = e.options[e.selectedIndex].value;
	window.location = path+val+'/'+val;
	document.write('hello javascript');
}
</script>
<div id="catbar">
<ul>
 <?php 
  if (isset($categories)) 
  	foreach ($categories as $category) 
  		echo '<li>'.anchor('/main/filter/catID/'.$category->catID, $category->catName).'</li>';
 ?>
 
 <?php echo form_open('/main/cat'); ?>
 <select name="cat_sel" id="cat_sel" onselect="submit_form('<?php echo base_url()."/main/filter/"?>');" >
 <?php foreach ($general_cat as $cat): ?>
 <option value="<?php echo $cat->catID; ?>"><?php echo $cat->catName; ?></option>
 <?php endforeach;?>
 </select>
 <input type="submit" name="cat_sub" value="SelectCategory" >
 <?php echo form_close();?>
</ul>

</div>