<div id="leftnav">
<ul>
<?php 
	echo '<li>'.anchor('main/view/about',"About Page").'</li>' ;
	echo '<li>'.anchor('',"Home").'</li>' 
?>
</ul>

<form id="form">
	<input type="text" value="Search..." onfocus="if (this.value == 'Search...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search...';}" />
	<input type="button" class="submit" value="Go" />
</form>


</div> <!-- leftnav -->