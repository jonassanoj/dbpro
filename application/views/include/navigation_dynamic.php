<ul>
<?php
// static part (always there)
	echo '<li><h2>'.anchor('', mb_convert_case(lang('w_home'),MB_CASE_TITLE))."</h2></li>\n" ;
// dynamic part
	foreach($navigation as $link) 
		echo "<h2><li>$link</h2></li>\n" ;
?>
</ul>