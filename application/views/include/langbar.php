<ul>
<?php
// static part (always there)
	echo '<li><h2>'.anchor('', mb_convert_case(lang('w_home'),MB_CASE_TITLE))."</h2></li>\n" ;
	echo '<li><h2>'.anchor('util/lang/english', lang('w_lang_en'))."</h2></li>\n" ;
	echo '<li><h2>'.anchor('util/lang/deutsch', lang('w_lang_de'))."</h2></li>\n" ;
	echo '<li><h2>'.anchor('util/lang/farsi', lang('w_lang_fa'))."</h2></li>\n" ;
	echo '<li><h2>'.anchor('util/lang/pashto', lang('w_lang_ps'))."</h2></li>\n" ;
?>
</ul>