<div id="leftnav">
<ul>
<?php 
<<<<<<< HEAD
	echo '<li>'.anchor('index.php/main/view/about',"About Page").'</li>' ;
	echo '<li>'.anchor('',"Home").'</li>' 
=======
	// don't use ucfirst() here but mb_convert_case() for unicode support:
	echo '<li>'.anchor('main/view/about', mb_convert_case(lang('w_about'),MB_CASE_TITLE)).'</li>' ;
	echo '<li>'.anchor('', mb_convert_case(lang('w_home'),MB_CASE_TITLE)).'</li>';
	echo '<li>'.anchor('util/lang/english', lang('w_lang_en')).'</li>' ;
	echo '<li>'.anchor('util/lang/deutsch', lang('w_lang_de')).'</li>' ;
	echo '<li>'.anchor('util/lang/pashto', lang('w_lang_ps')).'</li>' ;
	echo '<li>'.anchor('util/lang/farsi', lang('w_lang_fa')).'</li>' ;
>>>>>>> ab47203fab09e2a95e6c5c31f05de67d92a6d17e
?>
</ul>

</div> <!-- leftnav -->