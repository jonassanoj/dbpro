<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html <?php
		if (isset($this->lang))
			echo 'lang='.lang('language_code').' xml:lang='.lang('language_code').' dir='.lang('language_dir');
		?> xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<head>
<?php 
	if (isset($scripts)) {
		foreach($scripts as $uri) echo '<script type="text/javascript" src="'.base_url($uri).'"></script>'."\n"; 
	}
	echo'<script type="text/javascript" src="'.base_url('js/jquery-1.7.2.min.js').'"></script>'."\n"; 
	echo "<title>$title</title>\n";
	
	// favicon
	echo link_tag('favicon.png', 'shortcut icon', 'img/ico')."\n";
	
	// Main stylesheet. Always load first.
	echo link_tag('css/main.css')."\n";
	echo link_tag('css/formee-style.css')."\n";
	echo link_tag('css/formee-structure.css')."\n";
	echo link_tag('css/commentForm.css')."\n";
	echo link_tag('css/answer_form.css')."\n";

	// Additional styles given in an array
	if (isset($styles)) {
		foreach($styles as $uri) echo link_tag($uri)."\n";
	}
?>
</head>

