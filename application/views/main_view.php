<?php
/*
 *  basic view template (header,sidebar,footer)
 *  
 *  variables that are processed:
 *  $content string -- the uri of the view to load as content, required
 *  $title string -- the page title used as html title and the heading in the header
 *  $loginbox bool -- if true show loginbox
 *  $navigation array -- if set, show include/navigation_dynamic, else show include/navigation_default
 *  
 *  variables processed by include/header: 
 *  $this->lang object -- if set, localizes the document
 *  $scripts array -- uris of scripts to load
 *  $styles array -- uris of stylesheets to load
 *  
 *  variables processed by include/navigation_dynamic:
 *  $navigation array -- a list of strings, that should be output as navigation items (e.g. readily made links)  
 *  
 */ 

$this->load->view('include/header'); 

?>
<body>
	<div id="wrapper">
		<div id="header">
		<?php 
			
			if (isset($loginbox))
			if ($loginbox) {
				echo('<div id="loginbox">'."\n");
				$this->load->view('include/loginbox');
				echo('</div><!-- #loginbox-->'."\n");
			}
			echo("<h1>$title</h1>\n");
		?>
			
		</div><!-- #header-->
	
		<div id="middle">
			<div id="container">
				<div id="content">
					<?php $this->load->view($content);?>
				</div><!-- #content-->
			</div><!-- #container-->
			<div id="sidebar">
					<?php 
					if (isset($navigation)) 
						$this->load->view('include/navigation_dynamic');
					else 
						$this->load->view('include/navigation_default');
					?>
			</div><!-- #sidebar -->
		</div><!-- #middle-->
	</div><!-- #wrapper -->
	
	<div id="footer">
		<?php echo lang('title_main'); ?>. 2012
	</div><!-- footer  -->

</body>

</html>