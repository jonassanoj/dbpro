<div id="leftnav">
<ul>
<?php 
	// don't use ucfirst() here but mb_convert_case() for unicode support:
	echo '<li>'.anchor('main/view/about', mb_convert_case(lang('w_about'),MB_CASE_TITLE)).'</li>' ;
	echo '<li>'.anchor('', mb_convert_case(lang('w_home'),MB_CASE_TITLE)).'</li>';
	echo '<li>'.anchor('util/lang/english', lang('w_lang_en')).'</li>' ;
	echo '<li>'.anchor('util/lang/deutsch', lang('w_lang_de')).'</li>' ;
	echo '<li>'.anchor('', 'Wiki') .'</li>' ;
	echo '<li>'.anchor('','Doc') . '</li>' ;
?>
</ul>

</div> <!-- leftnav -->