<div id="leftnav">
<ul>
<?php 
	// don't use ucfirst() here for unicode support:
	echo '<li>'.anchor('main/view/about', mb_convert_case(lang('w_about'),MB_CASE_TITLE)).'</li>' ;
	echo '<li>'.anchor('', mb_convert_case(lang('w_home'),MB_CASE_TITLE)).'</li>';
	echo '<li>'.anchor('util/lang/english', mb_convert_case(lang('w_lang_en'),MB_CASE_TITLE)).'</li>' ;
	echo '<li>'.anchor('util/lang/deutsch', mb_convert_case(lang('w_lang_de'),MB_CASE_TITLE)).'</li>' ;
	echo '<li>'.anchor('util/lang/farsi', mb_convert_case(lang('w_lang_fa'),MB_CASE_TITLE)).'</li>' ;
?>
</ul>

</div> <!-- leftnav -->