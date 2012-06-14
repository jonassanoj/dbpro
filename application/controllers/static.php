<?php

class Static extends CI_Controller {

public function view($page)
{
			
	if ( ! file_exists('application/views/pages/'.$page.'.php'))
	{
		// Whoops, we don't have a page for that!
		show_404();
	}
	
	$data['title'] = ucfirst($page); // Capitalize the first letter
	
	$this->load->view('templates/header', $data);
	$this->load->view('static/'.$page, $data);
	$this->load->view('templates/footer', $data);

}

}
